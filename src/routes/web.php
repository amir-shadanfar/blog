<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

//Router::csrfVerifier(new \Demo\Middlewares\CsrfVerifier());

Router::group(['namespace' => '\App\Controllers'], function () {
    // pages
    Router::get('/', [\App\Controllers\PageController::class, 'home']);
    Router::get('/blogs', [\App\Controllers\PageController::class, 'blogs']);
    Router::get('/blog/{id}', [\App\Controllers\PageController::class, 'blog_detail']);
    Router::get('/about', [\App\Controllers\PageController::class, 'about']);
    Router::get('/not-found', '\App\Controllers\PageController@notFound');
    Router::get('/forbidden', '\App\Controllers\PageController@notFound');
    // methods
    Router::post('/blog', [\App\Controllers\ActionController::class, 'store_blog']);
    Router::delete('/comment/{id}', [\App\Controllers\ActionController::class, 'delete_comment']);
});