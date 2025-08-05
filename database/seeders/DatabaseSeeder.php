<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(BadgeSeeder::class);
        // $this->call(CategorySeeder::class);

        $this->call(PostAuthorSeeder::class);
        $this->call(PostCategorySeeder::class);
        $this->call(PostContentSeeder::class);
        
        $this->call(MasterSeeder::class);
        $this->call(InventorySeeder::class);
        $this->call(TreatmentSeeder::class);

        $this->call(DemoSeeder::class);
    }
}
