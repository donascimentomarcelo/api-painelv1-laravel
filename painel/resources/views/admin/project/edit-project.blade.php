@extends('app')

@section('content')

{!! Html::style('css/style.css') !!}

{!! Html::script('js/angular/lib/loading-bar.js') !!}
{!! Html::style('js/angular/lib/loading-bar.css') !!}

{!! Html::script('js/angular/lib/upload/ng-file-upload-shim.js') !!}
{!! Html::script('js/angular/lib/upload/ng-file-upload.js') !!}

{!! Html::script('js/angular/project/projectCtrl.js') !!}
{!! Html::script('js/angular/project/projectAPIService.js') !!}

<div class="container-fluid" ng-app="project">
	<div class="row" ng-controller="projectCtrl">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Registro de projeto</h4></div>
				<div class="panel-body">
					<form name="searchById">
						<div class="form-group">
							<div class="row">
								<div class="col-md-12">
								<label for="">Código do Projeto</label>
									<div class="input-group">
										<input type="number" class="form-control" min="0" ng-model="cod.id" ng-required="true">
										<span class="input-group-btn">
											<button class="btn btn-primary"  type="button" ng-click="edit(cod)" ng-disabled="searchById.$invalid">
												<span class="glyphicon glyphicon-search"></span>
											</button>
										</span>
									</div>
								</div> 
							</div>
						</div>
					</form>
					{!! Form::open(['name'=>'form', 'class'=>'form', 'files'=>true])!!}
						{!! csrf_field() !!}

							<div class="form-group">
								{!! Form::hidden('id', null, ['class' => 'form-control', 'ng-model'=>'project.id']) !!}
							</div>
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
						{!! Form::button('Salvar', ['class'=>'btn btn-primary', 'ng-click'=>'update(project)'])!!}
						</div>

					<div id="loading-bar-container"></div>	    
					{!! Form::close()!!}

						<div class="panel panel-default" ng-show="project.upload.data">
							<div class="panel-heading">
								<h4> Imagens do projeto </h4>
							</div>
							<div class="form-group">
								<div class="row">
									<div ng-repeat="p in project.upload.data" class="col-md-4">
										<form name="imageForm">
											<img data-ng-src="<% p.way + p.original_filename %>" class="img-project-list">
											<div class="form-group">
												<span class="btn btn-info btn-file btn-sm">
													<input type="file" ngf-select ng-model="p.file" name="file" accept="image/*" ngf-max-size="2MB">
													<span class="glyphicon glyphicon-picture"></span> 
												</span>
												<button class="btn btn-success btn-sm" ng-click="updateImage(p)">
													<span class="glyphicon glyphicon-pencil"></span>
												</button>
												<button class="btn btn-danger btn-sm" ng-click="deleteImage(p)">
													<span class="glyphicon glyphicon-trash"></span>
												</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
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