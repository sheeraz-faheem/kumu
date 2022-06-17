Requirement: Docker Desktop
## INSTRUCTIONS
1. Run `docker-compose up -d`
2. Run `docker ps`, copy CONTAINER ID
3. Run `docker exec -it <CONTAINER ID> sh`

### First time runnning only
4. Run `composer install`
5. Run `cp .env.example .env`
6. Run `php artisan migrate`

### Start php development server
8. Run `php artisan serve --host=0.0.0.0`

Navigate to `http://localhost:8000`

## Optional
Add Github Personal Access Token on .env if request limit is reached.
GITHUB_PAT=token


## API Routes
via POSTMAN Collection: https://www.getpostman.com/collections/ebec70c6d27c27b76450

    POST /api/register

    {
        "name": "Sheeraz Faheem",
        "email": "sfm@yopmail.com",
        "password": "123qwe",
        "c_password": "123qwe"
    }

    POST /api/login

    {
        "email": "srfaheem07@gmail.com",
        "password": "123qwe"
    }

    GET /api/user
    GET /api/github/users
    GET /api/hd?a=1&b=4