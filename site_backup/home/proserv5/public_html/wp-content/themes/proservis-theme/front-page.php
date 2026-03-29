<?php get_header(); ?>

<!-- ============================================================
     HERO
     ============================================================ -->
<section class="hero" id="uvod">
  <div class="container">
    <div class="hero-content">
      <p class="hero-eyebrow">Brno a okolí · Rychle · Spolehlivě · Záručně</p>
      <h1 class="hero-title"><?php echo esc_html(get_theme_mod('proservis_hero_title', 'OPRAVA VŠECH ZNAČEK')); ?></h1>
      <p class="hero-subtitle"><?php echo esc_html(get_theme_mod('proservis_hero_subtitle', 'Rychlá oprava praček, myček a sušiček všech značek a modelů v Brně a okolí')); ?></p>

      <div class="hero-buttons">
        <a href="<?php echo esc_url(proservis_phone_link()); ?>" class="btn btn-primary">
          <i class="fas fa-phone"></i>
          <?php echo esc_html(proservis_phone()); ?>
        </a>
        <a href="#objednavka" class="btn btn-secondary">
          <i class="fas fa-calendar-check"></i>
          Objednat opravu
        </a>
      </div>

      <!-- Hero brands -->
      <div class="hero-brands">
        <?php
        $brands = proservis_get_brands();
        $hero_brands = array_slice($brands, 0, 3);
        if (!empty($hero_brands)):
          foreach ($hero_brands as $brand):
            $logo = get_post_meta($brand->ID, '_brand_logo', true);
            if (!$logo) continue;
        ?>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/brands/' . $logo); ?>"
               alt="<?php echo esc_attr($brand->post_title); ?>"
               loading="lazy">
        <?php
          endforeach;
        else:
        ?>
          <img src="<?php echo PROSERVIS_URI; ?>/img/brands/lg-logo-logo-logo-pinterest-logos-14.png" alt="LG" loading="lazy">
          <img src="<?php echo PROSERVIS_URI; ?>/img/brands/Miele_Logo_M_Red_sRGB.svg.png" alt="Miele" loading="lazy">
          <img src="<?php echo PROSERVIS_URI; ?>/img/brands/Samsung_old_logo_before_year_2015.svg.png" alt="Samsung" loading="lazy">
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     APPLIANCES
     ============================================================ -->
<section class="appliances">
  <div class="container">
    <div class="appliances-grid">
      <div class="appliance-item">
        <img src="<?php echo PROSERVIS_URI; ?>/img/appliances/washing-machine.webp"
             alt="Oprava praček" loading="lazy">
      </div>
      <div class="appliance-item">
        <img src="<?php echo PROSERVIS_URI; ?>/img/appliances/dishwasher.webp"
             alt="Oprava myček" loading="lazy">
      </div>
      <div class="appliance-item">
        <img src="<?php echo PROSERVIS_URI; ?>/img/appliances/dryer.webp"
             alt="Oprava sušiček" loading="lazy">
      </div>
    </div>

    <div class="appliances-cta">
      <p>Opravujeme <strong>všechny typy</strong> domácích spotřebičů</p>
      <a href="<?php echo esc_url(proservis_phone_link()); ?>" class="btn btn-primary">
        <i class="fas fa-phone"></i> Zavolat hned
      </a>
    </div>
  </div>
</section>

<!-- ============================================================
     ABOUT
     ============================================================ -->
<section class="about" id="o-nas">
  <div class="container">
    <h2 class="section-title">O NÁS</h2>

    <div class="about-grid">
      <div class="about-card">
        <div class="about-card-icon"><i class="fas fa-clock"></i></div>
        <h3>Rychlý výjezd</h3>
        <p>Přijedeme k vám ještě ten samý den nebo následující ráno. Žádné čekání na týden.</p>
      </div>
      <div class="about-card">
        <div class="about-card-icon"><i class="fas fa-tools"></i></div>
        <h3>Zkušení technici</h3>
        <p>Naši technici mají přes 10 let zkušeností s opravou všech značek spotřebičů.</p>
      </div>
      <div class="about-card">
        <div class="about-card-icon"><i class="fas fa-shield-alt"></i></div>
        <h3>Záruka na opravu</h3>
        <p>Na každou opravu poskytujeme záruku. Pokud se problém vrátí — opravíme bezplatně.</p>
      </div>
      <div class="about-card">
        <div class="about-card-icon"><i class="fas fa-map-marker-alt"></i></div>
        <h3>Brno a okolí</h3>
        <p>Pracujeme po celém Brně a okolí do 30 km. Výjezd zdarma při objednání opravy.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     SERVICES
     ============================================================ -->
