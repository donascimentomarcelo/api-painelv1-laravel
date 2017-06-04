@extends('app')

@section('content')

{!! Html::script('js/angular/lib/loading-bar.js') !!}
{!! Html::style('js/angular/lib/loading-bar.css') !!}

{!! Html::script('js/angular/user/userCtrl.js') !!}
{!! Html::script('js/angular/user/userAPIService.js') !!}

<div class="container-fluid" ng-app="user">
	<div class="row" ng-controller="userCtrl">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Lista de usuário</div>
				<div class="panel-body">
				<div class="form-group">
					<button class="btn btn-primary" ng-click="load()">Listar</button>
				</div>
					<div id="loading-bar-container"></div>
					<table class="table" ng-show="users.length > 0">
 						<thead>
							<tr>
								<th>ID</th>
								<th>Nome</th>
								<th>E-mail/Login</th>
								<th>Editar</th>
							</tr>
							<tbody>
								<tr ng-repeat="user in users">
									<td><% user.id %></td>
									<td><% user.name %></td>
									<td><% user.email %></td>
									<td>
										<a href="edit/<% user.id %>" class="btn btn-success btn-sm">
											<span class="glyphicon glyphicon-pencil"></span>
										</a>
									</td>
								</tr>
							</tbody>
						</thead>
					</table>
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
