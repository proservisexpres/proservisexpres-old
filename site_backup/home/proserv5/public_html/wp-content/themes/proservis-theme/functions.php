<?php
/**
 * Proservis Theme Functions
 */

defined('ABSPATH') || exit;

define('PROSERVIS_VERSION', '1.0.0');
define('PROSERVIS_DIR', get_template_directory());
define('PROSERVIS_URI', get_template_directory_uri());

/* ============================================================
   SETUP
   ============================================================ */
function proservis_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form','comment-form','gallery','caption']);
    add_theme_support('custom-logo', [
        'height'      => 80,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    register_nav_menus([
        'primary' => __('Hlavní navigace', 'proservis'),
        'footer'  => __('Patička', 'proservis'),
    ]);

    load_theme_textdomain('proservis', PROSERVIS_DIR . '/languages');
}
add_action('after_setup_theme', 'proservis_setup');

/* ============================================================
   ENQUEUE SCRIPTS & STYLES
   ============================================================ */
function proservis_enqueue() {
    // Google Fonts — only what we need
    wp_enqueue_style(
        'proservis-fonts',
        'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Staatliches&family=Belgrano&display=swap',
        [],
        null
    );

    // Font Awesome
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css',
        [],
        '6.5.0'
    );

    // Main stylesheet
    wp_enqueue_style(
        'proservis-style',
        get_stylesheet_uri(),
        ['proservis-fonts', 'font-awesome'],
        PROSERVIS_VERSION
    );

    // Main JS (defer)
    wp_enqueue_script(
        'proservis-main',
        PROSERVIS_URI . '/js/main.js',
        [],
        PROSERVIS_VERSION,
        true // footer
    );

    // Pass PHP data to JS
    wp_localize_script('proservis-main', 'proservisData', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('proservis_nonce'),
    ]);
}
add_action('wp_enqueue_scripts', 'proservis_enqueue');

/* ============================================================
   CONTACT FORM AJAX
   ============================================================ */