<section class="services" id="sluzby">
  <div class="container">
    <h2 class="section-title">NAŠE SLUŽBY</h2>
    <p style="text-align:center;color:#666;margin-bottom:32px;">Opravujeme rychle a za rozumné ceny</p>

    <div class="services-table">
      <table>
        <thead>
          <tr>
            <th>Služba</th>
            <th>Cena od</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $services = proservis_get_services();
          if ($services):
            foreach ($services as $service):
              $price = get_post_meta($service->ID, '_service_price', true);
              $unit  = get_post_meta($service->ID, '_service_unit', true) ?: 'Kč';
          ?>
          <tr>
            <td><?php echo esc_html($service->post_title); ?></td>
            <td class="price"><?php echo esc_html($price . ' ' . $unit); ?></td>
          </tr>
          <?php
            endforeach;
          else:
            // Fallback данные
            $default_services = [
              ['Diagnostika (bez opravy)', '1000 Kč'],
              ['Výměna topení', '2000 Kč'],
              ['Výměna čerpadla', '2000 Kč'],
              ['Výměna snímače hladiny vody', '1500 Kč'],
              ['Výměna přívodního ventilu', '2000 Kč'],
              ['Výměna zámku', '2000 Kč'],
              ['Výměna kondenzátoru', '1700 Kč'],
              ['Oprava motoru', '2100 Kč'],
              ['Otevření dveří se zlomeným zámkem', '1500 Kč'],
              ['Čistka', '1500 Kč'],
            ];
            foreach ($default_services as $svc):
          ?>
          <tr>
            <td><?php echo esc_html($svc[0]); ?></td>
            <td class="price"><?php echo esc_html($svc[1]); ?></td>
          </tr>
          <?php
            endforeach;
          endif;
          ?>
        </tbody>
      </table>
    </div>

    <div class="services-cta">
      <a href="#objednavka" class="btn btn-primary">
        <i class="fas fa-calendar-check"></i>
        Objednat opravu online
      </a>
    </div>
  </div>
</section>

<!-- ============================================================
     CONTACT FORM
     ============================================================ -->
<section class="contact-form-section" id="objednavka">
  <div class="container">
    <h2 class="section-title">OBJEDNÁVKA</h2>
    <p style="text-align:center;color:rgba(255,255,255,0.7);margin-bottom:40px;">
      Vyplňte formulář a ozveme se vám do 30 minut
    </p>

    <form class="contact-form" id="proservis-form" novalidate>
      <?php wp_nonce_field('proservis_nonce', 'form_nonce'); ?>

      <div class="form-group">
        <label for="name">Jméno a příjmení *</label>
        <input type="text" id="name" name="name" placeholder="Jan Novák" required>
      </div>

      <div class="form-group">
        <label for="phone">Telefon *</label>
        <input type="tel" id="phone" name="phone" placeholder="+420 000 000 000" required>
      </div>

      <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" placeholder="jan@email.cz">
      </div>

      <div class="form-group">
        <label for="device">Typ spotřebiče</label>
        <select id="device" name="device">
          <option value="">Vyberte spotřebič</option>
          <option value="pračka">Pračka</option>
          <option value="myčka">Myčka nádobí</option>
          <option value="sušička">Sušička</option>
          <option value="jiné">Jiné</option>
        </select>
      </div>

      <div class="form-group">
        <label for="message">Popis problému</label>
        <textarea id="message" name="message" placeholder="Popište problém se spotřebičem..."></textarea>
      </div>

      <div class="form-submit">
        <button type="submit" class="btn btn-primary" id="form-submit">
          <i class="fas fa-paper-plane"></i>
          Odeslat objednávku
        </button>
      </div>

      <div id="form-response" style="text-align:center;margin-top:16px;display:none;"></div>
    </form>
  </div>
</section>

<!-- ============================================================
     HOW WE WORK
     ============================================================ -->
<section class="how-we-work" id="jak-pracujeme">
  <div class="container">
    <h2 class="section-title">JAK PRACUJEME</h2>

    <div class="how-grid">
      <div class="how-step">
        <div class="how-step-number">1</div>
        <h3>Zavolejte nebo objednejte</h3>
        <p>Kontaktujte nás telefonicky nebo přes formulář. Domluvíme termín výjezdu.</p>
      </div>
      <div class="how-step">
        <div class="how-step-number">2</div>
        <h3>Výjezd technika</h3>
        <p>Přijedeme ve sjednaný čas. Diagnostika na místě — bezplatně při objednání opravy.</p>
      </div>
      <div class="how-step">
        <div class="how-step-number">3</div>
        <h3>Oprava a záruka</h3>
        <p>Opravíme spotřebič a vydáme záruční list. Platíte až po úspěšné opravě.</p>
      </div>
    </div>
  </div>
</section>



<!-- ============================================================
     BRANDS
     ============================================================ -->
<section class="brands" id="znacky">
  <div class="container">
    <h2 class="section-title" style="color:#fff;">OPRAVA VŠECH ZNAČEK</h2>
    <p style="text-align:center;color:rgba(255,255,255,0.6);margin-bottom:0;">
      Opravujeme spotřebiče všech světových výrobců
    </p>

  <div class="brands-grid">
<?php
$brands = proservis_get_brands();
foreach ($brands as $brand):
    $logo = get_post_meta($brand->ID, '_brand_logo', true);
    if (!$logo) continue;
?>
    <div class="brand-item">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/brands/' . $logo); ?>"
             alt="<?php echo esc_attr($brand->post_title); ?>"
             loading="lazy">
    </div>
<?php endforeach; ?>
</div>

    <p class="brands-more">A další desítky značek...</p>
  </div>
</section>

<?php get_footer(); ?>
