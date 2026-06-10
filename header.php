<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class( 'bg-sp-bg text-sp-text-primary overflow-x-hidden' ); ?>>
<?php wp_body_open(); ?>

<!-- Custom cursor (hidden on touch devices via CSS) -->
<div id="sp-cursor"      aria-hidden="true"></div>
<div id="sp-cursor-ring" aria-hidden="true"></div>

<?php
/* ─────────────────────────────────────────────
   NAV WALKER  — desktop list items
   Reads the CSS class "cta" set in
   Appearance → Menus → CSS Classes (optional field)
   to render the last item as a button-style link.
───────────────────────────────────────────── */
class SP_Nav_Walker extends Walker_Nav_Menu {
    public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
        $item    = $data_object;
        $classes = empty( $item->classes ) ? [] : (array) $item->classes;
        $is_cta  = in_array( 'cta', $classes, true );
        $url     = $item->url;
        $title   = apply_filters( 'the_title', $item->title, $item->ID );
        $target  = $item->target ? ' target="' . esc_attr( $item->target ) . '"' : '';
        $rel     = $item->xfn   ? ' rel="' . esc_attr( $item->xfn ) . '"'       : '';

        if ( $is_cta ) {
            $output .= sprintf(
                '<li class="list-none"><a href="%s"%s%s class="nav-link-cta">%s</a></li>',
                esc_url( $url ), $target, $rel, esc_html( $title )
            );
        } else {
            $current = in_array( 'current-menu-item', $classes, true );
            $output .= sprintf(
                '<li class="list-none"><a href="%s"%s%s class="nav-link%s">%s</a></li>',
                esc_url( $url ), $target, $rel,
                $current ? ' nav-link--active' : '',
                esc_html( $title )
            );
        }
    }
}

/* ─────────────────────────────────────────────
   MOBILE WALKER — large stacked links for drawer
───────────────────────────────────────────── */
class SP_Mobile_Walker extends Walker_Nav_Menu {

    public function start_el(
        &$output,
        $data_object,
        $depth = 0,
        $args = null,
        $current_object_id = 0
    ) {

        $item    = $data_object;
        $classes = empty( $item->classes ) ? [] : (array) $item->classes;

        $is_cta = in_array( 'cta', $classes, true );

        $url    = $item->url;
        $title  = apply_filters( 'the_title', $item->title, $item->ID );

        $target = $item->target
            ? ' target="' . esc_attr( $item->target ) . '"'
            : '';

        $rel = $item->xfn
            ? ' rel="' . esc_attr( $item->xfn ) . '"'
            : '';

        if ( $is_cta ) {

            $output .= sprintf(
                '<li class="list-none mt-4">
                    <a href="%s"%s%s class="mobile-nav-link--cta">%s</a>
                </li>',
                esc_url( $url ),
                $target,
                $rel,
                esc_html( $title )
            );

        } else {

            $output .= sprintf(
                '<li class="list-none">
                    <a href="%s"%s%s class="mobile-nav-link">%s</a>
                </li>',
                esc_url( $url ),
                $target,
                $rel,
                esc_html( $title )
            );

        }
    }
}
/* ─────────────────────────────────────────────
   FALLBACK  — shown when no menu is assigned yet
───────────────────────────────────────────── */
function sp_fallback_nav(): void { ?>
    <ul class="flex items-center gap-10 list-none p-0 m-0">
        <li><a href="#about"      class="nav-link">About</a></li>
        <li><a href="#experience" class="nav-link">Experience</a></li>
        <li><a href="#services"   class="nav-link">Services</a></li>
        <li><a href="#work"       class="nav-link">Work</a></li>
        <li><a href="#stack"      class="nav-link">Stack</a></li>
        <li><a href="#contact"    class="nav-link-cta">Hire me ↗</a></li>
    </ul>
<?php }

function sp_mobile_fallback_nav(): void { ?>
    <ul class="flex flex-col items-center gap-8 list-none p-0 m-0">
        <li><a href="#about"      class="mobile-nav-link">About</a></li>
        <li><a href="#experience" class="mobile-nav-link">Experience</a></li>
        <li><a href="#services"   class="mobile-nav-link">Services</a></li>
        <li><a href="#work"       class="mobile-nav-link">Work</a></li>
        <li><a href="#stack"      class="mobile-nav-link">Stack</a></li>
        <li><a href="#contact"    class="mobile-nav-link mobile-nav-link--cta">Hire me ↗</a></li>
    </ul>
<?php }
?>

