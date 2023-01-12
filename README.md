# PHP Execrise for TP

## This is uses Docker to run the laravel project, you can use laravel sail or you can use the docker-compose file

### How to run

Copy the .env.example to .env and add the rapyd api key

```

RAPID_API_KEY=your_api_key

```

Run the docker

```

docker-compose up -d

```

or

```

./vendor/bin/sail up -d

```

### How to run the test

```

docker-compose exec app php artisan test

```

or

```

./vendor/bin/sail test

```
