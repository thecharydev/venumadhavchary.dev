<?php
/**
 * public/views/sections/terminal.php
 * [L2] Interactive Terminal — dark background.
 * No data variables required; terminal.js handles all commands.
 */
?>
<section class="section section--dark terminal-section" id="section-terminal" aria-labelledby="terminal-heading">
  <div class="container">

    <div class="section-header">
      <div class="section-eyebrow">
        <span class="section-badge">[L2: INTERFACE]</span>
        <span class="section-eyebrow-sep">&bull;</span>
        <span class="section-eyebrow-sub">COMMAND LINE</span>
      </div>
      <div class="section-title-row">
        <div>
          <h2 class="section-title" id="terminal-heading">Interactive Terminal</h2>
          <p class="section-desc">
            Navigate my portfolio via CLI. Type
            <code style="color:var(--crimson);font-family:var(--font-mono);font-size:0.9em;">help</code>
            to get started.
          </p>
        </div>
        <div class="section-tags">
          <span class="tag tag--border">Unix-Inspired</span>
          <span class="tag tag--crimson">20+ Commands</span>
        </div>
      </div>
    </div>

    <div class="callout callout--dark" role="note">
      <span class="material-symbols-outlined callout-icon" aria-hidden="true">terminal</span>
      <div class="callout-body">
        <strong class="callout-strong">Try these:</strong>
        <span style="color:var(--slate-300);margin-left:0.25rem;">
          <code style="color:var(--crimson);">about</code>,
          <code style="color:var(--crimson);">skills</code>,
          <code style="color:var(--crimson);">projects</code>,
          <code style="color:var(--crimson);">resume</code>,
          <code style="color:var(--crimson);">whoami</code>
        </span>
      </div>
      <span class="callout-pill">Press &uarr;&darr; for history</span>
    </div>

    <!-- Terminal frame -->
    <div class="terminal-frame" id="terminal-frame">
      <div class="terminal-bar" id="terminal-bar">
        <div class="terminal-traffic">
          <button type="button" class="traffic-dot traffic-dot--red" id="btn-terminal-close" title="Close terminal" aria-label="Close terminal"></button>
          <button type="button" class="traffic-dot traffic-dot--yellow" id="btn-terminal-minimize" title="Minimize terminal" aria-label="Minimize terminal"></button>
          <button type="button" class="traffic-dot traffic-dot--green" id="btn-terminal-fullscreen" title="Toggle fullscreen" aria-label="Toggle fullscreen"></button>
          <span class="terminal-window-name">guest@dev:~/portfolio</span>
        </div>
        <div class="terminal-meta">
          <span>zsh 5.9</span>
          <span>&bull;</span>
          <span class="terminal-status-text" id="terminal-status-text">READY</span>
        </div>
      </div>
      <div class="terminal-body" id="terminal-body">
        <div id="terminal-output"></div>
        <div class="terminal-input-line">
          <span class="terminal-prompt">guest@dev:~$</span>
          <input
            type="text"
            id="terminal-input"
            class="terminal-input"
            placeholder="Type 'help' to start..."
            autocomplete="off"
            spellcheck="false"
            aria-label="Terminal command input"
          />
        </div>
      </div>
    </div>

    <!-- Terminal relaunch banner (shown when terminal is closed) -->
    <div class="terminal-launcher" id="terminal-launcher" style="display:none;" aria-live="polite">
      <div class="terminal-launcher-content">
        <span class="material-symbols-outlined terminal-launcher-icon" aria-hidden="true">terminal</span>
        <div class="terminal-launcher-text">
          <span class="terminal-launcher-title">Terminal session terminated</span>
          <span class="terminal-launcher-sub">Process exited with code 0</span>
        </div>
      </div>
      <button type="button" class="btn btn--primary terminal-relaunch-btn" id="terminal-reopen-btn">
        <svg class="terminal-relaunch-icon" viewBox="0 0 24 24" aria-hidden="true">
          <path d="M12 5a7 7 0 1 1-6.32 4H3.5a9 9 0 1 0 1.26-3.66L3 3.58V9h5.42L6.3 6.88A6.96 6.96 0 0 1 12 5Z"/>
        </svg>
        Relaunch Terminal
      </button>
    </div>

  </div>
</section>
