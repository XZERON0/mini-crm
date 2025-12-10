# Mini CRM
> Если вы в **Vs Code-е**, то для просмотра .md нажмите ``CTRL + SHIFT + V`` или так же можете просмотреть через **Obsidian**

Здравствуйте! Выполнил ТЗ в соответствии с этим [документом](https://docs.google.com/document/d/1ScnYAJtrW042AFFaarB1SEn4VDTFFsShos9wflyxI6A/edit?tab=t.0). 

## Стэк
Какой стэк был тут использован: так это laravel 12 (PHP), tailwind, vite, Postgresql, Javascript


## Запуск
Тут есть есть два варианта запуска проекта: с докером и без

### Без докера 
1. Для начала, вам следует изменить окружение, дабы оно соответствовало под ваше 
устройство (имею ввиду про бд) в файле [env](.env), где:
   ```.env
   DB_CONNECTION=pgsql
   DB_HOST=localhost
   DB_PORT=7101
   DB_DATABASE=test
   DB_USERNAME=postgres
   DB_PASSWORD=alter0zero
   ```
2. Поменять на ваши настройки, например sqlite (рекомендую), или прочее
3. Так же вам необходимо будет установить зависимости, это важная часть:
    ```bash
    composer install
    ```
    Так же необходимо будет установить npm, без него не будет работать tailwind (Да, я его скомпилировал, но все же):
    ```bash
    npm install
    npm run build 
    ```
4. Запустить миграцию в консоле\терминале:
   ```bash
   php artisan migrate
   ```
5. Запустить сидеры:
   ```bash
   php artisan db:seed
   ```
   > Конечно, вы так же можете просмотреть **фабрики**, **сидеры**, **миграции** и **модели**, вот все [фабрики](database/factories/) и так же [сидеры](database/seeders/) и [миграции](database/migrations/), [модели](app/Models/). 

Вроде все основное я уже перечислил, теперь остается лишь запустить сам проект.

Запускается он конечно через:
```bash 
php artisan serve
```

Документацию по api в можете увидеть [нажав вот сюда](./swagger.yaml) и так же по другим (просто ссылки на файлы/директории):
1. [Контроллеры](app/http/Controllers/)
2. [Репозитории](app/Repositories/)
3. [Сервисы (Логика)](app/Services/)
4. [Request](app/http/Requests/)
5. [Resourse](app/http/Resources/)
6. [Виджет](./resources/views/widget/form.blade.php)
7. [Маршруты](./routes/)

А, да, чуть не забыл, чтобы проверить виджет на встраивания, я создал [простой html файл](./test-widgate.html) <-для перехода кликните, которые отправляет запрос прямиком туда, работает так же и файл. Правда с докером не работает, а именно файл, а так все в порядке. 

### С докером
Перед началом, конечно же нужно будет установить зависимости и так же скомпилировать tailwind стили:
```bash
composer install
npm i # ну или так же install
npm run dev
```
Тут достаточно одной команды как:
```bash
docker-compose up --build
```

далее вам необходимо будет зайти в контейнер под названием "**php**":
```bash
docker exec -it php bash
php artisan migrate
php artisan db:seed
exit
```
Необязательно, но для проверки можете так же выполнить:
```bash
docker exec -it db bash
psql -p 5432 -U postgres -d test # пароль: alter0zero
\dt # выводит список таблиц
exit
```

## В итоге
Я надеюсь, что вы высоко оцените мою кандидатуру и так же мои навыки, не смотря мою не зрелость и недостаток опыта. Сам я laravel изучил совсем недавно, да и php я знаю всего пару тройку недель. Так же я знаю и другие ЯП (Языки программирования) и фреймворки, это python, javascript, java, lua (база), bash, c# и dart (правда в обоих языка подзабыл как там), про фреймворки: django, flutter, spring, laravel, symfony, vue. Хорошо владею linux cli (тот же bash), github actions, docker (более менее), git, tailwind, vite, хотя большинство тут я изучил совсем недавно (github actions, linux cli, vite, tailwind). В общем, буду ждать от вас вестей. Если что извините, если я как то в readme мог бы грубо или нагло прозвучить. 