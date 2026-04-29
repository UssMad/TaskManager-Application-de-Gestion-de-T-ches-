---
name: Kinetic Minimalist
colors:
  surface: '#fcf8ff'
  surface-dim: '#dcd8e5'
  surface-bright: '#fcf8ff'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f5f2ff'
  surface-container: '#f0ecf9'
  surface-container-high: '#eae6f4'
  surface-container-highest: '#e4e1ee'
  on-surface: '#1b1b24'
  on-surface-variant: '#464555'
  inverse-surface: '#302f39'
  inverse-on-surface: '#f3effc'
  outline: '#777587'
  outline-variant: '#c7c4d8'
  surface-tint: '#4d44e3'
  primary: '#3525cd'
  on-primary: '#ffffff'
  primary-container: '#4f46e5'
  on-primary-container: '#dad7ff'
  inverse-primary: '#c3c0ff'
  secondary: '#006c49'
  on-secondary: '#ffffff'
  secondary-container: '#6cf8bb'
  on-secondary-container: '#00714d'
  tertiary: '#7e3000'
  on-tertiary: '#ffffff'
  tertiary-container: '#a44100'
  on-tertiary-container: '#ffd2be'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#e2dfff'
  primary-fixed-dim: '#c3c0ff'
  on-primary-fixed: '#0f0069'
  on-primary-fixed-variant: '#3323cc'
  secondary-fixed: '#6ffbbe'
  secondary-fixed-dim: '#4edea3'
  on-secondary-fixed: '#002113'
  on-secondary-fixed-variant: '#005236'
  tertiary-fixed: '#ffdbcc'
  tertiary-fixed-dim: '#ffb695'
  on-tertiary-fixed: '#351000'
  on-tertiary-fixed-variant: '#7b2f00'
  background: '#fcf8ff'
  on-background: '#1b1b24'
  surface-variant: '#e4e1ee'
typography:
  h1:
    fontFamily: Inter
    fontSize: 32px
    fontWeight: '600'
    lineHeight: 40px
    letterSpacing: -0.02em
  h2:
    fontFamily: Inter
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px
    letterSpacing: -0.015em
  h3:
    fontFamily: Inter
    fontSize: 18px
    fontWeight: '600'
    lineHeight: 28px
    letterSpacing: -0.01em
  body-base:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 24px
    letterSpacing: '0'
  body-sm:
    fontFamily: Inter
    fontSize: 13px
    fontWeight: '400'
    lineHeight: 20px
    letterSpacing: '0'
  label-md:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '500'
    lineHeight: 16px
    letterSpacing: 0.02em
  button:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '500'
    lineHeight: 20px
    letterSpacing: '0'
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
  xl: 40px
  container-margin: 32px
  gutter: 20px
---

## Brand & Style
The design system is rooted in high-efficiency professional workflows, blending the utility of a productivity tool with the aesthetic refinement of a premium SaaS product. It prioritizes clarity, speed, and a reduced cognitive load, evoking an emotional response of organized calm and technical precision.

The style is **Minimalist-Modern**. It leverages heavy whitespace, a disciplined monochromatic foundation, and subtle elevation to create a sense of structural integrity. By stripping away unnecessary ornamentation, the design system ensures that the user's data and tasks remain the focal point, while "Linear-inspired" interactions provide a tactile, responsive feel.

## Colors
The palette is dominated by a neutral scale to maintain a clean, "Notion-like" canvas. 
- **Neutral Base:** Used for backgrounds, borders, and secondary text to create a hierarchical structure without color fatigue.
- **Primary Accent (Indigo):** Reserved for primary actions, focus states, and progress indicators to draw the eye to the most important elements.
- **Semantic Accents:** Utilized sparingly for status badges. Green represents completion, while Blue/Indigo represents active states, and Grays represent pending or inactive states.

## Typography
This design system utilizes **Inter** for all interfaces to ensure maximum legibility and a systematic, utilitarian feel. 
- **Hierarchy:** Established through significant weight shifts (600 for headers vs 400 for body) rather than large size differences.
- **Type Scale:** A slightly tighter-than-default scale is used to accommodate information-dense dashboards.
- **Letter Spacing:** Headlines utilize negative tracking to feel more "custom" and editorial, while labels use slight positive tracking for readability at small sizes.

## Layout & Spacing
The layout follows a **Fixed-Fluid hybrid** model. Sidebars and navigation panels are fixed width (typically 240px-280px), while the main content area remains fluid with a max-width constraint of 1440px to prevent excessive line lengths.

A strict **4px baseline grid** governs all spacing. Vertical rhythm is maintained by using 16px (md) and 24px (lg) increments for component separation. Information density is kept "spacious" to emulate the breathing room found in Linear's interface.

## Elevation & Depth
Depth is communicated through **Ambient Shadows** and **Tonal Layers** rather than heavy borders.
- **Level 0 (Base):** Gray-50 background for the overall app workspace.
- **Level 1 (Surface):** White cards or panels with a 1px border (Gray-200) and a very soft, diffused shadow (0px 4px 12px rgba(0,0,0,0.03)).
- **Level 2 (Overlay):** Modals and dropdowns use a more pronounced shadow (0px 12px 24px rgba(0,0,0,0.08)) to appear physically closer to the user.
- **Focus:** Elements should feel "lifted" or "active" through subtle background color shifts rather than large shadow increases.

## Shapes
The shape language is consistently **Rounded**. 
- **Standard components** (Inputs, Buttons, Cards) utilize a 8px (0.5rem) radius to feel modern and approachable.
- **Large containers** (Modals, Panels) transition to a 12px (0.75rem) radius.
- **Interactive States:** Avoid sharp corners in all instances, including tooltips and hover overlays, to maintain the soft aesthetic.

## Components
- **Buttons:** Primary buttons use a solid Indigo fill with white text. Secondary buttons use a White fill with a Gray-200 border. Both feature 8px rounded corners and a subtle 1px inner "glow" top border for a tactile feel.
- **Status Badges:** Pill-shaped (fully rounded).
    - *To Do:* Gray-100 background, Gray-600 text.
    - *In Progress:* Indigo-50 background, Indigo-600 text.
    - *Completed:* Green-50 background, Green-600 text.
- **Form Inputs:** White background with a 1px Gray-200 border. On focus, the border shifts to Indigo-600 with a 2px Indigo-100 outer ring (box-shadow).
- **Cards:** White surfaces with 8px radius, a Gray-200 border, and the "Level 1" soft shadow.
- **Lists:** Rows should have a subtle hover state using Gray-50, and use 12px of vertical padding for a spacious feel.
- **Sidebar:** A Gray-50 background with 13px "body-sm" typography for navigation items, ensuring a clear distinction from the main content area.