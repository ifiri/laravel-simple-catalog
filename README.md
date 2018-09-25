# laravel-simple-catalog
Simple products catalog based on Laravel

Чтобы собрать приложение, выполнить

   composer install

Продукты обновляются раз в день, по расписанию. Я построил приложение так, что для обновления нужно либо настроить крон, либо запустить вручную команду

  php artisan schedule run

Перед использованием приложения нужно развернуть БД и выполнить миграции.
  
  php artisan migrate
  
Кроме того, чтобы корректно собрать фронт, необходимо выполнить

   npm install
   npm run dev
