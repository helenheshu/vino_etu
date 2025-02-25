@extends('layouts.app')
@section('content')

<link href="{{asset('css/celliers.css')}}" rel="stylesheet"/>

@if(Session::get('deleteCellier'))
<span class="deleteCellier"></span>
@endif

@if(Session::get('modifieCellier'))
<span class="modifieCellier"></span>
@endif


@if(isset(Auth::user()->id))

<div class="titre">
    <h1>Vos celliers</h1>
</div>

<div class="bouton-ajout-vin-conteneur">
    <a class="bouton-ajout-vin" href="{{ route('cellier.create') }}"><i class="material-icon">add</i> Ajouter un cellier</a>
</div>



<div class="liste-celliers">
    @forelse($celliers as $cellier)
    
        <article class="cellier" data-lien="{{route('cellier.show',  $cellier->id)}}" >
       
            <div class="texte-cellier-container">
                <h2 class="nom-cellier">{{ ucfirst($cellier->nom) }}</h2>
                <h3 class="localisation-cellier"><img class="map-icone" src="{{URL::asset('/assets/icon/map-marker-rouge.svg')}}" alt="icone map"> {{ ucfirst($cellier->localisation) }}</h3>
            </div>
            
            <div class="droite-container">
                <div class="btn-space">
                    <a class="waves-effect waves-light button modifier" href="{{ route('cellier.edit', $cellier->id)}}"><i class="material-icons">edit</i></a>
   
                    <a class="waves-effect waves-light button supprimer modal-trigger" href="#{{$cellier->id}}"><i class="material-icons">delete</i></a>
                    <!-- Modal Structure -->
                    <div id="{{$cellier->id}}" class="modal">
                        <div class="modal-content">
                            <h4>Supprimer ce cellier</h4>
                            <p>Êtes-vous certain de vouloir le cellier <span>{{ ucfirst($cellier->nom) }}</span>? Tous les bouteilles dans le cellier seront supprimées aussi.</p>
                        </div>
                        <div class="modal-footer">
                        <form action="{{ route('cellier.destroy', $cellier->id)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="waves-effect waves-green btn-flat">Supprimer</button>
                                        </form>
                            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Annuler</a>
                        </div>
                    </div>
                </div>
            </div>
          
        </article>
    
    @empty
    <div class="list-empty">
        <p>Vous n'avez pour l'instant aucun cellier. Veuillez en créer un avant de continuer</p>
    </div>

    @endforelse
</div>


@endif

<script src="{{asset('js/cellier_index.js')}}" defer></script>
@endsection