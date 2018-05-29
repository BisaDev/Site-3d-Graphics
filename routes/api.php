<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::name('api')->prefix('v1')->group(function () {
    Route::resource('users', 'Api\v1\UserController');
    Route::get('user', 'Api\v1\UserController@userInfo')->name('users.userInfo');
    Route::resource('projects', 'Api\v1\ProjectsController');
    Route::get('project/{id}/next', 'Api\v1\ProjectsController@getNextProject')->name('projects.getNextProject');
    Route::get('project/{slug}', 'Api\v1\ProjectsController@showBySlug')->name('project.bySlug');
    Route::resource('areas', 'Api\v1\AreasController');
    Route::get('getConfigModels', 'Api\v1\ProjectsController@getConfigModels')->name('project.configModels');

    Route::post('apply', 'Api\v1\ProfileController@store')->name('apply');
    Route::get('thanks-gif', function () {
        $dir = 'img/gifs';
        $gifs = \Illuminate\Support\Facades\File::allFiles(public_path(DIRECTORY_SEPARATOR.$dir));
        $gif = asset($dir.DIRECTORY_SEPARATOR.$gifs[array_rand($gifs, 1)]->getFilename());

        return response()->json(['success' => true, 'gif' => $gif]);
    })->name('thanks');

    //Positions API Group
    //@todo replace this with a Resource (based on Position Model)
    Route::group(['prefix' => 'positions'], function() {

        //@todo Default 404 when no route is match
        Route::get('{position}', function() {
            abort(404);
        })->where(['position' => '^(?!(fullStack|backend)).*']);

        Route::get('fullStack', function() {
            return [
                'is_dark' => true,
                'hero_color' => 'rgba(0,0,0,1)',
                'hero_image' => '/head_bg.png',
                'bgImage' => '/img/recruitment/maniak_bg.png',
                'position' => 'fullStack',
                'position_desc' => 'Full Stack developer',
                'phrase' => 'we\'re looking for you.',
                'subtitle' => 'Join the Maniak family! 😍',

                'abstract' =>
                    '<p>Based in Guadalajara since 2010, MANIAK is a mexican company motivated to generate a change through Software Development tailored to the specific needs of our clients. Our team is composed of a mix of amazingly creative and talented people. Our strength? Being part of the growth of our customers with developments of the best quality.</p>'. PHP_EOL .
                    '<p>In Maniak we are different. We believe in responsibility and we trust each one of our collaborators, for that reason we have a flexible schedule in which, as long as you fulfill your day/week activities, the schedules does not matter.</p>'. PHP_EOL .
                    '<p>We also believe in communication both among the members of the same team and other areas. We support the feedback and strengthen the opportunity areas of each one for their professional and personal growth.'. PHP_EOL ,

                //About the job
                //'salary' => '$20,000.00',

                'details' => [
                    'jobtitle' => 'Full stack developer',
                    'location' => 'Guadalajara, Mx.',
                    'experience' => '3+ years',
                    'required language' => 'English',
                    'position type' => 'Full time',
                ],

                'requirements' => [
                    'responsibilities 📌.' => [
                        'items' => [
                            'You will develop the web applications using PHP or Python as a backend language and Javascript.',
                            'You will create concepts, realization, and testing of user features',
                            'Analyze and propose solutions for use cases (user stories).',
                            'You will design and implement the general app architecture that includes: Models / Migrations, Seeders, Routers, Authentication and Domain Logic',
                        ],
                        'columns' => 2
                    ],

                    'ideal skills 🔍.' => [
                        'items' => [
                            'Experience working with relational SQL databases',
                            'Experience with distributed caches such as Redis or Memcached.',
                            'Experience with one of the following frameworks: Laravel, Django and/or Rails',
                            'Experience developing Php and/or Python',
                            'Understanding of modern web apps architecture',
                            'Knowledge of programming principles: SOLID, DRY, decorators',
                            'Experience LESS / SASS',
                            'Strong experience with vanilla JS',
                            'An agile mindset and the ability to adapt to changing priorities and requirements',
                            'Ability to learn fas',
                            'Experience using git in a collaborative project',
                            'Knowledge of common git commands and the ability to manage and fix conflicts.',
                        ],
                        'columns' => 2,
                    ],

                    'extras 👏.' => [
                        'items' => [
                            'Startup experience',
                            'Wordpress Development',
                        ],
                        'columns' => 2,
                    ],

                    'work environment 🎮.' => [
                        'items' => [
                            'Our office is located near from UVM Campus & the Akron Stadium, is made up by 50 members in administrative staff, developers, designers and managers.',
                            'We like keeping things casual, that\'s why we often have bbq\'s & beers in our own front yard or go to the "alitas" every now and then after work. Also, we have cold beverages like sodas and beers, coffee and tea that you can have anyday, anytime, as long as we don\'t empty the fridge.',
                        ],
                        'columns' => 1,
                    ],
                ],

                'perks' => [
                    [
                        'icon' => '🍻',
                        'description' => 'BBQ\'s and beer in our front yard'
                    ],
                    [
                        'icon' => '🧦',
                        'description' => 'Homeoffice'
                    ],
                    [
                        'icon' => '🍼',
                        'description' => 'Cold beverages anytime'
                    ],
                    [
                        'icon' => '🛋',
                        'description' => 'Flexible schedule'
                    ],
                ],

                /*
                'message' => [
                    '' => 'Are you ready to make a difference?',
                    '' => 'We don\'t discriminate by race, color, gender, weight, height or anything else. Maniak is committed to a culture that embraces diversity and inclusion.',
                ]
                */
            ];
        });

        Route::get('frontend', function() {
            return [
                'is_dark' => true,
                'hero_color' => 'rgba(0,0,0,1)',
                'hero_image' => '/head_bg.png',
                'bgImage' => '/img/recruitment/maniak_bg.png',
                'position' => 'frontend',
                'position_desc' => 'Front-end developer',
                'phrase' => 'we\'re looking for you.',
                'subtitle' => 'Join the Maniak family! 😍',

                'abstract' =>
                    '<p>Based in Guadalajara since 2010, MANIAK is a mexican company motivated to generate a change through Software Development tailored to the specific needs of our clients. Our team is composed of a mix of amazingly creative and talented people. Our strength? Being part of the growth of our customers with developments of the best quality.</p>'. PHP_EOL .
                    '<p>In Maniak we are different. We believe in responsibility and we trust each one of our collaborators, for that reason we have a flexible schedule in which, as long as you fulfill your day/week activities, the schedules does not matter.</p>'. PHP_EOL .
                    '<p>We also believe in communication both among the members of the same team and other areas. We support the feedback and strengthen the opportunity areas of each one for their professional and personal growth.'. PHP_EOL ,

                //About the job
                'salary' => '$20,000.00',

                'details' => [
                    'jobtitle' => 'Front-end developer',
                    'location' => 'Guadalajara, Mx.',
                    'experience' => '3+ years',
                    'required language' => 'English',
                    'position type' => 'Full time',
                ],

                'requirements' => [
                    'responsibilities 📌.' => [
                        'items' => [
                            'You will develop the front-end using Javascript, HTML CSS, and ideally Frameworks, such as ReactJs and Vuejs.',
                            'You will create concepts, realization, and testing of user interface, as well as - adaptation to different devices.',
                            'Analyze and propose solutions for use cases (user stories).',
                            'You will create the markup and styles of a component to a high quality standard, following strict design guidelines.',
                        ],
                        'columns' => 2
                    ],

                    'ideal skills 🔍.' => [
                        'items' => [
                            'Elevate sense of design and user experience.',
                            'Ability to think long term and avoid "hacky" solutions.',
                            'Basic PHP or Python knowledge.',
                            'Experience with responsive design.',
                            'Experience with Js frameworks (React, Vue, Angular)',
                            'Experience consuming a REST API.',
                            'Experience with build tools such as webpack, grunt, gulp.',
                            'Awareness of cross-browser compatibility issues and client-side performance considerations.',
                            'Knows what a web worker is.',
                            'ADA compliance knowledge.',
                            'Experience creating the structure / organization of style files with reduced scope.',
                            'Experience with advanced SASS / LESS control structures.',
                            'Ability to extract variables, colors and standards from a design file and put it into code.',
                            'Experience using ECMAScript 6.'
                        ],
                        'columns' => 2,
                    ],

                    'extras 👏.' => [
                        'items' => [
                            'Experience using Server Side Rendering.',
                            'Experience with state management (vuex, redux).',
                        ],
                        'columns' => 2,
                    ],

                    'work environment 🎮.' => [
                        'items' => [
                            'Our office is located near from UVM Campus & the Akron Stadium, is made up by 50 members in administrative staff, developers, designers and managers.',
                            'We like keeping things casual, that\'s why we often have bbq\'s & beers in our own front yard or go to the "alitas" every now and then after work. Also, we have cold beverages like sodas and beers, coffee and tea that you can have anyday, anytime, as long as we don\'t empty the fridge.',
                        ],
                        'columns' => 1,
                    ],
                ],

                'perks' => [
                    [
                        'icon' => '🍻',
                        'description' => 'BBQ\'s and beer in our front yard'
                    ],
                    [
                        'icon' => '🧦',
                        'description' => 'Homeoffice'
                    ],
                    [
                        'icon' => '🍼',
                        'description' => 'Cold beverages anytime'
                    ],
                    [
                        'icon' => '🛋',
                        'description' => 'Flexible schedule'
                    ],
                ],

                /*
                'message' => [
                    '' => 'Are you ready to make a difference?',
                    '' => 'We don\'t discriminate by race, color, gender, weight, height or anything else. Maniak is committed to a culture that embraces diversity and inclusion.',
                ]
                */
            ];
        });
    });
});
