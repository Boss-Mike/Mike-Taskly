# Mike Taskly - Laravel Task Management System

A Laravel-based task management system built with Docker for easy deployment and development.

## 🚀 Features

- **Task Management**: Create, read, update, and delete tasks
- **Laravel Framework**: Built with Laravel 8.x
- **Dockerized**: Fully containerized application for consistent environments
- **Database**: MySQL database for data persistence
- **Web Interface**: Clean and responsive web interface

## 📋 Prerequisites

Before you begin, ensure you have the following installed on your system:

- [Docker](https://www.docker.com/get-started) (version 20.0 or higher)
- [Docker Compose](https://docs.docker.com/compose/install/) (version 2.0 or higher)
- Git (for cloning the repository)

## 🏗️ Project Structure

```
Mike Taskly/
├── app/                    # Laravel application logic
├── config/                 # Laravel configuration files
├── database/              # Database migrations, seeders, factories
├── docker/                # Docker configuration files
│   ├── docker-compose.yml # Docker Compose configuration
│   ├── Dockerfile         # Docker image definition
│   └── nginx/             # Nginx configuration
├── public/                # Public web assets
├── resources/             # Views, CSS, JS resources
├── routes/                # Application routes
├── storage/               # Laravel storage
├── vendor/                # Composer dependencies
├── .env                   # Environment variables
├── composer.json          # PHP dependencies
└── artisan                # Laravel CLI tool
```

## 🛠️ Installation & Setup

### 1. Clone the Repository

```bash
git clone https://github.com/Boss-Mike/Mike-Taskly.git
cd Mike-Taskly
```

### 2. Environment Configuration

The application comes with a pre-configured `.env` file. The key database settings are:

```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=ltms
DB_USERNAME=ltms
DB_PASSWORD=ltms@1214.com
```

**Note**: The `DB_HOST=db` must match the database service name in Docker Compose.

### 3. Build and Run with Docker Compose

Navigate to the docker directory and build the application:

```bash
# Navigate to docker directory
cd docker

# Build and start all services
docker-compose up -d --build
```

This command will:
- Build the Laravel application Docker image
- Start the MySQL database container
- Start the Laravel application container
- Set up networking between containers

### 4. Verify Installation

Check that all containers are running:

```bash
docker-compose ps
```

You should see:
- `ltms-container` (Laravel app)
- `ltms-mysql-container` (MySQL database)

## 🌐 Accessing the Application

Once the containers are running, access your application at:

**Main Application**: [http://localhost:8081](http://localhost:8081)

### Available Routes:
- **Home Page**: `http://localhost:8081/task`
- **Create New Task**: `http://localhost:8081/task/create`
- **Task Management**: Full CRUD operations available through the web interface

## 🐳 Docker Commands

### Starting the Application
```bash
# Start all services in background
docker-compose up -d

# Start with logs visible
docker-compose up

# Build and start (useful after code changes)
docker-compose up -d --build
```

### Stopping the Application
```bash
# Stop all services
docker-compose down

# Stop and remove volumes (⚠️ this will delete database data)
docker-compose down -v
```

### Viewing Logs
```bash
# View all logs
docker-compose logs

# View logs for specific service
docker-compose logs app
docker-compose logs db

# Follow logs in real-time
docker-compose logs -f
```

### Accessing Containers
```bash
# Access Laravel app container
docker exec -it ltms-container bash

# Access MySQL database
docker exec -it ltms-mysql-container mysql -u ltms -p
```

## 🔧 Development Workflow

### Making Code Changes

1. **Application Code**: Edit files in `app/`, `resources/`, `routes/`, etc.
2. **Database Changes**: 
   - Add migrations in `database/migrations/`
   - Run migrations: `docker exec ltms-container php artisan migrate`
3. **Dependencies**: 
   - Update `composer.json`
   - Rebuild container: `docker-compose up -d --build`

### Laravel Artisan Commands

Run Laravel commands inside the container:

```bash
# Generate application key
docker exec ltms-container php artisan key:generate

# Run migrations
docker exec ltms-container php artisan migrate

# Clear cache
docker exec ltms-container php artisan cache:clear

# Create a new controller
docker exec ltms-container php artisan make:controller TaskController
```

## 🗃️ Database

### Database Configuration
- **Engine**: MySQL 5.7
- **Database Name**: `ltms`
- **Username**: `ltms`
- **Password**: `ltms@1214.com`
- **Host**: `db` (internal Docker network)
- **Port**: `3306`

### Database Access
```bash
# Connect to MySQL from host machine
mysql -h localhost -P 3306 -u ltms -p

# Or access via Docker container
docker exec -it ltms-mysql-container mysql -u ltms -p ltms
```

## 🚨 Troubleshooting

### Common Issues

1. **Port Already in Use**
   ```bash
   # Check what's using port 8081
   netstat -ano | findstr :8081
   
   # Stop the process or change port in docker-compose.yml
   ```

2. **Container Build Fails**
   ```bash
   # Clean Docker cache and rebuild
   docker system prune -f
   docker-compose build --no-cache
   ```

3. **Database Connection Issues**
   - Ensure `DB_HOST=db` in `.env` file
   - Check if database container is running: `docker-compose ps`
   - Restart containers: `docker-compose restart`

4. **Permission Issues**
   ```bash
   # Fix Laravel storage permissions
   docker exec ltms-container chmod -R 775 storage
   docker exec ltms-container chmod -R 775 bootstrap/cache
   ```

### Logs for Debugging
```bash
# Application logs
docker-compose logs app

# Nginx access logs
docker exec ltms-container tail -f /var/log/nginx/access.log

# PHP-FPM logs
docker exec ltms-container tail -f /var/log/php7/error.log
```

## 🔄 Updating the Application

1. **Pull latest changes**:
   ```bash
   git pull origin master
   ```

2. **Rebuild containers**:
   ```bash
   docker-compose down
   docker-compose up -d --build
   ```

3. **Run any new migrations**:
   ```bash
   docker exec ltms-container php artisan migrate
   ```

## 📝 Additional Notes

- The application uses **port 8081** to avoid conflicts with other services
- All Laravel files are mounted as volumes for development
- The `vendor/` directory is excluded from volume mounts for performance
- Database data persists in Docker volumes between container restarts

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature-name`
3. Make your changes
4. Test with Docker: `docker-compose up -d --build`
5. Commit your changes: `git commit -am 'Add feature'`
6. Push to the branch: `git push origin feature-name`
7. Submit a pull request

## 📄 License

This project is licensed under the MIT License.

---

**Need Help?** If you encounter any issues, please check the troubleshooting section or create an issue in the repository.
