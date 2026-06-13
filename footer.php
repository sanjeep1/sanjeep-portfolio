</main><!-- #main -->

<!-- ════════════ FOOTER ════════════════════════════════════════ -->
<footer class="border-t border-sp-border px-16 py-8 flex items-center justify-between
               flex-col gap-4 sm:flex-row" role="contentinfo">

    <p class="font-mono text-xs tracking-widest text-sp-text-muted">
        &copy; <?php echo date( 'Y' ); ?>
        <a href="<?php echo esc_url( home_url() ); ?>"
           class="hover:text-sp-accent transition-colors duration-200">
            <?php bloginfo( 'name' ); ?>
        </a><span class="text-sp-accent">.</span>
    </p>

    <nav aria-label="<?php esc_attr_e( 'Footer', 'sanjeep-portfolio' ); ?>"
         class="flex gap-8">
        <a href="#hero"    class="footer-link"><?php esc_html_e( 'Top', 'sanjeep-portfolio' ); ?></a>
        <a href="#work"    class="footer-link"><?php esc_html_e( 'Work', 'sanjeep-portfolio' ); ?></a>
        <a href="#contact" class="footer-link"><?php esc_html_e( 'Contact', 'sanjeep-portfolio' ); ?></a>
        <?php
        $github = get_field( 'contact_github' );
        if ( $github ) : ?>
            <a href="<?php echo esc_url( $github ); ?>" target="_blank" rel="noopener"
               class="footer-link">GitHub</a>
        <?php endif; ?>
    </nav>
</footer>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const toggle = document.getElementById('sp-menu-toggle');
    const menu = document.getElementById('sp-mobile-menu');

    if (!toggle || !menu) return;

    toggle.addEventListener('click', function () {
        const isOpen = menu.classList.contains('translate-x-0');

        if (isOpen) {
            menu.classList.remove('translate-x-0');
            menu.classList.add('translate-x-full');
            toggle.setAttribute('aria-expanded', 'false');
        } else {
            menu.classList.remove('translate-x-full');
            menu.classList.add('translate-x-0');
            toggle.setAttribute('aria-expanded', 'true');
        }
    });

});
</script>
<?php wp_footer(); ?>
</body>
</html>
