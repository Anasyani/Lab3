<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit();
}

$username   = htmlspecialchars(trim($_POST['username'] ?? ''));
$email      = htmlspecialchars(trim($_POST['email'] ?? ''));
$age        = trim($_POST['age'] ?? '');
$faculty    = htmlspecialchars(trim($_POST['faculty'] ?? ''));
$agree      = isset($_POST['agree']) ? 'да' : 'нет';
$study_form = htmlspecialchars(trim($_POST['study_form'] ?? ''));

// Проверка данных
$errors = [];
if (empty($username)) {
    $errors[] = "Имя не может быть пустым";
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Некорректный email";
}
if (!ctype_digit($age) || (int)$age < 16 || (int)$age > 100) {
    $errors[] = "Возраст должен быть числом от 16 до 100";
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: index.php");
    exit();
}

// Сохранение в сессию
$_SESSION['username']   = $username;
$_SESSION['email']      = $email;
$_SESSION['age']        = $age;
$_SESSION['faculty']    = $faculty;
$_SESSION['agree']      = $agree;
$_SESSION['study_form'] = $study_form;

// Сохранение в файл (";" и переводы строк убираем, чтобы не ломать формат)
$clean = fn($s) => str_replace([";", "\r", "\n"], " ", $s);
$line = implode(";", array_map($clean, [$username, $email, $age, $faculty, $agree, $study_form])) . "\n";
file_put_contents(__DIR__ . "/data.txt", $line, FILE_APPEND | LOCK_EX);

header("Location: index.php");
exit();
