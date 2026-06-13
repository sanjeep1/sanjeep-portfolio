<?php
/**
 * Template Part: Work / Projects Section
 */

$projects_subtitle = get_field('projects_subtitle');
$projects_heading  = get_field('projects_heading');
$choose_projects   = get_field('choose_projects');
?>

<section id="work" class="py-28 px-6 md:px-10 lg:px-16 max-w-7xl mx-auto" aria-labelledby="work-heading">

    <!-- Header -->
    <div class="flex items-end justify-between mb-16 reveal">
        <div>
            <?php if ($projects_subtitle) : ?>
                <div class="section-label">
                    <?php echo esc_html($projects_subtitle); ?>
                </div>
            <?php endif; ?>

            <?php if ($projects_heading) : ?>
                <h2 id="work-heading" class="section-title mb-0">
                    <?php echo esc_html($projects_heading); ?><span class="text-sp-accent">.</span>
                </h2>
            <?php endif; ?>
        </div>
    </div>

    <div role="list" aria-label="<?php esc_attr_e('Featured projects', 'sanjeep-portfolio'); ?>">

        <?php

        if (!empty($choose_projects)) :

            $i = 1;

            foreach ($choose_projects as $project) :

                $project_id = is_object($project) ? $project->ID : $project;

                $num = str_pad($i, 2, '0', STR_PAD_LEFT);

                $tags = get_the_terms($project_id,'project_tag');
        ?>

            <a href="<?php echo esc_url(get_permalink($project_id)); ?>"
                class="project-item reveal flex items-center gap-12 py-8 border-b relative overflow-hidden transition-all duration-500 no-underline hover:pl-6"
                role="listitem"
                aria-label="<?php echo esc_attr(get_the_title($project_id)); ?>"
                style="animation-delay:<?php echo ($i - 1) * 0.08; ?>s">

                    <div class="font-mono text-sp-text-muted text-[0.7rem] tracking-[0.1em] min-w-8"
                        aria-hidden="true">
                        <?php echo esc_html($num); ?>
                    </div>

                    <div class="flex flex-col gap-2">

                        <div class="project-name font-display font-semibold text-[1.5rem] tracking-[-0.02em] transition-colors duration-200">
                            <?php echo esc_html(get_the_title($project_id)); ?>
                        </div>

                        <?php if ($tags && !is_wp_error($tags)) : ?>
                            <div class="flex items-center gap-4 font-mono text-sp-text-muted text-[0.7rem] tracking-[0.06em] uppercase">

                                <?php
                                $tag_count = count($tags);

                                foreach ($tags as $index => $tag) :
                                ?>

                                    <span>
                                        <?php echo esc_html($tag->name); ?>
                                    </span>

                                    <?php if ($index < $tag_count - 1) : ?>
                                        <span aria-hidden="true">•</span>
                                    <?php endif; ?>

                                <?php endforeach; ?>

                            </div>
                        <?php endif; ?>

                    </div>

                    <div class="project-arrow ml-auto flex-shrink-0 text-sp-text-muted text-[1.2rem] transition-all duration-300" aria-hidden="true">
                        <svg fill="currentColor" width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M3.293,20.707a1,1,0,0,1,0-1.414L17.586,5H12a1,1,0,0,1,0-2h8a1,1,0,0,1,1,1v8a1,1,0,0,1-2,0V6.414L4.707,20.707a1,1,0,0,1-1.414,0Z"/></svg>
                    </div>

                </a>

        <?php
                $i++;
            endforeach;

        // Fallback if no projects selected
        else :

            $projects = new WP_Query([
                'post_type'      => 'project',
                'posts_per_page' => -1,
                'post_status'    => 'publish',
            ]);

            if ($projects->have_posts()) :

                $i = 1;

                while ($projects->have_posts()) :
                    $projects->the_post();

                    $num = str_pad($i, 2, '0', STR_PAD_LEFT);

                    $tags = get_the_terms(get_the_ID(),'project_tag');
        ?>

            <a href="<?php echo esc_url(get_permalink()); ?>"
                class="project-item reveal flex items-center gap-12 py-8 border-b relative overflow-hidden transition-all duration-500 no-underline hover:pl-6 hover:pr-8"
                role="listitem"
                aria-label="<?php echo esc_attr(get_the_title()); ?>"
                style="animation-delay:<?php echo ($i - 1) * 0.08; ?>s">

                    <div class="font-mono text-sp-text-muted text-[0.7rem] tracking-[0.1em] min-w-8"
                        aria-hidden="true">
                        <?php echo esc_html($num); ?>
                    </div>

                    <div class="flex flex-col gap-2">

                        <div class="project-name font-display font-semibold text-[1.5rem] tracking-[-0.02em] transition-colors duration-200">
                            <?php echo esc_html(get_the_title()); ?>
                        </div>

                        <?php if ($tags && !is_wp_error($tags)) : ?>
                            <div class="flex items-center gap-4 font-mono text-sp-text-muted text-[0.7rem] tracking-[0.06em] uppercase">

                                <?php
                                $tag_count = count($tags);

                                foreach ($tags as $index => $tag) :
                                ?>

                                    <span>
                                        <?php echo esc_html($tag->name); ?>
                                    </span>

                                    <?php if ($index < $tag_count - 1) : ?>
                                        <span aria-hidden="true">•</span>
                                    <?php endif; ?>

                                <?php endforeach; ?>

                            </div>
                        <?php endif; ?>

                    </div>

                    <div class="project-arrow ml-auto flex-shrink-0 text-sp-text-muted text-[1.2rem] transition-all duration-300" aria-hidden="true">
                        <svg fill="currentColor" width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M3.293,20.707a1,1,0,0,1,0-1.414L17.586,5H12a1,1,0,0,1,0-2h8a1,1,0,0,1,1,1v8a1,1,0,0,1-2,0V6.414L4.707,20.707a1,1,0,0,1-1.414,0Z"/></svg>
                    </div>

                </a>

        <?php
                $i++;
                endwhile;

                wp_reset_postdata();

            endif;

        endif;
        ?>

    </div>

</section>