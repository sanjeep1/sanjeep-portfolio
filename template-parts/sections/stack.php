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

<section id="stack" class="py-20 px-6 lg:px-16"
    aria-labelledby="stack-heading">

    <div class="max-w-screen-xl mx-auto mb-10 reveal">
        <div class="section-label">
            <?php echo esc_html($tech_subtitle); ?>
        </div>

        <h2 id="stack-heading" class="section-title mb-0">
            <?php echo esc_html($tech_heading); ?>
            <span class="text-sp-accent">.</span>
        </h2>
    </div>

    <!-- Marquee -->
    <div class="relative overflow-hidden" aria-hidden="true">

        <!-- Left gradient -->
        <div class="pointer-events-none absolute left-0 top-0 bottom-0 w-[140px] z-10 bg-gradient-to-r from-[var(--bg-2)] to-transparent"></div>

        <!-- Right gradient -->
        <div class="pointer-events-none absolute right-0 top-0 bottom-0 w-[140px] z-10 bg-gradient-to-l from-[var(--bg-2)] to-transparent"></div>

        <div class="flex w-max animate-[scrollLeft_32s_linear_infinite] hover:[animation-play-state:paused] stack-track">

            <?php foreach ($track_items as $tech) :
                if (!trim($tech)) continue;
            ?>
                <div class="flex items-center gap-2.5 font-mono text-sp-text-secondary text-[0.8rem] tracking-[0.05em] px-10 border-r border-sp-border h-[52px] whitespace-nowrap transition-colors duration-200 hover:text-sp-text-primary">

                    <div class="w-[6px] h-[6px] rounded-full bg-[var(--accent)] flex-shrink-0"></div>

                    <?php echo esc_html($tech); ?>

                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <p class="sr-only">
        <?php printf(
            esc_html__('Technologies I work with: %s', 'sanjeep-portfolio'),
            esc_html(implode(', ', $items))
        ); ?>
    </p>

</section>