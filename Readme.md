## About Boostiny Task

the app handel user authentication, authorization ,list products , make order with different payment methods.


-   responsible for authenticate and login users.
-   responsible for validating whether logged user is permitted to do specific action or not.
-   list cached products using redis 
- make order with different types of payment types with the help of factory and strategy patterns.
- notify the seller with different channels for his product orders

## Setting up

### Requirements

-   [PHP >= 7.4](http://php.net/)
-   [Composer](https://getcomposer.org/)
-   [Xampp (Apache Server - PhpMyAdmin )](https://www.apachefriends.org/)
-   [Git](https://git-scm.com/)

### Clone GitHub repo for this project locally

`git clone https://github.com/baselrabia/Boostiny-task.git`

-   `cd Boostiny-task`
-   `composer install`
-   `cp .env.example .env`
-   `php artisan key:generate`

### Linking Mysql Database to the Project

-   Open your local `PhpMyAdmin`
-   create new database for the application
-   edit the configuration of the database in the `.env` file
-   Run the command line for making the migration of the database and seeding data <br>
    `php artisan migrate --seed`

### more steps to start
-   Configure the Jwt key secret by run this line <br>
    `php artisan jwt:secret `
-   starting your cache layer with redis using docker <br>
    `docker-compose up -d`

## Starting the application

now everything is almost done just one step more to start your App

-   Run this command line for serving the App to your localhost -> `php artisan serve`
