<?php

namespace App\Console\Commands;

use App\Enums\CitizenSexe;
use App\Models\Citizen;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RegisterCitizens extends Command
{
    protected $signature = 'register:citizens';

    public function handle(): int
    {
        $citizens = json_decode(File::get(storage_path().'/igp/data/citizens.json'), true);

        Citizen::query()->forceDelete();

        foreach ($citizens as $citizen) {
            $citizen_model = new Citizen();
            $citizen_model->id_card = $citizen['id_card'];
            $citizen_model->lastname = $citizen['lastname'];
            $citizen_model->firstname = $citizen['firstname'];
            $citizen_model->birthdate = $citizen['birthdate'];
            $citizen_model->birth_location = $citizen['birth_location'];
            $citizen_model->sexe = CitizenSexe::{ $citizen['sexe'] };
            $citizen_model->nationality_acquisition_location = $citizen['nationality_acquisition_location'];
            $citizen_model->nationality_acquiered_at = $citizen['nationality_acquiered_at'];
            $citizen_model->nationality_given_by = $citizen['nationality_given_by'];
            $citizen_model->alive = $citizen['alive'];
            $citizen_model->death_date = $citizen['death_date'];
            $citizen_model->fullname_first = $citizen['firstname'].' '.$citizen['lastname'];
            $citizen_model->save();
        }

        return Command::SUCCESS;
    }
}
