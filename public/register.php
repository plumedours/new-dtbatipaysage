<?php

define('ROOT_DIR', realpath(dirname(__DIR__)));

include_once ROOT_DIR . '/src/forms/RegistrationForm.php';

if (isset($_POST['register'])) {
    $registrationFormClass->register($_POST);
}
?>
<!doctype html>
<html lang="en">

<head>
    <?php require_once './part/head.php' ?>
    <title>Inscription</title>
</head>

<body class="bg-slate-50 text-gray-900">
    <?php include_once 'part/navbarMin.php'; ?>
    <main class="max-w-5xl mx-auto p-4">
        <h1 class="text-5xl text-center">Inscription</h1>
        <div class="p-4 mt-6 flex justify-center">
            <form action="" method="post" class="flex flex-col gap-8 self-center w-96">
                <div>
                    <?php foreach ($registrationFormClass->errors as $error) : ?>
                        <p class="text-red-400"><?= $error ?></p>
                    <?php endforeach; ?>
                </div>

                <div class="flex flex-col">
                    <span>Nom :</span>
                    <input name="lastname" class="p-2" type="text" value="<?= $_POST['lastname'] ?? null ?>">
                </div>
                <div class="flex flex-col">
                    <span>Prénom :</span>
                    <input name="firstname" class="p-2" type="text" value="<?= $_POST['firstname'] ?? null ?>">
                </div>
                <div class="flex flex-col">
                    <span>Email :</span>
                    <input name="email" class="p-2" type="email" value="<?= $_POST['email'] ?? null ?>">
                </div>
                <div class="flex flex-col">
                    <span>Mot de passe :</span>
                    <input name="password" class="p-2" type="password">
                </div>
                <div class="flex flex-col">
                    <span>Retapez le mot de passe :</span>
                    <input name="password_retype" class="p-2" type="password">
                </div>
                <input name="register" class="bg-white p-2 rounded bg-orange-300 hover:bg-orange-400 transition font-semibold cursor-pointer" type="submit" value="VALIDER">
            </form>
        </div>
    </main>
    <script src="js/flowbite.js"></script>
</body>

</html>