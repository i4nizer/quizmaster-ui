<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 *
 * MIT License
 *
 * Copyright (c) 2020 Ronald M. Marasigan
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package LavaLust
 * @author Ronald M. Marasigan <ronald.marasigan@yahoo.com>
 * @since Version 1
 * @link https://github.com/ronmarasigan/LavaLust
 * @license https://opensource.org/licenses/MIT MIT License
 */

/*
| -------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------
| Here is where you can register web routes for your application.
|
|
*/

$router->get('/', 'Auth');

# USER ACCESS
$router->group('/user', function() use ($router) {

    # PAGES
    $router->get('/', 'Page::user_dashboard');
    $router->get('/dashboard', 'Page::user_dashboard');
    $router->get('/profile', 'Page::user_profile');
    $router->get('/quizzes', 'Page::user_quizzes');
    $router->get('/settings', 'Page::user_settings');
    $router->get('/quizzes/quiz/{quizId}', 'Page::user_quizzes_quiz');
    $router->get('/quizzes/quiz/{quizId}/category/{categoryId}', 'Page::user_quizzes_quiz_category');

    # APIs - /user/quiz
    $router->group('/quiz', function () use ($router) {

        $router->get('/', 'Quiz::get');
        $router->post('/', 'Quiz::post');
        $router->patch('/', 'Quiz::patch');
        $router->delete('/', 'Quiz::delete');

        # APIs - /user/quiz/category
        $router->group('/category', function () use ($router) {

            $router->get('/', 'Category::get');
            $router->post('/', 'Category::post');
            $router->patch('/', 'Category::patch');
            $router->delete('/', 'Category::delete');

            # APIs - /user/quiz/category/question
            $router->group('/question', function () use ($router) {

                $router->get('/', 'Question::get');
                $router->post('/', 'Question::post');
                $router->patch('/', 'Question::patch');
                $router->delete('/', 'Question::delete');

            });

        });

        # APIs - /user/quiz/{quizId}/category/{categoryId}
        $router->get('/{quizId}', 'Quiz::get');
        $router->get('/{quizId}/category', 'Category::get_quiz');
        $router->get('/{quizId}/category/{categoryId}', 'Category::get_quiz_category');

    });

});

$router->group('/auth', function() use ($router) {
    
    $router->match('/register', 'Auth::register', ['POST', 'GET']);
    $router->match('/login', 'Auth::login', ['POST', 'GET']);
    $router->get('/logout', 'Auth::logout');
    $router->match('/password-reset', 'Auth::password_reset', ['POST', 'GET']);
    $router->match('/set-new-password', 'Auth::set_new_password', ['POST', 'GET']);
    
});