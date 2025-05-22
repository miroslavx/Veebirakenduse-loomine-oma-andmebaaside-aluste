<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once('conf3.php');
require_once('abifunktsioonid.php');

$pageTitle = isset($pageTitle) ? $pageTitle : "Pizzeria";
?>
    <!DOCTYPE html>
    <html lang="et">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo htmlspecialchars($pageTitle); ?></title>
        <link rel="stylesheet" href="style.css">
    </head>
<body>
<div id="site-wrapper">
    <header class="site-header">
        <h1><a href="index.php">Minu Pizzeria</a></h1>
    </header>
    <nav class="main-nav">
        <ul>
            <li><a href="pizzas_list.php">Pitsad</a></li>
            <?php if (on_sisse_logitud()): ?>
                <?php if (on_admin()): ?>

                <?php endif; ?>
                <li><a href="logout.php">Logi välja</a></li>
            <?php else: ?>
                <li><a href="login.php">Logi sisse</a></li>
                <li><a href="register.php">Registreeri</a></li>
            <?php endif; ?>
        </ul>
    </nav>
<?php if (on_sisse_logitud()): ?>
    <div class="user-info-bar">Sisse logitud kui: <?php echo htmlspecialchars($_SESSION['kasutajanimi']); ?> (<?php echo htmlspecialchars($_SESSION['roll']); ?>)</div>
<?php endif; ?>

    <main class="content-area">
        <div class="container-inner">
<?php
if (isset($_SESSION['success_message'])) {
    echo '<div class="success-message">' . htmlspecialchars($_SESSION['success_message']) . '</div>';
    unset($_SESSION['success_message']);
}
if (isset($_SESSION['error_message'])) {
    echo '<div class="error-message">' . htmlspecialchars($_SESSION['error_message']) . '</div>';
    unset($_SESSION['error_message']);
}
?>