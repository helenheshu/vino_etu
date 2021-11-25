@extends('layouts.app')
<link href="{{asset('css/auth.css')}}" rel="stylesheet" />
@section('content')
<article class="flex-box">
  <header class="card-content flex-center entete-login">
    <h1>Connexion</h1>
    <img src="{{asset('assets/icon/coupe-verte.svg')}}" class="center" alt="icone coupe verte"></a>
  </header>
    <form action="{{ route('login.custom') }}" method="POST">
      @csrf
      <div class="row">
        <div class="input-field col s12">
          <input id="courriel" type="email" class="validate" name="courriel" value="{{ old('courriel')}}" required>
          <label for="courriel">Adresse de courriel</label>
        </div>
        <div class="input-field col s12">
          <input id="mot_de_passe" type="password" class="validate" name="password" required>
          <label for="mot_de_passe">Mot de passe</label>
        </div>

        @if ($errors->has('courriel'))
        <div class="input-field col s12">
          <span class="red-text">{{ $errors->first('courriel') }}</span>
        </div>
        @elseif ($errors->has('password'))
        <div class="input-field col s12">
          <span class="red-text">{{ $errors->first('password') }}</span>
        </div>
        @elseif (session('success'))
        <div class="input-field col s12">
          <span class="red-text">{{ session('success')}}</span>
        </div>
        @endif

        <div class="input-field col s12 btn-space">
          <button type="submit" class="btn waves-effect waves-light button btn-ajouter">Ouvrir une session</button>
        </div>
        <div class="input-field col s12">
          <a href="{{ route('register') }}" class="right">Créer un compte</a>
        </div>
      </div>
    </form>
</article>

@endsection

