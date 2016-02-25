# _Restaurants by Cuisine_

#### _Sorts restaurants by cuisine type, February 2016_

#### By _**Nic Netzel & Jared Beckler**_

## Description

_This web app will give the user the ability to add restaurants with certain cuisines and update/delete certain properties._

## Setup/Installation Requirements

* _Clone the Repository_
* _In your terminal, navigate to the project's main folder and run `composer install` to get Silex, Twig, and PHPUnit installed._
* _Navigate to the project's web folder using terminal and enter `php -S localhost:8000`_
* _Open PHPMyAdmin by going to localhost:8080/phpmyadmin in your web browser_
* _In phpmyadmin choose the Import tab and choose your database file and click Go. It's important to make sure you're not importing to a database that already exists, so make sure that a database with the same name as the one you're importing doesn't already exist._
* _In your web browser enter localhost:8000 to view the web app._

## Known Bugs

* _DELETE is not enabled_
* _PATCH does not properly change cuisine type in database so when going back to homepage after "updating", the cuisine type remains what is was before the "update"._
* _Watch out for  cuisine vs cuisineS in app routing and twig rendering. There are inconsistencies_

## Support and contact details

_Please contact us through GitHub with any questions, comments, or concerns._

## Technologies Used

* _Composer_
* _Twig_
* _Silex_
* _PHPUnit_
* _PHP_
* _mySQL_
* _Apache Server_
* _Bootstrap_

### License

**This software is licensed under the MIT license.**

Copyright (c) 2016 **_Nic Netzel & Jared Beckler_**
