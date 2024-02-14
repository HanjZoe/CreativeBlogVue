# Блог на laravel

##  <a id="title1">При создании использовались  </a>

PHP 7.4.33

mariadb 10.8

nmp 10.2.3

##  <a id="title2">Порядок действий  </a>
Переименовать .env.example в .env

В .env настроить подключение к базе данных

Выполнить следующие команды

```
composer install

nmp install 

npm run dev 

php artisan key:generate

php artisan optimize

php artisan storage:link

php artisan migrate 

php artisan db:seed
    
    Создаются 2 пользователя 
    
    email: admin@admin.kz
    пароль: password
    роль: Админ
    
    email: user@user.kz
    пароль: password
    роль: Читатель
    
php artisan serve 

php artisan queue:work
```

