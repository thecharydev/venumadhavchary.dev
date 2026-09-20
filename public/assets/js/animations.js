/**
 * animations.js
 * Subtle entrance animations using IntersectionObserver.
 * Elements fade up once when they scroll into view.
 *
 * Add the CSS class  `js-reveal`  to any element you want animated.
 * The class is added automatically to the elements listed in SELECTORS.
 */

(function () {
  'use strict';

  // Cards and items that should animate in
  var SELECTORS = [
    '.skill-card',
    '.metric-card',
    '.project-card',
    '.service-card',
    '.phase-card',
    '.timeline-entry',
    '.social-card',
    '.philosophy-item',
    '.bio-card',
    '.specs-panel',
    '.contact-form-card',
    '.contact-coordinates',
  ].join(', ');

  // Guard — IntersectionObserver not available (very old browser)
  if (!('IntersectionObserver' in window)) return;

  var observer = new IntersectionObserver(
    function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-revealed');
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.07, rootMargin: '0px 0px -32px 0px' }
  );

  // Inject base styles once, rather than relying on a CSS file
  var style = document.createElement('style');
  style.textContent = [
    '.js-reveal {',
    '  opacity: 0;',
    '  transform: translateY(12px);',
    '  transition: opacity 0.38s ease, transform 0.38s ease;',
    '}',
    '.js-reveal.is-revealed {',
    '  opacity: 1;',
    '  transform: translateY(0);',
    '}',
  ].join('\n');
  document.head.appendChild(style);

  document.querySelectorAll(SELECTORS).forEach(function (el) {
    el.classList.add('js-reveal');
    observer.observe(el);
  });

})();
