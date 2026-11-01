// Cloudflare Worker: live Tadawul quotes for the "Markets" card on the home page.
// Deploy it (the free plan is enough), then put its URL in STOCKS_ENDPOINT in index.html.
// GET /?symbols=2222.SR,1211.SR  ->  [{ symbol, price, changePercent, time }]
// Data comes from Yahoo Finance's public chart endpoint (unofficial; check its terms before relying on it).
const ALLOWED = /^(\^TASI\.SR|\d{4}\.SR)$/;

export default {
  async fetch(request, env, ctx) {
    const cors = { 'Access-Control-Allow-Origin': '*', 'Content-Type': 'application/json' };
    const url = new URL(request.url);
    const symbols = (url.searchParams.get('symbols') || '').split(',').filter(s => ALLOWED.test(s)).slice(0, 20);
    if (!symbols.length) return new Response('[]', { headers: cors });

    const cache = caches.default, key = new Request(url.toString());
    const hit = await cache.match(key);
    if (hit) return hit;

    const quotes = await Promise.all(symbols.map(async symbol => {
      try {
        const r = await fetch(`https://query1.finance.yahoo.com/v8/finance/chart/${encodeURIComponent(symbol)}?range=1d&interval=1d`, { headers: { 'User-Agent': 'Mozilla/5.0' } });
        const m = (await r.json()).chart.result[0].meta;
        return { symbol, price: m.regularMarketPrice, changePercent: m.regularMarketChangePercent, time: m.regularMarketTime };
      } catch {
        return { symbol };
      }
    }));

    const res = new Response(JSON.stringify(quotes), { headers: { ...cors, 'Cache-Control': 'public, max-age=60' } });
    ctx.waitUntil(cache.put(key, res.clone()));
    return res;
  },
};
