<?php
/**
 * Contact Page Template — Phlox Luxe
 * Template Name: Contact
 */
get_header();
?>
<div class="page-hero">
    <div class="luxe-container">
        <p class="luxe-overline">Get In Touch</p>
        <h1 class="luxe-h1">Contact Us</h1>
        <div class="breadcrumb">
            <a href="<?php echo esc_url( home_url('/') ); ?>">Home</a>
            <span class="breadcrumb-sep">/</span>
            <span>Contact</span>
        </div>
    </div>
</div>

<section class="section-lg">
    <div class="luxe-container">
        <div class="contact-layout">
            <div class="contact-info reveal">
                <p class="luxe-overline" style="margin-bottom:0.5rem;">We'd Love to Hear From You</p>
                <h2>Let's Talk</h2>
                <p class="luxe-body" style="margin:1rem 0 2rem;">Whether you have a question about your order, a product inquiry, or just want to say hello — our team is here for you.</p>
                <div class="contact-detail">
                    <span class="contact-icon"><i class="fa-regular fa-envelope"></i></span>
                    <div>
                        <strong style="display:block;font-size:0.78rem;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:0.2rem;">Email</strong>
                        <a href="mailto:hello@yourbrand.com" style="color:var(--clr-mid);">hello@yourbrand.com</a>
                    </div>
                </div>
                <div class="contact-detail">
                    <span class="contact-icon"><i class="fa-regular fa-phone"></i></span>
                    <div>
                        <strong style="display:block;font-size:0.78rem;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:0.2rem;">Phone</strong>
                        <span style="color:var(--clr-mid);">+1 (800) 000-0000</span>
                    </div>
                </div>
                <div class="contact-detail">
                    <span class="contact-icon"><i class="fa-regular fa-clock"></i></span>
                    <div>
                        <strong style="display:block;font-size:0.78rem;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:0.2rem;">Hours</strong>
                        <span style="color:var(--clr-mid);">Mon–Fri: 9am – 6pm EST</span>
                    </div>
                </div>
                <div style="margin-top:2rem;">
                    <h5 style="font-size:0.78rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;margin-bottom:1rem;">Quick Links</h5>
                    <div style="display:flex;flex-direction:column;gap:0.5rem;">
                        <a href="<?php echo esc_url( home_url('/faq/') ); ?>" class="btn btn-ghost" style="display:inline-block;">View FAQ →</a>
                        <a href="<?php echo esc_url( home_url('/shipping/') ); ?>" class="btn btn-ghost" style="display:inline-block;margin-top:0.5rem;">Shipping & Returns →</a>
                        <a href="<?php echo esc_url( home_url('/track-order/') ); ?>" class="btn btn-ghost" style="display:inline-block;margin-top:0.5rem;">Track My Order →</a>
                    </div>
                </div>
            </div>

            <div class="contact-form-box reveal reveal-delay-2">
                <form class="luxe-contact-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="contact-fname">First Name *</label>
                            <input type="text" id="contact-fname" name="fname" required placeholder="First name">
                        </div>
                        <div class="form-group">
                            <label for="contact-lname">Last Name *</label>
                            <input type="text" id="contact-lname" name="lname" required placeholder="Last name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contact-email">Email Address *</label>
                        <input type="email" id="contact-email" name="email" required placeholder="your@email.com">
                    </div>
                    <div class="form-group">
                        <label for="contact-order">Order Number (if applicable)</label>
                        <input type="text" id="contact-order" name="order" placeholder="#000000">
                    </div>
                    <div class="form-group">
                        <label for="contact-subject">Subject *</label>
                        <select id="contact-subject" name="subject" required>
                            <option value="">Select a topic…</option>
                            <option>Order Status</option>
                            <option>Return / Exchange</option>
                            <option>Product Question</option>
                            <option>Shipping Issue</option>
                            <option>Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="contact-msg">Message *</label>
                        <textarea id="contact-msg" name="message" required placeholder="How can we help you?"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;">Send Message <i class="fa-regular fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>
