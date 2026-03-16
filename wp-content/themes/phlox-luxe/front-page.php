<?php
/**
 * Front Page Template — Phlox Luxe
 * Template Name: Front Page
 */
get_header();
?>

<!-- ================================================
     HERO SECTION
     ================================================ -->
<section id="luxe-hero">
    <div class="hero-bg"></div>
    <div class="luxe-container">
        <div class="hero-content">
            <p class="luxe-overline">New Season — 2025</p>
            <h1 class="luxe-display">Wear the<br>Extraordinary.</h1>
            <p class="luxe-body">Premium essentials crafted for the modern individual.<br>Quality you can feel. Style you can own.</p>
            <div class="hero-ctas">
                <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="btn btn-primary">
                    Shop Now <i class="fa-regular fa-arrow-right"></i>
                </a>
                <a href="<?php echo esc_url( home_url( '/collections/' ) ); ?>" class="btn btn-outline" style="color:#fff;border-color:rgba(255,255,255,0.5);">
                    Explore Collections
                </a>
            </div>
        </div>
    </div>
    <!-- Scroll indicator -->
    <div style="position:absolute;bottom:2.5rem;left:50%;transform:translateX(-50%);z-index:2;text-align:center;color:rgba(255,255,255,0.5);font-size:0.72rem;letter-spacing:0.15em;text-transform:uppercase;animation:bounce 2s infinite;">
        <i class="fa-regular fa-chevron-down fa-lg" style="display:block;margin-bottom:0.3rem;"></i>
        Scroll
    </div>
</section>

<style>
@keyframes bounce { 0%,100%{transform:translateX(-50%) translateY(0)} 50%{transform:translateX(-50%) translateY(8px)} }
</style>

<!-- ================================================
     FEATURED COLLECTIONS
     ================================================ -->
<section class="section-lg">
    <div class="luxe-container">
        <div class="section-header reveal">
            <p class="luxe-overline">Curated For You</p>
            <h2 class="luxe-h1">Shop by Collection</h2>
        </div>
        <div class="collections-grid">
            <div class="collection-card reveal reveal-delay-1">
                <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/collection-one.png" alt="Wardrobe Essentials" loading="lazy">
                <div class="collection-card-body">
                    <p class="luxe-overline">Category 01</p>
                    <h3>Wardrobe Essentials</h3>
                    <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="btn btn-ghost">Explore →</a>
                </div>
            </div>
            <div class="collection-card reveal reveal-delay-2">
                <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/collection-two.png" alt="Luxury Accessories" loading="lazy">
                <div class="collection-card-body">
                    <p class="luxe-overline">Category 02</p>
                    <h3>Luxury Accessories</h3>
                    <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="btn btn-ghost">Explore →</a>
                </div>
            </div>
            <div class="collection-card reveal reveal-delay-3">
                <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/collection-three.png" alt="Home & Lifestyle" loading="lazy">
                <div class="collection-card-body">
                    <p class="luxe-overline">Category 03</p>
                    <h3>Home & Lifestyle</h3>
                    <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="btn btn-ghost">Explore →</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================================================
     BEST SELLERS
     ================================================ -->
<section class="section" style="background:var(--clr-surface);">
    <div class="luxe-container">
        <div class="section-header reveal" style="display:flex;align-items:flex-end;justify-content:space-between;text-align:left;margin-bottom:var(--sp-md);">
            <div>
                <p class="luxe-overline">Customer Favourites</p>
                <h2 class="luxe-h1">Best Sellers</h2>
            </div>
            <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="btn btn-ghost">View All →</a>
        </div>
        <div class="products-grid">
            <?php
            $best = new WP_Query( [
                'post_type'      => 'product',
                'posts_per_page' => 4,
                'meta_key'       => 'total_sales',
                'orderby'        => 'meta_value_num',
                'order'          => 'DESC',
            ] );
            if ( $best->have_posts() ) :
                while ( $best->have_posts() ) : $best->the_post();
                    luxe_product_card( get_the_ID(), 'Best Seller' );
                endwhile;
                wp_reset_postdata();
            else :
                // Placeholder cards if no products
                for ( $i = 0; $i < 4; $i++ ) : ?>
                    <div class="product-card reveal">
                        <div class="product-card-img" style="background:#f0ede8;aspect-ratio:3/4;display:flex;align-items:center;justify-content:center;color:#ccc;">
                            <i class="fa-regular fa-image fa-3x"></i>
                        </div>
                        <div class="product-card-body">
                            <p class="product-category">Category</p>
                            <h4>Premium Product Name</h4>
                            <div class="product-price"><span class="current">$129.00</span></div>
                            <div class="product-rating"><span class="stars">★★★★★</span><span class="count">(48)</span></div>
                        </div>
                    </div>
                <?php endfor;
            endif;
            ?>
        </div>
    </div>
