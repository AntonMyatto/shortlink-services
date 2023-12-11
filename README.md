### Установка:

1. Выполнить `git clone https://github.com/AntonMyatto/shortlink-services.git`
2. Выполнить `cp .env.example .env` (создание конфигурационного файла и дальнейшего его заполнения)
3. Выполнить `php artisan key:generate` (генерация ключа приложения)
4. Выполнить `php artisan migrate` и `php artisan db:seed` для заполнения данных в бд
4. Использовать базовые доступы из Seed-ов для входа в админ-панель

