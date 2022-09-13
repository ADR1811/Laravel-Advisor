<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etablissement;
use App\Models\Commentaire;

class CommentaireController extends Controller
{
    public function store(Request $request, $id)
    {
        $user = auth()->user();

        $commentaire = new Commentaire();
        $commentaire->user_id = $user->id;
        $commentaire->etablissement_id = $id;
        $commentaire->content = $request->content;
        $commentaire->rating = $request->rating;
        $commentaire->save();

        return redirect()->route('show.etablissement', ['id' => $id]);
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('show.all.etablissements');
    }
    public function destroy($id)
    {
        // peut supprimer si auteur du commentaire ou si propriétaire de l'établissement
        $commentaire = Commentaire::findOrfail($id);
        if (auth()->user()->id == $commentaire->user_id || auth()->user()->id == $commentaire->etablissement->user_id) {
            $commentaire->delete();
        }
        return redirect()->route('show.all.etablissements');
    }
}
