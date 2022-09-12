<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etablissement;

class EtablissementController extends Controller
{
    //
    public function index()
    {
        $etablissements = Etablissement::all();

        return view('etablissements/index', ['etablissements' => $etablissements]);
    }

    public function create()
    {

        return view('etablissements/create');
    }

    public function show($id)
    {
        $etablissement = Etablissement::findOrfail($id);

        return view('etablissements/show', ['etablissement' => $etablissement]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $etablissemnt = new Etablissement();
        $etablissemnt->user_id = $user->id;
        $etablissemnt->nom = $request->nom;
        $etablissemnt->adresse = $request->adresse;
        $etablissemnt->ville = $request->ville;
        $etablissemnt->code_postal = $request->code_postal;
        $etablissemnt->pays = $request->pays;
        // json statique vide temporaire
        $etablissemnt->images = json_encode([]);
        $etablissemnt->save();

        return redirect()->route('show.etablissement', ['id' => $etablissemnt->id]);
    }

    public function edit($id)
    {
        return view('etablissements/edit');
    }

    public function update(Request $request, $id)
    {
        return view('etablissements/update');
    }

    public function destroy($id)
    {
        // on verifie que l'utilisateur est connecté et qu'il est propriétaire de l'etablissement
        $user = auth()->user();
        $etablissement = Etablissement::findOrfail($id);

        if ($user->id == $etablissement->user_id) {
            $etablissement->delete();
        }

        return redirect()->route('show.all.etablissements');
    }
}
