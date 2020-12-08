<?php

use App\Models\Partner;
use App\Models\User;
use Illuminate\Database\Seeder;

class PartnersTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $partner1 = Partner::create([
            'name' => 'Partner1'
        ]);
        $partner2 = Partner::create([
            'name' => 'Partner2'
        ]);


        $partner1->articles()->createMany([
            [
                'title' => 'Partner1 Article1'
            ],
            [
                'title' => 'Partner1 Article2'
            ]
        ]);

        $partner2->articles()->createMany([
            [
                'title' => 'Partner2 Article1'
            ],
            [
                'title' => 'Partner2 Article2'
            ]
        ]);

        User::where('name', 'Partner1 User')->firstOrFail()->partners()->sync([$partner1->id]);
        User::where('name', 'Partner2 User')->firstOrFail()->partners()->sync([$partner2->id]);
        User::where('name', 'Both Partners User')->firstOrFail()->partners()->sync([$partner1->id, $partner2->id]);

    }
}
