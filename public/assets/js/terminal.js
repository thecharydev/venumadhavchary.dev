/**
 * Terminal simulation - interactive command line interface
 * Features:
 * - First-time scroll SSH connection simulation to venumadhavchary.dev
 * - Interactive macOS window controls (Close/Remove, Minimize, Fullscreen)
 * - Rich in-terminal representations for 'about' and 'skills' without page scroll
 */

(function() {
  'use strict';

  // Terminal state
  let commandHistory = [];
  let historyIndex = -1;
  let terminalOutput = [];

  // SSH Animation State
  let sshAnimationPlayed = false;
  let sshAnimationInProgress = false;
  let sshAnimationTimeouts = [];

  // DOM elements
  let terminalFrame;
  let terminalBar;
  let terminalBody;
  let terminalInput;
  let outputContainer;
  let terminalStatusText;
  let terminalLauncher;
  let btnClose;
  let btnMinimize;
  let btnFullscreen;
  let btnReopen;

  // Portfolio data (sourced from resume)
  const portfolioData = {
    about: "Full-Stack Web Developer from Hyderabad, India. B.Tech in CSE at Lovely Professional University. Specialising in Go, PHP (Laravel, Echo), PostgreSQL, MySQL, Redis, React, and NextJS.",
    skills: "Go (88%), PHP / Laravel (90%), PostgreSQL & MySQL (86%), React & NextJS (82%), Redis, Docker",
    projects: [
      "GarageMitra - Automobile Garage Management SaaS in Laravel, MySQL, NextJS (Active)",
      "Tasker - Full-Stack Monorepo in Go, React/TS, Postgres, Redis, S3 (Active)",
      "Cooking Next Big Thing - Converting Coffee to Code ☕ (Distributed Go & Redis Microservices)"
    ],
    experience: [
      "Full-Stack Developer — GarageMitra (2025)",
      "Full-Stack Developer — Tasker (2025–2026)",
      "Freelance Web Developer (2023–Present)"
    ],
    contact: "Email: thecharydev@gmail.com | GitHub: @thecharydev | LinkedIn: in/venumadhavchary | Location: Hyderabad, India [IST]"
  };

  // Command definitions
  const commands = {
    help: () => {
      return `<span class="terminal-success">Available commands:</span>

  <span class="terminal-info">help</span>          Show this help message
  <span class="terminal-info">clear</span>         Clear terminal screen
  <span class="terminal-info">about</span>         Present bio and profile telemetry
  <span class="terminal-info">skills</span>        Display technical skills matrix
  <span class="terminal-info">experience</span>    Show work experience & career telemetry (alias: journey, graph)
  <span class="terminal-info">projects</span>      List portfolio projects
  <span class="terminal-info">contact</span>       Show contact coordinates
  <span class="terminal-info">resume</span>        Download resume PDF
  <span class="terminal-info">whoami</span>        Display developer identity
  <span class="terminal-info">ls</span>            List available sections
  <span class="terminal-info">pwd</span>           Print working directory
  <span class="terminal-info">cat &lt;file&gt;</span>    Display file contents (e.g. cat skills.json)
  <span class="terminal-info">exit</span>          Close terminal window

<span class="terminal-dim">Try some fun commands:</span> <span class="terminal-info">sudo</span>, <span class="terminal-info">hack</span>, <span class="terminal-info">vim</span>, <span class="terminal-info">date</span>, <span class="terminal-info">fortune</span>, <span class="terminal-info">sl</span>`;
    },

    clear: () => {
      terminalOutput = [];
      if (outputContainer) {
        outputContainer.innerHTML = '';
      }
      return null;
    },

    about: () => {
      return `<div class="terminal-card">
<span class="terminal-info">┌─────────────────────────────────────────────────────────────┐</span>
<span class="terminal-info">│</span> <strong style="color:var(--text-primary)">Venu Madhav Chary</strong> 
<span class="terminal-info">│</span> <span style="color:var(--text-secondary)">Software Engineer &bull; Hyderabad, India [IST]</span>
<span class="terminal-info">└─────────────────────────────────────────────────────────────┘</span>

<span class="terminal-success">&#9656; Summary:</span>
Full-Stack Web Developer pursuing B.Tech in CSE at Lovely Professional
University (2022–2026). Specialising in high-reliability Go & PHP (Laravel,
Echo) backends, PostgreSQL/MySQL relational databases, Redis caching,
and modern React/NextJS frontends.

<span class="terminal-info">&#9656; Telemetry & Coordinates:</span>
  • <strong style="color:var(--text-primary)">Status:</strong>       <span class="terminal-success">&#9679; Open to Work & Opportunities</span>
  • <strong style="color:var(--text-primary)">Architecture:</strong> Layered Architecture (Handler/Service/Repo), MVC
  • <strong style="color:var(--text-primary)">Education:</strong>    B.Tech CSE @ LPU (2022–2026) &bull; CGPA: 6.56
  • <strong style="color:var(--text-primary)">GitHub:</strong>       <a href="https://github.com/thecharydev" target="_blank" rel="noopener noreferrer" class="terminal-link">https://github.com/thecharydev</a>
  • <strong style="color:var(--text-primary)">LinkedIn:</strong>     <a href="https://linkedin.com/in/venumadhavchary/" target="_blank" rel="noopener noreferrer" class="terminal-link">in/venumadhavchary</a>
  • <strong style="color:var(--text-primary)">Email:</strong>        <a href="mailto:thecharydev@gmail.com" class="terminal-link">thecharydev@gmail.com</a>
</div>
<span style="color:var(--text-tertiary)">Type <span class="terminal-info">skills</span> for technical abilities &bull; <span class="terminal-info">projects</span> for live deployments</span>`;
    },

    skills: () => {
      return `<div class="terminal-card">
<span class="terminal-success">&#9656; CORE PROFICIENCIES & TELEMETRY:</span>
  Go (Golang)        <span class="terminal-bar-chart">[<span style="color:var(--primary)">██████████████████</span>░░]</span> <span class="terminal-info">88%</span> &bull; Echo, Layered Arch, Goroutines
  PHP / Laravel      <span class="terminal-bar-chart">[<span style="color:var(--primary)">███████████████████</span>]</span> <span class="terminal-info">90%</span> &bull; MVC, Eloquent ORM, REST APIs, Billing
  PostgreSQL & MySQL <span class="terminal-bar-chart">[<span style="color:var(--primary)">█████████████████</span>░░░]</span> <span class="terminal-info">86%</span> &bull; Relational Schema, Indexing, Queries
  React & NextJS     <span class="terminal-bar-chart">[<span style="color:var(--primary)">████████████████</span>░░░░]</span> <span class="terminal-info">82%</span> &bull; TypeScript, Turborepo, Responsive UI

<span class="terminal-success">&#9656; TECH STACK MATRIX:</span>
  • <strong style="color:var(--text-primary)">Languages:</strong>     Go, PHP, JavaScript, TypeScript, C++, SQL
  • <strong style="color:var(--text-primary)">Backend:</strong>       Laravel, Echo Framework, RESTful APIs, MVC, Layered Arch
  • <strong style="color:var(--text-primary)">Frontend:</strong>      React, Next.js, HTML5, CSS3, Component Systems
  • <strong style="color:var(--text-primary)">Databases:</strong>     PostgreSQL, MySQL, Redis (Caching & Background Queues)
  • <strong style="color:var(--text-primary)">DevOps & Infra:</strong> Docker, Git, Turborepo, Postman, S3, Linux/Nginx
</div>
<span style="color:var(--text-tertiary)">Run <span class="terminal-info">cat skills.json</span> for full JSON breakdown &bull; <span class="terminal-info">projects</span> for builds</span>`;
    },

    experience: () => {
      return `<span class="terminal-success">Work Experience & Career Telemetry:</span>\n\n` +
        portfolioData.experience.map(exp => `  • ${exp}`).join('\n') +
        `\n\n<span style="color:var(--text-tertiary)">Type <span class="terminal-info">about</span> for bio &bull; <span class="terminal-info">projects</span> for live builds</span>`;
    },

    journey: () => commands.experience(),
    graph: () => commands.experience(),

    projects: () => {
      return `<span class="terminal-success">Portfolio Projects:</span>\n\n` +
        portfolioData.projects.map((proj, i) => `  [P-${i+1}] ${proj}`).join('\n') +
        `\n\n<span style="color:var(--text-tertiary)">Explore live interactive cards in the Projects section.</span>`;
    },

    contact: () => {
      return `<span class="terminal-success">Contact Coordinates:</span>\n
  • <strong style="color:var(--text-primary)">Email:</strong>    <a href="mailto:thecharydev@gmail.com" class="terminal-link">thecharydev@gmail.com</a>
  • <strong style="color:var(--text-primary)">GitHub:</strong>   <a href="https://github.com/thecharydev" target="_blank" rel="noopener noreferrer" class="terminal-link">@thecharydev</a>
  • <strong style="color:var(--text-primary)">LinkedIn:</strong> <a href="https://linkedin.com/in/venumadhavchary/" target="_blank" rel="noopener noreferrer" class="terminal-link">in/venumadhavchary</a>
  • <strong style="color:var(--text-primary)">Location:</strong> Hyderabad, India [IST]
  • <strong style="color:var(--text-primary)">Status:</strong>   <span class="terminal-success">Open to Work & Opportunities</span>`;
    },

    resume: () => {
      window.open('/api/download-resume.php', '_blank');
      return '<span class="terminal-success">Opening resume PDF...</span>';
    },

    whoami: () => {
      return `<span class="terminal-info">guest@dev</span> (visitor session connected to Venu Madhav's server)
Host: Venu Madhav Chary — Full-Stack Web Developer
Backend: Go & PHP | Frontend: React & NextJS | DB: PostgreSQL, MySQL, Redis
Location: Hyderabad, India [IST] | Status: <span class="terminal-success">Open to Work & Opportunities</span>

Run <span class="terminal-info">about</span> for bio & coordinates, or <span class="terminal-info">projects</span> to view work`;
    },

    ls: () => {
      return `about.md      skills.json      projects/      experience/      contact.txt`;
    },

    pwd: () => {
      return '/home/guest/portfolio';
    },

    cat: (args) => {
      const file = args[0];
      if (!file) {
        return '<span class="terminal-error">cat: missing file operand</span>';
      }
      
      if (file === 'about.md' || file === 'about') {
        return commands.about();
      } else if (file === 'skills.json' || file === 'skills') {
        return `{
  "languages": ["Go", "PHP", "JavaScript", "TypeScript", "C++"],
  "backend": ["Laravel", "Echo"],
  "frontend": ["ReactJs", "NextJS", "HTML/CSS"],
  "databases": ["PostgreSQL", "MySQL", "Redis"],
  "tools": ["Docker", "Git", "Turborepo", "Postman", "S3"],
  "concepts": ["Layered Architecture", "MVC Architecture", "Database Design", "RESTful APIs"]
}`;
      } else if (file === 'contact.txt' || file === 'contact') {
        return commands.contact();
      }
      return `<span class="terminal-error">cat: ${escapeHtml(file)}: No such file or directory</span>`;
    },

    cd: () => {
      return '<span class="terminal-error">cd: Access denied. This is a portfolio, not a filesystem.</span>';
    },

    // Fun easter eggs
    sudo: (args) => {
      if (args.length === 0) {
        return `[sudo] password for guest: 
<span class="terminal-error">guest is not in the sudoers file. This incident will be reported. 😏</span>`;
      }
      if (args.join(' ') === 'rm -rf /' || args.join(' ') === 'rm -rf /*') {
        return '<span class="terminal-error">Permission denied. Also, why would you do that?</span>';
      }
      return '<span class="terminal-error">sudo: command not allowed</span>';
    },

    rm: (args) => {
      if (args.join(' ').includes('-rf /')) {
        return `<span class="terminal-error">rm: cannot remove '/': Permission denied</span>
(If you're seeing this, you're in the wrong terminal)`;
      }
      return '<span class="terminal-error">rm: operation not permitted</span>';
    },

    hack: () => {
      return `Initiating hack sequence...
<span class="terminal-info">[████████░░] 80%</span>
<span class="terminal-error">Access denied.</span> Try being a legitimate client instead. 💼`;
    },

    exit: () => {
      closeTerminal();
      return '<span class="terminal-info">Closing terminal session...</span>';
    },

    vim: () => {
      return `You can't exit vim. Nobody can.
(Just kidding. Press ESC then :q! if you really want to leave)`;
    },

    nano: () => {
      return 'Seriously? nano? What are you, a frontend developer? 😄';
    },

    date: () => {
      return `It's time to hire me. 🚀
(Actual time: ${new Date().toLocaleString()})`;
    },

    sl: () => {
      return '🚂 💨  💨  💨';
    },

    fortune: () => {
      const fortunes = [
        '"Write code like nobody\'s going to maintain it, because they won\'t. They\'ll rewrite it." - Anonymous',
        '"The best thing about a boolean is even if you are wrong, you are only off by a bit." - Anonymous',
        '"PHP is like a chainsaw. Dangerous in the wrong hands, but incredibly useful when wielded correctly."',
        '"There are only two hard things in Computer Science: cache invalidation and naming things." - Phil Karlton',
        '"It works on my machine." - Every developer, ever'
      ];
      return fortunes[Math.floor(Math.random() * fortunes.length)];
    },

    ping: (args) => {
      const host = args[0] || 'google.com';
      return `PING ${escapeHtml(host)}: This isn't a real terminal. But yes, the internet works.`;
    },

    weather: () => {
      return '☀️ Current conditions: Clear skies, perfect weather for coding in Go, PHP, and PostgreSQL.';
    }
  };

  // SSH Boot Animation on First Scroll
  function getUnixDate() {
    const d = new Date();
    const parts = d.toString().split(' ');
    const timeStr = parts[4] || d.toTimeString().split(' ')[0];
    const yearStr = parts[3] || d.getFullYear();
    return parts.slice(0, 3).join(' ') + ' ' + timeStr + ' ' + yearStr;
  }

  function getWelcomeBanner() {
    return `<span class="terminal-info">  ____                 
 |  _ \\   ___ __   __  
 | | | | / _ \\ \\ / /  
 | |_| ||  __/ \\ V /   
 |____/  \\___|  \\_/    </span>

<span style="color:var(--text-muted)">Last login: ${getUnixDate()} from 10.10.10.20</span>

Type <span class="terminal-info">help</span> for available commands.\n`;
  }

  function runSshSequence(force = false) {
    if ((sshAnimationPlayed && !force) || sshAnimationInProgress) return;
    if (force) {
      sshAnimationTimeouts.forEach(clearTimeout);
      sshAnimationTimeouts = [];
    }
    sshAnimationPlayed = false;
    sshAnimationInProgress = true;

    if (terminalFrame) {
      terminalFrame.classList.add('terminal-frame--connecting');
    }

    if (outputContainer) {
      outputContainer.innerHTML = '';
    }

    if (terminalStatusText) {
      terminalStatusText.textContent = 'CONNECTING...';
      terminalStatusText.style.color = 'var(--warning, #ffbd2e)';
    }

    // Temporarily hide prompt line while connecting
    const inputLine = document.querySelector('.terminal-input-line');
    if (inputLine) {
      inputLine.style.opacity = '0';
      inputLine.style.pointerEvents = 'none';
    }

    const commandToType = 'ssh guest@venumadhavchary.dev';
    const typingLine = document.createElement('div');
    typingLine.className = 'terminal-line';
    typingLine.innerHTML = `<span class="terminal-prompt">guest@local:~$</span> <span class="terminal-command" id="ssh-command-text"></span><span class="terminal-caret" id="ssh-caret"></span>`;
    outputContainer.appendChild(typingLine);

    const sshCmdText = document.getElementById('ssh-command-text');
    let charIdx = 0;

    function typeNextChar() {
      if (charIdx < commandToType.length) {
        if (sshCmdText) {
          sshCmdText.textContent += commandToType.charAt(charIdx);
        }
        charIdx++;
        const tid = setTimeout(typeNextChar, 24);
        sshAnimationTimeouts.push(tid);
      } else {
        const caret = document.getElementById('ssh-caret');
        if (caret) caret.remove();

        const tid1 = setTimeout(() => {
          addOutput('<span style="color:var(--text-muted)">Connecting to venumadhavchary.dev [127.0.0.1:22]...</span>');
          if (terminalStatusText) {
            terminalStatusText.textContent = 'CONNECTED';
            terminalStatusText.style.color = 'var(--secondary-light)';
          }
          if (terminalBody) terminalBody.scrollTop = terminalBody.scrollHeight;
        }, 150);
        sshAnimationTimeouts.push(tid1);

        const tid2 = setTimeout(() => {
          addOutput(getWelcomeBanner());
          finishSshSequence();
        }, 420);
        sshAnimationTimeouts.push(tid2);
      }
    }

    const startTid = setTimeout(typeNextChar, 100);
    sshAnimationTimeouts.push(startTid);
  }

  function finishSshSequence() {
    sshAnimationTimeouts.forEach(clearTimeout);
    sshAnimationTimeouts = [];

    sshAnimationInProgress = false;
    sshAnimationPlayed = true;

    if (terminalFrame) {
      terminalFrame.classList.remove('terminal-frame--connecting');
    }

    const inputLine = document.querySelector('.terminal-input-line');
    if (inputLine) {
      inputLine.style.opacity = '1';
      inputLine.style.pointerEvents = 'auto';
    }

    if (terminalStatusText && !terminalFrame.classList.contains('terminal-frame--fullscreen')) {
      terminalStatusText.textContent = 'READY';
      terminalStatusText.style.color = 'var(--secondary-light)';
    }

    if (terminalInput && window.innerWidth > 768) {
      terminalInput.focus();
    }

    if (terminalBody) {
      terminalBody.scrollTop = terminalBody.scrollHeight;
    }
  }

  function skipSshSequence() {
    if (!sshAnimationInProgress) return;
    sshAnimationTimeouts.forEach(clearTimeout);
    sshAnimationTimeouts = [];

    if (outputContainer) {
      outputContainer.innerHTML = '';
      addOutput('<span class="terminal-prompt">guest@local:~$</span> <span class="terminal-command">ssh guest@venumadhavchary.dev</span>');
      addOutput('<span style="color:var(--text-muted)">Connecting to venumadhavchary.dev [127.0.0.1:22]...</span>');
      addOutput(getWelcomeBanner());
    }

    finishSshSequence();
  }

  // Window control actions
  function closeTerminal() {
    if (!terminalFrame) return;
    if (terminalFrame.classList.contains('terminal-frame--fullscreen')) {
      toggleFullscreen(false);
    }
    terminalFrame.classList.add('terminal-frame--closing');
    setTimeout(() => {
      terminalFrame.classList.remove('terminal-frame--closing');
      terminalFrame.classList.add('terminal-frame--closed');
      if (terminalLauncher) {
        terminalLauncher.style.display = 'flex';
        terminalLauncher.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      }
    }, 220);
  }

  function reopenTerminal() {
    if (!terminalFrame) return;

    if (btnReopen) {
      btnReopen.classList.add('is-relaunching', 'is-active');
    }

    if (terminalLauncher) {
      terminalLauncher.classList.add('terminal-launcher--closing');
    }

    // Cancel any pending animations
    sshAnimationTimeouts.forEach(clearTimeout);
    sshAnimationTimeouts = [];

    setTimeout(() => {
      if (terminalLauncher) {
        terminalLauncher.style.display = 'none';
        terminalLauncher.classList.remove('terminal-launcher--closing');
      }
      if (btnReopen) {
        btnReopen.classList.remove('is-relaunching', 'is-active');
      }

      // Reset state to a completely fresh terminal session
      terminalOutput = [];
      if (outputContainer) {
        outputContainer.innerHTML = '';
      }
      if (terminalInput) {
        terminalInput.value = '';
      }
      historyIndex = commandHistory.length;

      // Clear minimized state if it was minimized before closing
      if (terminalFrame.classList.contains('terminal-frame--minimized')) {
        terminalFrame.classList.remove('terminal-frame--minimized');
      }
      if (btnMinimize) {
        btnMinimize.title = 'Minimize terminal';
        btnMinimize.setAttribute('aria-label', 'Minimize terminal');
      }

      terminalFrame.classList.remove('terminal-frame--closed');
      terminalFrame.classList.add('terminal-frame--restoring');

      setTimeout(() => {
        terminalFrame.classList.remove('terminal-frame--restoring');
        // Boot up a fresh SSH connection sequence
        runSshSequence(true);
      }, 350);
    }, 220);
  }

  function toggleMinimize() {
    if (!terminalFrame) return;
    const isMinimized = terminalFrame.classList.toggle('terminal-frame--minimized');
    if (terminalStatusText) {
      terminalStatusText.textContent = isMinimized ? 'MINIMIZED' : 'READY';
      terminalStatusText.style.color = isMinimized ? 'var(--warning, #ffbd2e)' : 'var(--secondary-light)';
    }
    if (btnMinimize) {
      btnMinimize.title = isMinimized ? 'Restore terminal' : 'Minimize terminal';
      btnMinimize.setAttribute('aria-label', isMinimized ? 'Restore terminal' : 'Minimize terminal');
    }
    if (!isMinimized && terminalInput) {
      terminalInput.focus();
    }
  }

  function toggleFullscreen(forceState) {
    if (!terminalFrame) return;

    // If currently minimized, restore it first
    if (terminalFrame.classList.contains('terminal-frame--minimized')) {
      terminalFrame.classList.remove('terminal-frame--minimized');
    }

    const shouldFullscreen = typeof forceState === 'boolean'
      ? forceState
      : !terminalFrame.classList.contains('terminal-frame--fullscreen');

    terminalFrame.classList.toggle('terminal-frame--fullscreen', shouldFullscreen);
    document.body.classList.toggle('terminal-fullscreen-active', shouldFullscreen);

    if (terminalStatusText) {
      terminalStatusText.textContent = shouldFullscreen ? 'FULLSCREEN (ESC)' : 'READY';
      terminalStatusText.style.color = shouldFullscreen ? 'var(--primary)' : 'var(--secondary-light)';
    }

    if (btnFullscreen) {
      btnFullscreen.title = shouldFullscreen ? 'Exit fullscreen' : 'Toggle fullscreen';
      btnFullscreen.setAttribute('aria-label', shouldFullscreen ? 'Exit fullscreen' : 'Toggle fullscreen');
    }

    if (terminalInput) {
      terminalInput.focus();
    }

    if (terminalBody) {
      terminalBody.scrollTop = terminalBody.scrollHeight;
    }
  }

  // Initialize terminal
  function initTerminal() {
    terminalFrame = document.getElementById('terminal-frame');
    terminalBar = document.getElementById('terminal-bar');
    terminalBody = document.getElementById('terminal-body');
    terminalInput = document.getElementById('terminal-input');
    outputContainer = document.getElementById('terminal-output');
    terminalStatusText = document.getElementById('terminal-status-text');
    terminalLauncher = document.getElementById('terminal-launcher');

    btnClose = document.getElementById('btn-terminal-close');
    btnMinimize = document.getElementById('btn-terminal-minimize');
    btnFullscreen = document.getElementById('btn-terminal-fullscreen');
    btnReopen = document.getElementById('terminal-reopen-btn');

    if (!terminalInput) return;

    // Traffic buttons click events
    if (btnClose) {
      btnClose.addEventListener('click', (e) => {
        e.stopPropagation();
        closeTerminal();
      });
    }

    if (btnMinimize) {
      btnMinimize.addEventListener('click', (e) => {
        e.stopPropagation();
        toggleMinimize();
      });
    }

    if (btnFullscreen) {
      btnFullscreen.addEventListener('click', (e) => {
        e.stopPropagation();
        toggleFullscreen();
      });
    }

    if (btnReopen) {
      btnReopen.addEventListener('click', reopenTerminal);
    }

    // Clicking header bar restores when minimized
    if (terminalBar) {
      terminalBar.addEventListener('click', (e) => {
        if (terminalFrame && terminalFrame.classList.contains('terminal-frame--minimized')) {
          if (!e.target.closest('button')) {
            toggleMinimize();
          }
        }
      });
    }

    // Global ESC key to exit fullscreen
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && terminalFrame && terminalFrame.classList.contains('terminal-frame--fullscreen')) {
        toggleFullscreen(false);
      }
    });

    // Handle input
    terminalInput.addEventListener('keydown', handleKeyDown);
    
    // Focus or skip on click inside terminal body
    if (terminalBody) {
      terminalBody.addEventListener('click', () => {
        if (sshAnimationInProgress) {
          skipSshSequence();
        } else {
          terminalInput.focus();
        }
      });
    }

    // Setup intersection observer to run SSH animation on first scroll
    const terminalSection = document.getElementById('section-terminal') || terminalFrame;
    if ('IntersectionObserver' in window && terminalSection) {
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting && !sshAnimationPlayed) {
            observer.unobserve(entry.target);
            runSshSequence();
          }
        });
      }, { threshold: 0.25 });

      observer.observe(terminalSection);
    } else {
      // Fallback
      runSshSequence();
    }
  }

  // Handle keyboard input
  function handleKeyDown(e) {
    if (sshAnimationInProgress) {
      skipSshSequence();
      return;
    }

    if (e.key === 'Enter') {
      e.preventDefault();
      const command = terminalInput.value.trim();
      
      if (command) {
        commandHistory.push(command);
        historyIndex = commandHistory.length;
        executeCommand(command);
      }
      
      terminalInput.value = '';
    } else if (e.key === 'ArrowUp') {
      e.preventDefault();
      if (historyIndex > 0) {
        historyIndex--;
        terminalInput.value = commandHistory[historyIndex];
      }
    } else if (e.key === 'ArrowDown') {
      e.preventDefault();
      if (historyIndex < commandHistory.length - 1) {
        historyIndex++;
        terminalInput.value = commandHistory[historyIndex];
      } else {
        historyIndex = commandHistory.length;
        terminalInput.value = '';
      }
    } else if (e.key === 'Tab') {
      e.preventDefault();
      const partial = terminalInput.value.toLowerCase();
      const matches = Object.keys(commands).filter(cmd => cmd.startsWith(partial));
      if (matches.length === 1) {
        terminalInput.value = matches[0];
      }
    }
  }

  // Execute command
  function executeCommand(input) {
    // Show command in output
    addOutput(`<span class="terminal-prompt">guest@dev:~$</span> <span class="terminal-command">${escapeHtml(input)}</span>`);

    // Parse command
    const parts = input.trim().split(/\s+/);
    const cmd = parts[0].toLowerCase();
    const args = parts.slice(1);

    // Execute
    if (commands[cmd]) {
      const result = commands[cmd](args);
      if (result !== null && result !== undefined) {
        addOutput(result);
      }
    } else {
      addOutput(`<span class="terminal-error">Command not found: ${escapeHtml(cmd)}</span>\nType <span class="terminal-info">help</span> for available commands`);
    }

    // Scroll to bottom
    if (terminalBody) {
      terminalBody.scrollTop = terminalBody.scrollHeight;
    }
  }

  // Add output to terminal
  function addOutput(text) {
    if (!outputContainer) return;

    const line = document.createElement('div');
    line.className = 'terminal-line';
    line.innerHTML = text;
    outputContainer.appendChild(line);

    terminalOutput.push(text);
  }

  // Escape HTML
  function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
  }

  // Initialize on load
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initTerminal);
  } else {
    initTerminal();
  }
})();
