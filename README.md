<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About project

This is a web application for goldshop this app have many process:

- Buy and sale gold with many property .
- Display daily buys and sales oprations and can display oprations of any day.
- sales can be peimums and add peimums in any time and any money .
- Display how much we get in any day.
- project have dealers pages.

## Project requirement

- **laravel >=6.x**
- **php >=7.2**
### Run project
1. open project dirction after clone like that: 
  ```sh
    cd G:\pms\pms_project_researsh
   ```
2. complate project file: 
  ```sh
    composer install
   ```
3. make a copy of env file and change variable env as you like: 
  ```sh
    copy .env.example .env
   ```
3. generate key: 
    ```sh
    php artisan key:generate
    ```
4. create new database with DB_DATABASE by defult it will be "goldshop" 

5. run migrations: 
    ```sh
    php artisan migrate
    ```
6. run seed : 
    ```sh
    php artisan db:seed
    ```
7. run project
    ```sh
    php artisan serve
    ```
## Username and Password
you can change username and password or add another user from  database\seeds\UserSeeser.php
- username: admin@admin.com .
- password: 123.