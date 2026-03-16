</main><!-- #main-content -->

<!-- ============================================
     FOOTER
     ============================================ -->
<footer id="luxe-footer">
    <div class="luxe-container">
        <div class="footer-grid">

            <!-- Brand -->
            <div class="footer-brand">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-logo">
                    <?php bloginfo( 'name' ); ?><span>.</span>
                </a>
                <p>Crafted for those who believe that quality is never an accident. Premium essentials, elevated design, timeless style.</p>
                <div class="footer-social">
                    <a href="#" class="social-link" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="social-link" aria-label="Pinterest"><i class="fa-brands fa-pinterest"></i></a>
                    <a href="#" class="social-link" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="#" class="social-link" aria-label="Twitter / X"><i class="fa-brands fa-x-twitter"></i></a>
                </div>
            </div>

            <!-- Shop -->
            <div class="footer-col">
                <h5>Shop</h5>
                <ul>
                    <li><a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>">All Products</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/collections/' ) ); ?>">Collections</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/new-arrivals/' ) ); ?>">New Arrivals</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/best-sellers/' ) ); ?>">Best Sellers</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/sale/' ) ); ?>">Sale</a></li>
                </ul>
            </div>

            <!-- Help -->
            <div class="footer-col">
                <h5>Help</h5>
                <ul>
                    <li><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>">FAQ</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/shipping/' ) ); ?>">Shipping & Returns</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/track-order/' ) ); ?>">Track Order</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact Us</a></li>
                    <li><a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>">My Account</a></li>
                </ul>
            </div>

            <!-- Company -->
            <div class="footer-col">
                <h5>Company</h5>
                <ul>
                    <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About Us</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/sustainability/' ) ); ?>">Sustainability</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/press/' ) ); ?>">Press</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/careers/' ) ); ?>">Careers</a></li>
                    <li><a href="<?php echo esc_url( get_privacy_policy_url() ); ?>">Privacy Policy</a></li>
                </ul>
            </div>

        </div><!-- .footer-grid -->

        <div class="footer-bottom">
            <p>© <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</p>
            <div class="footer-payments">
                <div class="payment-icon">VISA</div>
                <div class="payment-icon">MC</div>
                <div class="payment-icon">AMEX</div>
                <div class="payment-icon">PayPal</div>
                <div class="payment-icon">Apple</div>
                <div class="payment-icon">Google</div>
            </div>
        </div>

    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
