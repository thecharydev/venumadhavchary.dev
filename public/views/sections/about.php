<?php
/**
 * public/views/sections/about.php
 * [L1] About Me — foundation section, light background.
 * Also contains the Skills subsection.
 * Variables expected: $profile, $skillsData / $primarySkills, $skillMetrics, $technologies
 */
$primarySkillsList = $primarySkills ?? $skills['primary_skills'] ?? $skills['primary'] ?? [];
$metricsList       = $skillMetrics ?? $skills['metrics'] ?? [];
$techList          = $technologies ?? $skills['technologies'] ?? $skills['secondary'] ?? [];
$skillsCalloutText = $skills['callout'] ?? 'I build robust web backends, automate complex processes, and design SaaS platforms that scale — from database schema to admin dashboards to billing logic.';
?>
<section class="section section--light" id="section-about" aria-labelledby="about-heading">
  <div class="container">

    <!-- ── About header ──────────────────────────────── -->
    <div class="section-header">
      <div class="section-eyebrow">
        <span class="section-badge">[L1: FOUNDATION]</span>
        <span class="section-eyebrow-sep">&bull;</span>
        <span class="section-eyebrow-sub">IDENTITY</span>
      </div>
      <div class="section-title-row">
        <div>
          <h2 class="section-title" id="about-heading">About Me</h2>
          <p class="section-desc">Full-Stack Web Developer from India. Backend-first, freelance, always building something real.</p>
        </div>
        <div class="section-tags">
          <a href="/api/download-resume.php" target="_blank" rel="noopener noreferrer" class="btn btn--primary" title="Download Resume PDF">
            <span class="material-symbols-outlined" aria-hidden="true" style="font-size:14px">download</span>
            Download Resume
          </a>
          <span class="tag tag--crimson">Open to Freelance</span>
        </div>
      </div>
    </div>

    <!-- ── Two-column bio grid ────────────────────────── -->
    <div class="hero-grid">

      <!-- Left: Bio card -->
      <div class="bio-card">

        <!-- Identity row -->
        <div class="bio-identity">
          <div class="bio-avatar-row">
            <div class="bio-avatar">
              <?php
                $avatarRaw = $profile['avatar'] ?? 'assets/images/thecharydev.png';
                $avatarUrl = ltrim(preg_replace('#^/?public/#', '', $avatarRaw), '/');
              ?>
              <img src="<?= htmlspecialchars($avatarUrl) ?>"
                   alt="<?= htmlspecialchars($profile['name'] ?? 'Madhav') ?> &mdash; <?= htmlspecialchars($profile['title'] ?? '') ?>"
                   width="58" height="58" />
            </div>
            <div>
              <h1 class="bio-name"><?= htmlspecialchars($profile['name'] ?? 'Madhav') ?></h1>
              <p class="bio-role"><?= htmlspecialchars($profile['title'] ?? '') ?></p>
            </div>
          </div>
          <div class="bio-status">
            <span class="status-indicator">
              <span class="status-pulse" aria-hidden="true"></span>
              <?= htmlspecialchars($profile['location'] ?? 'India [IST]') ?>
            </span>
            <span class="bio-availability"><?= htmlspecialchars($profile['availability'] ?? 'Open to Freelance') ?></span>
          </div>
        </div>

        <!-- Bio text + stats -->
        <div class="bio-body">
          <?php if (!empty($profile['bio'])): ?>
          <p class="bio-text">
            <?= nl2br(htmlspecialchars($profile['bio'])) ?>
          </p>
          <?php endif; ?>
          <!-- <div class="bio-stats" aria-label="Key statistics">
            <div class="bio-stat">
              <span class="bio-stat-code">[L2]</span>
              <span class="bio-stat-value"><?= htmlspecialchars($profile['projects_shipped'] ?? '0') ?></span>
              <span class="bio-stat-label">Projects Shipped</span>
            </div>
            <div class="bio-stat">
              <span class="bio-stat-code">[L3]</span>
              <span class="bio-stat-value"><?= htmlspecialchars($profile['github_contributions'] ?? '0') ?></span>
              <span class="bio-stat-label">GitHub Contributions (<?= date('Y') ?>)</span>
            </div>
            <div class="bio-stat">
              <span class="bio-stat-code">[L4]</span>
              <span class="bio-stat-value"><?= htmlspecialchars($profile['coding_years'] ?? '0') ?></span>
              <span class="bio-stat-label">Years Coding</span>
            </div>
          </div> -->
        </div>

        
        <!-- Social links & Resume -->
        <div class="bio-socials">
          <span class="bio-socials-label">Profiles &amp; Coordinates</span>
          <div class="bio-socials-grid">
            <a href="mailto:<?= htmlspecialchars($profile['email'] ?? '') ?>" class="social-card">
              <span class="material-symbols-outlined social-card-icon" aria-hidden="true">mail</span>
              <div>
                <div class="social-card-label">Email</div>
                <div class="social-card-handle"><?= htmlspecialchars($profile['email'] ?? '') ?></div>
              </div>
            </a>
            <a href="<?= htmlspecialchars($profile['github'] ?? '') ?>" target="_blank" rel="noopener noreferrer" class="social-card">
              <svg class="social-card-icon-svg" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
              </svg>
              <div>
                <div class="social-card-label">GitHub</div>
                <div class="social-card-handle"><?= htmlspecialchars($profile['github_username'] ?? '@thecharydev') ?></div>
              </div>
            </a>
            <?php if (!empty($profile['linkedin'])): ?>
            <a href="<?= htmlspecialchars($profile['linkedin']) ?>" target="_blank" rel="noopener noreferrer" class="social-card">
              <svg class="social-card-icon-svg" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
              </svg>
              <div>
                <div class="social-card-label">LinkedIn</div>
                <div class="social-card-handle"><?= htmlspecialchars($profile['linkedin_username'] ?? 'in/venumadhavchary') ?></div>
              </div>
            </a>
            <?php endif; ?>
            <a href="/api/download-resume.php" target="_blank" rel="noopener noreferrer" class="social-card" title="Download Resume PDF">
              <span class="material-symbols-outlined social-card-icon" aria-hidden="true">description</span>
              <div>
                <div class="social-card-label">Resume</div>
                <div class="social-card-handle">Download PDF</div>
              </div>
            </a>
          </div>
        </div>

        <div class="education-card">
          <div class="education-card-header">
            <span class="education-card-title">Education</span>
          </div>
          <div class="education-card-body">
            <strong><?= htmlspecialchars($profile['education'][0]['degree'] ?? 'B.Tech in Computer Science and Engineering') ?></strong>
            <span><?= htmlspecialchars($profile['education'][0]['institution'] ?? 'Lovely Professional University') ?></span>
            <span><?= htmlspecialchars($profile['education'][0]['period'] ?? '2022 — 2026') ?></span>
          </div>
        </div>
      </div>
      <!-- Right: Specs panel + CTA -->
      <div class="hero-sidebar">
        <?php if (!empty($profile['specs'])): ?>
        <div class="specs-panel">
          <div class="specs-header">
            <span class="specs-title">Technical Specs</span>
            <span class="specs-status">&#9679; ACTIVE</span>
          </div>
          <div class="specs-rows">
            <?php foreach ($profile['specs'] as $spec): ?>
            <div class="spec-row">
              <span class="spec-key"><?= htmlspecialchars($spec['key'] ?? '') ?></span>
              <span class="spec-value <?= !empty($spec['color']) ? 'spec-value--' . htmlspecialchars($spec['color']) : '' ?>">
                <?= htmlspecialchars($spec['value'] ?? '') ?>
              </span>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>

        <!-- Contact card (in place of CTA) -->
        <div class="contact-form-card" id="section-contact">
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

    <?php if (false): /* Skills & Technologies hidden for now per user request */ ?>
    <!-- ── Skills subsection ──────────────────────────── -->
    <div style="margin-top:4rem;" id="section-skills">
      <div class="section-header">
        <div class="section-eyebrow">
          <span class="section-badge">[TECH STACK]</span>
          <span class="section-eyebrow-sep">&bull;</span>
          <span class="section-eyebrow-sub">CORE COMPETENCIES</span>
        </div>
        <div class="section-title-row">
          <h3 class="section-title">Skills &amp; Technologies</h3>
        </div>
      </div>

      <div class="callout callout--light" role="note">
        <span class="material-symbols-outlined callout-icon" aria-hidden="true">lightbulb</span>
        <div class="callout-body callout-body--light">
          <strong class="callout-strong--dark">In Plain English:</strong>
          <span style="color:var(--slate-700);margin-left:0.25rem;"><?= htmlspecialchars($skillsCalloutText) ?></span>
        </div>
        <span class="callout-pill" style="background:var(--slate-200);color:var(--slate-800);">Full-Stack Capable</span>
      </div>

      <!-- Skills canvas -->
      <div class="skills-canvas">

        <?php if (!empty($primarySkillsList)): ?>
        <div class="skills-grid">
          <?php foreach ($primarySkillsList as $skill): ?>
          <?php
            $isPrimary = !empty($skill['primary']) || !empty($skill['featured']);
            $pct = (int)($skill['percentage'] ?? $skill['level'] ?? 0);
            $color = $skill['color'] ?? 'crimson';
          ?>
          <div class="skill-card <?= $isPrimary ? 'skill-card--primary' : '' ?>">
            <div class="skill-card-top">
              <span class="skill-name"><?= htmlspecialchars($skill['name'] ?? '') ?></span>
              <span class="skill-pct skill-pct--<?= htmlspecialchars($color) ?>"><?= $pct ?>%</span>
            </div>
            <div class="skill-bar">
              <div class="skill-bar-fill <?= $color ? 'skill-bar-fill--' . htmlspecialchars($color) : '' ?>"
                   style="width:<?= $pct ?>%"
                   role="progressbar"
                   aria-valuenow="<?= $pct ?>"
                   aria-valuemin="0"
                   aria-valuemax="100"
                   aria-label="<?= htmlspecialchars($skill['name'] ?? '') ?> proficiency <?= $pct ?>%"></div>
            </div>
            <p class="skill-desc"><?= htmlspecialchars($skill['description'] ?? '') ?></p>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Metrics strip -->
        <?php if (!empty($metricsList)): ?>
        <div class="metrics-strip" aria-label="Key metrics">
          <?php foreach ($metricsList as $metric): ?>
          <div class="metric-card">
            <div class="metric-label"><?= htmlspecialchars($metric['label'] ?? '') ?></div>
            <div class="metric-value <?= !empty($metric['color']) ? 'metric-value--' . htmlspecialchars($metric['color']) : '' ?>">
              <?= htmlspecialchars($metric['value'] ?? '') ?>
            </div>
            <div class="metric-sub <?= !empty($metric['subColor']) ? 'metric-sub--' . htmlspecialchars($metric['subColor']) : '' ?>">
              <?= htmlspecialchars($metric['sub'] ?? '') ?>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Extra tech chips -->
        <?php if (!empty($techList)): ?>
        <div class="tech-strip">
          <span class="tech-strip-label">Also working with:</span>
          <?php foreach ($techList as $tech): ?>
          <span class="tech-chip"><?= htmlspecialchars($tech) ?></span>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

      </div>
    </div>
    <?php endif; ?>

  </div>
</section>
