<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Check if the expected POST fields are set
    if (isset($_POST['email']) && isset($_POST['password'])) {

        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        if ($email === "" || $password === "") {
            echo "null email/password!";
        } else if ($email === $password) {  // Just an example check
            $_SESSION['status'] = true;
            header('Location: ../view/home.php');
            exit();
        } else {
            echo "invalid user!";
        }

    } else {
        echo "Missing email or password!";
    }

} else {
    echo "Invalid request! Please submit the form!";
}
?>