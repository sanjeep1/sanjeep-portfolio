<?php
/**
 * Template Part: Work / Projects Section
 */

$projects_subtitle = get_field('projects_subtitle');
$projects_heading  = get_field('projects_heading');
$choose_projects   = get_field('choose_projects'); // Relationship field
?>

<section id="work"
    class="py-28 px-6 md:px-10 lg:px-16 max-w-7xl mx-auto"
    aria-labelledby="work-heading">

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

    <div role="list"
         aria-label="<?php esc_attr_e('Featured projects', 'sanjeep-portfolio'); ?>">

        <?php

        // Use ACF relationship field
        if (!empty($choose_projects)) :

            $i = 1;

            foreach ($choose_projects as $project) :

                $project_id = is_object($project) ? $project->ID : $project;

                $num = str_pad($i, 2, '0', STR_PAD_LEFT);

                $categories = get_the_terms(
                    $project_id,
                    'project_cat'
                );
        ?>

            <a href="<?php echo esc_url(get_permalink($project_id)); ?>"
               class="project-item reveal"
               role="listitem"
               aria-label="<?php echo esc_attr(get_the_title($project_id)); ?>"
               style="animation-delay:<?php echo ($i - 1) * 0.08; ?>s">

                <div class="project-num" aria-hidden="true">
                    <?php echo esc_html($num); ?>
                </div>

                <div class="project-info">

                    <div class="project-name">
                        <?php echo esc_html(get_the_title($project_id)); ?>
                    </div>

                    <?php if ($categories && !is_wp_error($categories)) : ?>
                        <div class="project-meta">

                            <?php
                            $cat_count = count($categories);

                            foreach ($categories as $index => $cat) :
                            ?>

                                <span>
                                    <?php echo esc_html($cat->name); ?>
                                </span>

                                <?php if ($index < $cat_count - 1) : ?>
                                    <span aria-hidden="true">•</span>
                                <?php endif; ?>

                            <?php endforeach; ?>

                        </div>
                    <?php endif; ?>

                </div>

                <div class="project-arrow" aria-hidden="true">
                    ↗
                </div>

            </a>

        <?php
                $i++;
            endforeach;

        // Fallback if no projects selected
        else :

            $projects = new WP_Query([
                'post_type'      => 'project',
                'posts_per_page' => 5,
                'post_status'    => 'publish',
            ]);

            if ($projects->have_posts()) :

                $i = 1;

                while ($projects->have_posts()) :
                    $projects->the_post();

                    $num = str_pad($i, 2, '0', STR_PAD_LEFT);

                    $categories = get_the_terms(
                        get_the_ID(),
                        'project_cat'
                    );
        ?>

            <a href="<?php the_permalink(); ?>"
               class="project-item reveal"
               role="listitem"
               aria-label="<?php the_title_attribute(); ?>"
               style="animation-delay:<?php echo ($i - 1) * 0.08; ?>s">

                <div class="project-num" aria-hidden="true">
                    <?php echo esc_html($num); ?>
                </div>

                <div class="project-info">

                    <div class="project-name">
                        <?php the_title(); ?>
                    </div>

                    <?php if ($categories && !is_wp_error($categories)) : ?>
                        <div class="project-meta">

                            <?php
                            $cat_count = count($categories);

                            foreach ($categories as $index => $cat) :
                            ?>

                                <span>
                                    <?php echo esc_html($cat->name); ?>
                                </span>

                                <?php if ($index < $cat_count - 1) : ?>
                                    <span aria-hidden="true">•</span>
                                <?php endif; ?>

                            <?php endforeach; ?>

                        </div>
                    <?php endif; ?>

                </div>

                <div class="project-arrow" aria-hidden="true">
                    ↗
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