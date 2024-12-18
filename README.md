# Quick Start - Innoscripta Case 


### Step by step
Clone this Repository
```sh
git clone https://github.com/Math2121/innoscripta-case innoscripta
```

Create the .env file
```sh
cd innoscripta/
cp .env.example .env
```


Update environment variables in .env
```dosini

DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync

```


Up containers
```sh
docker-compose up -d
```


Access the container
```sh
docker-compose exec app bash
```


Generate the Laravel project key
```sh
php artisan key:generate
```


Access the project
[http://localhost:9000](http://localhost:9000)

Access the documentation
[http://localhost:9000/api/documentation](http://localhost:9000/api/documentation)
