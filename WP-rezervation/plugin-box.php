<?php
/*
Plugin Name: Rezervacia Lightbox
Description: Otvori rezervaciu v iframe lightboxe. Pre pridanie kdekoľvek na stránku použite shortcode [box-rezervacia].
Version: 1.1.0
Author: TD
*/

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Admin menu
 */
add_action('admin_menu', 'rezervacia_lightbox_admin_menu');
function rezervacia_lightbox_admin_menu() {
    add_menu_page(
        'Rezervacia Lightbox',
        'Rezervacia Lightbox',
        'manage_options',
        'rezervacia-lightbox',
        'rezervacia_lightbox_settings_page',
        'dashicons-calendar-alt',
        80
    );
}

/**
 * Register settings
 */
add_action('admin_init', 'rezervacia_lightbox_register_settings');
function rezervacia_lightbox_register_settings() {
    register_setting(
        'rezervacia_lightbox_settings_group',
        'rezervacia_lightbox_api_key',
        [
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => '',
        ]
    );

    register_setting(
        'rezervacia_lightbox_settings_group',
        'rezervacia_lightbox_base_url',
        [
            'type' => 'string',
            'sanitize_callback' => 'esc_url_raw',
            'default' => 'http://localhost/crystal-media/rezervacia-api.php',
        ]
    );
}

/**
 * Settings page
 */
function rezervacia_lightbox_settings_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    $api_key = get_option('rezervacia_lightbox_api_key', '');
    $base_url = get_option('rezervacia_lightbox_base_url', 'http://localhost/crystal-media/rezervacia-api.php');
    ?>
    <div class="wrap">
        <h1>Rezervacia Lightbox</h1>

        <form method="post" action="options.php">
            <?php settings_fields('rezervacia_lightbox_settings_group'); ?>
            <?php do_settings_sections('rezervacia_lightbox_settings_group'); ?>

            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row">
                        <label for="rezervacia_lightbox_base_url">URL rezervácie</label>
                    </th>
                    <td>
                        <input
                            type="url"
                            id="rezervacia_lightbox_base_url"
                            name="rezervacia_lightbox_base_url"
                            value="<?php echo esc_attr($base_url); ?>"
                            class="regular-text"
                        >
                        <!--<p class="description">
                            Napr. http://localhost/crystal-media/rezervacia-api.php
                        </p>-->
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        <label for="rezervacia_lightbox_api_key">API kľúč</label>
                    </th>
                    <td>
                        <input
                            type="text"
                            id="rezervacia_lightbox_api_key"
                            name="rezervacia_lightbox_api_key"
                            value="<?php echo esc_attr($api_key); ?>"
                            class="regular-text"
                        >
                        <p class="description">
                            Zadajte API kľúč, ktorý sa pošle do iframe URL.
                        </p>
                    </td>
                </tr>
            </table>

            <?php submit_button('Uložiť nastavenia'); ?>
        </form>
    </div>
    <?php
}

/**
 * Frontend output
 */
add_action('wp_footer', 'rezervacia_lightbox_render_footer');
function rezervacia_lightbox_render_footer() {
    $api_key = get_option('rezervacia_lightbox_api_key', '');
    $base_url = get_option('rezervacia_lightbox_base_url', 'http://localhost/crystal-media/rezervacia-api.php');

    if (empty($api_key) || empty($base_url)) {
        return;
    }

    $iframe_url = add_query_arg(
        [
            'api'   => $api_key,
            'embed' => 1,
        ],
        $base_url
    );
    ?>
    <style>
        .lb-backdrop{
            position:fixed;
            inset:0;
            background:rgba(0,0,0,.6);
            display:none;
            align-items:center;
            justify-content:center;
            z-index:9999;
            padding:16px;
        }
        .lb-backdrop.open{
            display:flex;
        }
        .lb-box{
            width:min(820px, 100%);
            height:min(80vh, 760px);
            background:#fff;
            border-radius:14px;
            overflow:hidden;
            box-shadow:0 20px 60px rgba(0,0,0,.35);
            position:relative;
            padding:20px;
        }
        .lb-close{
            position:absolute;
            top:8px;
            right:8px;
            z-index:2;
            border:0;
            border-radius:10px;
            padding:8px 10px;
            background:rgba(0,0,0,.08);
            cursor:pointer;
        }
        .lb-iframe{
            width:100%;
            height:100%;
            border:0;
        }
    </style>

    <div class="lb-backdrop" id="rezLb" aria-hidden="true">
        <div class="lb-box" role="dialog" aria-modal="true">
            <button class="lb-close" type="button" id="rezLbClose">✕</button>
            <iframe class="lb-iframe" id="rezIframe" src=""></iframe>
        </div>
    </div>

    <script>
        (function(){
            const lb = document.getElementById('rezLb');
            const iframe = document.getElementById('rezIframe');
            const btnClose = document.getElementById('rezLbClose');
            const iframeUrl = <?php echo wp_json_encode($iframe_url); ?>;

            function openRezervacia(){
                iframe.src = iframeUrl;
                lb.classList.add('open');
                lb.setAttribute('aria-hidden', 'false');
            }

            function closeRezervacia(){
                lb.classList.remove('open');
                lb.setAttribute('aria-hidden', 'true');
                iframe.src = '';
            }

            lb.addEventListener('click', function(e){
                if (e.target === lb) {
                    closeRezervacia();
                }
            });

            btnClose.addEventListener('click', closeRezervacia);

            document.addEventListener('keydown', function(e){
                if (e.key === 'Escape' && lb.classList.contains('open')) {
                    closeRezervacia();
                }
            });

            window.openRezervacia = openRezervacia;
        })();
    </script>
    <?php
}

/**
 * Shortcode
 */
add_shortcode('box-rezervacia', 'rezervacia_lightbox_shortcode');
function rezervacia_lightbox_shortcode() {
    $api_key = get_option('rezervacia_lightbox_api_key', '');

    if (empty($api_key)) {
        return '<p>Rezervačný modul nie je nastavený. Chýba API kľúč.</p>';
    }

    return '<button type="button" onclick="openRezervacia()">Rezervovať</button>';
}