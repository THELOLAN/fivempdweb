<?php

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{

    public string $site_name;

    public string $footer_copyright;

    public static function group(): string
    {
        return 'general';
    }
}
