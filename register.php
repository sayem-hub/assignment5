<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = file_get_contents('users.json');
    $users = json_decode($data, true);

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    $user = [
        'username' => $username,
        'email' => $email,
        'password' => $password,
        'role' => $role,
    ];

    $users[] = $user;

    $serializedData = serialize($users);

    file_put_contents('./data/users.txt', $serializedData, FILE_APPEND);

    header("Location: index.php");
}
?>