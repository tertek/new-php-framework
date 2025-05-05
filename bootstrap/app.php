<?php

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

use mindplay\vite\Manifest;

const BUILD_PATH = __DIR__ . "/../build";

$dev = getenv('APP_ENV') !== 'production';

if($dev === true) {
    $base_path = getenv('VITE_SERVER_URI') . "/";
    $manifest_path = '';

} else {
    $base_path = BUILD_PATH;
    $manifest_path = BUILD_PATH . '/.vite/manifest.json';
}

$vite = new Manifest(
    manifest_path: $manifest_path,
    base_path: $base_path,
    dev: $dev
);

$tags = $vite->createTags(__DIR__ . "/../resources/js/app.js");

/* //  Add Twig Environment and define cache path
//  Create Twig loader and environment
$loader = new FilesystemLoader( __DIR__ . '/../pages/');
$twig = new Environment($loader);

// Load Twig Template for Home page
echo $twig->render('home.twig.php'); */


include_once __DIR__. "/../pages/home.php";