</section>

<!-- ================================================
     LIFESTYLE BANNER
     ================================================ -->
<section class="section-lg lifestyle-banner">
    <div class="lifestyle-banner-bg"></div>
    <div class="luxe-container">
        <div class="lifestyle-banner-content">
            <p class="luxe-overline">The New Standard</p>
            <h2 class="luxe-h1">Quality Without<br>Compromise.</h2>
            <p class="luxe-body" style="margin-bottom:2rem;">We obsess over every detail so you don't have to.<br>Premium materials. Responsible sourcing. Lasting design.</p>
            <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="btn btn-accent">Our Story →</a>
        </div>
    </div>
</section>

<!-- ================================================
     NEW ARRIVALS
     ================================================ -->
<section class="section-lg">
    <div class="luxe-container">
        <div class="section-header reveal" style="display:flex;align-items:flex-end;justify-content:space-between;text-align:left;margin-bottom:var(--sp-md);">
            <div>
                <p class="luxe-overline">Just Dropped</p>
                <h2 class="luxe-h1">New Arrivals</h2>
            </div>
            <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="btn btn-ghost">View All →</a>
        </div>
        <div class="products-grid">
            <?php
            $new_arrivals = new WP_Query( [
                'post_type'      => 'product',
                'posts_per_page' => 4,
                'orderby'        => 'date',
                'order'          => 'DESC',
            ] );
            if ( $new_arrivals->have_posts() ) :
                while ( $new_arrivals->have_posts() ) : $new_arrivals->the_post();
                    luxe_product_card( get_the_ID(), 'New' );
                endwhile;
                wp_reset_postdata();
            else :
                for ( $i = 0; $i < 4; $i++ ) : ?>
                    <div class="product-card reveal">
                        <div class="product-card-img" style="background:#f0ede8;aspect-ratio:3/4;display:flex;align-items:center;justify-content:center;color:#ccc;">
                            <span class="product-badge new">New</span>
                            <i class="fa-regular fa-image fa-3x"></i>
                        </div>
                        <div class="product-card-body">
                            <p class="product-category">New</p>
                            <h4>New Season Product</h4>
                            <div class="product-price"><span class="current">$189.00</span></div>
                            <div class="product-rating"><span class="stars">★★★★★</span><span class="count">(12)</span></div>
                        </div>
                    </div>
                <?php endfor;
            endif;
            ?>
        </div>
    </div>
</section>

<!-- ================================================
     TRUST STRIP
     ================================================ -->
<section class="section" style="background:var(--clr-surface);">
    <div class="luxe-container">
        <div class="trust-strip reveal">
            <div class="trust-item">
                <div class="trust-icon"><i class="fa-regular fa-truck-fast"></i></div>
                <h5>Free Shipping</h5>
                <p>On all orders over $150</p>
            </div>
            <div class="trust-item">
                <div class="trust-icon"><i class="fa-regular fa-shield-check"></i></div>
                <h5>Secure Payments</h5>
                <p>256-bit SSL encryption</p>
            </div>
            <div class="trust-item">
                <div class="trust-icon"><i class="fa-regular fa-arrow-rotate-left"></i></div>
                <h5>Easy Returns</h5>
                <p>30-day hassle-free returns</p>
            </div>
            <div class="trust-item">
                <div class="trust-icon"><i class="fa-regular fa-headset"></i></div>
                <h5>24/7 Support</h5>
                <p>Real humans, always ready</p>
            </div>
        </div>
    </div>
