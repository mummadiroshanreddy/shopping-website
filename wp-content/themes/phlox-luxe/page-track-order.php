<?php
/**
 * Track Order Page — Phlox Luxe
 * Template Name: Track Order
 */
get_header();
?>
<div class="page-hero">
    <div class="luxe-container">
        <p class="luxe-overline">Where's My Order?</p>
        <h1 class="luxe-h1">Track Your Order</h1>
        <div class="breadcrumb">
            <a href="<?php echo esc_url( home_url('/') ); ?>">Home</a>
            <span class="breadcrumb-sep">/</span>
            <span>Track Order</span>
        </div>
    </div>
</div>
<section class="section-lg">
    <div class="luxe-container" style="max-width:580px;text-align:center;">
        <p class="luxe-overline" style="margin-bottom:0.5rem;">Real-Time Updates</p>
        <h2 style="font-family:var(--font-serif);font-size:2rem;margin-bottom:1rem;">Find Your Package</h2>
        <p class="luxe-body" style="margin-bottom:2.5rem;">Enter your order number and email address to see the real-time status of your shipment.</p>
        <form class="luxe-track-form" style="display:flex;flex-direction:column;gap:1rem;">
            <div class="form-group" style="text-align:left;">
                <label for="track-order">Order Number *</label>
                <input type="text" id="track-order" placeholder="#000000" required>
            </div>
            <div class="form-group" style="text-align:left;">
                <label for="track-email">Email Address *</label>
                <input type="email" id="track-email" placeholder="your@email.com" required>
            </div>
            <button type="submit" class="btn btn-primary" style="justify-content:center;">Track Order <i class="fa-regular fa-magnifying-glass"></i></button>
        </form>
        <div style="margin-top:3rem;padding:2rem;background:var(--clr-accent-lt);border-radius:var(--radius-md);">
            <p style="font-size:0.85rem;color:var(--clr-mid);">
                <strong>Can't find your order number?</strong><br>
                Check your confirmation email or <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" style="color:var(--clr-accent);">log in to your account</a>.
            </p>
        </div>
        <div style="margin-top:2rem;">
            <p style="font-size:0.85rem;color:var(--clr-muted);">Still need help? <a href="<?php echo esc_url( home_url('/contact/') ); ?>" style="color:var(--clr-accent);">Contact our support team</a></p>
        </div>
    </div>
</section>
<?php get_footer(); ?>
