<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('ROOT_DIR', realpath(dirname(__DIR__)));

include_once  ROOT_DIR . '/src/core/Database.php';
include_once ROOT_DIR . '/src/core/Session.php';
include_once ROOT_DIR . '/src/models/Photo.php';


$session = new Session();
$session->redirectIfNotAdmin();

if (isset($_GET['del'])) {
    $photoId =  (int)$_GET['del'];
    $id = $photos->getOnePhoto($photoId);
    $photo = ROOT_DIR . '/public/img/gallery/' . $id['name'];
    var_dump(file_exists($photo));

    if (file_exists($photo)) {
        $photos->deletePhoto($photoId);
        unlink($photo);
    }

    header('Location: /gallery.php');
    exit;
}
