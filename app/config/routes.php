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
    $router->get('/', 'Page');  
    $router->get('/profile', 'Page::user_profile');
    $router->get('/leaderboards', 'Page::user_leaderboards');
    $router->get('/quizzes', 'Page::user_quizzes');
    $router->get('/recent', 'Page::user_recent');
    $router->get('/quizzes/{quizId}', 'Page::user_quizzes_quiz');
    $router->get('/play/{quizId}', 'Page::user_play');
    
    # API
    $router->patch('/', 'User::patch');
    
    # API
    $router->group('/quiz', function () use ($router) {

        $router->get('/', 'Quiz::get');
        $router->post('/', 'Quiz::post');
        $router->patch('/', 'Quiz::patch');
        $router->delete('/', 'Quiz::delete');

        $router->get('/public', 'Quiz::get_public');
        
        $router->post('/upload', 'Quiz::upload');
        $router->delete('/upload', 'Quiz::unload');
        
        $router->group('/question', function () use ($router) {

            $router->get('/', 'Question::get');
            $router->post('/', 'Question::post');
            $router->patch('/', 'Question::patch');
            $router->delete('/', 'Question::delete');
            $router->post('/upload', 'Question::upload');
            $router->delete('/upload', 'Question::unload');

            $router->group('/answer', function () use ($router) {

                $router->get('/', 'Answer::get');
                $router->post('/', 'Answer::post');
                $router->patch('/', 'Answer::patch');
                $router->delete('/', 'Answer::delete');

            });

            $router->get('/{questionId}/answer', 'Answer::get_by_question');

        });

        $router->group('/response', function () use ($router) {

            $router->get('/', 'Response::get');
            $router->post('/', 'Response::post');
            $router->patch('/', 'Response::patch');
            $router->delete('/', 'Response::delete');
            
            # $router->get('/{responseId}', 'Response::get');

        });

        $router->get('/{quizId}', 'Quiz::get');
        $router->get('/{quizId}/question', 'Question::get_by_quiz');
        $router->get('/{quizId}/response', 'Response::get_by_quiz');


    });

});

$router->group('/auth', function() use ($router) {
    
    $router->match('/register', 'Auth::register', ['POST', 'GET']);
    $router->match('/login', 'Auth::login', ['POST', 'GET']);
    $router->get('/logout', 'Auth::logout');
    $router->match('/password-reset', 'Auth::password_reset', ['POST', 'GET']);
    $router->match('/set-new-password', 'Auth::set_new_password', ['POST', 'GET']);
    
});