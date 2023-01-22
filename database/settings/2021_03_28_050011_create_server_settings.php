<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateServerSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('server.cd_garage', false);
    }
}
