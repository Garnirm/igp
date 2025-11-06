<?php

use Illuminate\Support\Facades\Log;

/**
 * @param array<int|string,mixed> $params
 */
function log_user_error(array $params): void
{
    /** @var non-empty-string $json */
    $json = json_encode($params);

    Log::channel('user_error')->info($json);
}