# Clean Light Theme Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Redesign the Klinik Yakusa dashboard theme to a professional Clean Light Theme (Teal-Slate).

**Architecture:** Update variables and style rules in core CSS files (`style.css`, `sidebar.css`, `navbar.css`, `dashboard.css`, `form.css`, `table.css`) and Tailwind config, then compile the final Tailwind bundle.

**Tech Stack:** PHP, Bootstrap 5, Tailwind CSS v3.4.1, Node.js/npm.

## Global Constraints

- Preserve all PHP tags, database queries, and route paths.
- Keep changes aligned with existing PHP/Bootstrap/Tailwind conventions.
- Do not break existing `/klinik/...` navigation links.
- Compile Tailwind CSS using `npm run build` after each file modification to verify that the stylesheet compiles cleanly.
- Keep changes clean, minimalist, high contrast, and highly legible.

---

### Task 1: Update Design Tokens & Tailwind Configuration

**Files:**
- Modify: `assets/css/style.css:9-84`
- Modify: `assets/css/style.css:353-367`
- Modify: `tailwind.config.js:15-38`

**Interfaces:**
- Consumes: None
- Produces: CSS color variables and Tailwind config properties for Teal-Slate theme

- [ ] **Step 1: Modify root style variables in `assets/css/style.css`**
  Modify lines 9-84 to replace dark theme slate colors, green primary accents, and glass variables with clean light mode variables:
  ```css
  :root {
      --primary: #0d9488;
      --primary-hover: #0f766e;
      --secondary: #0ea5e9;
      --secondary-hover: #0284c7;

      --slate-50: #f8fafc;
      --slate-100: #f1f5f9;
      --slate-200: #e2e8f0;
      --slate-300: #cbd5e1;
      --slate-400: #94a3b8;
      --slate-500: #64748b;
      --slate-600: #475569;
      --slate-700: #334155;
      --slate-800: #1e293b;
      --slate-900: #0f172a;
      --slate-950: #020617;

      --text-strong: var(--slate-900);
      --text-default: var(--slate-700);
      --text-muted: var(--slate-500);
      --surface: #ffffff;
      --surface-soft: var(--slate-50);
      --surface-alt: #f8fafc;
      --border-subtle: var(--slate-100);
      --border-strong: var(--slate-200);

      --radius-sm: 10px;
      --radius-md: 12px;
      --radius-lg: 16px;
      --radius-xl: 20px;
      --radius-2xl: 24px;

      --shadow-soft: 0 2px 12px rgba(15, 23, 42, 0.04);
      --shadow-hover: 0 8px 24px rgba(15, 23, 42, 0.08);
      --shadow-card: 0 4px 20px rgba(15, 23, 42, 0.05);
      --shadow-ring: 0 0 0 4px rgba(13, 148, 136, 0.15);

      --transition-fast: 0.2s ease-in-out;
      --transition-normal: 0.3s ease;
      --transition-slow: 0.45s ease;

      --surface-glass: #ffffff;
      --border-glass: var(--border-strong);
      --border-glass-hover: var(--primary);
      --shadow-glass: var(--shadow-soft);
      --shadow-glow: 0 0 15px rgba(13, 148, 136, 0.08);
  }

  body {
      background: #f8fafc;
      color: #334155;
      overflow-x: hidden;
      min-height: 100vh;
  }
  ```

- [ ] **Step 2: Modify `.card-glass` definitions in `assets/css/style.css`**
  Modify lines 353-367 to make `.card-glass` look like a modern light card:
  ```css
  .card-glass {
      background: var(--surface) !important;
      backdrop-filter: none !important;
      -webkit-backdrop-filter: none !important;
      border: 1px solid var(--border-strong) !important;
      border-radius: var(--radius-xl) !important;
      box-shadow: var(--shadow-soft) !important;
      transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease !important;
  }
  .card-glass:hover {
      transform: translateY(-5px);
      border-color: var(--primary) !important;
      box-shadow: var(--shadow-hover) !important;
  }
  ```

- [ ] **Step 3: Update `tailwind.config.js` colors**
  Modify theme values inside `tailwind.config.js` to match style variables:
  ```javascript
      extend: {
        colors: {
          primary: '#0d9488',
          primaryHover: '#0f766e',
          secondary: '#0ea5e9',
          slate: {
            50: '#f8fafc',
            100: '#f1f5f9',
            200: '#e2e8f0',
            300: '#cbd5e1',
            400: '#94a3b8',
            500: '#64748b',
            600: '#475569',
            700: '#334155',
            800: '#1e293b',
            900: '#0f172a',
          }
        },
  ```

