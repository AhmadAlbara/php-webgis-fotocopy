<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: auth/login.php');
    exit;
}
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
$content = "pages/" . $page . ".php";

$title = ucfirst($page);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> - PrintZone</title>
    <link rel="shortcut icon" href="../assets/img/logo.ico" type="image/x-icon">

    <!-- Link Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Link Leaflet  -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>

    <!-- Link custom css & js  -->
    <link rel="stylesheet" href="../assets/css/global.css">
    <script src="../assets/js/global.js"></script>


    <!-- Link Icons -->
    <script src="https://kit.fontawesome.com/3d6dc94dfa.js" crossorigin="anonymous"></script>


    <!-- Link Sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="md:flex lg:m-auto lg:max-w-7xl lg:justify-center gap-4">

    <?php include 'layouts/sidebar.html'; ?>
    <main class="w-full p-8">
        <?php
        if (file_exists($content)) {
            include $content;
        } else {
            echo "<p>Pages Not Found.</p>";
        }
        ?>

        <?php include "layouts/footer.html"; ?>
    </main>
</body>

</html>