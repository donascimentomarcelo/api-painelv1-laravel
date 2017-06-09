@extends('app')

@section('content')

{!! Html::style('css/style.css') !!}
{!! Html::script('js/angular/lib/loading-bar.js') !!}
{!! Html::style('js/angular/lib/loading-bar.css') !!}

{!! Html::script('js/angular/lib/upload/ng-file-upload-shim.js') !!}
{!! Html::script('js/angular/lib/upload/ng-file-upload.js') !!}
{!! Html::script('js/angular/project/projectCtrl.js') !!}

<div class="container-fluid" ng-app="project">
	<div class="row" ng-controller="projectCtrl">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Registro de projeto</h4></div>
				<div class="panel-body">
					
					{!! Form::open(['name'=>'form', 'class'=>'form', 'files'=>true])!!}
						{!! csrf_field() !!}
						
							<div class="form-group">
								{!! Form::label('Nome', 'Nome') !!}
								{!! Form::text('name', null, ['class' => 'form-control', 'ng-model'=>'project.name']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('Categoria', 'Categoria') !!}
								{!! Form::text('category', null, ['class' => 'form-control', 'ng-model'=>'project.category']) !!}
							</div>

							<div class="form-group">
								{!! Form::label('Link', 'Link') !!}
								{!! Form::text('link', null, ['class' => 'form-control', 'ng-model'=>'project.link']) !!}
							</div>

							<div class="form-group">
								{!! Form::label('Descrição', 'Descrição') !!}
								{!! Form::textarea('description', null, ['class' => 'form-control', 'ng-model'=>'project.description']) !!}
							</div>


							<div class="form-group">
								<span class="btn btn-default btn-file">
									<input type="file" ngf-select ng-model="file" name="file"    
									accept="image/*" ngf-max-size="2MB" required
									ngf-model-invalid="errorFile">
									<span class="glyphicon glyphicon-folder-open"></span> Selecione as imagens
								</span>
							</div>

						
						<div class="form-group">
						{!! Form::button('Criar Projeto', ['class'=>'btn btn-primary', 'ng-click'=>'save(project)'])!!}
						</div>
						    
					{!! Form::close()!!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection