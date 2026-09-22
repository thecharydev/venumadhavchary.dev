<?php
/**
 * Experience & Growth data - Sourced directly from Venu Madhav's journey
 */

return [
    'intro' => 'From coding on a mobile phone as a teenage rookie to first-principles backend scaling and full-stack SaaS engineering.',
    
    'callout' => 'Started in 2020 without a laptop, coding directly from a mobile phone — building websites with PHP & MySQL and running a web hosting reselling venture. Later, discovering how a request actually travels from client to server blew my mind and led me to choose backend engineering. Diving deep into first principles — mastering internals, architecture, caching, and system scaling. Today, I am a Software Engineer ready to build and scale high-impact systems.',
    
    'growth_milestones' => [
        [
            'id' => 'm-2020',
            'year' => '2020 — 2022',
            'year_short' => '2020–22',
            'tag' => 'TEENAGE ROOKIE // NO LAPTOP',
            'title' => 'The Teenage Rookie: Mobile Roots & Hosting Company',
            'highlight' => 'Started Web Hosting Company from Mobile',
            'description' => 'Did not own a laptop during COVID, so developed, hosted, and configured web solutions straight from a mobile phone. Launched a web hosting venture managing cPanel, Plesk, and automated client billing with WHMCS, configuring VPS instances, SEO, and building websites with PHP and MySQL.',
            'skills' => ['PHP', 'MySQL', 'WHMCS', 'Plesk', 'cPanel', 'Web Hosting', 'VPS Management', 'WordPress', 'SEO', 'Linux CLI', 'DNS & Domains'],
            'color' => 'secondary'
        ],
        [
            'id' => 'm-2022',
            'year' => '2022 — 2024',
            'year_short' => '2022–24',
            'tag' => 'CS FUNDAMENTALS // LPU',
            'title' => 'Academic Foundations & Core Algorithms',
            'highlight' => 'B.Tech CSE at LPU',
            'description' => 'Enrolled at Lovely Professional University for Computer Science. Focused on core software engineering fundamentals, algorithmic problem solving in C++, object-oriented design patterns, and relational database management systems.',
            'skills' => ['C++', 'OOP', 'Data Structures & Algorithms', 'DBMS & SQL', 'Operating Systems', 'Web Fundamentals'],
            'color' => 'blue'
        ],
        [
            'id' => 'm-2024',
            'year' => '2024 — 2026',
            'year_short' => '2024–26 (The Spike ★)',
            'tag' => 'THE INFLECTION SPIKE ★',
            'title' => 'Backend Enthusiast: First Principles & Systems Scaling',
            'highlight' => 'First-Principles Awakening',
            'description' => 'The major growth spike: uncovered how deep client-to-server request processing actually goes. Studied backend engineering from first principles (HTTP internals, routing, layered architecture, Postgres, Redis caching, worker queues, fault tolerance, and backend scaling). Built and shipped GarageMitra (Laravel workshop management system) and Tasker (Go/React monorepo).',
            'skills' => [
                'HTTP Internals & Routing',
                'Layered Architecture (Handler/Service/Repo)',
                'Request Context & Serialization',
                'PostgreSQL Mastery',
                'Redis Caching Strategies',
                'Task Queues & Background Workers',
                'Error Handling & Fault Tolerance',
                'Graceful Shutdown & Observability',
                'Backend Security & Auth',
                'Backend Scaling & Performance',
                'Go (Golang)',
                'Laravel & PHP',
                'Turborepo & Docker'
            ],
            'color' => 'crimson',
            'featured' => true
        ],
        [
            'id' => 'm-present',
            'year' => 'PRESENT (2026)',
            'year_short' => 'Present (2026)',
            'tag' => 'SOFTWARE ENGINEER // READY TO SHIP',
            'title' => 'Software Engineer — Open to Opportunities',
            'highlight' => 'Actively Seeking Opportunities',
            'description' => 'Equipped with disciplined first-principles backend foundations, real-world production full-stack engineering experience, and relentless curiosity. Open to software engineering roles where I can build and scale robust systems.',
            'skills' => [
                'High-Concurrency Backends',
                'Production SaaS Architecture',
                'Go & Layered Systems',
                'Laravel & MySQL',
                'PostgreSQL & Redis',
                'Turborepo & TypeScript'
            ],
            'color' => 'green',
            'active' => true
        ]
    ],

    'timeline' => [
        [
            'role' => 'Software Engineer — Open to Opportunities',
            'period' => '2026 — PRESENT',
            'description' => 'Ready to build high-performance systems. Bringing first-principles backend engineering discipline, deep understanding of the client-to-server request lifecycle, layered architecture, Redis caching, asynchronous worker queues, and hands-on production shipping experience.',
            'technologies' => ['Go', 'Laravel', 'PostgreSQL', 'Redis', 'ReactJs', 'TypeScript', 'Docker', 'System Scaling'],
            'color' => 'green'
        ],
        [
            'role' => 'Backend Developer Enthusiast — The Growth Spike',
            'period' => '2024 — 2026',
            'description' => 'Underwent an exponential growth inflection. Mastered backend engineering from first principles, including system scaling and performance engineering. Engineered GarageMitra (Laravel auto garage management system with dynamic billing and job cards) followed by Tasker (Go + React/TS monorepo with cron workflows, Postgres, Redis, and layered architecture).',
            'technologies' => ['HTTP Internals', 'Layered Architecture', 'PostgreSQL', 'Redis Caching', 'Task Queues', 'Fault Tolerance', 'Backend Scaling', 'Go', 'Laravel'],
            'color' => 'primary'
        ],
        [
            'role' => 'B.Tech CSE Student — CS Fundamentals',
            'organization' => 'Lovely Professional University (LPU)',
            'period' => '2022 — 2024',
            'description' => 'Studied core computer science curriculum: C++, Object-Oriented Programming (OOP), Data Structures and Algorithms, Database Management Systems, and operating system basics.',
            'transition_note' => 'Because of all the hands-on building, hosting, and web work I did during 2020–2022, I chose to pursue B.Tech in Computer Science and Engineering.',
            'technologies' => ['C++', 'OOP', 'Data Structures', 'Algorithms', 'DBMS', 'SQL'],
            'color' => 'tertiary'
        ],
        [
            'role' => 'Teenage Rookie & Web Hosting Founder',
            'period' => '2020 — 2022',
            'description' => 'Started without a laptop during COVID, running and coding everything directly from a mobile phone. Founded a web hosting venture, configured server virtualization with cPanel, Plesk, and automated client billing with WHMCS. Built websites with PHP and MySQL under raw resource constraints.',
            'technologies' => ['PHP', 'MySQL', 'WHMCS', 'Plesk', 'cPanel', 'Web Hosting', 'VPS', 'WordPress', 'SEO', 'Linux'],
            'color' => 'secondary'
        ]
    ]
];
