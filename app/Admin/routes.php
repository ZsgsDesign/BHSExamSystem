<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('exams', ExamController::class);
    $router->resource('problems', ProblemController::class);
    $router->get('users/upload', 'UserController@upload');
    $router->post('users/upload', 'UserController@upload');
    $router->get('users/export', 'UserController@export');
    $router->resource('users', UserController::class);

});
