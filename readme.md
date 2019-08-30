## Core package: laravel-gentelella modified

![Gentelella Bootstrap Admin Template](https://wiki.smu.edu.sg/is480/img_auth.php/thumb/1/14/JPP_MAINWIKI.png/900px-JPP_MAINWIKI.png "IS480 - JOBPLUSLUS")

**[Template Demo](https://colorlib.com/polygon/gentelella/index.html)**

/!\ The home page on laravel-gentelella is empty and not like the demo /!\

## Framework: Laravel 5.4

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

### Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs/5.4).


# Setting Up Environment

## Step 1

### With GIT
Clone git repository

With Git SSH
```
git clone git@github.com:FlorientR/laravel-gentelella.git
```

Or with HTTPS
```
git clone https://github.com/FlorientR/laravel-gentelella.git
```

Go to the project folder 
```
cd laravel-gentelella
```

Update composer 
```
composer update
```

### With Composer
```
composer create-project florientr/laravel-gentelella MyProject
```

## Step 2
Copy ```.env.example``` file to ```.env```

For Unix
```
cp .env.example .env
```
For Windows
```
copy .env.example .env
```

Next, run this follow commands

!! YOU NEED TO INSTALL NODE.JS FOR USE NPM !! 

For install all NPM package

```
npm install
```

Or for install just minimal package

```
npm install --global bower gulp
npm install gulp
npm install laravel-elixir
```

And then, run this commands

```
php artisan key:generate
bower install
gulp
```

Configure your ```.env``` file and run :
```
php artisan migrate
```

###UPDATE 2.0

Add auth support !

**WARNING** : For auth support, configure your ```.env``` file with ```database``` and ```smtp``` connection !


You are ready for a new Laravel 5.4 application with Gentelella template !!

