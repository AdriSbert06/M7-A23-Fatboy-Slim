<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

$app->get('/', function (Request $request, Response $response) {
    // Conectar a la base de datos
    $db = new SQLite3('../public/db/musics.db');

    // Consultar los datos de la base de datos
    $result = $db->query("SELECT * FROM musics");
    
    // Crear el contenido HTML
    $html = "
    <!DOCTYPE html>
    <html lang='ca'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Biografies de Músics</title>
        <style>
            body { font-family: sans-serif; padding: 2rem; background: #eee; }
            .card { background: white; padding: 1rem; margin-bottom: 1rem; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
            img { max-width: 200px; height: auto; }
        </style>
    </head>
    <body>
        <h1>Biografies de Músics</h1>";

    // Procesar cada músico en los resultados
    while ($m = $result->fetchArray(SQLITE3_ASSOC)) {
        $birth = new DateTime($m['birth_date']);
        $death = $m['death_date'] ? new DateTime($m['death_date']) : new DateTime();
        $age = $birth->diff($death)->y;

        $html .= "
        <div class='card'>
            <h2>{$m['name']}</h2>
            <img src='{$m['image_url']}' alt='{$m['name']}'><br>
            <strong>Naixement:</strong> {$m['birth_date']}<br>";
        if ($m['death_date']) {
            $html .= "<strong>Mort:</strong> {$m['death_date']}<br>";
        }
        $html .= "
            <strong>Edat:</strong> $age anys<br>
            <strong>Gènere musical:</strong> {$m['genre']}<br>
            <strong>Cançó més famosa:</strong> {$m['hit_song']}
        </div>";
    }

    $html .= "</body></html>";

    $response->getBody()->write($html);
    return $response->withHeader('Content-Type', 'text/html');
});

$app->run();
