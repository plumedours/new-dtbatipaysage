<?php

define('ROOT_DIR', realpath(dirname(__DIR__)));

include_once ROOT_DIR . '/src/core/Session.php';
include_once ROOT_DIR . '/src/models/Category.php';
include_once ROOT_DIR . '/src/models/Photo.php';
include_once ROOT_DIR . '/src/forms/UploadPhoto.php';

$session = new Session();
$session->redirectIfNotAdmin();

$file = new UploadPhoto;
$photoBDD = new UploadPhoto;
$r = null;

if (isset($_POST['addPhoto'])) {
    if (!isset($_POST['category']) || $_FILES['photoUpload']['error'] != 0) {
        $r = 'Il faut une catégorie et une image valide !';
    } else {
        $f = $_FILES['photoUpload'];
        $file->set($f)->max_size(3)->get_extension();

        if ($file->upload()) {
            $r = true;
        } else {
            $r = $file->report();
        }
        $file->newPhoto($_POST, $f);
    }
}
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
        <h1 class="text-5xl text-center">Admin</h1>
        <h2 class="font-fold text-2xl mt-8 text-center">Ajouter une photo</h2>
        <div class="p-4 mt-6 flex justify-center">
            <form enctype="multipart/form-data" action="/admin-photo-new.php" method="post" class="flex flex-col gap-8 self-center w-full max-w-xl">
                <div>
                    <?php if (!is_null($r)) : ?>
                        <?php if ($r === true) : ?>
                            <p class="text-green-400 font-semibold">Le fichier à bien été envoyé !</p>
                        <?php else : ?>
                            <p class="text-red-500 font-semibold"><?= $r ?></p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="flex flex-col">
                    <span class="font-semibold">Photo :</span>
                    <input class="block w-full text-sm text-gray-900 bg-white rounded border border-gray-300 cursor-pointer" type="file" name="photoUpload" />
                </div>
                <div class="flex flex-col">
                    <span class="font-semibold">Catégorie :</span>
                    <select name="category" class="p-2 bg-white cursor-pointer rounded">
                        <option class="bg-white" value="" disabled selected>- CHOISIR UNE CATÉGORIE -</option>
                        <?php foreach ($categoryClass->getAllCategories() as $category) : ?>
                            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <input name="addPhoto" class="p-2 rounded bg-orange-300 hover:bg-orange-400 transition cursor-pointer" type="submit" value="Envoyer">
            </form>
        </div>
    </main>
</body>

</html>