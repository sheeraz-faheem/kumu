## INSTRUCTIONS
1. Run `docker-compose up -d`
2. Run `docker ps`, copy CONTAINER ID
3. Run `docker exec -it <CONTAINER ID> sh`
4. Run `composer install`
5. Run `cp .env.example .env`
6. Run `php artisan serve --host=0.0.0.0`

Navigate to `http://localhost:8000`