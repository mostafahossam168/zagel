<?php
$map = ['create', 'read', 'update', 'delete'];

return [
    'models' => [
        'roles'      => $map,
        'admins'     => $map,
        'contacts'   => ['read', 'delete'],
        'categories' => $map,
        'partners'   => $map,
        'users'      => $map,
        'faqs'       => $map,
        'pages'      => ['read', 'update'],
        // 'students' => $map,
        // 'teachers' => $map,
        // 'categories' => $map,
        // 'courses' => $map,
        // 'lessons' => $map,
        // 'coupones' => $map,
        // 'quizes' => $map,
        // 'questions' => $map,
        // 'settings' => ['read', 'update'],
        // 'enrollments' => ['read', 'update'],
        // 'reviews' => ['read', 'update'],
        // 'actives' => ['read', 'delete'],
        // 'contacts' => ['read', 'delete'],
        'services'             => $map,
        'testimonials'         => $map,
        'project_submissions'  => ['read', 'update', 'delete'],
        'notifications'        => ['create', 'read', 'delete'],
        'provider_listings'    => ['read', 'update', 'delete'],
        'statistics_home' => ['read'],
    ],
];
