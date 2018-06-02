@extends('layouts.appConnected')

@section('content')
<div class="retouches">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            	<div class="panel panel-danger">
                	<div class="panel-heading">{{$titre}}</div>
                	<div class="panel-body">
                		{{$msg}}
                	</div>
                    <div class="panel-footer clearfix">
                        <a href="{{url()->previous()}}" class="btn btn-success floatRight">Retour</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

