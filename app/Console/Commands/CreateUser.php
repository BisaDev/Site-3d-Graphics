<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

/**
 * Class CreateUser
 * @package App\Console\Commands
 */
class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mnk:create-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a user.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->line(PHP_EOL.'Fulfill User data:');
        $name = $this->ask('Name');
        $email =  $this->ask('Email');
        $password = $this->secret('Password');

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
            'remember_token' => str_random(10),
        ];

        try {
            $user = User::create($data);
            $user->save();
            $this->info('User ID('.$user->id.'): '.$user->username.' has been created successfully!');
        } catch (\Exception $e) {
            $this->error('Something went wrong!');
            dd($e->getMessage());
        }
    }
}
