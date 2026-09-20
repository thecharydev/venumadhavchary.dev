<?php
/**
 * Skills data - Sourced from Resume
 */

return [
    'intro' => 'Backend-first engineering with modern full-stack capability. Go, PHP, React, and relational databases at the core.',
    
    'callout' => 'I design layered RESTful architectures, optimize database schemas across PostgreSQL and MySQL, implement Redis caching, and build responsive interfaces with React and NextJS.',
    
    'primary_skills' => [
        [
            'name' => 'Go (Golang)',
            'percentage' => 88,
            'color' => 'primary',
            'description' => 'Backend services, Echo framework, layered architecture (handler/service/repo), and background job scheduling.',
            'primary' => true
        ],
        [
            'name' => 'PHP / Laravel',
            'percentage' => 90,
            'color' => 'tertiary',
            'description' => 'Full backend systems, MVC architecture, Eloquent ORM, REST APIs, billing engines, and SaaS platforms.',
            'primary' => true
        ],
        [
            'name' => 'PostgreSQL & MySQL',
            'percentage' => 86,
            'color' => 'secondary',
            'description' => 'Relational database design, query optimization, indexing, and Redis caching for high performance.',
            'primary' => false
        ],
        [
            'name' => 'React & NextJS',
            'percentage' => 82,
            'color' => 'primary',
            'description' => 'TypeScript frontends, Turborepo monorepos, responsive dashboards, and component-driven UI architecture.',
            'primary' => false
        ]
    ],
    
    'metrics' => [
        [
            'label' => 'Core Backend',
            'value' => 'Go & PHP',
            'sub' => 'Echo & Laravel',
            'color' => 'secondary'
        ],
        [
            'label' => 'Databases',
            'value' => 'Postgres / MySQL',
            'sub' => '+ Redis Caching',
            'color' => 'primary'
        ],
        [
            'label' => 'Frontend',
            'value' => 'React / NextJS',
            'sub' => 'TypeScript & Turborepo',
            'color' => 'tertiary'
        ],
        [
            'label' => 'Education',
            'value' => 'B.Tech CSE',
            'sub' => 'LPU (2022–2026)',
            'color' => 'secondary'
        ]
    ],
    
    'technologies' => [
        'Go (Golang)',
        'PHP',
        'Laravel',
        'Echo',
        'C++',
        'JavaScript',
        'TypeScript',
        'ReactJs',
        'NextJS',
        'PostgreSQL',
        'MySQL',
        'Redis',
        'Docker',
        'Git',
        'Turborepo',
        'Postman',
        'S3 Object Storage',
        'MVC Architecture',
        'Database Design',
        'RESTful APIs'
    ]
];