</section>

<!-- ================================================
     BRAND STORYTELLING
     ================================================ -->
<section class="section-lg">
    <div class="luxe-container">
        <div class="about-hero">
            <div class="reveal">
                <p class="luxe-overline">Our Craft</p>
                <h2 class="luxe-h1">Every Detail<br>Deliberately Chosen.</h2>
                <p class="luxe-body" style="margin:1.5rem 0;">From the sourcing of materials to the final stitch, we believe that true luxury lies in the details that most people never notice — but never forget.</p>
                <p class="luxe-body" style="margin-bottom:2rem;">Our artisans bring decades of expertise to every product we create. This isn't fast fashion. This is craftsmanship, redefined for the modern age.</p>
                <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="btn btn-primary">Learn Our Story →</a>
            </div>
            <div class="reveal reveal-delay-2">
                <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/about-brand.png" alt="Brand craftsmanship" style="width:100%;height:500px;object-fit:cover;border-radius:var(--radius-md);box-shadow:var(--shadow-lg);">
            </div>
        </div>
    </div>
</section>

<!-- ================================================
     TESTIMONIALS
     ================================================ -->
<section class="section-lg" style="background:var(--clr-accent-lt);">
    <div class="luxe-container">
        <div class="section-header reveal">
            <p class="luxe-overline">Social Proof</p>
            <h2 class="luxe-h1">What Our Customers Say</h2>
        </div>
        <div class="testimonials-grid">
            <div class="testimonial-card reveal reveal-delay-1">
                <div class="testimonial-stars">★★★★★</div>
                <div class="testimonial-quote">"</div>
                <p class="testimonial-text">The quality is absolutely exceptional. I've never received so many compliments on a single piece of clothing before. Worth every penny.</p>
                <div class="testimonial-author">
                    <div class="author-avatar">S</div>
                    <div class="author-info">
                        <p class="author-name">Sophia R.</p>
                        <p class="author-tag">Verified Buyer · New York</p>
                    </div>
                </div>
            </div>
            <div class="testimonial-card reveal reveal-delay-2">
                <div class="testimonial-stars">★★★★★</div>
                <div class="testimonial-quote">"</div>
                <p class="testimonial-text">Fast shipping, beautiful packaging and even more beautiful products. This brand has genuinely raised the bar for online shopping.</p>
                <div class="testimonial-author">
                    <div class="author-avatar">M</div>
                    <div class="author-info">
                        <p class="author-name">Marcus T.</p>
                        <p class="author-tag">Verified Buyer · London</p>
                    </div>
                </div>
            </div>
            <div class="testimonial-card reveal reveal-delay-3">
                <div class="testimonial-stars">★★★★★</div>
                <div class="testimonial-quote">"</div>
                <p class="testimonial-text">I was skeptical at first but after receiving my order I am completely blown away. The attention to detail is on another level entirely.</p>
                <div class="testimonial-author">
                    <div class="author-avatar">A</div>
                    <div class="author-info">
                        <p class="author-name">Aisha K.</p>
                        <p class="author-tag">Verified Buyer · Dubai</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================================================
     NEWSLETTER
     ================================================ -->
<section class="newsletter-section">
    <div class="luxe-container">
        <div class="reveal">
            <p class="luxe-overline">Join The Inner Circle</p>
            <h2 class="luxe-h2">Unlock Exclusive Access</h2>
            <p class="luxe-body">New arrivals, private sales, and curated style edits — delivered to your inbox.</p>
            <form class="newsletter-form" id="footer-newsletter">
                <input type="email" placeholder="Your email address" required>
                <button type="submit" class="btn btn-accent">Subscribe</button>
            </form>
        </div>
    </div>
</section>

<?php get_footer(); ?>
