<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Laravel TZ

### How to install

This section provides instructions on how to install the Laravel project on a local environment or Docker.

1. Clone the project repository from GitHub and install the dependencies. You can do this by running the following commands:

    ```shell
    git clone <repository_url>
    composer install

    docker compose up -d
    ```
    After that you have started the project on your local machine. You can access the project by visiting `http://172.21.2.3` in your browser.

2. Create a new `.env` file in the root directory of the project and copy the contents of the `.env.example` file into it.

    ```shell
    cp .env.example .env
    ```

3. Run the database migrations and change the permissions of the storage and cache directories. You can do this by running the following commands:

    ```shell
    docker exec -it php sh

    chmod 777 -R storage/logs
    chmod 777 -R storage/framework

    php artisan migrate
    php artisan key:generate
    ```
