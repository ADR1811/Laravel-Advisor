@extends('layouts.app')
@section('content')
    <form action="{{ route('update.etablissement', $etablissement->id) }}" method="POST"
        enctype="multipart/form-data"class="container">
        <h2>Édition de l'établissement</h2>

        @csrf
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" placeholder="Nom" name="nom"
                value="{{ $etablissement->nom }}">
        </div>
        <div class="form-group">
            <label for="adresse">Adresse</label>
            <input type="text" class="form-control" id="adresse" placeholder="Adresse" name="adresse"
                value="{{ $etablissement->adresse }}">
        </div>
        <div class="form-group">
            <label for="ville">Ville</label>
            <input type="text" class="form-control" id="ville" placeholder="Ville" name="ville"
                value="{{ $etablissement->ville }}">
        </div>
        <div class="form-group">
            <label for="code_postal">Code Postal</label>
            <input type="text" class="form-control" id="code_postal" placeholder="Code Postal" name="code_postal"
                value="{{ $etablissement->code_postal }}">
        </div>
        <div class="form-group">
            <label for="pays">Pays</label>
            <input type="text" class="form-control" id="pays" placeholder="Pays" name="pays"
                value="{{ $etablissement->pays }}">
        </div>
        <div class="form-group">
            <label for="images">Images</label>
            {{-- 5 files input --}}

            <input type="file" id="image1" name="image1" accept="image/png, image/jpeg" class="image-input" hidden>

            <input type="file" id="image2" name="image2" accept="image/png, image/jpeg" class="image-input" hidden />

            <input type="file" id="image3" name="image3" accept="image/png, image/jpeg" class="image-input" hidden />

            <input type="file" id="image4" name="image4" accept="image/png, image/jpeg" class="image-input" hidden />

            <input type="file" id="image5" name="image5" accept="image/png, image/jpeg" class="image-input" hidden />

            {{-- input imageStatus array --}}
            <input type="text" id="imageStatus" name="imageStatus" hidden>

            {{-- Container  d'images ajouté avec du js --}}
            <div id="images-container" class="d-flex flex-wrap">
                @foreach ($etablissement->images as $image)
                    @if ($image != '')
                        <div id="img-{{ $loop->iteration }}">
                            <img src="{{ Storage::url($image) }}" class="img-thumbnail" alt="image" />
                            {{-- icone de suppression ou data-id est la clée de image --}}
                            <i class="fa fa-times-circle delete-image" data-id="image{{ $loop->iteration }}"></i>
                        </div>
                    @endif
                @endforeach
            </div>
            @php($count = 0)
            @foreach ($etablissement->images as $image)
                @if ($image != '')
                    @php($count++)
                @endif
            @endforeach
            {{-- Button pour ajouter une image si supperieur ou égale à 5 on id --}}
            <button type="button" class="btn btn-primary" id="add-image" {{ $count >= 5 ? 'disabled' : '' }}>
                Ajouter une image</button>
            {{-- limit 0/5 changé par la suite en js --}}
            <p id="limit">
                {{-- on définit la variable $count à 0 --}}

                {{ $count }}/5
            </p>
            <button type="submit" class="btn btn-primary">Modifier</button>
    </form>


    <script>
        // on recupere toutes image-input

        function deleteButtonHydratation(imageAvailable) {
            deleteButton = document.querySelectorAll('.delete-image');
            for (let i = 0; i < deleteButton.length; i++) {
                deleteButton[i].addEventListener('click', function() {
                    // on recupere la balise div parente du bouton
                    let divContainer = this.parentNode;
                    let imageName = this.getAttribute('data-id');

                    // on supprime la balise div
                    divContainer.remove();
                    imageAvailable[imageName]['status'] = "removed";
                    console.log(imageAvailable);
                    let limit = document.getElementById('limit');
                    let count = parseInt(limit.innerText.split('/')[0]);
                    limit.innerText = `${count - 1}/5`;

                    let inputImageStatus = document.getElementById('imageStatus');
                    inputImageStatus.value = JSON.stringify(imageAvailable);
                });
            }
        };


        let imageInputs = document.querySelectorAll('.image-input');
        // on recupere le button ajouter une image
        let addImage = document.querySelector('#add-image');
        // on recupere le container d'images
        let imagesContainer = document.querySelector('#images-container');
        // convert  $imagesStatus into js array
        let imageAvailable = @json($imagesStatus);
        // type of imageAvailable
        imageAvailable = JSON.parse(imageAvailable);
        deleteButtonHydratation(imageAvailable);
        addImage.addEventListener('click', () => {
            // on regarde le json imageAvailable et on récupere la première clé pour laquelle status est "absente" ou removed
            if (parseInt(limit.innerHTML.split('/')[0]) < 5) {
                let imageNumber = Object.keys(imageAvailable).find(key => imageAvailable[key]['status'] ===
                    'absent' || imageAvailable[key]['status'] === 'removed');
                // on récupere l'input correspondant à l'image
                let imageInput = document.querySelector(`#${imageNumber}`);
                imageInput.click();
                imageInput.addEventListener('change', () => {
                    let imageName = imageInput.value.split('\\').pop();
                    imagesContainer.innerHTML += `<div id=img-${imageNumber.split('image')[1]}>
                            <img src="${URL.createObjectURL(imageInput.files[0])}" class="img-thumbnail" alt="image" />
                            <i class="fa fa-times-circle delete-image" data-id="${imageNumber}"></i>
                        </div>`;
                    limit.innerHTML = `${parseInt(limit.innerHTML.split('/')[0]) + 1}/5`;
                    // imageAvailable[imageNumber]['status'] = 'new';
                    if (imageAvailable[imageNumber]['status'] === 'removed') {
                        imageAvailable[imageNumber]['status'] = 'replaced';
                    } else {
                        imageAvailable[imageNumber]['status'] = 'new';
                    }
                    if (parseInt(limit.innerHTML.split('/')[0]) >= 5) {
                        addImage.disabled = true;
                    }
                    deleteButtonHydratation(imageAvailable);
                    let inputImageStatus = document.getElementById('imageStatus');
                    inputImageStatus.value = JSON.stringify(imageAvailable);
                });
            };
        });
    </script>
@endsection
