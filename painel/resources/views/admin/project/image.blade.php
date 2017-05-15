@extends('app')
{!! Html::style('css/style.css') !!}
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Editar Imagem: {{$upload->filename}}</h4></div>
				<div class="panel-body">
					
						@include('errors._check')

						{!! Form::model($upload, ['route'=>['admin.painel.image.update', $upload->id], 'files'=>true])!!}
						
						<div class="align-image">
							<label for="">Imagem do projeto</label>
							<div class="form-group">
								<img src="{{$upload->way}}{{$upload->original_filename}}" class="img-project-edit" alt="">
							</div>
						</div>

						<div class="form-group">
							<label for="order">Ordem da imagem</label>
							<input type="number" id="order" name="order" class="form-control">
						</div>

						<div class="form-group">
							<span class="btn btn-default btn-file">
								{!! Form::file('images[]', array('multiple'=>true, 'class'=>'custom-file-input')) !!}
								<span class="glyphicon glyphicon-folder-open"></span> Selecione outra imagem
							</span>
						</div>
						
						<div class="form-group">
							{!! Form::submit('Alterar Imagem', ['class'=>'btn btn-primary'])!!}
							{!! Form::submit('Deletar Imagem', ['class'=>'btn btn-danger'])!!}
						</div>

						{!! Form::close()!!}
					
				</div>
			</div>
		</div>
	</div>
	@endsection