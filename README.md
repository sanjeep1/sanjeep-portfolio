# Sanjeep Portfolio — WordPress Theme

A custom dark editorial portfolio theme built with **Tailwind CSS v3** and **Advanced Custom Fields (ACF)**.

---

## Requirements

| Requirement | Version |
|---|---|
| WordPress | 6.0+ |
| PHP | 8.0+ |
| ACF Pro | 6.x (free version works too) |
| Node.js | 18+ |
| npm | 9+ |

---

## Installation

### 1 — Upload the theme

Copy the `sanjeep-portfolio` folder to:
```
wp-content/themes/sanjeep-portfolio/
```
Then go to **Appearance → Themes** and activate it.

### 2 — Install ACF

Install the **Advanced Custom Fields** plugin (free or Pro). The theme registers all field groups automatically via `acf_add_local_field_group()` — no JSON import needed.

### 3 — Rebuild CSS (if you edit styles)

```bash
cd wp-content/themes/sanjeep-portfolio/
npm install
npm run build   # one-time production build
npm run dev     # watch mode while developing
```

The compiled `assets/css/main.css` is included in the zip so you don't *need* to build unless you edit styles.

---

## Navigation setup

1. Go to **Appearance → Menus**
2. Create a menu, add Custom Links pointing to `#about`, `#services`, `#work`, `#stack`
3. For the CTA button (Hire me), add the link and give it the CSS class `cta`
4. Assign to the **Primary Navigation** location

---

## File structure

```
sanjeep-portfolio/
├── style.css                   # Theme header (WP requires this)
├── functions.php               # Theme setup, ACF fields, CPT, AJAX
├── header.php                  # Nav + cursor markup
├── footer.php                  # Footer + back-to-top
├── front-page.php              # Homepage template
├── index.php                   # Fallback template
├── tailwind.config.js          # Tailwind design tokens
├── package.json                # npm scripts
├── template-parts/
│   └── sections/
│       ├── hero.php
│       ├── about.php
│       ├── services.php
│       ├── work.php
│       ├── stack.php
│       └── contact.php
└── assets/
    ├── css/
    │   ├── input.css           # Tailwind source (edit this)
    │   └── main.css            # Compiled output (auto-generated)
    └── js/
        └── main.js             # Cursor, nav, form, animations
```

---

## Customization

### Colors
Edit the tokens in `tailwind.config.js` under `theme.extend.colors`:
```js
'sp-accent': '#c8f04a',   // lime green accent — change to your color
'sp-bg':     '#0a0a0a',   // background
```
Then run `npm run build` to recompile.

### Fonts
Swap Google Fonts in `functions.php` (the `sp-fonts` enqueue) and update `tailwind.config.js`:
```js
fontFamily: {
  display: ['YourFont', 'sans-serif'],
  body:    ['YourBodyFont', 'sans-serif'],
  mono:    ['YourMonoFont', 'monospace'],
},
```

### Adding sections
1. Create `template-parts/sections/your-section.php`
2. Add `get_template_part('template-parts/sections/your-section')` to `front-page.php`
3. Register ACF fields for it in `functions.php`

---

## Performance tips

- Use **WP Rocket** or **LiteSpeed Cache** for caching
- Run images through **ShortPixel** or **Imagify**
- The theme already uses `defer` for JS and Google Fonts with `display=swap`
- Compiled Tailwind CSS is ~30KB (minified) — purge is automatic via content scanning

---