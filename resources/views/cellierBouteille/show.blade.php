@extends('layouts.app')
@section('content')

@if(Session::get('nouvelleCellier'))
<span class="nouvelleCellier"></span>
@endif

@if(Session::get('modifieBouteille'))
<span class="modifieBouteille"></span>
@endif

<link href="{{asset('css/cellierBouteillesListe.css')}}" rel="stylesheet" />
<link href="{{asset('css/star-rating.css')}}" rel="stylesheet" />
<link href="{{asset('css/fiche-vin.css')}}" rel="stylesheet"  />

<header>
    <div class="cellier">
        <select name ="select-cellier">
            @foreach($celliers as $unCellier)
            <option value="{{ $unCellier->id }}" @if( $unCellier->id == $cellier->id) selected @endif> Cellier | {{ $unCellier->nom}} </option>
            @endforeach
        </select>
    </div>
    <div class="bouteille-nom">
        <select  name ="select-bouteille">
            @foreach($cellierBouteillesByIDs as $vin)
            <option value="{{ $vin['id'] }}" @if( $vin['id'] == $bouteille->id) selected @endif>Vin | {{ $vin['bouteille']->nom}} </option>
            @endforeach
        </select>
    </div>
</header>
<main>
    <section class="info-fiche">
        <article class="infoBouteilleConteneur-fiche">
            <div class="">
                <p class="bold">@if($bouteille->pays){{ $bouteille->pays }} | @endif {{ $bouteille->type }}</p>
                <p>{{  $bouteille->format }}</p>
                <p>{{  $bouteille->taille }} cl</p>
                <p class="prixSaq">Prix Saq | @if($bouteille->prix_saq)<span class="bold-20px">{{ $bouteille->prix_saq  }} $</span> @else N/A @endif</p>
            </div>
            <div>
                <div class="bouteilleSAQConteneur-fiche">
                    @if($bouteille->url_saq)
                    <a class="lienSAQ" href="{{ $bouteille->url_saq }}">SAQ</a>
                    @endif
                </div>
                @if(!$bouteille->url_saq && $bouteille->user_id == Session::get('user')->id)
                    <a class="bouteilleSAQConteneur-fiche" href="{{ route('bouteilleEdit', $bouteille->id)}}"><i class="material-icons-fiche">edit</i></a>
                @endif
            </div>
        </article>
    </section>


    <!-- Deuxième section de la fiche d'un vin, le "Millésime -->
    <!-- Bouton millésime, via le clique pour afficher les info -->
    <section class="millesime-conteneur-encadre">
        <div class="nom-Millesime-Fiche">
            <h2>Millésimes</h2>
            <div class="icon-millesime-action">
                <a name="ajouterMillesime" class="btn-floating btn-big waves-effect waves-light valider"  ><i class="material-icons">add</i></a>
                <a class="btn-floating btn-big waves-effect waves-light  modifier "  data-js-modifier ><i class="material-icons">edit</i></a>
                <a class="btn-floating btn-big waves-effect waves-light  supprimer modal-trigger "  href="#modal-suprimer"  data-js-btnEffacer><i class="material-icons">delete</i></a>
            </div> 
        </div>
        <div class="millesime-conteneur">
            @foreach($cellierBouteilleMillesime as $cellierBouteille)
            <div  data-js-bouton="{{ $cellierBouteille->millesime }}">
                <button @if($loop->last) class="millesime-item-selected millesime-item"  @endif id="bouton-millesime"class="millesime-item" >
                    @if($cellierBouteille->millesime  != 0)
                        <p>{{ $cellierBouteille->millesime }}</p>
                    @else
                        <p>N/A</p>
                    @endif
                </button>
            </div>
            @endforeach
        </div>
        
    <!-- Section du fomulaire -->

        <div class="form-modifier form">
            <form id="" name="myForm" action="" method="POST" class="form-modifier" data-js-form>
                @method('PUT')
                @csrf
                <div class="millesime-info-debut">
                    <!-- L'image  -->
                    @if (isset($bouteille->url_img))
                        <img class="image-fiche" src="{{ $bouteille->url_img}}" alt="">
                    @else
                        <img class="image-fiche" src="{{asset('assets/icon/bouteille-fiche-vin.svg')}}" alt="">
                    @endif
                    <div>
                        <div class="select-form"> <!-- La note de 0 à 5 sous forme d'étoiles -->
                            <select class="star-rating"  name="note"  data-id-bouteille="{{$cellierBouteille->bouteille_id}}" data-millesime="{{$cellierBouteille->millesime}}">
                                <option value="">Choisir une note</option>
                                <option value="5" @if( $cellierBouteille->note == 5) selected @endif>Excellent</option>
                                <option value="4" @if( $cellierBouteille->note == 4) selected @endif>Très bon </option>
                                <option value="3" @if( $cellierBouteille->note == 3) selected @endif>Passable</option>
                                <option value="2" @if( $cellierBouteille->note == 2) selected @endif>Médiocre</option>
                                <option value="1" @if( $cellierBouteille->note == 1) selected @endif>Terrible</option>
                            </select>
                        </div>
                        <div>
                            <div class="form-modifier-item " >
                                <label for="millesime">Millésime</label>
                                <input  name="millesime" readonly id="millesime"  class="input-fiche-cercle" value="@if($cellierBouteille->millesime != 0){{ $cellierBouteille->millesime }} @else N/A @endif"/>
                                <select name ="select-millesime" >
                                <option value="" disabled selected></option>
                                {{ $anneeDebut= 1700 }}
                                {{ $anneePresent = date('Y') }}

                                @for ($i = $anneePresent; $i >= $anneeDebut; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                                </select>
                            </div>
                            <p id="messageMillesime" class="nonValide"></p>
                            <div class="form-modifier-item" >
                                <label for="prix">Prix d'achat</label>
                                <input type="number" name="prix"  readonly id="prix" data-js-input class="input-fiche-cercle" value="{{number_format((float)$cellierBouteille->prix, 2, '.', '')}}"/>
                            </div>
                            <p id="messagePrix" class="nonValide"></p>
                            <div class="form-modifier-item" >
                                <label for="quantite">Qte</label>
                                <input type="number" name="quantite" readonly id="quantite" data-js-input class="input-fiche-cercle" value="{!! $cellierBouteille->quantite !!}"/>
                            </div>
                            <p id="messageQuantite" class="nonValide"></p>
                        </div>
                    </div>
                </div>
                <div class="millesime-info-fin">
                    <div class="item-commentaire" >
                        <label for="commentaire">Commentaire</label>
                        <input type="textarea" name="commentaire" readonly id="commentaire" data-js-input class="textarea" placeholder="Aucun commentaire" value="{{ $cellierBouteille->commentaire }}"/>
                        <p id="messageCommentaire" class="nonValide"></p>
                    </div>
                    <div class="item-commentaire" >
                        <label for="garde_jusqua">Garder jusqu'à</label>
                        <input type="textarea" name="garde_jusqua" readonly placeholder="Non disponible" id="garde_jusqua" data-js-input class="textarea" value="{!! $cellierBouteille->garde_jusqua !!}"/>
                        <p id="messageGardeJusqua" class="nonValide"></p>
                    </div>
                    <div class="item-commentaire" >
                        <div>
                            <label for="date_achat">Date d'achat</label>
                            <input type="text" name="date_achat" disabled tabindex="-1" autocomplete="off" class="datepicker" id="date_achat" data-js-input class="" value="{!! $cellierBouteille->date_achat !!}"/>
                        </div>
                    </div>
                </div>

                <!-- Validation  -->
                <!-- Boutons, modifier, annuler, valider, suprimer -->

                <div class="bouton">
                    <button class="bouton-fiche valider hide"  data-js-ajouter>Ajouter</button>
                    <button  class="bouton-fiche valider non-active modal-trigger" href="#modal-valider" data-js-btnValider >Valider</button>
                    <button class="bouton-fiche non-active" data-js-btnAnnuler>Annuler</button>
                </div>

                <!-- Modal bouton suprimer -->
                <div id="modal-suprimer" class="modal">
                    <div class="modal-content">
                        <h4>Supprimer ce millésime</h4>
                        <p>Êtes-vous certain de vouloir supprimer ce millésime et les informations qu'il contient?</p>
                    </div>
                    <div class="modal-footer">
                        <button class="waves-effect waves-green btn-flat modale-close" data-js-suprimerModal >Supprimer</button>
                        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Annuler</a>
                    </div>
                </div>
                 <!-- Modal bouton valider -->
                 <div id="modal-valider" class="modal">
                    <div class="modal-content">
                        <h4>Modifier ce millésime</h4>
                        <p>Êtes-vous certain de vouloir modifier ce millésime, en cliquant valider les informations seront modifiées.</p>
                    </div>
                    <div class="modal-footer">
                        <button class="waves-effect waves-green btn-flat modal-close" data-js-validerModal >Valider</button>
                        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Annuler</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>

<script src="{{asset('js/cellierBouteille_show.js')}}" defer></script>
<script src="{{asset('js/star-rating.js')}}" defer></script>
<script src="{{asset('js/cellier_index.js')}}" defer></script>
@endsection





