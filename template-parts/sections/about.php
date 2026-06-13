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

<section id="about" class="py-28 px-6 lg:px-16 grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24 items-start max-w-screen-xl mx-auto" aria-labelledby="about-heading">

    <!-- Left -->
    <div>
        <div class="section-label reveal">
            <?php echo esc_html($about_subtitle); ?>
        </div>

        <h2 id="about-heading" class="section-title reveal">
            <?php echo esc_html($heading); ?><span class="text-sp-accent">.</span>
        </h2>

        <div class="about-text reveal text-sp-text-secondary font-light leading-loose text-[1.05rem]">
            <?php
            if ($content) {
                echo wp_kses_post($content);
            } else {
                echo wp_kses_post($default_content);
            }
            ?>
        </div>

        <!-- Skills -->
        <div class="mt-12 reveal">
            <div class="grid grid-cols-1 sm:grid-cols-2">
                <?php
                $skill_list = !empty($skills)
                    ? array_map(fn($s) => $s['skill_name'] ?? '', $skills)
                    : $default_skills;

                foreach ($skill_list as $skill) :
                    if (!trim($skill)) continue;
                ?>
                    <div class="skill-item flex items-center gap-3 py-3.5 font-mono text-xs tracking-wide text-sp-text-secondary border-b transition-all duration-200 hover:text-sp-text-primary hover:pl-2">
                        <?php echo esc_html($skill); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Right -->
    <div class="relative reveal">
        <div class="about-img-frame overflow-hidden rounded bg-[var(--bg-3)] aspect-[4/5]">
            <?php if ($photo && !empty($photo['url'])) : ?>
                <img
                    src="<?php echo esc_url($photo['sizes']['portrait'] ?? $photo['url']); ?>"
                    alt="<?php echo esc_attr($photo['alt'] ?? get_bloginfo('name')); ?>"
                    width="600"
                    height="750"
                    class="w-full h-full object-cover transition-transform duration-[800ms] ease-[cubic-bezier(0.16,1,0.3,1)] hover:scale-[1.03]">
            <?php else : ?>
                <div class="w-full h-full flex flex-col items-center justify-center gap-3 bg-[var(--surface)] text-[var(--text-muted)] font-mono text-[0.7rem] tracking-[0.12em] uppercase">
                    <div class="font-display font-extrabold text-[5rem] tracking-[-0.04em] text-[var(--border-hover)]">
                        SB
                    </div>

                    <span>
                        <?php esc_html_e('Upload your photo in Portfolio → About', 'sanjeep-portfolio'); ?>
                    </span>
                </div>
            <?php endif; ?>
        </div>

        <!-- Decoration -->
        <div class="about-img-deco absolute -bottom-6 -left-6 w-[120px] h-[120px] border rounded-sm bg-[var(--accent-dim)] -z-10"></div>

        <!-- Availability -->
        <?php if ($availability) : ?>
            <div
                class="absolute top-6 -right-6 bg-[var(--accent)] text-[var(--bg)] font-mono uppercase font-medium tracking-[0.2em] text-[0.65rem] px-4 py-2 rounded-sm [writing-mode:vertical-rl]"
                aria-label="<?php esc_attr_e('Availability', 'sanjeep-portfolio'); ?>">
                <?php echo esc_html($availability); ?>
            </div>
        <?php endif; ?>
    </div>

</section>