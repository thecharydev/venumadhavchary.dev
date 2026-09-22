<?php
/**
 * Projects data - Sourced from Resume
 */

return [
    'intro' => 'Real-world full-stack systems built and shipped. Layered architectures, reliable databases, and automated workflows.',
    
    'projects' => [
        [
            'id' => 'P-01',
            'name' => 'GarageMitra',
            'status' => 'ACTIVE BUILD',
            'badge' => 'MANAGEMENT TOOL',
            'featured' => true,
            'highlights' => [
                'Digital workshop system tracking job cards and vehicle repair history.',
                'Built to learn Laravel hands-on by solving daily workflow friction for mechanics.',
                'Replaced manual paperwork with digitized records and instant billing.'
            ],
            'type' => 'Workshop Management System',
            'stack' => 'Laravel PHP, MySQL, NextJS',
            'status_text' => 'Completed Project (2025)',
            'technologies' => ['Job Cards', 'Service History', 'Customer Records', 'Billing', 'Invoicing'],
            'repo' => 'https://github.com/thecharydev/garagemitra',
            'type_color' => 'tertiary',
            'status_color' => 'secondary'
        ],
        [
            'id' => 'P-02',
            'name' => 'Tasker',
            'status' => 'ACTIVE BUILD',
            'badge' => 'FEATURED',
            'featured' => true,
            'highlights' => [
                'Task management system with cron workflows, worker queues, and object storage.',
                'Built to understand how production-grade, high-concurrency systems are engineered.',
                'Structured with strict layered boundaries for maintainability and fault tolerance.'
            ],
            'type' => 'Task Management Platform',
            'stack' => 'Go, ReactJs, PostgreSQL, Redis, TypeScript',
            'status_text' => 'Active Build (2025–2026)',
            'technologies' => ['Layered Architecture', 'Cron Jobs', 'Redis Caching', 'Worker Queues', 'S3 Storage'],
            'repo' => 'https://github.com/thecharydev/Tasker',
            'type_color' => 'primary',
            'status_color' => 'secondary'
        ],
        [
            'id' => 'P-03',
            'name' => 'Cooking Next Big Thing',
            'status' => 'BREWING...',
            'badge' => 'LAB / WIP',
            'featured' => false,
            'highlights' => [
                'Exploration and experimentation with backend architectures in the lab.',
                'Researching and benchmarking ideas before committing to the next build.',
                'Currently ideating and prototyping — updates drop on GitHub once scoped.'
            ],
            'type' => 'Exploration & Prototyping',
            'stack' => 'Open Stack / Systems Engineering',
            'status_text' => 'In The Lab (Ideation)',
            'technologies' => ['Backend Exploration', 'System Architecture', 'Prototyping', 'Coffee ☕'],
            'repo' => 'https://github.com/thecharydev',
            'type_color' => 'primary',
            'status_color' => 'tertiary',
            'is_wip' => true
        ]
    ],
    
    'services' => [
        [
            'number' => '01',
            'name' => 'Go & PHP Backend Architecture',
            'description' => 'RESTful APIs, Echo & Laravel, layered architecture (handler, service, repository), and cron background jobs.'
        ],
        [
            'number' => '02',
            'name' => 'Full-Stack Web Applications',
            'description' => 'End-to-end applications with React, NextJS, TypeScript, and Turborepo monorepos built for speed and maintainability.'
        ],
        [
            'number' => '03',
            'name' => 'Database Design & Caching',
            'description' => 'Relational database schema modeling with PostgreSQL and MySQL, coupled with Redis for sub-millisecond caching.'
        ],
        [
            'number' => '04',
            'name' => 'SaaS Business Systems',
            'description' => 'Job card workflows, multi-tenant records, customer service histories, billing engines, and invoice generation.'
        ]
    ]
];
