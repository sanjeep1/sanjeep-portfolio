<?php
/**
 * Template Part: Services Section
 */

$heading  = get_field( 'services_heading');
$subtitle = get_field( 'services_subtitle');
$content = get_field( 'services_content');
$services = function_exists( 'get_field' ) ? get_field( 'services_list') : [];

?>

<section id="services" class="py-24 px-6 lg:px-16 bg-sp-bg-2 border-y border-sp-border" aria-labelledby="services-heading">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 max-w-screen-xl mx-auto reveal">

        <div>
            <div class="section-label">
                <?php echo esc_html($subtitle); ?>
            </div>

            <h2 id="services-heading" class="section-title mb-0">
                <?php echo esc_html($heading); ?>
                <span class="text-sp-accent">.</span>
            </h2>
        </div>

        <?php if ($content) : ?>
            <p class="text-sp-text-secondary text-sm max-w-xs text-right font-light leading-relaxed mt-4 md:mt-0">
                <?php echo esc_html($content); ?>
            </p>
        <?php endif; ?>

    </div>

    <!-- Services Grid -->
    <div class="services-grid grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-px max-w-screen-xl mx-auto bg-[var(--border)]"
        role="list"
        aria-label="<?php esc_attr_e('Services list', 'sanjeep-portfolio'); ?>">

        <?php foreach ($services as $i => $svc) :

            $icon  = $svc['svc_icon'] ?? '';
            $title = $svc['svc_title'] ?? '';
            $desc  = $svc['svc_desc'] ?? '';
            $num   = str_pad($i + 1, 2, '0', STR_PAD_LEFT);

        ?>

            <article class="service-card relative overflow-hidden p-10 bg-sp-bg-2 transition-colors duration-300 hover:bg-[var(--surface)] reveal"
                role="listitem"
                style="animation-delay:<?php echo $i * 0.08; ?>s">

                <div class="font-mono text-sp-accent mb-6 text-[0.65rem] tracking-[0.18em]"
                    aria-hidden="true">
                    <?php echo esc_html($num); ?>
                </div>

                <?php if ($icon) :
                    $svg = file_get_contents(get_attached_file($icon));
                    if ($svg) :
                ?>
                    <div class="mb-5 text-[2rem] leading-none" aria-hidden="true">
                        <div class="w-8 h-8 text-current">
                            <?php echo $svg; ?>
                        </div>
                    </div>
                <?php
                    endif;
                endif;
                ?>

                <h3 class="font-display font-semibold text-[1.3rem] tracking-[-0.02em] mb-3">
                    <?php echo esc_html($title); ?>
                </h3>

                <p class="text-sp-text-secondary font-light leading-relaxed text-[0.9rem]">
                    <?php echo esc_html($desc); ?>
                </p>

            </article>

        <?php endforeach; ?>

    </div>

</section>