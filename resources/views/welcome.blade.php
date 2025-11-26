<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        /* Стиль для центрирования контента */
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa; /* Светло-серый фон */
        }

        .display-4{
            font-size: 2.5rem;
        }
        .container {
            max-width: 960px;
        }
        .jumbotron-custom {
            padding: 4rem 2rem;
            margin-bottom: 2rem;
            background-color: #ffffff;
            border-radius: .5rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }
        .header-links {
            position: absolute;
            top: 1rem;
            right: 1rem;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="jumbotron-custom text-center">
        @auth
            {{-- 🟢 Если пользователь залогинен (АДМИН или ЮЗЕР) --}}
            <h2 class="display-4 fw-bold text-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-rocket-takeoff-fill me-3" viewBox="0 0 16 16">
                    <path d="M12.5 6.49L16 0H9.516c.864 1.35 1.05 2.532.84 3.903-.13.842-.423 1.583-.83 2.158A2.8 2.8 0 0 1 12.5 6.49Z"/>
                    <path d="M11.39 9.9c-.382.4-.718.835-.918 1.258-1.527 3.328-4.733 5-8.2.204-1.782.593-3.218.847-4.437.067-.09-.23-.482-.843-.886-.96-.445.74-.836 1.4-.23.23.003-.102.006-.204.01-.307.03-.896.223-2.029.623-3.088C3.15 4.7 5.0 4.223 6.9 4.7c.394.098.74.286 1.02.493A4 4 0 0 1 10 3.25c-.714 0-1.4.204-2.012.593a.91.91 0 0 0-.256-.479c-.197-.248-.445-.478-.737-.714C6.545 2.47 5.753 2.152 4.673 2.152c-1.127 0-2.02.264-2.73.692-.71.428-1.28.972-1.724 1.637-.444.665-.77 1.488-.97 2.478a23.27 23.27 0 0 0-.012.378c-.02.485.034.984.14 1.486-.07-.066-.14-.135-.214-.205-.124.2-.24.407-.333.62A.53.53 0 0 0 0 10.5c0 .28.225.5.5.5h.502a.5.5 0 0 0 .447-.276L2.4 9.172a.55.55 0 0 1 .374-.183h.017c.567-.058 1.109-.153 1.62-.284.124.1.24.2.333.303.208.225.46.43.743.606.273.167.58.293.91.378.33.085.7.13 1.08.13s.75-.045 1.08-.13c.33-.085.637-.211.91-.378a3.9 3.9 0 0 0 .743-.606c.093-.103.21-.203.333-.303.51.13 1.052.226 1.62.284h.017a.55.55 0 0 1 .374.183l.948 1.552a.5.5 0 0 0 .447.276h.502a.5.5 0 0 0 .5-.5c0-.18-.082-.352-.22-.472L11.39 9.9Z"/>
                </svg>
                Здраствуйте, {{ auth()->user()->name }}! 🚀
            </h2>
            <p class="lead text-muted">Вы успешно залогинились.</p>
            <p class="fs-5">
                Перейдите в свою Панель
            </p>
        @else
            {{-- 🔴 Если пользователь не залогинен (Гость) --}}
            <h2 class="display-4 fw-bold text-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-rocket-takeoff-fill me-3" viewBox="0 0 16 16">
                    <path d="M12.5 6.49L16 0H9.516c.864 1.35 1.05 2.532.84 3.903-.13.842-.423 1.583-.83 2.158A2.8 2.8 0 0 1 12.5 6.49Z"/>
                    <path d="M11.39 9.9c-.382.4-.718.835-.918 1.258-1.527 3.328-4.733 5-8.2.204-1.782.593-3.218.847-4.437.067-.09-.23-.482-.843-.886-.96-.445.74-.836 1.4-.23.23.003-.102.006-.204.01-.307.03-.896.223-2.029.623-3.088C3.15 4.7 5.0 4.223 6.9 4.7c.394.098.74.286 1.02.493A4 4 0 0 1 10 3.25c-.714 0-1.4.204-2.012.593a.91.91 0 0 0-.256-.479c-.197-.248-.445-.478-.737-.714C6.545 2.47 5.753 2.152 4.673 2.152c-1.127 0-2.02.264-2.73.692-.71.428-1.28.972-1.724 1.637-.444.665-.77 1.488-.97 2.478a23.27 23.27 0 0 0-.012.378c-.02.485.034.984.14 1.486-.07-.066-.14-.135-.214-.205-.124.2-.24.407-.333.62A.53.53 0 0 0 0 10.5c0 .28.225.5.5.5h.502a.5.5 0 0 0 .447-.276L2.4 9.172a.55.55 0 0 1 .374-.183h.017c.567-.058 1.109-.153 1.62-.284.124.1.24.2.333.303.208.225.46.43.743.606.273.167.58.293.91.378.33.085.7.13 1.08.13s.75-.045 1.08-.13c.33-.085.637-.211.91-.378a3.9 3.9 0 0 0 .743-.606c.093-.103.21-.203.333-.303.51.13 1.052.226 1.62.284h.017a.55.55 0 0 1 .374.183l.948 1.552a.5.5 0 0 0 .447.276h.502a.5.5 0 0 0 .5-.5c0-.18-.082-.352-.22-.472L11.39 9.9Z"/>
                </svg>
                Добро Пожаловать в CRMSystem 1.0 🚀
            </h2>
            <p class="lead text-muted">Проект запущен! Добро пожаловать.</p>
            <p class="fs-5">
                Войдите в личный кабинет или пройдите регистрацию
            </p>
        @endauth

        <hr class="my-4">
        @if (Route::has('login'))
            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                @auth
                    {{-- Проверка роли --}}
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-lg btn-success px-3">
                            Админ Панель
                        </a>
                    @else
                        <a href="{{ route('user.dashboard') }}" class="btn btn-primary btn-lg btn-success px-3">
                            Панель
                        </a>
                    @endif
                @else
                    <a class="btn btn-primary btn-lg px-3" href="{{ route('login') }}" role="button">
                        Войти
                    </a>
                    @if (Route::has('register'))
                        <a class="btn btn-primary btn-lg btn-success px-3" href="{{ route('register') }}" role="button">
                            Регистрация
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
