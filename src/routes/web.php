<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

// Router::csrfVerifier(csrf_token());

Router::group(['namespace' => '\App\Controllers'], function () {
    // pages
    Router::get('/', [\App\Controllers\PageController::class, 'home']);
    Router::get('/blogs', [\App\Controllers\PageController::class, 'blogs']);
    Router::get('/blog/{id}', [\App\Controllers\PageController::class, 'blog_detail']);
    Router::get('/about', [\App\Controllers\PageController::class, 'about']);
    // methods
    Router::post('/blog', [\App\Controllers\ActionController::class, 'store_blog']);
    Router::delete('/comment/{id}', [\App\Controllers\ActionController::class, 'delete_comment']);
});