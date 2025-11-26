<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // ❗ Пропускаем запрос, если маршрут НЕ найден
        if (!$request->route()->getName()) {
            return $next($request);
        }
        // Пропускаю все Livewire AJAX-запросы
        if ($request->expectsJson()) {
            return $next($request);
        }

        // Чек роль только для обычных запросов страницы
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/403');
        }

        return $next($request);
    }
}
