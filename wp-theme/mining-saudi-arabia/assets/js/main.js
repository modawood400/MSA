// Form endpoints come from WordPress (wp_localize_script → window.MSA).
const LEAD_ENDPOINT = (window.MSA && MSA.lead) || "";
const NEWSLETTER_ENDPOINT = (window.MSA && MSA.subscribe) || "";

const AR = {
  "skip":"انتقل إلى المحتوى","ticker":"الأحدث",
  "nav.articles":"المقالات","nav.magazine":"المجلة","nav.leaders":"Mining Leaders","nav.events":"الفعاليات","nav.newsletter":"النشرة البريدية","nav.advertise":"أعلن معنا",
  "cta.subscribe":"اشترك","cta.kit":"اطلب ملف الوسائط","cta.meeting":"احجز اجتماعًا تسويقيًا",
  "tag.top":"القصة الرئيسية","byline":"فريق محتوى MSA","art.latest":"أحدث المقالات",
  "tag.markets":"الأسواق","news.eyebrow":"غرفة الأخبار","art.sub":"أخبار وتحليلات قطاع التعدين في المملكة العربية السعودية.","art.read":"اقرأ المزيد","tag.tech":"التقنية","tag.infra":"البنية التحتية","tag.analysis":"تحليل","tag.guide":"دليل","tag.exploration":"الاستكشاف",
  "art.strip":"<b>Mining Saudi Arabia</b> تغطي قطاع التعدين في المملكة يوميًا — المشاريع والاستكشاف والصفقات والنتائج والأشخاص الذين يقفون وراءها.",
  "art.all":"كل المقالات",
  "mag.badge":"جديد","mag.eyebrow":"المجلة","mag.h":"<span>مجلتنا</span>","mag.kicker":"إصدار فصلي · Mining Saudi Arabia",
  "mag.p":"مجلة Mining Saudi Arabia تتجاوز الأخبار اليومية: تغطية معمّقة للقطاع، ورؤى القيادات التنفيذية، والتحولات الاستراتيجية التي تشكّل قطاع التعدين في المملكة — عدد كل ربع سنة.",
  "mag.f1":"تغطية معمّقة للقطاع","mag.f2":"رؤى ومقابلات مع القيادات التنفيذية","mag.f3":"الفرص والمشاريع في أنحاء المملكة",
  "mag.cta":"اقرأ أحدث عدد","mag.prev":"عدد سابق","mag.latest":"أحدث عدد","mag.all":"كل الأعداد",
  "ml.h":"حوارات مع <span>من يبنون القطاع</span>",
  "ml.p":"Mining Leaders هي سلسلة مقابلات الفيديو الخاصة بنا مع الرؤساء التنفيذيين والقيادات وراء المشاريع التي تشكّل التعدين في السعودية وخارجها.",
  "ml.now":"أحدث حلقة","ml.watchnow":"شاهد الآن","ml.by":"إنتاج","ml.card.ep":"الحلقة 01","ml.m.guest":"الشركة","ml.subscribe":"اشترك","ml.m.ep":"الحلقة","ml.m.rel":"تاريخ النشر","ml.m.fmt":"النوع","ml.m.fmtv":"مقابلة فيديو","ml.m.series":"السلسلة","ml.share":"شارك","ml.copied":"تم نسخ الرابط","ml.watch":"شاهد على YouTube","ml.sub":"اشترك في القناة",
  "ev.eyebrow":"على أرض الحدث","ev.h":"تغطية <span>الفعاليات</span>",
  "ev.p":"يغطي فريقنا أهم فعاليات القطاع حضوريًا — مقابلات في الموقع، ومحتوى يومي، والحوارات التي تصنع الفارق.",
  "ev.s1":"فعاليات كبرى غطّيناها في 2026","ev.s3":"مقابلة ميدانية معروضة هنا","ev.ivs":"مقابلات",
  "ev.pdac.loc":"تورنتو، كندا · 1–4 مارس",
  "ev.pdac.p":"في أكبر مؤتمر لاستكشاف المعادن في العالم، التقينا بالشركات والتقنيات والمستثمرين الذين يربطون التعدين العالمي بالسعودية.",
  "iv.fmf1.n":"سليمان العثيم","iv.fmf1.r":"الرئيس التنفيذي لشركة Saudi Gold Refinery (SGR)",
  "iv.fmf2.n":"الشيخ عبدالعزيز بن لعبون","iv.fmf2.r":"جيولوجي سعودي أول، الجمعية التعاونية للجيولوجيين السعوديين",
  "iv.fmf3.n":"هند صديق حامد","iv.fmf3.r":"وكيل وزارة المعادن، السودان",
  "iv.fmf4.n":"أحمد هارون","iv.fmf4.r":"مدير الهيئة العامة للأبحاث الجيولوجية، السودان",
  "iv.emf1.n":"م. عبدالله محمد القضيبي","iv.emf1.r":"الرئيس التنفيذي لشركة ويكو لخدمات التعدين",
  "iv.emf2.n":"محمد القحطاني","iv.emf2.r":"الشركة العربية للجيوفيزياء والمساحة (ARGAS)",
  "ev.all":"كل المقابلات",
  "ev.emf.loc":"العاصمة الإدارية الجديدة، مصر","ev.emf.h":"منتدى مصر للتعدين 2026",
  "ev.emf.p":"28–29 سبتمبر 2026 في فندق سانت ريجيس العاصمة الجديدة. أجرينا مقابلات مع المستكشفين وشركات علوم الأرض والمستثمرين في الموقع.",
  "ev.partner":"الشريك الإعلامي الرسمي","ev.geo.loc":"أوزبكستان · الشريك الإعلامي الرسمي",
  "ev.geo.p":"بصفتنا الشريك الإعلامي الرسمي لهذا المؤتمر الدولي لعلوم الأرض واستكشاف المعادن، تحدثنا مع قيادات من القطاع والحكومة والبحث العلمي.",
  "ev.fmf.loc":"الرياض، المملكة العربية السعودية","ev.fmf.h":"مؤتمر التعدين الدولي 2026",
  "ev.fmf.p":"في أبرز تجمّع للتعدين في المملكة بالرياض، حاورنا قيادات حكومية وشركات سعودية وجيولوجيين من أنحاء المنطقة.",
  "nl.eyebrow":"النشرة الأسبوعية","nl.h":"التعدين السعودي في بريدك كل أسبوع",
  "nl.p":"تجمع نشرة Saudi Mining Weekly أهم المشاريع والتمويلات والاكتشافات والصفقات التي حرّكت القطاع — في قراءة واحدة قصيرة.",
  "nl.subs":"مشترك يقرؤونها بالفعل","nl.label":"البريد الإلكتروني","nl.free":"مجانية. يمكنك إلغاء الاشتراك في أي وقت.",
  "nl.recent":"أحدث الأعداد","nl.archive":"أرشيف النشرة",
  "reach.h":"حجم الوصول","reach.title":"حجم <span>الوصول</span>","nl.title":"النشرة <span>الأسبوعية</span>","nl.subs2":"مشترك","nl.f1":"كل أسبوع","nl.f2":"مجانية","nl.f3":"إلغاء الاشتراك في أي وقت","adv.title":"اعمل <span>معنا</span>","aud.title":"من تصل إليهم","ct.title":"لنتحدث <span>معًا</span>","ct.b3":"اجتماع تسويقي في الوقت المناسب لك","reach.1":"انطباع خلال 12 شهرًا","reach.2":"متخصص تم الوصول إليهم","reach.3":"مشترك في النشرة البريدية","reach.4":"زائر شهري للموقع",
  "adv.eyebrow":"اعمل معنا","adv.h":"اجعل شركتك جزءًا من القصة",
  "adv.p":"المقالات والمجلة والمقابلات وتغطية الفعاليات والنشرة التي يتابعها القطاع متاحة للشركات التي تدخل قطاع التعدين السعودي أو تنمو فيه.",
  "adv.s1":"مقالات مميزة","adv.s1d":"قصص ومقالات مميزة عن شركتك ومشاريعك وتقنياتك.",
  "adv.s2":"الظهور في المجلة","adv.s2d":"حضور في مجلة Mining Saudi Arabia الفصلية.",
  "adv.s3":"المقابلات والفيديو","adv.s3d":"مقابلات مع القيادات وخلال الفعاليات وعروض للتقنيات — تتحول إلى مقال ومقاطع ومحتوى للنشرة.",
  "adv.s4":"تغطية الفعاليات","adv.s4d":"ترويج قبل الحدث، ومقابلات في الموقع، ومحتوى يومي، ومقال بعد الحدث.",
  "adv.s5":"النشرة والبريد","adv.s5d":"رعاية النشرة البريدية وحملات بريدية لمشتركينا.",
  "adv.s6":"LinkedIn والتواصل","adv.s6d":"الظهور على LinkedIn وترويج المحتوى وإدارة منصات التواصل.",
  "adv.s7":"دليل الشركات","adv.s7d":"ملفات موثّقة وظهور مميز في الدليل.",
  "adv.s8":"حملات دخول السوق","adv.s8d":"التموضع والمحتوى واستهداف الحسابات ودعم توليد العملاء في السوق السعودي.",
  "aud.1":"مشغلو التعدين وأصحاب التراخيص","aud.2":"شركات التعدين والاستكشاف الدولية","aud.3":"الجهات الحكومية والمستثمرون والصناديق","aud.4":"مزودو التقنية والحفر والمعدات","aud.5":"الجيولوجيون والمهندسون والمديرون",
  "ct.h":"اطلب ملف الوسائط أو احجز اجتماعًا تسويقيًا",
  "ct.p":"أخبرنا عن شركتك وأهدافك، وسنرسل لك ملف الوسائط أو نحدد اجتماعًا لتخطيط المزيج المناسب.",
  "ct.b1":"تفاصيل الجمهور والوصول والقنوات","ct.b2":"خيارات مبنية حول هدفك في السوق السعودي",
  "f.name":"الاسم","f.email":"البريد الإلكتروني","f.company":"الشركة","f.service":"الخدمة المطلوبة","f.select":"اختر خدمة","f.unsure":"لم أحدد بعد",
  "f.goal":"الهدف","f.details":"تفاصيل إضافية","f.submit":"إرسال الطلب",
  "g.1":"دخول السوق","g.2":"رفع الوعي بالعلامة","g.3":"الوصول إلى صناع القرار","g.4":"توليد العملاء المحتملين","g.5":"الترويج لفعالية","g.6":"الظهور التنفيذي",
  "ft.read":"اقرأ وشاهد","ft.company":"الشركة","ft.about":"من نحن","ft.dir":"دليل الشركات","ft.privacy":"سياسة الخصوصية","ft.terms":"الشروط والأحكام","ft.work":"اعمل معنا",
  "msg.required":"يرجى إدخال الاسم والبريد الإلكتروني واسم الشركة.","msg.email":"يرجى إدخال بريد إلكتروني صحيح.",
  "msg.ok":"شكرًا لك. تم استلام طلبك وسنتواصل معك قريبًا.","msg.nlok":"تم الاشتراك. ستصلك النشرة القادمة.",
  "side.justin":"وصل حديثًا","side.new":"جديد","side.t.article":"مقال","side.t.newsletter":"نشرة","side.t.magazine":"مجلة","side.home":"الرئيسية","side.news":"آخر الأخبار","side.article":"المقالات","side.events":"الفعاليات والندوات","side.dir":"الدليل","side.browse":"تصفح دليل الشركات","side.list":"أضف شركتك","side.about":"عن MSA","side.contact":"تواصل معنا",
  "msg.err":"تعذّر الإرسال. يرجى المحاولة مرة أخرى.","art.more":"عرض المزيد","art.back":"العودة إلى الرئيسية","art.related":"اقرأ أيضًا","art.none":"لا يوجد محتوى بعد.","art.notfound":"الصفحة غير موجودة","art.search":"بحث","msg.noendpoint":"النموذج غير مربوط بعد. (للمطوّر: عيّن عنوان الإرسال في السكربت)"
};
const EN_MSG = {
  "msg.required":"Please enter your name, email and company.","msg.email":"Please enter a valid email address.",
  "msg.ok":"Thank you. Your request has been received and we’ll be in touch shortly.","msg.nlok":"You’re subscribed. Look out for the next issue.",
  "msg.err":"That couldn’t be sent. Please try again.","msg.noendpoint":"This form isn’t connected yet. (Developer: set the endpoint in the script.)"
};

