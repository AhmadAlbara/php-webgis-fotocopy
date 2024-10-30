<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: ../index.php?page=dashboard');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="../../assets/img/logo.ico" type="image/x-icon">
    <script src="../../assets/js/global.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Login - PrintZone </title>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <form action="../../routes.php?action=login" method="POST" class="bg-white p-6 rounded shadow-md w-80">
        <div class="mb-4">
            <a class="text-xl font-bold mb-4 flex items-center justify-center text-primary" href="">
                <img src="../../assets/img/logo.png" alt="logo" width="50px">
                <i>PrintZone</i>
            </a>
            <p class="text-sm text-gray-400 text-center">Enter Your Credential To Access Your Account</p>
        </div>


        <hr>

        <div class="mt-4">
            <input type="text" name="username" placeholder="Username" class="w-full p-2 border rounded mb-4" required>
            <input type="password" name="password" placeholder="Password" class="w-full p-2 border rounded mb-4" required>
            <button type="submit" class="w-full bg-primary text-white p-2 rounded">Login</button>
            <p class="text-center mt-4">Don't Have an Account ? <a href="register.php" class="text-primary">Register</a></p>
        </div>

    </form>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        <?php if (isset($_SESSION['error'])): ?>
            Toast.fire({
                icon: "error",
                title: "<?= $_SESSION['error']; ?>"
            });
            <?php unset($_SESSION['error']); // Clear error session here after displaying 
            ?>
        <?php endif; ?>
    </script>
</body>

</html>