- [ ] **Step 4: Compile Tailwind CSS**
  Run: `npm run build`
  Expected: Successful Tailwind compilation with zero warnings/errors.

- [ ] **Step 5: Commit changes**
  Run: `git add assets/css/style.css tailwind.config.js; git commit -m "style: update style variables and tailwind config for light mode"`

---

### Task 2: Redesign Sidebar Navigation

**Files:**
- Modify: `assets/css/sidebar.css:6-16`
- Modify: `assets/css/sidebar.css:22-44`
- Modify: `assets/css/sidebar.css:60-74`
- Modify: `assets/css/sidebar.css:109-127`
- Modify: `assets/css/sidebar.css:131-157`
- Modify: `assets/css/sidebar.css:184-216`
- Modify: `assets/css/sidebar.css:255-302`
- Modify: `assets/css/sidebar.css:329-339`
- Modify: `assets/css/sidebar.css:353-415`
- Modify: `assets/css/sidebar.css:682-720`

**Interfaces:**
- Consumes: Theme variables from `assets/css/style.css`
- Produces: Professional light sidebar theme

- [ ] **Step 1: Modify local sidebar variables and main class in `assets/css/sidebar.css`**
  Modify lines 6-16 and 22-44:
  ```css
  :root{
      --sidebar-bg: var(--surface);
      --sidebar-bg2: var(--surface-soft);
      --primary: #0d9488;          /* Teal 600 */
      --primary-hover: #0f766e;    /* Teal 700 */
      --text: var(--slate-800);
      --muted: var(--slate-500);
      --border: var(--border-strong);
      --hover: rgba(13, 148, 136, 0.04);
      --active: rgba(13, 148, 136, 0.08);
  }

  /* ==========================================
                  SIDEBAR
  ========================================== */

  .sidebar{
      position:fixed;
      left:0;
      top:0;
      width:280px;
      height:calc(100vh - 40px);
      margin:20px;
      background:var(--surface) !important;
      backdrop-filter:none !important;
      -webkit-backdrop-filter:none !important;
      border:1px solid var(--border-strong) !important;
      border-radius:var(--radius-2xl) !important;
      box-shadow:var(--shadow-soft) !important;
      color:var(--text);
      display:flex;
      flex-direction:column;
      justify-content:space-between;
      z-index:999;
      transition:all 0.35s ease;
      overflow-y:auto;
      scrollbar-width:thin;
      scrollbar-color:var(--slate-300) transparent;
  }
  ```

- [ ] **Step 2: Update brand elements**
  Modify lines 60-74 and brand-text elements:
  ```css
  .brand{
      display:flex;
      align-items:center;
      gap:15px;
      color:var(--slate-900);
      text-decoration:none;
      margin-bottom:30px;
  }

  .brand:hover{
      color:var(--primary);
  }
  ```

- [ ] **Step 3: Redesign profile card and items**
  Modify lines 131-157 and avatar:
  ```css
  .profile-card{
      background:var(--slate-50);
      border:1px solid var(--border-strong);
      border-radius:22px;
      padding:18px;
      display:flex;
      align-items:center;
      gap:15px;
      margin-bottom:28px;
      transition:.35s;
  }

  .profile-card:hover{
      background:rgba(13,148,136,.04);
      border-color:rgba(13,148,136,.2);
  }

  .profile-avatar{
      width:60px;
      height:60px;
      min-width:60px;
      border-radius:18px;
      background:linear-gradient(
          135deg,
          var(--primary),
          var(--secondary)
      );
      display:flex;
      justify-content:center;
      align-items:center;
      font-size:26px;
      color:#fff;
      box-shadow: 0 6px 15px rgba(13, 148, 136, 0.15);
  }

  .profile-info h5{
      margin:0;
      font-size:17px;
      font-weight:700;
      color:var(--slate-800);
  }

  .profile-info span{
      display:flex;
      align-items:center;
      gap:8px;
      margin-top:6px;
      color:var(--slate-600);
      font-size:13px;
  }

  .profile-info span i{
      color: var(--primary);
      font-size:10px;
  }
  ```

