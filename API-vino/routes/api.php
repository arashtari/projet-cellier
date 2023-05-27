<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use GuzzleHttp\Middleware;
use App\Http\Controllers\BouteilleController;
use App\Http\Controllers\CellierController;
use App\Http\Controllers\CellierBouteillesController;
use App\Http\Controllers\UsagerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// ------------------------------------------ Cellier
// Récupération de tous les celliers
Route::get('/celliers/{id}', [CellierController::class, 'getCelliers']);

// Récupération d'un cellier avec son id
Route::get('/cellier/{id}', [CellierController::class, 'getCellier']);

// Ajout d'un cellier
Route::post('/cellier', [CellierController::class, 'ajoutCellier']);

// Modification d'un cellier
Route::put('/cellier/{id}', [CellierController::class, 'modifierCellier']);

// Suppression d'un cellier
Route::delete('/cellier/{id}', [CellierController::class, 'effacerCellier']);


// ------------------------------------------ Bouteille
// Récupération des bouteilles avec id d'un cellier 
Route::get('/bouteilles/{id}', [BouteilleController::class, 'getBouteilles']);

// Récupération d'une bouteille avec son id 
Route::get('/bouteille/{id}', [BouteilleController::class, 'getBouteille']);

// Modification d'une bouteille
Route::put('/bouteille/{id}', [BouteilleController::class, 'modifierBouteille']);

// Suppression d'une bouteille
Route::delete('/bouteille/{id}', [BouteilleController::class, 'effacerBouteille']);


// Auto Complete Liste Bouteille
Route::post('/bouteilles/autocompleteBouteille', [BouteilleController::class, 'autocompleteBouteille']);


// ------------------------------------------ Cellier_bouteilles
// Récupérer les bouteilles d'un cellierà
Route::get('/cellier-bouteilles/{id}', [CellierBouteillesController::class, 'getCellierBouteilles']);

// Ajouter une bouteille à la quantité Cellier_bouteilles
Route::post('/cellier-bouteilles/{bouteille_id}/{cellier_id}/ajouter', [CellierBouteillesController::class, 'ajouterBouteilleQuantite']);

// Retirer une bouteille à la quantité Cellier_bouteilles
Route::post('/cellier-bouteilles/{bouteille_id}/{cellier_id}/boire', [CellierBouteillesController::class, 'boireBouteilleQuantite']);

// Modification de la Quantite
Route::put('/cellier-bouteilles/{bouteille_id}/{cellier_id}/modifier', [CellierBouteillesController::class, 'modifierBouteilleQuantite']);

// Ajouter une bouteille dans cellier
Route::post('/cellier-bouteilles/ajoutBouteilleCellier', [CellierBouteillesController::class, 'ajouterBouteilleCellier']);

// Supprimer une bouteille d'un cellier
Route::delete('/cellier-bouteilles/{bouteille_id}/{cellier_id}/supprimer', [CellierBouteillesController::class, 'supprimerBouteilleCellier']);



// ------------------------------------------ Usager
// Récupération de tous les usagers
Route::get('/usagers', [UsagerController::class, 'getUsagers']);

// Récupération d'un usager avec son id
Route::get('/usager/{id}', [UsagerController::class, 'getUsager']);

// Modification d'un usager
Route::put('/usager/{id}', [UsagerController::class, 'modifierUsager']);

// Ajout d'un usager
Route::post('/usager', [UsagerController::class, 'ajouterUsager']);

// Suppression d'un usager
Route::delete('/usager/{id}', [UsagerController::class, 'supprimerUsager']);

// Ajout de bouteille non liste
Route::post('bouteilles/nouvelle', [BouteilleController::class, 'ajouterNouvelleBouteille']);


//Route API pour l'authentification des utilisateurs
// Route::post('/login', 'AuthController@login');


Route::post('/registration', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/connexion', [App\Http\Controllers\AuthController::class, 'login']);

Route::group(['middleware'=> ['auth:sanctum']], function() {
    Route::post('/profile', [App\Http\Controllers\AuthController::class, 'profile']);
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);

});


