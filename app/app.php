<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Restaurant.php";
    require_once __DIR__."/../src/Cuisine.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost;dbname=restaurants_DB';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path'=>__DIR__."/../views"
    ));

    $app->get("/", function() use ($app)
    {
        return $app['twig']->render('index.html.twig', array('cuisines'=> Cuisine::getAll()));
    });

    $app->post("/cuisines", function() use ($app)
    {
        $new_cuisine = new Cuisine($_POST['new_cuisine']);
        $new_cuisine->save();
      return $app['twig']->render('index.html.twig', array('cuisines'=>Cuisine::getAll()));
    });

    return $app;
 ?>
