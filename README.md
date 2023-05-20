
# Imageny
Simple image hosting service powered by Laravel & Inertiajs & Vuejs.

## Prerequisites
* To run this project, you must have PHP 8.1 installed.
* You should set up a host on your web server for your local domain.

## Installation

### Step 1

Begin by cloning this repository to your machine, and installing all Composer & NPM dependencies.

```bash
git clone git@github.com:bibrokhim/imageny.git
cd imageny && composer install && npm install && npm run build
```

### Step 2
Copy .env.example file to .env file.

```
cp .env.example .env
```

### Step 3
Create a database and set database connection values in the .env file.


### Step 4
Then you should generate an application key, run the migrations and create a symbolic link to storage folder.
```
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
```

### Step 5
Next, boot up a server and visit app. If using a tool like Laravel Valet, of course the URL will default to `http://imageny.test`.

Default credentials to login:
```
Email: admin@example.com
Password: e882ef307f20
```

You can change email and password on users page.

## Configuration
You can change default image sizes and encoding formats in configuration file ``config/image.php``.
Supported encoding formats: https://image.intervention.io/v2/api/encode