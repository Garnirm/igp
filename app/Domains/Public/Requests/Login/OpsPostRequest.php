<?php

namespace App\Domains\Public\Requests\Login;

use App\Http\Requests\BaseRequest;

class OpsPostRequest extends BaseRequest
{
    /**
     * @return array<string,array<string>>
     */
    public function rules(): array
    {
        return [
            'email' => [ 'required', 'string' ],
            'password' => [ 'required', 'string' ],
        ];
    }
}
