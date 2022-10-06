<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class CreateRolesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create-roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command create roles';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $roles =['Admin','User'];
        foreach ($roles as $role) {
            Role::create(['name'=>$role]);
        }
        return 0;
    }
}
