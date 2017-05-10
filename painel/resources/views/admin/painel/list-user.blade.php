@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Lista de usuário</div>
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
								<th>ID</th>
								<th>Nome</th>
								<th>E-mail/Login</th>
							</tr>
							<tbody>
								@foreach($users as $user)
								<tr>
									<td>{{$user->id}}</td>
									<td>{{$user->name}}</td>
									<td>{{$user->email}}</td>
								</tr>
								@endforeach
							</tbody>
						</thead>
					</table>
					{!! $users->render() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
