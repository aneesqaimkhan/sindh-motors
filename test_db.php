<?php

// Simple database test script
require_once __DIR__ . '/vendor/autoload.php';

try {
    $db = \Config\Database::connect();
    $db->connect();
    echo "Database connection successful!\n";
    
    // Check users table structure
    $result = $db->query("DESCRIBE users");
    $fields = $result->getResultArray();
    
    echo "\nUsers table structure:\n";
    foreach ($fields as $field) {
        echo "Field: {$field['Field']}, Type: {$field['Type']}, Null: {$field['Null']}, Key: {$field['Key']}, Default: {$field['Default']}\n";
    }
    
    // Check if admin user exists
    $adminUser = $db->table('users')->where('username', 'superadmin')->first();
    if ($adminUser) {
        echo "\nAdmin user found:\n";
        echo "Username: {$adminUser['username']}, Status: {$adminUser['status']}, Is Admin: {$adminUser['is_admin']}\n";
    } else {
        echo "\nAdmin user not found!\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
