<?php
/**
 * Single Project Template
 * Handles individual project posts (CPT: project)
 *
 * @package sanjeep-portfolio
 */

get_header();

while (have_posts()):
    the_post();

    // ACF fields
    $live_url = get_field('proj_url');
    $github_url = get_field('proj_github');
    $proj_type = get_field('proj_type');
    $cover = get_field('proj_cover');
    $tags = get_the_terms(get_the_ID(), 'project_tag');

    // Taxonomy categories
    $cats = get_the_terms(get_the_ID(), 'project_cat');

    // Adjacent projects
    $prev_post = get_previous_post(false, '', 'project_cat');
    $next_post = get_next_post(false, '', 'project_cat');

    // Cover image — fallback to featured image
    $cover_url = '';
    $cover_alt = get_the_title();
    if ($cover && !empty($cover['url'])) {
        $cover_url = $cover['sizes']['project'] ?? $cover['url'];
        $cover_alt = $cover['alt'] ?: $cover_alt;
    } elseif (has_post_thumbnail()) {
        $cover_url = get_the_post_thumbnail_url(null, 'project');
    }
    ?>

    <!-- ═══════════════════════════════════
     PROJECT SINGLE — HERO
════════════════════════════════════ -->
    <section class="relative min-h-[55vh] flex flex-col justify-end pt-32 pb-0 overflow-hidden"
        aria-labelledby="project-title">

        <!-- Background cover image with overlay -->
        <?php if ($cover_url): ?>
            <div class="absolute inset-0 z-0" aria-hidden="true">
                <img src="<?php echo esc_url($cover_url); ?>" alt="" class="w-full h-full object-cover opacity-20">
                <div class="absolute inset-0 bg-gradient-to-t from-sp-bg via-sp-bg/80 to-sp-bg/30"></div>
            </div>
        <?php else: ?>
            <!-- No image: subtle grid bg -->
            <div class="absolute inset-0 z-0" aria-hidden="true">
                <div class="hero-grid opacity-60"></div>
                <div class="hero-orb" style="top:-200px;right:-200px;width:500px;height:500px;"></div>
            </div>
        <?php endif; ?>

        <div class="relative z-10 max-w-screen-xl mx-auto w-full px-16 max-md:px-6 pb-12">

            <!-- Breadcrumb -->
            <nav class="flex items-center gap-2 mb-10 reveal"
                aria-label="<?php esc_attr_e('Breadcrumb', 'sanjeep-portfolio'); ?>">
                <a href="<?php echo esc_url(home_url('/')); ?>"
                    class="font-mono text-[0.65rem] tracking-widest uppercase text-white hover:text-sp-accent transition-colors duration-200">
                    <?php esc_html_e('Home', 'sanjeep-portfolio'); ?>
                </a>
                <span class="text-sp-text-muted font-mono text-[0.65rem]" aria-hidden="true">/</span>
                <a href="<?php echo esc_url(home_url('/#work')); ?>"
                    class="font-mono text-[0.65rem] tracking-widest uppercase text-white hover:text-sp-accent transition-colors duration-200">
                    <?php esc_html_e('Work', 'sanjeep-portfolio'); ?>
                </a>
                <span class="text-sp-text-muted font-mono text-[0.65rem]" aria-hidden="true">/</span>
                <span class="font-mono text-[0.65rem] tracking-widest uppercase text-sp-text-secondary">
                    <?php the_title(); ?>
                </span>
            </nav>

            <!-- Category + Year -->
            <div class="flex items-center gap-4 mb-5 reveal">
                <?php if ($cats && !is_wp_error($cats)): ?>
                    <span class="font-mono text-[0.65rem] tracking-widest uppercase text-sp-accent
                         border border-sp-accent/30 px-3 py-1" style="border-radius:2px">
                        <?php echo esc_html($cats[0]->name); ?>
                    </span>
                <?php endif; ?>
            </div>

            <!-- Title -->
            <h1 id="project-title" class="font-display font-extrabold leading-none text-sp-text-primary reveal"
                style="font-size:clamp(2.8rem,7vw,6rem);letter-spacing:-0.04em">
                <?php the_title(); ?>
            </h1>

            <!-- Type + Tags -->
            <div class="flex flex-wrap items-center gap-3 mt-6 reveal">
                <?php if ($proj_type): ?>
                    <span class="font-mono text-[0.7rem] tracking-wide uppercase text-sp-text-secondary">
                        <?php echo esc_html($proj_type); ?>
                    </span>
                    <span class="text-sp-text-muted" aria-hidden="true">—</span>
                <?php endif; ?>
                <?php if ($tags && !is_wp_error($tags)): ?>
                    <?php foreach ($tags as $tag): ?>
                        <span class="font-mono text-[0.6rem] tracking-widest uppercase text-white
                            border border-sp-border px-2.5 py-1 hover:border-sp-border-hover
                            hover:text-sp-text-secondary transition-colors duration-200" style="border-radius:2px">
                            <?php echo esc_html($tag->name); ?>
                        </span>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- CTA buttons -->
            <div class="flex flex-wrap gap-3 mt-8 pb-12 reveal border-b border-sp-border">
                <?php if ($live_url): ?>
                    <a href="<?php echo esc_url($live_url); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-sp-accent text-sp-bg
                      font-mono text-[0.7rem] tracking-widest uppercase
                      px-6 py-3 hover:bg-sp-text-primary hover:-translate-y-px
                      transition-all duration-200" style="border-radius:2px">
                        <?php esc_html_e('Live site', 'sanjeep-portfolio'); ?> ↗
                    </a>
                <?php endif; ?>
                <?php if ($github_url): ?>
                    <a href="<?php echo esc_url($github_url); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 text-sp-text-secondary
                      font-mono text-[0.7rem] tracking-widest uppercase
                      border border-sp-border px-6 py-3
                      hover:text-sp-text-primary hover:border-sp-border-hover hover:-translate-y-px
                      transition-all duration-200" style="border-radius:2px">
                        <?php esc_html_e('GitHub', 'sanjeep-portfolio'); ?> ↗
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════
     PROJECT BODY
