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
      show(errorEl, 'Transmission paused. Both fields are required before sending.');
      return;
    }

    if (!isValidEmail(emailVal.trim())) {
      show(errorEl, 'That address failed validation. Check the syntax and try again.');
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
      .catch(function (error) {
        show(errorEl, getErrorMessage(error));
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

  function getErrorMessage(error) {
    var message = error && error.message ? error.message : '';

    if (message === 'Message must be at least 10 characters') {
      return 'Signal too short. Add a little more detail so the message can get through.';
    }

    if (message === 'Message too long (max 5000 characters)') {
      return 'Payload rejected: that message is over 5,000 characters. Trim the signal and try again.';
    }

    if (message === 'Too many requests. Please try again in an hour.') {
      return 'Rate limit reached. The inbox needs a cooldown — try again in an hour.';
    }

    if (message === 'Invalid email address') {
      return 'That address failed validation. Check the syntax and try again.';
    }

    if (message === 'Invalid JSON input' || message === 'Method not allowed') {
      return 'Request rejected. Please refresh the page and try again.';
    }

    return 'Transmission failed. Please email me directly at thecharydev@gmail.com';
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
      return response.text().then(function(body) {
        var data;

        try {
          data = JSON.parse(body);
        } catch (parseError) {
          throw new Error('Unexpected server response');
        }

        if (!response.ok || !data.success) {
          throw new Error(data.message || 'Failed to send message');
        }

        return data;
      });
    });
  }

})();
