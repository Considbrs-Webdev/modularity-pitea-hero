# Overlay Opacity Implementation Examples

This document shows multiple ways to implement the overlay opacity control for the Pitea Hero module.

## Current Implementation (Inline Style with Opacity)

**Location:** `source/php/Module/views/pitea-hero.blade.php` (line 12)

```blade
<div class="c-pitea-hero__overlay" style="opacity: {{ ($overlayOpacity ?? 50) / 100 }};"></div>
```

**Pros:**
- Simple and direct
- Works immediately without CSS changes
- Easy to understand

**Cons:**
- Inline styles can be harder to override
- Less semantic (opacity affects the entire overlay element)

---

## Alternative 1: CSS Custom Property (Recommended)

**Blade Template:**
```blade
<section class="c-pitea-hero" style="@if(!empty($backgroundImage['url'])) background-image: url('{{ $backgroundImage['url'] }}'); @endif --overlay-opacity: {{ ($overlayOpacity ?? 50) / 100 }};">
    <div class="c-pitea-hero__overlay"></div>
```

**SCSS:**
```scss
&__overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: var(--overlay-opacity, 0.5);
}
```

**Pros:**
- Clean separation of concerns
- Easy to override with CSS
- More maintainable
- Can be used for other styling if needed

**Cons:**
- Requires SCSS update

---

## Alternative 2: Background Color with RGBA

**Blade Template:**
```blade
<div class="c-pitea-hero__overlay" style="background-color: rgba(0, 0, 0, {{ ($overlayOpacity ?? 50) / 100 }});"></div>
```

**SCSS (if overlay needs base background):**
```scss
&__overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); // Fallback
}
```

**Pros:**
- More semantic (controls overlay darkness directly)
- Can specify overlay color (black, white, etc.)
- Works well if overlay has a background color

**Cons:**
- Requires knowing the overlay color
- If overlay is transparent, this won't work

---

## Alternative 3: CSS Variable with Background Color

**Blade Template:**
```blade
<section class="c-pitea-hero" style="@if(!empty($backgroundImage['url'])) background-image: url('{{ $backgroundImage['url'] }}'); @endif --overlay-opacity: {{ ($overlayOpacity ?? 50) / 100 }};">
    <div class="c-pitea-hero__overlay"></div>
```

**SCSS:**
```scss
&__overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, var(--overlay-opacity, 0.5));
}
```

**Pros:**
- Best of both worlds (CSS variable + background color)
- Can easily change overlay color in SCSS
- Clean and maintainable

**Cons:**
- Requires SCSS update
- Assumes overlay has a background color

---

## Alternative 4: Data Attribute with CSS

**Blade Template:**
```blade
<div class="c-pitea-hero__overlay" data-opacity="{{ $overlayOpacity ?? 50 }}"></div>
```

**SCSS:**
```scss
&__overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    
    &[data-opacity] {
        opacity: calc(var(--opacity-value) / 100);
    }
}

// Or with attribute selector
&__overlay[data-opacity="0"] { opacity: 0; }
&__overlay[data-opacity="25"] { opacity: 0.25; }
&__overlay[data-opacity="50"] { opacity: 0.5; }
&__overlay[data-opacity="75"] { opacity: 0.75; }
&__overlay[data-opacity="100"] { opacity: 1; }
```

**Pros:**
- Semantic HTML
- Can be styled with CSS
- Good for debugging (visible in HTML)

**Cons:**
- More complex CSS needed
- Limited precision with discrete values

---

## Alternative 5: Conditional Class Names

**Blade Template:**
```blade
@php
    $opacityValue = $overlayOpacity ?? 50;
    $opacityClass = 'c-pitea-hero__overlay--opacity-' . round($opacityValue / 10) * 10;
@endphp
<div class="c-pitea-hero__overlay {{ $opacityClass }}"></div>
```

**SCSS:**
```scss
&__overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    
    &--opacity-0 { opacity: 0; }
    &--opacity-10 { opacity: 0.1; }
    &--opacity-20 { opacity: 0.2; }
    &--opacity-30 { opacity: 0.3; }
    &--opacity-40 { opacity: 0.4; }
    &--opacity-50 { opacity: 0.5; }
    &--opacity-60 { opacity: 0.6; }
    &--opacity-70 { opacity: 0.7; }
    &--opacity-80 { opacity: 0.8; }
    &--opacity-90 { opacity: 0.9; }
    &--opacity-100 { opacity: 1; }
}
```

**Pros:**
- Pure CSS solution
- No inline styles
- Easy to cache/precompile

**Cons:**
- Limited precision (only 10% increments)
- More CSS code needed
- Requires PHP logic in template

---

## Recommendation

For this use case, **Alternative 1 (CSS Custom Property)** or **Alternative 3 (CSS Variable with Background Color)** are recommended because they:
- Keep styles in CSS files
- Are easy to maintain
- Provide full precision
- Allow easy overrides
- Work well with the existing architecture

The current implementation (inline style) is fine for a quick solution, but consider migrating to one of the CSS variable approaches for better maintainability.