// English-only editorial text (headlines, excerpts, captions) keeps its own direction in Arabic mode
document.querySelectorAll('.acard h1, .acard h3, .acard .ex, .nl-issue h3, .post-head h1, .post-head .ex, .entry, .arch-head h1, .ml-info .role, .iv figcaption:not([lang])')
  .forEach(el => el.dir = 'auto');

const nodes = [...document.querySelectorAll('[data-i18n]')];
nodes.forEach(n => n.dataset.en = n.innerHTML);
let lang = 'en';
const t = k => lang === 'ar' ? (AR[k] || EN_MSG[k]) : EN_MSG[k];
function setLang(l){
  lang = l;
  document.documentElement.lang = l;
  document.documentElement.dir = l === 'ar' ? 'rtl' : 'ltr';
  nodes.forEach(n => { n.innerHTML = l === 'ar' && AR[n.dataset.i18n] ? AR[n.dataset.i18n] : n.dataset.en; });
  document.querySelectorAll('.lang button').forEach(b => b.setAttribute('aria-pressed', b.dataset.lang === l));
  try { localStorage.setItem('msa-lang', l); } catch(e){}
}
document.querySelectorAll('.lang button').forEach(b => b.addEventListener('click', () => setLang(b.dataset.lang)));
try { if (localStorage.getItem('msa-lang') === 'ar') setLang('ar'); } catch(e){}
const qp = new URLSearchParams(location.search).get('lang');
if (qp === 'ar' || qp === 'en') setLang(qp);

