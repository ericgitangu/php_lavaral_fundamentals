protected $routeMiddleware = [
    'role' => \App\Http\Middleware\CheckUserRole::class,
];