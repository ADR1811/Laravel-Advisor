@extends('layouts.app')

@section('content')
    <form action="{{ route('store.etablissement') }}" method="POST" enctype="multipart/form-data" class="container">
        @csrf
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" placeholder="Nom" name="nom">
        </div>
        <div class="form-group">
            <label for="adresse">Adresse</label>
            <input type="text" class="form-control" id="adresse" placeholder="Adresse" name="adresse">
        </div>
        <div class="form-group">
            <label for="ville">Ville</label>
            <input type="text" class="form-control" id="ville" placeholder="Ville" name="ville">
        </div>
        <div class="form-group">
            <label for="code_postal">Code Postal</label>
            <input type="text" class="form-control" id="code_postal" placeholder="Code Postal" name="code_postal">
        </div>
        <div class="form-group">
            <label for="pays">Pays</label>
            <input type="text" class="form-control" id="pays" placeholder="Pays" name="pays">
        </div>
        <div class="form-group">
            <label for="images">Images</label>
            {{-- 5 files input --}}
            <input type="file" id="image1" name="image1" accept="image/png, image/jpeg" class="image-input" hidden>
            <input type="file" id="image2" name="image2" accept="image/png, image/jpeg" class="image-input" hidden>
            <input type="file" id="image3" name="image3" accept="image/png, image/jpeg" class="image-input" hidden>
            <input type="file" id="image4" name="image4" accept="image/png, image/jpeg" class="image-input" hidden>
            <input type="file" id="image5" name="image5" accept="image/png, image/jpeg" class="image-input" hidden>

            {{-- Container  d'images ajouté avec du js --}}
            <div id="images-container" class="d-flex flex-wrap"></div>

            {{-- Button pour ajouter une image --}}
            <button type="button" class="btn btn-primary" id="add-image">Ajouter une image</button>
            {{-- limit 0/5 changé par la suite en js --}}
            <p id="limit">0/5</p>
            <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script>
        // on recupere toutes image-input
        let imageInputs = document.querySelectorAll('.image-input');
        // on recupere le button ajouter une image
        let addImage = document.querySelector('#add-image');
        // on recupere le container d'images
        let imagesContainer = document.querySelector('#images-container');

        // on click sur la premiere image-input vide
        addImage.addEventListener('click', () => {
            for (let i = 0; i < imageInputs.length; i++) {
                if (imageInputs[i].value == '') {
                    console.log(imageInputs[i]);
                    imageInputs[i].click();
                    // si l'image-input qui vient d'etre cliqué est rempli on l'ajoute dans images-container
                    imageInputs[i].addEventListener('change', () => {
                        // on recupere le nom de l'image
                        let imageName = imageInputs[i].value.split('\\').pop();
                        // on ajoute l'image dans le container
                        imagesContainer.innerHTML +=
                            `<img src="${URL.createObjectURL(imageInputs[i].files[0])}" alt="${imageName}" class="img-thumbnail">`;
                        // on incremente le nombre d'image
                        let limit = document.querySelector('#limit');
                        limit.innerHTML = `${i + 1}/5`;
                        // si on a 5 images on desactive le button ajouter une image
                        if (i == 4) {
                            addImage.disabled = true;
                        }
                    });


                    break;
                }

            }
        });
    </script>
@endsection
