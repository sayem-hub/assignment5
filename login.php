<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $serialziedData = file_get_contents('./data/users.txt');
    $users = unserialize($serialziedData);

    foreach ($users as $user) {
        if ($user['email'] === $email && password_verify($password, $user['password'])) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            switch ($user['role']) {
                case 'admin':
                    header("Location: ./rolePages/admin.php");
                    break;
                case 'manager':
                    header("Location: manager.php");
                    break;
                case 'user':
                    header("Location: ./rolePages/user.php");
                    break;
                default:
                    header("Location: ./rolePages/index.php");
                    break;
            }
        }
    }

    echo "Login failed. <a href='index.php'>Go back to login</a>";
}
?>