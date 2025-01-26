@extends("base")

@section("title", "Connexion")

@section("content")
    <div class="card" style="width: 36rem;">
        <div class="card-body">
            <form action="" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{old("email")}}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mot de passe" value="{{old("password")}}" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    Connexion
                </button>
            </form>
        </div>
    </div>
@endsection

