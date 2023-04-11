<?php

namespace Database\Seeders;

use App\Models\DayModal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = [
            'sunday', 'monday', 'tuesday', 'wednesday','thursday','friday', 'saturday'
        ];
        foreach ($days as $day) {
            DayModal::create(['name' => $day]);
        }
    }
}