// Side drawer (menu button): "just in" feed + full site menu
const nav = document.getElementById('nav'), menuBtn = document.getElementById('menuBtn');
const drawer = document.getElementById('sideDrawer'), scrim = document.getElementById('sideScrim');
function setDrawer(open) {
  if (!drawer) return;
  drawer.classList.toggle('open', open);
  drawer.toggleAttribute('inert', !open);
  drawer.setAttribute('aria-hidden', !open);
  menuBtn.setAttribute('aria-expanded', open);
  document.body.classList.toggle('side-lock', open);
  if (open) { scrim.hidden = false; requestAnimationFrame(() => scrim.classList.add('on')); drawer.querySelector('a, button').focus({ preventScroll: true }); }
  else { scrim.classList.remove('on'); setTimeout(() => { if (!drawer.classList.contains('open')) scrim.hidden = true; }, 300); }
}
menuBtn.addEventListener('click', () => setDrawer(!drawer.classList.contains('open')));
if (drawer) {
  scrim.addEventListener('click', () => setDrawer(false));
  document.getElementById('sideClose').addEventListener('click', () => { setDrawer(false); menuBtn.focus(); });
  drawer.querySelectorAll('a').forEach(a => a.addEventListener('click', () => setDrawer(false)));
  addEventListener('keydown', e => { if (e.key === 'Escape' && drawer.classList.contains('open')) { setDrawer(false); menuBtn.focus(); } });
}

