/**
 * animations.js
 * Bulletproof bidirectional scroll reveals, synchronized preloader pacing,
 * landing entrance orchestration, and tactile micro-interactions.
 */

(function () {
  'use strict';

  /* ── 1. Scroll Velocity & Direction Tracker ──────────── */

  let lastScrollY = window.scrollY;
  // Default to 'up' since the site starts at the bottom and ascends towards projects
  let currentScrollDir = 'up';
  document.documentElement.setAttribute('data-scroll-dir', currentScrollDir);

  function updateScrollDirection() {
    const currentY = window.scrollY;
    const diff = currentY - lastScrollY;
    if (Math.abs(diff) > 4) {
      currentScrollDir = diff > 0 ? 'down' : 'up';
      document.documentElement.setAttribute('data-scroll-dir', currentScrollDir);
      lastScrollY = currentY;
    }
  }

  /* ── 2. Robust Bidirectional Reveal & Re-Animation System ─ */

  let revealElements = [];
  let isTicking = false;

  function evaluateReveals() {
    const vh = window.innerHeight || document.documentElement.clientHeight;
    const scrollY = window.scrollY;

    // Top threshold: 50px (just below fixed header)
    // Bottom threshold: vh - 30px
    const revealTopLimit = 50;
    const revealBottomLimit = vh - 30;

    // Generous hysteresis reset buffer:
    // Elements only reset when they are at least 80px COMPLETELY OUTSIDE the viewport window.
    // If you stop scrolling in the middle of a section, elements stay revealed with zero jumping!
    const resetTopLimit = -80;
    const resetBottomLimit = vh + 80;

    revealElements.forEach(function (el) {
      const rect = el.getBoundingClientRect();

      // Top of page guarantee: ensure apex projects section is always revealed
      if (scrollY <= 140 && el.closest('#section-projects')) {
        if (!el.classList.contains('is-revealed')) {
          el.classList.remove('reveal--from-bottom');
          el.classList.add('reveal--from-top', 'is-revealed');
        }
        return;
      }

      const isInRevealZone = (rect.top < revealBottomLimit && rect.bottom > revealTopLimit);

      if (isInRevealZone) {
        if (!el.classList.contains('is-revealed')) {
          // Lock in directional vector matching current scroll motion
          if (currentScrollDir === 'up') {
            el.classList.remove('reveal--from-bottom');
            el.classList.add('reveal--from-top');
          } else {
            el.classList.remove('reveal--from-top');
            el.classList.add('reveal--from-bottom');
          }

          el.classList.add('is-revealed');

          // Trigger counter roll
          const counters = el.querySelectorAll('[data-counter]');
          counters.forEach(animateCounter);
        }
      } else {
        // ONLY reset when the element is 100% completely outside the visible screen
        const isCompletelyOffscreen = (rect.bottom < resetTopLimit || rect.top > resetBottomLimit);

        if (isCompletelyOffscreen && el.classList.contains('is-revealed')) {
          // Do not reset top items if user is at apex
          if (scrollY <= 140 && el.closest('#section-projects')) return;

          el.classList.remove('is-revealed', 'reveal--from-top', 'reveal--from-bottom');

          const counters = el.querySelectorAll('[data-counter]');
          counters.forEach(function (c) {
            if (c._counterAnimId) {
              cancelAnimationFrame(c._counterAnimId);
              c._counterAnimId = null;
            }
            c.textContent = '0';
          });
        }
      }
    });

    isTicking = false;
  }

  function onScrollOrResize() {
    updateScrollDirection();
    if (!isTicking) {
      isTicking = true;
      requestAnimationFrame(evaluateReveals);
    }
  }

  window.addEventListener('scroll', onScrollOrResize, { passive: true });
  window.addEventListener('resize', onScrollOrResize, { passive: true });

  function setupScrollReveals() {
    // Single elements across sections
    const singleSelectors = [
      '.section-header',
      '.terminal-frame',
      '.bio-card',
      '.specs-panel',
      '.contact-form-card',
      '.education-card',
      '.contact-coordinates',
      '.callout',
      '.trajectory-card'
    ];

    singleSelectors.forEach(function (selector) {
      document.querySelectorAll(selector).forEach(function (el) {
        el.classList.add('reveal');
        revealElements.push(el);
      });
    });

    // Multi-item grid containers
    const gridContainers = [
      { selector: '.projects-grid', children: '.project-card' },
      { selector: '.services-grid', children: '.service-card' },
      { selector: '.bio-socials-grid', children: '.social-card' },
      { selector: '.specs-rows', children: '.spec-row' },
      { selector: '.timeline', children: '.timeline-entry, .timeline-bridge' }
    ];

    gridContainers.forEach(function (group) {
      document.querySelectorAll(group.selector).forEach(function (container) {
        const items = container.querySelectorAll(group.children);
        items.forEach(function (item, index) {
          item.classList.add('reveal');
          // Horizontal sibling cascade
          if (group.selector !== '.timeline') {
            item.style.transitionDelay = ((index % 4) * 0.08) + 's';
          }
          revealElements.push(item);
        });
      });
    });

    // Deduplicate elements
    revealElements = Array.from(new Set(revealElements));

    // Initial evaluation
    evaluateReveals();
  }

  /* ── 3. Landing Entrance Orchestration ───────────────── */

  function triggerEntranceAnimations() {
    // Stagger visible landing view elements in an upward-building sequence
    const vh = window.innerHeight || document.documentElement.clientHeight;
    const visibleReveals = revealElements.filter(function (el) {
      const rect = el.getBoundingClientRect();
      return rect.top < vh && rect.bottom > 0;
    });

    visibleReveals.forEach(function (el, i) {
      setTimeout(function () {
        el.classList.add('reveal--from-top', 'is-revealed');

        const counters = el.querySelectorAll('[data-counter]');
        counters.forEach(animateCounter);
      }, i * 90);
    });
  }

  // Expose globally for preloader hook
  window.triggerEntranceAnimations = triggerEntranceAnimations;

  // Listen for preloader completion event from loader.php
  window.addEventListener('preloader-cleared', function () {
    triggerEntranceAnimations();
  });

  /* ── 4. Animated Number Counter ─────────────────────── */

  function animateCounter(el) {
    const target = parseInt(el.getAttribute('data-counter'), 10);
    if (isNaN(target)) return;

    if (el._counterAnimId) {
      cancelAnimationFrame(el._counterAnimId);
    }

    const duration = 900; // ms — smooth counter roll
    const startTime = performance.now();

    function update(now) {
      const elapsed = now - startTime;
      const progress = Math.min(1, elapsed / duration);
      // Ease out cubic
      const ease = 1 - Math.pow(1 - progress, 3);
      const current = Math.round(target * ease);

      el.textContent = current;

      if (progress < 1) {
        el._counterAnimId = requestAnimationFrame(update);
      } else {
        el.textContent = target;
        el._counterAnimId = null;
      }
    }

    el._counterAnimId = requestAnimationFrame(update);
  }

  /* ── 5. Interactive Card Spotlight Micro-Physics ────── */

  function setupCardSpotlights() {
    const cards = document.querySelectorAll('.project-card, .service-card, .specs-panel');

    cards.forEach(function (card) {
      card.addEventListener('mousemove', function (e) {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        card.style.setProperty('--spotlight-x', x + 'px');
        card.style.setProperty('--spotlight-y', y + 'px');
      }, { passive: true });
    });
  }

  /* ── 6. Initialization ───────────────────────────────── */

  function init() {
    setupScrollReveals();
    setupCardSpotlights();

    // If preloader was already dismissed before animations.js parsed
    if (window.__preloaderDismissed || !document.getElementById('site-preloader')) {
      triggerEntranceAnimations();
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

})();
