/**
 * Sanjeep Portfolio — main.js
 * Cursor · Nav · Reveal · Contact form · Back-to-top · Mobile menu
 */

( function () {
  'use strict';

  /* ────────────────────────────────────────
     CUSTOM CURSOR
  ─────────────────────────────────────────- */
  const cursor = document.getElementById( 'sp-cursor' );
  const ring   = document.getElementById( 'sp-cursor-ring' );

  if ( cursor && ring && window.matchMedia( '(pointer: fine)' ).matches ) {
    let mx = 0, my = 0, rx = 0, ry = 0;

    document.addEventListener( 'mousemove', ( e ) => {
      mx = e.clientX;
      my = e.clientY;
      cursor.style.left = mx + 'px';
      cursor.style.top  = my + 'px';
    } );

    const animateRing = () => {
      rx += ( mx - rx ) * 0.12;
      ry += ( my - ry ) * 0.12;
      ring.style.left = rx + 'px';
      ring.style.top  = ry + 'px';
      requestAnimationFrame( animateRing );
    };
    animateRing();

    // Hover state
    const hoverEls = 'a, button, .service-card, .project-item, .skill-item, label, select, input, textarea';
    document.addEventListener( 'mouseover', ( e ) => {
      if ( e.target.closest( hoverEls ) ) {
        cursor.classList.add( 'is-hover' );
        ring.classList.add( 'is-hover' );
      }
    } );
    document.addEventListener( 'mouseout', ( e ) => {
      if ( e.target.closest( hoverEls ) ) {
        cursor.classList.remove( 'is-hover' );
        ring.classList.remove( 'is-hover' );
      }
    } );

    // Hide cursor when leaving window
    document.addEventListener( 'mouseleave', () => {
      cursor.style.opacity = '0';
      ring.style.opacity   = '0';
    } );
    document.addEventListener( 'mouseenter', () => {
      cursor.style.opacity = '1';
      ring.style.opacity   = '1';
    } );
  }

  /* ────────────────────────────────────────
     NAV — scroll state + active links
  ─────────────────────────────────────────- */
  const nav = document.getElementById( 'sp-nav' );

  if ( nav ) {
    const onScroll = () => {
      nav.classList.toggle( 'scrolled', window.scrollY > 60 );
    };
    window.addEventListener( 'scroll', onScroll, { passive: true } );
    onScroll();

    // Highlight active section in nav
    const sections = document.querySelectorAll( 'section[id]' );
    const navLinks  = document.querySelectorAll( '.nav-link' );

    const sectionObserver = new IntersectionObserver(
      ( entries ) => {
        entries.forEach( ( entry ) => {
          if ( entry.isIntersecting ) {
            navLinks.forEach( ( link ) => {
              link.classList.toggle(
                'text-sp-accent',
                link.getAttribute( 'href' ) === '#' + entry.target.id
              );
            } );
          }
        } );
      },
      { threshold: 0.35 }
    );

    sections.forEach( ( s ) => sectionObserver.observe( s ) );
  }

  /* ────────────────────────────────────────
     MOBILE MENU
  ─────────────────────────────────────────- */
  const menuToggle = document.getElementById( 'sp-menu-toggle' );
  const mobileMenu = document.getElementById( 'sp-mobile-menu' );

  if ( menuToggle && mobileMenu ) {
    let menuOpen = false;

    const toggleMenu = () => {
      menuOpen = ! menuOpen;
      mobileMenu.classList.toggle( 'translate-x-full', ! menuOpen );
      mobileMenu.setAttribute( 'aria-hidden', String( ! menuOpen ) );
      menuToggle.setAttribute( 'aria-expanded', String( menuOpen ) );
      document.body.style.overflow = menuOpen ? 'hidden' : '';
    };

    menuToggle.addEventListener( 'click', toggleMenu );

    // Close on link click
    mobileMenu.querySelectorAll( 'a' ).forEach( ( link ) => {
      link.addEventListener( 'click', () => {
        if ( menuOpen ) toggleMenu();
      } );
    } );

    // Close on Escape
    document.addEventListener( 'keydown', ( e ) => {
      if ( e.key === 'Escape' && menuOpen ) toggleMenu();
    } );
  }

  /* ────────────────────────────────────────
     REVEAL ON SCROLL
  ─────────────────────────────────────────- */
  const revealObserver = new IntersectionObserver(
    ( entries ) => {
      entries.forEach( ( entry ) => {
        if ( entry.isIntersecting ) {
          entry.target.classList.add( 'visible' );
          revealObserver.unobserve( entry.target );
        }
      } );
    },
    { threshold: 0.1, rootMargin: '0px 0px -50px 0px' }
  );

  document.querySelectorAll( '.reveal' ).forEach( ( el ) => {
    revealObserver.observe( el );
  } );

  /* ────────────────────────────────────────
     BACK TO TOP
  ─────────────────────────────────────────- */
  const backTop = document.getElementById( 'sp-back-top' );

  if ( backTop ) {
    window.addEventListener( 'scroll', () => {
      backTop.classList.toggle( 'visible', window.scrollY > 600 );
    }, { passive: true } );

    backTop.addEventListener( 'click', () => {
      window.scrollTo( { top: 0, behavior: 'smooth' } );
    } );
  }

  /* ────────────────────────────────────────
     CONTACT FORM — AJAX
  ─────────────────────────────────────────- */
  const form   = document.getElementById( 'sp-contact-form' );
  const status = document.getElementById( 'sp-form-status' );

  if ( form && status && typeof spData !== 'undefined' ) {
    const btn       = document.getElementById( 'sp-form-btn' );
    const btnLabel  = btn.querySelector( '.btn-label' );
    const btnLoad   = btn.querySelector( '.btn-loading' );

    const setLoading = ( loading ) => {
      btn.disabled            = loading;
      btnLabel.style.display  = loading ? 'none'   : 'inline';
      btnLoad.style.display   = loading ? 'inline' : 'none';
    };

    const showError = ( id, msg ) => {
      const el = document.getElementById( id );
      if ( el ) el.textContent = msg;
    };

    const clearErrors = () => {
      [ 'sp-name-error', 'sp-email-error', 'sp-message-error' ].forEach( ( id ) => {
        const el = document.getElementById( id );
        if ( el ) el.textContent = '';
      } );
      form.querySelectorAll( '.error' ).forEach( ( el ) => el.classList.remove( 'error' ) );
    };

    const validate = () => {
      let valid = true;

      const name    = form.querySelector( '#sp-name' );
      const email   = form.querySelector( '#sp-email' );
      const message = form.querySelector( '#sp-message' );

      if ( ! name.value.trim() ) {
        showError( 'sp-name-error', 'Please enter your name.' );
        name.classList.add( 'error' );
        valid = false;
      }

      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if ( ! emailRegex.test( email.value.trim() ) ) {
        showError( 'sp-email-error', 'Please enter a valid email address.' );
        email.classList.add( 'error' );
        valid = false;
      }

      if ( message.value.trim().length < 20 ) {
        showError( 'sp-message-error', 'Please write at least 20 characters.' );
        message.classList.add( 'error' );
        valid = false;
      }

      return valid;
    };

    form.addEventListener( 'submit', async ( e ) => {
      e.preventDefault();
      clearErrors();

      if ( ! validate() ) return;

      setLoading( true );
      status.textContent  = '';
      status.className    = 'form-status mt-4 font-mono text-xs tracking-wide';

      const data = new FormData( form );
      data.set( 'action', 'sp_contact' );
      data.set( 'nonce',  spData.nonce );

      try {
        const res  = await fetch( spData.ajaxUrl, { method: 'POST', body: data } );
        const json = await res.json();

        if ( json.success ) {
          status.textContent = json.data.message || "Thanks! I'll be in touch soon.";
          status.classList.add( 'success' );
          form.reset();
        } else {
          status.textContent = json.data.message || 'Something went wrong. Please try again.';
          status.classList.add( 'error' );
        }
      } catch ( err ) {
        status.textContent = 'Network error. Please email me directly.';
        status.classList.add( 'error' );
      } finally {
        setLoading( false );
      }
    } );

    // Clear error on input
    form.querySelectorAll( '.form-input, .form-textarea' ).forEach( ( el ) => {
      el.addEventListener( 'input', () => {
        el.classList.remove( 'error' );
      } );
    } );
  }

  /* ────────────────────────────────────────
     STACK MARQUEE — pause on reduced motion
  ─────────────────────────────────────────- */
  if ( window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ) {
    const track = document.querySelector( '.stack-track' );
    if ( track ) track.style.animationPlayState = 'paused';
  }

  /* ────────────────────────────────────────
     SMOOTH ANCHOR SCROLLING (offset for fixed nav)
  ─────────────────────────────────────────- */
  document.querySelectorAll( 'a[href^="#"]' ).forEach( ( anchor ) => {
    anchor.addEventListener( 'click', ( e ) => {
      const id     = anchor.getAttribute( 'href' ).slice( 1 );
      const target = document.getElementById( id );
      if ( ! target ) return;

      e.preventDefault();
      const navHeight = nav ? nav.offsetHeight : 0;
      const top       = target.getBoundingClientRect().top + window.scrollY - navHeight - 20;
      window.scrollTo( { top, behavior: 'smooth' } );
    } );
  } );

} )();