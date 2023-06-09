# Welcome to the Marvel Heroes Project!

## This project were created to practice Laravel and Vue.js. 
These are a few things worked with in this project:
- API
- PSR
- Commands
- Migrations
- PHP Unit Tests
- Git!
- Vue Components


**Prerequisites:**
- PHP 8.2
- npm installed
  

## Please follow the instructions below to start your project.

1) Download the repository

2) Open the terminal in the main directory of the project, then run  `composer install`

3) Run `npm install`

4) Create an .env file based on the .env.example and set up your DB connections. Also generate the key with the command: `php artisan key:generate`

5) Access https://developer.marvel.com/account and create a pair of keys to work with the API

6)  In .env file, place your MARVEL_PUBLIC_KEY and MARVEL_PRIVATE_KEY

7) Run `php artisan app:run-all-migrations`. This command will create the database (if not exists), tables and load marvel data

8) Open two terminals and run both commands: `php artisan serve` and `npm run dev`, then go take a look at the project page!

9) *Optional:* you can run the php unit tests by running the command `php artisan test`
