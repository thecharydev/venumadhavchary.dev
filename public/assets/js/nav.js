/**
 * nav.js
 * Handles:
 *  - Mobile drawer open / close
 *  - Active nav-link highlight based on scroll position
 *  - Keyboard (Escape) closes drawer
 *
 * Exports: closeMobileDrawer (attached to window for inline HTML use)
 */

(function () {
  'use strict';

  /* ── Mobile drawer ────────────────────────────────── */

  const menuBtn    = document.getElementById('mobile-menu-btn');
  const menuIcon   = document.getElementById('mobile-menu-icon');
  const drawer     = document.getElementById('mobile-drawer');

  function openDrawer() {
    if (!drawer) return;
    drawer.classList.add('is-open');
    if (menuBtn)  menuBtn.setAttribute('aria-expanded', 'true');
    if (drawer)   drawer.setAttribute('aria-hidden', 'false');
    if (menuIcon) menuIcon.textContent = 'close';
  }

  function closeDrawer() {
    if (!drawer) return;
    drawer.classList.remove('is-open');
    if (menuBtn)  menuBtn.setAttribute('aria-expanded', 'false');
    if (drawer)   drawer.setAttribute('aria-hidden', 'true');
    if (menuIcon) menuIcon.textContent = 'menu';
  }

  if (menuBtn) {
    menuBtn.addEventListener('click', function () {
      drawer && drawer.classList.contains('is-open')
        ? closeDrawer()
        : openDrawer();
    });
  }

  // Close on outside click
  document.addEventListener('click', function (e) {
    if (!drawer || !menuBtn) return;
    if (!drawer.contains(e.target) && !menuBtn.contains(e.target)) {
      closeDrawer();
    }
  });

  // Close on Escape
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') closeDrawer();
  });

  // Expose for inline onclick="" on drawer links
  window.closeMobileDrawer = closeDrawer;

  /* ── Active nav highlight ─────────────────────────── */

  const sections  = Array.from(document.querySelectorAll('section[id], [id="section-contact"]'));
  const navLinks  = document.querySelectorAll('.nav-link, .mobile-drawer-link');

  function updateActiveLink() {
    const scrollY  = window.scrollY;
    const OFFSET   = 80; // px above section top to trigger activation
    let   activeId = '';

    // Walk sections bottom-up so the lowest visible section wins
    for (let i = sections.length - 1; i >= 0; i--) {
      const s = sections[i];
      if (scrollY >= s.offsetTop - OFFSET) {
        activeId = s.id;
        break;
      }
    }

    navLinks.forEach(function (link) {
      const href = link.getAttribute('href') || '';
      if (href === '#' + activeId) {
        link.classList.add('is-active');
      } else {
        link.classList.remove('is-active');
      }
    });
  }

  window.addEventListener('scroll', updateActiveLink, { passive: true });
  // Also run after a short delay on load to account for any reflows
  setTimeout(updateActiveLink, 120);

})();
