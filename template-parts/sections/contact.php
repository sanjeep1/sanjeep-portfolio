<?php
/**
 * Template Part: Contact Section
 */

$subtitle   = get_field( 'contact_subtitle');
$heading   = get_field( 'contact_heading');
$highlight = get_field( 'contact_highlight');
$contact_content= get_field( 'contact_content');
$contact_shortcode= get_field( 'contact_shortcode');
$email     = get_field( 'contact_email');
$phone     = get_field( 'contact_phone');
$github    = get_field( 'contact_github');
$linkedin  = get_field( 'contact_linkedin');
?>

<section id="contact" class="py-28 px-16 grid grid-cols-1 lg:grid-cols-2 gap-24 items-start max-w-screen-xl mx-auto" aria-labelledby="contact-heading">

    <!-- Left: CTA + links -->
    <div>
        <div class="section-label reveal">
            <?php echo $subtitle; ?>
        </div>

        <h2 id="contact-heading" class="contact-big reveal">
            <?php echo $heading; ?><span class="text-sp-accent">.</span>
        </h2>

        <?php if ( $contact_content ) : ?>
        <p class="contact-sub reveal">
            <?php echo esc_html( $contact_content ); ?>
        </p>
        <?php endif; ?>

        <!-- Social / contact links -->
        <div class="flex flex-col reveal" role="list"
             aria-label="<?php esc_attr_e( 'Contact links', 'sanjeep-portfolio' ); ?>">

            <?php if ( $email ) : ?>
            <a href="mailto:<?php echo esc_attr( $email ); ?>"
               class="contact-link" role="listitem">
                <span class="flex items-center gap-3">
                    <?php echo esc_html( $email ); ?>
                    <span class="contact-link-badge">Email</span>
                </span>
                <span class="contact-link-arrow" aria-hidden="true">
                    <svg fill="currentColor" width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M3.293,20.707a1,1,0,0,1,0-1.414L17.586,5H12a1,1,0,0,1,0-2h8a1,1,0,0,1,1,1v8a1,1,0,0,1-2,0V6.414L4.707,20.707a1,1,0,0,1-1.414,0Z"/></svg>
                </span>
            </a>
            <?php endif; ?>

            <?php if ( $phone ) : ?>
            <a href="tel:+977<?php echo esc_attr( $phone ); ?>"
               class="contact-link" role="listitem">
                <span class="flex items-center gap-3">
                    <?php echo esc_html( $phone ); ?>
                    <span class="contact-link-badge">Phone</span>
                </span>
                <span class="contact-link-arrow" aria-hidden="true">
                    <svg fill="currentColor" width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M3.293,20.707a1,1,0,0,1,0-1.414L17.586,5H12a1,1,0,0,1,0-2h8a1,1,0,0,1,1,1v8a1,1,0,0,1-2,0V6.414L4.707,20.707a1,1,0,0,1-1.414,0Z"/></svg>
                </span>
            </a>
            <?php endif; ?>

            <?php if ( $github ) : ?>
            <a href="<?php echo esc_url( $github ); ?>"
               target="_blank" rel="noopener noreferrer"
               class="contact-link" role="listitem"
               aria-label="<?php esc_attr_e( 'GitHub — opens in new tab', 'sanjeep-portfolio' ); ?>">
                <span class="flex items-center gap-3">
                    <?php echo esc_html( str_replace( 'https://', '', $github ) ); ?>
                    <span class="contact-link-badge">GitHub</span>
                </span>
                <span class="contact-link-arrow" aria-hidden="true">
                    <svg fill="currentColor" width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M3.293,20.707a1,1,0,0,1,0-1.414L17.586,5H12a1,1,0,0,1,0-2h8a1,1,0,0,1,1,1v8a1,1,0,0,1-2,0V6.414L4.707,20.707a1,1,0,0,1-1.414,0Z"/></svg>
                </span>
            </a>
            <?php endif; ?>

            <?php if ( $linkedin ) : ?>
            <a href="<?php echo esc_url( $linkedin ); ?>"
               target="_blank" rel="noopener noreferrer"
               class="contact-link" role="listitem"
               aria-label="<?php esc_attr_e( 'LinkedIn — opens in new tab', 'sanjeep-portfolio' ); ?>">
                <span class="flex items-center gap-3">
                    <?php esc_html_e( 'Sanjeep Banjara', 'sanjeep-portfolio' ); ?>
                    <span class="contact-link-badge">LinkedIn</span>
                </span>
                <span class="contact-link-arrow" aria-hidden="true">
                    <svg fill="currentColor" width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M3.293,20.707a1,1,0,0,1,0-1.414L17.586,5H12a1,1,0,0,1,0-2h8a1,1,0,0,1,1,1v8a1,1,0,0,1-2,0V6.414L4.707,20.707a1,1,0,0,1-1.414,0Z"/></svg>
                </span>
            </a>
            <?php endif; ?>

        </div>
    </div>

    <!-- Right: Contact form -->
    <div class="reveal">
        <?php echo do_shortcode($contact_shortcode); ?>
    </div>
</section>
