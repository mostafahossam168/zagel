---
name: Premium Arabic Marketplace
colors:
  surface: '#f9f9fe'
  surface-dim: '#dad9de'
  surface-bright: '#f9f9fe'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f3f3f8'
  surface-container: '#eeedf2'
  surface-container-high: '#e8e8ec'
  surface-container-highest: '#e2e2e7'
  on-surface: '#1a1c1f'
  on-surface-variant: '#43474f'
  inverse-surface: '#2f3034'
  inverse-on-surface: '#f1f0f5'
  outline: '#737780'
  outline-variant: '#c3c6d0'
  surface-tint: '#386092'
  primary: '#0f3f70'
  on-primary: '#ffffff'
  primary-container: '#2e5789'
  on-primary-container: '#accdff'
  inverse-primary: '#a4c9ff'
  secondary: '#006e2d'
  on-secondary: '#ffffff'
  secondary-container: '#5ffd86'
  on-secondary-container: '#00722f'
  tertiary: '#563900'
  on-tertiary: '#ffffff'
  tertiary-container: '#744e00'
  on-tertiary-container: '#f7c26f'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#d4e3ff'
  primary-fixed-dim: '#a4c9ff'
  on-primary-fixed: '#001c39'
  on-primary-fixed-variant: '#1c4879'
  secondary-fixed: '#68ff8b'
  secondary-fixed-dim: '#3fe26f'
  on-secondary-fixed: '#002108'
  on-secondary-fixed-variant: '#005320'
  tertiary-fixed: '#ffddaf'
  tertiary-fixed-dim: '#f3be6b'
  on-tertiary-fixed: '#281800'
  on-tertiary-fixed-variant: '#614000'
  background: '#f9f9fe'
  on-background: '#1a1c1f'
  surface-variant: '#e2e2e7'
typography:
  display-lg:
    fontFamily: Cairo
    fontSize: 48px
    fontWeight: '700'
    lineHeight: '1.2'
  display-md:
    fontFamily: Cairo
    fontSize: 36px
    fontWeight: '700'
    lineHeight: '1.3'
  headline-lg:
    fontFamily: Cairo
    fontSize: 28px
    fontWeight: '600'
    lineHeight: '1.4'
  headline-md:
    fontFamily: Cairo
    fontSize: 24px
    fontWeight: '600'
    lineHeight: '1.4'
  body-lg:
    fontFamily: Cairo
    fontSize: 18px
    fontWeight: '400'
    lineHeight: '1.6'
  body-md:
    fontFamily: Cairo
    fontSize: 16px
    fontWeight: '400'
    lineHeight: '1.6'
  label-lg:
    fontFamily: Cairo
    fontSize: 14px
    fontWeight: '600'
    lineHeight: '1.2'
  label-sm:
    fontFamily: Cairo
    fontSize: 12px
    fontWeight: '400'
    lineHeight: '1.2'
  headline-lg-mobile:
    fontFamily: Cairo
    fontSize: 24px
    fontWeight: '600'
    lineHeight: '1.4'
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  base: 4px
  xs: 4px
  sm: 8px
  md: 16px
  lg: 24px
  xl: 32px
  xxl: 48px
  grid-columns: '12'
  gutter: 24px
  margin-mobile: 16px
  margin-desktop: auto
---

## Brand & Style

The visual identity of this design system is rooted in the concept of "The Trusted Facilitator." It balances the heritage and hospitality of the Arabic service market with the efficiency of a premium digital platform. The aesthetic is categorized as **Corporate Modern**, prioritizing clarity, high-end finishing, and structural integrity to evoke a sense of security and professional excellence.

The target audience ranges from high-net-worth individuals seeking bespoke services to specialized professionals. Consequently, the UI avoids trendy clutter in favor of generous whitespace, precise alignment, and a sophisticated color interplay that communicates reliability. Every interaction is designed to feel intentional and frictionless, honoring the user's time and cultural context.

## Colors

The palette is led by **Deep Blue**, a color associated with depth, expertise, and stability in the corporate world. It serves as the primary anchor for navigation and primary actions. **Vibrant Green** is utilized strategically for success states and growth-oriented calls to action, providing a refreshing contrast. **Warm Orange** acts as an energetic accent for highlights or urgent notifications.

