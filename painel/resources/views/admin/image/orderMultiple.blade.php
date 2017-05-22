@extends('app')
{!! Html::style('css/style.css') !!}
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Alterar Ordem das imagens</h4></div>
				<div class="panel-body">
					
					@include('errors._check')

					{!! Form::model($uploads, ['route'=>['admin.image.update.multiple', $uploads->id], 'files'=>true])!!}

					@foreach($uploads->upload as $upload)
						
						<div class="align-image">
							<div class="form-group">
								<img src="{{$upload->way}}{{$upload->original_filename}}" class="img-project-edit" alt="">
							</div>
						</div>
		
						<div class="form-group">
							<label>Ordem</label>
							<input type="text" class="form-control" name="order" value="{{$upload->order}}">
						</div>
		
						<hr>
					
					@endforeach
					

					<div class="form-group">
						{!! Form::submit('Salvar Ordem', ['class'=>'btn btn-primary'])!!}
					</div>

					{!! Form::close()!!}
					
				</div>
			</div>
		</div>
	</div>
	@endsection