════════════════════════════════════ -->
    <div class="max-w-screen-xl mx-auto px-16 max-md:px-6 py-20
            grid grid-cols-1 lg:grid-cols-[1fr_280px] gap-16 items-start">

        <!-- ── Main content ── -->
        <article class="min-w-0">

            <!-- Cover image (full width in body) -->
            <?php if ($cover_url): ?>
                <figure class="mb-14 reveal overflow-hidden" style="border-radius:4px">
                    <img src="<?php echo esc_url($cover['url'] ?? $cover_url); ?>" alt="<?php echo esc_attr($cover_alt); ?>"
                        class="w-full object-cover hover:scale-[1.02]
                        transition-transform duration-700 ease-out" style="max-height:560px">
                </figure>
            <?php endif; ?>
            <div class="section-label mb-8">
                <?php esc_html_e('Project Descriptions', 'sanjeep-portfolio'); ?>
            </div>
            <!-- Excerpt / intro -->
            <?php if (has_excerpt()): ?>
                <p class="text-sp-text-primary font-light leading-relaxed mb-10 reveal"
                    style="font-size:1.15rem;max-width:680px">
                    <?php the_excerpt(); ?>
                </p>
            <?php endif; ?>

            <!-- Post content (from WP editor) -->
            <?php if (get_the_content()): ?>
                <div class="project-content reveal">
                    <?php the_content(); ?>
                </div>
            <?php endif; ?>

            <!-- Gallery — extra images (ACF gallery field if you add one) -->
            <?php
            $gallery = function_exists('get_field') ? get_field('project_screenshots') : [];
            if (!empty($gallery)): ?>
                <div class="mt-16 reveal">
                    <div class="section-label mb-8">
                        <?php esc_html_e('Screenshots', 'sanjeep-portfolio'); ?>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <?php foreach ($gallery as $img):
                            if (empty($img['url']))
                                continue;
                            ?>
                            <figure class="overflow-hidden group" style="border-radius:4px;background:var(--bg-3)">
                                <img src="<?php echo esc_url($img['sizes']['project'] ?? $img['url']); ?>"
                                    alt="<?php echo esc_attr($img['alt'] ?? ''); ?>" class="w-full object-cover group-hover:scale-[1.03]
                                transition-transform duration-700 ease-out">
                            </figure>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

        </article>

        <!-- ── Sidebar ── -->
        <aside class="lg:sticky lg:top-28 flex flex-col gap-0 reveal"
            aria-label="<?php esc_attr_e('Project details', 'sanjeep-portfolio'); ?>">

            <div class="section-label mb-6">
                <?php esc_html_e('Project info', 'sanjeep-portfolio'); ?>
            </div>

            <!-- Meta rows -->
            <dl class="flex flex-col border-t border-sp-border">

                <?php if ($proj_type): ?>
                    <div class="flex justify-between items-center py-4 border-b border-sp-border">
                        <dt class="font-mono text-[0.65rem] tracking-widest uppercase text-sp-text-muted">
                            <?php esc_html_e('Type', 'sanjeep-portfolio'); ?>
                        </dt>
                        <dd class="font-mono text-[0.75rem] text-sp-text-secondary">
                            <?php echo esc_html($proj_type); ?>
                        </dd>
                    </div>
                <?php endif; ?>

                <?php if ($cats && !is_wp_error($cats)): ?>
                    <div class="flex justify-between items-center py-4 border-b border-sp-border">
                        <dt class="font-mono text-[0.65rem] tracking-widest uppercase text-sp-text-muted">
                            <?php esc_html_e('Category', 'sanjeep-portfolio'); ?>
                        </dt>
                        <dd class="font-mono text-[0.75rem] text-sp-accent uppercase">
                            <?php echo esc_html(implode(', ', wp_list_pluck($cats, 'name'))); ?>
                        </dd>
                    </div>
                <?php endif; ?>

                <?php if (!empty($tags)): ?>
                    <div class="flex flex-col gap-3 py-4 border-b border-sp-border">
                        <dt class="font-mono text-[0.65rem] tracking-widest uppercase text-sp-text-muted">
                            <?php esc_html_e('Stack', 'sanjeep-portfolio'); ?>
                        </dt>
                        <dd class="flex flex-wrap gap-1.5">
                            <?php if ($tags && !is_wp_error($tags)): ?>
                                <?php foreach ($tags as $tag): ?>
                                    <span class="font-mono text-[0.6rem] tracking-widest uppercase
                                        text-white border border-sp-border
                                        px-2 py-0.5 hover:border-sp-border-hover hover:text-sp-text-primary
                                        transition-colors duration-200" style="border-radius:2px">
                                        <?php echo esc_html($tag->name); ?>
                                    </span>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </dd>
                    </div>
                <?php endif; ?>

                <?php if ($live_url): ?>
                    <div class="flex justify-between items-center py-4 border-b border-sp-border group">
                        <dt class="font-mono text-[0.65rem] tracking-widest uppercase text-sp-text-muted">
                            <?php esc_html_e('Live URL', 'sanjeep-portfolio'); ?>
                        </dt>
                        <dd>
                            <a href="<?php echo esc_url($live_url); ?>" target="_blank" rel="noopener noreferrer" class="font-mono text-[0.7rem] text-sp-text-secondary
                              hover:text-sp-accent transition-colors duration-200 group-hover:underline">
                                <?php esc_html_e('View site', 'sanjeep-portfolio'); ?> ↗
                            </a>
                        </dd>
                    </div>
                <?php endif; ?>

                <?php if ($github_url): ?>
                    <div class="flex justify-between items-center py-4 border-b border-sp-border group">
                        <dt class="font-mono text-[0.65rem] tracking-widest uppercase text-sp-text-muted">
                            <?php esc_html_e('Source', 'sanjeep-portfolio'); ?>
                        </dt>
                        <dd>
                            <a href="<?php echo esc_url($github_url); ?>" target="_blank" rel="noopener noreferrer" class="font-mono text-[0.7rem] text-sp-text-secondary
                              hover:text-sp-accent transition-colors duration-200">
                                <?php esc_html_e('GitHub', 'sanjeep-portfolio'); ?> ↗
                            </a>
                        </dd>
                    </div>
                <?php endif; ?>

            </dl>
        </aside>
    </div>

    <!-- ═══════════════════════════════════
     NEXT / PREV PROJECTS
