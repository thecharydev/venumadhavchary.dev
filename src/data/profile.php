<?php
/**
 * Profile data - Sourced from Resume & GitHub (@thecharydev)
 */

return [
    'name' => 'Venu Madhav',
    'full_name' => 'Venu Madhav Chary',
    'site_name' => defined('SITE_NAME') ? SITE_NAME : (getenv('SITE_NAME') ?: getenv('site_name') ?: 'venumadhavchary.dev'),
    'site_icon' => defined('SITE_ICON') ? SITE_ICON : (getenv('SITE_ICON') ?: getenv('site_icon') ?: 'V'),
    'title' => 'Software Engineer',
    'role' => 'Software Engineer',
    'tagline' => 'Building robust server-side solutions one line of code at a time',
    'location' => 'Hyderabad, India [IST]',
    'timezone' => 'IST (UTC+5:30)',
    'availability' => 'Open to Work & Opportunities',
    'status' => 'Open to Work & Opportunities',
    'experience_years' => '3+',
    'avatar' => 'assets/images/thecharydev.png',
    'favicon' => 'assets/images/thecharydev.png',
    
    'quote' => 'Building robust server-side solutions one line of code at a time 🚀',
    
    'bio' => "I'm a software engineer focused on building reliable backend systems and thoughtful digital products. I enjoy turning complex requirements into clean, scalable solutions that are built to last. I can't sleep until the bugs are fixed.",
    
    'email' => 'thecharydev@gmail.com',
    'github' => 'https://github.com/thecharydev',
    'github_username' => '@thecharydev',
    'linkedin' => 'https://linkedin.com/in/venumadhavchary/',
    'linkedin_username' => 'in/venumadhavchary',
    
    'education' => [
        [
            'degree' => 'B.Tech in Computer Science and Engineering',
            'institution' => 'Lovely Professional University',
            'period' => '2022 — 2026',
            'location' => 'Phagwara, Punjab',
            'grade' => 'CGPA: 6.56'
        ],
        [
            'degree' => '12th MPC',
            'institution' => 'Sri Chaitanya Junior College',
            'period' => '2020 — 2022',
            'location' => 'Hyderabad, India',
            'grade' => 'Percentage: 92%'
        ],
        [
            'degree' => '10th Secondary School',
            'institution' => 'Sri Chaitanya Techno School',
            'period' => '2019 — 2020',
            'location' => 'Hyderabad, India',
            'grade' => 'CGPA: 10.00'
        ]
    ],
    
    'philosophy' => [
        [
            'number' => '01 // ARCHITECTURE',
            'title' => 'ROBUST SERVER-SIDE',
            'text' => 'Building resilient solutions one line of code at a time. Clean layered architecture across handlers, services, and repositories.',
            'color' => 'crimson'
        ],
        [
            'number' => '02 // PERFORMANCE',
            'title' => 'DATA INTEGRITY & SPEED',
            'text' => 'Disciplined relational schemas across PostgreSQL & MySQL with optimized query indexing and Redis caching.',
            'color' => 'green'
        ],
        [
            'number' => '03 // PRAGMATISM',
            'title' => 'CODE THAT SHIPS',
            'text' => 'Real-world production software over buzzword prototypes. Background queues, automated billing, and rock-solid APIs.',
            'color' => 'blue'
        ]
    ],
    
    'specs' => [
        ['key' => 'Primary Lang', 'value' => 'Go, PHP, JavaScript, C++', 'color' => 'primary'],
        ['key' => 'Frontend', 'value' => 'React, NextJS, TypeScript', 'color' => null],
        ['key' => 'Databases', 'value' => 'PostgreSQL, MySQL, Redis', 'color' => 'secondary'],
        ['key' => 'Tools & Infra', 'value' => 'Docker, Git, Postman, AWS, S3', 'color' => null],
        ['key' => 'Architecture', 'value' => 'MVC, Layered Architecture', 'color' => null]
    ]
];
