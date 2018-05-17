@extends('layouts.appConnected')

@section('content')

    <div class="retouches">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">Informations Generales</div>

                        <div class="panel-body">
                            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('utilisateur.saveChange', $user->id) }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
                                    <label for="nom" class="col-md-4 control-label">Nom</label>

                                    <div class="col-md-6">
                                        <input id="nom" type="text" class="form-control" name="nom" value="{{ $user->nom }}" required autofocus>

                                        @if ($errors->has('nom'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nom') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('prenom') ? ' has-error' : '' }}">
                                    <label for="prenom" class="col-md-4 control-label">Prenom</label>

                                    <div class="col-md-6">
                                        <input id="prenom" type="text" class="form-control" name="prenom" value="{{ $user->prenom }}" required autofocus>

                                        @if ($errors->has('prenom'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('prenom') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('dateNaiss') ? ' has-error' : '' }}">
                                    <label for="dateNaiss" class="col-md-4 control-label">Prenom</label>

                                    <div class="col-md-6">
                                        <input id="dateNaiss" type="date" class="form-control" name="dateNaiss" value="{{ $user->dateNaiss }}" required autofocus>

                                        @if ($errors->has('dateNaiss'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('dateNaiss') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                    <div class="form-group{{ $errors->has('numTel') ? ' has-error' : '' }}">
                                    <label for="numTel" class="col-md-4 control-label">Numero de telephone</label>

                                    <div class="col-md-6">
                                        <input id="numTel" type="tel" class="form-control" name="numTel" value="{{ $user->numTel }}" required>

                                        @if ($errors->has('numTel'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('numTel') }}</strong>
                                            </span>
                                        @endif

                                    </div>
                                </div>

                                <!-- <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div> -->
                                <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                                    <label for="photo" class="col-md-4 control-label">Photo : </label>

                                    <div class="col-md-6">
                                        <input id="photo" type="file" class="form-control" name="photo">

                                        @if ($errors->has('photo'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('photo') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('wilaya') ? ' has-error' : '' }}">
                                    <label for="wilaya" class="col-md-4 control-label">Wilaya</label>

                                    <div class="col-md-6">
                                        <select id="wilaya" class="form-control" name="wilaya" required>
                                        @foreach(config('variables.wilayas') as $nwil=>$wil)
                                            @if($user->wilaya == $nwil)
                                            <option value="{{$nwil}}" id="{{$nwil}}" selected>{{$nwil}}-{{$wil}}</option>
                                            @else
                                            <option value="{{$nwil}}" id="{{$nwil}}">{{$nwil}}-{{$wil}}</option>
                                            @endif
                                        @endforeach
                                        </select>

                                        @if ($errors->has('wilaya'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('wilaya') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('region') ? ' has-error' : '' }}">
                                    <label for="region" class="col-md-4 control-label">Region</label>

                                    <div class="col-md-6">
                                        <select name="region" id="region" class="form-control">
                                        
                                        </select>

                                        @if ($errors->has('region'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('region') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary">
                                            Enregister
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    </div>
</div>

<script src = "{{asset('rateit/jquery.rateit.js')}}"></script>
@endsection
