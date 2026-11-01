<?php
/**
 * Site footer.
 *
 * @package msa
 */

?>
</main>

<footer>
  <div class="wrap">
    <div class="foot">
      <div>
        <img src="<?php echo esc_url( msa_logo_url() ); ?>" alt="Mining Saudi Arabia" width="152" height="40" loading="lazy">
        <p style="color:#fff;font-weight:600">Mining Saudi Arabia</p>
        <p>Operated by Mining News Company Limited</p>
        <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>">MiningSaudiArabia.com</a></p>
      </div>
      <div>
        <h4 data-i18n="ft.read">Read &amp; watch</h4>
        <ul>
          <li><a href="<?php echo esc_url( msa_archive_url( 'article' ) ); ?>" data-i18n="nav.articles">Articles</a></li>
          <li><a href="<?php echo esc_url( msa_archive_url( 'magazine' ) ); ?>" data-i18n="nav.magazine">Magazine</a></li>
          <li><a href="https://www.youtube.com/@miningSaudiArabia" target="_blank" rel="noopener">Mining Leaders</a></li>
          <li><a href="<?php echo esc_url( msa_section_url( 'events' ) ); ?>" data-i18n="nav.events">Events</a></li>
          <li><a href="<?php echo esc_url( msa_archive_url( 'newsletter' ) ); ?>" data-i18n="nav.newsletter">Newsletter</a></li>
        </ul>
      </div>
      <div>
        <h4 data-i18n="ft.company">Company</h4>
        <?php
        if ( has_nav_menu( 'footer' ) ) {
            wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false, 'depth' => 1 ) );
        } else {
            ?>
        <ul>
          <li><a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>" data-i18n="ft.about">About</a></li>
          <li><a href="<?php echo esc_url( home_url( '/browse-company-directory/' ) ); ?>" data-i18n="ft.dir">Company directory</a></li>
          <li><a href="<?php echo esc_url( get_privacy_policy_url() ? get_privacy_policy_url() : home_url( '/privacy-policy/' ) ); ?>" data-i18n="ft.privacy">Privacy policy</a></li>
          <li><a href="<?php echo esc_url( home_url( '/terms-conditions/' ) ); ?>" data-i18n="ft.terms">Terms &amp; conditions</a></li>
        </ul>
            <?php
        }
        ?>
      </div>
      <div>
        <h4 data-i18n="ft.work">Work with us</h4>
        <div style="display:flex;flex-direction:column;gap:10px;align-items:flex-start">
          <a href="<?php echo esc_url( msa_section_url( 'contact' ) ); ?>" class="btn btn-gold btn-sm" data-goto="kit" data-i18n="cta.kit">Request the Media Kit</a>
          <a href="<?php echo esc_url( msa_section_url( 'contact' ) ); ?>" class="btn btn-ghost btn-sm" data-goto="meeting" data-i18n="cta.meeting">Book a Marketing Meeting</a>
        </div>
      </div>
    </div>
    <div class="copy"><span>© <?php echo esc_html( gmdate( 'Y' ) ); ?> Mining News Company Limited</span><span>MiningSaudiArabia.com</span></div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
