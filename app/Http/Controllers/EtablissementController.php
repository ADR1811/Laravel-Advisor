<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etablissement;
use App\Models\Commentaire;
use Illuminate\Support\Facades\Storage;

class EtablissementController extends Controller
{
    //
    public function index()
    {
        $etablissements = Etablissement::all();

        // faire la moyenne des notes dans commentaires
        foreach ($etablissements as $etablissement) {
            $note = 0;
            // on regarde le type de $etablissement->images
            foreach ($etablissement->commentaire as $commentaire) {
                $note += $commentaire->rating;
            }
            if (count($etablissement->commentaire) > 0) {
                $note = $note / count($etablissement->commentaire);
            }
            $etablissement->rating = $note;
            // on convertit $etablissement->images en json
            $etablissement->images = json_decode($etablissement->images, true);
        }

        return view('home', ['etablissements' => $etablissements]);
    }

    public function create()
    {

        return view('etablissements/create');
    }

    public function show($id)
    {
        $user = auth()->user();
        $etablissement = Etablissement::findOrfail($id);
        $note = 0;
        $commentaires = Commentaire::where('etablissement_id', $id)->get()->sortByDesc('created_at');
        $etablissement->images = json_decode($etablissement->images, true);
        foreach ($etablissement->commentaire as $commentaire) {
            $note += $commentaire->rating;
        }
        if (count($etablissement->commentaire) > 0) {
            $note = $note / count($etablissement->commentaire);
            $etablissement->rating = $note;
        }
        return view('etablissements/show', ['etablissement' => $etablissement, 'commentaires' => $commentaires]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'nom' => 'required',
            'adresse' => 'required',
            'ville' => 'required',
            'code_postal' => 'required',
            'pays' => 'required',
            'image1' => 'required',
        ]);

        $image1 = $request->file('image1') ? $request->file('image1')->store('public') : '';
        $image2 = $request->file('image2') ? $request->file('image2')->store('public') : '';
        $image3 = $request->file('image3') ? $request->file('image3')->store('public') : '';
        $image4 = $request->file('image4') ? $request->file('image4')->store('public') : '';
        $image5 = $request->file('image5') ? $request->file('image5')->store('public') : '';

        $etablissemnt = new Etablissement();
        $etablissemnt->user_id = $user->id;
        $etablissemnt->nom = $request->nom;
        $etablissemnt->adresse = $request->adresse;
        $etablissemnt->ville = $request->ville;
        $etablissemnt->code_postal = $request->code_postal;
        $etablissemnt->pays = $request->pays;

        $etablissemnt->images = json_encode([
            'image1' => $image1,
            'image2' => $image2,
            'image3' => $image3,
            'image4' => $image4,
            'image5' => $image5,
        ]);
        $etablissemnt->save();

        return redirect()->route('show.etablissement', ['id' => $etablissemnt->id]);
    }

    public function edit($id)
    {
        $etablissement = Etablissement::findOrfail($id);
        $etablissement->images = json_decode($etablissement->images, true);
        $images = [];
        foreach ($etablissement->images as $key => $image) {
            if ($image != '') {
                $images[$key] = ["status" => "present"];
            } else {
                $images[$key] = ["status" => "absent"];
            }
        }
        $images = json_encode($images);
        return view('etablissements/edit', ['etablissement' => $etablissement, 'imagesStatus' => $images]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required',
            'adresse' => 'required',
            'ville' => 'required',
            'code_postal' => 'required',
            'pays' => 'required',
        ]);
        $etablissement = Etablissement::findOrfail($id);
        $etablissement->nom = $request->nom;
        $etablissement->adresse = $request->adresse;
        $etablissement->ville = $request->ville;
        $etablissement->code_postal = $request->code_postal;
        $etablissement->pays = $request->pays;

        $images = json_decode($etablissement->images, true);
        $imageStatus = json_decode($request->imageStatus, true);
        if ($imageStatus != null) {
            foreach ($imageStatus as $key => $status) {
                if ($status['status'] == 'replaced') {
                    Storage::delete($images[$key]);
                    $images[$key] = $request->file($key) ? $request->file($key)->store('public') : '';
                } else if ($status['status'] == 'removed') {
                    Storage::delete($images[$key]);
                    $images[$key] = '';
                }
            }
        }
        // on reorganise les images
        $images = array_values($images);
        // on fait remonter ceux qui sont remplis
        foreach ($images as $key => $image) {
            if ($image == '') {
                array_push($images, $image);
                unset($images[$key]);
            }
        }
        $images = array_combine(range(1, count($images)), array_values($images));
        // on remet les clés en json avec comme clé image1, image2, etc...
        foreach ($images as $key => $image) {
            $images['image' . $key] = $image;
            unset($images[$key]);
        }
        $etablissement->images = json_encode($images);
        $etablissement->save();

        return redirect()->route('show.etablissement', ['id' => $etablissement->id]);
    }

    public function destroy($id)
    {
        $user = auth()->user();
        $etablissement = Etablissement::findOrfail($id);
        $images = json_decode($etablissement->images, true);
        if ($user->id == $etablissement->user_id) {
            $commentaires = Commentaire::where('etablissement_id', $id)->get();
            foreach ($commentaires as $commentaire) {
                $commentaire->delete();
            }
            foreach ($images as $image) {
                if ($image) {
                    Storage::delete($image);
                }
            }
            $etablissement->delete();
        }
        return redirect()->route('show.my-etablissement');
    }
    public function showForUser()
    {
        $user = auth()->user();
        $etablissements = $user->etablissements;
        foreach ($etablissements as $etablissement) {
            $note = 0;
            foreach ($etablissement->commentaire as $commentaire) {
                $note += $commentaire->rating;
            }
            if (count($etablissement->commentaire) > 0) {
                $note = $note / count($etablissement->commentaire);
            }
            $etablissement->rating = $note;
            $etablissement->images = json_decode($etablissement->images, true);
        }

        return view('etablissements/user_etablissements', ['etablissements' => $etablissements]);
    }
}
