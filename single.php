<?php
/**
 * Default Single Post Template
 * Minimal version aligned with portfolio design system
 *
 * @package sanjeep-portfolio
 */

get_header();

while ( have_posts() ) :
    the_post();
?>

<!-- ════════════════════════
     HERO SECTION
════════════════════════ -->
<section class="relative pt-32 pb-16 border-b border-sp-border">

    <div class="max-w-screen-xl mx-auto px-16 max-md:px-6">

        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 mb-8">
            <a href="<?php echo esc_url(home_url('/')); ?>"
               class="font-mono text-[0.65rem] uppercase text-sp-text-muted hover:text-sp-accent">
                Home
            </a>
            <span class="text-sp-text-muted">/</span>
            <span class="font-mono text-[0.65rem] uppercase text-sp-text-secondary">
                Blog
            </span>
        </nav>

        <!-- Title -->
        <h1 class="font-display font-extrabold text-sp-text-primary leading-none"
            style="font-size:clamp(2.2rem,5vw,4.5rem);letter-spacing:-0.03em">
            <?php the_title(); ?>
        </h1>

        <!-- Meta -->
        <div class="flex flex-wrap items-center gap-4 mt-6 font-mono text-[0.7rem] text-sp-text-muted uppercase">
            <span><?php echo get_the_date(); ?></span>
            <span>•</span>
            <span><?php the_author(); ?></span>
            <span>•</span>
            <span><?php echo get_the_category_list(', '); ?></span>
        </div>

    </div>
</section>

<!-- ════════════════════════
     CONTENT AREA
════════════════════════ -->
<div class="max-w-screen-xl mx-auto px-16 max-md:px-6 py-16 grid grid-cols-1 lg:grid-cols-[1fr_280px] gap-16">

    <!-- MAIN CONTENT -->
    <article class="min-w-0">

        <!-- Featured Image -->
        <?php if ( has_post_thumbnail() ) : ?>
            <figure class="mb-10 overflow-hidden" style="border-radius:4px">
                <?php the_post_thumbnail('large', [
                    'class' => 'w-full object-cover hover:scale-[1.02] transition-transform duration-700'
                ]); ?>
            </figure>
        <?php endif; ?>

        <!-- Excerpt -->
        <?php if ( has_excerpt() ) : ?>
            <p class="text-sp-text-primary font-light mb-10 text-lg leading-relaxed">
                <?php the_excerpt(); ?>
            </p>
        <?php endif; ?>

        <!-- Content -->
        <div class="prose prose-invert max-w-none text-sp-text-primary">
            <?php the_content(); ?>
        </div>

    </article>

    <!-- SIDEBAR -->
    <aside class="lg:sticky lg:top-28 flex flex-col gap-8">

        <!-- About -->
        <div>
            <div class="font-mono text-[0.7rem] uppercase text-sp-text-muted mb-4">
                About This Post
            </div>

            <p class="text-sm text-sp-text-secondary leading-relaxed">
                This article is part of the portfolio blog section where I share development insights,
                project breakdowns, and technical notes.
            </p>
        </div>

        <!-- Categories -->
        <div>
            <div class="font-mono text-[0.7rem] uppercase text-sp-text-muted mb-3">
                Categories
            </div>
            <div class="flex flex-wrap gap-2 text-[0.7rem]">
                <?php the_category(' '); ?>
            </div>
        </div>

        <!-- Tags -->
        <?php if ( get_the_tags() ) : ?>
        <div>
            <div class="font-mono text-[0.7rem] uppercase text-sp-text-muted mb-3">
                Tags
            </div>

            <div class="flex flex-wrap gap-2">
                <?php
                $tags = get_the_tags();
                foreach ( $tags as $tag ) : ?>
                    <span class="text-[0.65rem] uppercase font-mono border border-sp-border px-2 py-1 text-sp-text-muted">
                        <?php echo esc_html($tag->name); ?>
                    </span>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

    </aside>
</div>

<!-- ════════════════════════
     NAVIGATION
════════════════════════ -->
<nav class="border-t border-sp-border mt-10">
    <div class="max-w-screen-xl mx-auto grid grid-cols-1 md:grid-cols-2 divide-x divide-sp-border">

        <!-- Previous -->
        <div class="p-10">
            <?php $prev = get_previous_post(); ?>
            <?php if ($prev) : ?>
                <a href="<?php echo get_permalink($prev); ?>" class="block group">
                    <span class="font-mono text-[0.65rem] uppercase text-sp-text-muted">
                        Previous Post
                    </span>
                    <div class="text-lg font-bold group-hover:text-sp-accent transition-colors">
                        <?php echo get_the_title($prev); ?>
                    </div>
                </a>
            <?php endif; ?>
        </div>

        <!-- Next -->
        <div class="p-10 text-right">
            <?php $next = get_next_post(); ?>
            <?php if ($next) : ?>
                <a href="<?php echo get_permalink($next); ?>" class="block group">
                    <span class="font-mono text-[0.65rem] uppercase text-sp-text-muted">
                        Next Post
                    </span>
                    <div class="text-lg font-bold group-hover:text-sp-accent transition-colors">
                        <?php echo get_the_title($next); ?>
                    </div>
                </a>
            <?php endif; ?>
        </div>

    </div>
</nav>

<?php endwhile; ?>

<?php get_footer(); ?>