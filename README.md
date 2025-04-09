# Logistic Application

A comprehensive logistics management system built with Laravel, featuring order tracking, freight calculation, and blog management capabilities.

## Features

-   **Order Management**

    -   Create and track orders
    -   Real-time order status updates
    -   Order history tracking
    -   Unique tracking IDs for each order

-   **Freight Calculator**

    -   Calculate shipping costs based on:
        -   Distance
        -   Weight
        -   Carrier type (Air, Ocean, Road)
    -   Customizable rate settings
    -   Instant quote generation

-   **Blog Management**

    -   Create and manage blog posts
    -   Categorize posts (Popular/Regular)
    -   Image upload support
    -   Rich text content

-   **Admin Dashboard**

    -   Secure authentication
    -   Order management interface
    -   Blog post management
    -   Calculator settings management
    -   Contact form submissions

-   **User Features**
    -   Order tracking
    -   Quote requests
    -   Contact form
    -   Blog reading

## Requirements

-   PHP >= 8.0
-   Composer
-   Node.js & NPM
-   SQLite (default) or MySQL
-   Web server (Apache/Nginx)

## Installation

1. Clone the repository:

```bash
git clone https://github.com/Jim-devENG/Logistic-Application.git
cd Logistic-Application
```

2. Install PHP dependencies:

```bash
composer install
```

3. Install Node.js dependencies:

```bash
npm install
```

4. Create environment file:

```bash
cp .env.example .env
```

5. Generate application key:

```bash
php artisan key:generate
```

6. Configure database:

    - For SQLite (default):
        ```bash
        touch database/database.sqlite
        ```
    - For MySQL:
        - Update .env file with your database credentials

7. Run migrations:

```bash
php artisan migrate
```

8. Compile assets:

```bash
npm run dev
```

9. Start the development server:

```bash
php artisan serve
```

## Usage

### Admin Access

1. Visit `/login` to access the admin panel
2. Create an account using the sign-up form
3. Log in with your credentials

### Order Management

1. Create new orders through the quote form
2. Track orders using the tracking ID
3. Manage orders through the admin dashboard

### Blog Management

1. Access blog management through admin dashboard
2. Create new posts with images
3. Categorize posts as needed

### Freight Calculator

1. Access calculator settings in admin panel
2. Set rates for:
    - Per kilometer
    - Per kilogram
    - Air freight
    - Ocean freight
    - Road freight

## API Endpoints

The application provides the following REST API endpoints:

-   `GET /api/blogs` - Get all blog posts
-   `GET /api/blogs/{id}` - Get specific blog post
-   `GET /api/authors` - Get all authors

## Security Features

-   CSRF protection on all forms
-   Form validation with detailed error messages
-   Secure file upload handling with type validation
-   Password hashing using Laravel's built-in hashing
-   Session-based authentication
-   Input sanitization
-   SQL injection prevention through Laravel's query builder
-   XSS protection through Laravel's escaping

## Deployment

### Production Setup

1. Set environment variables:

    ```
    APP_ENV=production
    APP_DEBUG=false
    ```

2. Optimize the application:

    ```bash
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    ```

3. Compile assets for production:
    ```bash
    npm run production
    ```

### Server Requirements

-   PHP 8.0 or higher
-   MySQL 5.7+ or SQLite 3
-   Apache/Nginx web server
-   mod_rewrite enabled (Apache)
-   SSL certificate (recommended)

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Support

For support, please open an issue in the GitHub repository or contact the maintainers.

## Acknowledgments

-   Laravel Framework
-   Bootstrap
-   jQuery
-   All contributors and maintainers
