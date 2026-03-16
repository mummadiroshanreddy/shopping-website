<?php
/**
 * Phlox Luxe Child Theme — functions.php
 */

defined( 'ABSPATH' ) || exit;

/* ──────────────────────────────
   1. ENQUEUE STYLES & SCRIPTS
────────────────────────────── */
add_action( 'wp_enqueue_scripts', 'phlox_luxe_enqueue' );
function phlox_luxe_enqueue() {
    // Google Fonts
    wp_enqueue_style(
        'luxe-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600;700&display=swap',
        [], null
    );

    // Parent theme
    wp_enqueue_style(
        'phlox-style',
        get_template_directory_uri() . '/style.css',
        [], wp_get_theme( 'phlox' )->get( 'Version' )
    );

    // Child theme design system
    wp_enqueue_style(
        'phlox-luxe-style',
        get_stylesheet_uri(),
        [ 'phlox-style' ],
        filemtime( get_stylesheet_directory() . '/style.css' )
    );

    // WooCommerce premium overrides
    wp_enqueue_style(
        'phlox-luxe-wc',
        get_stylesheet_directory_uri() . '/assets/css/woocommerce.css',
        [ 'phlox-luxe-style' ],
        filemtime( get_stylesheet_directory() . '/assets/css/woocommerce.css' )
    );

    // Font Awesome for icons
    wp_enqueue_style(
        'fontawesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css',
        [], '6.5.0'
    );

    // Main JS
    wp_enqueue_script(
        'phlox-luxe-js',
        get_stylesheet_directory_uri() . '/assets/js/app.js',
        [], filemtime( get_stylesheet_directory() . '/assets/js/app.js' ),
        true
    );

    // Pass WC cart URL to JS
    wp_localize_script( 'phlox-luxe-js', 'luxeData', [
        'cartUrl'     => wc_get_cart_url(),
        'shopUrl'     => get_permalink( wc_get_page_id( 'shop' ) ),
        'checkoutUrl' => wc_get_checkout_url(),
        'ajaxUrl'     => admin_url( 'admin-ajax.php' ),
        'nonce'       => wp_create_nonce( 'wc_store_api' ),
    ] );
}

/* ──────────────────────────────
   2. WOOCOMMERCE SUPPORT
────────────────────────────── */
add_action( 'after_setup_theme', 'phlox_luxe_setup' );
function phlox_luxe_setup() {
    add_theme_support( 'woocommerce', [
        'thumbnail_image_width' => 600,
        'gallery_thumbnail_image_width' => 100,
        'single_image_width'   => 800,
    ] );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'gallery', 'caption' ] );

    // Nav menus
    register_nav_menus( [
        'primary' => __( 'Primary Navigation', 'phlox-luxe' ),
        'footer'  => __( 'Footer Navigation', 'phlox-luxe' ),
    ] );
}

/* ──────────────────────────────
   3. REMOVE DEFAULT WC WRAPPERS
   (replaced by our templates)
────────────────────────────── */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

add_action( 'woocommerce_before_main_content', 'phlox_luxe_wc_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'phlox_luxe_wc_wrapper_end', 10 );
function phlox_luxe_wc_wrapper_start() {
    echo '<div class="luxe-container" style="padding-top:2rem;padding-bottom:4rem;">';
}
function phlox_luxe_wc_wrapper_end() {
    echo '</div>';
}

/* ──────────────────────────────
   4. CUSTOM HEADER / FOOTER
   (hooked in every page)
────────────────────────────── */
// We output header/footer via get_header() / get_footer()
// The child theme provides header.php and footer.php

/* ──────────────────────────────
   5. HELPER: RENDER STARS
────────────────────────────── */
function luxe_stars( $rating = 5 ) {
    $out = '<span class="stars">';
    for ( $i = 1; $i <= 5; $i++ ) {
        $out .= $i <= $rating ? '★' : '☆';
    }
    $out .= '</span>';
    return $out;
}

/* ──────────────────────────────
   6. PRODUCT CARD TEMPLATE
────────────────────────────── */
function luxe_product_card( $product_id = 0, $badge = '' ) {
    global $product;
    if ( $product_id ) {
        $product = wc_get_product( $product_id );
    }
    if ( ! $product ) return;

    $img   = get_the_post_thumbnail_url( $product->get_id(), 'medium' );
    $title = $product->get_name();
    $price = $product->get_price_html();
    $link  = get_permalink( $product->get_id() );
    ?>
    <div class="product-card reveal">
        <div class="product-card-img">
            <?php if ( $img ) : ?>
                <a href="<?php echo esc_url( $link ); ?>">
                    <img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy">
                </a>
            <?php else : ?>
                <a href="<?php echo esc_url( $link ); ?>">
                    <div style="width:100%;height:100%;background:#f0ede8;display:flex;align-items:center;justify-content:center;color:#aaa;">
                        <i class="fa fa-image fa-2x"></i>
                    </div>
                </a>
            <?php endif; ?>
            <?php if ( $badge ) : ?>
                <span class="product-badge <?php echo esc_attr( strtolower( $badge ) ); ?>"><?php echo esc_html( $badge ); ?></span>
            <?php endif; ?>
            <div class="product-card-actions">
                <button class="product-action-btn wishlist-toggle" title="Add to Wishlist" data-id="<?php echo esc_attr( $product->get_id() ); ?>">
                    <i class="fa-regular fa-heart"></i>
                </button>
                <button class="product-action-btn" title="Quick view" data-id="<?php echo esc_attr( $product->get_id() ); ?>">
                    <i class="fa-regular fa-eye"></i>
                </button>
            </div>
            <button class="product-quick-add" data-id="<?php echo esc_attr( $product->get_id() ); ?>">
                + Quick Add
            </button>
        </div>
        <div class="product-card-body">
            <p class="product-category"><?php echo implode( ', ', wp_get_post_terms( $product->get_id(), 'product_cat', [ 'fields' => 'names' ] ) ); ?></p>
            <h4><a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $title ); ?></a></h4>
            <div class="product-price">
                <span class="current"><?php echo $price; ?></span>
            </div>
            <div class="product-rating">
                <?php echo luxe_stars( 5 ); ?>
                <span class="count">(<?php echo rand( 12, 120 ); ?>)</span>
            </div>
        </div>
    </div>
    <?php
}

/* ──────────────────────────────
   7. WIDGET AREAS
────────────────────────────── */
add_action( 'widgets_init', 'phlox_luxe_widgets' );
function phlox_luxe_widgets() {
    register_sidebar( [
        'name'          => 'Shop Sidebar',
        'id'            => 'shop-sidebar',
        'before_widget' => '<div class="filter-group">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5>',
        'after_title'   => '</h5>',
    ] );
}

/* ──────────────────────────────
   8. ADD TO CART VIA AJAX
────────────────────────────── */
add_action( 'wp_ajax_luxe_add_to_cart', 'luxe_ajax_add_to_cart' );
add_action( 'wp_ajax_nopriv_luxe_add_to_cart', 'luxe_ajax_add_to_cart' );
function luxe_ajax_add_to_cart() {
    check_ajax_referer( 'wc_store_api', 'nonce' );
    $product_id = absint( $_POST['product_id'] ?? 0 );
    $quantity   = absint( $_POST['quantity'] ?? 1 );
    if ( $product_id && WC()->cart ) {
        WC()->cart->add_to_cart( $product_id, $quantity );
        wp_send_json_success( [
            'count'    => WC()->cart->get_cart_contents_count(),
            'subtotal' => WC()->cart->get_cart_subtotal(),
        ] );
    }
    wp_send_json_error();
}
