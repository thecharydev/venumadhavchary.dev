<?php
/**
 * Projects data - Sourced from Resume
 */

return [
    'intro' => 'Real-world full-stack systems built and shipped. Layered architectures, reliable databases, and automated workflows.',
    
    'projects' => [
        [
            'id' => 'P-01',
            'name' => 'Tasker',
            'status' => 'ACTIVE BUILD',
            'badge' => 'FEATURED',
            'featured' => true,
            'description' => 'Full-stack task management application with a Go backend and React/TypeScript frontend inside a Turborepo monorepo. Designed with a strict layered architecture (handler, service, repository), background job processing, cron-based workflow scheduling, Redis caching, and S3-compatible object storage for file handling.',
            'type' => 'Full-Stack Monorepo',
            'stack' => 'Go, ReactJs, PostgreSQL, Redis, TypeScript',
            'status_text' => 'Active Project (2026)',
            'technologies' => ['Go', 'ReactJs', 'TypeScript', 'PostgreSQL', 'Redis', 'Turborepo', 'Cron Jobs', 'S3'],
            'repo' => 'https://github.com/thecharydev/Tasker',
            'type_color' => 'primary',
            'status_color' => 'secondary'
        ],
        [
            'id' => 'P-02',
            'name' => 'GarageMitra',
            'status' => 'ACTIVE BUILD',
            'badge' => 'FLAGSHIP',
            'featured' => true,
            'description' => 'Garage management system for auto repair shops and mechanics. Features complete job card management to track vehicle service requests, vehicle registration with customer history associations, and a full billing system with dynamic invoice generation and editing capabilities.',
            'type' => 'Management SaaS',
            'stack' => 'Laravel PHP, MySQL, NextJS',
            'status_text' => 'In Development (2026)',
            'technologies' => ['Laravel', 'PHP', 'MySQL', 'NextJS', 'Job Cards', 'Billing', 'Invoicing'],
            'repo' => 'https://github.com/thecharydev/garagemitra',
            'type_color' => 'tertiary',
            'status_color' => 'secondary'
        ],
        [
            'id' => 'P-03',
            'name' => 'Cooking Next Big Thing',
            'status' => 'BREWING...',
            'badge' => 'LAB / WIP',
            'featured' => false,
            'description' => 'Converting coffee into high-concurrency code ☕. Currently architecting a distributed event-streaming service in Go with Redis Pub/Sub, WebSockets, and zero-downtime worker queues.',
            'type' => 'Distributed Microservice',
            'stack' => 'Go, Redis Streams, WebSockets, Docker',
            'status_text' => 'Caffeine → Code (In Lab)',
            'technologies' => ['Go', 'Redis Streams', 'WebSockets', 'Docker', 'Event-Driven', 'Coffee ☕'],
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
