<?php

namespace App\Domains\Public\Data;

use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Data;

class LoginOpsPostData extends Data
{
    public function __construct(
        #[Email()]
        public string $email,

        public string $password,
    )
    {
    }
}