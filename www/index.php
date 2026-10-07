<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
</head>
<body>
    <h1>Регистрация студента</h1>

    <?php if (isset($_SESSION['errors'])): ?>
        <ul style="color:red;">
            <?php foreach ($_SESSION['errors'] as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
        <?php unset($_SESSION['errors']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['username'])): ?>
        <p>Данные из сессии:</p>
        <ul>
            <li>Имя: <?= $_SESSION['username'] ?></li>
            <li>Email: <?= $_SESSION['email'] ?></li>
            <li>Возраст: <?= $_SESSION['age'] ?></li>
            <li>Факультет: <?= $_SESSION['faculty'] ?></li>
            <li>Согласен с правилами: <?= $_SESSION['agree'] ?></li>
            <li>Форма обучения: <?= $_SESSION['study_form'] ?></li>
        </ul>
    <?php else: ?>
        <p>Данных пока нет.</p>
    <?php endif; ?>

    <a href="form.html">Заполнить форму</a> |
    <a href="view.php">Посмотреть все данные</a>
</body>
</html>
