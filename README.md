# Comment box for Bitdegree

Simple, reusable and robust comment box made with Laravel, Vue and Scss

## Getting Started

These instructions will get you a copy of the project up and running on your local machine.

### Prerequisites

PHP 7.1
 
Composer

Node.js


### Installing

navigate to cloned project

```
cd ~/challenge-fullstack
```

create .env file

```
cp .env.example .env (or rename manually and don't forget to set correct connection)
```
Install php dependencies

```
composer install
```

Install javascript dependencies

```
npm install
```

Generate key

```
php artisan key:generate
```
Migrate database and seed

```
php artisan migrate --seed
```


Create symlink

```
php artisan storage:link
```


Set up server:

```
php artisan serve
```


Interface is user friendly just check it out, no explanation is needed http://localhost:8000

### About comment-box component

Component takes 2 props: `route_name` and `user`.

`route_name` should be used as ID string, if you use the same id on different pages, you'll get the same comment box

`user` should be used as boolean to restrict or allow users to post

### About codebase

I did my best to make code maintainable by separating concerns. Controllers are about 2 lines long. Also, 
in order to make code readable I used PSR-12 coding standart. I tried to made my code robust by validating data 
using FormRequests, handing common errors and using modular approach while making style.


### In addition

I added profile page in order to let anyone change their default photo to desired new one
