<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5PTRNJGG');</script>
<!-- End Google Tag Manager -->  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5PTRNJGG"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<header class="site-header">
  <div class="header-inner">

    <!-- Logo -->
    <div class="site-logo">
      <?php if (has_custom_logo()): ?>
        <?php the_custom_logo(); ?>
      <?php else: ?>
        <a href="<?php echo home_url('/'); ?>">
          <strong style="font-family:'Staatliches',cursive;font-size:28px;color:#04004A;letter-spacing:0.05em;">
            PROSERVIS<span style="color:#FFB204;">EXPRES</span>
          </strong>
        </a>
      <?php endif; ?>
    </div>

    <!-- Navigation -->
    <nav class="site-nav" id="site-nav" aria-label="Hlavní navigace">
      <?php wp_nav_menu([
        'theme_location' => 'primary',
        'menu_class'     => '',
        'container'      => false,
        'fallback_cb'    => function() {
          echo '<ul>';
          echo '<li><a href="#o-nas">O nás</a></li>';
          echo '<li><a href="#sluzby">Služby</a></li>';
          echo '<li><a href="#objednavka">Objednávka</a></li>';
          echo '<li><a href="#znacky">Značky</a></li>';
          echo '</ul>';
        },
      ]); ?>
    </nav>

    <!-- Phone CTA -->
    <div class="header-phone">
      <a href="<?php echo esc_url(proservis_phone_link()); ?>" class="btn btn-primary">
        <i class="fas fa-phone"></i>
        <?php echo esc_html(proservis_phone()); ?>
      </a>
    </div>

    <!-- Mobile toggle -->
    <button class="nav-toggle" id="nav-toggle" aria-label="Menu" aria-expanded="false">
      <span></span>
      <span></span>
      <span></span>
    </button>

  </div>
</header>
