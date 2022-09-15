@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="@if (count($etablissements) > 0) row @endif">
            @if (count($etablissements) > 0)
                @foreach ($etablissements as $etablissement)
                    <div class="col-md-4">
                        <div class="card">
                            {{-- ternaire pour placer l'image --}}

                            <img src="{{ Storage::url($etablissement->images['image1']) }}" class="card-img-top"
                                alt="...">
                            <div class="card-body">
                                <p class="card-text">{{ $etablissement->nom }}</p>
                                <p class="card-text">
                                    {{-- on affiche 5 étoiles vide et en fonction du nombre d'étoiles on affiche des étoiles pleines --}}
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($i < floor($etablissement->rating))
                                            <i class="fa fa-star checked"></i>
                                        @else
                                            <i class="fa fa-star-o"></i>
                                        @endif
                                    @endfor
                                </p>
                                <p class="card-text">{{ $etablissement->adresse }}, {{ $etablissement->code_postal }}
                                    {{ $etablissement->ville }}, {{ $etablissement->pays }}</p>

                                <p class="card-text">Créé le {{ $etablissement->created_at->format('d/m/Y') }}</p>

                                {{-- button with src --}}
                                <a href="{{ route('edit.etablissement', $etablissement) }}"
                                    class="btn btn-primary">Éditer</a>
                                <a href="{{ route('delete.etablissement', $etablissement) }}"
                                    class="btn btn-danger">Supprimer</a>

                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center text-muted">Aucun lieu</p>
                <div class=text-center>
                    <a href="{{ route('create.etablissement') }}" class="text-center btn btn-primary">Créer un
                        établissement</a>
                </div>
            @endif
        </div>
    </div>
@endsection
