/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './**/*.php',
    './assets/js/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        'sp-bg':          '#0a0a0a',
        'sp-bg-2':        '#111111',
        'sp-bg-3':        '#1a1a1a',
        'sp-surface':     '#161616',
        'sp-border':      'rgba(255,255,255,0.08)',
        'sp-border-hover':'rgba(255,255,255,0.18)',
        'sp-text-primary':'#f0ede8',
        'sp-text-secondary':'#888580',
        'sp-text-muted':  '#444444',
        'sp-accent':      '#c8f04a',
        'sp-accent-dim':  'rgba(200,240,74,0.12)',
        'sp-accent-2':    '#ff6b35',
      },
      fontFamily: {
        display: ['Syne', 'sans-serif'],
        body:    ['DM Sans', 'sans-serif'],
        mono:    ['DM Mono', 'monospace'],
      },
      fontSize: {
        '2xs': ['0.65rem', { lineHeight: '1rem' }],
      },
      animation: {
        'scroll-left':   'scrollLeft 30s linear infinite',
        'scroll-right':  'scrollLeft 30s linear infinite reverse',
        'slide-up':      'slideUp 0.8s cubic-bezier(0.16,1,0.3,1) both',
        'fade-in':       'fadeIn 0.6s ease both',
      },
      keyframes: {
        scrollLeft: {
          from: { transform: 'translateX(0)' },
          to:   { transform: 'translateX(-50%)' },
        },
        slideUp: {
          from: { transform: 'translateY(110%)', opacity: 0 },
          to:   { transform: 'translateY(0)',    opacity: 1 },
        },
        fadeIn: {
          from: { opacity: 0 },
          to:   { opacity: 1 },
        },
      },
      maxWidth: {
        'screen-xl': '1400px',
      },
    },
  },
  plugins: [],
};
