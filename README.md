# Venu Madhav's Portfolio - Full-Stack Web Developer

Modern, industrial-aesthetic portfolio built with PHP and the Stitch "Kernel & Monolith" design system.

## 🎨 Design Philosophy

- **No SaaS Clichés:** Industrial computing aesthetic, UNIX-inspired
- **Terminal-First:** Interactive CLI interface with command simulation
- **Inverted Architecture:** Projects at top, identity at bottom
- **Amber Accent:** Industrial amber (#F0883E) replacing typical tech colors
- **Hairline Precision:** 1px borders, tonal elevation, no shadows

## 🛠 Tech Stack

- **Backend:** PHP 8.1+, Composer
- **Email:** Resend API
- **Frontend:** Vanilla JavaScript, modular CSS
- **Typography:** Geist (body) + JetBrains Mono (code)
- **Deployment:** Nginx, GitHub Actions CI/CD

## 📦 Quick Start

### 1. Install Dependencies

```bash
composer install
```

### 2. Configure Environment

```bash
cp .env.example .env
# Edit .env and add your RESEND_API_KEY
```

### 3. Download Fonts (Optional)

Fonts are currently loaded from Google Fonts CDN. For self-hosted fonts:

- **Geist:** https://vercel.com/font
- **JetBrains Mono:** https://www.jetbrains.com/lp/mono/

Place in `public/assets/fonts/geist/` and `public/assets/fonts/jetbrains-mono/` and update the font links in `public/index.php`

### 4. Run Locally

```bash
# From project root
php -S localhost:8000 -t public
```

Visit: http://localhost:8000

The site will load from `public/index.php`

## 🎯 Section Order (Inverted Stack)

```
[Header - Fixed Navigation]
    ↓
[L4: Projects] ← TOP (Apex - What I Built)
[L3: Experience]
[L2: Terminal] ← Interactive CLI Console
[L1: About Me] ← BASE (Foundation - Who I Am)
    └─ Skills embedded in About section
[Contact Form]
[Footer]
```

## 🖥 Terminal Commands

The interactive terminal (L2 section) supports:

**Navigation:**
- `help` - Show all available commands
- `clear` - Clear terminal screen
- `about`, `skills`, `experience`, `projects`, `contact` - Navigate to sections
- `resume` - Download resume PDF
- `whoami`, `ls`, `pwd` - System info commands
- `cat [file]` - Display file contents (try `cat skills.json`)

**Easter Eggs:**
- `sudo`, `sudo rm -rf /`, `hack`, `vim`, `nano`, `exit`
- `date`, `fortune`, `sl`, `ping`, `weather`

**Features:**
- Command history (use ↑/↓ arrow keys)
- Auto-scroll to sections when navigating
- Authentic terminal styling with blinking caret

## 📁 Project Structure

```
├── public/              # Web root
│   ├── index.php       # Main portfolio page
│   ├── api/            # API endpoints
│   └── assets/         # CSS, JS, fonts, images
├── src/                # Backend logic
│   ├── config.php      # Configuration
│   ├── mailer.php      # Resend integration
│   ├── logger.php      # Logging functions
│   └── data/           # Portfolio content
├── logs/               # Request/contact logs
└── .env                # Environment variables

```

## 🚀 Deployment

### Manual Deployment (VPS)

```bash
# SSH to server
ssh user@your-server

# Pull latest code
cd /var/www/venumadhavchary.dev
git pull origin main

# Install dependencies
composer install --no-dev --optimize-autoloader

# Set permissions
chmod -R 755 public
chmod -R 775 logs
chown -R www-data:www-data logs

# Reload services
sudo systemctl reload php8.2-fpm
sudo systemctl reload nginx
```

### Automatic Deployment

Push to `main` branch triggers GitHub Actions workflow:
- Pull latest code
- Install Composer dependencies
- Reload services

## 🔐 Security

- ✅ Rate limiting (5 requests/hour per IP)
- ✅ Input validation (client + server)
- ✅ XSS prevention
- ✅ Secrets in .env (never committed)
- ✅ Protected directories (logs, src, vendor)
- ✅ Security headers via nginx

## 🎨 Customization

### Update Portfolio Content

Edit files in `src/data/`:
- `profile.php` - Bio, name, contact info
- `skills.php` - Technical skills
- `experience.php` - Work timeline
- `projects.php` - Portfolio projects

### Update Colors

Edit `public/assets/css/variables.css` design tokens.

### Add Terminal Commands

Edit `public/assets/js/terminal.js` commands object.

## 📝 License

Personal portfolio - All rights reserved.

## 👤 Author

**Venu Madhav** 
- Email: thecharydev@gmail.com
- GitHub: [@thecharydev](https://github.com/thecharydev)
- Portfolio: https://venumadhavchary.dev

---

Built with industrial precision. No SaaS clichés. 🔧
