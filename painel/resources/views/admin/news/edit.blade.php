@extends('app')
{!! Html::style('css/style.css') !!}
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Editar Publicação: {{$news->title}}</h4></div>
				<div class="panel-body">
					
					@include('errors._check')

					<div class="alert alert-warning alert-del-img">
					<strong>Informações Importantes.</strong><br>
						Você pode alterar a publicação e reenviar ou você pode apenas reenviar sem realizar alterações.
					</div>

					{!! Form::model($news, ['route'=>['admin.painel.email.update', $news->id]])!!}
					
					{!! csrf_field() !!}

					@include('admin.news._form')

					<div class="form-group">
					{!! Form::submit('Salvar e Enviar', ['class'=>'btn btn-primary'])!!}
					</div>

					{!! Form::close()!!}
					
				</div>
			</div>
		</div>
	</div>
	@endsection