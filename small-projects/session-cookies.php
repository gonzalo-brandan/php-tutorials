<?php
if($_SERVER['REQUEST_URI'] === '/favicon.ico'){ //avoid double request to the server looking for favicon
    exit;
}
session_start();

// If the request method is POST, set a cookie named 'user' with the value from the 'name' field for 1 hour.
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    setcookie('user', $_POST['name'], time() + 3600, '/'); //
}

$hasCookie = isset($_COOKIE['user']);
if(!$hasCookie){
    $welcomeMessage = "Welcome back, user!";
} else {
    $welcomeMessage = "Welcome back, " . htmlspecialchars($_COOKIE['user']);
}

if(!isset($_SESSION['visits'])){
    $_SESSION['visits'] = 1;
} else {
    $_SESSION['visits']++;
}

$visitsMessage = "This is your " . $_SESSION['visits'] . " visit";
?>

<html>
    <body>
        <?php if (!$hasCookie): ?>
            <form method = "POST">
                <label>Your name: </label>
                <input  type="text" name="name" />
                <button>Track</button>
            </form>
        <?php endif;?>
        <p><?=$welcomeMessage?></p>
        <p><?=$visitsMessage?></p>
    </body>
</html>

