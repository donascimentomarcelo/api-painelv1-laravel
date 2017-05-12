@extends('app')

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
							</tr>
							<tbody>
								@foreach($projects as $project)
								<tr>
									<td>{{$project->id}}</td>
									<td>{{$project->name}}</td>
									<td>{{$project->link}}</td>
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