<!-- ═══════════════════════════════════════
     HEADER / DESKTOP NAV
════════════════════════════════════════ -->
<header id="sp-nav" role="banner"
    class="fixed top-0 left-0 right-0 z-50
           flex items-center justify-between
           px-16 max-md:px-6 py-5
           backdrop-blur-xl bg-sp-bg/85
           border-b border-transparent
           transition-all duration-300">

    <!-- Logo -->
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
       class="font-display text-xl font-extrabold tracking-tight text-sp-text-primary no-underline shrink-0 z-10"
       aria-label="<?php bloginfo( 'name' ); ?>">
        SB<span class="text-sp-accent">.</span>
    </a>

    <!-- Desktop nav — hidden below md -->
    <nav class="hidden md:block"
         aria-label="<?php esc_attr_e( 'Primary navigation', 'sanjeep-portfolio' ); ?>">
        <?php wp_nav_menu( [
            'theme_location' => 'primary',
            'container'      => false,
            'menu_class'     => 'flex items-center gap-10 list-none p-0 m-0',
            'fallback_cb'    => 'sp_fallback_nav',
            'walker'         => new SP_Nav_Walker(),
            'depth'          => 1,
        ] ); ?>
    </nav>

    <!-- Hamburger — visible below md -->
    <button id="sp-menu-toggle"
            class="md:hidden relative z-10 flex flex-col justify-center gap-[5px] w-10 h-10 p-2 shrink-0"
            aria-label="<?php esc_attr_e( 'Open menu', 'sanjeep-portfolio' ); ?>"
            aria-expanded="false"
            aria-controls="sp-mobile-menu">
        <!-- Three bars; JS adds [open] attribute to header to animate them -->
        <span class="block h-px bg-sp-text-primary transition-all duration-300 origin-center
                     [[open]_&]:translate-y-[6px] [[open]_&]:rotate-45 w-6"></span>
        <span class="block h-px bg-sp-accent   transition-all duration-300
                     [[open]_&]:opacity-0 w-4"></span>
        <span class="block h-px bg-sp-text-primary transition-all duration-300 origin-center
                     [[open]_&]:-translate-y-[6px] [[open]_&]:-rotate-45 w-6"></span>
    </button>
</header>

<!-- ═══════════════════════════════════════
     MOBILE DRAWER
════════════════════════════════════════ -->
<div id="sp-mobile-menu"
     role="dialog"
     aria-modal="true"
     aria-label="<?php esc_attr_e( 'Mobile navigation', 'sanjeep-portfolio' ); ?>"
     class="fixed inset-0 z-40
            flex flex-col items-center justify-center gap-2
            bg-sp-bg/[0.97] backdrop-blur-2xl
            translate-x-full transition-transform duration-500 ease-in-out
            md:hidden">

    <!-- Nav links pulled from the same WP menu -->
    <nav aria-label="<?php esc_attr_e( 'Mobile menu', 'sanjeep-portfolio' ); ?>">
        <?php wp_nav_menu( [
            'theme_location' => 'primary',
            'container'      => false,
            'menu_class'     => 'flex flex-col items-center gap-6 list-none p-0 m-0',
            'fallback_cb'    => 'sp_mobile_fallback_nav',
            'walker'         => new SP_Mobile_Walker(),
            'depth'          => 1,
        ] ); ?>
    </nav>

    <!-- Social row -->
    <?php
    $github   = function_exists( 'get_field' ) ? get_field( 'contact_github') : '';
    $linkedin = function_exists( 'get_field' ) ? get_field( 'contact_linkedin') : '';
    if ( $github || $linkedin ) : ?>
    <div class="flex items-center gap-6 mt-10 pt-8 border-t border-sp-border w-40 justify-center">
        <?php if ( $github ) : ?>
        <a href="<?php echo esc_url( $github ); ?>"
           target="_blank" rel="noopener noreferrer"
           class="font-mono text-[0.65rem] tracking-widest uppercase text-sp-text-muted hover:text-sp-accent transition-colors duration-200">
            GitHub
        </a>
        <?php endif; ?>
        <?php if ( $linkedin ) : ?>
        <a href="<?php echo esc_url( $linkedin ); ?>"
           target="_blank" rel="noopener noreferrer"
           class="font-mono text-[0.65rem] tracking-widest uppercase text-sp-text-muted hover:text-sp-accent transition-colors duration-200">
            LinkedIn
        </a>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>

<main id="main" tabindex="-1">
