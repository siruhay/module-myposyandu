<?php

namespace ModuleMyPosyandu\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->command->call('module:migrate', ['module' => 'MyPosyandu']);
        
        $this->call(MyPosyanduBaseSeeder::class);
        $this->call(MyPosyanduDataSeeder::class);
        $this->call(MyPosyanduUserSeeder::class);
    }
}
