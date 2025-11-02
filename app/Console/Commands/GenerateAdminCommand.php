<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class GenerateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       Admin::create([
           'first_name'=>'admin',
           'last_name'=>'admin.admin',
           'email'=>'admin@gmail.com',
           'password'=>Hash::make(123456789),
           'status'
       ]);

       $this->components->success('admin successfully created');

    }
}
