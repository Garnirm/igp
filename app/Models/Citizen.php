<?php

namespace App\Models;

use App\Enums\CitizenSexe;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $id_card
 * @property string $lastname
 * @property string $firstname
 * @property null|string $birthdate
 * @property null|array<string,string> $birth_location
 * @property CitizenSexe $sexe
 * @property null|string $nationality_acquisition_location
 * @property null|string $nationality_acquiered_at
 * @property null|string $nationality_given_by
 * @property bool $alive
 * @property null|string $death_date
 * @property string $fullname_first
 */
class Citizen extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'firstname', 'lastname', 'sexe', 'city_id',
    ];

    protected $casts = [
        'birth_location' => 'array',
        'sexe' => CitizenSexe::class,
    ];

    protected $table = 'citizen';

    /**
     * @return BelongsTo<City,$this>
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}