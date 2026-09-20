<?php
/**
 * public/views/layout/header.php
 * Fixed top navigation bar + mobile drawer + side scroll nav.
 * Variables expected: $profile (array)
 */
$siteName = $profile['site_name'] ?? (defined('SITE_NAME') ? SITE_NAME : 'venumadhavchary.dev');
$siteIcon = $profile['site_icon'] ?? (defined('SITE_ICON') ? SITE_ICON : 'V');
?>
<header class="site-header" role="banner">
  <div class="header-inner">

    <!-- Brand -->
    <div class="brand">
      <a href="#section-projects" class="brand-link" aria-label="<?= htmlspecialchars($profile['name']) ?> — home">
        <span class="brand-icon" aria-hidden="true"><?= htmlspecialchars($siteIcon) ?></span>
        <span class="brand-name"><?= htmlspecialchars($siteName) ?></span>
        <span class="brand-sep" aria-hidden="true">//</span>
        <span class="brand-tagline"><?= htmlspecialchars($profile['title']) ?></span>
      </a>
    </div>

    <!-- Desktop nav — inverted order matches page layout -->
    <nav class="main-nav" aria-label="Main navigation">
      <a href="#section-projects"   class="nav-link"><span class="nav-tag" aria-hidden="true">[L4]</span> Projects</a>
      <span class="nav-divider" aria-hidden="true">+</span>
      <!-- <a href="#section-experience" class="nav-link"><span class="nav-tag" aria-hidden="true">[L3]</span> Experience</a>
      <span class="nav-divider" aria-hidden="true">+</span> -->
      <a href="#section-terminal"   class="nav-link"><span class="nav-tag" aria-hidden="true">[L2]</span> Terminal</a>
      <span class="nav-divider" aria-hidden="true">+</span>
      <a href="#section-about"      class="nav-link"><span class="nav-tag" aria-hidden="true">[L1]</span> About</a>
      <span class="nav-divider" aria-hidden="true">+</span>
      <a href="#section-contact"    class="nav-link">
        <span class="nav-live-dot" aria-hidden="true"></span>
        Contact
      </a>
    </nav>

    <!-- Header actions -->
    <div class="header-actions">
      <div class="header-socials">
        <a href="<?= htmlspecialchars($profile['github']) ?>" target="_blank" rel="noopener noreferrer"
           class="icon-btn" aria-label="GitHub profile">
          <svg class="icon-svg" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
          </svg>
        </a>
        <?php if (!empty($profile['linkedin'])): ?>
        <a href="<?= htmlspecialchars($profile['linkedin']) ?>" target="_blank" rel="noopener noreferrer"
           class="icon-btn" aria-label="LinkedIn profile">
          <svg class="icon-svg" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
          </svg>
        </a>
        <?php endif; ?>
        <a href="mailto:<?= htmlspecialchars($profile['email']) ?>" class="icon-btn" aria-label="Send email">
          <span class="material-symbols-outlined" aria-hidden="true" style="font-size:17px;line-height:1">mail</span>
        </a>
      </div>
      <a href="#section-contact" class="btn btn--primary">
        <span class="material-symbols-outlined" aria-hidden="true" style="font-size:14px">send</span>
        Contact
      </a>
    </div>

    <!-- Mobile hamburger -->
    <button class="mobile-menu-btn" id="mobile-menu-btn"
            aria-label="Toggle navigation menu" aria-expanded="false"
            aria-controls="mobile-drawer">
      <span class="material-symbols-outlined" id="mobile-menu-icon" aria-hidden="true">menu</span>
    </button>

  </div>

  <!-- Scroll progress bar -->
  <div class="header-progress" role="progressbar" aria-hidden="true">
    <div class="header-progress-fill" id="progress-fill"></div>
  </div>
</header>

<!-- Mobile navigation drawer -->
<nav class="mobile-drawer" id="mobile-drawer" aria-label="Mobile navigation" aria-hidden="true">
  <!-- <a href="#section-projects"   class="mobile-drawer-link" onclick="closeMobileDrawer()"><span class="mobile-drawer-tag">[L4]</span> Projects</a>
  <a href="#section-experience" class="mobile-drawer-link" onclick="closeMobileDrawer()"><span class="mobile-drawer-tag">[L3]</span> Experience</a> -->
  <a href="#section-terminal"   class="mobile-drawer-link" onclick="closeMobileDrawer()"><span class="mobile-drawer-tag">[L2]</span> Terminal</a>
  <a href="#section-about"      class="mobile-drawer-link" onclick="closeMobileDrawer()"><span class="mobile-drawer-tag">[L1]</span> About Me</a>
  <a href="#section-contact"    class="mobile-drawer-link" onclick="closeMobileDrawer()"><span class="mobile-drawer-tag">[+]</span> Contact</a>
  <a href="/api/download-resume.php" target="_blank" rel="noopener noreferrer" class="mobile-drawer-link" onclick="closeMobileDrawer()"><span class="mobile-drawer-tag">[PDF]</span> Resume</a>
</nav>

<!-- Sticky side scroll navigator (desktop only) -->
<aside class="scroll-nav" aria-label="Page position navigator">
  <div class="scroll-nav-inner">
    <button class="scroll-nav-btn" onclick="scrollToSection('section-projects')"
            title="Scroll to top" aria-label="Scroll to top">
      <span class="material-symbols-outlined" aria-hidden="true">vertical_align_top</span>
    </button>
    <div class="scroll-track" aria-hidden="true">
      <div class="scroll-thumb" id="scroll-thumb"></div>
    </div>
    <button class="scroll-nav-btn" onclick="scrollToSection('section-contact')"
            title="Scroll to contact" aria-label="Scroll to contact">
      <span class="material-symbols-outlined" aria-hidden="true">vertical_align_bottom</span>
    </button>
  </div>
</aside>
