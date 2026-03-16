<?php
/**
 * FAQ Page Template — Phlox Luxe
 * Template Name: FAQ
 */
get_header();

$faqs = [
    'Shipping' => [
        ['How long does shipping take?', 'Standard shipping takes 5–7 business days. Express shipping (2–3 days) is available at checkout. International orders may take 7–14 business days depending on location.'],
        ['Do you offer free shipping?', 'Yes! We offer free standard shipping on all orders over $150. Orders under $150 have a flat shipping rate of $9.99.'],
        ['Do you ship internationally?', 'We ship to over 80 countries worldwide. International shipping rates and times vary by destination — calculated at checkout.'],
    ],
    'Returns & Exchanges' => [
        ['What is your return policy?', 'We offer a hassle-free 30-day return policy. Items must be unused, unwashed, and in their original packaging with all tags attached.'],
        ['How do I start a return?', 'Email us at returns@yourbrand.com with your order number and reason for return. We\'ll provide a prepaid shipping label within 24 hours.'],
        ['Can I exchange an item?', 'Absolutely! Contact our team and we\'ll arrange an exchange for a different size or color at no additional cost.'],
    ],
    'Payments' => [
        ['What payment methods do you accept?', 'We accept all major credit/debit cards (Visa, Mastercard, Amex), PayPal, Apple Pay, Google Pay, and buy-now-pay-later options.'],
        ['Is my payment information secure?', 'Yes. Our site uses 256-bit SSL encryption. We never store your full card details — all payments are processed securely.'],
        ['Do you offer buy-now-pay-later?', 'Yes! We partner with Klarna and Afterpay to offer interest-free installment plans at checkout.'],
    ],
    'Orders & Tracking' => [
        ['How do I track my order?', 'Once your order ships, you\'ll receive a confirmation email with a tracking link. You can also track your order on our Track Order page.'],
        ['Can I cancel or modify my order?', 'Orders can be modified or cancelled within 1 hour of placement. Contact us immediately via email or call us for urgent changes.'],
        ['What if my order arrives damaged?', 'We\'re so sorry if that happens! Contact us within 7 days with photos and your order number — we\'ll send a replacement immediately.'],
    ],
];
?>
<div class="page-hero">
    <div class="luxe-container">
        <p class="luxe-overline">Got Questions?</p>
        <h1 class="luxe-h1">Frequently Asked Questions</h1>
        <div class="breadcrumb">
            <a href="<?php echo esc_url( home_url('/') ); ?>">Home</a>
            <span class="breadcrumb-sep">/</span>
            <span>FAQ</span>
        </div>
    </div>
</div>

<section class="section-lg">
    <div class="luxe-container" style="max-width:800px;">
        <?php foreach ( $faqs as $category => $questions ) : ?>
            <h3 style="font-family:var(--font-serif);font-size:1.4rem;margin:3rem 0 1rem;color:var(--clr-accent);"><?php echo esc_html( $category ); ?></h3>
            <?php foreach ( $questions as $faq ) : ?>
                <div class="faq-item">
                    <button class="faq-question">
                        <?php echo esc_html( $faq[0] ); ?>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p><?php echo esc_html( $faq[1] ); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endforeach; ?>

        <div style="text-align:center;margin-top:4rem;padding:3rem;background:var(--clr-accent-lt);border-radius:var(--radius-md);">
            <h3 style="font-family:var(--font-serif);font-size:1.4rem;margin-bottom:0.8rem;">Still have questions?</h3>
            <p class="luxe-body" style="margin-bottom:1.5rem;">Our support team is ready to help. We usually respond within a few hours.</p>
            <a href="<?php echo esc_url( home_url('/contact/') ); ?>" class="btn btn-primary">Contact Us</a>
        </div>
    </div>
</section>
<?php get_footer(); ?>
