<?php
/**
 * Template Part: Work / Projects Section
 */

$projects = sp_get_featured_projects( 6 );
?>

<section id="work"
    class="py-28 px-16 max-w-screen-xl mx-auto"
    aria-labelledby="work-heading">

    <!-- Header -->
    <div class="flex items-end justify-between mb-16 reveal">
        <div>
            <div class="section-label">Portfolio</div>
            <h2 id="work-heading" class="section-title mb-0">Selected Work</h2>
        </div>
        <a href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ?: '#contact' ); ?>"
           class="font-mono text-xs tracking-widest uppercase
                  text-sp-text-secondary no-underline flex items-center gap-2
                  transition-colors duration-200 hover:text-sp-accent">
            <?php esc_html_e( 'All projects', 'sanjeep-portfolio' ); ?> ↗
        </a>
    </div>

    <!-- Project list -->
    <div role="list" aria-label="<?php esc_attr_e( 'Featured projects', 'sanjeep-portfolio' ); ?>">

        <?php if ( $projects->have_posts() ) :
            $i = 1;
            while ( $projects->have_posts() ) : $projects->the_post();
                $url   = get_field( 'proj_url' );
                $year  = get_field( 'proj_year' );
                $type  = get_field( 'proj_type' );
                $tags  = get_field( 'proj_tags' );
                $link  = $url ?: get_permalink();
                $num   = str_pad( $i, 2, '0', STR_PAD_LEFT );
        ?>
        <a href="<?php echo esc_url( $link ); ?>"
           class="project-item reveal"
           role="listitem"
           target="<?php echo $url ? '_blank' : '_self'; ?>"
           rel="<?php echo $url ? 'noopener noreferrer' : ''; ?>"
           aria-label="<?php echo esc_attr( get_the_title() . ( $url ? ' — opens in new tab' : '' ) ); ?>"
           style="animation-delay:<?php echo ( $i - 1 ) * 0.08; ?>s">

            <div class="project-num" aria-hidden="true"><?php echo esc_html( $num ); ?></div>

            <div class="project-info">
                <div class="project-name"><?php the_title(); ?></div>
                <div class="project-meta">
                    <?php if ( $type ) : ?>
                        <span><?php echo esc_html( $type ); ?></span>
                        <span aria-hidden="true">•</span>
                    <?php endif; ?>
                    <?php
                    // Show taxonomy categories
                    $cats = get_the_terms( get_the_ID(), 'project_cat' );
                    if ( $cats && ! is_wp_error( $cats ) ) :
                        echo '<span>' . esc_html( $cats[0]->name ) . '</span>';
                        echo '<span aria-hidden="true">•</span>';
                    endif;
                    ?>
                    <?php if ( $year ) : ?>
                        <span><?php echo esc_html( $year ); ?></span>
                    <?php endif; ?>
                </div>

                <?php if ( ! empty( $tags ) ) : ?>
                <div class="project-tags">
                    <?php foreach ( $tags as $tag ) :
                        $label = is_array( $tag ) ? ( $tag['ptag'] ?? '' ) : $tag;
                        if ( ! $label ) continue;
                    ?>
                    <span class="project-tag"><?php echo esc_html( $label ); ?></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <div class="project-arrow" aria-hidden="true">↗</div>
        </a>
        <?php
                $i++;
            endwhile;
            wp_reset_postdata();

        else : ?>
        <!-- Placeholder projects when CPT is empty -->
        <?php
        $placeholders = [
            [ 'num'=>'01', 'name'=>'Complete Website Redesign with Elementor', 'type'=>'WordPress + ACF', 'cat'=>'Trekking Agency', 'year'=>'2024', 'tags'=>['WordPress','Custom Theme','Tailwind'] ],
            [ 'num'=>'02', 'name'=>'Responsive WordPress Website with Kadence',            'type'=>'React + Headless', 'cat'=>'Tourism',         'year'=>'2024', 'tags'=>['React','WP REST API','SEO'] ],
            [ 'num'=>'03', 'name'=>'WordPress Theme Customization & Hosting Migration',        'type'=>'React',            'cat'=>'E-Commerce',      'year'=>'2023', 'tags'=>['React','Redux','JavaScript'] ],
            [ 'num'=>'04', 'name'=>'Enterprise WordPress Site Development and Migration',           'type'=>'PHP + MySQL',      'cat'=>'Web App',         'year'=>'2023', 'tags'=>['PHP','MySQL','JavaScript'] ],
            [ 'num'=>'05', 'name'=>'React Movie Search Application with API Integration',              'type'=>'JavaScript',       'cat'=>'Frontend',        'year'=>'2023', 'tags'=>['JavaScript','API','CSS'] ],
        ];
        foreach ( $placeholders as $p ) : ?>
        <a href="#" class="project-item reveal" role="listitem">
            <div class="project-num" aria-hidden="true"><?php echo esc_html( $p['num'] ); ?></div>
            <div class="project-info">
                <div class="project-name"><?php echo esc_html( $p['name'] ); ?></div>
                <div class="project-meta">
                    <span><?php echo esc_html( $p['type'] ); ?></span>
                    <span aria-hidden="true">•</span>
                    <span><?php echo esc_html( $p['cat'] ); ?></span>
                    <span aria-hidden="true">•</span>
                    <span><?php echo esc_html( $p['year'] ); ?></span>
                </div>
                <div class="project-tags">
                    <?php foreach ( $p['tags'] as $tag ) : ?>
                    <span class="project-tag"><?php echo esc_html( $tag ); ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="project-arrow" aria-hidden="true">↗</div>
        </a>
        <?php endforeach; ?>
        <?php endif; ?>

    </div>
</section>
