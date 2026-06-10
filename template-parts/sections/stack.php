<?php
/**
 * Template Part: Tech Stack Section (infinite scroll marquee)
 */

$tech_subtitle = get_field('tech_subtitle');
$tech_heading = get_field('tech_heading');
$stack_items = function_exists( 'get_field' ) ? get_field( 'stack_items') : [];

$defaults = [
    'WordPress','Elementor','React','Tailwind CSS','JavaScript',
    'Python','PHP','ACF Pro','MySQL','Figma','Git',
    'WooCommerce','REST API',
];

$items = ! empty( $stack_items )
    ? array_map( fn( $s ) => $s['stack_name'] ?? '', $stack_items )
    : $defaults;

// We duplicate for seamless infinite loop
$track_items = array_merge( $items, $items );
?>

<section id="stack"
    class="py-20 px-16"
    aria-labelledby="stack-heading">

    <div class="max-w-screen-xl mx-auto mb-10 reveal">
        <div class="section-label"><?php echo $tech_subtitle; ?></div>
        <h2 id="stack-heading" class="section-title mb-0"><?php echo $tech_heading; ?></h2>
    </div>

    <!-- Marquee -->
    <div class="stack-scroll-wrap" aria-hidden="true">
        <div class="stack-track">
            <?php foreach ( $track_items as $tech ) :
                if ( ! trim( $tech ) ) continue;
            ?>
            <div class="stack-item">
                <div class="stack-dot"></div>
                <?php echo esc_html( $tech ); ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Screen-reader accessible list -->
    <p class="sr-only">
        <?php printf(
            /* translators: comma-separated list of technologies */
            esc_html__( 'Technologies I work with: %s', 'sanjeep-portfolio' ),
            esc_html( implode( ', ', $items ) )
        ); ?>
    </p>
</section>
