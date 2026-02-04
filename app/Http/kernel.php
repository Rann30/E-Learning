protected $middlewareAliases = [
'student' => \App\Http\Middleware\StudentMiddleware::class,
'admin' => \App\Http\Middleware\AdminMiddleware::class,
];
->withMiddleware(function ($middleware) {
$middleware->alias([
'student' => \App\Http\Middleware\StudentMiddleware::class,
'admin' => \App\Http\Middleware\AdminMiddleware::class,
'teacher' => \App\Http\Middleware\TeacherMiddleware::class,
]);
})