// Header: sliding gold indicator under the hovered / current nav link
const navInd = document.getElementById('navInd');
function indTo(a) {
  if (!a) { navInd.style.opacity = 0; return; }
  navInd.style.width = a.offsetWidth - 24 + 'px';
  navInd.style.transform = `translateX(${a.offsetLeft + 12}px)`;
  navInd.style.opacity = 1;
}
const indToActive = () => indTo(nav.querySelector('a.on'));
nav.querySelectorAll('a').forEach(a => a.addEventListener('mouseenter', () => indTo(a)));
nav.addEventListener('mouseleave', indToActive);
addEventListener('resize', indToActive);
document.querySelectorAll('.lang button').forEach(b => b.addEventListener('click', () => requestAnimationFrame(indToActive)));

// Header: floating glass bar after scrolling + reading progress
const siteHeader = document.getElementById('siteHeader'), scrollProg = document.getElementById('scrollProg');
let hdTick = false;
function onScroll() {
  hdTick = false;
  siteHeader.classList.toggle('scrolled', scrollY > 60);
  const max = document.documentElement.scrollHeight - innerHeight;
  scrollProg.style.setProperty('--p', max > 0 ? Math.min(1, scrollY / max) : 0);
}
addEventListener('scroll', () => { if (!hdTick) { hdTick = true; requestAnimationFrame(onScroll); } }, { passive: true });
onScroll();

