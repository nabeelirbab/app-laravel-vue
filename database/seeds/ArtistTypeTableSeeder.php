<?php

use Illuminate\Database\Seeder;

class ArtistTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();
        DB::table('artist_types')->insert([
            [
                'created_at' => $now,
                'updated_at' => $now,
                'name' => 'Record label',
            ],
            [
                'created_at' => $now,
                'updated_at' => $now,
                'name' => 'Producer',
            ],
        ]);
    }
}
