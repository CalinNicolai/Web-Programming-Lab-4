# Отчет по Четвертой лабораторной работе

## 1. Инструкции по запуску проекта

Данные инструкции действительны при использовании PhpStorm, в ином случае, воспользуйтесь приведенной ссылкой:
[запуск проекта с gitHub](https://www.youtube.com/watch?v=6N6JFynR0gM)

1. Клонируйте репозиторий:
   ```bash
   https://github.com/CalinNicolai/Web-Programming-Lab-4.git
2. Запустите проект:
   <!-- Если у вас есть веб-сервер (например, Apache или Nginx), настройте его так, чтобы корневой каталог указывал на
   каталог вашего проекта.  
   Если у вас нет веб-сервера, вы можете использовать встроенный сервер PHP для тестирования: -->
   ```bash 
   php -S localhost:8000 task1.php

## 2. Описание проекта

В данной лабораторной работе была изучена Обработка форм в PHP.

## 3. Краткая документация к проекту

#### Валидация POST запроса с помощью класса Validator

```PHP
require_once 'Validator.php';
$validator = new Validator();

$validator->addValidation('name', function($value) {
    if (empty($value) )
        return false;
    if (strlen($value) <= 3 )
        return false;
    if (strlen($value) >= 20 )
        return false;
    if (preg_match('/\d/', $value))
        return false;
    return true;
}, 'Некорректное имя. Имя должно содержать от 3 до 20 символов и не должно содержать цифр.');

$validator->addValidation('email', function($value) {
    if (empty($value))
        return false;
    if (!filter_var($value, FILTER_VALIDATE_EMAIL))
        return false;
    return true;
}, 'Некорректный email.');

$validator->addValidation('comment', function($value) {
    return !empty($value);
}, 'Пожалуйста, напишите ваш отзыв.');

$validator->addValidation('agreement', function($value) {
    return !empty($value);
}, 'Подтвердите, что согласны на обработку данных.');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'name' => $_POST['name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'comment' => $_POST['comment'] ?? '',
        'agreement' => isset($_POST['agreement']),
    ];

    $errors = $validator->validateForm($data);

    if (empty($errors)) {
        echo "<div class='container mt-5'>";
        echo "<div class='alert alert-success' role='alert'>Ваш отзыв успешно отправлен!</div>";
        echo "</div>";
    } else {
        echo "<div class='container mt-5'>";
        echo "<div class='alert alert-danger' role='alert'>";
        echo "<ul>";
        foreach ($errors as $fieldErrors) {
            foreach ($fieldErrors as $error) {
                echo "<li>$error</li>";
            }
        }
        echo "</ul>";
        echo "</div>";
        echo "</div>";
    }
}

```

## 4. Пример использования проекта (с приложением скриншотов)

![Пример работы программы](/images/1.png)

## 5. Задания

### №1 Работа с глобальной переменной $_POST `Task1.php`

#### 1. Создайте файл с указанным содержимым

#### 2. Добавьте в отмеченную область код, который будет отображать сообщение только после отправки формы.

#### 3. Добавьте под формой функцию для проверки данных, гарантирующую заполнение всех полей и корректность введенного e-mail.

#### 4. Объясните, что такое глобальная переменная $_POST и $_SERVER[“PHP_SELF”]

### №2 Получение данных с различных контроллеров `Task2.php`

#### Создайте форму, состоящую минимум из 3 контроллеров (input, select)

#### Тема формы определяется на ваш выбор

#### Обработайте данные и выведите их на экран

### №3 . Создание, обработка и валидация форм `Task3.php`

#### 1. Создайте форму, показанную на рисунке

#### Cоздайте собственную функцию валидации, которая будет проверять все поля формы при получении запроса

- Для поля “name”: установите минимальную длину в 3 символа, максимальную - 20 символов, и запретите использование цифр.
- Для поля “mail”: удостоверьтесь, что адрес электронной почты соответствует стандартам.
- Для поля “comment”: удостоверьтесь, что оно не пустое и укажите каки либо другие необходимые критерии валидации
- Убедитесь, что пользователь отметил галочку “Do you agree with data processing?” перед отправкой формы"
- Если пользователь верно ввел данные, выведите комментарий ниже формы (не требуется сохранение комментариев где-либо)

#### 3. Чем отличается глобальная переменная $_REQUEST и $_POST?

#### 4. В качестве валидатора рассмотрите и изучите следующий класс. `Alternative.php`

### №4 Создание формы `Task4.php`

#### 1. Создайте тест из 3-х вопросов используя input, type radio, и input, type checkbox и запросите имя пользователя. Проверьте заполнение формы и варианты, выбранные пользователем. Выведите результаты на экран.

