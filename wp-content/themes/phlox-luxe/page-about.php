<?php
/**
 * About Page Template — Phlox Luxe
 * Template Name: About
 */
get_header();
?>
<!-- Page Hero -->
<div class="page-hero">
    <div class="luxe-container">
        <p class="luxe-overline">Who We Are</p>
        <h1 class="luxe-h1">Our Story</h1>
        <div class="breadcrumb">
            <a href="<?php echo esc_url( home_url('/') ); ?>">Home</a>
            <span class="breadcrumb-sep">/</span>
            <span>About</span>
        </div>
    </div>
</div>

<!-- Brand Hero -->
<section class="section-lg">
    <div class="luxe-container">
        <div class="about-hero">
            <div class="reveal">
                <p class="luxe-overline">Our Mission</p>
                <h2 class="luxe-h1">Built on a Belief<br>That Craft Matters.</h2>
                <p class="luxe-body" style="margin:1.5rem 0;">We started this brand because we were tired of choosing between quality and sustainability. Between style and substance. We believed there was a better way — and we built it.</p>
                <p class="luxe-body" style="margin-bottom:2rem;">Every product we design starts with a question: would we be proud to wear this in 10 years? If the answer is no, we start over. This relentless pursuit of excellence defines everything we do.</p>
                <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="btn btn-primary">Shop The Collection</a>
            </div>
            <div class="reveal reveal-delay-2">
                <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/about-brand.png" alt="Our craft" style="border-radius:var(--radius-md);box-shadow:var(--shadow-lg);width:100%;">
            </div>
        </div>
    </div>
</section>

<!-- Stats -->
<section class="section" style="background:var(--clr-dark);color:#fff;text-align:center;">
    <div class="luxe-container">
        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:2rem;">
            <?php foreach([
                ['10+','Years of Experience'],
                ['50K+','Happy Customers'],
                ['100%','Sustainable Materials'],
                ['30','Day Return Policy']
            ] as $stat) : ?>
            <div class="reveal">
                <div style="font-family:var(--font-serif);font-size:clamp(2rem,4vw,3.5rem);font-weight:700;color:var(--clr-accent);margin-bottom:0.4rem;"><?php echo $stat[0]; ?></div>
                <p style="font-size:0.82rem;letter-spacing:0.10em;text-transform:uppercase;color:rgba(255,255,255,0.6);"><?php echo $stat[1]; ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Values -->
<section class="section-lg">
    <div class="luxe-container">
        <div class="section-header reveal">
            <p class="luxe-overline">What Drives Us</p>
            <h2 class="luxe-h1">Our Core Values</h2>
        </div>
        <div class="about-values">
            <div class="value-card reveal reveal-delay-1">
                <div class="value-icon"><i class="fa-regular fa-gem"></i></div>
                <h4>Uncompromising Quality</h4>
                <p class="luxe-body" style="font-size:0.88rem;">We source only the finest materials and work with master artisans who share our obsession for perfection.</p>
            </div>
            <div class="value-card reveal reveal-delay-2">
                <div class="value-icon"><i class="fa-regular fa-leaf"></i></div>
                <h4>Sustainable Future</h4>
                <p class="luxe-body" style="font-size:0.88rem;">Every decision we make considers its impact on the planet. Premium doesn't have to mean wasteful.</p>
            </div>
            <div class="value-card reveal reveal-delay-3">
                <div class="value-icon"><i class="fa-regular fa-heart"></i></div>
                <h4>Customer First</h4>
                <p class="luxe-body" style="font-size:0.88rem;">You are at the heart of everything we do. From design to delivery, your experience is our priority.</p>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter CTA -->
<section class="newsletter-section">
    <div class="luxe-container">
        <div class="reveal">
            <p class="luxe-overline">Stay Connected</p>
            <h2 class="luxe-h2">Be the First to Know</h2>
            <p class="luxe-body">New collections, exclusive collaborations, and behind-the-scenes stories.</p>
            <form class="newsletter-form">
                <input type="email" placeholder="Your email address" required>
                <button type="submit" class="btn btn-accent">Join</button>
            </form>
        </div>
    </div>
</section>

<?php get_footer(); ?>
