<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BoloController;
use App\Http\Controllers\CivilianController;
use App\Http\Controllers\ControlCenterController;
use App\Http\Controllers\CronjobController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\InstructionController;
use App\Http\Controllers\InvestigationController;
use App\Http\Controllers\LawController;
use App\Http\Controllers\PenaltyController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\USerController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes(['register' => false]);

Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/einrichtung', [IndexController::class, 'empty'])->name('empty');
Route::post('/einrichtung/absenden', [IndexController::class, 'postData']);

Route::get('/run/cronjob', [CronjobController::class, '_run']);

Route::group(['middleware' => ['auth', 'settings']], function () {
    //Route::get('/role/{role}/permission/{permissionName}', [IndexController::class, 'checkPermission']);
    Route::get('/einstellungen/abrufen', [SettingController::class, 'index']);
    Route::post('/einstellungen/allgemein/speichern', [SettingController::class, 'saveGeneral']);
    Route::get('/einstellingen/seiten/abrufen', [SettingController::class, 'getSites']);
    Route::post('/einstellungen/seiten/aktualisieren', [SettingController::class, 'updateSites']);
    Route::get('/einstellungen/server/abrufen', [SettingController::class, 'getServer']);
    Route::post('/einstellungen/server/aktualisieren', [SettingController::class, 'updateServer']);

    Route::view('/', 'index')->name('index');
    Route::get('/getData', [IndexController::class, 'getData']);
    Route::get('/sidebar/daten', [IndexController::class, 'sidebar']);
    Route::get('/getUser', [IndexController::class, 'getUser']);
    Route::post('/status/ändern', [IndexController::class, 'toggleStatus']);
    Route::get('/dashboard', [IndexController::class, 'dashboard']);
    Route::post('/passwort/ändern', [IndexController::class, 'password']);

    Route::get('/einwohnerdatenbank/daten', [CivilianController::class, 'index']);

    Route::post('/einwohnerdatenbank/suchen', [CivilianController::class, 'search']);
    Route::get('/einwohnerdatenbank/eintrag/erstellen', [CivilianController::class, 'create']);
    Route::post('/einwohnerdatenbank/fahndung/ausrufen', [CivilianController::class, 'sendBolo']);
    Route::post('/einwohnerdatenbank/lizenz/entfernen', [CivilianController::class, 'removeLicense']);
    Route::post('/einwohnerdatenbank/eintrag/{entry}/löschen', [CivilianController::class, 'deleteEntry']);
    Route::get('/einwohnerdatenbank/{civilian}/abrufen', [CivilianController::class, 'show']);
    Route::post('/einwohnerdatenbank/{civilian}/eintrag/erstellen', [CivilianController::class, 'createEntry']);

    Route::post('/fahrzeugdatenbank/suchen', [VehicleController::class, 'search']);
    Route::get('/fahrzeugdatenbank/daten', [VehicleController::class, 'index']);

    Route::get('/gesetze/daten', [LawController::class, 'index']);
    Route::post('/gesetze/speichern', [LawController::class, 'store']);
    Route::get('/gesetze/{law}/löschen', [LawController::class, 'destroy']);
    Route::get('/gesetze/{law}/daten', [LawController::class, 'edit']);
    Route::post('/gesetze/{law}/aktualisieren', [LawController::class, 'update']);

    Route::get('/leitstelle/daten', [ControlCenterController::class, 'index']);
    Route::post('/leitstelle/zurücksetzen', [ControlCenterController::class, 'resetLeitstelle']);
    Route::post('/leitstelle/übernehmen', [ControlCenterController::class, 'takeLeitstelle']);
    Route::post('/leitstelle/abgeben', [ControlCenterController::class, 'giveLeitstelle']);
    Route::post('/leitstelle/erstellen', [ControlCenterController::class, 'store']);
    Route::post('/leitstelle/officer/einteilen', [ControlCenterController::class, 'classifyUser']);
    Route::post('/leitstelle/{control_center}/zurücksetzen', [ControlCenterController::class, 'resetArea']);
    Route::post('/leitstelle/{control_center}/löschen', [ControlCenterController::class, 'destroy']);

    Route::get('strafkatalog/daten', [PenaltyController::class, 'index']);
    Route::post('/strafkatalog/speichern', [PenaltyController::class, 'store']);
    Route::get('/strafkatalog/{strafkatalog}/daten', [PenaltyController::class, 'edit']);
    Route::post('/strafkatalog/{strafkatalog}/aktualisieren', [PenaltyController::class, 'update']);
    Route::post('/strafkatalog/{strafkatalog}/löschen', [PenaltyController::class, 'destroy']);

    Route::get('dienstanweisungen/daten', [InstructionController::class, 'index']);
    Route::post('dienstanweisungen/erstellen', [InstructionController::class, 'store']);
    Route::get('dienstanweisungen/{instructions}/daten', [InstructionController::class, 'edit']);
    Route::post('dienstanweisungen/{instructions}/aktualisieren', [InstructionController::class, 'update']);
    Route::post('dienstanweisungen/{instructions}/löschen', [InstructionController::class, 'destroy']);

    Route::get('fahndungen/daten', [BoloController::class, 'index']);
    Route::post('fahndung/{bolo}/stoppen', [BoloController::class, 'stopBolo']);

    Route::get('ermittlungen/daten', [InvestigationController::class, 'index']);
    Route::get('ermittlungen/aktiv', [InvestigationController::class, 'active']);
    Route::get('ermittlungen/inaktiv', [InvestigationController::class, 'inactive']);
    Route::post('ermittlungen/erstellen', [InvestigationController::class, 'create']);
    Route::post('ermittlungen/eintrag/{entry}/löschen', [InvestigationController::class, 'deleteEntry']);
    Route::get('ermittlungen/{investigation}/daten', [InvestigationController::class, 'show']);
    Route::post('ermittlungen/{investigation}/schließen', [InvestigationController::class, 'close']);
    Route::post('ermittlungen/{investigation}/eintrag/erstellen', [InvestigationController::class, 'createEntry']);
    Route::post('ermittlungen/{investigation}/löschen', [InvestigationController::class, 'destroy']);

    Route::get('ausbildungen/daten', [TrainingController::class, 'index']);
    Route::post('ausbildung/erstellen', [TrainingController::class, 'store']);
    Route::post('ausbildung/{training}/status', [TrainingController::class, 'status']);
    Route::post('ausbildung/{training}/löschen', [TrainingController::class, 'destroy']);
    Route::get('ausbildungen/{training}/daten', [TrainingController::class, 'show']);
    Route::get('ausbildungen/{training}/aktualisieren', [TrainingController::class, 'update']);
    Route::post('ausbildung/{training}/teilnehmen', [TrainingController::class, 'applyTraining']);
    Route::post('ausbildungen/{training}/status/ändern', [TrainingController::class, 'changeStatus']);
    Route::post('ausbildung/{training}/officer/{user}/löschen', [TrainingController::class, 'removeOfficer']);

    Route::get('officer/daten', [UserController::class, 'index']);
    Route::post('officer/speichern', [UserController::class, 'store']);
    Route::post('officer/{user}/löschen', [UserController::class, 'destroy']);
    Route::post('officer/{user}/aktualisieren', [UserController::class, 'update']);

    Route::get('rollen/daten', [RoleController::class, 'index']);
    Route::get('rollen/abrufen', [RoleController::class, 'getRoles']);
    Route::post('/rollen/erstellen', [RoleController::class, 'store']);
    Route::post('rollen/{role}/berechtigungen/zuweisen', [RoleController::class, 'assign']);
    Route::get('rollen/{role}/daten', [RoleController::class, 'edit']);
    Route::post('rollen/{role}/löschen', [RoleController::class, 'destroy']);
    Route::post('rollen/{role}/aktualisieren', [RoleController::class, 'updateRole']);
    Route::post('rollen/{role}/berechtigungen', [RoleController::class, 'update']);
    Route::post('rollen/{role}/berechtigung/{permission}/entfernen', [RoleController::class, 'removePermission']);

    Route::get('/{any}', [IndexController::class, 'index'])->where('any', '.*');
});
