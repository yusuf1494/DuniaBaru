<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../vendor/autoload.php';

date_default_timezone_set("Asia/Jakarta");
session_start();

$app = new \Slim\Slim(array(
    'templates.path' => '../templates',
    'view' => new \Slim\Views\Twig()
        ));

$app->container->singleton('log', function() {
    $log = new \Monolog\Logger('DuniaBaru');
    $log->pushHandler(new \Monolog\Handler\StreamHandler('../logs/app.log', \Monolog\Logger::DEBUG));
    return $log;
});

$app->view(new \Slim\Views\Twig());
$app->view->parserOptions = array(
    'charset' => 'utf-8',
    'auto_reload' => true,
    'autoescape' => true,
    'strict_variables' => false
);

$app->view->parserExtensions = array(new \Slim\Views\TwigExtension);

$app->get('/', function () use($app) {
    $app->log->info("Dunia Baru '/' route");
    $app->render('index.twig');
})->name('Home');

$auth = function() use ($app) {
    if (!isset($_SESSION['user'])) {
        $app->redirect('/');
    }
};

$anonymous = function() use($app) {
    if (isset($_SESSION['user'])) {
        $app->notFound();
    }
};

$app->post('/logout', function() use($app){
   if(isset($_SESSION['user'])){
      unset( $_SESSION['user']);
      $app->redirect('/');
   } 
})->name('logout');

$app->post('/auth', $anonymous, function () use($app) {
    $request = $app->request();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $app->log->info('username : ' + $username);
    $app->log->info('password : ' + $password);

    if ($username == 'yusuf1494' && $password == 'yusuf') {
        $_SESSION['user'] = 'user';
        $app->redirect('/dashboard');
    } else {
        $app->redirect('/');
    }
})->name('authenticate');

$app->get('/dashboard', $auth, function () use($app) {
    $app->render('dashboard.twig');
})->name('dashboard');

$app->run();
