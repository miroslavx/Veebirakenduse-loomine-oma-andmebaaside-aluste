<?php
// header.php
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
    <style>
        /* Глобальный сброс и базовые стили */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif; /* Более современный шрифт для WP стиля */
            background-color: #E0E0E0; /* Светло-серый фон Bauhaus */
            color: #000000;
            line-height: 1.5;
        }

        /* Общий контейнер для всего контента */
        #site-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Минимальная высота всего экрана */
        }

        header.site-header {
            background-color: #000000;
            color: white;
            padding: 20px 30px;
            text-align: left;
        }
        header.site-header h1 a {
            color: white;
            text-decoration: none;
            font-weight: 600; /* Slightly less bold */
            font-size: 2em;
            letter-spacing: 1px;
        }

        nav.main-nav {
            background-color: #F0F0F0; /* Очень светлый фон для навигации */
            border-bottom: 4px solid #000000;
        }
        nav.main-nav ul {
            list-style-type: none;
            display: flex;
            justify-content: flex-start; /* Плитки начинаются слева */
            height: 70px; /* Фиксированная высота для плиток навигации */
        }
        nav.main-nav ul li {
            border-right: 4px solid #000000;
        }
        nav.main-nav ul li:last-child {
            border-right: none; /* Убираем у последней */
        }
        nav.main-nav ul li a {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            padding: 0 30px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1em;
            color: #FFFFFF; /* Текст по умолчанию белый */
            transition: opacity 0.2s ease-in-out;
        }
        nav.main-nav ul li a:hover {
            opacity: 0.85;
        }

        /* Цвета плиток навигации (Bauhaus) */
        nav.main-nav ul li a[href="pizzas_list.php"],
        nav.main-nav ul li a[href="index.php"]       { background-color: #D90429; } /* Красный */
        nav.main-nav ul li a[href="login.php"]       { background-color: #0053A0; } /* Синий */
        nav.main-nav ul li a[href="register.php"]    { background-color: #FFC300; color: #000000; } /* Желтый, черный текст */
        nav.main-nav ul li a[href="logout.php"]      { background-color: #333333; } /* Темно-серый */

        .user-info-bar {
            background-color: #333333;
            color: #FFFFFF;
            padding: 8px 30px;
            text-align: right;
            font-size: 0.9em;
            border-bottom: 4px solid #000000;
        }

        main.content-area {
            flex-grow: 1; /* Занимает оставшееся пространство */
            padding: 0; /* Внутренний контейнер будет иметь отступы */
            background-color: #FFFFFF; /* Белый фон для основного контента */
        }

        .container-inner {
            max-width: 1000px; /* Ограничитель ширины для самого контента */
            margin: 0 auto;
            padding: 0; /* Блоки внутри будут иметь свои отступы */
        }

        /* Стили для блоков внутри .container-inner */
        .content-block {
            padding: 30px;
            border-bottom: 4px solid #000000;
        }
        .content-block:last-child {
            border-bottom: none; /* Нет нижней границы у последнего блока */
        }
        .content-block h2 {
            font-size: 1.7em;
            color: #000000;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #000000; /* Линия под заголовком блока */
            font-weight: 600;
        }

        /* Сообщения как отдельные блоки */
        .success-message, .error-message {
            padding: 20px 30px;
            text-align: center;
            font-weight: bold;
            font-size: 1.1em;
            border-bottom: 4px solid #000000;
        }
        .success-message { background-color: #FFC300; color: #000000; } /* Желтый */
        .error-message { background-color: #D90429; color: #FFFFFF; }   /* Красный */


        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px; /* Небольшой отступ от заголовка h2, если есть */
        }
        th, td {
            border: 2px solid #000000;
            padding: 12px 15px;
            text-align: left;
            background-color: #FFFFFF;
        }
        th {
            background-color: #000000;
            color: white;
            font-weight: 600;
        }
        tr:nth-child(even) td {
            background-color: #F0F0F0; /* Светло-серая зебра */
        }

        /* Ссылки действий */
        .actions a {
            display: inline-block;
            padding: 8px 15px;
            text-decoration: none;
            color: #FFFFFF;
            font-weight: 600;
            border: 2px solid #000000;
            margin-right: 8px;
            margin-bottom: 8px;
            transition: opacity 0.2s;
        }
        .actions a:hover { opacity: 0.8; }
        .actions a.edit { background-color: #0053A0; }   /* Синий */
        .actions a.delete { background-color: #D90429; } /* Красный */

        /* Ссылка "Lisa uus pitsa" */
        .add-new-link a {
            display: inline-block;
            padding: 12px 25px;
            background-color: #0053A0; /* Синяя плитка */
            color: #FFFFFF;
            text-decoration: none;
            border: 2px solid #000000;
            font-weight: 600;
            font-size: 1.1em;
            transition: opacity 0.2s;
        }
        .add-new-link a:hover { opacity: 0.8; }

        /* Формы */
        form { margin-top: 10px; } /* Небольшой отступ */
        form div { margin-bottom: 20px; }
        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #000000;
        }
        form input[type="text"],
        form input[type="password"],
        form input[type="number"],
        form textarea,
        form select {
            width: 100%;
            padding: 12px;
            border: 2px solid #000000;
            background-color: #FFFFFF;
            color: #000000;
            font-size: 1em;
        }
        form textarea { min-height: 100px; resize: vertical; }
        form input[type="submit"] {
            width: 100%;
            padding: 15px;
            color: white;
            border: 2px solid #000000;
            cursor: pointer;
            font-size: 1.2em;
            font-weight: 600;
            background-color: #0053A0; /* Синяя плитка */
            transition: opacity 0.2s;
        }
        form input[type="submit"]:hover { opacity: 0.8; }
        form a { /* для ссылки "назад" в форме */
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #0053A0;
            font-weight: 600;
        }


        footer.site-footer {
            text-align: center;
            padding: 25px;
            background-color: #000000;
            color: #A0A0A0; /* Светло-серый текст в футере */
            font-size: 0.9em;
        }
    </style>
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
                    <!-- Admin spetsiifilised lingid siia kui vaja -->
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
            // Сообщения выводятся перед основным контентом блока
            if (isset($_SESSION['success_message'])) {
                echo '<div class="success-message">' . htmlspecialchars($_SESSION['success_message']) . '</div>';
                unset($_SESSION['success_message']);
            }
            if (isset($_SESSION['error_message'])) {
                echo '<div class="error-message">' . htmlspecialchars($_SESSION['error_message']) . '</div>';
                unset($_SESSION['error_message']);
            }
            ?>
            <!-- Здесь будет начинаться контент конкретной страницы (например, обернутый в .content-block) -->