@extends('app')
{!! Html::style('css/style.css') !!}
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Registro de projeto</h4></div>
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
					
					{!! Form::open(['route'=>'admin.painel.create.project', 'class'=>'form', 'files'=>true])!!}
						{!! csrf_field() !!}
						
							@include('admin.project._form')

							<div class="form-group">
								<span class="btn btn-default btn-file">
									{!! Form::file('images[]', array('multiple'=>true, 'class'=>'custom-file-input')) !!}
									<span class="glyphicon glyphicon-folder-open"></span> Selecione as imagens
								</span>
							</div>
						
						<div class="form-group">
						{!! Form::submit('Criar Projeto', ['class'=>'btn btn-primary'])!!}
						</div>
						    
					{!! Form::close()!!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection