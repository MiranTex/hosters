# Hoster List API

## Introduction

**Project Description:**
Hoster List API is a web application that allows users to filter and view a list of hosting options. The backend is built with Laravel, providing a RESTful API, while the frontend is developed using Next.js. Each part runs in a separate Docker container.

**Documentation Purpose:**
This documentation provides a comprehensive guide to setting up, installing, and using the application, including details on API endpoints, data structures, and system requirements.

## Stack
- Laravel 11
- Nextjs 14.2.4

## Requirements

**Required Software:**
- Docker
- Docker Compose
- Git

**System Prerequisites:**
- Operating System: Linux, macOS, or Windows 10/11 with WSL2

## Configuration and Installation

### Clone the Repository
```bash
git clone https://github.com/MiranTex/hosters
cd your-repo
```

### RUN docker containers
If you want to direct access to the backend pelase expose the port 8000 in the docker-compose.yml in the backend service.
```bash
docker compose up -d
```


## API
There are two endpoits that are being consumed by the front end
The api will be versioned, so the v1 means the verison 1, so if we need to chenge to new versions the clients can still consume this first version.

### /api/v1/filters
IT provides the set of actual filter values that exists in the database to be rendered in the frontend.the filter return data with this structure:
```json
    [
        "locations",
        "ram",
        "hddTypes",
        "storages"
    ]
```

### /api/v1/hosters
That return a list of hosters paginated, and capable to receive queryparam to perform filters.
The list has this format:

```php
    [
        "data" => [
            "*" => [
                "model",
                "ram",
                "location",
                "storage",
                "price"
            ],
        ],

        "meta infos about pagination"
    ]
```

## Tests

To run test please run:
```bash
sudo docker container exec -it hosters-backend php artisan test
```

## Possible troubles

### Permission deny
To control the session and some frameworks logs the laravel may need some specific permissions on a folder, so if you face one of them pelase run 

```bash
docker container exec -it hosters-backend chmod -R 777 ./path_to_the_folder
```