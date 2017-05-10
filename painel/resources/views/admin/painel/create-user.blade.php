@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
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
					
					{!! Form::open(['route'=>'admin.painel.create.user', 'class'=>'form'])!!}
						{!! csrf_field() !!}
						<div class="form-group">
						    {!! Form::label('Nome', 'Nome') !!}
						    {!! Form::text('name', null, ['class' => 'form-control']) !!}
						</div>
						<div class="form-group">
						    {!! Form::label('E-mail', 'E-mail') !!}
						    {!! Form::text('email', null, ['class' => 'form-control']) !!}
						</div>
						<div class="form-group">
						    {!! Form::label('Senha', 'Senha') !!}
						    {!! Form::password('password',array('class' => 'form-control')) !!}
						</div>
						<div class="form-group">
						    {!! Form::label('Conforma senha', 'Conforma senha') !!}
							{!! Form::password('confirmpassword',array('class' => 'form-control')) !!}
						</div>
						<div class="form-group">
						{!! Form::submit('Criar Usuário', ['class'=>'btn btn-primary'])!!}
						</div>
						    
					{!! Form::close()!!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
