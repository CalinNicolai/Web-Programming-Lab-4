<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>#my-shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="">#my-shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Comments</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Exit</button>
            </form>
        </div>
    </nav>
</header>

<main class="container">
    <h1 id="Write-comment">Оставить отзыв</h1>
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger" role="alert">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
        <div class="form-group">
            <label for="name">Ваше имя:</label>
            <input name="name" type="text" class="form-control" id="name" placeholder="Введите ваше имя" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : ''; ?>">
        </div>
        <div class="form-group">
            <label for="email">Ваш email:</label>
            <input name="email" type="email" class="form-control" id="email" placeholder="Введите ваш email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>">
        </div>
        <div class="form-group">
            <label for="comment">Ваш отзыв:</label>
            <textarea name="comment" class="form-control" id="comment" rows="3"><?php echo isset($_POST["comment"]) ? $_POST["comment"] : ''; ?></textarea>
        </div>
        <div class="form-check">
            <input name="agreement" type="checkbox" class="form-check-input" id="agree" <?php echo isset($_POST["agreement"]) ? 'checked' : ''; ?>>
            <label class="form-check-label" for="agree">Согласен на обработку данных</label>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $comment = $_POST["comment"];
    $agreement = isset($_POST["agreement"]);

    // Валидация имени
    validateName($errors, $name);
    // Валидация email
    validateEmail($errors, $email);
    // Валидация комментария
    validateComment($errors, $comment);

    // Проверка согласия на обработку данных
    if (!$agreement) {
        $errors[] = "Подтвердите, что согласны на обработку данных.";
    }

    // Если нет ошибок, выводим сообщение об успешной отправке
    if (empty($errors)) {
        echo "<div class='container mt-5'>";
        echo "<div class='alert alert-success' role='alert'>Ваш отзыв успешно отправлен!</div>";
        echo "</div>";
    } else {
        // Выводим ошибки в формате списка
        echo "<div class='container mt-5'>";
        echo "<div class='alert alert-danger' role='alert'>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
        echo "</div>";
        echo "</div>";
    }
}

function validateName(array &$errors, $name): void
{
    if (empty($name) || strlen($name) < 3 || strlen($name) > 20 || preg_match('/\d/', $name)) {
        $errors[] = "Некорректное имя. Имя должно содержать от 3 до 20 символов и не должно содержать цифр.";
    }
}

function validateEmail(array &$errors, $email)
{
    if (empty($email)) {
        $errors[] = "Вы должны указать Email";
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Неверный формат Email";
        }
    }
}

function validateComment(array &$errors, $comment)
{
    if (empty($comment)) {
        $errors[] = "Вы должны написать комментарий";
    }
}
?>
