<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

$app->get('/', function (Request $request, Response $response) {
    $db = new SQLite3('../public/db/musics.db');
    $result = $db->query("SELECT * FROM musics");

    $html = "
    <!DOCTYPE html>
    <html lang='ca'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Biografies de Músics</title>
        <script src='https://cdn.tailwindcss.com'></script>
    </head>
    <body class='bg-blue-50 font-sans p-8'>
        <h1 class='text-4xl font-bold text-center text-blue-800 mb-10'>Biografies de Músics</h1>
        <div class='grid grid-cols-1 gap-8'>";
    
    while ($m = $result->fetchArray(SQLITE3_ASSOC)) {
        $birth = new DateTime($m['birth_date']);
        $death = $m['death_date'] ? new DateTime($m['death_date']) : new DateTime();
        $age = $birth->diff($death)->y;

        $name = htmlspecialchars($m['name'], ENT_QUOTES);
        $birth_date = htmlspecialchars($m['birth_date'], ENT_QUOTES);
        $death_date = htmlspecialchars($m['death_date'], ENT_QUOTES);
        $genre = htmlspecialchars($m['genre'], ENT_QUOTES);
        $image_url = htmlspecialchars($m['image_url'], ENT_QUOTES);
        $hit_song = htmlspecialchars($m['hit_song'], ENT_QUOTES);

        $html .= "
        <div class='bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform transform hover:scale-105'>
            <h2 class='text-2xl font-semibold text-blue-900 mb-4'>{$name}</h2>
            <img class='mb-4 rounded shadow-md' src='{$image_url}' alt='{$name}' onerror=\"this.src='default.jpg'\" style='max-height: 200px;'>
            <p class='text-gray-700'><strong>Naixement:</strong> {$birth_date}</p>";
        if ($m['death_date']) {
            $html .= "<p class='text-gray-700'><strong>Mort:</strong> {$death_date}</p>";
        }
        $html .= "
            <p class='text-gray-700'><strong>Edat:</strong> {$age} anys</p>
            <p class='text-gray-700'><strong>Gènere musical:</strong> {$genre}</p>
            <p class='text-gray-700'><strong>Cançó més famosa:</strong> {$hit_song}</p>
        </div>";
    }

    $html .= "</div></body></html>";

    $response->getBody()->write($html);
    return $response->withHeader('Content-Type', 'text/html');
});

$app->run();
