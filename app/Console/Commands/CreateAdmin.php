<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\Notification;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user with role Admin';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = new User();
        $user->name = 'admin';
        $user->email = 'inbox.semenov@gmail.com';
        $user->city = 'Kiev';
        $user->password = Hash::make('sLamUB4sDYhLuRdU');
        $user->save();

        $role = new Role();
        $role = $role::find(1);

        $role->users()->save($user);

        $notification = new Notification();
        $notification->user_id = $user->id;
        $notification->save();

        echo "Admin was created" . PHP_EOL;
    }
}