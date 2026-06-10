<?php
/**
 * 404 Template
 *
 * @package sanjeep-portfolio
 */

get_header();
?>

<!-- ═══════════════════════════════════
     404 PAGE
════════════════════════════════════ -->
<section class="relative min-h-screen flex flex-col items-center justify-center
                px-6 text-center overflow-hidden"
         aria-labelledby="error-heading">

    <!-- Background grid -->
    <div class="hero-grid" aria-hidden="true"></div>
    <div class="hero-orb" style="top:-200px;right:-100px;" aria-hidden="true"></div>
    <div class="hero-orb" style="bottom:-200px;left:-100px;background:radial-gradient(circle,rgba(255,107,53,0.05) 0%,transparent 70%);" aria-hidden="true"></div>

    <div class="relative z-10 flex flex-col items-center gap-6 max-w-lg">

        <!-- Giant 404 -->
        <div class="relative select-none" aria-hidden="true">
            <span class="font-display font-extrabold text-sp-text-primary block leading-none"
                  style="font-size:clamp(7rem,20vw,14rem);letter-spacing:-0.06em;
                         -webkit-text-stroke:1px rgba(200,240,74,0.2)">
                404
            </span>
            <!-- Glitch layer -->
            <span class="font-display font-extrabold text-sp-accent block leading-none
                         absolute inset-0 opacity-10 blur-sm"
                  style="font-size:clamp(7rem,20vw,14rem);letter-spacing:-0.06em">
                404
            </span>
        </div>

        <!-- Label -->
        <div class="section-label justify-center" style="margin-bottom:0">
            <?php esc_html_e( 'Page not found', 'sanjeep-portfolio' ); ?>
        </div>

        <!-- Heading -->
        <h1 id="error-heading"
            class="font-display font-extrabold text-sp-text-primary leading-none"
            style="font-size:clamp(1.8rem,4vw,2.8rem);letter-spacing:-0.03em">
            <?php esc_html_e( "Lost in the mountains?", 'sanjeep-portfolio' ); ?>
        </h1>

        <!-- Sub text -->
        <p class="text-sp-text-secondary font-light leading-relaxed" style="font-size:1rem;max-width:380px">
            <?php esc_html_e( "The page you're looking for doesn't exist or has been moved. Let's get you back on track.", 'sanjeep-portfolio' ); ?>
        </p>

        <!-- Actions -->
        <div class="flex flex-wrap gap-3 justify-center mt-4">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
               class="btn-primary">
                ← <?php esc_html_e( 'Back home', 'sanjeep-portfolio' ); ?>
            </a>
            <a href="<?php echo esc_url( home_url( '/#work' ) ); ?>"
               class="btn-ghost">
                <?php esc_html_e( 'View work', 'sanjeep-portfolio' ); ?>
            </a>
        </div>

        <!-- Quick links -->
        <div class="flex flex-col gap-0 w-full max-w-xs mt-8 border-t border-sp-border pt-8">
            <p class="font-mono text-[0.6rem] tracking-widest uppercase text-sp-text-muted mb-4">
                <?php esc_html_e( 'Or go to', 'sanjeep-portfolio' ); ?>
            </p>
            <?php
            $quick_links = [
                '#about'      => __( 'About',      'sanjeep-portfolio' ),
                '#services'   => __( 'Services',   'sanjeep-portfolio' ),
                '#work'       => __( 'Work',        'sanjeep-portfolio' ),
                '#experience' => __( 'Experience', 'sanjeep-portfolio' ),
                '#contact'    => __( 'Contact',     'sanjeep-portfolio' ),
            ];
            foreach ( $quick_links as $href => $label ) :
            ?>
            <a href="<?php echo esc_url( home_url( '/' ) . $href ); ?>"
               class="flex items-center justify-between py-3 border-b border-sp-border
                      font-mono text-[0.7rem] tracking-wide text-sp-text-secondary no-underline
                      hover:text-sp-text-primary hover:pl-3 transition-all duration-200 group">
                <span><?php echo esc_html( $label ); ?></span>
                <span class="text-sp-text-muted group-hover:text-sp-accent transition-colors duration-200"
                      aria-hidden="true">↗</span>
            </a>
            <?php endforeach; ?>
        </div>

        <!-- Error code watermark -->
        <p class="font-mono text-[0.55rem] tracking-[0.2em] uppercase text-sp-text-muted mt-8 opacity-40">
            <?php esc_html_e( 'Error 404 · Page not found', 'sanjeep-portfolio' ); ?>
        </p>
    </div>
</section>

<?php get_footer(); ?>
