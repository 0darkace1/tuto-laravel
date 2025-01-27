@extends("base")

@section("title", "Connexion")

@section("content")
    <div class="card" style="width: 36rem;">
        <div class="card-body">
            <form action="{{ route("auth.register") }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input id="name" name="name" type="text" autocomplete="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nom" value="{{old("name")}}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{old("email")}}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mot de passe">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="password_confirmation" class="form-label">Confirmation</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirmation">
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    Se connecter
                </button>
            </form>
        </div>
    </div>
@endsection

