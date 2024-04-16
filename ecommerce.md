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

# SETUP REQUIRED MODELS AND DATABASES FOR ECOMMERCE

    Products        1:M      Cart_items   Product  1:M   Product_images  
    
    Categories      1:M      Products   
    Brands          1:M      Products  
    Cart_items      
    users           1:M    Cart_items    Users  1:M   Cart_items    Users  1:M   Orders
    user_addresses
    Orders           1:M    Order_items
    Orders           1:1    Payments

    Categories   : 1
        .id
        .name
        .slug
        .created_at
        .updated_at


     Brands  : 2
        .id
        .name
        .slug
        .created_at
        .updated_at

    Products    : 3
        .id
        .title
        .slug
        .quantity
        .price
        .inStock
        .published
        .description
        .user_id
        .brand_id
        .category_id
        .created_at
        .updated_at
    
    Product_Images : 4
        .id
        .product_id
        .image/avatar
        .created_at
        .updated_at
    
    Cart_items  : 9
        .id
        .product_id
        .quantity
        .created_at
        .updated_at     
    
    Users : 5
        .id
        .emai
        .password
        .isAdmin
        .created_at
        .updated_at 

    User_Addresses : 6
        .id
        .user_id
        .address1
        .address2
        .type
        .zipcode
        .city
        province
        .country
        .ismain(It is the main address or not)
        .created_at
        .updated_at

    Orders  : 7
        .id
        .user_id
        .total_price
        .status
        .session_id  - (stripe api)
        .user_id_address_id
        .created_at
        .updated_at


    Orders_items : 8
        .id
        .product_id
        .order_id
        .quantity
        .unite_price
        .created_at
        .updated_at 

    Payments : 10
        .id
        .order_id
        .user_id
        .amount
        .status (Paid, Pending ,Upaid)
        .created_at
        .updated_at 

# SHOW PRODUCTS LISTS IN ADMIN DASHBOARD
    https://flowbite.com/blocks/application/advanced-tables/
    - Make AdminSeeder
        php artisan make:seeder AdminSeeder
        php artisan make:seeder BrandSeeder
        php  artisan make:seeder CategorySeeder
        php  artisan make:seeder ProductSeeder
        php  artisan db:seed 
        php  artisan migrate:fresh --seed 

    - Instll slug package

    - Setup the Side navigation on admin dashbaord
    - Create Product  Controller route

    - Show the product in index.
        
# ADD PRODUCT WIITH MULTIPLE IMAGES 1
    https://element-plus.org/en-US/component/upload.html
    https://element-plus.org/en-US/guide/quickstart.html
    https://element-plus.org/en-US/component/dialog.html
    https://inertiajs.com/manual-visits
    npm install element-plus --save

          modified:   app/Http/Controllers/Admin/ProductController.php
            modified:   app/Http/Middleware/HandleInertiaRequests.php
            modified:   app/Models/Brand.php
            modified:   app/Models/Category.php
            modified:   app/Models/Product.php
            modified:   app/Models/ProductImage.php
            modified:   ecommerce.md
            modified:   package-lock.json
            modified:   package.json
            modified:   resources/js/Pages/Admin/Products/ProductList.vue
            modified:   resources/js/Pages/Admin/components/sidebar.vue
            modified:   resources/js/app.

# ADD PRODUCT WITH MULTIPLE IMAGES 2
        https://element-plus.org/en-US/component/upload.html
         modified:   app/Http/Controllers/Admin/ProductController.php
        modified:   ecommerce.md
        modified:   resources/js/Pages/Admin/Products/ProductList.vue

# MODERN ECOMMERCE : LARAVEL VUEJS INERTIA.JS AND TAILWINDSCSS
    https://flowbite.com/docs/components/avatar/
    -- need to show the category insteadd of numbers in ui
        <td class="px-4 py-3">{{ product.category_id}}</td> TO
        <td class="px-4 py-3">{{ product.category.name}}</td>
        <td class="px-4 py-3">{{           {{ product.inStock}}}}</td>
    - load the relationship in Prodduct Cponttroller
    - https://flowbite.com/docs/components/buttons/
            pulished button

                 modified:   app/Http/Controllers/Admin/ProductController.php
                modified:   ecommerce.md
                modified:   resources/js/Pages/Admin/Products/ProductList.vue
                modified:   routes/web.php

    







