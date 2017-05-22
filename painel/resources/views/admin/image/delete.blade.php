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

						<div class="alert alert-danger alert-del-img">
							<strong>Deseja escluir esta imagem?</strong><br>
							Ao excluir a imagem será removida das configurações assim sendo não poderá ser recuperada novamente.
						</div>

						{!! Form::model($upload, ['route'=>['admin.painel.image.destroy', $upload->id]])!!}
						
						<div class="align-image">
							<label for="">Imagem do projeto</label>
							<div class="form-group">
								<img src="{{$upload->way}}{{$upload->original_filename}}" class="img-project-edit" alt="">
							</div>
						</div>
						<div class="form-group">
							{!! Form::submit('Excluir Imagem', ['class'=>'btn btn-danger'])!!}
						</div>

						{!! Form::close()!!}
					
				</div>
			</div>
		</div>
	</div>
	@endsection

