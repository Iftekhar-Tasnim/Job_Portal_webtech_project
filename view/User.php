<?php
class User {
    private $conn;
    private $table_name = "users";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function authenticate($email, $password, $userType) {
        // Demo credentials (replace with database query in production)
        $demo_credentials = [
            'applicant' => [
                'email' => 'demo@applicant.com',
                'password' => 'demo123',
                'name' => 'Demo Applicant'
            ],
            'employer' => [
                'email' => 'demo@employer.com',
                'password' => 'demo123',
                'name' => 'Demo Employer'
            ]
        ];

        if (isset($demo_credentials[$userType])) {
            $demo = $demo_credentials[$userType];
            if ($email === $demo['email'] && $password === $demo['password']) {
                return [
                    'id' => 1,
                    'name' => $demo['name'],
                    'type' => $userType
                ];
            }
        }
        return false;
    }

    public function register($data) {
        // TODO: Implement user registration with database
        return true;
    }

    public function getUserById($id) {
        // TODO: Implement get user by ID from database
        return null;
    }

    public function updateProfile($id, $data) {
        // TODO: Implement profile update
        return true;
    }
} 