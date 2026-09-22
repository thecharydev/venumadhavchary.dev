<?php
/**
 * public/views/sections/experience.php
 * [L3] Experience & Growth Telemetry — light background.
 * Variables expected: $experienceIntro, $experienceCallout, $growthMilestones, $experienceTimeline
 */

$growthMilestones = $growthMilestones ?? [];
$experienceTimeline = $experienceTimeline ?? [];

// Default active milestone: 2024–2026 Inflection Spike or latest
$initialMilestone = null;
foreach ($growthMilestones as $m) {
    if (!empty($m['featured'])) {
        $initialMilestone = $m;
        break;
    }
}
if (!$initialMilestone && !empty($growthMilestones)) {
    $initialMilestone = end($growthMilestones);
}
?>
<section class="section section--light" id="section-experience" aria-labelledby="experience-heading">
  <div class="container">

    <!-- Section Header -->
    <div class="section-header">
      <div class="section-eyebrow">
        <span class="section-badge">[L3: EVOLUTION]</span>
        <span class="section-eyebrow-sep">&bull;</span>
        <span class="section-eyebrow-sub">CAREER TRAJECTORY</span>
      </div>
      <div class="section-title-row">
        <h2 class="section-title" id="experience-heading">Journey &amp; Growth</h2>
      </div>
    </div>

    <!-- Plain English Callout -->
    <div class="callout callout--light" role="note">
      <span class="material-symbols-outlined callout-icon" aria-hidden="true">insights</span>
      <p class="callout-body callout-body--light">
        <strong class="callout-strong--dark">In Plain English:</strong>
        <?= htmlspecialchars($experienceCallout ?: 'Started in 2020 without a laptop, coding directly from a mobile phone — building websites with PHP & MySQL and running a web hosting reselling venture. Later, discovering how a request actually travels from client to server blew my mind and led me to choose backend engineering. Diving deep into first principles — mastering HTTP internals, layered architecture, caching, and system scaling — directly powered production platforms like GarageMitra and Tasker. Today, I am a Software Engineer ready to build and scale high-impact systems.') ?>
      </p>
    </div>

    <!-- Trajectory Chart Card -->
    <div class="trajectory-card" role="region" aria-label="Career Growth Trajectory & Skills Evolution">
      <div class="trajectory-header">
        <span class="trajectory-title">Growth Trajectory</span>
        <span class="trajectory-badge">
          <span class="material-symbols-outlined" aria-hidden="true">trending_up</span>
          2020 &rarr; PRESENT
        </span>
      </div>

      <!-- Trajectory SVG Visual Curve -->
      <div class="trajectory-chart-wrap">
        <svg class="trajectory-svg" fill="none" viewBox="0 0 860 260" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Career growth trajectory curve">
          <defs>
            <linearGradient id="growthGradient" x1="0" y1="0" x2="0" y2="1">
              <stop offset="0%" stop-color="#f01747" stop-opacity="0.22" />
              <stop offset="60%" stop-color="#fee2e2" stop-opacity="0.08" />
              <stop offset="100%" stop-color="#fee2e2" stop-opacity="0.0" />
            </linearGradient>
          </defs>

          <!-- Grid Lines -->
          <line stroke="#f1f5f9" stroke-width="1" x1="50" x2="820" y1="35" y2="35"></line>
          <line stroke="#f1f5f9" stroke-width="1" x1="50" x2="820" y1="90" y2="90"></line>
          <line stroke="#f1f5f9" stroke-width="1" x1="50" x2="820" y1="145" y2="145"></line>
          <line stroke="#f1f5f9" stroke-width="1" x1="50" x2="820" y1="200" y2="200"></line>

          <!-- Year Indicators along the Base -->
          <text fill="#64748b" font-family="JetBrains Mono, Menlo, monospace" font-size="10" font-weight="600" text-anchor="middle" x="90" y="248">2020</text>
          <text fill="#64748b" font-family="JetBrains Mono, Menlo, monospace" font-size="10" font-weight="600" text-anchor="middle" x="310" y="248">2022</text>
          <text fill="#f01747" font-family="JetBrains Mono, Menlo, monospace" font-size="10.5" font-weight="700" text-anchor="middle" x="540" y="248">2024</text>
          <text fill="#059669" font-family="JetBrains Mono, Menlo, monospace" font-size="10.5" font-weight="700" text-anchor="middle" x="790" y="248">Present</text>

          <!-- Shaded Fill Under Curve -->
          <path class="trajectory-fill" d="M 90 220 C 180 214 250 196 310 184 C 390 166 480 116 540 70 C 620 34 700 22 790 18 L 790 230 L 90 230 Z" fill="#fee2e2" fill-opacity="0.3"></path>
          <path class="trajectory-fill" d="M 90 220 C 180 214 250 196 310 184 C 390 166 480 116 540 70 C 620 34 700 22 790 18 L 790 230 L 90 230 Z" fill="url(#growthGradient)"></path>

          <!-- Main Trajectory Line -->
          <path class="trajectory-curve-path" d="M 90 220 C 180 214 250 196 310 184 C 390 166 480 116 540 70 C 620 34 700 22 790 18" stroke="#f01747" stroke-linecap="round" stroke-width="2.5"></path>

          <!-- Vertical Guideline passing through active milestone -->
          <line id="svg-guideline" class="svg-guideline" stroke="#cbd5e1" stroke-dasharray="3 3" stroke-width="1.5" x1="790" x2="790" y1="18" y2="230" style="opacity: 0;"></line>

          <!-- Milestone Interactive Nodes -->
          <!-- 1. 2020-2022 -->
          <g class="trajectory-node <?= ($initialMilestone['id'] ?? '') === 'm-2020' ? 'is-active' : '' ?>"
             data-milestone-id="m-2020"
             transform="translate(90, 220)"
             role="button"
             tabindex="0"
             aria-label="2020 to 2022: Teenage Rookie">
            <circle class="node-halo" cx="0" cy="0" r="12" fill="#64748b"></circle>
            <circle class="node-core" cx="0" cy="0" r="5" fill="#64748b" stroke="#ffffff" stroke-width="2"></circle>
          </g>

          <!-- 2. 2022-2024 -->
          <g class="trajectory-node <?= ($initialMilestone['id'] ?? '') === 'm-2022' ? 'is-active' : '' ?>"
             data-milestone-id="m-2022"
             transform="translate(310, 184)"
             role="button"
             tabindex="0"
             aria-label="2022 to 2024: CS Fundamentals">
            <circle class="node-halo" cx="0" cy="0" r="12" fill="#0051d5"></circle>
            <circle class="node-core" cx="0" cy="0" r="5" fill="#0051d5" stroke="#ffffff" stroke-width="2"></circle>
          </g>

          <!-- 3. 2024-2026 -->
          <g class="trajectory-node <?= ($initialMilestone['id'] ?? '') === 'm-2024' ? 'is-active' : '' ?>"
             data-milestone-id="m-2024"
             transform="translate(540, 70)"
             role="button"
             tabindex="0"
             aria-label="2024 to 2026: The Backend Spike">
            <circle class="node-halo" cx="0" cy="0" r="14" fill="#f01747"></circle>
            <circle class="node-core" cx="0" cy="0" r="6" fill="#f01747" stroke="#ffffff" stroke-width="2"></circle>
          </g>

          <!-- 4. Present -->
          <g class="trajectory-node <?= ($initialMilestone['id'] ?? '') === 'm-present' ? 'is-active' : '' ?>"
             data-milestone-id="m-present"
             transform="translate(790, 18)"
             role="button"
             tabindex="0"
             aria-label="Present: Software Engineer">
            <circle class="node-halo" cx="0" cy="0" r="14" fill="#059669"></circle>
            <circle class="node-core" cx="0" cy="0" r="6" fill="#059669" stroke="#ffffff" stroke-width="2"></circle>
          </g>
        </svg>

        <!-- Floating Graph Tooltip (Reference Chart Style) -->
        <div class="trajectory-graph-tooltip" id="trajectory-graph-tooltip" role="tooltip" aria-hidden="true">
          <div class="graph-tooltip-header">
            <span class="graph-tooltip-year" id="tooltip-year"></span>
          </div>
          <div class="graph-tooltip-body">
            <span class="graph-tooltip-skills-label">TOPICS &amp; SKILLS:</span>
            <div class="graph-tooltip-skills-list" id="tooltip-skills-list"></div>
          </div>
        </div>

      </div>

    </div>

    <!-- Timeline Entries -->
    <div class="timeline" aria-label="Work experience timeline">
      <?php foreach ($experienceTimeline as $index => $exp): ?>
      <?php
        $expColor = $exp['color'] ?? 'crimson';
        $expTags = $exp['technologies'] ?? $exp['tags'] ?? [];
      ?>
      <div class="timeline-entry">
        <div class="timeline-marker" aria-hidden="true">
          <div class="timeline-dot timeline-dot--<?= htmlspecialchars($expColor) ?>"></div>
          <?php if ($index < count($experienceTimeline) - 1): ?>
          <div class="timeline-line"></div>
          <?php endif; ?>
        </div>
        <div class="timeline-body">
          <div class="timeline-head">
            <div>
              <h3 class="timeline-role"><?= htmlspecialchars($exp['role'] ?? '') ?></h3>
              <p class="timeline-org"><?= htmlspecialchars($exp['organization'] ?? '') ?></p>
            </div>
            <span class="timeline-date"><?= htmlspecialchars($exp['period'] ?? '') ?></span>
          </div>
          <p class="timeline-desc"><?= htmlspecialchars($exp['description'] ?? '') ?></p>
          <?php if (!empty($expTags)): ?>
          <div class="timeline-chips">
            <?php foreach ($expTags as $tag): ?>
            <span class="timeline-chip"><?= htmlspecialchars($tag) ?></span>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        </div>
      </div>

      <?php if (!empty($exp['transition_note'])): ?>
      <div class="timeline-bridge">
        <div class="timeline-bridge-marker" aria-hidden="true">
          <div class="timeline-bridge-line timeline-bridge-line--top"></div>
          <div class="timeline-bridge-dot"></div>
          <div class="timeline-bridge-line timeline-bridge-line--bottom"></div>
        </div>
        <div class="timeline-bridge-content">
          <span class="timeline-bridge-label">
            <span class="material-symbols-outlined" style="font-size:13px;line-height:1">school</span>
            The Turning Point &bull; 2022
          </span>
          <p class="timeline-bridge-text"><?= htmlspecialchars($exp['transition_note']) ?></p>
        </div>
      </div>
      <?php endif; ?>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- JSON Data & Interactive Handler for Year / Topics Inspector -->
