<?php

define('ROOT_DIR', realpath(dirname(__DIR__)));

include_once ROOT_DIR . '/src/core/Session.php';

$session = new Session();
$session->redirectIfNotAdmin();
?>

<!doctype html>
<html lang="fr">

<head>
    <?php require_once './part/head.php' ?>
    <title>Ajouter une photo</title>
</head>

<body class="bg-slate-50 text-gray-900">
<?php include_once 'part/navbarMin.php'; ?>
<main class="max-w-5xl mx-auto p-4">
    <h1 class="text-5xl text-center">Dashboard</h1>

</main>
</body>

</html>
