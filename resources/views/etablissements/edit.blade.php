<form action="{{ route('update.etablissement', $etablissement->id) }}" method="POST" enctype="multipart/form-data">
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
        {{-- multiple image upload --}}
        <input type="file" class="form-control" id="images" name="images[]" multiple />
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
