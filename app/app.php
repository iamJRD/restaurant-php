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

    $app->get("/restaurants", function() use ($app) {
        return $app['twig']->render('cuisines.html.twig', array('resturants' => Resturant::getAll()));
    });

    $app->post("/cuisines", function() use ($app)
    {
        $new_cuisine = new Cuisine($_POST['new_cuisine']);
        $new_cuisine->save();
      return $app['twig']->render('index.html.twig', array('cuisine'=>Cuisine::getAll()));
    });

    $app->get("/cuisines/{id}", function($id) use ($app){
        $cuisine = Cuisine::find($id);
      return $app['twig']->render('cuisines.html.twig', array('cuisine'=> $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    $app->post("/restaurants", function() use ($app)
    {
        $new_restaurant_name = $_POST['new_restaurant'];
        $new_restaurant_description = $_POST['new_description'];
        $cuisine_id = $_POST['cuisine_id'];
        $new_restaurant = new Restaurant($new_restaurant_name, $new_restaurant_description, $cuisine_id, $id = null);
        $new_restaurant->save();
        $cuisine = Cuisine::find($cuisine_id);
      return $app['twig']->render('cuisines.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    return $app;
 ?>