- [ ] **Step 4: Update menu navigation links**
  Modify lines 255-302 to handle hover and active text colors nicely:
  ```css
  .sidebar-menu li a{
      display:flex;
      align-items:center;
      gap:14px;
      padding:14px 16px;
      border-radius:16px;
      color:var(--slate-600);
      text-decoration:none;
      transition:all 0.3s ease;
      position:relative;
      overflow:hidden;
      font-weight:500;
      border:1px solid transparent;
  }

  .sidebar-menu li a i{
      width:20px;
      text-align:center;
      font-size:16px;
      transition:all 0.3s ease;
      color:var(--slate-500);
  }

  .sidebar-menu li a:hover{
      background: var(--hover);
      border-color: rgba(13, 148, 136, 0.1);
      color: var(--primary);
      transform: translateX(4px);
  }

  .sidebar-menu li a:hover i{
      color: var(--primary);
  }

  .sidebar-menu li a.active{
      background: var(--active) !important;
      border: 1px solid rgba(13, 148, 136, 0.2) !important;
      color: var(--primary) !important;
      font-weight: 600;
      box-shadow: 0 4px 12px rgba(13, 148, 136, 0.05) !important;
  }

  .sidebar-menu li a.active i{
      color: var(--primary);
  }
  ```

- [ ] **Step 5: Redesign sidebar footer and logout links**
  Modify lines 329-339 and footer link hover styling:
  ```css
  .sidebar-footer{
      padding:20px;
      border-top:1px solid var(--border-strong);
      background:var(--slate-50);
      border-bottom-left-radius:var(--radius-2xl);
      border-bottom-right-radius:var(--radius-2xl);
  }

  .footer-link{
      display:flex;
      align-items:center;
      gap:15px;
      color:var(--slate-600);
      text-decoration:none;
      padding:14px 18px;
      border-radius:16px;
      transition:.35s;
      font-weight:500;
      margin-bottom:8px;
  }

  .footer-link:hover{
      background:var(--hover);
      color:var(--primary);
      transform:translateX(6px);
  }

  .footer-link:hover i{
      color: var(--primary);
  }

  .logout{
      color:#ef4444;
  }

  .logout:hover{
      background:rgba(239,68,68,.08);
      color:#dc2626;
  }

  .logout:hover i{
      color:#dc2626;
  }

  .sidebar-version {
      border-top: 1px solid var(--border-strong);
  }
  ```

- [ ] **Step 6: Update expanded/collapsed styling variables**
  Modify properties of `.profile-card` in collapse states (lines 682-720):
  ```css
  .profile-card {
      border-radius: 20px;
      background: var(--slate-50);
      border: 1px solid var(--border-strong);
      box-shadow: none;
  }
  .sidebar-divider {
      background: var(--border-strong);
  }
  ```

- [ ] **Step 7: Compile Tailwind CSS**
  Run: `npm run build`
  Expected: Successful compilation.

- [ ] **Step 8: Commit changes**
  Run: `git add assets/css/sidebar.css; git commit -m "style: redesign sidebar navigation for clean light mode"`

---

### Task 3: Redesign Topbar / Navbar

**Files:**
- Modify: `assets/css/navbar.css:10-25`
- Modify: `assets/css/navbar.css:115-137`
- Modify: `assets/css/navbar.css:199-227`
- Modify: `assets/css/navbar.css:238-256`
- Modify: `assets/css/navbar.css:305-322`
- Modify: `assets/css/navbar.css:378-395`
- Modify: `assets/css/navbar.css:407-428`

**Interfaces:**
- Consumes: Theme variables from `assets/css/style.css`
- Produces: Professional light navbar theme

- [ ] **Step 1: Modify `.topbar` container background and border**
  Modify lines 10-25:
  ```css
  .topbar{
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: var(--surface) !important;
      backdrop-filter: none !important;
      -webkit-backdrop-filter: none !important;
      border: 1px solid var(--border-strong) !important;
      border-radius: var(--radius-xl) !important;
      padding: 18px 24px;
      margin-bottom: 24px;
      box-shadow: var(--shadow-soft) !important;
      position: sticky;
      top: 20px;
      z-index: 100;
  }
  ```

- [ ] **Step 2: Update search wrapper**
  Modify lines 115-137:
  ```css
  .search-wrapper{
      display:flex;
      align-items:center;
      gap:12px;
      width:340px;
      height:52px;
      padding:0 18px;
      background: var(--slate-50) !important;
      border:1px solid var(--border-strong) !important;
      border-radius:16px;
      transition: var(--transition-fast);
  }

  .search-wrapper:hover{
      border-color: var(--primary);
      box-shadow: 0 4px 12px rgba(13, 148, 136, 0.08);
  }

  .search-wrapper:focus-within{
      border-color: var(--primary) !important;
      background: var(--surface) !important;
      box-shadow: var(--shadow-ring) !important;
  }
  ```

