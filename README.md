<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Instalation
Clone the repository

    git clone git@github.com:ErlinaNovita/PokeBot.git OR git clone https://github.com/ErlinaNovita/PokeBot.git

Switch to the repo folder

    cd PokeBot

Install all the dependencies using composer

    composer install
    Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Generate a new JWT authentication secret key

    php artisan jwt:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone git@github.com:gothinkster/laravel-realworld-example-app.git
    cd laravel-realworld-example-app
    composer install
    cp .env.example .env
    php artisan key:generate
    php artisan jwt:generate 
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve


## Environment variables

`.env` - Environment variables can be set in this file
[which can be customized as needed] :
- DB_CONNECTION
- DB_HOST
- DB_PORT
- DB_DATABASE
- DB_USERNAME
- DB_PASSWORD

## php.ini

```
- do a search for the following 2 keywords: 
*extension=pdo_pgsql*
*extension=pgsql*
```

```
- into this : 
extension=php_pdo_pgsql.dll
extension=pdo_sqlite
extension=php_pgsql.dll
```

## Add and custom some item 

- open direktori:\foldername\database\migrations\2014_10_12_000000_create_users_table.php
- add and custom function up like this :
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('id');
            $table->string('name');
            $table->timestamps();
        });
    }
    
## Controller

- create controller into folder direktori:\foldername\app\Http\Controllers\
- insert function get list like this :
    `public function list()
    `{
        `$user = User::query()->get();
        `return response()->json($user);
    `}
- insert function create & validation for like this :
    `public function create(Request $request)
    {
        `$validated = $request->validate([
            `'id' => 'required',
            `'name' => 'required',
        `]);

        $user = User::query()->where('id', $request->id)->get()->first();

        if($user){
            return $user->update([
                'name' => $request->name
            ]);
        } else {
            return User::create([
                'id' => $request->id,
                'name' => $request->name
            ]);
        }
    }`

## api.php

- open file direktori:\foldername\routes\api.php
- change Route::prefix into this :
    `Route::prefix('pokebot')->group(function () {
        `Route::post('/register', 'App\Http\Controllers\RegisterAndListController@create');
        `Route::get('/user', 'App\Http\Controllers\RegisterAndListController@list');
    `});
    
## Procfile

- add file with no extension, and give the file a name = "Procfile" 
