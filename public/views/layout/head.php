<?php
/**
 * public/views/layout/head.php
 * <head> block — meta tags, fonts, stylesheets.
 * Variables expected: $profile (array)
 */
$rawFavicon = $profile['favicon'] ?? $profile['avatar'] ?? 'assets/images/thecharydev.png';
$favicon = ltrim(preg_replace('#^/?public/#', '', $rawFavicon), '/');
?>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- SEO -->
  <title><?= htmlspecialchars($profile['name']) ?> | <?= htmlspecialchars($profile['title']) ?></title>
  <meta name="description" content="<?= htmlspecialchars($profile['bio']) ?>" />
  <meta name="author"      content="<?= htmlspecialchars($profile['full_name']) ?>" />
  <meta property="og:title"       content="<?= htmlspecialchars($profile['name']) ?> | <?= htmlspecialchars($profile['title']) ?>" />
  <meta property="og:description" content="<?= htmlspecialchars($profile['bio']) ?>" />
  <meta property="og:type"        content="website" />
  <meta property="og:image"       content="<?= htmlspecialchars($favicon) ?>" />

  <!-- Favicon -->
  <link rel="icon" href="<?= htmlspecialchars($favicon) ?>" type="image/png" />
  <link rel="apple-touch-icon" href="<?= htmlspecialchars($favicon) ?>" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@400,0&display=swap" rel="stylesheet" />

  <!-- Stylesheets — load order matters -->
  <link rel="stylesheet" href="<?= asset_url('assets/css/variables.css') ?>" />
  <link rel="stylesheet" href="<?= asset_url('assets/css/base.css') ?>" />
  <link rel="stylesheet" href="<?= asset_url('assets/css/loader.css') ?>" />
  <link rel="stylesheet" href="<?= asset_url('assets/css/components.css') ?>" />
  <link rel="stylesheet" href="<?= asset_url('assets/css/header.css') ?>" />
  <link rel="stylesheet" href="<?= asset_url('assets/css/projects.css') ?>" />
  <link rel="stylesheet" href="<?= asset_url('assets/css/experience.css') ?>" />
  <link rel="stylesheet" href="<?= asset_url('assets/css/terminal.css') ?>" />
  <link rel="stylesheet" href="<?= asset_url('assets/css/hero.css') ?>" />
  <link rel="stylesheet" href="<?= asset_url('assets/css/skills.css') ?>" />
  <link rel="stylesheet" href="<?= asset_url('assets/css/contact.css') ?>" />
  <link rel="stylesheet" href="<?= asset_url('assets/css/footer.css') ?>" />
  <link rel="stylesheet" href="<?= asset_url('assets/css/animations.css') ?>" />

  <!-- Initial landing behavior -->
  <script>
    if (!window.location.hash || window.location.hash === '#section-about') {
      if ('scrollRestoration' in history) {
        history.scrollRestoration = 'manual';
      }
    }
  </script>
</head>
