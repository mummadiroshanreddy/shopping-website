<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0D0D0D">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Announcement Bar -->
<div id="luxe-announce">
    <span>✦ Free worldwide shipping on orders over $150 —
        <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>">Shop Now</a>
    </span>
    <button id="luxe-announce-close" aria-label="Close announcement">✕</button>
</div>

<!-- Navigation -->
<nav id="luxe-nav" role="navigation" aria-label="Main Navigation">
    <div class="nav-inner">
        <!-- Logo -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-logo">
            <?php bloginfo( 'name' ); ?><span>.</span>
        </a>

        <!-- Links -->
        <ul class="nav-links">
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
            <li><a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>">Shop</a></li>
            <li><a href="<?php echo esc_url( home_url( '/collections/' ) ); ?>">Collections</a></li>
            <li><a href="<?php echo esc_url( home_url( '/new-arrivals/' ) ); ?>">New Arrivals</a></li>
            <li><a href="<?php echo esc_url( home_url( '/best-sellers/' ) ); ?>">Best Sellers</a></li>
            <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About</a></li>
            <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a></li>
        </ul>

        <!-- Icons -->
        <div class="nav-icons">
            <button class="nav-icon-btn" id="search-toggle" aria-label="Search">
                <i class="fa-regular fa-magnifying-glass"></i>
            </button>
            <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>" class="nav-icon-btn" aria-label="Account">
                <i class="fa-regular fa-circle-user"></i>
            </a>
            <button class="nav-icon-btn" id="wishlist-nav-btn" aria-label="Wishlist">
                <i class="fa-regular fa-heart"></i>
            </button>
            <button class="nav-icon-btn" id="cart-toggle" aria-label="Cart">
                <i class="fa-regular fa-bag-shopping"></i>
                <span class="cart-badge" id="cart-count">
                    <?php echo WC()->cart ? WC()->cart->get_cart_contents_count() : 0; ?>
                </span>
            </button>
            <button class="nav-hamburger" id="nav-hamburger" aria-label="Menu" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</nav>

<!-- Mobile Menu -->
<div id="mobile-menu" role="dialog" aria-label="Mobile Navigation">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
    <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>">Shop</a>
    <a href="<?php echo esc_url( home_url( '/collections/' ) ); ?>">Collections</a>
    <a href="<?php echo esc_url( home_url( '/new-arrivals/' ) ); ?>">New Arrivals</a>
    <a href="<?php echo esc_url( home_url( '/best-sellers/' ) ); ?>">Best Sellers</a>
    <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About</a>
    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a>
    <a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>">FAQ</a>
</div>

<!-- Cart Drawer -->
<div id="cart-overlay" role="dialog" aria-label="Shopping Cart"></div>
<div id="cart-drawer">
    <div class="cart-header">
        <h3>Your Cart</h3>
        <button class="cart-close" id="cart-close" aria-label="Close cart">✕</button>
    </div>
    <div class="cart-body" id="cart-drawer-body">
        <?php
        if ( WC()->cart && ! WC()->cart->is_empty() ) :
            foreach ( WC()->cart->get_cart() as $key => $item ) :
                $prod = wc_get_product( $item['product_id'] );
                $img  = get_the_post_thumbnail_url( $item['product_id'], 'thumbnail' );
                ?>
                <div class="cart-item">
                    <?php if ( $img ) : ?>
                        <img class="cart-item-img" src="<?php echo esc_url( $img ); ?>" alt="">
                    <?php else : ?>
                        <div class="cart-item-img" style="background:#f0ede8;display:flex;align-items:center;justify-content:center;color:#aaa;"><i class="fa fa-image"></i></div>
                    <?php endif; ?>
                    <div class="cart-item-info">
                        <h5><?php echo esc_html( $prod->get_name() ); ?></h5>
                        <p class="cart-item-price"><?php echo $prod->get_price_html(); ?></p>
                        <div class="cart-item-qty">
                            <button class="qty-btn">−</button>
                            <span class="qty-num"><?php echo esc_html( $item['quantity'] ); ?></span>
                            <button class="qty-btn">+</button>
                        </div>
                        <button class="cart-remove" data-key="<?php echo esc_attr( $key ); ?>">Remove</button>
                    </div>
                </div>
            <?php endforeach;
        else : ?>
            <div style="text-align:center;padding:3rem;color:var(--clr-muted);">
                <i class="fa-regular fa-bag-shopping fa-3x" style="margin-bottom:1rem;display:block;"></i>
                <p>Your cart is empty.</p>
                <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="btn btn-primary" style="margin-top:1.5rem;display:inline-flex;">Shop Now</a>
            </div>
        <?php endif; ?>
    </div>
    <div class="cart-footer">
        <div class="cart-subtotal">
            <span>Subtotal</span>
            <span><?php echo WC()->cart ? WC()->cart->get_cart_subtotal() : '$0.00'; ?></span>
        </div>
        <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn btn-primary">Checkout</a>
        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="btn btn-outline">View Cart</a>
        <p class="cart-note">Free shipping on orders over $150</p>
    </div>
</div>

<!-- Newsletter Popup -->
<div id="newsletter-popup" role="dialog" aria-label="Newsletter Signup">
    <div class="popup-box">
        <button class="popup-close" id="popup-close" aria-label="Close">✕</button>
        <div class="popup-img">
            <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/collection-one.png" alt="Exclusive offer">
        </div>
        <div class="popup-body">
            <p class="luxe-overline">Members Only</p>
            <h2 class="luxe-h2">Get 15% Off Your First Order</h2>
            <p class="luxe-body">Join our exclusive community and be the first to know about new collections, private sales, and style inspiration.</p>
            <form class="newsletter-form" id="popup-form">
                <input type="email" placeholder="Enter your email" required style="border-radius:2px 0 0 2px;">
                <button type="submit" class="btn btn-accent">Subscribe</button>
            </form>
            <span class="popup-dismiss" id="popup-dismiss">No thanks, I'll pay full price</span>
        </div>
    </div>
</div>

<main id="main-content">
