# URL Shortener

This is a simple URL shortening service built with Laravel. The project allows users to shorten long URLs and decode shortened URLs back to their original form. It includes functionality to handle URL encoding and decoding, along with robust testing to ensure the system works as expected.

## Steps Taken

1. **Created a new Laravel project**:

    ```bash
    laravel new shorten-url
    ```

2. **Created a model with a migration for `Urls`**:

    ```bash
    php artisan make:model -m Url
    ```

3. **Added routes for encoding and decoding** in `routes/web.php`.

4. **Fleshed out the migration file** by adding string columns for `original_url` and `short_code`. The `original_url` is unique to ensure that the same page is not stored with multiple short URLs, saving space.

5. **Added fillable properties and a function to generate a short code** in the `Url` model.

6. **Created controller methods** to handle the logic of encoding and decoding.

7. **Tested controller methods** and ensured they worked correctly.

8. **Fixed any bugs** that arose during testing.

9. **Wrote automated tests** for key functionalities.

10. **Ran tests** and ensured everything was functioning as expected.

## Challenges Faced and Solutions

### Problems Solved:

-   **Handling URLs with parameters**: URLs with parameters (e.g., `/decode/long-url-here`) were not properly handled when passed as a request parameter.  
    **Solution**: I fixed this by passing the URL as a query parameter, like `/decode?url=long-url-here`.

-   **Escaped slashes in JSON response**: The `url()` function escaped slashes in the JSON response, which made the output visually unappealing and harder to process.  
    **Solution**: I resolved this by adding the `JSON_UNESCAPED_SLASHES` option to the JSON response to prevent slashes from being escaped.

### Extra Thoughts:

-   **Redirect on shortened URL access**: The system could return a redirect to the original URL when accessing the shortened version. The need for this would depend on how the API is being consumed.
-   **Consistent data response**: I've chosen to always return the requested data along with the input data for consistency. This allows API consumers to verify and trust the response, although it might not be strictly necessary.
-   **Laravel boilerplate**: I did not begin with a starter kit but some base boilerplate remains. I only removed boilerplate Laravel code such as example tests where it was relevant for the purposes of this test.

## How to Run

### Clone the Project

First, clone the repository from GitHub:

```bash
git clone https://github.com/helirose/shorten-url.git
cd shorten-url
```

### Install Dependencies

Next, install the necessary PHP dependencies using Composer:

```bash
composer install
```

### Set Up the Database

Run the database migrations to set up the `Urls` table:

```bash
php artisan migrate
```

### Run the Application

Start the Laravel development server:

```bash
php artisan serve
```

The application will be available at `http://localhost:8000` by default.

### Running Tests

To run the automated tests, use the following command:

```bash
php artisan test
```

This will execute the test cases and show you the results in the terminal.
