@extends("base")

@section("title", "Créer un article")

@section("content")
    <form action="" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Article de démonstration">
        <textarea name="content" placeholder="Contenu de démonstration"></textarea>
        <button>Enregistrer</button>
    </form>
@endsection
