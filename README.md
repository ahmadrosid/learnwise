# Learnwise

Learnwise is open source learning management system just like Udemy created with Laravel and Fastbootstrap.

![demo](learnwise-demo.png)

This project inspired by: https://github.com/AntonioErdeljac/next13-lms-platform

## Set up local development

### Prerequisites

-   PHP 8.1 or above
-   Node.js 16.xx or above
-   A running database server (MySQL, PostgreSQL, SQLite, MongoDB)

### Steps

1. Clone the repository:

    ```sh
    git clone https://github.com/ahmadrosid/learnwise
    ```

2. Make a copy of the `.env` file:

    ```sh
    cp .env.example .env
    ```

3. Install PHP and Node.js dependencies:

    ```sh
    composer install
    npm install
    # or
    yarn install
    # or
    pnpm install
    ```

4. Prepare an empty database and update the following environment variables in the `.env` file accordingly:

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=learnwise
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5. We use Xendit as the payment gateway, so a Xendit account is required. Create one if you haven't already, then update these two variables in the `.env` file:

    ```
    XENDIT_SECRET_KEY=
    XENDIT_PUBLIC_KEY=
    ```

6. Perform database migration and key generation:

    ```sh
    php artisan migrate
    php artisan key:generate
    ```

7. Finally, run the server:

    ```sh
    npx concurrently "npm run dev" "php artisan serve"
    ```
