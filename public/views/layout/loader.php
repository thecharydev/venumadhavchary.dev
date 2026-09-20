<?php
/**
 * public/views/layout/loader.php
 * Minimalist terminal bootloader / preloader screen.
 * Automatically dismissed when assets are loaded or after a snappy timer.
 */
$siteName = $profile['site_name'] ?? (defined('SITE_NAME') ? SITE_NAME : 'venumadhavchary.dev');
?>
<div id="site-preloader" class="site-preloader" aria-hidden="true">
  <div class="preloader-terminal">
    <div class="preloader-bar">
      <div class="preloader-dots">
        <span class="p-dot p-dot--red"></span>
        <span class="p-dot p-dot--yellow"></span>
        <span class="p-dot p-dot--green"></span>
      </div>
      <span class="preloader-title">sys://boot &bull; <?= htmlspecialchars($siteName) ?></span>
      <span class="preloader-status" id="preloader-status-text">INITIALIZING</span>
    </div>
    <div class="preloader-body">
      <div class="preloader-log" id="preloader-log">
        <div class="log-line"><span class="log-cmd">> sys.verify_environment()</span> <span class="log-ok">[OK]</span></div>
        <div class="log-line"><span class="log-cmd">> kernel.mount(portfolio, user)</span> <span class="log-ok">[OK]</span></div>
        <div class="log-line log-line--active"><span class="log-cmd">> session.start()</span> <span class="log-pulse">&bull;&bull;&bull;</span></div>
      </div>
      <div class="preloader-progress-wrap">
        <div class="preloader-progress-bar">
          <div class="preloader-progress-fill" id="preloader-progress-fill"></div>
        </div>
        <div class="preloader-progress-meta">
          <span class="preloader-hint">SYS_READY</span>
          <span class="preloader-pct" id="preloader-pct">0%</span>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Inline Preloader Controller & Bulletproof Failsafe -->
<script>
(function() {
  var preloader = document.getElementById('site-preloader');
  if (!preloader) return;

  var progressFill = document.getElementById('preloader-progress-fill');
  var pctText = document.getElementById('preloader-pct');
  var statusText = document.getElementById('preloader-status-text');

  var dismissed = false;
  function dismiss() {
    if (dismissed) return;
    dismissed = true;
    if (preloader) {
      preloader.classList.add('is-loaded');
      setTimeout(function() {
        if (preloader && preloader.parentNode) {
          preloader.parentNode.removeChild(preloader);
        }
      }, 550);
    }
    // Trigger any entrance animations
    document.querySelectorAll('.reveal').forEach(function(el) {
      var rect = el.getBoundingClientRect();
      if (rect.top < window.innerHeight && rect.bottom > 0) {
        el.classList.add('is-revealed');
      }
    });
  }

  // Animate progress smoothly in 550ms
  var startTime = Date.now();
  var duration = 520;

  function tick() {
    if (dismissed) return;
    var elapsed = Date.now() - startTime;
    var progress = Math.min(100, Math.round((elapsed / duration) * 100));

    if (progressFill) progressFill.style.width = progress + '%';
    if (pctText) pctText.textContent = progress + '%';

    if (progress >= 70 && statusText) {
      statusText.textContent = 'READY';
      statusText.style.color = '#34d399';
    }

    if (progress < 100) {
      requestAnimationFrame(tick);
    } else {
      setTimeout(dismiss, 50);
    }
  }

  requestAnimationFrame(tick);

  // Hard failsafe: guaranteed dismiss within 800ms
  setTimeout(dismiss, 800);
  window.addEventListener('load', function() {
    setTimeout(dismiss, 100);
  });
})();
</script>
