## About backendtask

-   Crud operation in employee resource
-   Crud operation in companies resource
-   Store the image field within storage folder.
-   Use yajra to list either companies and employees
-   drop down to filter employees according to company

# How to Run

-   clone the repository

```
git clone https://github.com/Mostafa-Shawky2021/backend-task project-app && cd project-app
```

-   install composer dependencies

```
composer install
```

-   Config env variables and database credentials

```
mv .env.example .env
```

-   Generate application key

```
php artisan key:generate
```

-   Create Symbolic link for image storage

```
php artisan storage:link
```

-   Migrate database , make sure you configure database source and credentials

```
php artisan migrate
php artisan db:seed
```

-   install npm dependencies

```
npm install && npm run dev
```

-   Serve the application

```
php artisan serve
```
