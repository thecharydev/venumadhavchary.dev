/**
 * scroll.js
 * Handles:
 *  - Header scroll-progress bar
 *  - Sticky side-nav scroll-thumb position
 *  - scrollToSection() utility
 *
 * Exports: scrollToSection (attached to window for inline HTML use)
 */

(function () {
  'use strict';

  const progressFill = document.getElementById('progress-fill');
  const scrollThumb  = document.getElementById('scroll-thumb');
  const TRACK_H      = 44; // px — matches .scroll-track height in header.css

  function updateScroll() {
    const scrollTop  = window.scrollY;
    const docHeight  = document.documentElement.scrollHeight - window.innerHeight;
    const pct        = docHeight > 0 ? Math.min(100, scrollTop / docHeight * 100) : 0;

    // Progress bar
    if (progressFill) progressFill.style.width = pct + '%';

    // Scroll thumb on side nav
    if (scrollThumb) {
      const pos = Math.max(0, Math.min(TRACK_H - 10, pct / 100 * TRACK_H));
      scrollThumb.style.top = pos + 'px';
    }
  }

  window.addEventListener('scroll', updateScroll, { passive: true });
  updateScroll(); // initial paint

  /**
   * Smoothly scroll to a section by its id.
   * Accounts for the fixed header height.
   */
  function scrollToSection(id, behavior = 'smooth') {
    const el = document.getElementById(id);
    if (!el) return;
    const HEADER = parseInt(
      getComputedStyle(document.documentElement).getPropertyValue('--header-height') || '56',
      10
    );
    const top = el.getBoundingClientRect().top + window.scrollY - HEADER - 4;
    window.scrollTo({ top, behavior });
  }

  // Expose globally for onclick="" usage in HTML
  window.scrollToSection = scrollToSection;

  // On initial site load, land on About Me section
  function landOnAboutSection(behavior) {
    if (!window.location.hash || window.location.hash === '#section-about') {
      scrollToSection('section-about', behavior || 'instant');
      updateScroll();
    }
  }

  // Position immediately
  landOnAboutSection('instant');

  // Track if user manually scrolled so subsequent checks don't interfere
  let userInteracted = false;
  ['wheel', 'touchstart', 'touchmove', 'keydown', 'mousedown'].forEach(function (evt) {
    window.addEventListener(evt, function () { userInteracted = true; }, { passive: true, once: true });
  });

  // Re-check on load in case deferred font loading caused slight reflow
  window.addEventListener('load', function () {
    if (!userInteracted && (!window.location.hash || window.location.hash === '#section-about')) {
      landOnAboutSection('instant');
    }
  });

})();
