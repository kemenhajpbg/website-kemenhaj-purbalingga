<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@kemenhaj.local'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'),
            ],
        );

        $this->call([
            SiteContentSeeder::class,
            NewsSeeder::class,
            HajjStatSeeder::class,
            OfficeProfileSeeder::class,
            GallerySeeder::class,
            OfficialSeeder::class,
        ]);
    }
}
