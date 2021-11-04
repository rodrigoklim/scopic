FullStack Developer Test

The steps necessaries to test the project are:

Backend

1) Git clone the repository.
2) Open terminal and access backend folder.
3) execute: composer install.
4) execute: alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'.
5) rename the file test.env to .env
6) execute: sail artisan migrate.
7) execute: sail artisan schedule:work
8) execute: sail artisan queue:listen
9) execute: sail up --build.
10) after initializing the container access http://localhost for once.

Frontend

1) Open terminal and access frontend folder.
2) execute: npm install.
3) execute: docker build -t dockerize-quasar .
4) execute: docker run -it -p 8000:80 — rm dockerize-quasar
5) after initializing the container access http://localhost:8080 and have fun!
