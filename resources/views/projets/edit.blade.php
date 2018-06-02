@extends('layouts.appConnected')

@section('content')

    <div class="retouches">
        <div class="container">
            <div class="row">
                <div class="col-md-8 panel-center">
                    <div class="panel panel-default ">
                        <div class="panel-heading text-center">Creer un projet</div>

                        <div class="panel-body">
                            <form class="form-horizontal" style="margin-left : 30%;" method="POST"  action="{{ route('projets.update', $projet->id) }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                    <label for="type" class="col-md-4 control-label">Type</label>

                                    <div class="col-md-6">
                                        @php $typeAct = $projet->type->designation @endphp
									
										
                                        <select name="type" class="form-control">
                                            @foreach($types as $type)
                                                
                                                <option value="{{$type->designation}}" id="{{$type->designation}}" {{$typeAct == $type->designation ? 'selected' : ''}}>{{$type->designation}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('type'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('type') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label for="description" class="col-md-4 control-label">Description</label>

                                    <div class="col-md-6">
                                        <textarea id="description" class="form-control" name="description">{{$projet->description}}</textarea>

                                        @if ($errors->has('Description'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('Description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('superficie') ? ' has-error' : '' }}">
                                    <label for="superficie" class="col-md-4 control-label">Superficie</label>

                                    <div class="col-md-6">
                                        <input id="superficie" type="text" value="{{$projet->superficie}}" class="form-control" name="superficie" required autofocus>

                                        @if ($errors->has('superficie'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('superficie') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                     <div class="form-group{{ $errors->has('wilaya') ? ' has-error' : '' }}">
                                    <label for="wilaya" class="col-md-4 control-label">Wilaya</label>

                                    <div class="col-md-6">
                                        <select id="wilaya" class="form-control" name="wilaya" required>
                                        @foreach(config('variables.wilayas') as $nwil=>$wil)
                                            @if($projet->wilaya == $nwil)
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
                                        @foreach(config('variables.communes.'.$projet->wilaya) as $commune)
                                            @if($commune == $projet->region)
                                            <option value="{{$commune}}" id="{{$commune}}" selected>{{$commune}}</option>
                                            @else
                                            <option value="{{$commune}}" id="{{$commune}}">{{$commune}}</option>
                                            @endif
                                        @endforeach   

                                        </select>

                                        @if ($errors->has('region'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('region') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('budget') ? ' has-error' : '' }}">
                                    <label for="budget" class="col-md-4 control-label">Budget : </label>

                                    <div class="col-md-6">
                                        <input id="budget" type="text" value="{{$projet->budget}}" class="form-control" name="budget"  required>

                                        @if ($errors->has('region'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('Budget') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                 <div class="form-group{{ $errors->has('delai') ? ' has-error' : '' }}">
                                    <label for="delai" class="col-md-4 control-label">Delai : </label>

                                    <div class="col-md-6">
                                        <input id="delai" type="text" value="{{$projet->delai}}" class="form-control" name="delai"  required>

                                        @if ($errors->has('delai'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('delai') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <input type="checkbox" name="necessiteEntrepreneur" id="necessiteEntrepreneur" {{$projet->necessiteEntrepreneur ? 'checked' : ''}} /><label for="necessiteEntrepreneur" class="col-md-10 control-label">Ce projet necessite un entrepreneur et pas des ouvriers independants</label>
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
