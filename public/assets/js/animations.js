/**
 * animations.js
 * Comprehensive bidirectional scroll reveals, synchronized preloader pacing,
 * landing entrance orchestration, and tactile micro-interactions.
 */

(function () {
  'use strict';

  /* ── 1. Scroll Velocity & Direction Tracker ──────────── */

  let lastScrollY = window.scrollY;
  // Default to 'up' since the site starts at the bottom and ascends towards projects
  let currentScrollDir = 'up';
  document.documentElement.setAttribute('data-scroll-dir', currentScrollDir);

  function checkApexReveals() {
    // When near the top of the page (Apex: Projects section), ensure all elements are revealed
    if (window.scrollY <= 140) {
      document.querySelectorAll('#section-projects .reveal').forEach(function (el) {
        if (!el.classList.contains('is-revealed')) {
          el.setAttribute('data-reveal-dir', 'up');
          el.classList.add('is-revealed');
        }
      });
    }
  }

  function updateScrollDirection() {
    const currentY = window.scrollY;
    const diff = currentY - lastScrollY;
    // Hysteresis threshold to ignore minor micro-jitters
    if (Math.abs(diff) > 4) {
      const newDir = diff > 0 ? 'down' : 'up';
      if (newDir !== currentScrollDir) {
        currentScrollDir = newDir;
        document.documentElement.setAttribute('data-scroll-dir', newDir);
      }
      lastScrollY = currentY;
    }
    checkApexReveals();
  }

  window.addEventListener('scroll', updateScrollDirection, { passive: true });

  /* ── 2. Bidirectional Staggered Scroll Reveal System ─── */

  let scrollObserver = null;

  function setupScrollReveals() {
    if (!('IntersectionObserver' in window)) {
      // Fallback: reveal everything immediately
      document.querySelectorAll('.reveal').forEach(function (el) {
        el.classList.add('is-revealed');
      });
      return;
    }

    scrollObserver = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            // Horizontal grid column stagger
            const parent = entry.target.parentElement;
            if (parent && (parent.classList.contains('projects-grid') || parent.classList.contains('specs-rows') || parent.classList.contains('bio-socials-grid'))) {
              const siblings = Array.from(parent.children);
              const idx = siblings.indexOf(entry.target);
              const total = siblings.length;
              if (idx !== -1 && total > 1) {
                if (currentScrollDir === 'up') {
                  // Scrolling UP: bottom-most items enter first with 0s delay, higher items cascade after
                  const revIdx = (total - 1 - idx) % 4;
                  entry.target.style.transitionDelay = (revIdx * 0.07) + 's';
                } else {
                  // Scrolling DOWN: top-most items enter first
                  const normIdx = idx % 4;
                  entry.target.style.transitionDelay = (normIdx * 0.07) + 's';
                }
              }
            } else {
              // Vertical items and standalone cards trigger immediately without delay
              entry.target.style.transitionDelay = '0s';
            }

            // Lock in active direction at the exact moment of viewport entrance
            entry.target.setAttribute('data-reveal-dir', currentScrollDir);
            entry.target.classList.add('is-revealed');

            // Trigger animated number counters if present
            const counters = entry.target.querySelectorAll('[data-counter]');
            counters.forEach(animateCounter);
          } else {
            // Un-reveal off-screen so element re-triggers smoothly on reverse scroll
            // (Unless at the top of the page where apex items should remain visible)
            if (window.scrollY > 140 || !entry.target.closest('#section-projects')) {
              entry.target.classList.remove('is-revealed');
              entry.target.removeAttribute('data-reveal-dir');
            }

            const counters = entry.target.querySelectorAll('[data-counter]');
            counters.forEach(function (c) {
              if (c._counterAnimId) {
                cancelAnimationFrame(c._counterAnimId);
                c._counterAnimId = null;
              }
              c.textContent = '0';
            });
          }
        });
      },
      {
        threshold: 0.06,
        // -55px top margin clears the 56px fixed header without delaying reveals on mobile
        rootMargin: '-55px 0px -40px 0px'
      }
    );

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
        scrollObserver.observe(el);
      });
    });

    // Multi-item grid containers with staggered delays
    const gridContainers = [
      { selector: '.projects-grid', children: '.project-card', maxStagger: 6 },
      { selector: '.services-grid', children: '.service-card', maxStagger: 4 },
      { selector: '.bio-socials-grid', children: '.social-card', maxStagger: 4 },
      { selector: '.specs-rows', children: '.spec-row', maxStagger: 6 },
      { selector: '.timeline', children: '.timeline-entry, .timeline-bridge', maxStagger: 8 }
    ];

    gridContainers.forEach(function (group) {
      document.querySelectorAll(group.selector).forEach(function (container) {
        const items = container.querySelectorAll(group.children);
        items.forEach(function (item) {
          item.classList.add('reveal');
          scrollObserver.observe(item);
        });
      });
    });
  }

  /* ── 3. Landing Entrance Orchestration ───────────────── */

  function triggerEntranceAnimations() {
    // Only run when preloader is cleared or already dismissed
    const visibleReveals = Array.from(document.querySelectorAll('.reveal')).filter(function (el) {
      const rect = el.getBoundingClientRect();
      return rect.top < window.innerHeight && rect.bottom > 0;
    });

    // Stagger the initial landing view elements in an upward-building sequence
    visibleReveals.forEach(function (el, i) {
      setTimeout(function () {
        el.setAttribute('data-reveal-dir', 'up');
        el.classList.add('is-revealed');

        const counters = el.querySelectorAll('[data-counter]');
        counters.forEach(animateCounter);
      }, i * 95);
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

    const duration = 950; // ms — tuned to 0.95s reveal
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
