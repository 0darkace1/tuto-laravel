@extends("base")

@section("title", "Créer un article")

@section("content")

    <div class="card" style="width: 36rem;">
        <div class="card-body">
            <form action="" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Titre de l'article</label>
                    <input id="title" name="title" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Titre de l'article" value="{{old("title")}}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug de l'article</label>
                    <input id="slug" name="slug" type="text" class="form-control @error('slug') is-invalid @enderror" placeholder="Slug de l'article" value="{{old("slug")}}">
                    @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Contenu de l'article</label>
                    <textarea id="content" name="content" class="form-control @error('title') is-invalid @enderror" placeholder="Contenu de l'article" required>{{old("content")}}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        </div>
    </div>
@endsection
