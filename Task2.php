<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Обзор машины</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
<div class="container mt-5">
    <h1>Обзор машины</h1>
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
        <div class="mb-3">
            <label for="brand" class="form-label">Марка машины</label>
            <input type="text" class="form-control" id="brand" name="brand" required>
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Год выпуска</label>
            <input type="number" class="form-control" id="year" name="year" min="1900" max="2025" required>
        </div>
        <div class="mb-3">
            <label for="color" class="form-label">Цвет</label>
            <select class="form-select" id="color" name="color" required>
                <option value="">Выберите цвет</option>
                <option value="red">Красный</option>
                <option value="blue">Синий</option>
                <option value="green">Зеленый</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $brand = $_POST["brand"];
    $year = $_POST["year"];
    $color = $_POST["color"];

    echo "<div class='container mt-5'>";
    echo "<h2>Результаты обзора машины:</h2>";
    echo "<div class='card'>";
    echo "<div class='card-body'>";
    echo "<p class='card-text'><strong>Марка машины:</strong> $brand</p>";
    echo "<p class='card-text'><strong>Год выпуска:</strong> $year</p>";
    echo "<p class='card-text'><strong>Цвет:</strong> $color</p>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}
