<footer class="site-footer">
  <div class="container">
    <div class="footer-inner">

      <div class="footer-col">
        <h4>PROSERVISEXPRES</h4>
        <p>Rychlá a spolehlivá oprava domácích spotřebičů v Brně a okolí.</p>
      </div>

      <div class="footer-col">
        <h4>Kontakt</h4>
        <p>
          <a href="<?php echo esc_url(proservis_phone_link()); ?>">
            <i class="fas fa-phone"></i> <?php echo esc_html(proservis_phone()); ?>
          </a>
        </p>
        <p>
          <a href="mailto:<?php echo esc_html(get_theme_mod('proservis_email', 'servis@proservisexpres.cz')); ?>">
            <i class="fas fa-envelope"></i>
            <?php echo esc_html(get_theme_mod('proservis_email', 'servis@proservisexpres.cz')); ?>
          </a>
        </p>
        <p><i class="fas fa-map-marker-alt"></i> Brno a okolí</p>
      </div>

      <div class="footer-col">
        <h4>Navigace</h4>
        <?php wp_nav_menu([
          'theme_location' => 'footer',
          'container'      => false,
          'fallback_cb'    => function() {
            echo '<ul>';
            echo '<li><a href="#o-nas">O nás</a></li>';
            echo '<li><a href="#sluzby">Služby a ceny</a></li>';
            echo '<li><a href="#objednavka">Objednávka</a></li>';
            echo '<li><a href="#znacky">Značky</a></li>';
            echo '</ul>';
          },
        ]); ?>
      </div>

      <div class="footer-col">
        <h4>&nbsp;</h4>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
      </div>

    </div>
	<div class="custom-footer-header" style="text-align: center; padding: 20px 0;">
		<h2 style="margin: 0; font-family: sans-serif; color: #333; font-size: 24px;">
			ICO 21946043
		</h2>
	</div>

    <div class="footer-bottom">
      <p>&copy; <?php echo date('Y'); ?> ProservisExpres. Všechna práva vyhrazena.</p>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