function proservis_handle_form() {
    check_ajax_referer('proservis_nonce', 'nonce');

    $name    = sanitize_text_field($_POST['name'] ?? '');
    $phone   = sanitize_text_field($_POST['phone'] ?? '');
    $email   = sanitize_email($_POST['email'] ?? '');
    $device  = sanitize_text_field($_POST['device'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    if (empty($name) || empty($phone)) {
        wp_send_json_error(['message' => 'Vyplňte prosím jméno a telefon.']);
    }

    $to      = 'proservisexpres@gmail.com';
    $subject = "Nová objednávka opravy od {$name}";
    $body    = "Jméno: {$name}\nTelefon: {$phone}\nE-mail: {$email}\nSpotřebič: {$device}\nZpráva: {$message}";
    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        "From: {$name} <{$email}>",
    ];

    $sent = wp_mail($to, $subject, $body, $headers);

    if ($sent) {
        wp_send_json_success(['message' => 'Objednávka byla úspěšně odeslána. Ozveme se vám co nejdříve!']);
    } else {
        wp_send_json_error(['message' => 'Chyba při odesílání. Zavolejte nám prosím.']);
    }
}
add_action('wp_ajax_proservis_form', 'proservis_handle_form');
add_action('wp_ajax_nopriv_proservis_form', 'proservis_handle_form');

/* ============================================================
   CUSTOM POST TYPES
   ============================================================ */

// Службы (услуги)
function proservis_register_cpt() {
    // Services
    register_post_type('proservis_service', [
        'labels'   => [
            'name'          => 'Služby',
            'singular_name' => 'Služba',
            'add_new_item'  => 'Přidat službu',
            'edit_item'     => 'Upravit službu',
        ],
        'public'       => false,
        'show_ui'      => true,
        'show_in_menu' => true,
        'menu_icon'    => 'dashicons-hammer',
        'supports'     => ['title'],
        'menu_position' => 5,
    ]);

    // Brands
    register_post_type('proservis_brand', [
        'labels'   => [
            'name'          => 'Značky',
            'singular_name' => 'Značka',
            'add_new_item'  => 'Přidat značku',
            'edit_item'     => 'Upravit značku',
        ],
        'public'       => false,
        'show_ui'      => true,
        'show_in_menu' => true,
        'menu_icon'    => 'dashicons-star-filled',
        'supports'     => ['title', 'thumbnail'],
        'menu_position' => 6,
    ]);
}
add_action('init', 'proservis_register_cpt');

/* ============================================================
   CUSTOM FIELDS (без ACF — простые meta boxes)
   ============================================================ */
function proservis_add_meta_boxes() {
    add_meta_box(
        'proservis_service_price',
        'Cena služby',
        'proservis_service_price_callback',
        'proservis_service',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'proservis_add_meta_boxes');

function proservis_service_price_callback($post) {
    wp_nonce_field('proservis_service_meta', 'proservis_service_nonce');
    $price = get_post_meta($post->ID, '_service_price', true);
    $unit  = get_post_meta($post->ID, '_service_unit', true) ?: 'Kč';
    echo '<p>';
    echo '<label>Cena od: <input type="text" name="service_price" value="' . esc_attr($price) . '" style="width:120px"></label> ';
    echo '<label>Jednotka: <input type="text" name="service_unit" value="' . esc_attr($unit) . '" style="width:60px"></label>';
    echo '</p>';
}

function proservis_save_service_meta($post_id) {
    if (!isset($_POST['proservis_service_nonce'])) return;
    if (!wp_verify_nonce($_POST['proservis_service_nonce'], 'proservis_service_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (isset($_POST['service_price'])) {
        update_post_meta($post_id, '_service_price', sanitize_text_field($_POST['service_price']));
    }
    if (isset($_POST['service_unit'])) {
        update_post_meta($post_id, '_service_unit', sanitize_text_field($_POST['service_unit']));
    }
}
add_action('save_post', 'proservis_save_service_meta');

/* ============================================================
   HELPER FUNCTIONS
   ============================================================ */

// Получить услуги из CPT
function proservis_get_services() {
    return get_posts([
        'post_type'      => 'proservis_service',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ]);
}

// Получить бренды из CPT
function proservis_get_brands() {
    return get_posts([
        'post_type'      => 'proservis_brand',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ]);
}

// Телефон из настроек темы
function proservis_phone() {
    return get_theme_mod('proservis_phone', '+420 727 919 861');
}

// Meta box для логотипа бренда
function proservis_brand_meta_box() {
    add_meta_box(
        'proservis_brand_logo',
        'Logo značky',
        'proservis_brand_logo_callback',
        'proservis_brand',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'proservis_brand_meta_box');

function proservis_brand_logo_callback($post) {
    wp_nonce_field('proservis_brand_meta', 'proservis_brand_nonce');
    $logo = get_post_meta($post->ID, '_brand_logo', true);
    echo '<p>';
    echo '<label>Имя файла из папки img/brands/:<br>';
    echo '<input type="text" name="brand_logo" value="' . esc_attr($logo) . '" style="width:100%" placeholder="lg-logo.png">';
    echo '</label></p>';
    echo '<p style="color:#666;font-size:12px">Файл должен лежать в wp-content/themes/proservis-theme/img/brands/</p>';
}

function proservis_save_brand_meta($post_id) {
    if (!isset($_POST['proservis_brand_nonce'])) return;
    if (!wp_verify_nonce($_POST['proservis_brand_nonce'], 'proservis_brand_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (isset($_POST['brand_logo'])) {
        update_post_meta($post_id, '_brand_logo', sanitize_text_field($_POST['brand_logo']));
    }
}
add_action('save_post', 'proservis_save_brand_meta');

function proservis_phone_link() {
    return 'tel:' . preg_replace('/[^+0-9]/', '', proservis_phone());
}

/* ============================================================
   THEME CUSTOMIZER
   ============================================================ */
function proservis_customize($wp_customize) {
    // Секция контактов
    $wp_customize->add_section('proservis_contacts', [
        'title'    => 'Kontakty',
        'priority' => 30,
    ]);

    // Телефон
    $wp_customize->add_setting('proservis_phone', [
        'default'           => '+420 727 919 861',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('proservis_phone', [
        'label'   => 'Telefon',
        'section' => 'proservis_contacts',
        'type'    => 'text',
    ]);

    // Email
    $wp_customize->add_setting('proservis_email', [
        'default'           => 'proservisexpres@gmail.com',
        'sanitize_callback' => 'sanitize_email',
    ]);
    $wp_customize->add_control('proservis_email', [
        'label'   => 'E-mail',
        'section' => 'proservis_contacts',
        'type'    => 'email',
    ]);

    // Hero заголовок
    $wp_customize->add_section('proservis_hero', [
        'title'    => 'Hero sekce',
        'priority' => 20,
    ]);

    $wp_customize->add_setting('proservis_hero_title', [
        'default'           => 'OPRAVA VŠECH ZNAČEK',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('proservis_hero_title', [
        'label'   => 'Hlavní nadpis',
        'section' => 'proservis_hero',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('proservis_hero_subtitle', [
        'default'           => 'Rychlá oprava praček, myček a sušiček všech značek a modelů v Brně a okolí',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('proservis_hero_subtitle', [
        'label'   => 'Podnadpis',
        'section' => 'proservis_hero',
        'type'    => 'textarea',
    ]);
}
add_action('customize_register', 'proservis_customize');

/* ============================================================
   REMOVE BLOAT
   ============================================================ */
// Убираем эмодзи
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// Убираем ненужные теги из head
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');

// Отключаем XML-RPC
add_filter('xmlrpc_enabled', '__return_false');

// Footer настройки

