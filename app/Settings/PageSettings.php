<?php

use \Spatie\LaravelSettings\Settings;

class PageSettings extends Settings
{

    public bool $civilian_database;
    public bool $vehicle_database;
    public bool $law_books;
    public bool $managment_center;
    public bool $instructions;
    public bool $bolo;
    public bool $investigations;
    public bool $trainings;
    public bool $officer;
    public bool $logs;
    public bool $role;

    public static function group(): string
    {
        return 'page';
    }
}
