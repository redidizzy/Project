
@extends('layouts.error')

@section('content')
<div class="retouches">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            	<div class="panel panel-danger">
                	<div class="panel-heading">La page que vous recherchez est introuvable </div>
                	<div class="panel-body">
                		La page que vous recherchez est introuvable
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

