<?php
/**
 * Archive Template
 * Used for: category, tag, date, author, and custom taxonomy archives.
 * For the project_cat taxonomy it renders project cards.
 *
 * @package sanjeep-portfolio
 */

get_header();

$is_project_cat = is_tax( 'project_cat' );
$archive_title  = get_the_archive_title();
$archive_desc   = get_the_archive_description();

// Clean "Category: " prefix WP adds
$archive_title = preg_replace( '/^[^:]+:\s*/', '', strip_tags( $archive_title ) );
?>

<!-- ═══════════════════════════════════
     ARCHIVE HERO
════════════════════════════════════ -->
<section class="relative pt-40 pb-16 px-16 max-md:px-6 overflow-hidden border-b border-sp-border"
         aria-labelledby="archive-title">

    <div class="hero-grid opacity-40" aria-hidden="true"></div>

    <div class="relative z-10 max-w-screen-xl mx-auto">

        <!-- Label -->
        <div class="section-label reveal">
            <?php
            if ( is_category() )              esc_html_e( 'Category',  'sanjeep-portfolio' );
            elseif ( is_tag() )               esc_html_e( 'Tag',       'sanjeep-portfolio' );
            elseif ( is_tax( 'project_cat' ) ) esc_html_e( 'Projects', 'sanjeep-portfolio' );
            elseif ( is_author() )            esc_html_e( 'Author',    'sanjeep-portfolio' );
            elseif ( is_year() )              esc_html_e( 'Year',      'sanjeep-portfolio' );
            elseif ( is_month() )             esc_html_e( 'Month',     'sanjeep-portfolio' );
            else                              esc_html_e( 'Archive',   'sanjeep-portfolio' );
            ?>
        </div>

        <h1 id="archive-title"
            class="font-display font-extrabold text-sp-text-primary leading-none reveal"
            style="font-size:clamp(2.8rem,7vw,5.5rem);letter-spacing:-0.04em">
            <?php echo esc_html( $archive_title ); ?><span class="text-sp-accent">.</span>
        </h1>

        <?php if ( $archive_desc ) : ?>
        <p class="mt-5 text-sp-text-secondary font-light leading-relaxed reveal"
           style="font-size:1.05rem;max-width:520px">
            <?php echo wp_kses_post( $archive_desc ); ?>
        </p>
        <?php endif; ?>

        <!-- Post count -->
        <p class="mt-4 font-mono text-[0.65rem] tracking-widest uppercase text-sp-text-muted reveal">
            <?php printf(
                /* translators: %d: number of posts */
                esc_html( _n( '%d entry', '%d entries', $wp_query->found_posts, 'sanjeep-portfolio' ) ),
                absint( $wp_query->found_posts )
            ); ?>
        </p>
    </div>
</section>

<!-- ═══════════════════════════════════
     POSTS / PROJECTS GRID