// Highlight current section in nav
const links = [...nav.querySelectorAll('a')];
const io = new IntersectionObserver(es => es.forEach(e => {
  if (e.isIntersecting) { links.forEach(a => a.classList.toggle('on', a.getAttribute('href') === '#' + e.target.id)); indToActive(); }
}), { rootMargin: '-45% 0px -50% 0px' });
links.forEach(a => { const h = a.getAttribute('href'); const s = h.startsWith('#') && document.querySelector(h); if (s) io.observe(s); });

// Magazine: fan the covers out once the stage scrolls into view
const magStage = document.getElementById('magStage');
if (magStage) new IntersectionObserver((es, o) => es.forEach(e => { if (e.isIntersecting) { magStage.classList.add('in'); o.disconnect(); } }), { threshold: .3 }).observe(magStage);
// Hovering an issue in the list brings its cover forward
document.querySelectorAll('.mag-issues a').forEach(a => {
  const c = magStage.querySelector('.' + a.dataset.cover); if (!c) return;
  const on = v => { a.classList.toggle('on', v); c.classList.toggle('on', v); };
  a.addEventListener('mouseenter', () => on(true)); a.addEventListener('mouseleave', () => on(false));
  a.addEventListener('focus', () => on(true)); a.addEventListener('blur', () => on(false));
  c.addEventListener('mouseenter', () => a.classList.add('on')); c.addEventListener('mouseleave', () => a.classList.remove('on'));
});