Surface colors utilize a "Light BG" to maintain a breezy, high-end feel, while the "Dark" and "Text Dark" tones ensure high legibility and an authoritative typographic presence. Status colors are mapped to traditional semantic expectations: Yellow for pending (معلق), Green for accepted (مقبول), and Red for rejected (مرفوض), ensuring immediate cognitive recognition in the marketplace dashboard.

## Typography

The design system exclusively utilizes **Cairo**, a font meticulously crafted for Arabic and Latin scripts. Its geometric yet humanistic qualities align perfectly with the modern-professional tone. 

- **Headlines (700 Bold):** Used for primary page titles and high-level section headers to establish immediate hierarchy.
- **Sub-headers (600 SemiBold):** Used for card titles and secondary navigation elements.
- **Body Text (400 Regular):** Optimized for readability with a slightly increased line height (1.6) to accommodate Arabic diacritics and character complexity.

All typography is set with Right-to-Left (RTL) alignment as the default, ensuring that line endings and reading flow feel natural to Arabic speakers. On mobile devices, display sizes scale down to maintain screen real estate while preserving the relative hierarchy between headings and body content.

## Layout & Spacing

This design system employs a **12-column fluid grid** for desktop, allowing for flexible content arrangements while maintaining a strict vertical rhythm based on an 8px square grid. 

- **RTL Logic:** Layouts are mirrored. The primary navigation, logo, and "start of line" begin on the right. Sidebars are docked to the right, and content flows toward the left.
- **Margins:** Desktop containers use an `auto` margin with a max-width of 1200px to ensure the premium feel isn't lost on ultra-wide monitors. Mobile devices use a strict 16px safe area on both edges.
- **Gaps:** A consistent 24px gutter is used between major cards and sections to provide visual "breathing room," reinforcing the premium positioning.

## Elevation & Depth

Hierarchy is established through **Ambient Shadows** and tonal layering. The primary surface is the "Light BG" (#f8f9fa), upon which white cards (#ffffff) are placed to signify interactive or contained information.

Shadows are used sparingly but effectively. The standard elevation for cards and buttons uses a subtle, diffused blur: `0 4px 24px rgba(0,0,0,0.08)`. This creates a soft lift that suggests the element is floating just above the surface without appearing heavy or dated. 

For interactive states (like hovering over a service card), the shadow may deepen slightly, or a very thin 1px border in the primary color may be added to provide a "focus" feel without disrupting the clean aesthetic.

## Shapes

The shape language is defined by a **10px (0.625rem)** border radius. This specific rounding is chosen to feel "Soft" yet "Structured." It avoids the aggressive sharpness of a 0px radius, which can feel too industrial, and the playfulness of a fully pill-shaped design, which can undermine the "Premium/Professional" brand promise.

This 10px radius is applied consistently across:
- Primary and Secondary buttons.
- Input fields.
- Service cards.
- Modal containers.

Small elements like status badges use a more pronounced rounding (Pill-shaped) to distinguish them as non-structural, purely informational tags.

## Components

### Buttons
- **Primary:** Solid #2E5789 with white text. High emphasis for main marketplace actions (e.g., "Request Service").
- **Outline:** 1.5px border of #2E5789 with primary color text. Used for secondary actions.
- **Ghost:** No background or border. Used for tertiary actions or navigation within cards.

### Input Fields
Inputs feature a subtle light grey background with a 10px radius. On focus, the border transitions to Primary Blue. In the RTL context, the label and placeholder text are right-aligned, and any icons (like search or currency symbols) are positioned to account for the reading direction (e.g., a "search" icon at the far left or right depending on its functional role).

### White Cards
The cornerstone of the marketplace UI. These use a pure white background, the 10px border radius, and the signature 0 4px 24px shadow. Content inside cards should follow the 16px (md) internal padding rule.

### Status Badges
Small, high-contrast labels with pill-shaped rounding.
- **معلق (Pending):** Yellow background, dark text.
- **مقبول (Accepted):** Green background, white text.
- **مرفوض (Rejected):** Red background, white text.

### RTL Specifics
Navigation arrows and progress indicators must be mirrored. A "Back" arrow points right (`→`), and a "Forward" or "Next" arrow points left (`←`).