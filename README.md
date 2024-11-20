# SHORTURL API

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
FRONT_ALLOWED_URL=""
```