@extends('layouts.appConnected')

@section('content')

    <div class="retouches">
        <div class="container">
            <div class="row">
                <div class="col-md-8 panel-center">
                    <div class="panel panel-default ">
                        <div class="panel-heading text-center">Editer l'offre</div>

                        <div class="panel-body">
                            <form class="form-horizontal" style="margin-left : 30%;" method="POST"  action="{{ route('offres.update', $offre->id) }}">
                                {{ csrf_field() }}
						
								
                               <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                    <label for="type" class="col-md-4 control-label">Type poste:</label>

                                    <div class="col-md-6">
                                        @php $typeAct = $offre->type->designation @endphp
									
										
                                        <select name="type" class="form-control">
                                            @foreach($types as $type)
                                                
                                                <option value="{{$type->designation}}" id="{{$type->designation}}" {{$typeAct == $type->designation ? 'selected' : ''}} >{{$type->designation}}</option>
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
                                    <label for="contenu" class="col-md-4 control-label">Contenu : </label></br>

                                    <div class="col-md-6">
                                        <textarea id="contenu" class="form-control" name="contenu">{{$offre->contenu}}</textarea>

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