<script type="application/json" id="trajectory-milestones-data">
<?= json_encode($growthMilestones, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>
</script>

<script>
(function() {
  const dataEl = document.getElementById('trajectory-milestones-data');
  if (!dataEl) return;
  let milestones = [];
  try {
    milestones = JSON.parse(dataEl.textContent);
  } catch (e) {
    return;
  }

  const milestonesMap = {};
  milestones.forEach(m => { milestonesMap[m.id] = m; });

  const chartWrap = document.querySelector('.trajectory-chart-wrap');
  const svg = document.querySelector('.trajectory-svg');
  const tooltip = document.getElementById('trajectory-graph-tooltip');
  const guideline = document.getElementById('svg-guideline');
  const yearEl = document.getElementById('tooltip-year');
  const skillsListEl = document.getElementById('tooltip-skills-list');

  const buttons = document.querySelectorAll('.trajectory-year-btn');
  const nodes = document.querySelectorAll('.trajectory-node');

  // Vibrant palette matching the reference graph card:
  const dotColors = [
    '#8b5cf6', // purple
    '#10b981', // green
    '#f59e0b', // amber
    '#f01747', // crimson
    '#0051d5', // blue
    '#06b6d4', // cyan
    '#64748b', // slate
    '#ec4899', // pink
    '#14b8a6'  // teal
  ];

  // Milestone X coordinates in SVG viewBox (0 to 860)
  const milestoneNodes = [
    { id: 'm-2020', x: 90 },
    { id: 'm-2022', x: 310 },
    { id: 'm-2024', x: 540 },
    { id: 'm-present', x: 790 }
  ];

  let hideTimeout = null;
  let currentActiveMilestone = null;

  // Determines the closest milestone based on SVG X position / percentage
  function getNearestMilestoneId(svgX) {
    let closest = milestoneNodes[0];
    let minDistance = Math.abs(svgX - closest.x);

    for (let i = 1; i < milestoneNodes.length; i++) {
      const dist = Math.abs(svgX - milestoneNodes[i].x);
      if (dist < minDistance) {
        minDistance = dist;
        closest = milestoneNodes[i];
      }
    }
    return closest.id;
  }

  function showMilestone(id) {
    if (hideTimeout) {
      clearTimeout(hideTimeout);
      hideTimeout = null;
    }

    const data = milestonesMap[id];
    if (!data) return;

    // Highlight active button & node
    buttons.forEach(btn => {
      const match = btn.getAttribute('data-milestone-id') === id;
      btn.classList.toggle('is-active', match);
    });

    nodes.forEach(node => {
      const match = node.getAttribute('data-milestone-id') === id;
      node.classList.toggle('is-active', match);
    });

    const nodeItem = milestoneNodes.find(m => m.id === id) || milestoneNodes[3];

    // Move SVG guideline
    if (guideline) {
      guideline.setAttribute('x1', nodeItem.x);
      guideline.setAttribute('x2', nodeItem.x);
      guideline.style.opacity = '0.85';
    }

    // Populate and show floating graph tooltip
    if (tooltip && chartWrap && svg) {
      if (yearEl) yearEl.textContent = data.year || '';

      if (skillsListEl) {
        skillsListEl.innerHTML = '';
        (data.skills || []).forEach((skill, idx) => {
          const color = dotColors[idx % dotColors.length];
          const item = document.createElement('div');
          item.className = 'tooltip-skill-item';
          item.innerHTML = `
            <span class="tooltip-skill-dot" style="background: ${color};"></span>
            <span class="tooltip-skill-text">${skill}</span>
          `;
          skillsListEl.appendChild(item);
        });
      }

      // Calculate pixel position of the active node inside chartWrap
      const svgRect = svg.getBoundingClientRect();
      const wrapRect = chartWrap.getBoundingClientRect();
      const nodePixelX = (svgRect.left - wrapRect.left) + (nodeItem.x / 860) * svgRect.width + chartWrap.scrollLeft;

      const tooltipWidth = 250;
      const maxLeft = (chartWrap.scrollWidth || wrapRect.width) - tooltipWidth - 16;
      let targetLeft = nodePixelX - (tooltipWidth / 2);
      targetLeft = Math.max(16, Math.min(targetLeft, maxLeft));

      tooltip.style.left = targetLeft + 'px';
      tooltip.classList.add('is-visible');
      tooltip.setAttribute('aria-hidden', 'false');
    }
  }

  function hideMilestone() {
    currentActiveMilestone = null;
    buttons.forEach(btn => btn.classList.remove('is-active'));
    nodes.forEach(node => node.classList.remove('is-active'));
    if (guideline) {
      guideline.style.opacity = '0';
    }
    if (tooltip) {
      tooltip.classList.remove('is-visible');
      tooltip.setAttribute('aria-hidden', 'true');
    }
  }

  function scheduleHide() {
    hideTimeout = setTimeout(hideMilestone, 180);
  }

  // Handle continuous cursor / touch movement across the graph
  function handleChartMove(clientX) {
    if (hideTimeout) {
      clearTimeout(hideTimeout);
      hideTimeout = null;
    }

    if (!svg) return;
    const svgRect = svg.getBoundingClientRect();
    if (svgRect.width === 0) return;

    // Convert mouse clientX to SVG coordinate space (viewBox 0 to 860)
    const relativeX = (clientX - svgRect.left) / svgRect.width;
    const svgX = relativeX * 860;
    const clampedSvgX = Math.max(0, Math.min(860, svgX));

    const nearestId = getNearestMilestoneId(clampedSvgX);
    if (nearestId !== currentActiveMilestone || (tooltip && !tooltip.classList.contains('is-visible'))) {
      currentActiveMilestone = nearestId;
      showMilestone(nearestId);
    }
  }

  if (chartWrap) {
    chartWrap.addEventListener('mousemove', (e) => {
      handleChartMove(e.clientX);
    });

    chartWrap.addEventListener('mouseenter', (e) => {
      handleChartMove(e.clientX);
    });

    chartWrap.addEventListener('mouseleave', () => {
      currentActiveMilestone = null;
      scheduleHide();
    });

    // Touch support for mobile scrubbing:
    chartWrap.addEventListener('touchstart', (e) => {
      if (e.touches && e.touches.length > 0) {
        handleChartMove(e.touches[0].clientX);
      }
    }, { passive: true });

    chartWrap.addEventListener('touchmove', (e) => {
      if (e.touches && e.touches.length > 0) {
        handleChartMove(e.touches[0].clientX);
      }
    }, { passive: true });
  }

  // Button hover & focus
  buttons.forEach(btn => {
    const id = btn.getAttribute('data-milestone-id');
    btn.addEventListener('mouseenter', () => {
      currentActiveMilestone = id;
      showMilestone(id);
    });
    btn.addEventListener('mouseleave', () => {
      currentActiveMilestone = null;
      scheduleHide();
    });
    btn.addEventListener('focus', () => {
      currentActiveMilestone = id;
      showMilestone(id);
    });
    btn.addEventListener('blur', () => {
      currentActiveMilestone = null;
      scheduleHide();
    });
    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      if (tooltip && tooltip.classList.contains('is-visible') && btn.classList.contains('is-active')) {
        hideMilestone();
      } else {
        currentActiveMilestone = id;
        showMilestone(id);
      }
    });
  });

  // Node hover & click
  nodes.forEach(node => {
    const id = node.getAttribute('data-milestone-id');
    node.addEventListener('mouseenter', () => {
      currentActiveMilestone = id;
      showMilestone(id);
    });
    node.addEventListener('mouseleave', () => {
      currentActiveMilestone = null;
      scheduleHide();
    });
    node.addEventListener('focus', () => {
      currentActiveMilestone = id;
      showMilestone(id);
    });
    node.addEventListener('blur', () => {
      currentActiveMilestone = null;
      scheduleHide();
    });
    node.addEventListener('click', (e) => {
      e.stopPropagation();
      if (tooltip && tooltip.classList.contains('is-visible') && node.classList.contains('is-active')) {
        hideMilestone();
      } else {
        currentActiveMilestone = id;
        showMilestone(id);
      }
    });
    node.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        currentActiveMilestone = id;
        showMilestone(id);
      }
    });
  });

  // Dismiss on click outside
  document.addEventListener('click', (e) => {
    if (!e.target.closest('.trajectory-card')) {
      hideMilestone();
    }
  });
})();
</script>