// Articles backdrop: a geological survey map. Contour lines of a slowly moving noise field
// (marching squares) plus a few pulsing drill-site markers. Paused off-screen; static for reduced motion.
(() => {
  const cv = document.getElementById('topoFx'); if (!cv) return;
  const ctx = cv.getContext('2d');
  const still = matchMedia('(prefers-reduced-motion: reduce)').matches;
  // smooth value noise
  const perm = new Uint8Array(512), grad = new Float32Array(256);
  for (let i = 0; i < 256; i++) { perm[i] = i; grad[i] = Math.random(); }
  for (let i = 255; i > 0; i--) { const j = Math.random() * (i + 1) | 0; [perm[i], perm[j]] = [perm[j], perm[i]]; }
  for (let i = 0; i < 256; i++) perm[i + 256] = perm[i];
  const sm = t => t * t * (3 - 2 * t);
  const v = (x, y) => grad[perm[(x & 255) + perm[y & 255]]];
  function noise(x, y) {
    const xi = Math.floor(x), yi = Math.floor(y), xf = x - xi, yf = y - yi, u = sm(xf), w = sm(yf);
    const a = v(xi, yi), b = v(xi + 1, yi), c = v(xi, yi + 1), d = v(xi + 1, yi + 1);
    return a + (b - a) * u + (c - a) * w + (a - b - c + d) * u * w;
  }
  const field = (x, y, t) => noise(x * .9 + t * .05, y * .9 - t * .03) * .65 + noise(x * 2.1 - t * .04, y * 2.1 + t * .06) * .35;
  const CELL = 14, LEVELS = 14;
  let W = 0, H = 0, cols = 0, rows = 0, vals, sites = [], run = false;
  function size() {
    const dpr = Math.min(devicePixelRatio || 1, 2);
    W = cv.clientWidth; H = cv.clientHeight;
    cv.width = W * dpr; cv.height = H * dpr; ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    cols = Math.ceil(W / CELL) + 1; rows = Math.ceil(H / CELL) + 1; vals = new Float32Array(cols * rows);
    sites = Array.from({ length: Math.max(3, Math.round(W / 320)) }, () => ({ x: Math.random() * W, y: Math.random() * H, ph: Math.random() * 6.28 }));
  }
  function draw(t) {
    ctx.clearRect(0, 0, W, H);
    const sc = 1 / 260;
    for (let j = 0; j < rows; j++) for (let i = 0; i < cols; i++) vals[j * cols + i] = field(i * CELL * sc, j * CELL * sc, t);
    for (let l = 1; l < LEVELS; l++) {
      const iso = l / LEVELS, major = l % 4 === 0;
      ctx.beginPath();
      for (let j = 0; j < rows - 1; j++) for (let i = 0; i < cols - 1; i++) {
        const a = vals[j * cols + i], b = vals[j * cols + i + 1], c = vals[(j + 1) * cols + i + 1], d = vals[(j + 1) * cols + i];
        const k = (a > iso) | (b > iso) << 1 | (c > iso) << 2 | (d > iso) << 3;
        if (k === 0 || k === 15) continue;
        const x = i * CELL, y = j * CELL, f = (p, q) => (iso - p) / (q - p);
        const T = [x + CELL * f(a, b), y], R = [x + CELL, y + CELL * f(b, c)], B = [x + CELL * f(d, c), y + CELL], L = [x, y + CELL * f(a, d)];
        const seg = (p, q) => { ctx.moveTo(p[0], p[1]); ctx.lineTo(q[0], q[1]); };
        switch (k) {
          case 1: case 14: seg(L, T); break; case 2: case 13: seg(T, R); break;
          case 3: case 12: seg(L, R); break; case 4: case 11: seg(R, B); break;
          case 6: case 9: seg(T, B); break; case 7: case 8: seg(L, B); break;
          case 5: seg(L, T); seg(R, B); break; case 10: seg(T, R); seg(L, B); break;
        }
      }
      ctx.strokeStyle = major ? 'rgba(154,116,40,.42)' : 'rgba(120,100,70,.17)';
      ctx.lineWidth = major ? 1.3 : .8; ctx.stroke();
    }
    // drill-site markers
    for (const s of sites) {
      const p = (Math.sin(t * 1.4 + s.ph) + 1) / 2;
      ctx.strokeStyle = `rgba(154,116,40,${.25 + .35 * (1 - p)})`; ctx.lineWidth = 1;
      ctx.beginPath(); ctx.arc(s.x, s.y, 6 + p * 16, 0, 6.29); ctx.stroke();
      ctx.fillStyle = 'rgba(176,132,48,.9)'; ctx.beginPath(); ctx.arc(s.x, s.y, 3, 0, 6.29); ctx.fill();
      ctx.strokeStyle = 'rgba(154,116,40,.5)'; ctx.beginPath();
      ctx.moveTo(s.x - 10, s.y); ctx.lineTo(s.x - 5, s.y); ctx.moveTo(s.x + 5, s.y); ctx.lineTo(s.x + 10, s.y);
      ctx.moveTo(s.x, s.y - 10); ctx.lineTo(s.x, s.y - 5); ctx.moveTo(s.x, s.y + 5); ctx.lineTo(s.x, s.y + 10); ctx.stroke();
    }
  }
  let last = 0;
  function loop(now) {
    if (!run) return;
    if (now - last > 33) { last = now; draw(now / 1000); }   // ~30fps is plenty for slow drift
    requestAnimationFrame(loop);
  }
  size(); draw(0);
  new ResizeObserver(() => { size(); draw(performance.now() / 1000); }).observe(cv);
  if (still) return;
  new IntersectionObserver(es => es.forEach(e => {
    if (e.isIntersecting && !run) { run = true; requestAnimationFrame(loop); }
    else if (!e.isIntersecting) run = false;
  })).observe(cv);
})();

// Lite YouTube: load the player only when clicked
document.querySelectorAll('button.yt').forEach(b => b.addEventListener('click', () => {
  const f = document.createElement('iframe');
  f.src = `https://www.youtube-nocookie.com/embed/${b.dataset.id}?autoplay=1&rel=0`;
  f.title = b.getAttribute('aria-label');
  f.allow = 'accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture';
  f.allowFullscreen = true;
  b.replaceChildren(f);
}, { once: true }));

