@extends("base")

@section("title", "Accueil du blog")

@section("content")
    <h1>Mon Premier Blog</h1>
    <hr>

    @foreach ($posts as $post)
        <article>
            <h2>{{ $post->title }}</h2>
            <p class="small">
                @if ($post->category)
                    Catégorie: <strong>{{ $post->category?->name }}</strong>@if(!$post->tags->isEmpty()),@endif
                @endif
                <br>
                @if(!$post->tags->isEmpty())
                    Tags:
                    @foreach ($post->tags as $tag )
                        <span class="badge bg-secondary">{{ $tag->name }}</span>
                    @endforeach
                @endif
            </p>
            <p>{{ $post->content }}</p>
            <p>
                <a class="btn btn-primary" href="{{ route("blog.show", ["slug" => $post->slug, "post" => $post->id]) }}">Lire la suite</a>
                @auth
                    <a class="btn btn-primary" href="{{ route("blog.edit", ["post" => $post->id]) }}">Éditer</a>
                @endauth
            </p>
        </article>
    @endforeach

    {{ $posts->links() }}

@endsection
