@extends('app')
{!! Html::style('css/style.css') !!}
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Lista de Projetos</h4></div>
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
					<table class="table">
						<thead>
							<tr>
								<th>Código</th>
								<th>Nome do Projeto</th>
								<th>Link</th>
								<th>Imagens</th>
								<th>Opções</th>
							</tr>
							<tbody>
								@foreach($projects as $project)
								<tr>
									<td>{{$project->id}}</td>
									<td>{{$project->name}}</td>
									<td>{{$project->link}}</td>
									<td>
										<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#{{$project->id}}">Exibir</button>	
									</td>
									<td>
										<a href="{{route('admin.painel.edit',['id'=>$project->id])}}" class="btn btn-success btn-sm">Editar</a>
									</td>
								</tr>
								<tr >
									<td colspan="5">
										<div id="{{$project->id}}" class="collapse">
											<div class="row">
												@foreach($project->upload as $key)
												<div class="col-sm-4">
													<img src="{{$key->way}}{{$key->original_filename}}" class="img-project" alt="">
												</div>
												@endforeach
											</div>
										</div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</thead>
					</table>
					{!! $projects->render() !!}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
