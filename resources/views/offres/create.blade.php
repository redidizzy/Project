@extends('layouts.appConnected')

@section('content')

    <div class="retouches">
        <div class="container">
            <div class="row">
                <div class="col-md-8 panel-center">
                    <div class="panel panel-default ">
                        <div class="panel-heading text-center">Creer une offre d'emploi </div>

                        <div class="panel-body">
                            <form class="form-horizontal" style="margin-left : 30%;" method="POST"  action="{{ route('offres.store', Auth::user()->id) }}">
                                {{ csrf_field() }}
								
								<div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                    <label for="type" class="col-md-4 control-label">Type du poste : </label>

                                    <div class="col-md-6">
                                        <select name="type" class="form-control">
                                            @foreach($types as $type)
                                                <option value="{{$type->designation}}" id="{{$type->designation}}">{{$type->designation}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('type'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('type') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
								
                                <div class="form-group{{ $errors->has('contenu') ? ' has-error' : '' }}">
                                    <label for="contenu" class="col-md-4 control-label">Contenu :</label></br>

                                    <div class="col-md-6">
                                        <textarea id="contenu" class="form-control" name="contenu">Votre offre...</textarea>

                                        @if ($errors->has('contenu'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('contenu') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-success">
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
 
@endsection
