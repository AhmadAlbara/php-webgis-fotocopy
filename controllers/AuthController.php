<?php
session_start();
include './config/Database.php';

class AuthController
{
    public function updateUser()
    {
        global $conn;

        $username = $_SESSION['username'];
        $new_username = mysqli_real_escape_string($conn, $_POST['new_username'] ?? '');
        $old_password = mysqli_real_escape_string($conn, $_POST['old_password'] ?? '');
        $new_password = mysqli_real_escape_string($conn, $_POST['new_password'] ?? '');


        $query = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            $updates = [];


            if (!empty($old_password)) {
                if (!password_verify($old_password, $user['password'])) {
                    $_SESSION['error'] = "Current password is incorrect!";
                    header('Location: ../views/index.php?page=profile');
                    exit();
                }
            }


            if (!empty($new_username) && $username !== $new_username) {
                $checkQuery = "SELECT * FROM users WHERE username='$new_username'";
                $checkResult = mysqli_query($conn, $checkQuery);

                if (mysqli_num_rows($checkResult) > 0) {
                    $_SESSION['error'] = "Username already taken!";
                    header('Location: ../views/index.php?page=profile');
                    exit();
                }

                $updates[] = "username='$new_username'";
            }

            if (!empty($new_password)) {
                $password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
                $updates[] = "password='$password_hashed'";
            }


            if (!empty($updates)) {
                $updateQuery = "UPDATE users SET " . implode(', ', $updates) . " WHERE username='$username'";
                if (mysqli_query($conn, $updateQuery)) {
                    $_SESSION['success'] = "Profile updated successfully!";


                    if (!empty($new_username) && $username !== $new_username) {
                        $_SESSION['username'] = $new_username;
                    }

                    header('Location: ../views/index.php?page=profile');
                    exit();
                } else {
                    $_SESSION['error'] = "Failed to update profile: " . mysqli_error($conn);
                    header('Location: ../views/index.php?page=profile');
                    exit();
                }
            } else {
                $_SESSION['error'] = "No changes made!";
                header('Location: ../views/index.php?page=profile');
                exit();
            }
        } else {
            $_SESSION['error'] = "User not found!";
            header('Location: ../views/index.php?page=profile');
            exit();
        }
    }

    public function login($username, $password)
    {
        global $conn;


        $username = mysqli_real_escape_string($conn, $username);

        $query = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);


            if (password_verify($password, $user['password'])) {

                $_SESSION['username'] = $username;
                header('Location: ../views/index.php?page=dashboard');
                exit();
            } else {

                $_SESSION['error'] = "Incorrect username or password!";
                header('Location: ../views/auth/login.php');
                exit();
            }
        } else {
            $_SESSION['error'] = "Incorrect username or password!";
            header('Location: ../views/auth/login.php');
            exit();
        }
    }

    public function register($username, $password, $confirm_password)
    {
        global $conn;


        if ($password !== $confirm_password) {
            $_SESSION['error'] = "Password and confirm password not match !";
            header('Location: ../views/auth/register.php');
            exit();
        }


        $query = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['error'] = "Username has already been registered";
            header('Location: ../views/auth/register.php');
            exit();
        }


        $password_hashed = password_hash($password, PASSWORD_DEFAULT);


        $query = "INSERT INTO users (username, password) VALUES ('$username', '$password_hashed')";
        if (mysqli_query($conn, $query)) {
            echo "Registrasi berhasil!";
            header('Location: ../views/auth/login.php');
            exit();
        } else {
            echo "Gagal registrasi: " . mysqli_error($conn);
            exit();
        }
    }
    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: ../views/auth/login.php');
        exit();
    }
}
