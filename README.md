# How to deploy

Make sure the php version is at 8.0 and node is at v16.1.0

1. Install composer 
2. Install npm
3. copy .env.example and set the db connection
4. run php artisan migrate:fresh --seed
5. breeze is used for auth, here are the creds
    
    email: demo@test.com
    password: password

After seeding some dummy data will be populated. The CRUD is implemented for both Projects and Tasks