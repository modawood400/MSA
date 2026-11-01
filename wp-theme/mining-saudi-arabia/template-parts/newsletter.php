<?php
/**
 * 5. Weekly newsletter: sign-up form and the four latest issues.
 *
 * @package msa
 */

$issues = msa_latest( 'newsletter', 4 );
?>
<!-- 5. NEWSLETTER -->
<section id="newsletter" class="nl-sec" aria-labelledby="nlH">
  <div class="wrap nl-grid">
    <div class="nl-left reveal">
      <h2 class="big-title" id="nlH" data-i18n="nl.title">Weekly <span>Newsletter</span></h2>
      <p class="nl-lead" data-i18n="nl.p">The Saudi Mining Weekly rounds up the projects, funding, discoveries and deals that moved the sector — in one short read.</p>
      <div class="nl-stat">
        <span class="nl-stat-ic"><svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m2 7 10 6 10-6"/></svg></span>
        <div><b class="count" data-count="14" data-suffix="K+">14K+</b><span data-i18n="nl.subs2">subscribers</span></div>
      </div>
      <ul class="nl-feats">
        <li><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="17" rx="2"/><path d="M3 9h18M8 2v4M16 2v4"/></svg><span data-i18n="nl.f1">Every week</span></li>
        <li><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.6 13.4 13.4 20.6a2 2 0 0 1-2.8 0L3 13V3h10l7.6 7.6a2 2 0 0 1 0 2.8z"/><circle cx="7.5" cy="7.5" r="1.5"/></svg><span data-i18n="nl.f2">Free</span></li>
        <li><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="m9 9 6 6M15 9l-6 6"/></svg><span data-i18n="nl.f3">Unsubscribe anytime</span></li>
      </ul>
      <form id="nlForm" class="nl-form" novalidate>
        <label for="nl-email" class="sr-only" data-i18n="nl.label">Email address</label>
        <span class="nl-in-ic"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m2 7 10 6 10-6"/></svg></span>
        <input class="hp" name="website" tabindex="-1" autocomplete="off" aria-hidden="true">
        <input id="nl-email" name="email" type="email" autocomplete="email" placeholder="you@company.com" required>
        <button class="btn btn-gold" type="submit"><span data-i18n="cta.subscribe">Subscribe</span><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2 11 13M22 2l-7 20-4-9-9-4z"/></svg></button>
      </form>
      <div class="form-msg" id="nlMsg" role="status" aria-live="polite"></div>
    </div>
    <?php if ( $issues ) : ?>
    <div class="nl-right reveal d1">
      <div class="nl-right-head">
        <h3 data-i18n="nl.recent">Recent issues</h3>
        <a class="nl-archive" href="<?php echo esc_url( msa_archive_url( 'newsletter' ) ); ?>"><span data-i18n="nl.archive">Newsletter archive</span><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
      </div>
      <div class="nl-issues">
        <?php foreach ( $issues as $p ) : ?>
          <a class="nl-issue" href="<?php echo esc_url( get_permalink( $p ) ); ?>">
            <div class="th"><?php echo get_the_post_thumbnail( $p, 'medium_large', array( 'alt' => '', 'loading' => 'lazy' ) ); ?></div>
            <div class="bd"><time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d', $p ) ); ?>"><?php echo esc_html( get_the_date( 'M j, Y', $p ) ); ?></time><h3><?php echo esc_html( get_the_title( $p ) ); ?></h3></div>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>
  </div>
</section>
