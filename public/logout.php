<?php
define('ROOT_DIR', realpath(dirname(__DIR__)));

include_once ROOT_DIR . '/src/core/Session.php';

$session = new Session();

$session->clear();