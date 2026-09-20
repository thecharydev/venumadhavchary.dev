/**
 * contact.js
 * Handles the contact form submit, validation feedback,
 * and success / error state display.
 *
 * In production: swap the simulateSubmit() body for a real
 * fetch() POST to your backend or a form service (Formspree, etc.).
 */

(function () {
  'use strict';

  var form       = document.getElementById('contact-form');
  var successEl  = document.getElementById('form-success');
  var errorEl    = document.getElementById('form-error-msg');
  var submitBtn  = document.getElementById('form-submit-btn');

  if (!form) return;

  form.addEventListener('submit', function (e) {
    e.preventDefault();

    var emailVal   = (document.getElementById('contact-email-input')   || {}).value || '';
    var messageVal = (document.getElementById('contact-message-input') || {}).value || '';

    // Clear previous states
    hide(successEl);
    hide(errorEl);

    // Basic validation
    if (!emailVal.trim() || !messageVal.trim()) {
      show(errorEl, 'Please fill in both fields before sending.');
      return;
    }

    if (!isValidEmail(emailVal.trim())) {
      show(errorEl, 'Please enter a valid email address.');
      return;
    }

    // Disable button while "sending"
    setLoading(true);

    simulateSubmit(emailVal.trim(), messageVal.trim())
      .then(function () {
        show(successEl, null); // use default text
        form.reset();
        setTimeout(function () { hide(successEl); }, 6000);
      })
      .catch(function () {
        show(errorEl, 'Something went wrong. Please email me directly at thecharydev@gmail.com');
      })
      .finally(function () {
        setLoading(false);
      });
  });

  /* ── Helpers ────────────────────────────────────────── */

  function show(el, text) {
    if (!el) return;
    if (text) el.textContent = text;
    el.classList.add('is-visible');
  }

  function hide(el) {
    if (!el) return;
    el.classList.remove('is-visible');
  }

  function setLoading(isLoading) {
    if (!submitBtn) return;
    submitBtn.disabled = isLoading;
    submitBtn.textContent = isLoading ? 'Sending…' : 'Send Message';
  }

  function isValidEmail(val) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val);
  }

  /**
   * Submits contact form to the PHP backend API
   */
  function simulateSubmit(email, message) {
    var endpoint = window.location.pathname.startsWith('/public/') ? '/public/api/contact.php' : '/api/contact.php';
    return fetch(endpoint, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ email: email, message: message })
    }).then(function(response) {
      if (!response.ok) {
        return response.json().then(function(data) {
          throw new Error(data.message || 'Failed to send message');
        });
      }
      return response.json();
    });
  }

})();
