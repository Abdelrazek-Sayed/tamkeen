# steps to setup the project

# 1- run command    docker compose up -d --build  to start docker containers

# you will find the project run on port localhost:8008 and php my admin on localhost:6001

# 2- craete .env file

# 3- add DB_DATABASE, DB_USERNAME , DB_PASSWORD

# 4- then run docker compose exec app composer install

# 5- then run docker compose exec app php artisan key:generate

# 6- run docker compose exec app php artisan migrate --seed

# to run migartions and seeders with factories for users and posts as dummy data

# you can login by google only change the GOOGLE_CLIENT_ID and  GOOGLE_CLIENT_SECRET in env file

# you can login by email or phone or with google

# you will find the timeline page user can see other users posts and commnt them

# and only can delete or update his posts

# you can find the delete posts archieve in dropdown  and can hard delete them

# the app supports two langs ar and en by laravel macamara package

# and can store posts with two langs using spatie package

