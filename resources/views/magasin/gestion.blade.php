@extends('templates.menu')
@include('leformdebg')

@section('content')

    <style>
        .col-md-8 .radio-inline {
            width: 275px;
        }

        .r2 {
            width: 70px!important;
        }

        .position_absolute {
            position: fixed;
        z-index: 999;
        bottom: 0;
        width: 100%;
        height: 50px;
        background-color: white;
        -webkit-box-shadow: 0px 2px 19px -1px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 2px 19px -1px rgba(0,0,0,0.75);
        box-shadow: 0px 2px 19px -1px rgba(0,0,0,0.75);
        }

        .btn_fixed {
            height: 40px!important;
            margin-top: 5px!important;
        }

        form{
            margin-bottom: 50px;
        }

        .panel-body {padding: 0}

        .un_coiffeur {
            border: 1px solid #c3c3c3;
            height: 200px;
            text-align: center;
            box-sizing: border-box;
            margin: 10px;
        }
    </style>



    <div class="panel-body">
        <form class="form-horizontal" method="POST"  action="{{ route('update.magasin') }}">
            {{ csrf_field() }}

            <h1 style="text-align: center; margin-bottom:75px;">Gestion de votre boutique</h1>
            <div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Nom de la boutique</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="nom" placeholder="{{$magasin->nom}}" value=" {{$magasin->nom}}" required autofocus>
                    @if ($errors->has('nom'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nom') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <input type="hidden" name="id" value="{{$magasin->id}}" >

            <div class="form-group{{ $errors->has('tel') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">Numéro de télèphone</label>

                <div class="col-md-6">
                    <input id="tel" type="text" class="form-control" name="tel" placeholder="{{ $magasin->tel  }}" value="{{ $magasin->tel  }}" required>

                    @if ($errors->has('tel'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('tel') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('adresse') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">Adresse de la boutique</label>

                <div class="col-md-6">
                    <input id="tel" type="text" class="form-control" name="adresse" placeholder="{{ $magasin->adresse }}" value="{{ $magasin->adresse }}" required>

                    @if ($errors->has('adresse'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('adresse') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group ">
                <label for="email" class="col-md-4 control-label">Logo de la boutique</label>

                <div class="col-md-6">
                    <input type="file" name="logo" value="default.png" class="form-control" />


                </div>
            </div>



            <div class="form-group{{ $errors->has('cp') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">Code Postale de la boutique</label>

                <div class="col-md-6">
                    <input id="tel" type="text" class="form-control" name="cp" placeholder="{{ $magasin->cp }}" value="{{ $magasin->cp }}" required>

                    @if ($errors->has('cp'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('cp') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">Type de client</label>

                <div class="col-md-6">

                    <label class="radio-inline"><input type="radio" checked name="type" value="0">Mixte</label>
                    <label class="radio-inline"><input type="radio" name="type" value="1">Femme</label>
                    <label class="radio-inline"><input type="radio" name="type" value="2">Homme</label>


                    @if ($errors->has('type'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 25px; margin-bottom: 50px;">
            <h3 style="text-align: center;">Vos coiffeurs</h3>

                <div class="col-md-8 col-md-offset-2 ">

                    @forelse ( $coiffeurs as $coiffeur )
                    <div class="col-md-3 un_coiffeur">
                        <div class="col-md-12 ">
                            <h4>{{$coiffeur->nom}}</h4>
                            <li>Nom : @if ( !empty($coiffeur->nom)) {{$coiffeur->nom}} @else Indéfini @endif</li>
                            <li>Sexe : @if ( !empty($coiffeur->sexe)) {{$coiffeur->sexe}} @else Indéfini @endif</li>
                        </div>
                    </div>
                    @empty
                        <p style="text-align: center;">Vous n'avez pas enregistrer de coiffeur</p>
                    @endforelse







                </div>


            </div>

            <div class="col-md-12" style="margin-top: 25px; margin-bottom: 50px;">
                <h3 style="text-align: center;">Vos services</h3>

                <div class="col-md-8 col-md-offset-2 ">
                    @forelse( $taches as $tache )
                    <div class="col-md-3 un_coiffeur">
                        <div class="col-md-12 ">
                            <h4>{{$tache->nom}}</h4>
                            <li>Prix : @if ( !empty($tache->prix)) {{$tache->prix}} @else Indéfini @endif</li>
                            <li>Durée : @if ( !empty($tache->coef_temps)) {{$tache->coef_temps * 30 }}min @else Temps Indéfini @endif</li>
                            <br/>
                            <p>Description : @if ( !empty($tache->desc)) {{$tache->desc }} @else  Indéfini @endif</p>
                        </div>
                    </div>
                    @empty
                        <p style="text-align: center;">Vous n'avez pas enregistrer de service</p>

                    @endforelse






                </div>


            </div>

            <br/>
            <h3 style="text-align: center; margin-bottom: 45px; margin-top: 45px;">Horraire de la boutique</h3>

            <hr/>
            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">Lundi :</label>
                <div class="col-md-8">
                    <label class="radio-inline"><input type="time" name="lundi_m_o" value="{{$horraires[0][1]}}"><label style="margin-left: 10px;">Ouverture Matin</label></label>
                    <label class="radio-inline"><input type="time" name="lundi_m_f" value="{{$horraires[0][2]}}"><label style="margin-left: 10px;">Fermeture Matin</label></label>
                    <br/>
                    <label class="radio-inline"><input type="time" name="lundi_a_o" value="{{$horraires[0][3]}}"><label style="margin-left: 10px;">Ouverture Après-midi</label></label>
                    <label class="radio-inline"><input type="time" name="lundi_a_f" value="{{$horraires[0][4]}}"><label style="margin-left: 10px;">Fermeture Après-midi</label></label>
                    </br>
                    <label class="radio-inline r2"><input type="radio" name="lundi_f" @if( $horraires[0][0] == 0 ) checked @endif value="0">fermer</label>
                    <label class="radio-inline r2"><input type="radio" name="lundi_f" @if( $horraires[0][0] == 1 ) checked @endif value="1">ouvert</label>
                </div>
            </div>
<hr/>
            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">Mardi :</label>

                <div class="col-md-8">
                    <label class="radio-inline"><input type="time" name="mardi_m_o" value="{{$horraires[1][1]}}"><label style="margin-left: 10px;">Ouverture Matin</label></label>
                    <label class="radio-inline"><input type="time" name="mardi_m_f" value="{{$horraires[1][2]}}"><label style="margin-left: 10px;">Fermeture Matin</label></label>
                    <br/>
                    <label class="radio-inline"><input type="time" name="mardi_a_o" value="{{$horraires[1][3]}}"><label style="margin-left: 10px;">Ouverture Après-midi</label></label>
                    <label class="radio-inline"><input type="time" name="mardi_a_f" value="{{$horraires[1][4]}}"><label style="margin-left: 10px;">Fermeture Après-midi</label></label>
                    </br>
                    <label class="radio-inline r2"><input type="radio" name="mardi_f" @if( $horraires[1][0] == 0 ) checked @endif value="0">fermer</label>
                    <label class="radio-inline r2"><input type="radio" name="mardi_f" @if( $horraires[1][0] == 1 ) checked @endif value="1">ouvert</label>
                </div>
            </div>
            <hr/>
            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">Lundi :</label>

                <div class="col-md-8">
                    <label class="radio-inline"><input type="time" name="mercredi_m_o" value="{{$horraires[2][1]}}"><label style="margin-left: 10px;">Ouverture Matin</label></label>
                    <label class="radio-inline"><input type="time" name="mercredi_m_f" value="{{$horraires[2][2]}}"><label style="margin-left: 10px;">Fermeture Matin</label></label>
                    <br/>
                    <label class="radio-inline"><input type="time" name="mercredi_a_o" value="{{$horraires[2][3]}}"><label style="margin-left: 10px;">Ouverture Après-midi</label></label>
                    <label class="radio-inline"><input type="time" name="mercredi_a_f" value="{{$horraires[2][4]}}"><label style="margin-left: 10px;">Fermeture Après-midi</label></label>
                    </br>
                    <label class="radio-inline r2"><input type="radio" name="mercredi_f" @if( $horraires[2][0] == 0 ) checked @endif value="0">fermer</label>
                    <label class="radio-inline r2"><input type="radio" name="mercredi_f" @if( $horraires[2][0] == 1 ) checked @endif value="1">ouvert</label>
                </div>
            </div>
            <hr/>
            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">Lundi :</label>

                <div class="col-md-8">
                    <label class="radio-inline"><input type="time" name="jeudi_m_o" value="{{$horraires[3][1]}}"><label style="margin-left: 10px;">Ouverture Matin</label></label>
                    <label class="radio-inline"><input type="time" name="jeudi_m_f" value="{{$horraires[3][2]}}"><label style="margin-left: 10px;">Fermeture Matin</label></label>
                    <br/>
                    <label class="radio-inline"><input type="time" name="jeudi_a_o" value="{{$horraires[3][3]}}"><label style="margin-left: 10px;">Ouverture Après-midi</label></label>
                    <label class="radio-inline"><input type="time" name="jeudi_a_f" value="{{$horraires[3][4]}}"><label style="margin-left: 10px;">Fermeture Après-midi</label></label>
                    </br>
                    <label class="radio-inline r2"><input type="radio" name="jeudi_f" @if( $horraires[3][0] == 0 ) checked @endif value="0">fermer</label>
                    <label class="radio-inline r2"><input type="radio" name="jeudi_f" @if( $horraires[3][0] == 1 ) checked @endif value="1">ouvert</label>
                </div>
            </div>
            <hr/>
            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">Lundi :</label>
                <div class="col-md-8">
                    <label class="radio-inline"><input type="time" name="vendredi_m_o" value="{{$horraires[4][1]}}"><label style="margin-left: 10px;">Ouverture Matin</label></label>
                    <label class="radio-inline"><input type="time" name="vendredi_m_f" value="{{$horraires[4][2]}}"><label style="margin-left: 10px;">Fermeture Matin</label></label>
                    <br/>
                    <label class="radio-inline"><input type="time" name="vendredi_a_o" value="{{$horraires[4][3]}}"><label style="margin-left: 10px;">Ouverture Après-midi</label></label>
                    <label class="radio-inline"><input type="time" name="vendredi_a_f" value="{{$horraires[4][4]}}"><label style="margin-left: 10px;">Fermeture Après-midi</label></label>
                    </br>
                    <label class="radio-inline r2"><input type="radio" name="vendredi_f" @if( $horraires[4][0] == 0 ) checked @endif value="0">fermer</label>
                    <label class="radio-inline r2"><input type="radio" name="vendredi_f" @if( $horraires[4][0] == 1 ) checked @endif value="1">ouvert</label>
                </div>
            </div>
            <hr/>
            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">Lundi :</label>
                <div class="col-md-8">
                    <label class="radio-inline"><input type="time" name="samedi_m_o" value="{{$horraires[5][1]}}"><label style="margin-left: 10px;">Ouverture Matin</label></label>
                    <label class="radio-inline"><input type="time" name="samedi_m_f" value="{{$horraires[5][2]}}"><label style="margin-left: 10px;">Fermeture Matin</label></label>
                    <br/>
                    <label class="radio-inline"><input type="time" name="samedi_a_o" value="{{$horraires[5][3]}}"><label style="margin-left: 10px;">Ouverture Après-midi</label></label>
                    <label class="radio-inline"><input type="time" name="samedi_a_f" value="{{$horraires[5][4]}}"><label style="margin-left: 10px;">Fermeture Après-midi</label></label>
                    </br>
                    <label class="radio-inline r2"><input type="radio" name="samedi_f" @if( $horraires[5][0] == 0 ) checked @endif value="0">fermer</label>
                    <label class="radio-inline r2"><input type="radio" name="samedi_f" @if( $horraires[5][0] == 1 ) checked @endif value="1">ouvert</label>
                </div>
            </div>
            <hr/>
            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">Lundi :</label>
                <div class="col-md-8">
                    <label class="radio-inline"><input type="time" name="dimanche_m_o" value="{{$horraires[6][1]}}"><label style="margin-left: 10px;">Ouverture Matin</label></label>
                    <label class="radio-inline"><input type="time" name="dimanche_m_f" value="{{$horraires[6][2]}}"><label style="margin-left: 10px;">Fermeture Matin</label></label>
                    <br/>
                    <label class="radio-inline"><input type="time" name="dimanche_a_o" value="{{$horraires[6][3]}}"><label style="margin-left: 10px;">Ouverture Après-midi</label></label>
                    <label class="radio-inline"><input type="time" name="dimanche_a_f" value="{{$horraires[6][4]}}"><label style="margin-left: 10px;">Fermeture Après-midi</label></label>
                    </br>
                    <label class="radio-inline r2"><input type="radio" name="dimanche_f" @if( $horraires[6][0] == 0 ) checked @endif value="0">fermer</label>
                    <label class="radio-inline r2"><input type="radio" name="dimanche_f" @if( $horraires[6][0] == 1 ) checked @endif value="1">ouvert</label>
                </div>
            </div>

            <hr/>
            <div class="position_absolute">
                <div class="form-group">
                    <div class="col-md-2 col-md-offset-4">
                        <button type="submit" class="btn btn-primary btn_fixed">
                            Sauvegarder votre boutique
                        </button>
                    </div>
                    <a style="color: white!important; background-color: #2579a9;" class="btn btn-primary btn_fixed" href="{{route('coiffeur.create')}}">Ajouter un coiffeur</a>
                    <a style="color: white!important; background-color: #2579a9;" class="btn btn-primary btn_fixed" href="{{route('tache.create')}}">Ajouter un service</a>
                </div>
            </div>
        </form>
    </div>

@endsection
