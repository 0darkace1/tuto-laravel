@extends("base")

@section("title", $post->title)

@section("content")
    <div class="card" style="width: 18rem;">
        @if($post->image)
            <img src="{{ $post->imageUrl() }}" class="card-img-top">
        @endif
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

        @if(auth()?->user()?->role == "admin")
            <div class="card-footer">
                <a href="{{ route("blog.edit", ["post" => $post->id]) }}" class="card-link">Éditer</a>
            </div>
        @endif
    </div>
@endsection
