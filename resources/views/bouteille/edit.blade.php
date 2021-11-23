@extends('layouts.app')
@section('content')
<script src="{{asset('js/cellier_index.js')}}"></script>

@if(Session::get('erreur'))
<span class="success"></span>
@endif


<div class="entete-page">
    <h1 class="titre-formulaire">Modifier un vin</h1>
    <img src="{{URL::asset('/assets/icon/deux-coupe-jaune.svg')}}" alt="Icone deux coupe de vin">
</div>

<div class="row">
    <form class="col s12 edit-vin " action="{{ route('bouteilleUpdate', $bouteille->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="input-field col s12">
            <input id="nom" name="nom" max="111" type="text" class="@if($errors->first('nom')) invalid @endif validate" value="{{$bouteille->nom}}" required />
            <label for="nom">Nom</label>
            <span class="helper-text" data-error="Champ obligatoire"></span>
        </div>
        <div class="input-field col s12">
            <input id="pays" type="text" name="pays" pattern="^[-a-zA-ZáéíóúÁÉÍÓÚÑñÇç ]*$" class="@if($errors->first('pays')) invalid @endif validate" value="{{$bouteille->pays}}">
            <label for="pays">Pays</label>
            <span class="helper-text" data-error="Format invalid"></span>
        </div>
        <div class="input-field col s12 ">
            <select name="type_id">
                <!-- <option value="{{$bouteille->type_id}}" selected>{{$bouteille->type->type}}</option> -->
                @foreach($types as $type)
                <option value="{{ $type->id }}" @if($bouteille->type_id==$type->id) selected @endif> {{ $type->type}}</option>
                @endforeach
            </select>
            <label>Type</label>
            @if($errors->first('type_id')) <span class="helper-text erreur" data-error="Format invalid">Champ obligatoire</span> @endif
        </div>
        <div class="input-field col s12">
            <select name="format_id">
                <!-- <option value="{{$bouteille->format_id}}" selected>{{$bouteille->format->nom}} - {{$bouteille->format->taille}} cl</option> -->
                @foreach($formats as $format)
                <option value="{{ $format->id }}" @if( $bouteille->format_id==$format->id) selected @endif>{{ $format->nom}} - {{$format->taille}} cL </option>
                @endforeach
            </select>
            <label>Format</label>
            @if($errors->first('format_id')) <span class="helper-text erreur" data-error="Format invalid">Champ obligatoire</span> @endif
        </div>

        <input type="hidden" name="url_img" value="{{$bouteille->url_img}}">

        <div class="file-field input-field col s12">
            <div class="image-vin-conteneur">
            <img class="image-vin" src="{{$bouteille->url_img}}" alt="{{$bouteille->nom}}">
           
                <div class="btn">
                    <span>Image</span>
                    <input type="file" name="file" accept="image/*">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
        </div>
    
    <div class="col s12 btn-space">
        @if( $idCellier != 0)
        <a href="{{route('ficheVin', ['idCellier'=>$idCellier,'idBouteille'=>$idBouteille])}}
         " class="btn waves-effect waves-light button btn-annuler" name="annuler">Annuler</a>
        @else 
        <a href="javascript:window.close();
         " class="btn waves-effect waves-light button btn-annuler" name="annuler">Annuler</a>
        @endif
        <a class="btn waves-effect waves-light button btn-modifier modal-trigger" href="#modal-modifier" disabled>Modifier</a>

        <!-- Modal Structure pour modifier-->
        <div id="modal-modifier" class="modal">
            <div class="modal-content">
                <h4>Modifier ce vin</h4>
                <p>Êtes-vous certain de vouloir modifier le vin <span>{{ ucfirst($bouteille->nom) }}</span>? Les informations de ce vin seront modifiés dans les autres celliers aussi.</p>
            </div>
            <div class="modal-footer">
                                                            
                
                    <button class="waves-effect waves-green btn-flat" type="submit" name="submit">Modifier</button>
                
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Annuler</a>
            </div>
        </div>
        <input type="hidden" name="url_img" value="{{$bouteille->url_img}}">
        
        <a class="btn waves-effect waves-light button btn-supprimer modal-trigger" href="#{{$bouteille->id}}"><i class="material-icons">delete</i></a>

    </form>
</div>



<!-- Modal Structure pour suprrimer-->
<div id="{{$bouteille->id}}" class="modal">
    <div class="modal-content">
        <h4>Supprimer ce vin</h4>
        <p>Êtes-vous certain de vouloir le vin <span>{{ ucfirst($bouteille->nom) }}</span>? Tous les millesimes de ce vin dans le cellier seront supprimés aussi.</p>
    </div>
    <div class="modal-footer">
                                                    
        <form action="{{ route('bouteille.destroy', $bouteille->id)}}" method="POST">
            @method('DELETE')
            @csrf
            <button class="waves-effect waves-green btn-flat">Supprimer</button>
        </form>
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Annuler</a>
    </div>
</div>

@endsection
<link href="{{asset('css/bouteille_edit.css')}}" rel="stylesheet" media="print"
    onload="this.media='all'" />
<script src="{{asset('js/bouteille_edit.js')}}" defer></script>