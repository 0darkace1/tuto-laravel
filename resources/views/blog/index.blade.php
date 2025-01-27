@extends("base")

@section("title", "Accueil du blog")

@section("content")
    <h1>Mon Premier Blog</h1>
    <hr>

    <div class="container">
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card h-100" style="width: 100%;">
                        @if($post->image)
                            <img src="{{ $post->imageUrl() }}" class="card-img-top" alt="{{ $post->title }}">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            @if ($post->category)
                                <li class="list-group-item">
                                    Catégorie: <strong>{{ $post->category?->name }}</strong>
                                    @if(!$post->tags->isEmpty()),@endif
                                </li>
                            @endif
                            @if(!$post->tags->isEmpty())
                                <li class="list-group-item">
                                    Tags:
                                    @foreach ($post->tags as $tag )
                                        <span class="badge bg-secondary">{{ $tag->name }}</span>
                                    @endforeach
                                </li>
                            @endif
                        </ul>

                        @auth
                            @if(auth())
                            @endif
                            <div class="card-footer">
                                <a class="card-link" href="{{ route("blog.show", ["slug" => $post->slug, "post" => $post->id]) }}">Lire la suite</a>
                                <a href="{{ route("blog.edit", ["post" => $post->id]) }}" class="card-link">Éditer</a>
                            </div>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-4">
        {{ $posts->links() }} <!-- Pagination -->
    </div>
@endsection
