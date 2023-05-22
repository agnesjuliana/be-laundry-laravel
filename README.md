
# Laundy Chasier - Back-end Laravel

Another case from final project in my third year. This is the backend part. This one is the laravel version from the study case. There is also another version from this case using nodejs. Please search be-laundry-node if you want to know more. 
## Environment Variables

This project using the default folder template from laravel. So you can edit environtment variable in file .env. Just copy and rename the .env.example or simply run

```bash
  php artisan key:gen
```

## Deployment
After preparing the environtment variable, now install the depedencies. (Make sure your set up is ready for laravel installation. Reference to their documentation, cuz I only provide the minimum step)

```bash
  composer update
  composer install
```

Make database with same name as you write in the .env file. Now, you can run the migration to build your table in database. (For this project, I didn't provide seeder for data. So you need to make your own user to access the authentication. Don't forget to encryp your password using md5)

```bash
php artisan migrate
```

Now the magic begin

```bash
php artisan serve
```

## API Reference
Nah, just reference the API by postman (Cuz I'm too rushed to move the environtment)

[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/11708290-7c9feff6-3865-40fe-aced-239108032805?action=collection%2Ffork&collection-url=entityId%3D11708290-7c9feff6-3865-40fe-aced-239108032805%26entityType%3Dcollection%26workspaceId%3Db8082477-685c-4add-8d56-64f1c34ecbdc#?env%5Bphp%5D=W3sia2V5IjoicGhwLXNlcnZlciIsInZhbHVlIjoiIGh0dHA6Ly8xMjcuMC4wLjE6ODAwMCIsImVuYWJsZWQiOnRydWUsInR5cGUiOiJkZWZhdWx0In0seyJrZXkiOiJiZWFyZXItdG9rZW4iLCJ2YWx1ZSI6IiIsImVuYWJsZWQiOnRydWUsInR5cGUiOiJzZWNyZXQifSx7ImtleSI6ImJlYXJlci10b2tlbiIsInZhbHVlIjoiIiwiZW5hYmxlZCI6ZmFsc2UsInR5cGUiOiJkZWZhdWx0In1d)
