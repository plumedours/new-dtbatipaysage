<?php

define('ROOT_DIR', realpath(dirname(__DIR__)));

?>

<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">

<head>
    <?php require_once './part/head.php' ?>
    <title>DT Bâti-Paysage</title>
</head>

<body class="bg-slate-50 text-gray-900">
    <?php require_once './part/navbar.php' ?>
    <div class="flex flex-col w-full">
        <?php require_once './part/header.php' ?>
        <div id="prestations"></div>
        <?php require_once './part/prestations.php' ?>
        <div id="achievements"></div>
        <?php require_once './part/achievements.php' ?>
        <div id="about"></div>
        <?php require_once './part/about.php' ?>
        <?php require_once './part/partners.php' ?>
        <div id="contact"></div>
        <?php require_once './part/contact.php' ?>
    </div>
    <?php require_once './part/footer.php' ?>
    <!-- <script src="js/flowbite.js"></script>
    <script src="js/cocoen.js"></script>
    <script src="js/index.js"></script> -->
</body>

</html>