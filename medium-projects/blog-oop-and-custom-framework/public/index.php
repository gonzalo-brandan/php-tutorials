<?php
declare (strict_types = 1);

require_once __DIR__ . '/../vendor/autoload.php';

use Core\Router;

$router = new Router();
require_once __DIR__ . '/../routes.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_SERVER['REQUEST_METHOD'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
</head>
<body>
    <?php echo $router->dispatch($uri, $method); ?>
</body>
</html>
