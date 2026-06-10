<?php
/**
 * Template Part: About Section
 */

$about_subtitle = get_field( 'about_subtitle');
$heading        = get_field( 'about_heading');
$content        = function_exists( 'get_field' ) ? get_field( 'about_content') : '';
$photo          = function_exists( 'get_field' ) ? get_field( 'about_photo') : null;
$availability   = get_field( 'about_availability');
$skills         = function_exists( 'get_field' ) ? get_field( 'about_skills') : [];

$default_skills = [
    'WordPress / ACF', 'React / Next.js', 'Tailwind CSS',
    'JavaScript / ES6+', 'PHP / WP REST API', 'Figma / UI Design',
    'Git / GitHub', 'Performance & SEO',
];

$default_content = '<p>I\'m a <strong>frontend developer</strong> from Kathmandu who lives at the intersection of design and code. I believe great websites aren\'t just functional — they\'re <strong>experiences</strong>.</p>
<p>With expertise in <strong>WordPress custom theme development</strong>, <strong>React</strong>, and modern CSS frameworks like Tailwind, I build fast, accessible, and visually compelling web products for businesses around the world.</p>
<p>When I\'m not writing code, I\'m exploring the mountains of Nepal or obsessing over design systems and typography.</p>';
?>

<section id="about" class="py-28 px-16 grid grid-cols-1 lg:grid-cols-2 gap-24 items-start max-w-screen-xl mx-auto" aria-labelledby="about-heading">

    <!-- Left: Text -->
    <div>
        <div class="section-label reveal">
            <?php echo $about_subtitle; ?>
        </div>

        <h2 id="about-heading" class="section-title reveal">
            <?php echo esc_html( $heading ); ?>
        </h2>

        <div class="about-text reveal">
            <?php
            if ( $content ) {
                echo wp_kses_post( $content );
            } else {
                echo wp_kses_post( $default_content );
            }
            ?>
        </div>

        <!-- Skills grid -->
        <div class="mt-12 reveal">
            <div class="grid grid-cols-2 gap-0">
                <?php
                $skill_list = ! empty( $skills )
                    ? array_map( fn( $s ) => $s['skill_name'] ?? '', $skills )
                    : $default_skills;

                foreach ( $skill_list as $skill ) :
                    if ( ! trim( $skill ) ) continue;
                ?>
                <div class="skill-item">
                    <?php echo esc_html( $skill ); ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Right: Photo -->
    <div class="relative reveal">
        <div class="about-img-frame">
            <?php if ( $photo && ! empty( $photo['url'] ) ) : ?>
                <img src="<?php echo esc_url( $photo['sizes']['portrait'] ?? $photo['url'] ); ?>"
                     alt="<?php echo esc_attr( $photo['alt'] ?? get_bloginfo( 'name' ) ); ?>"
                     width="600" height="750"
                     class="w-full h-full object-cover">
            <?php else : ?>
                <!-- Placeholder when no photo uploaded -->
                <div class="about-img-placeholder">
                    <div class="initials">SB</div>
                    <span><?php esc_html_e( 'Upload your photo in Portfolio → About', 'sanjeep-portfolio' ); ?></span>
                </div>
            <?php endif; ?>
        </div>

        <!-- Decorative corner box -->
        <div class="about-img-deco" aria-hidden="true"></div>

        <!-- Availability tag -->
        <?php if ( $availability ) : ?>
        <div class="about-img-tag" aria-label="<?php esc_attr_e( 'Availability', 'sanjeep-portfolio' ); ?>">
            <?php echo esc_html( $availability ); ?>
        </div>
        <?php endif; ?>
    </div>
</section>
