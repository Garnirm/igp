<?php

namespace App\Console\Commands;

use App\Models\Army\Establishment;
use App\Models\City;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RegisterEstablishments extends Command
{
    protected $signature = 'register:establishments';

    public function handle(): int
    {
        $entities = json_decode(File::get(public_path('entities.json')), true);

        foreach ($entities as $city => $establishments) {
            foreach (array_keys($establishments) as $establishment) {
                $e = Establishment::query()->where('name', $establishment)->firstOr(function () use ($establishment) {
                    $e = new Establishment();
                    $e->name = $establishment;

                    return $e;
                });

                $city_model = City::query()->where('name', $city)->first();

                if (is_null($city_model)) {
                    dd($city);
                }

                $e->city_id = $city_model->id;
                $e->save();
            }
        }

        return Command::SUCCESS;
    }
}