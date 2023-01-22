<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreatePageSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('page.civilian_database', true);
        $this->migrator->add('page.vehicle_database', true);
        $this->migrator->add('page.law_books', true);
        $this->migrator->add('page.managment_center', true);
        $this->migrator->add('page.instructions', true);
        $this->migrator->add('page.bolo', true);
        $this->migrator->add('page.investigations', true);
        $this->migrator->add('page.trainings', true);
        $this->migrator->add('page.officer', true);
        $this->migrator->add('page.logs', true);
    }
}
