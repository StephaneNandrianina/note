<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AleaController;
use App\Http\Controllers\ChiffreAffaireController;
use App\Http\Controllers\ConfigurationNoteController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\DatabaseResetController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\import\ConfigurationNoteImportController;
use App\Http\Controllers\import\NoteImportController;
use App\Http\Controllers\MagasinController;
use App\Http\Controllers\MoyenneEtudiantSemestreController;
use App\Http\Controllers\PointDeventeController;
use App\Http\Controllers\ReinitialisationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('profilAdmin.loginAdmin');
});

Route::get('/reset-database', [DatabaseResetController::class, 'resetDatabase'])->name('reset-database');

//Import
Route::get('/toImportConfigurationNote', [ConfigurationNoteImportController::class, 'toFileImportConfigurationNote'])->name('toImportConfigurationNote')->middleware('admin');
Route::post('/importConfigurationNote', [ConfigurationNoteImportController::class, 'importConfigurationNote'])->name('importationConfigurationNote');

Route::get('/toImportNote', [NoteImportController::class, 'toFileImportNote'])->name('toImportNote')->middleware('admin');
Route::post('/importNote', [NoteImportController::class, 'importNote'])->name('importationNote');


//Admin
Route::get('/versLogin', [AdminController::class, 'versLogin'])->name('admin.versLogin')->middleware('admin');
Route::post('/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/logoutAdmnin', [AdminController::class, 'logout'])->name('admin.logout')->middleware('admin');

Route::get('/showSaisi', [AdminController::class, 'getAllEtudAndMatiere'])->name('show.saisinote')->middleware('admin');
Route::get('/insertNote', [AdminController::class, 'insertNote'])->name('saisi.note')->middleware('admin');

Route::get('/showFiltreEtudiant', [AdminController::class, 'getAllPromotion'])->name('show.filtrage')->middleware('admin');
Route::get('/listeEtudiantt', [AdminController::class, 'recherche'])->name('filtrer.etudiant')->middleware('admin');

Route::get('/listeSemestre/{idetudiant}/{idsemestre}', [AdminController::class, 'listeSemestre'])->name('liste.semestre')->middleware('admin');

Route::get('/moyenne/{idetudiant}/{idsemestre}', [MoyenneEtudiantSemestreController::class, 'moyenne'])->name('liste.moyenne')->middleware('admin');

Route::get('/releve/{idetudiant}/{idsemestre}',[AdminController::class, 'releveDeNote'])->name('releve.r')->middleware('admin');

Route::get('/notes-etudiant/{etudiantId}/{semestreId}', [AdminController::class, 'show'])->name('notes-etudiant');

Route::get('/configurationnote', [ConfigurationNoteController::class, 'index'])->name('configurerNote');
Route::put('/configurationnote/{id}', [ConfigurationNoteController::class, 'update'])->name('configurationnote.update');

Route::get('/semestres', [AdminController::class, 'afficherSemestres'])->name('semestres.index');
Route::get('/etudiants/{semestreId}', [AdminController::class, 'listeEtudiantsParSemestre'])->name('etudiants.liste');

// test
Route::get('/test-verification', [AdminController::class, 'testVerification']);

//Etudiant
Route::get('/versLoginEtu', [EtudiantController::class, 'versLoginEtu'])->name('etudiant.versLogin')->middleware('etudiant');
Route::post('/loginEtu', [EtudiantController::class, 'login'])->name('etudiant.login')->middleware('etudiant');
Route::get('/test', [EtudiantController::class, 'test'])->name('test')->middleware('etudiant');

Route::get('/listeSem',[EtudiantController::class, 'listeSemestre'])->name('listesemestre.l')->middleware('etudiant');

Route::get('/etudiants/{etudiantId}/semestres/{semestreId}/matieres-ajounees', [AdminController::class, 'listerMatieresAjourees'])->name('matieres.ajounees');

Route::get('/montrer', [AleaController::class, 'selectall'])->name('montrer.saisinote')->middleware('admin');
Route::get('/insertionn', [AleaController::class, 'insertForMatiereAndPromotion'])->name('insertionn.saisinote')->middleware('admin');


