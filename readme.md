# MANIAK Website 2018

*You must feel honored to have access to this project.*

### Installation
- Run composer install
- Configure database credentials on the `.env` file
- Run migrations `php artisan migrate`

If are you using **Valet** the site should be available on http://maniak-website-2018.test/

For local development run:
`npm run watch`


##API Clients on Laravel Passport

Generate a API client by running:

```bash
php artisan passport:client --password
```

Create Oauth Keys

```bash
php artisan passport:keys

```

Enjoy!