- [ ] **Step 3: Redesign date/time box**
  Modify lines 199-227:
  ```css
  .date-info,
  .time-info{
      display:flex;
      align-items:center;
      gap:8px;
      background: var(--slate-50) !important;
      padding:10px 14px;
      border-radius:14px;
      border:1px solid var(--border-strong) !important;
      color: var(--slate-700) !important;
      font-size:14px;
      transition: var(--transition-fast);
  }

  .date-info:hover,
  .time-info:hover{
      border-color: var(--primary) !important;
      color: var(--primary) !important;
      box-shadow: 0 4px 12px rgba(13, 148, 136, 0.08) !important;
  }
  ```

- [ ] **Step 4: Update notification button and count**
  Modify lines 238-256:
  ```css
  .notification-btn{
      width:50px;
      height:50px;
      border:none;
      border-radius:16px;
      background: var(--slate-50) !important;
      border:1px solid var(--border-strong) !important;
      color: var(--slate-600) !important;
      cursor:pointer;
      transition:.3s;
      position:relative;
  }

  .notification-btn:hover{
      border-color: var(--primary) !important;
      color: var(--primary) !important;
      box-shadow: 0 4px 12px rgba(13, 148, 136, 0.08) !important;
      transform:translateY(-2px);
  }
  ```

- [ ] **Step 5: Redesign profile dropdown button and drop menu**
  Modify lines 305-322 and 378-428:
  ```css
  .profile-button{
      display:flex;
      align-items:center;
      gap:15px;
      padding:8px 12px;
      background: var(--slate-50) !important;
      border:1px solid var(--border-strong) !important;
      color: var(--slate-800) !important;
      border-radius:18px;
      cursor:pointer;
      transition:.3s;
  }

  .profile-button:hover{
      border-color: var(--primary) !important;
      box-shadow: 0 4px 12px rgba(13, 148, 136, 0.08) !important;
  }

  .profile-menu{
      position:absolute;
      top:70px;
      right:0;
      width:240px;
      background: var(--surface) !important;
      border-radius:18px;
      border:1px solid var(--border-strong) !important;
      box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08) !important;
      overflow:hidden;
      opacity:0;
      visibility:hidden;
      transform:translateY(15px);
      transition:.3s;
      z-index:9999;
  }

  .profile-menu a{
      display:flex;
      align-items:center;
      gap:14px;
      padding:15px 20px;
      color: var(--slate-600) !important;
      text-decoration:none;
      transition:.25s;
  }

  .profile-menu a:hover{
      background: var(--hover) !important;
      color: var(--primary) !important;
  }
  ```

- [ ] **Step 6: Compile Tailwind CSS**
  Run: `npm run build`
  Expected: Successful compilation.

- [ ] **Step 7: Commit changes**
  Run: `git add assets/css/navbar.css; git commit -m "style: redesign topbar and navbar dropdowns for light mode"`

---

### Task 4: Redesign Dashboard Content (Hero, Stats, Finance Cards)

**Files:**
- Modify: `assets/css/dashboard.css:60-69`
- Modify: `assets/css/dashboard.css:322-337`
- Modify: `assets/css/dashboard.css:542-558`
- Modify: `assets/css/dashboard.css:712-725`

**Interfaces:**
- Consumes: Color variables
- Produces: Professional light theme elements for Dashboard page

- [ ] **Step 1: Modify Hero banner background**
  Modify lines 60-69 of `assets/css/dashboard.css` to use Teal gradient:
  ```css
  .hero-dashboard{
      background: linear-gradient(135deg, #0d9488 0%, #0f766e 100%) !important;
      border: none !important;
      border-radius: var(--radius-2xl);
      padding:45px;
      color:#fff;
      overflow:hidden;
      position:relative;
      box-shadow: 0 10px 25px rgba(13, 148, 136, 0.15) !important;
  }
  ```

- [ ] **Step 2: Update stats-card styles**
  Modify lines 322-337:
  ```css
  .stats-card{
      position:relative;
      overflow:hidden;
      border-radius: var(--radius-xl);
      padding:28px;
      min-height:185px;
      color:#fff;
      transition: var(--transition-normal);
      box-shadow: var(--shadow-soft);
      cursor:pointer;
  }

  .stats-card:hover{
      transform:translateY(-4px);
      box-shadow: var(--shadow-hover);
  }
  ```

