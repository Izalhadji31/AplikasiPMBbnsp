#!/usr/bin/env php
<?php

// Quick script to create test users
require __DIR__ . '/vendor/autoload.php';

use App\Models\User;
use Illuminate\Database\Capsule\Manager as DB;

// Setup Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Create Admin User
try {
    $admin = User::where('email', 'admin@test.com')->first();
    if (!$admin) {
        User::create([
            'name' => 'Admin BNSP',
            'email' => 'admin@test.com',
            'password' => bcrypt('password123'),
            'role' => 'admin'
        ]);
        echo "[SUCCESS] Admin user created\n";
    } else {
        echo "[INFO] Admin user already exists\n";
    }
} catch (\Exception $e) {
    echo "[ERROR] " . $e->getMessage() . "\n";
}

// Create Student User
try {
    $student = User::where('email', 'student@test.com')->first();
    if (!$student) {
        User::create([
            'name' => 'John Doe',
            'email' => 'student@test.com',
            'password' => bcrypt('password123'),
            'role' => 'student'
        ]);
        echo "[SUCCESS] Student user created\n";
    } else {
        echo "[INFO] Student user already exists\n";
    }
} catch (\Exception $e) {
    echo "[ERROR] " . $e->getMessage() . "\n";
}

echo "\n=== User Credentials ===\n";
echo "Admin:\n";
echo "  Email: admin@test.com\n";
echo "  Password: password123\n\n";
echo "Student:\n";
echo "  Email: student@test.com\n";
echo "  Password: password123\n";
