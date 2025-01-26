<div class="card" style="width: 36rem;">
    <div class="card-body">
        <form action="" method="POST">
            @csrf
            @method($post->id ? "PATCH" : "POST")
            <div class="form-group mb-3">
                <label for="title" class="form-label">Titre</label>
                <input id="title" name="title" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Titre de l'article" value="{{old("title", $post->title)}}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input id="slug" name="slug" type="text" class="form-control @error('slug') is-invalid @enderror" placeholder="Slug de l'article" value="{{old("slug", $post->slug)}}">
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="content" class="form-label">Contenu</label>
                <textarea id="content" name="content" class="form-control @error('title') is-invalid @enderror" placeholder="Contenu de l'article" required>{{old("content", $post->content)}}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="category" class="form-label">Categorie</label>
                <select id="category" name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                    <option value="">Sélectionner une catégorie</option>
                    @foreach ($categories as $category)
                        <option @selected(old("category_id", $post->category_id) == $category->id) value="{{$category->id}}">{{ $category->name}}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            @php
                $selectedTags = $post->tags()->pluck("id");
            @endphp
            <div class="form-group mb-3">
                <label for="tag" class="form-label">Tags</label>
                <select id="tag" name="tags[]" class="form-control @error('tags') is-invalid @enderror" required multiple>
                    @foreach ($tags as $tag)
                        <option @selected($selectedTags->contains($tag->id)) value="{{$tag->id}}">{{ $tag->name}}</option>
                    @endforeach
                </select>
                @error('tags')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                @if($post->id)
                    Modifier
                @else
                    Créer
                @endif
            </button>
        </form>
    </div>
</div>
