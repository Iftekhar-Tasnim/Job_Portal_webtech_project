<?php
class Job {
    private $conn;
    private $table_name = "jobs";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        // Sample job data (replace with database query in production)
        return [
            [
                'id' => 1,
                'title' => "Software Developer",
                'company' => "Tech Solutions",
                'location' => "Dhaka",
                'category' => "it",
                'experience' => "mid",
                'description' => "We are looking for a talented software developer to join our team.",
                'requirements' => [
                    "3+ years of experience in software development",
                    "Proficient in Java and JavaScript",
                    "Experience with web technologies",
                    "Strong problem-solving skills"
                ]
            ],
            [
                'id' => 2,
                'title' => "Marketing Manager",
                'company' => "Marketing Pro",
                'location' => "Chittagong",
                'category' => "marketing",
                'experience' => "senior",
                'description' => "We need an experienced marketing manager to lead our marketing team.",
                'requirements' => [
                    "5+ years of marketing experience",
                    "Team management experience",
                    "Strong communication skills",
                    "Digital marketing expertise"
                ]
            ]
        ];
    }

    public function getById($id) {
        $jobs = $this->getAll();
        foreach ($jobs as $job) {
            if ($job['id'] == $id) {
                return $job;
            }
        }
        return null;
    }

    public function filter($filters) {
        $jobs = $this->getAll();
        $filtered = [];

        foreach ($jobs as $job) {
            $match = true;
            if (!empty($filters['location']) && $job['location'] !== $filters['location']) {
                $match = false;
            }
            if (!empty($filters['category']) && $job['category'] !== $filters['category']) {
                $match = false;
            }
            if (!empty($filters['experience']) && $job['experience'] !== $filters['experience']) {
                $match = false;
            }
            if ($match) {
                $filtered[] = $job;
            }
        }

        return $filtered;
    }
} 