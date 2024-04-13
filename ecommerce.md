# MULTIPLE AUTHENTICATION AND ADMIN DASHBOARD  USER INTERFACE
    . Breeze
     . Use miggration
         $table->boolean('isAdmin');
     .Run php artisan migrate:fresh    
    .  Add new Route
    . Create admin Middlwarre
        php artisan make:middleware AdminMiddleware
        php artisan make:middleware redirectAdmin
    php artisan make:controller Admin/AdminAuthController
        
            modified:   app/Http/Controllers/Auth/AuthenticatedSessionController.php
            modified:   bootstrap/app.php
            modified:   database/migrations/0001_01_01_000000_create_users_table.php
            modified:   package-lock.json
            modified:   package.json
            modified:   resources/js/Pages/Dashboard.vue
            modified:   routes/web.php
            modified:   tailwind.config.js

                app/Http/Controllers/Admin/
                app/Http/Middleware/AdminMiddleware.php
                app/Http/Middleware/RedirectAdmin.php
                ecommerce.md
                resources/js/Pages/Admin/
