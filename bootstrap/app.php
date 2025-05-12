<?php

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

use mindplay\vite\Manifest;

const BUILD_PATH = __DIR__ . "/../public/build/";
const ENTRY_POINT = "resources/js/app.js";

/**
 * VITE BACKEND INTEGRATION
 * 
 * Create tags based on mode, parses manifest or includes Vite development server
 * 
 * $manifest_path: Points to the Vite manifest.json file created for the production build.
 * $base_path: is relative to your public web root - it is the root folder from which Vite's production 
 * assets are served, and/or the root folder from which Vite serves assets dynamically in development mode.
 */
function getVite($manifest_path, $base_path, $dev) {
    
    $manifest = new Manifest(
        manifest_path: $manifest_path,
        base_path: $base_path,
        dev: $dev
    );

    return $manifest->createTags(ENTRY_POINT);
}
/**
 * Vite Development Server is running if headers return 200 from Vite Server URI
 * Otherwise and if exists, we will use build directory
 * Else, we will insert empty strings and show a warning message in the console.
 */
if(substr(get_headers(getenv('VITE_SERVER_URI') . '/@vite/client')[0], 9, 3) == 200) {
    $vite = getVite('', getenv('VITE_SERVER_URI') . "/", true);

} else if(is_dir(BUILD_PATH)) {
    $vite = getVite( BUILD_PATH . '/manifest.json', "build/", false);   
}
else {
    $vite = (object) [
        "css" => "", 
        "js" => "<script>console.warn('PHP-VITE-INTEGRATION: No build  directory found. Run Vite to build assets or serve development resources.')</script>"
    ];
}

/* //  Add Twig Environment and define cache path
//  Create Twig loader and environment
$loader = new FilesystemLoader( __DIR__ . '/../pages/');
$twig = new Environment($loader);

// Load Twig Template for Home page
echo $twig->render('home.twig.php'); */


include_once __DIR__. "/../pages/home.php";