aj laravel
===

#deployment with docker

run `docker-compose -f docker/docker-compose.yaml up`


# refresh db
in docker container `aj_laravel` run `php:artisan migrate:fresh`

#題目一

`get 127.0.0.1/login` 題目一，登入/註冊頁

`get 127.0.0.1/home` 題目一，登入後頁面

#題目二
in docker container `aj_laravel`

add `* * * * * php /var/www/html/artisan schedule:run >> /dev/null 2>&1` to crontab and run `crond`
