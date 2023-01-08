## Instruction

PostMan contracts <a href="https://api.postman.com/collections/4168227-ea0991a4-946d-4fd0-9770-caf790f0a0fe?access_key=PMAT-01GP8KFRTA3Z2ERPA9W6Q9PE9X">here</a>

Use it with the "Import" button in the Postman.

I use php-open-source-saver/jwt-auth as JWT auth package.<br/>

Instruction:
- cp .env.example .env
- docker-compose up --build -d
- docker exec uny_fpm_1 composer install
- php artisan jwt:secret
- php artisan jwt:generate-certs
- docker exec uny_fpm_1 php artisan migrate
- docker exec uny_fpm_1 php artisan db:seed --class=InterestSeeder

And you are ready to use API with Postman.
1. Register - will create a new user in DB.
2. Login - will login current user and return the bearer token, 
which we store in the UNY Environment at the tests step: https://prnt.sc/UhWSmDITQFv_
3. Now you can check if it works with ME (/api/auth/me) request
4. Now you can interact with CRUD for interests
