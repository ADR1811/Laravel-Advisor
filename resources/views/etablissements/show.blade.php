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
            <a href="{{ route('show.etablissement', $etablissement->id) }}" class="btn btn-primary">Voir</a>
        </div>
    </div>
</body>

</html>