════════════════════════════════════ -->
<div class="max-w-screen-xl mx-auto px-16 max-md:px-6 py-20">

    <?php if ( have_posts() ) : ?>

        <?php if ( $is_project_cat ) : ?>
        <!-- Project cards (same CPT card layout as homepage) -->
        <div class="flex flex-col" role="list"
             aria-label="<?php esc_attr_e( 'Projects', 'sanjeep-portfolio' ); ?>">
            <?php
            $i = 1;
            while ( have_posts() ) : the_post();
                $p_url  = get_field( 'proj_url' );
                $p_year = get_field( 'proj_year' );
                $p_type = get_field( 'proj_type' );
                $p_tags = get_field( 'proj_tags' ) ?: [];
                $p_link = get_permalink();
                $p_num  = str_pad( $i, 2, '0', STR_PAD_LEFT );
            ?>
            <a href="<?php echo esc_url( $p_link ); ?>"
               class="project-item reveal"
               role="listitem"
               style="animation-delay:<?php echo ( $i - 1 ) * 60; ?>ms">

                <div class="project-num" aria-hidden="true"><?php echo esc_html( $p_num ); ?></div>

                <div class="project-info">
                    <div class="project-name"><?php the_title(); ?></div>
                    <div class="project-meta">
                        <?php if ( $p_type ) : ?><span><?php echo esc_html( $p_type ); ?></span><span aria-hidden="true">•</span><?php endif; ?>
                        <?php if ( $p_year ) : ?><span><?php echo esc_html( $p_year ); ?></span><?php endif; ?>
                    </div>
                    <?php if ( ! empty( $p_tags ) ) : ?>
                    <div class="project-tags">
                        <?php foreach ( $p_tags as $pt ) :
                            $pl = is_array( $pt ) ? ( $pt['ptag'] ?? '' ) : $pt;
                            if ( ! $pl ) continue;
                        ?>
                        <span class="project-tag"><?php echo esc_html( $pl ); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="project-arrow" aria-hidden="true">↗</div>
            </a>
            <?php
                $i++;
            endwhile;
            ?>
        </div>

        <?php else : ?>
        <!-- Standard blog post grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-px bg-sp-border"
             role="list"
             aria-label="<?php esc_attr_e( 'Posts', 'sanjeep-portfolio' ); ?>">

            <?php
            $j = 0;
            while ( have_posts() ) : the_post(); ?>
            <article class="bg-sp-bg-2 p-8 flex flex-col gap-4 hover:bg-sp-surface
                            transition-colors duration-300 group reveal"
                     role="listitem"
                     style="animation-delay:<?php echo $j * 60; ?>ms">

                <?php if ( has_post_thumbnail() ) : ?>
                <a href="<?php the_permalink(); ?>" class="overflow-hidden block -mx-8 -mt-8 mb-4" tabindex="-1" aria-hidden="true">
                    <?php the_post_thumbnail( 'thumb', [
                        'class' => 'w-full object-cover h-44 group-hover:scale-105 transition-transform duration-700 opacity-70 group-hover:opacity-100',
                    ] ); ?>
                </a>
                <?php endif; ?>

                <!-- Category -->
                <?php
                $a_cats = get_the_category();
                if ( $a_cats ) : ?>
                <a href="<?php echo esc_url( get_category_link( $a_cats[0]->term_id ) ); ?>"
                   class="font-mono text-[0.6rem] tracking-widest uppercase text-sp-accent no-underline
                          hover:text-sp-text-primary transition-colors duration-200">
                    <?php echo esc_html( $a_cats[0]->name ); ?>
                </a>
                <?php endif; ?>

                <!-- Title -->
                <h2 style="font-size:1.05rem;letter-spacing:-0.02em">
                    <a href="<?php the_permalink(); ?>"
                       class="font-display font-bold text-sp-text-primary no-underline
                              group-hover:text-sp-accent transition-colors duration-200">
                        <?php the_title(); ?>
                    </a>
                </h2>

                <!-- Excerpt -->
                <p class="text-sp-text-secondary font-light text-sm leading-relaxed flex-1">
                    <?php echo wp_trim_words( get_the_excerpt(), 18 ); ?>
                </p>

                <!-- Meta -->
                <div class="flex items-center justify-between pt-4 border-t border-sp-border mt-auto">
                    <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"
                          class="font-mono text-[0.6rem] tracking-widest uppercase text-sp-text-muted">
                        <?php echo get_the_date( 'M j, Y' ); ?>
                    </time>
                    <span class="font-mono text-[0.6rem] tracking-widest uppercase text-sp-text-muted">
                        <?php printf( esc_html__( '%s min', 'sanjeep-portfolio' ), esc_html( sp_reading_time() ) ); ?>
                    </span>
                </div>
            </article>
            <?php
                $j++;
            endwhile;
            ?>
        </div>
        <?php endif; ?>

        <!-- Pagination -->
        <?php if ( $wp_query->max_num_pages > 1 ) : ?>
        <nav class="flex items-center justify-center gap-2 mt-16"
             aria-label="<?php esc_attr_e( 'Pagination', 'sanjeep-portfolio' ); ?>">
            <?php
            echo paginate_links( [
                'prev_text' => '← ' . __( 'Prev', 'sanjeep-portfolio' ),
                'next_text' => __( 'Next', 'sanjeep-portfolio' ) . ' →',
                'type'      => 'list',
                'before_page_number' => '',
            ] );
            ?>
        </nav>
        <?php endif; ?>

    <?php else : ?>

        <!-- Nothing found -->
        <div class="flex flex-col items-center justify-center py-32 text-center">
            <div class="font-display font-extrabold text-sp-border"
                 style="font-size:8rem;letter-spacing:-0.05em;line-height:1">
                0
            </div>
            <p class="font-mono text-[0.7rem] tracking-widest uppercase text-sp-text-muted mt-4">
                <?php esc_html_e( 'Nothing here yet.', 'sanjeep-portfolio' ); ?>
            </p>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
               class="btn-ghost mt-8">
                ← <?php esc_html_e( 'Back home', 'sanjeep-portfolio' ); ?>
            </a>
        </div>

    <?php endif; ?>

</div>

<?php get_footer(); ?>
