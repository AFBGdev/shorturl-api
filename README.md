# SHORTURL API

## Run project

### .env file

Duplicate the `.env.example` file and set the database variables

```
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

### MySQL service

You need to run the MySQL service. This project includes a `docker-compose.yml` file, which you can use to run the service. Run this command:
```
  docker compose up -d
```