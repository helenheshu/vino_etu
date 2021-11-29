<?php

namespace App\Http\Controllers;

use App\Models\Cellier;
use App\Models\CellierBouteille;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CellierController extends Controller
{
    /**
     * Afficher la liste des celliers
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {

            $userCelliers = Cellier::getCelliersByUser(Auth::user()->id);

            if (Auth::user()->id <> 1 && !isset($userCelliers[0])) {
                return view('celliers.create');
            }

            return view('celliers.index', ['celliers' => $userCelliers]);
        }

        return redirect('login');
    }

    /**
     * Afficher le formulaire de création d'un cellier
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('celliers.create');
    }

    /**
     * Envoi les informations du formulaire de création de cellier dans la DB après validation
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required | max:32',
            'localisation' => 'required | max:40',
            'user_id' => 'required | exists:users,id',
        ]);

        $post = new Cellier();
        $post = Cellier::create([
            'nom' => ucfirst($request->nom),
            'localisation' => ucfirst($request->localisation),
            'user_id' => session('user')->id
        ]);

        return redirect('cellier/' . $post->id)->withInput()->with("nouvelleCellier", "nouvelle cellier ajoutée");
    }

    /**
     * Affiche le contenu d'un cellier
     *
     * @param  \App\Models\Cellier  $cellier
     * @return \Illuminate\Http\Response
     */
    public function show(Cellier $cellier)
    {
        return CellierBouteilleController::index($cellier->id);
    }



    /**
     * Afficher le formulaire de modification d'un cellier
     *
     * @param  \App\Models\Cellier  $cellier
     * @return \Illuminate\Http\Response
     */
    public function edit(Cellier $cellier)
    {
        if (session('user')->id != $cellier->user_id) {
            return redirect('cellier');
        }
        return view('celliers.edit', ['cellier' => $cellier]);
    }

    /**
     * Envoi les informations du formulaire de modification de cellier dans la DB après validation
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cellier  $cellier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cellier $cellier)
    {
        $request->validate([
            'nom' => 'required | max:32',
            'localisation' => 'required | max:40',
        ]);

        $cellier->update([
            'nom' => ucfirst($request->nom),
            'localisation' => ucfirst($request->localisation),
        ]);
        return redirect('/cellier')->withInput()->with("modifieCellier", "un cellier modifiée");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cellier  $cellier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cellier $cellier)
    {
        $cellier->delete();

        return redirect('/cellier')->withInput()->with('deleteCellier', "un cellier supprimé");
    }

    /**
     * fonctionnalité de recherche dans un cellier
     * @param motCle
     * @param idCellier
     * @return response des bouteilles qui correspondent au mot clé de la recherche
     */

    public function rechercheDansCellier($motCle, $idCellier)
    {
        $bouteilles = Cellier::rechercheDansCellier($motCle, $idCellier);

        return response()->json($bouteilles);
    }

      /**
       * Afficher toutes les bouteilles du celliers après avoir effacer une recherche
       * @param idCellier
       * @return response toutes les bouteilles du celliers
     */
    public function reinitialiserCellier($idCellier)
    {
        $bouteilles = CellierBouteille::obtenirListeBouteilleCellier($idCellier);

        return response()->json($bouteilles);
    }
}
