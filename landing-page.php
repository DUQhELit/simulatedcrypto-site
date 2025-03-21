<?php
/*
Theme Name: TradeSimulator
Theme URI: https://tradesimulator.io
Author: Your Name
Author URI: https://yourwebsite.com
Description: A custom WordPress theme for TradeSimulator.io with an optimized iOS app landing page.
Version: 1.0
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: tradesimulator
*/

// Enqueue Styles and Scripts
function tradesimulator_enqueue_scripts() {
    wp_enqueue_style('tradesimulator-style', get_stylesheet_uri());
    wp_enqueue_script('google-analytics', 'https://www.googletagmanager.com/gtag/js?id=G-NPWZ7073JT', [], null, true);
    wp_add_inline_script('google-analytics', "
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-NPWZ7073JT');
    ");
}
add_action('wp_enqueue_scripts', 'tradesimulator_enqueue_scripts');

// Register Menus
function tradesimulator_register_menus() {
    register_nav_menus([
        'primary' => __('Primary Menu', 'tradesimulator'),
    ]);
}
add_action('init', 'tradesimulator_register_menus');

// Add Theme Support
function tradesimulator_theme_support() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
}
add_action('after_setup_theme', 'tradesimulator_theme_support');

// Custom Landing Page Template
function tradesimulator_landing_page() {
    if (is_front_page()) {
        include get_template_directory() . '/landing-page.php';
        exit;
    }
}
add_action('template_redirect', 'tradesimulator_landing_page');

// Create Landing Page Template
function tradesimulator_create_landing_page() {
    $landing_page_content = "<?php
    /* Template Name: Landing Page */
    get_header();
    ?>
    <div class='landing-page-container'>
        <h1>TradeSimulator - The Best Crypto Trading Simulator</h1>
        <p>Master crypto trading risk-free. Download the app now!</p>
        <a class='cta' href='#' id='download-btn'>Download on iOS</a>
    </div>
    <script>
        document.getElementById('download-btn').addEventListener('click', function() {
            gtag('event', 'click', {
                'event_category': 'Download',
                'event_label': 'Download iOS App',
                'value': 1
            });
        });
    </script>
    <?php get_footer(); ?>";
    file_put_contents(get_template_directory() . '/landing-page.php', $landing_page_content);
}
add_action('after_setup_theme', 'tradesimulator_create_landing_page');
