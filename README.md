## Документация

Для начало переходим в корневую директорию проэкта и запускаем команду для создания env файла  
```
cp .env.example .env
```

Затем поднимаем докер

```
docker-compose up
```

Далее заходим в контейнер php, проводим миграцию 
```
docker exec -it  test_php_1  /bin/bash    

php artisan migrate
```

Далее можно перейти на страницу http://localhost:8080/plots 

Апи http://localhost:8080/api/v1/get-plots?cadastral_numbers=69:27:0000022:1306,69:27:0000022:1307 .
