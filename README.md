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

5. We use [Xendit](http://xendit.co) as the payment gateway, so a Xendit account is required. Create one if you haven't already, then update these two variables in the `.env` file:

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

8. After receiving a payment, certain updates are required. To accomplish this, you'll need to expose your local development server using services like [expose](http://expose.dev) or [ngrok](http://ngrok.com). Here's what you need to do:

    - **For ngrok**:

        1. Visit [ngrok](http://ngrok.com) to create an account.
        2. Run the following commands to configure ngrok and share your local server:

        ```sh
        ngrok config add-authtoken <your-token>
        ngrok http 8000
        ```

    - **For expose**:
        1. Visit [expose](http://expose.dev) to set up an account.
        2. Run the following command to share your local server:
        ```sh
        expose share http://127.0.0.1:8000
        ```

    > Note: These are just a couple of options. There are other services available that can achieve the same purpose.
