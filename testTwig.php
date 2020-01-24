<?php

require __DIR__ . '/vendor/autoload.php';

// Routing
$page = 'home';

if (isset($_GET['p'])) {
    $page = $_GET['p'];
}

// Rendu du template
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templatesTest');
$twig = new \Twig\Environment($loader, [
    'cache' => false // __DIR__ . '/tmpTest'
]);

switch ($page) {
    case 'contact':
        echo $twig->render('contact.twig');
        break;
    case 'home':
        echo $twig->render('home.twig');
        break;
    default:
        header('HTPP/1.0 404 Not Found');
        echo $twig->render('404.twig');
        break;
}

//if( $page === 'home') {
//    echo $twig->render('home.twig', ['person' => [
//        'name' => 'Marc', 
//        'age' => 26
//    ]]);
//}
