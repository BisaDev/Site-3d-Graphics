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


##Maniak Recruitment
###Settings
- Current mail recipient: hector@maniak.com.mx (config/mail.php)
- Current Positions (on DB and validated back/front end): __['3d', 'backend', 'design', 'frontend',]__

###Set Position
Steps:

1). Create a new Endpoint Route on backend, within "position" route group, on file: __routes/api.php__ and fulfill all the Position Data:

```php
<?php
//..

//Positions API Group
Route::group(['prefix' => 'positions'], function() {
    Route::get('backend', function() {
        return [
            'is_dark' => true,
            'hero_color' => 'rgba(0,0,0,1)',
            'hero_image' => '/head_bg.png',
            'bgImage' => '/img/recruitment/maniak_bg.png',
            'position' => 'backend',
            'position_desc' => 'Back-end developer',
            'phrase' => 'we\'re looking for you.',
            'subtitle' => 'Join the Maniak family! 😍',
        ];
    });
});

//..
```
- That's it, Position data will be display on your custom route:
    * {domain}/positions/:position:
        * {domain}/positions/backend
        * {domain}/positions/frontend
        * {domain}/positions/whatever

- Route: *recruitment* outputs the data to display on the position.