<?php
session_start();

if (isset($_SESSION['email'])) {
    // User is logged in, display the logout button.
    echo "Welcome, " . $_SESSION['username'] . "!<br>";
    echo "<a href='logout.php'>Logout</a>";
} else {
    // User is not logged in, display registration and login forms.
    include('forms.php');
}
?>