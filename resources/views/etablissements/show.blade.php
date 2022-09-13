<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{ asset('storage/' . $etablissement->images) }}" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">{{ $etablissement->nom }}</h5>
            <p class="card-text">{{ $etablissement->adresse }}</p>
            <p class="card-text">{{ $etablissement->ville }}</p>
            <p class="card-text">{{ $etablissement->code_postal }}</p>
            <p class="card-text">{{ $etablissement->pays }}</p>
        </div>
    </div>

    {{-- write comments --}}


    {{-- comments section --}}
    <div class="card">
        <div class="card-header">
            <h3>Comments</h3>
        </div>
        <form action="{{ route('store.comment', $etablissement->id) }}" method="POST">
            @csrf
            {{-- FontAwesome start to do rating --}}
            <div class="form-group">
                <label for="rating">Note</label>
                <div class="rating">
                    <input type="radio" name="rating" id="star1" value="1"><label for="star1">1</label>
                    <input type="radio" name="rating" id="star2" value="2"><label for="star2">2</label>
                    <input type="radio" name="rating" id="star3" value="3"><label for="star3">3</label>
                    <input type="radio" name="rating" id="star4" value="4"><label for="star4">4</label>
                    <input type="radio" name="rating" id="star5" value="5"><label for="star5">5</label>
                </div>
            </div>
            <div class="form-group">
                <label for="content">Commentaire</label>
                <textarea class="form-control" name="content" id="content" cols="30" rows="10"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <div class="card-body">
            <ul class="list-group">
                @foreach ($commentaires as $commentaire)
                    <li class="list-group-item">
                        {{-- user and after rating and after content and after date --}}
                        <div class="row">
                            <div class="col-md-3">
                                <h5>{{ $commentaire->user->name }}</h5>
                            </div>
                            <div class="col-md-3">
                                <h5>{{ $commentaire->rating }}</h5>
                            </div>
                            <div class="col-md-3">
                                <h5>{{ $commentaire->content }}</h5>
                            </div>
                            <div class="col-md-3">
                                <h5>{{ $commentaire->created_at }}</h5>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

</body>

</html>
