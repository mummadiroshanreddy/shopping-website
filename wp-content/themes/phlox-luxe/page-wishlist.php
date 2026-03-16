<?php
/**
 * Wishlist Page — Phlox Luxe
 * Template Name: Wishlist
 */
get_header();
global $product;
$wishlist_ids = [];
// Get wishlist from cookie or session (for server-side rendering hint)
?>
<div class="page-hero">
    <div class="luxe-container">
        <p class="luxe-overline">Saved Items</p>
        <h1 class="luxe-h1">My Wishlist</h1>
        <div class="breadcrumb">
            <a href="<?php echo esc_url( home_url('/') ); ?>">Home</a>
            <span class="breadcrumb-sep">/</span>
            <span>Wishlist</span>
        </div>
    </div>
</div>
<section class="section-lg">
    <div class="luxe-container">
        <div id="wishlist-container">
            <!-- JS-driven wishlist rendered on client side -->
            <script>
            (function() {
                const ids = JSON.parse(localStorage.getItem('luxe_wishlist') || '[]');
                if (!ids.length) {
                    document.getElementById('wishlist-container').innerHTML = `
                        <div style="text-align:center;padding:5rem 0;">
                            <i class="fa-regular fa-heart fa-4x" style="color:var(--clr-border);margin-bottom:1.5rem;display:block;"></i>
                            <h3 style="font-family:var(--font-serif);font-size:1.6rem;margin-bottom:0.8rem;">Your wishlist is empty</h3>
                            <p style="color:var(--clr-muted);margin-bottom:2rem;">Save items you love and come back to them anytime.</p>
                            <a href="<?php echo esc_url( get_permalink( wc_get_page_id('shop') ) ); ?>" class="btn btn-primary">Start Shopping</a>
                        </div>`;
                }
            })();
            </script>

            <?php
            // Server-side: show all published products (client JS will filter by wishlist IDs)
            // A real implementation would use cookies. Here we show the grid for site preview.
            $all_products = new WP_Query([
                'post_type'      => 'product',
                'posts_per_page' => -1,
                'post_status'    => 'publish',
            ]);
            if ($all_products->have_posts()) :
            ?>
            <p style="color:var(--clr-muted);margin-bottom:2rem;font-size:0.85rem;">Your saved items appear here. Items are stored locally on this device.</p>
            <div class="products-grid" id="wishlist-grid">
                <?php while ($all_products->have_posts()) : $all_products->the_post(); ?>
                    <div class="product-card reveal" data-product-id="<?php echo get_the_ID(); ?>" style="display:none;">
                        <?php luxe_product_card(get_the_ID(), ''); ?>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <script>
            (function() {
                const ids = JSON.parse(localStorage.getItem('luxe_wishlist') || '[]');
                const cards = document.querySelectorAll('#wishlist-grid [data-product-id]');
                let shown = 0;
                cards.forEach(c => { if (ids.includes(c.dataset.productId)) { c.style.display = ''; shown++; } });
                if (!shown) {
                    document.getElementById('wishlist-grid').style.display = 'none';
                }
            })();
            </script>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>
