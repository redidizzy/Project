@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
                            <label for="nom" class="col-md-4 control-label">Nom</label>

                            <div class="col-md-6">
                                <input id="nom" type="text" class="form-control" name="nom" value="{{ old('nom') }}" required autofocus>

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
                                <input id="prenom" type="text" class="form-control" name="prenom" value="{{ old('prenom') }}" required autofocus>

                                @if ($errors->has('prenom'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('prenom') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Adresse e-mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('dateNaiss') ? ' has-error' : '' }}">
                            <label for="dateNaiss" class="col-md-4 control-label">Prenom</label>

                            <div class="col-md-6">
                                <input id="dateNaiss" type="date" class="form-control" name="dateNaiss" value="{{ old('dateNaiss') }}" required autofocus>

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
                                <input id="numTel" type="tel" class="form-control" name="numTel" value="{{ old('numTel') }}" required>

                                @if ($errors->has('numTel'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('numTel') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
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
                        </div>
                        <div class="form-group{{ $errors->has('prenom') ? ' has-error' : '' }}">
                            <label for="photo" class="col-md-4 control-label">Photo : </label>

                            <div class="col-md-6">
                                <input id="photo" type="file" class="form-control" name="photo" value="{{ old('photo') }}" required>

                                @if ($errors->has('photo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('prenom') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('wilaya') ? ' has-error' : '' }}">
                            <label for="wilaya" class="col-md-4 control-label">Wilaya</label>

                            <div class="col-md-6">
                                <input id="wilaya" type="number" class="form-control" name="wilaya" value="{{ old('wilaya') }}" required>

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
                                <input id="region" type="text" class="form-control" name="region" value="{{ old('region') }}" required>

                                @if ($errors->has('region'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('region') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">Type d'utilisateur</label>

                            <div class="col-md-6">
                                <select name="type" id="type" class="form-control">
                                        <option value="Entrepreneur" id="entrepreneur">Entrepreneur </option>
                                        <option value="Client" id="client">Client</option>
                                        <option value="Ouvrier" id ="ouvrier">Ouvrier</option>
                                </select>
                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>
                        <!-- /////////////////////////////////////////////Info ouvriers////////////////-->
                        <div id="Info_Ouvrier" class="collapse ">
                            <div class="form-group{{ $errors->has('fonction') ? ' has-error' : '' }}">
                                <label for="fonction" class="col-md-4 control-label">Profession</label>

                                <div class="col-md-6">
                                    <select name="fonction" id="fonction" class="form-control">
                                            @foreach($fonctions as $fonction)
                                                <option value="{{$fonction->designation}}" id="$fonction->designation">{{$fonction->designation}} </option>
                                            @endforeach
                                    </select>
                                    @if ($errors->has('fonction'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fonction') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('diplome') ? ' has-error' : '' }}">

                                <div class="col-md-6">
                                    <input type="checkbox" name="diplome" id="diplome" />
                                    <label for="diplome">Je suis diplome</label>
                                    @if ($errors->has('fonction'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fonction') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 <script src="{{ asset('js/JQuery.js') }}"></script>
    <script href="{{ asset('css/Bootstrap/js/bootstrap.js') }}"></script>
<script>
    $(function(){
        $("#type").change(function(){
                if($("#type").val() === "Ouvrier")
                    $("#Info_Ouvrier").collapse("show");
                else
                    $("#Info_Ouvrier").collapse("hide");
            
                
        });
    });
</script>
@endsection
