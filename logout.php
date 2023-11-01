<?php
session_start();

if (isset($_SESSION['email'])) {
    // Unset all session variables.
    session_unset();
    // Destroy the session.
    session_destroy();
}

header("Location: ./index.php");
?>