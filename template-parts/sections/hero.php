<?php
/**
 * Template Part: Hero Section
 */

$badge = get_field('hero_badge');
$name = get_field('hero_name');
$tagline = get_field('hero_tagline');
$description = get_field('hero_description');
$cta_first = get_field('hero_cta_first');
$cta_second = get_field('hero_cta_second');
$stats = function_exists('get_field') ? get_field('hero_stats') : [];

// Split name into two parts for staggered animation
$name_parts = explode(' ', $name, 2);
$first = $name_parts[0] ?? $name;
$last = $name_parts[1] ?? '';
?>

<section id="hero"
    class="relative min-h-screen flex flex-col justify-end px-6 md:px-10 lg:px-16 pb-20 pt-[var(--nav-height)] overflow-hidden"
    aria-labelledby="hero-heading">

    <!-- Grid background -->
    <div class="absolute inset-0 pointer-events-none
            [background-image:linear-gradient(rgba(255,255,255,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.04)_1px,transparent_1px)]
            [background-size:80px_80px]
            [mask-image:radial-gradient(ellipse_80%_80%_at_50%_50%,black_30%,transparent_80%)]">
    </div>

    <!-- Accent orb -->
    <div class="absolute pointer-events-none
            w-[700px] h-[700px]
            top-[-120px] right-[-120px]
            bg-[radial-gradient(circle,rgba(200,240,74,0.06)_0%,transparent_70%)]">
    </div>

    <!-- Noise overlay -->
    <div class="hero-noise absolute inset-0 pointer-events-none"></div>

    <div class="relative z-10 max-w-7xl mx-auto w-full px-0 md:px-0">

        <!-- Badge -->
        <div class="hero-badge reveal flex items-center gap-3 mb-8 font-mono uppercase tracking-[0.2em] text-sp-accent text-xs"
            aria-label="<?php esc_attr_e('Availability status', 'sanjeep-portfolio'); ?>">
            <?php echo esc_html($badge); ?>
        </div>

        <!-- Name -->
        <h1 class="hero-name font-display font-extrabold leading-none text-[clamp(2.5rem,10vw,10.5rem)] tracking-[-0.045em]">

            <!-- First Name -->
            <span class="block overflow-hidden leading-[1.05]">
                <span
                    class="block translate-y-full opacity-0">
                    <?php echo esc_html( $first ); ?>
                </span>
            </span>

            <!-- Last Name -->
            <span class="block overflow-hidden leading-[1.05]">
                <span
                    class="block translate-y-full opacity-0">
                    <?php echo esc_html( $last ); ?><span class="text-sp-accent">.</span>
                </span>
            </span>

        </h1>

        <!-- Description row -->
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-8 mt-12 reveal">

            <p class="max-w-md
            text-sp-text-secondary
            leading-relaxed
            font-light
            text-base md:text-[1.05rem]">
                <?php echo wp_kses_post($description); ?>
            </p>

            <div class="flex flex-wrap gap-4 flex-shrink-0">
                <a href="<?php echo esc_url($cta_first['url']); ?>" class="btn-primary">
                    <?php echo esc_html($cta_first['title']); ?> ↓
                </a>
                <a href="<?php echo esc_url($cta_second['url']); ?>" class="btn-ghost">
                    <?php echo esc_html($cta_second['title']); ?>
                </a>
            </div>
        </div>

        <!-- Stats -->
        <?php if (!empty($stats)): ?>
            <div class="reveal
           flex flex-wrap gap-8 md:gap-12
           pt-8 mt-8
           border-t border-sp-border">
                <?php foreach ($stats as $stat):
                    $number = $stat['stat_number'] ?? '';
                    $suffix = $stat['stat_suffix'] ?? '+';
                    $label = $stat['stat_label'] ?? '';
                    if (!$number && !$label)
                        continue;
                    ?>
                    <div class="flex flex-col gap-1">
                        <div class="font-display font-bold text-[2.2rem] tracking-[-0.04em] leading-none">
                            <?php echo esc_html($number); ?>
                            <?php if ($suffix): ?>
                                <span class="text-sp-accent"><?php echo esc_html($suffix); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="font-mono uppercase
                    tracking-[0.15em]
                    text-sp-text-secondary
                    text-[10px]"><?php echo esc_html($label); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <!-- Default stats if none set in ACF -->
            <div class="reveal flex flex-wrap gap-8 md:gap-12 pt-8 mt-8 border-t border-sp-border">
                <div class="flex flex-col gap-1">
                    <div class="font-display font-bold text-[2.2rem] tracking-[-0.04em] leading-none">3<span
                            class="text-sp-accent">+</span></div>
                    <div class="font-mono uppercase tracking-[0.15em] text-sp-text-secondary text-[10px]">Years experience
                    </div>
                </div>
                <div class="flex flex-col gap-1">
                    <div class="font-display font-bold text-[2.2rem] tracking-[-0.04em] leading-none">20<span
                            class="text-sp-accent">+</span></div>
                    <div class="font-mono uppercase tracking-[0.15em] text-sp-text-secondary text-[10px]">Projects delivered
                    </div>
                </div>
                <div class="flex flex-col gap-1">
                    <div class="font-display font-bold text-[2.2rem] tracking-[-0.04em] leading-none">10<span
                            class="text-sp-accent">+</span></div>
                    <div class="font-mono uppercase tracking-[0.15em] text-sp-text-secondary text-[10px]">Happy clients
                    </div>
                </div>
                <div class="flex flex-col gap-1">
                    <div class="font-display font-bold text-[2.2rem] tracking-[-0.04em] leading-none">∞</div>
                    <div class="font-mono uppercase tracking-[0.15em] text-sp-text-secondary text-[10px]">Cups of chai</div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Scroll indicator -->
    <div class="hero-scroll
           absolute
           bottom-10 right-16
           hidden lg:flex
           items-center gap-3
           font-mono uppercase
           tracking-[0.2em]
           text-sp-text-muted
           text-[10px]" aria-hidden="true">Scroll</div>
</section>