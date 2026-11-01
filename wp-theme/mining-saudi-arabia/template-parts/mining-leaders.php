<?php
/**
 * 3. Mining Leaders: the featured episode (Customizer → Mining Saudi Arabia → Mining Leaders episode).
 *
 * @package msa
 */

$ep = msa_episode();
if ( ! $ep['id'] ) {
	return;
}
$yt   = 'https://www.youtube.com/watch?v=' . $ep['id'];
$enc  = rawurlencode( $yt );
$time = strtotime( $ep['date'] );
?>
<!-- 3. MINING LEADERS -->
<section id="mining-leaders" aria-labelledby="mlH">
  <div class="wrap">
    <div class="ml-banner reveal">
      <img class="ml-logo" src="<?php echo esc_url( msa_asset( 'logos/mining-leaders-light@2x.png' ) ); ?>" alt="Mining Leaders" width="224" height="100">
      <h2 id="mlH" data-i18n="ml.h">Conversations with the <span>people building the sector</span></h2>
    </div>

    <div class="ml-feature reveal d1">
      <div class="ml-info">
        <div class="ml-id">
        <span class="ml-ep"><b><?php echo esc_html( $ep['ep'] ); ?></b><span data-i18n="ml.now">Latest episode</span></span>
        <div class="ml-guest">
          <div>
            <h3><?php echo esc_html( $ep['guest'] ); ?></h3>
            <p class="role"><?php echo esc_html( $ep['role'] ); ?></p>
          </div>
        </div>
        </div>
        <ul class="ml-facts">
          <?php if ( $time ) : ?>
          <li><span data-i18n="ml.m.rel">Released</span><b><time datetime="<?php echo esc_attr( gmdate( 'Y-m-d', $time ) ); ?>"><?php echo esc_html( gmdate( 'M j, Y', $time ) ); ?></time></b></li>
          <?php endif; ?>
          <li><span data-i18n="ml.m.fmt">Format</span><b data-i18n="ml.m.fmtv">Video interview</b></li>
          <?php if ( $ep['company'] ) : ?>
          <li><span data-i18n="ml.m.guest">Company</span><b><?php echo esc_html( $ep['company'] ); ?></b></li>
          <?php endif; ?>
          <li><span data-i18n="ml.m.series">Series</span><b>Mining Leaders</b></li>
        </ul>
        <div class="ml-cta">
        <div class="acts">
          <button class="btn btn-gold" type="button" data-play="mlPlayer"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg><span data-i18n="ml.watchnow">Watch now</span></button>
          <a class="btn btn-ghost" href="<?php echo esc_url( $yt ); ?>" target="_blank" rel="noopener" data-i18n="ml.watch">Watch on YouTube</a>
        </div>
        <div class="ml-share">
          <span data-i18n="ml.share">Share</span>
          <a href="<?php echo esc_url( 'https://www.linkedin.com/sharing/share-offsite/?url=' . $enc ); ?>" target="_blank" rel="noopener" aria-label="Share on LinkedIn"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M4.98 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5zM3 9h4v12H3zM9 9h3.8v1.7h.05c.53-1 1.83-2.05 3.77-2.05C20.6 8.65 21 11.2 21 14.4V21h-4v-5.8c0-1.4-.03-3.2-1.95-3.2-1.95 0-2.25 1.52-2.25 3.1V21H9z"/></svg></a>
          <a href="<?php echo esc_url( 'https://x.com/intent/post?url=' . $enc ); ?>" target="_blank" rel="noopener" aria-label="Share on X"><svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M18.2 2h3.4l-7.4 8.5L23 22h-6.8l-5.3-6.9L4.8 22H1.4l7.9-9L1 2h7l4.8 6.3zM17 20h1.9L7.1 4H5.1z"/></svg></a>
          <a href="<?php echo esc_url( 'https://wa.me/?text=' . $enc ); ?>" target="_blank" rel="noopener" aria-label="Share on WhatsApp"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5-1.3A10 10 0 1 0 12 2zm5.8 14.2c-.2.7-1.4 1.3-2 1.4-.5.1-1.2.1-1.9-.1a17 17 0 0 1-1.7-.6 13.4 13.4 0 0 1-5.1-4.5c-.4-.5-1-1.5-1-2.8s.7-2 1-2.3c.2-.3.5-.3.7-.3h.5c.2 0 .4 0 .6.5l.8 2c.1.2.1.4 0 .5l-.4.6-.3.4c-.1.1-.3.3-.1.6.2.3.7 1.2 1.6 2a7 7 0 0 0 2.2 1.4c.3.1.5.1.6-.1l.9-1c.2-.3.4-.2.6-.1l1.9.9c.3.1.4.2.5.3.1.2.1.8-.1 1.5z"/></svg></a>
          <button type="button" id="mlCopy" data-url="<?php echo esc_url( $yt ); ?>" aria-label="Copy link"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="12" height="12" rx="2"/><path d="M5 15V5a2 2 0 0 1 2-2h10"/></svg></button>
          <small id="mlCopied" data-i18n="ml.copied" hidden>Link copied</small>
        </div>
        </div>
        <div class="ml-by"><span data-i18n="ml.by">Produced by</span><img src="<?php echo esc_url( msa_logo_url() ); ?>" alt="Mining Saudi Arabia" width="98" height="26" loading="lazy"></div>
      </div>
      <button class="yt ml-player" id="mlPlayer" data-id="<?php echo esc_attr( $ep['id'] ); ?>" style="background-image:url('<?php echo esc_url( 'https://i.ytimg.com/vi/' . $ep['id'] . '/maxresdefault.jpg' ); ?>')" aria-label="<?php echo esc_attr( 'Play: Mining Leaders | ' . $ep['guest'] . ', ' . $ep['role'] ); ?>">
        <span class="ep"><?php echo esc_html( $ep['ep'] ); ?></span>
        <span class="play"><svg width="22" height="22" viewBox="0 0 24 24" fill="#fff"><path d="M8 5v14l11-7z"/></svg></span>
      </button>
    </div>
  </div>
</section>
