@extends('layouts.app')

@section('content')
    {{-- content section --}}

    <div class="container container-etablissement">
        <div class="row">
            <div class="col-md-6">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-interval="false">
                    <div class="carousel-indicators">

                        @foreach ($etablissement->images as $image)
                            @if ($image != '')
                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"
                                    aria-label="Slide {{ $loop->index }}"></button>
                            @endif
                        @endforeach
                    </div>
                    <div class="carousel-inner">
                        @foreach ($etablissement->images as $image)
                            @if ($image != '')
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <img src="{{ Storage::url($image) }}" class="d-block w-100" alt="...">
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            {{-- right col for texte --}}
            <div class="col-md-6 col-right">
                <h1>{{ $etablissement->nom }}</h1>
                <p>{{ $etablissement->adresse }}, {{ $etablissement->code_postal }} {{ $etablissement->ville }},
                    {{ $etablissement->pays }}</p>
                <p> Créé le {{ $etablissement->created_at->format('d/m/Y') }}</p>
                <p>
                    {{-- on affiche 5 étoiles vide et en fonction du nombre d'étoiles on affiche des étoiles pleines --}}
                    @for ($i = 0; $i < 5; $i++)
                        @if ($i < floor($etablissement->rating))
                            <i class="fa fa-star checked"></i>
                        @else
                            <i class="fa fa-star-o"></i>
                        @endif
                    @endfor
                    <span>{{ floor($etablissement->rating) }}/5</span>
                </p>
            </div>
        </div>
    </div>
    {{-- end content section --}}
    <br>
    <br>
    <br>
    {{-- start Comment section --}}

    <div class="container container-comment">
        <h2>Commentaires</h2>
        <br>
        <div>
            <h3>Ajouter un commentaire</h3>
            <form action="{{ route('store.comment', $etablissement) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="content">Commentaire</label>
                    <textarea class="form-control" name="content" id="content" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="rating">Note : </label>
                    <input type="radio" name="rating" value="1" hidden>
                    <input type="radio" name="rating" value="2" hidden>
                    <input type="radio" name="rating" value="3" hidden>
                    <input type="radio" name="rating" value="4" hidden>
                    <input type="radio" name="rating" value="5" hidden>

                    <i class="fa fa-star-o" id="star1"></i>
                    <i class="fa fa-star-o" id="star2"></i>
                    <i class="fa fa-star-o" id="star3"></i>
                    <i class="fa fa-star-o" id="star4"></i>
                    <i class="fa fa-star-o" id="star5"></i>
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
            <br>
            {{-- rajouter une ligne de séparation --}}
            <hr>
            <br>
            <div class="comment-list">
                @foreach ($commentaires as $commentaire)
                    <div class="comment">
                        <div>
                            <span>Par : {{ $commentaire->user->name }}</span>
                        </div>
                        <div class="comment-rating">
                            @for ($i = 0; $i < 5; $i++)
                                @if ($i < floor($commentaire->rating))
                                    <i class="fa fa-star checked"></i>
                                @else
                                    <i class="fa fa-star-o"></i>
                                @endif
                            @endfor
                        </div>
                        <span>Le : {{ $commentaire->created_at->format('d/m/Y') }}</span>
                        <div>
                            <p>{{ $commentaire->content }}</p>
                        </div>
                    </div>
                    {{-- si l'user est connecté --}}

                    @if (Auth::check())
                        @if ($commentaire->user_id == Auth::user()->id || $etablissement->user_id == Auth::user()->id)
                            <form action="{{ route('delete.comment', $commentaire) }}" method="GET">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
        <script>
            let inputs = document.querySelectorAll('input[type="radio"]');
            let star1 = document.querySelector('#star1');
            let star2 = document.querySelector('#star2');
            let star3 = document.querySelector('#star3');
            let star4 = document.querySelector('#star4');
            let star5 = document.querySelector('#star5');

            let stars = [star1, star2, star3, star4, star5];

            stars.forEach((star, index) => {
                star.addEventListener('click', () => {
                    inputs[index].checked = true;
                    stars.forEach((star, index2) => {
                        if (index2 <= index) {
                            star.classList.remove('fa-star-o');
                            star.classList.add('fa-star');
                            star.classList.add('checked');
                        } else {
                            star.classList.remove('fa-star');
                            star.classList.remove('checked');
                            star.classList.add('fa-star-o');
                        }
                    })
                });
            });
        </script>
    @endsection
