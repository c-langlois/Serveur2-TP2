<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use slim\Middleware\MethodoverrideMiddleware; // needs to be enabled in the case of delete 
use DI\Container;
use slim\Factory\AppFactory;

require_once __DIR__ . '/vendor/autoload.php';

// Configuration file
// require_once __DIR__ .'/includes/config.php';

// Model file require once
/* require_once __DIR__ . '/core/post.php'; */

// Create a new container
$container = new Container();

// Create a new slim application instance with the container
$app = AppFactory::create(null,$container);

// Activation de la surcharge de méthode (dans le cas de DELETE)
$app->addRoutingMiddleware();
$app->add(MethodOverrideMiddleware::class);

// Ajout du middleware de parsing du corps des requêtes 
$app->addBodyParsingMiddleware();

$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {

    $name = $args['name'];

    $response->getBody()->write("Hello, $name");


    return $response;

});

// Définition d'une route pour récupérer les articles
$app->get ('/api/posts', function (Request $request, Response $response, array $args) use ($db) {
    // Instantiate the Post model and pass the database connection
    $post = new Post ($db);
    // Récupération des articles depuis la base de données 
    $result = $post->read() ;
    // Vérification si des articles ont été trouvés 
    if ($result->rowcount () > 0) {
        $posts = $result ->fetchAll(PDO::FETCH_ASSOC);
    // Retour des articles en tant que réponse JSON 
        $response->getBody()->write(json_encode($posts));
        return $response->withHeader ('Content-Type','application/json')->withstatus (200);
    }
    else {
    // Aucun article trouvé
        $response->getBody () ->write(json_encode (['message' => 'No posts found. ']));
        return $response->withHeader ('Content-Type','application/son')->withstatus (404);
    }
});


//Run the slim app 
$app-> run();