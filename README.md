# Voucher Application

This application allows you to generate and manage vouchers.

## Instructions

Follow these steps to set up the application:

1. **Navigate to the project directory:**

    ```
    cd vuocher-app
    ```

2. **Install the dependencies:**

    ```
    composer install
    ```

3. **Generate an application key:**

    ```
    php artisan key:generate
    ```

4. **Copy the .env.example file to .env.**

    You can do this using the `copy` command on Windows or `cp` command on Unix-like systems (Linux, MacOS):

    - On Windows:
        ```
        copy .env.example .env 
        ```

    - On Unix-like systems:
        ```
        cp .env.example .env 
        ```

5. **Set up your database connection**

    Open the `.env` file and set up your database connection parameters.

6. **Run the database migrations and seed the database:**

    ```
    php artisan migrate --seed
    ```

## User Credentials

The application is seeded with the following user credentials:

- **Regular User:**
    - Email: `regular@example.com`
    - Password: `password`

- **Group Admin:**
    - Email: `groupadmin@example.com`
    - Password: `password`

- **Super Admin:**
    - Email: `superadmin@example.com`
    - Password: `password`

**Please remember to change these default credentials in a production environment.**
