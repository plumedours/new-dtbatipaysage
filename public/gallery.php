<?php

define('ROOT_DIR', realpath(dirname(__DIR__)));

include_once ROOT_DIR . '/src/core/Session.php';
include_once ROOT_DIR . '/src/models/Category.php';
include_once ROOT_DIR . '/src/models/Photo.php';
include_once ROOT_DIR . '/src/services/ActiveLink.php';

$session = new Session();
$isAdmin = $session->checkAdmin();

$getCategory = $_GET['cat'] ?? null;

if ($getCategory) {
    $gallery = $photos->getAllPhotosFromCategory($getCategory);
} else {
    $gallery = $photos->getAllPhotos();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require_once './part/head.php' ?>
    <title>DT Bâti-Paysage - Galerie</title>
</head>

<body class="bg-slate-50 text-gray-900">
    <?php require_once './part/navbarMin.php' ?>

    <div class="flex justify-center">
        <div class="flex flex-row flex-wrap text-xs md:text-sm w-auto lg:text-base rounded mt-1 justify-center bg-gray-800">
            <li class="md:mx-2 underline font-semibold <?= $activeLink->isAll() ?>"><a href="/gallery.php">Toutes</a></li>
            <?php foreach ($categoryClass->getAllCategories() as $category) : ?>
                <li class="md:mx-2 underline font-semibold <?= $activeLink->setActive($category['slug']) ?>"><a href="/gallery.php?cat=<?= $category['slug'] ?>"><?= $category['name'] ?></a></li>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="columns-2 gap-0.5 px-2 md:columns-3 lg:columns-4 max-w-5xl mx-auto py-5">
        <?php foreach ($gallery as $photo) : ?>
            <div class="flex flex-col p-2">
                <a class="spotlight" href="<?= './img/gallery/' . $photo['name'] ?>"><img class="w-auto hover:scale-105 transition duration-300 ease-in-out cursor-pointer shadow-lg shadow-gray-800" src="<?= './img/gallery/' . $photo['name'] ?>"></a>
                <?php if ($isAdmin === true) : ?>
                    <a class="flex self-center" href="/deletePhoto.php?del=<?= $photo['id'] ?>"><i class="fa-solid fa-xmark pt-2 font-bold text-red-600"></i></a>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <?php require_once './part/footer.php' ?>
    <script src="js/spotlight.bundle.js" defer></script>
    <script src="js/flowbite.js"></script>
</body>

</html>