@extends('app')

@section('content')

{!! Html::script('js/angular/lib/loading-bar.js') !!}
{!! Html::style('js/angular/lib/loading-bar.css') !!}

{!! Html::script('js/angular/user/userCtrl.js') !!}
{!! Html::script('js/angular/user/userAPIService.js') !!}

<div class="container-fluid" ng-app="user">
	<div class="row" ng-controller="userCtrl">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Registro de usuário</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					
					{!! Form::open(['class'=>'form', 'name'=>'form'])!!}
						{!! csrf_field() !!}
						<div class="form-group">
						    {!! Form::label('Nome', 'Nome') !!}
						    {!! Form::text('name', null, ['class' => 'form-control', 'ng-model'=>'user.name', 'required', 'ng-required'=>'true']) !!}
						</div>
						<div class="form-group">
						    {!! Form::label('E-mail', 'E-mail') !!}
						    {!! Form::text('email', null, ['class' => 'form-control', 'ng-model'=>'user.email', 'required', 'ng-required'=>'true']) !!}
						</div>
						<div class="form-group">
						    {!! Form::label('Senha', 'Senha') !!}
						    {!! Form::password('password',array('class' => 'form-control', 'required', 'ng-model'=>'user.password', 'ng-required'=>'true')) !!}
						</div>
						<div class="form-group">
						    {!! Form::label('Conforma senha', 'Conforma senha') !!}
							{!! Form::password('confirmpassword',array('class' => 'form-control', 'required', 'ng-model'=>'user.confirmpassword', 'ng-required'=>'true')) !!}
						</div>
						<div class="form-group">
						{!! Form::button('Criar Usuário', ['class'=>'btn btn-success', 'ng-click'=>'save(user)', 'ng-disabled'=>'form.$invalid'])!!}
						</div>
						<div id="loading-bar-container"></div>
					{!! Form::close()!!}
					<div class="snackbar-container" data-snackbar="true" data-snackbar-duration="5000" data-snackbar-remove-delay="200"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
	#loading-bar .bar {
		position: relative;
		background: #333;
		height: 7px;
	}
</style>
@endsection
