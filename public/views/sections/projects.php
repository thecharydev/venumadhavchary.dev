<?php
/**
 * public/views/sections/projects.php
 * [L4] Projects & Portfolio — apex section, dark background.
 * Variables expected: $projects, $services (arrays)
 */
?>
<section class="section section--dark" id="section-projects" aria-labelledby="projects-heading">
  <div class="container">

    <div class="section-header">
      <div class="section-eyebrow">
        <span class="section-badge">[L4: APEX]</span>
        <span class="section-eyebrow-sep">&bull;</span>
        <span class="section-eyebrow-sub">PRODUCTION DEPLOYMENTS</span>
      </div>
      <div class="section-title-row">
        <div>
          <h2 class="section-title" id="projects-heading">Projects &amp; Portfolio</h2>
          <p class="section-desc">Real-world systems built and shipped. No toy prototypes &mdash; these handle actual production workloads.</p>
        </div>
      </div>
    </div>

    <!-- Terminal decorative header -->
    <div class="terminal-frame" aria-hidden="true">
      <div class="terminal-bar">
        <div class="terminal-traffic">
          <span class="traffic-dot traffic-dot--red"></span>
          <span class="traffic-dot traffic-dot--yellow"></span>
          <span class="traffic-dot traffic-dot--green"></span>
          <span class="terminal-window-name">madhav@dev:~/projects</span>
        </div>
        <div class="terminal-meta">
          <span>Linux x86_64</span>
          <span>&bull;</span>
          <span class="terminal-status-text">LIVE</span>
        </div>
      </div>
      <div class="terminal-prompt" style="padding:0.875rem 1.25rem;font-family:var(--font-mono);font-size:0.72rem;">
        <span style="color:var(--crimson);font-weight:600;">madhav@dev:~$</span>
        <span>&nbsp;ls -la projects/</span>
        <span style="display:inline-block;width:7px;height:13px;background:var(--crimson);animation:blink 1s infinite;margin-left:4px;border-radius:1px;vertical-align:middle;"></span>
      </div>
    </div>

    <!-- Project cards -->
    <div class="projects-grid" aria-label="Portfolio projects">
      <?php foreach ($projects as $index => $project): ?>
      <?php
        $isFeatured = !empty($project['featured']);
        $typeColor = $project['type_color'] ?? $project['color'] ?? 'crimson';
        $statusColor = $project['status_color'] ?? $project['statusColor'] ?? 'green';
        $statusText = $project['status_text'] ?? $project['status'] ?? 'Active';
        $techTags = $project['technologies'] ?? $project['tags'] ?? [];
      ?>
      <article class="project-card <?= $isFeatured ? 'project-card--featured' : '' ?>">
        <div class="project-card-top">
          <span class="project-live">
            <span class="project-live-dot" aria-hidden="true"></span>
            <?= strtoupper(htmlspecialchars($project['status'] ?? 'ACTIVE')) ?>
          </span>
          <?php if (!empty($project['badge']) || $isFeatured): ?>
          <span class="project-badge"><?= htmlspecialchars($project['badge'] ?? 'FLAGSHIP') ?></span>
          <?php endif; ?>
        </div>
        <div class="project-index-row">
          <span class="project-index">[<?= htmlspecialchars($project['id'] ?? 'P-' . str_pad($index + 1, 2, '0', STR_PAD_LEFT)) ?>]</span>
          <h3 class="project-name"><?= htmlspecialchars($project['name'] ?? '') ?></h3>
        </div>
        <p class="project-desc"><?= htmlspecialchars($project['description'] ?? '') ?></p>
        <div class="project-details">
          <div class="project-detail">
            <span class="project-detail-key">TYPE:</span>
            <span class="project-detail-val project-detail-val--<?= htmlspecialchars($typeColor) ?>"><?= htmlspecialchars($project['type'] ?? '') ?></span>
          </div>
          <div class="project-detail">
            <span class="project-detail-key">STACK:</span>
            <span class="project-detail-val"><?= htmlspecialchars($project['stack'] ?? '') ?></span>
          </div>
          <div class="project-detail">
            <span class="project-detail-key">STATUS:</span>
            <span class="project-detail-val project-detail-val--<?= htmlspecialchars($statusColor) ?>"><?= htmlspecialchars($statusText) ?></span>
          </div>
        </div>
        <?php if (!empty($techTags)): ?>
        <div class="project-tags">
          <?php foreach ($techTags as $tag): ?>
          <span class="project-tag"><?= htmlspecialchars($tag) ?></span>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <?php if (!empty($project['is_wip'])): ?>
        <div class="project-links" style="margin-top:0.65rem;padding-top:0.55rem;border-top:1px solid var(--border-subtle, #1e293b);display:flex;flex-direction:column;gap:0.4rem;">
          <div style="display:flex;align-items:center;justify-content:space-between;font-family:var(--font-mono);font-size:0.72rem;color:var(--amber, #f59e0b);">
            <span style="display:inline-flex;align-items:center;gap:0.35rem;font-weight:600;">
              <span class="material-symbols-outlined" style="font-size:14px;animation:spin 3s linear infinite;" aria-hidden="true">sync</span>
              Cooking... Coffee &rarr; Code
            </span>
            <span style="font-size:0.68rem;opacity:0.85;">Brewing</span>
          </div>
          <div style="height:3px;background:rgba(255,255,255,0.08);border-radius:2px;overflow:hidden;" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" aria-label="Project in progress">
            <div class="shimmer-active" style="width:72%;height:100%;border-radius:2px;"></div>
          </div>
        </div>
        <?php elseif (!empty($project['repo'])): ?>
        <div class="project-links" style="margin-top:0.65rem;padding-top:0.5rem;border-top:1px solid var(--border-subtle, #1e293b);display:flex;align-items:center;">
          <a href="<?= htmlspecialchars($project['repo']) ?>" target="_blank" rel="noopener noreferrer" style="font-family:var(--font-mono);font-size:0.72rem;color:var(--crimson);display:inline-flex;align-items:center;gap:0.35rem;text-decoration:none;font-weight:600;">
            <svg style="width:13px;height:13px;fill:currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
            GitHub Repository &rarr;
          </a>
        </div>
        <?php endif; ?>
      </article>
      <?php endforeach; ?>
    </div>

    <!-- Services -->
    <?php if (!empty($services)): ?>
    <div class="services-section">
      <div class="services-row-header">
        <span class="section-badge">[SERVICES]</span>
        <h3 class="services-heading">What I Build</h3>
      </div>
      <div class="services-grid">
        <?php foreach ($services as $service): ?>
        <div class="service-card">
          <span class="service-num"><?= htmlspecialchars($service['number'] ?? '') ?></span>
          <h4 class="service-name"><?= htmlspecialchars($service['name'] ?? '') ?></h4>
          <p class="service-text"><?= htmlspecialchars($service['description'] ?? '') ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>

  </div>
</section>
