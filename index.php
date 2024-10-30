<?php
session_start();


if (isset($_SESSION['username'])) {
    header('Location: views/index.php?page=dashboard');
    exit();
} else {
    header('Location: views/auth/login.php');
    exit();
}

