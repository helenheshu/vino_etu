@extends('layouts.app')
@section('content')
<link href="{{asset('css/bouteilles.css')}}" rel="stylesheet"/>

<h1 class="titre">Mettre à jour le catalogue de bouteilles</h1>
<div class=" flex-center">
    <a class="waves-effect waves-light btn-large" >Importer des bouteilles du site de la SAQ</a>
    
    
    <div class="preloader-wrapper big ">
        <div class="spinner-layer spinner-blue-only">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div><div class="gap-patch">
            <div class="circle"></div>
          </div><div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>
      </div>
</div>

<table class="table striped highlight responsive-table">
        <thead>
          <tr>
              <th>Image</th>
              <th>Nom</th>
              <th>Pays</th>
              <th>Description</th>
              <th>Code SAQ</th>
              <th>Prix SAQ</th>
              <th>URL SAQ</th>
              <th>Format</th>
              <th>Type</th>
          </tr>
        </thead>

        <tbody>
       
        </tbody>
      </table>
<span class="message"></span>
@endsection

<script src="{{asset('js/bouteille_index.js')}}" defer></script>