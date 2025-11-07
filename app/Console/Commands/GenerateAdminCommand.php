<?php

namespace App\Console\Commands;

use App\Enums\AdminStatus;
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
        $admins = [
            [
                'first_name' => 'root',
                'last_name' => 'main',
                'email' => 'root@gmail.com',
                'password' => Hash::make('123456789'),
                'status' => AdminStatus::ACTIVE,
            ],
            [
                'first_name' => 'Ali',
                'last_name' => 'Ahmadi',
                'email' => 'ali@gmail.com',
                'password' => Hash::make('password123'),
                'status' => AdminStatus::ACTIVE,
            ],
            [
                'first_name' => 'Sara',
                'last_name' => 'Moradi',
                'email' => 'sara@gmail.com',
                'password' => Hash::make('password456'),
                'status' => AdminStatus::ACTIVE,
            ]
        ];

        foreach ($admins as $admin) {
            Admin::create($admin);
        }

        $this->components->success('All admins created successfully ✅');

    }
}
