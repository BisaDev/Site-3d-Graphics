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


##Maniak Recruitment
###Settings
- Current mail recipient: hector@maniak.com.mx (config/mail.php)
- Current Positions (on DB and validated back/front end): __['3d', 'backend', 'design', 'frontend',]__
- Important to add Mailgun as mail driver in .env file, check .env.example for reference

###Set Position
Steps:

1). Add a new file to app/Positions in json format. You can copy one already there as an example
2). The file name defines the URL and the name the vacancy will be stored in the DB 

- That's it, Position data will be display on your custom route:
    * {domain}/positions/:position:
        * {domain}/positions/backend
        * {domain}/positions/frontend
        * {domain}/positions/whatever

- Route: *recruitment* outputs the data to display on the position.