- [ ] **Step 3: Update finance-card and chart-card styles**
  Modify lines 542-558 and 712-725:
  ```css
  .finance-card{
      position:relative;
      overflow:hidden;
      border-radius: var(--radius-xl);
      padding:28px;
      color:#fff;
      min-height:155px;
      display:flex;
      align-items:center;
      transition: var(--transition-normal);
      box-shadow: var(--shadow-soft);
  }

  .finance-card:hover{
      transform:translateY(-4px);
      box-shadow: var(--shadow-hover);
  }

  .chart-card{
      background:#fff;
      border-radius: var(--radius-xl);
      overflow:hidden;
      box-shadow: var(--shadow-soft);
      transition: var(--transition-normal);
      border: 1px solid var(--border-strong);
      height:100%;
  }

  .chart-card:hover{
      transform:translateY(-4px);
      box-shadow: var(--shadow-hover);
  }
  ```

- [ ] **Step 4: Compile Tailwind CSS**
  Run: `npm run build`
  Expected: Successful compilation.

- [ ] **Step 5: Commit changes**
  Run: `git add assets/css/dashboard.css; git commit -m "style: update dashboard hero, stats and chart card styles"`

---

### Task 5: Redesign Forms, Tables, and DataTables Components

**Files:**
- Modify: `assets/css/form.css:6-22`
- Modify: `assets/css/form.css:30-49`
- Modify: `assets/css/table.css:6-11`

**Interfaces:**
- Consumes: Core variables
- Produces: Professional light forms and clean table states

- [ ] **Step 1: Redesign card container styles in `assets/css/form.css`**
  Modify lines 6-22 to use solid light cards:
  ```css
  .card.card-glass{
      border-radius:var(--radius-2xl) !important;
      overflow:hidden;
      border: 1px solid var(--border-strong) !important;
      background: var(--surface) !important;
      box-shadow: var(--shadow-soft) !important;
  }

  .card.card-glass .card-header{
      padding:1.15rem 1.25rem;
      border-bottom:1px solid var(--border-strong);
      background: var(--slate-50);
  }

  .card-header.bg-success{
      background: linear-gradient(135deg, var(--primary), var(--primary-hover)) !important;
  }

  .card.card-glass .card-body{
      background: var(--surface);
  }
  ```

- [ ] **Step 2: Redesign form inputs and focus states in `assets/css/form.css`**
  Modify lines 30-49:
  ```css
  .form-control,
  .form-select {
      color: var(--slate-800);
      border: 1px solid var(--border-strong);
      border-radius: var(--radius-md);
      min-height: 48px;
      padding: .75rem .95rem;
      background-color: var(--surface);
      transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
  }

  .form-control::placeholder {
      color: var(--slate-400);
  }

  .form-control:focus,
  .form-select:focus{
      border-color: var(--primary);
      box-shadow: var(--shadow-ring);
      outline: 0;
  }
  ```

- [ ] **Step 3: Redesign tables and DataTables wrappers in `assets/css/table.css`**
  Modify lines 6-11 of `assets/css/table.css`:
  ```css
  .card .table-responsive{
      border-radius:var(--radius-xl);
      overflow:hidden;
      border:1px solid var(--border-strong);
      background:var(--surface);
  }
  ```

- [ ] **Step 4: Compile Tailwind CSS**
  Run: `npm run build`
  Expected: Successful compilation.

- [ ] **Step 5: Commit changes**
  Run: `git add assets/css/form.css assets/css/table.css; git commit -m "style: update form inputs and table containers for light theme"`

---

## Verification Plan

### Automated Tests
- Compiling Tailwind CSS using the Node script to confirm it compiles with no errors:
  `npm run build`

### Manual Verification
- Deploying changes locally to Apache (XAMPP).
- Visiting `http://localhost/klinik/` to verify:
  1. Main Dashboard background is light-grey `#f8fafc`.
  2. Sidebar background is solid white `#ffffff` with a clean right border.
  3. Active item in sidebar is light-teal background with teal text.
  4. Topbar search box, datetime, and notifications are light-themed with soft borders.
  5. Hero Dashboard uses a professional dark teal gradient.
  6. Statistics cards and finance cards look modern with clean shadows.
  7. Form inputs have white backgrounds, clear borders, and teal focus highlights.
  8. Table rows hover with a very light teal tint, pagination uses teal active states.
