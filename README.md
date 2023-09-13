
# Task-Manager


## Requirements

- PHP ^8.1
- Laravel ^10.10


## Installation


1. Clone the repository

    git clone https://github.com/Sarwar242/TaskManager.git

2. Switch to the repo folder

    cd TaskManager

3. Install all the dependencies using composer

    composer install

4. Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

5. Generate a new application key

    php artisan key:generate

6. Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate
    php artisan db:seed

7. Start the local development server

    php artisan serve

You can now access the server at http://127.0.0.1:8000/

**TL;DR command list**

    git clone https://github.com/Sarwar242/TaskManager.git
    cd TaskManager
    composer install
    cp .env.example .env
    php artisan key:generate
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve
    npm run dev

## Database seeding

Open the DatabaseSeeder and set the property values as per your requirement

    database/seeders/DatabaseSeeder.php

Run the database seeder and you're done

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh
    
## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

----------

# Testing TaskManager App

Run the laravel development server

    php artisan serve

The frontend can now be accessed at

    http://127.0.0.1:8000/
