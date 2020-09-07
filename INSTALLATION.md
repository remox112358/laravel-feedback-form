# FeedbackForm
FeedbackForm - форма обратной связи сделанная с помощью фреймворка Laravel

## Установка
Пошаговая инструкция, для запуска среды разработки.

### Копирование
В первую очередь "скопируйте" данный проект к себе на компьютер с помощью команды
```
git clone https://github.com/remox112358/laravel-feedback-form.git
```

### Настройка
Переименуйте .env.example в .env, измените значения данных полей
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=feedback_form
DB_USERNAME=root
DB_PASSWORD="пароль от базы данных"

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME="email адрес"
MAIL_PASSWORD="пароль от email адреса"
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="email адрес"
MAIL_FROM_NAME=FeedbackForm

NOCAPTCHA_SITEKEY="ключ сайта (от reCAPTCHA)"
NOCAPTCHA_SECRET="секретный ключ (от reCAPTCHA)"
```

В config/app.php (опционально)
```
'timezone' => 'Желаемая временная зона (поддерживаемая php7)'
```

### Зависимости
Для установки зависимостей
```
composer install
```

А также
```
npm install
```

### Запуск
Генерируем уникальный ключ для приложения
```
php artisan key:generate
```

Инициализируем миграции (обязательно настройте подключение к БД в .env)
```
php artisan migrate
```

Запускам сиды (заполнение базы данных)
```
**Запуск всех сидов**
php artisan db:seed

**Запуск одного сида**
php artisan db:seed --class="название класса сида"

**Запуск сидов с обнулением данных в БД**
php artisan migrate:fresh --seed
```

Запускаем встроенный сервер для разработки
```
php artisan serve
```

Запускаем отслеживание изменений (в нашем случае компилирование sass)
```
npm run watch
```

### Конец
Данное руководство по установке в дальнейшем может дополниться