// CTAs preselect request type
const form = document.getElementById('leadForm');
document.querySelectorAll('[data-goto]').forEach(a => a.addEventListener('click', () => {
  if (!form) return;
  form.requestType.value = a.dataset.goto === 'kit' ? 'media-kit' : 'meeting';
  if (a.dataset.svc) form.service.value = a.dataset.svc;
}));

// "Watch now" starts the matching lite player
document.querySelectorAll('[data-play]').forEach(b => b.addEventListener('click', () => {
  const p = document.getElementById(b.dataset.play);
  if (!p) return;
  p.click(); p.scrollIntoView({ behavior: 'smooth', block: 'center' });
}));

// Mining Leaders: copy episode link
const mlCopy = document.getElementById('mlCopy');
if (mlCopy) mlCopy.addEventListener('click', async () => {
  try { await navigator.clipboard.writeText(mlCopy.dataset.url); } catch (e) { return; }
  const m = document.getElementById('mlCopied'); m.hidden = false; setTimeout(() => m.hidden = true, 1800);
});

// Count-up numbers (reach + newsletter)
const counters = document.querySelectorAll('.count');
const runCount = el => {
  const end = +el.dataset.count, suf = el.dataset.suffix || '';
  if (matchMedia('(prefers-reduced-motion: reduce)').matches) { el.textContent = end + suf; return; }
  const t0 = performance.now(), dur = 1400;
  const step = now => { const k = Math.min(1, (now - t0) / dur), e = 1 - (1 - k) ** 3;
    el.textContent = Math.round(end * e) + suf; if (k < 1) requestAnimationFrame(step); };
  requestAnimationFrame(step);
};
const cio = new IntersectionObserver((es, o) => es.forEach(e => { if (e.isIntersecting) { runCount(e.target); o.unobserve(e.target); } }), { threshold: .5 });
counters.forEach(c => cio.observe(c));

// Scroll-reveal
const rv = new IntersectionObserver((es, o) => es.forEach(e => { if (e.isIntersecting) { e.target.classList.add('on'); o.unobserve(e.target); } }), { threshold: .15 });
document.querySelectorAll('.reveal').forEach(el => rv.observe(el));

async function post(url, data){
  const r = await fetch(url, { method:'POST', headers:{'Content-Type':'application/json','Accept':'application/json'}, body: JSON.stringify(data) });
  if (!r.ok) throw new Error(r.status);
}
const emailOk = v => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v);
function show(el, cls, key){ el.className = 'form-msg ' + cls; el.textContent = t(key); }

// Lead form
const msg = document.getElementById('formMsg');
if (form) form.addEventListener('submit', async e => {
  e.preventDefault();
  const d = new FormData(form);
  const data = { requestType:d.get('requestType'), name:d.get('name').trim(), email:d.get('email').trim(), company:d.get('company').trim(),
    service:d.get('service'), goals:d.getAll('goals'), details:d.get('details').trim(), lang, website:d.get('website') || '' };
  if (!data.name || !data.email || !data.company) return show(msg, 'err', 'msg.required');
  if (!emailOk(data.email)) return show(msg, 'err', 'msg.email');
  if (!LEAD_ENDPOINT) return show(msg, 'err', 'msg.noendpoint');
  const btn = form.querySelector('[type=submit]'); btn.disabled = true;
  try { await post(LEAD_ENDPOINT, data); form.reset(); show(msg, 'ok', 'msg.ok'); }
  catch { show(msg, 'err', 'msg.err'); }
  finally { btn.disabled = false; }
});

// Newsletter form
const nlForm = document.getElementById('nlForm'), nlMsg = document.getElementById('nlMsg');
if (nlForm) nlForm.addEventListener('submit', async e => {
  e.preventDefault();
  const email = nlForm.email.value.trim();
  if (!emailOk(email)) return show(nlMsg, 'err', 'msg.email');
  if (!NEWSLETTER_ENDPOINT) return show(nlMsg, 'err', 'msg.noendpoint');
  try { await post(NEWSLETTER_ENDPOINT, { email, lang, website: nlForm.website ? nlForm.website.value : '' }); nlForm.reset(); show(nlMsg, 'ok', 'msg.nlok'); }
  catch { show(nlMsg, 'err', 'msg.err'); }
});

