# Laravel Application with Docker

This is a Laravel application containerized with Docker, including Nginx, MySQL, Redis, and phpMyAdmin.

## Prerequisites

- Docker Desktop (or Docker Engine with Docker Compose)
- Git (optional, for cloning the repository)

## Getting Started

### 1. Clone the repository (if not already done)
```bash
git clone <repository-url>
cd <project-directory>
```

### 2. Environment Setup

1. Copy the example environment file and update it with your configuration:
   ```bash
   cp .env.example .env
   ```

2. Update the following environment variables in the `.env` file:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=db
   DB_PORT=3306
   DB_DATABASE=laravel_db
   DB_USERNAME=laraveluser
   DB_PASSWORD=laravelpass
   
   REDIS_HOST=redis
   ```

### 3. Build and Start Containers

Navigate to the Docker directory, and run the following command to build and start all the containers:

```bash
docker-compose up -d --build
```

This will start the following services:
- Laravel application (PHP-FPM)
- Nginx web server
- MySQL database
- phpMyAdmin
- Redis

### 4. Install Dependencies

Run Composer install inside the app container:

```bash
docker-compose exec app composer install
```

### 5. Generate Application Key

```bash
docker-compose exec app php artisan key:generate
```

### 6. Run Database Migrations

```bash
docker-compose exec app php artisan migrate --seed
```

## Accessing the Application

- **Web Application**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081
  - Username: root
  - Password: rootpassword

## Stopping the Application

To stop all containers:

```bash
docker-compose down
```

To stop and remove all containers, networks, and volumes:

```bash
docker-compose down -v
```

## Development

### Running Artisan Commands

Run any Artisan commands using:

```bash
docker-compose exec app php artisan <command>
```

### Viewing Logs

View application logs:

```bash
docker-compose logs -f app
```

View Nginx logs:

```bash
docker-compose logs -f webserver
```

## Environment Variables

| Variable | Description | Default |
|----------|-------------|---------|
| `DB_HOST` | Database host | `db` |
| `DB_PORT` | Database port | `3306` |
| `DB_DATABASE` | Database name | `laravel_db` |
| `DB_USERNAME` | Database user | `laraveluser` |
| `DB_PASSWORD` | Database password | `laravelpass` |
| `REDIS_HOST` | Redis host | `redis` |

## Troubleshooting

- If you encounter permission issues, run:
  ```bash
  docker-compose exec app chown -R www-data:www-data /var/www/html/storage
  docker-compose exec app chmod -R 775 /var/www/html/storage
  ```

- To rebuild the containers:
  ```bash
  docker-compose down -v
  docker-compose up -d --build
  ```

## License

This project is open-source and available under the [MIT License](LICENSE).
