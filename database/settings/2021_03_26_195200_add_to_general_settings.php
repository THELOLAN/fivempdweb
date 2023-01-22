<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class AddToGeneralSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.footer_copyright', '© 2021 Nightstudios. Alle Rechte vorbehalten');
    }
}
