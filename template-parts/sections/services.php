<?php
/**
 * Template Part: Services Section
 */

$heading  = get_field( 'services_heading');
$subtitle = get_field( 'services_subtitle');
$content = get_field( 'services_content');
$services = function_exists( 'get_field' ) ? get_field( 'services_list') : [];

$default_services = [
    [
        'svc_icon'  => '⚡',
        'svc_title' => 'WordPress Development',
        'svc_desc'  => 'Custom themes from scratch using ACF, Gutenberg blocks, and Tailwind CSS. Performance-first, SEO-optimized builds that load fast and rank high.',
        'svc_tags'  => [ ['svc_tag'=>'ACF Pro'], ['svc_tag'=>'Custom Themes'], ['svc_tag'=>'WooCommerce'], ['svc_tag'=>'REST API'] ],
    ],
    [
        'svc_icon'  => '⚛',
        'svc_title' => 'Debugging & Troubleshooting',
        'svc_desc'  => 'Identify and resolve issues to ensure smooth website operation.',
        'svc_tags'  => [ ['svc_tag'=>'React'], ['svc_tag'=>'Next.js'], ['svc_tag'=>'TypeScript'], ['svc_tag'=>'API Integration'] ],
    ],
    [
        'svc_icon'  => '🎨',
        'svc_title' => 'UI/UX Implementation',
        'svc_desc'  => 'Translating Figma designs to pixel-perfect, responsive, and accessible code with smooth animations and delightful micro-interactions.',
        'svc_tags'  => [ ['svc_tag'=>'Tailwind CSS'], ['svc_tag'=>'Figma'], ['svc_tag'=>'GSAP'], ['svc_tag'=>'Responsive'] ],
    ],
    [
        'svc_icon'  => '🚀',
        'svc_title' => 'Performance Optimization',
        'svc_desc'  => 'Core Web Vitals audits, lazy loading, code splitting, and CDN setup to achieve lightning-fast load times and top Lighthouse scores.',
        'svc_tags'  => [ ['svc_tag'=>'Core Web Vitals'], ['svc_tag'=>'Lighthouse'], ['svc_tag'=>'CDN'], ['svc_tag'=>'Caching'] ],
    ],
    [
        'svc_icon'  => '🔌',
        'svc_title' => 'API & Integration',
        'svc_desc'  => 'Integrate APIs and third-party services seamlessly.',
        'svc_tags'  => [ ['svc_tag'=>'WPGraphQL'], ['svc_tag'=>'Headless CMS'], ['svc_tag'=>'Next.js'], ['svc_tag'=>'REST API'] ],
    ],
    [
        'svc_icon'  => '🛒',
        'svc_title' => 'E-Commerce',
        'svc_desc'  => 'Custom WooCommerce builds with unique storefronts, payment gateway integration, inventory management, and conversion-optimized checkout.',
        'svc_tags'  => [ ['svc_tag'=>'WooCommerce'], ['svc_tag'=>'Custom Checkout'], ['svc_tag'=>'Payments'], ['svc_tag'=>'UX'] ],
    ],
];

$items = ! empty( $services ) ? $services : $default_services;
?>

<section id="services"
    class="py-24 px-16 bg-sp-bg-2 border-t border-b border-sp-border"
    aria-labelledby="services-heading">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-16
                max-w-screen-xl mx-auto reveal">
        <div>
            <div class="section-label">
                <?php echo esc_html( $subtitle ); ?>
            </div>
            <h2 id="services-heading" class="section-title mb-0">
                <?php echo esc_html( $heading ); ?><span class="text-sp-accent">.</span>
            </h2>
        </div>
        <?php if ( $content ) : ?>
        <p class="text-sp-text-secondary text-sm max-w-xs text-right
                  font-light leading-relaxed mt-4 md:mt-0">
            <?php echo esc_html( $content ); ?>
        </p>
        <?php endif; ?>
    </div>

    <!-- Grid -->
    <div class="services-grid max-w-screen-xl mx-auto"
         role="list"
         aria-label="<?php esc_attr_e( 'Services list', 'sanjeep-portfolio' ); ?>">

        <?php foreach ( $items as $i => $svc ) :
            $icon  = $svc['svc_icon']  ?? '';
            $title = $svc['svc_title'] ?? '';
            $desc  = $svc['svc_desc']  ?? '';
            $num   = str_pad( $i + 1, 2, '0', STR_PAD_LEFT );
        ?>
        <article class="service-card reveal" role="listitem"
                 style="animation-delay:<?php echo $i * 0.08; ?>s">

            <div class="service-num" aria-hidden="true"><?php echo esc_html( $num ); ?></div>

            <?php if ( $icon ) : ?>
            <div class="service-icon" aria-hidden="true"><?php echo esc_html( $icon ); ?></div>
            <?php endif; ?>

            <h3 class="service-title"><?php echo esc_html( $title ); ?></h3>
            <p class="service-desc"><?php echo esc_html( $desc ); ?></p>

        </article>
        <?php endforeach; ?>
    </div>
</section>
