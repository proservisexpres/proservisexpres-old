-- ============================================================
-- Proservis Theme — данные для импорта
-- Дата: 22.03.2026
-- Содержит: бренды (13) + услуги (10) + мета данные
-- ============================================================
-- ИНСТРУКЦИЯ:
-- 1. Откройте phpMyAdmin → выберите нужную БД
-- 2. Вкладка SQL → вставьте этот файл → выполните
-- 3. Замените префикс wpta_ на ваш если он другой
-- ============================================================

SET NAMES utf8mb4;
SET foreign_key_checks = 0;

-- Удаляем старые данные если есть
DELETE FROM `wpta_postmeta` WHERE `post_id` IN (
    SELECT ID FROM `wpta_posts` 
    WHERE `post_type` IN ('proservis_service', 'proservis_brand')
);
DELETE FROM `wpta_posts` 
WHERE `post_type` IN ('proservis_service', 'proservis_brand');

-- ============================================================
-- БРЕНДЫ
-- ============================================================
INSERT INTO `wpta_posts` 
(`post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) 
VALUES
(1, NOW(), UTC_TIMESTAMP(), '', 'LG',         '', 'publish', 'closed', 'closed', '', 'lg',         '', '', NOW(), UTC_TIMESTAMP(), '', 0, '', 1,  'proservis_brand', '', 0),
(1, NOW(), UTC_TIMESTAMP(), '', 'Miele',      '', 'publish', 'closed', 'closed', '', 'miele',      '', '', NOW(), UTC_TIMESTAMP(), '', 0, '', 2,  'proservis_brand', '', 0),
(1, NOW(), UTC_TIMESTAMP(), '', 'Samsung',    '', 'publish', 'closed', 'closed', '', 'samsung',    '', '', NOW(), UTC_TIMESTAMP(), '', 0, '', 3,  'proservis_brand', '', 0),
(1, NOW(), UTC_TIMESTAMP(), '', 'Argo',       '', 'publish', 'closed', 'closed', '', 'argo',       '', '', NOW(), UTC_TIMESTAMP(), '', 0, '', 4,  'proservis_brand', '', 0),
(1, NOW(), UTC_TIMESTAMP(), '', 'Ariston',    '', 'publish', 'closed', 'closed', '', 'ariston',    '', '', NOW(), UTC_TIMESTAMP(), '', 0, '', 5,  'proservis_brand', '', 0),
(1, NOW(), UTC_TIMESTAMP(), '', 'Beko',       '', 'publish', 'closed', 'closed', '', 'beko',       '', '', NOW(), UTC_TIMESTAMP(), '', 0, '', 6,  'proservis_brand', '', 0),
(1, NOW(), UTC_TIMESTAMP(), '', 'Siemens',    '', 'publish', 'closed', 'closed', '', 'siemens',    '', '', NOW(), UTC_TIMESTAMP(), '', 0, '', 7,  'proservis_brand', '', 0),
(1, NOW(), UTC_TIMESTAMP(), '', 'Vestel',     '', 'publish', 'closed', 'closed', '', 'vestel',     '', '', NOW(), UTC_TIMESTAMP(), '', 0, '', 8,  'proservis_brand', '', 0),
(1, NOW(), UTC_TIMESTAMP(), '', 'Whirlpool',  '', 'publish', 'closed', 'closed', '', 'whirlpool',  '', '', NOW(), UTC_TIMESTAMP(), '', 0, '', 9,  'proservis_brand', '', 0),
(1, NOW(), UTC_TIMESTAMP(), '', 'Indesit',    '', 'publish', 'closed', 'closed', '', 'indesit',    '', '', NOW(), UTC_TIMESTAMP(), '', 0, '', 10, 'proservis_brand', '', 0),
(1, NOW(), UTC_TIMESTAMP(), '', 'Electrolux', '', 'publish', 'closed', 'closed', '', 'electrolux', '', '', NOW(), UTC_TIMESTAMP(), '', 0, '', 11, 'proservis_brand', '', 0),
(1, NOW(), UTC_TIMESTAMP(), '', 'Bauknecht',  '', 'publish', 'closed', 'closed', '', 'bauknecht',  '', '', NOW(), UTC_TIMESTAMP(), '', 0, '', 12, 'proservis_brand', '', 0),
(1, NOW(), UTC_TIMESTAMP(), '', 'Fagor',      '', 'publish', 'closed', 'closed', '', 'fagor',      '', '', NOW(), UTC_TIMESTAMP(), '', 0, '', 13, 'proservis_brand', '', 0);

-- Мета: логотипы брендов
INSERT INTO `wpta_postmeta` (`post_id`, `meta_key`, `meta_value`)
SELECT ID, '_brand_logo', CASE `post_name`
    WHEN 'lg'         THEN 'lg-logo-logo-logo-pinterest-logos-14.png'
    WHEN 'miele'      THEN 'Miele_Logo_M_Red_sRGB.svg.png'
    WHEN 'samsung'    THEN 'Samsung_old_logo_before_year_2015.svg.png'
    WHEN 'argo'       THEN 'argo.jpeg'
    WHEN 'ariston'    THEN 'ariston.png'
    WHEN 'beko'       THEN 'New_Beko_logo.svg.png'
    WHEN 'siemens'    THEN 'Siemens_AG_logo.svg.png'
    WHEN 'vestel'     THEN 'vestel.jpg'
    WHEN 'whirlpool'  THEN 'png-clipart-whirlpool-corporation-home-appliance-washing-machines-brand-maytag-others.png'
    WHEN 'indesit'    THEN 'png-clipart-indesit-co-home-appliance-logo-washing-machines-refrigerator-logo-miscellaneous-blue-thumbnail.png'
    WHEN 'electrolux' THEN 'png-clipart-electrolux-logo-organization-brand-washing-machines-whirlpool-logo-text-logo-thumbnail.png'
    WHEN 'bauknecht'  THEN 'bauknecht.jpg'
    WHEN 'fagor'      THEN 'fagor-logo-png-transparent.png'
END
FROM `wpta_posts`
WHERE `post_type` = 'proservis_brand';

-- ============================================================
-- УСЛУГИ
-- ============================================================
INSERT INTO `wpta_posts`
(`post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`)
VALUES
(1, NOW(), UTC_TIMESTAMP(), '', 'Diagnostika (bez opravy)',           '', 'publish', 'closed', 'closed', '', 'diagnostika',    '', '', NOW(), UTC_TIMESTAMP(), '', 0, '', 1,  'proservis_service', '', 0),
(1, NOW(), UTC_TIMESTAMP(), '', 'Výměna topení',                      '', 'publish', 'closed', 'closed', '', 'vymena-topeni',  '', '', NOW(), UTC_TIMESTAMP(), '', 0, '', 2,  'proservis_service', '', 0),
(1, NOW(), UTC_TIMESTAMP(), '', 'Výměna čerpadla',                    '', 'publish', 'closed', 'closed', '', 'vymena-cerpadla','', '', NOW(), UTC_TIMESTAMP(), '', 0, '', 3,  'proservis_service', '', 0),
(1, NOW(), UTC_TIMESTAMP(), '', 'Výměna snímače hladiny vody',        '', 'publish', 'closed', 'closed', '', 'vymena-snimace', '', '', NOW(), UTC_TIMESTAMP(), '', 0, '', 4,  'proservis_service', '', 0),
(1, NOW(), UTC_TIMESTAMP(), '', 'Výměna přívodního ventilu',          '', 'publish', 'closed', 'closed', '', 'vymena-ventilu', '', '', NOW(), UTC_TIMESTAMP(), '', 0, '', 5,  'proservis_service', '', 0),
(1, NOW(), UTC_TIMESTAMP(), '', 'Výměna zámku',                       '', 'publish', 'closed', 'closed', '', 'vymena-zamku',   '', '', NOW(), UTC_TIMESTAMP(), '', 0, '', 6,  'proservis_service', '', 0),
(1, NOW(), UTC_TIMESTAMP(), '', 'Výměna kondenzátoru',                '', 'publish', 'closed', 'closed', '', 'vymena-kondenz', '', '', NOW(), UTC_TIMESTAMP(), '', 0, '', 7,  'proservis_service', '', 0),
(1, NOW(), UTC_TIMESTAMP(), '', 'Oprava motoru',                      '', 'publish', 'closed', 'closed', '', 'oprava-motoru',  '', '', NOW(), UTC_TIMESTAMP(), '', 0, '', 8,  'proservis_service', '', 0),
(1, NOW(), UTC_TIMESTAMP(), '', 'Otevření dveří se zlomeným zámkem', '', 'publish', 'closed', 'closed', '', 'otevreni-dveri', '', '', NOW(), UTC_TIMESTAMP(), '', 0, '', 9,  'proservis_service', '', 0),
(1, NOW(), UTC_TIMESTAMP(), '', 'Čistka',                             '', 'publish', 'closed', 'closed', '', 'cistka',         '', '', NOW(), UTC_TIMESTAMP(), '', 0, '', 10, 'proservis_service', '', 0);

-- Мета: цены и единицы измерения
INSERT INTO `wpta_postmeta` (`post_id`, `meta_key`, `meta_value`)
SELECT ID, '_service_price', CASE `post_name`
    WHEN 'diagnostika'    THEN '1000'
    WHEN 'vymena-topeni'  THEN '2000'
    WHEN 'vymena-cerpadla'THEN '2000'
    WHEN 'vymena-snimace' THEN '1500'
    WHEN 'vymena-ventilu' THEN '2000'
    WHEN 'vymena-zamku'   THEN '2000'
    WHEN 'vymena-kondenz' THEN '1700'
    WHEN 'oprava-motoru'  THEN '2100'
    WHEN 'otevreni-dveri' THEN '1500'
    WHEN 'cistka'         THEN '1500'
END
FROM `wpta_posts` WHERE `post_type` = 'proservis_service';

INSERT INTO `wpta_postmeta` (`post_id`, `meta_key`, `meta_value`)
SELECT ID, '_service_unit', 'Kč'
FROM `wpta_posts` WHERE `post_type` = 'proservis_service';

SET foreign_key_checks = 1;

-- ============================================================
-- ГОТОВО
-- ============================================================
