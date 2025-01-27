@extends("base")

@section("title", "Accueil du blog")

@section("content")
    <h1>Mon Premier Blog</h1>
    <hr>

    <div class="grid">
        @foreach ($posts as $post)

            <div class="card mb-2">
                {{-- <img src="https://st4.depositphotos.com/14953852/24787/v/450/depositphotos_247872612-stock-illustration-no-image-available-icon-vector.jpg" class="card-img-top" alt="..."> --}}

                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->content }}</p>
                </div>
                <ul class="list-group list-group-flush">
                    @if ($post->category)
                        <li class="list-group-item">Catégorie: <strong>{{ $post->category?->name }}</strong>@if(!$post->tags->isEmpty()),@endif</li>
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
                    <div class="card-footer">
                        <a class="card-link" href="{{ route("blog.show", ["slug" => $post->slug, "post" => $post->id]) }}">Lire la suite</a>
                        <a href="{{ route("blog.edit", ["post" => $post->id]) }}" class="card-link">Éditer</a>
                    </div>
                @endauth
            </div>
        @endforeach
    </div>

    {{ $posts->links() }}

@endsection
