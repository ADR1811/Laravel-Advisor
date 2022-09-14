@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($etablissements as $etablissement)
                <div class="col-md-4">
                    <div class="card">
                        {{-- image if empty placeholder --}}
                        <img src="{{ $etablissement->image ? asset('storage/' . $etablissement->image) : 'https://via.placeholder.com/80' }}"
                            class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">{{ $etablissement->nom }}</p>
                            <p class="card-text">
                                {{-- on affiche 5 étoiles vide et en fonction du nombre d'étoiles on affiche des étoiles pleines --}}
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < floor($etablissement->rating))
                                        <i class="fa fa-star checked"></i>
                                    @else
                                        <i class="fa fa-star"></i>
                                    @endif
                                @endfor
                            </p>
                            <p class="card-text">{{ $etablissement->adresse }}, {{ $etablissement->code_postal }}
                                {{ $etablissement->ville }}, {{ $etablissement->pays }}</p>

                            <p class="card-text">Crée le {{ $etablissement->created_at->format('d/m/Y') }}</p>

                            {{-- button with src --}}
                            <a href="{{ route('show.etablissement', $etablissement) }}" class="btn btn-primary">Voir
                                l'établissement</a>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
