/**
 * animations.js
 * High-performance smooth loading sequence, staggered scroll reveals,
 * interactive card spotlight micro-physics, and animated counters.
 */

(function () {
  'use strict';

  /* ── 1. Snappy Preloader Coordinator ────────────────── */

  const preloader = document.getElementById('site-preloader');
  const progressFill = document.getElementById('preloader-progress-fill');
  const pctText = document.getElementById('preloader-pct');
  const statusText = document.getElementById('preloader-status-text');

  function initPreloader() {
    if (!preloader) return;

    // Check if user prefers reduced motion
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion) {
      preloader.classList.add('is-loaded');
      triggerEntranceAnimations();
      return;
    }

    let progress = 0;
    const startTime = performance.now();
    const duration = 620; // ms — fast and snappy

    function step(now) {
      const elapsed = now - startTime;
      progress = Math.min(100, Math.round((elapsed / duration) * 100));

      if (progressFill) progressFill.style.width = progress + '%';
      if (pctText) pctText.textContent = progress + '%';

      if (progress >= 70 && statusText) {
        statusText.textContent = 'READY';
        statusText.style.color = 'var(--green-light, #34d399)';
      }

      if (progress < 100) {
        requestAnimationFrame(step);
      } else {
        setTimeout(function () {
          preloader.classList.add('is-loaded');
          triggerEntranceAnimations();
        }, 80);
      }
    }

    requestAnimationFrame(step);
  }

  /* ── 2. Staggered Scroll Reveal System ──────────────── */

  function setupScrollReveals() {
    if (!('IntersectionObserver' in window)) {
      // Fallback: reveal everything immediately
      document.querySelectorAll('.reveal').forEach(function (el) {
        el.classList.add('is-revealed');
      });
      return;
    }

    const observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-revealed');

            // If entry has counter elements, trigger number animation
            const counters = entry.target.querySelectorAll('[data-counter]');
            counters.forEach(animateCounter);

            observer.unobserve(entry.target);
          }
        });
      },
      {
        threshold: 0.08,
        rootMargin: '0px 0px -30px 0px'
      }
    );

    // Single elements to reveal
    const singleSelectors = [
      '.section-header',
      '.terminal-frame',
      '.bio-card',
      '.specs-panel',
      '.contact-form-card',
      '.education-card',
      '.contact-coordinates',
      '.callout'
    ];

    singleSelectors.forEach(function (selector) {
      document.querySelectorAll(selector).forEach(function (el) {
        el.classList.add('reveal', 'reveal--fade-up');
        observer.observe(el);
      });
    });

    // Staggered grid groups
    const gridContainers = [
      { selector: '.projects-grid', children: '.project-card', step: 0.09 },
      { selector: '.services-grid', children: '.service-card', step: 0.08 },
      { selector: '.bio-socials-grid', children: '.social-card', step: 0.06 },
      { selector: '.specs-rows', children: '.spec-row', step: 0.04 }
    ];

    gridContainers.forEach(function (group) {
      document.querySelectorAll(group.selector).forEach(function (container) {
        const items = container.querySelectorAll(group.children);
        items.forEach(function (item, idx) {
          item.classList.add('reveal', 'reveal--fade-up');
          item.style.transitionDelay = (idx * group.step) + 's';
          observer.observe(item);
        });
      });
    });
  }

  function triggerEntranceAnimations() {
    // Immediately reveal anything already in the viewport
    const visibleReveals = document.querySelectorAll('.reveal');
    visibleReveals.forEach(function (el) {
      const rect = el.getBoundingClientRect();
      if (rect.top < window.innerHeight && rect.bottom > 0) {
        el.classList.add('is-revealed');
      }
    });
  }

  /* ── 3. Animated Number Counter ─────────────────────── */

  function animateCounter(el) {
    const target = parseInt(el.getAttribute('data-counter'), 10);
    if (isNaN(target)) return;

    const duration = 900; // ms
    const startTime = performance.now();

    function update(now) {
      const elapsed = now - startTime;
      const progress = Math.min(1, elapsed / duration);
      // Ease out cubic
      const ease = 1 - Math.pow(1 - progress, 3);
      const current = Math.round(target * ease);

      el.textContent = current;

      if (progress < 1) {
        requestAnimationFrame(update);
      } else {
        el.textContent = target;
      }
    }

    requestAnimationFrame(update);
  }

  /* ── 4. Interactive Card Spotlight Micro-Physics ────── */

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

  /* ── Initialize ─────────────────────────────────────── */

  // Setup DOM elements once parsed
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function () {
      setupScrollReveals();
      setupCardSpotlights();
      initPreloader();
    });
  } else {
    setupScrollReveals();
    setupCardSpotlights();
    initPreloader();
  }

})();
