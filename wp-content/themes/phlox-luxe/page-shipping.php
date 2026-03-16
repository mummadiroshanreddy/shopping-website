<?php
/**
 * Shipping & Returns Page — Phlox Luxe
 * Template Name: Shipping
 */
get_header();
?>
<div class="page-hero">
    <div class="luxe-container">
        <p class="luxe-overline">Delivery & Returns</p>
        <h1 class="luxe-h1">Shipping & Returns</h1>
        <div class="breadcrumb">
            <a href="<?php echo esc_url( home_url('/') ); ?>">Home</a>
            <span class="breadcrumb-sep">/</span>
            <span>Shipping & Returns</span>
        </div>
    </div>
</div>
<section class="section-lg">
    <div class="luxe-container" style="max-width:860px;">
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;margin-bottom:4rem;">
            <?php
            $info = [
                ['<i class="fa-regular fa-truck-fast fa-2x" style="color:var(--clr-accent);margin-bottom:1rem;display:block;"></i>', 'Free Shipping', 'On all orders over $150. Standard delivery 5–7 business days.'],
                ['<i class="fa-regular fa-arrow-rotate-left fa-2x" style="color:var(--clr-accent);margin-bottom:1rem;display:block;"></i>', 'Free Returns', '30-day hassle-free returns. No restocking fees, ever.'],
                ['<i class="fa-regular fa-bolt fa-2x" style="color:var(--clr-accent);margin-bottom:1rem;display:block;"></i>', 'Express Option', '2–3 business day delivery available at checkout.'],
            ];
            foreach ($info as $i) : ?>
            <div style="text-align:center;padding:2rem;background:var(--clr-surface);border:1px solid var(--clr-border);border-radius:var(--radius-md);">
                <?php echo $i[0]; ?>
                <h4 style="font-weight:700;margin-bottom:0.5rem;"><?php echo $i[1]; ?></h4>
                <p class="luxe-body" style="font-size:0.88rem;"><?php echo $i[2]; ?></p>
            </div>
            <?php endforeach; ?>
        </div>

        <h2 style="font-family:var(--font-serif);font-size:1.8rem;margin-bottom:1.5rem;">Shipping Information</h2>
        <div class="faq-item">
            <button class="faq-question">Processing Time <span class="faq-icon">+</span></button>
            <div class="faq-answer"><p>All orders are processed within 1–2 business days. Orders placed before 12pm EST on weekdays typically ship the same day.</p></div>
        </div>
        <div class="faq-item">
            <button class="faq-question">Domestic Shipping Rates <span class="faq-icon">+</span></button>
            <div class="faq-answer"><p>Standard (5–7 days): $9.99. Express (2–3 days): $19.99. Overnight: $39.99. Free standard shipping on orders over $150.</p></div>
        </div>
        <div class="faq-item">
            <button class="faq-question">International Shipping <span class="faq-icon">+</span></button>
            <div class="faq-answer"><p>We ship to 80+ countries. International rates are calculated at checkout. Delivery typically takes 7–14 business days. Import duties may apply.</p></div>
        </div>

        <h2 style="font-family:var(--font-serif);font-size:1.8rem;margin:3rem 0 1.5rem;">Return Policy</h2>
        <div class="faq-item">
            <button class="faq-question">30-Day Returns <span class="faq-icon">+</span></button>
            <div class="faq-answer"><p>Changed your mind? Return any unused, unwashed item in original packaging within 30 days of delivery for a full refund.</p></div>
        </div>
        <div class="faq-item">
            <button class="faq-question">How to Return <span class="faq-icon">+</span></button>
            <div class="faq-answer"><p>Email returns@yourbrand.com with your order number. We'll send a prepaid label within 24 hours. Drop it at any post office.</p></div>
        </div>
        <div class="faq-item">
            <button class="faq-question">Refund Timeline <span class="faq-icon">+</span></button>
            <div class="faq-answer"><p>Refunds are processed within 3–5 business days of receiving your return. You'll receive an email confirmation once issued.</p></div>
        </div>
    </div>
</section>
<?php get_footer(); ?>
