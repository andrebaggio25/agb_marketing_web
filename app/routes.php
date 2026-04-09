<?php

declare(strict_types=1);

use App\Core\Router;

/** @var Router $router */
$router->get('/', 'App\Controllers\HomeController@index');
$router->get('/blog', 'App\Controllers\BlogController@index');
$router->get('/blog/{slug}', 'App\Controllers\BlogController@show');
$router->get('/pagina/{slug}', 'App\Controllers\PageController@show');
$router->post('/lead', 'App\Controllers\LeadController@store');

$router->get('/admin/login', 'App\Controllers\Admin\AuthController@loginForm');
$router->post('/admin/login', 'App\Controllers\Admin\AuthController@login');
$router->get('/admin/logout', 'App\Controllers\Admin\AuthController@logout');
$router->get('/admin', 'App\Controllers\Admin\DashboardController@index');

$router->get('/admin/pages', 'App\Controllers\Admin\PageAdminController@index');
$router->get('/admin/pages/create', 'App\Controllers\Admin\PageAdminController@create');
$router->post('/admin/pages', 'App\Controllers\Admin\PageAdminController@store');
$router->get('/admin/pages/{id}/edit', 'App\Controllers\Admin\PageAdminController@edit');
$router->post('/admin/pages/{id}', 'App\Controllers\Admin\PageAdminController@update');
$router->post('/admin/pages/{id}/delete', 'App\Controllers\Admin\PageAdminController@destroy');

$router->get('/admin/posts', 'App\Controllers\Admin\PostAdminController@index');
$router->get('/admin/posts/create', 'App\Controllers\Admin\PostAdminController@create');
$router->post('/admin/posts', 'App\Controllers\Admin\PostAdminController@store');
$router->get('/admin/posts/{id}/edit', 'App\Controllers\Admin\PostAdminController@edit');
$router->post('/admin/posts/{id}', 'App\Controllers\Admin\PostAdminController@update');
$router->post('/admin/posts/{id}/delete', 'App\Controllers\Admin\PostAdminController@destroy');

$router->get('/admin/categories', 'App\Controllers\Admin\CategoryAdminController@index');
$router->get('/admin/categories/create', 'App\Controllers\Admin\CategoryAdminController@create');
$router->post('/admin/categories', 'App\Controllers\Admin\CategoryAdminController@store');
$router->get('/admin/categories/{id}/edit', 'App\Controllers\Admin\CategoryAdminController@edit');
$router->post('/admin/categories/{id}', 'App\Controllers\Admin\CategoryAdminController@update');
$router->post('/admin/categories/{id}/delete', 'App\Controllers\Admin\CategoryAdminController@destroy');

$router->get('/admin/media', 'App\Controllers\Admin\MediaAdminController@index');
$router->post('/admin/media', 'App\Controllers\Admin\MediaAdminController@upload');
$router->post('/admin/media/{id}/delete', 'App\Controllers\Admin\MediaAdminController@destroy');

$router->get('/admin/leads', 'App\Controllers\Admin\LeadAdminController@index');
$router->get('/admin/leads/{id}', 'App\Controllers\Admin\LeadAdminController@show');
$router->post('/admin/leads/{id}/status', 'App\Controllers\Admin\LeadAdminController@status');
$router->post('/admin/leads/{id}/note', 'App\Controllers\Admin\LeadAdminController@addNote');

$router->get('/admin/users', 'App\Controllers\Admin\UserAdminController@index');
$router->get('/admin/users/create', 'App\Controllers\Admin\UserAdminController@create');
$router->post('/admin/users', 'App\Controllers\Admin\UserAdminController@store');
$router->get('/admin/users/{id}/edit', 'App\Controllers\Admin\UserAdminController@edit');
$router->post('/admin/users/{id}', 'App\Controllers\Admin\UserAdminController@update');
$router->post('/admin/users/{id}/delete', 'App\Controllers\Admin\UserAdminController@destroy');

$router->get('/admin/settings', 'App\Controllers\Admin\SettingAdminController@index');
$router->post('/admin/settings', 'App\Controllers\Admin\SettingAdminController@update');

$router->get('/admin/database', 'App\Controllers\Admin\DatabaseAdminController@index');
$router->post('/admin/database/migrate', 'App\Controllers\Admin\DatabaseAdminController@migrate');

$router->get('/admin/sections', 'App\Controllers\Admin\SectionAdminController@index');
$router->get('/admin/sections/{id}/edit', 'App\Controllers\Admin\SectionAdminController@edit');
$router->post('/admin/sections/{id}', 'App\Controllers\Admin\SectionAdminController@update');
