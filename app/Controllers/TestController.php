<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class TestController extends Controller
{
    public function index()
    {
        try {
            $db = \Config\Database::connect();
            
            if ($db->connect(false)) {
                echo "Database connection successful!<br>";
                echo "Connected to database: " . $db->database . "<br>";
                echo "Server is running on: " . $_SERVER['HTTP_HOST'] ?? 'localhost' . "<br>";
                echo "Current time: " . date('Y-m-d H:i:s') . "<br>";
            } else {
                echo "Database connection failed!<br>";
                echo "Error: " . $db->error()['message'] ?? 'Unknown error' . "<br>";
            }
        } catch (\Exception $e) {
            echo "Exception occurred: " . $e->getMessage() . "<br>";
        }
    }
}
