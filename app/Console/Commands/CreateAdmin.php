<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user with administrative privilige';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Enter name: ');

        while (true) {

            $password = $this->secret('Enter password: ');
            $passwordConfirmation = $this->secret('Confirm password: ');

            if ($password === $passwordConfirmation) {
                break;
            } else {
                $this->error('Password do not match. Please try again.');
            }
        }

        $email = $this->ask('Enter email: ');

        while (! $this->validateEmail($email)) {
            $this->error('Invalid email address. Please provide a valid email address!');
            $email = $this->ask('Enter email:');
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
            'role' => 'admin',
        ]);

        $this->info('User created!');
    }

    private function validateEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
}
