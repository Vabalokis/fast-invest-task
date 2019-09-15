# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/6.x/installation)

Clone the repository

    git clone git@github.com:Vabalokis/fast-invest-task.git

Switch to the repo folder

    cd fast-invest-task

Install all the dependencies using composer

    composer install

Install all the dependencies using node package manager

    npm install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone git@github.com:Vabalokis/fast-invest-task.git
    cd fast-invest-task
    composer install
    npm install
    cp .env.example .env
    php artisan key:generate
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve
    
# Code overview

## Dependencies

- [auth-tests](https://github.com/dczajkowski/auth-tests) - For testing default authentication
- [laravel-ui](https://github.com/laravel/ui) - Scaffolding blade views files for default authentication
- [laravel-telescope](https://github.com/laravel/telescope) - For debugging events and listeners

## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

## Testing

Edit `phpunit.xml` file by changing these two lines between `<php>` tags:
```xml
<server name="DB_CONNECTION" value="sqlite"/>
<server name="DB_DATABASE" value=":memory:"/>
```
Alternatively, use different database than sqlite, but also different from the one used for development.

