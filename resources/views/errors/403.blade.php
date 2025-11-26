<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 | Доступ запрещен</title>
    <!-- Bootstrap 5.3 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa; /* Светлый фон */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .error-container {
            max-width: 600px;
            padding: 40px;
            border-radius: 12px;
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        .error-code {
            font-size: 8rem;
            font-weight: 700;
            color: #dc3545; /* Цвет ошибки (красный) */
            line-height: 1;
        }
        .error-message {
            font-size: 1.5rem;
            color: #6c757d;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<div class="error-container text-center">
    <p class="error-code">403</p>
    <h1 class="display-5 fw-bold text-danger mb-3">Доступ запрещен</h1>

    @auth
        {{-- Если юзер аутентифицирован--}}
        <p class="error-message">
            У вас нет прав для просмотра этой страницы.
            Пожалуйста, вернитесь на свою панель управления.
        </p>

        <hr>

        {{-- кнопка редиректа --}}
        @if (auth()->user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="btn btn-danger btn-lg shadow-sm">
                Перейти в Панель Администратора
            </a>
        @else
            <a href="{{ route('user.dashboard') }}" class="btn btn-primary btn-lg shadow-sm">
                Перейти в Мою Панель
            </a>
        @endif

    @else
        {{-- Если юзер не аутентифицирован--}}
        <p class="error-message">
            Вы пытаетесь получить доступ к защищенному ресурсу. Пожалуйста, войдите в систему.
        </p>
        <a href="{{ route('login') }}" class="btn btn-success btn-lg shadow-sm">
            Войти в CRMSystem
        </a>
    @endauth

    <div class="mt-4">
        <a href="{{ route('home') }}" class="text-secondary text-decoration-none">
            Вернуться на главную
        </a>
    </div>
</div>

</body>
</html>
