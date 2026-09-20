<?php
/**
 * Venu Madhav's Portfolio 
 * Architecture: Projects (apex) → Experience → Terminal → About (foundation) → Contact
 */

require_once __DIR__ . '/../src/config.php';

// Load portfolio data
$profile        = require __DIR__ . '/../src/data/profile.php';
$skillsData     = require __DIR__ . '/../src/data/skills.php';
// $experienceData = require __DIR__ . '/../src/data/experience.php';
$projectsData   = require __DIR__ . '/../src/data/projects.php';

// Normalize data variables for partials
$skills             = $skillsData;
$primarySkills      = $skillsData['primary_skills'] ?? $skillsData['primary'] ?? [];
$skillMetrics       = $skillsData['metrics'] ?? [];
$technologies       = $skillsData['technologies'] ?? $skillsData['secondary'] ?? [];
// $experiencePhases   = $experienceData['phases'] ?? [];
// $experienceTimeline = $experienceData['timeline'] ?? [];
$projects           = $projectsData['projects'] ?? $projectsData;
// $services           = $projectsData['services'] ?? [];

?>
<!DOCTYPE html>
<html lang="en">
<?php require __DIR__ . '/views/layout/head.php'; ?>
<body>
<?php require __DIR__ . '/views/layout/loader.php'; ?>

<?php require __DIR__ . '/views/layout/header.php'; ?>

<main id="main-content" class="site-main">
  <?php 
    require __DIR__ . '/views/sections/projects.php'; 
    // require __DIR__ . '/views/sections/experience.php'; 
    require __DIR__ . '/views/sections/terminal.php'; 
    require __DIR__ . '/views/sections/about.php'; 
   ?>
</main>

<?php require __DIR__ . '/views/layout/footer.php'; ?>

</body>
</html>
