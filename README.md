# SHORTURL API

This project was deployed on Railway. Go to [https://shorturl-api-production.up.railway.app](https://shorturl-api-production.up.railway.app)

The Stack that I used in this project are:

- Laravel v11.32.0
- PHP v8.2.22
- Node v22.11.0
- PHPUnit

## Routes

- `/{slug}` = Redirects to the target url
- `/api/v1/...` = Api routes

## Run project

### Set .env file

Duplicate the `.env.example` and create the `.env` file, then set the database variables

```
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

To specify the front URL and avoid CORS policy errors, you must set the next env variable

```
// Ex:

FRONT_ALLOWED_URL="http://localhost:5173"
```

### Database

#### MySQL service

This project stores data into a MySQL database, so; you must to start a MySQL service. You can do this from third parties like XAMMP or an oline service, but I have included a `docker-compose.yml` file that you can use to start the MySQL service. Just run:

```
docker compose up -d
```

> **Note:** This file use your `.env` config to set the `MYSQL_ROOT_PASSWORD`, `MYSQL_DATABASE` and `PORT` image environment variables.

#### Build tables (Migrations)

To create the necessary tables, you can use the artisan command to buld them. Just run:

```
php artisan migrate
```

### 🚀 Start Server (Redirect service and API)

To start the server in your local environment, just run:

```
php artisan serve
```

## Test

There are some tests in this project using *PHPUnit*. To run these, just run:

```
php artisan test
```
