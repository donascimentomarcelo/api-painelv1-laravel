@extends('app')
{!! Html::style('css/style.css') !!}
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Editar Projeto: #{{$projects->name}}</h4></div>
				<div class="panel-body">
					
					@include('errors._check')

					{!! Form::model($projects, ['route'=>['admin.painel.update', $projects->id], 'files'=>true])!!}

					@include('admin.project._form')
					<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#{{$projects->id}}">Exibir Imagens</button>	
					<hr>

					<div id="{{$projects->id}}" class="collapse">
						<div class="row">
							@foreach($projects->upload as $key)
							<div class="col-sm-4">
								<div class="form-group">

									<a href="{{route('admin.painel.image',['id'=>$key->id])}}" class="btn btn-success btn-sm">
										<span class="glyphicon glyphicon-pencil"></span>
									</a>

									<a href="{{route('admin.painel.image.delete',['id'=>$key->id])}}" class="btn btn-danger btn-sm">
										<span class="glyphicon glyphicon-trash"></span>
									</a>

								</div>
								<img src="{{$key->way}}{{$key->original_filename}}" class="img-project" alt="">
							</div>
							@endforeach
						</div>
					</div>
					<hr>
					<div class="form-group">
						{!! Form::submit('Salvar Projetos', ['class'=>'btn btn-primary'])!!}
					</div>

					{!! Form::close()!!}
					
				</div>
			</div>
		</div>
	</div>
	@endsection