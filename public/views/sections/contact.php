<?php
/**
 * public/views/sections/contact.php
 * [DISPATCH] Contact — dark background, two-column layout.
 * Variables expected: $profile (array)
 */
?>
<section class="section section--dark" id="section-contact" aria-labelledby="contact-heading">
  <div class="container">

    <div class="section-header">
      <div class="section-eyebrow">
        <span class="section-badge">[DISPATCH]</span>
        <span class="section-eyebrow-sep">&bull;</span>
        <span class="section-eyebrow-sub">GET IN TOUCH</span>
      </div>
      <div class="section-title-row">
        <div>
          <h2 class="section-title" id="contact-heading">Contact</h2>
          <p class="section-desc">Reach out for freelance projects, collaborations, or opportunities. Replies within 24 hours.</p>
        </div>
      </div>
    </div>

    <div class="contact-grid">

      <!-- Left: Intro + coordinates -->
      <div class="contact-intro-card">
        <p class="contact-intro-text">
          Looking to build a <strong>web application</strong>, redesign a <strong>SaaS system</strong>,
          or need a reliable software engineer for your team? I&rsquo;m available for freelance projects,
          long-term collaborations, and new opportunities.
        </p>
        <p class="contact-intro-text">
          Whether it&rsquo;s a small automation script or a full multi-panel SaaS platform &mdash; let&rsquo;s talk.
        </p>

        <div class="contact-coordinates">
          <div class="coordinates-header">Direct Coordinates</div>
          <div class="coordinates-list">
            <div class="coord-row">
              <span class="coord-key">EMAIL:</span>
              <a href="mailto:<?= htmlspecialchars($profile['email']) ?>" class="coord-value">
                <?= htmlspecialchars($profile['email']) ?>
              </a>
            </div>
            <div class="coord-row">
              <span class="coord-key">GITHUB:</span>
              <a href="<?= htmlspecialchars($profile['github']) ?>" target="_blank" rel="noopener noreferrer" class="coord-value">
                <?= htmlspecialchars($profile['github_username']) ?>
              </a>
            </div>
            <div class="coord-row">
              <span class="coord-key">LOCATION:</span>
              <span class="coord-value coord-value--plain"><?= htmlspecialchars($profile['location']) ?></span>
            </div>
            <div class="coord-row">
              <span class="coord-key">RESPONSE:</span>
              <span class="coord-value coord-value--plain">Within 24 hours</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Right: Contact form -->
      <div class="contact-form-card">
        <div class="form-card-header">
          <span class="form-card-title">
            <span class="material-symbols-outlined" aria-hidden="true" style="font-size:16px">send</span>
            Send a Message
          </span>
          <span class="form-card-note">No spam, ever.</span>
        </div>

        <form class="contact-form" id="contact-form" novalidate aria-label="Contact form">
          <div class="form-field">
            <label class="form-label" for="contact-email-input">Your Email</label>
            <input
              type="email"
              id="contact-email-input"
              class="form-input"
              placeholder="you@example.com"
              required
              autocomplete="email"
            />
          </div>
          <div class="form-field">
            <label class="form-label" for="contact-message-input">Message</label>
            <textarea
              id="contact-message-input"
              class="form-input form-textarea"
              placeholder="Hi Madhav, I'd like to discuss a project..."
              required
              rows="4"
            ></textarea>
          </div>
          <div class="form-actions">
            <button type="submit" id="form-submit-btn" class="btn btn--primary">
              <span class="material-symbols-outlined" aria-hidden="true" style="font-size:14px">send</span>
              Send Message
            </button>
            <span class="form-ack-note">ACK within 24h</span>
          </div>
          <div class="form-success" id="form-success" role="alert" aria-live="polite">
            &#10003; Message received &mdash; I&rsquo;ll get back to you within 24 hours!
          </div>
          <div class="form-error-msg" id="form-error-msg" role="alert" aria-live="polite"></div>
        </form>
      </div>

    </div>
  </div>
</section>