════════════════════════════════════ -->
    <?php if ($prev_post || $next_post): ?>
        <nav class="border-t border-sp-border" aria-label="<?php esc_attr_e('Project navigation', 'sanjeep-portfolio'); ?>">
            <div
                class="max-w-screen-xl mx-auto grid grid-cols-1 md:grid-cols-2 divide-y md:divide-y-0 md:divide-x divide-sp-border">

                <?php if ($prev_post): ?>
                    <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" class="group flex flex-col gap-2 p-10 max-md:px-6 hover:bg-sp-bg-2
                  transition-colors duration-300 no-underline">
                        <span class="font-mono text-[0.65rem] tracking-widest uppercase text-sp-text-muted
                         flex items-center gap-2 group-hover:text-sp-accent transition-colors duration-200">
                            ← <?php esc_html_e('Previous project', 'sanjeep-portfolio'); ?>
                        </span>
                        <span class="font-display font-bold text-sp-text-primary
                         group-hover:text-sp-accent transition-colors duration-200"
                            style="font-size:1.3rem;letter-spacing:-0.02em">
                            <?php echo esc_html(get_the_title($prev_post)); ?>
                        </span>
                    </a>
                <?php else: ?>
                    <div></div>
                <?php endif; ?>

                <?php if ($next_post): ?>
                    <a href="<?php echo esc_url(get_permalink($next_post)); ?>" class="group flex flex-col gap-2 p-10 max-md:px-6 text-right hover:bg-sp-bg-2
                  transition-colors duration-300 no-underline md:items-end">
                        <span class="font-mono text-[0.65rem] tracking-widest uppercase text-sp-text-muted
                         flex items-center gap-2 group-hover:text-sp-accent transition-colors duration-200">
                            <?php esc_html_e('Next project', 'sanjeep-portfolio'); ?> →
                        </span>
                        <span class="font-display font-bold text-sp-text-primary
                         group-hover:text-sp-accent transition-colors duration-200"
                            style="font-size:1.3rem;letter-spacing:-0.02em">
                            <?php echo esc_html(get_the_title($next_post)); ?>
                        </span>
                    </a>
                <?php endif; ?>

            </div>
        </nav>
    <?php endif; ?>

<?php endwhile; ?>

<?php get_footer(); ?>