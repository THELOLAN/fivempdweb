<?php


namespace App\Settings;


use Spatie\LaravelSettings\Settings;

class ServerSettings extends Settings
{

    public bool $cd_garage;

    public static function group(): string
    {
        return 'server';
    }
}
