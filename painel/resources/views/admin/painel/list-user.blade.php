@extends('app')

@section('content')

{!! Html::script('js/angular/lib/loading-bar.js') !!}
{!! Html::style('js/angular/lib/loading-bar.css') !!}

{!! Html::script('js/angular/user/userCtrl.js') !!}

<div class="container-fluid" ng-app="user">
	<div class="row" ng-controller="userCtrl">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Lista de usuário</div>
				<div class="panel-body">
					<div dw-loading="key" dw-loading-options="options">
						<table class="table">
							<thead>
								<tr>
									<th>ID</th>
									<th>Nome</th>
									<th>E-mail/Login</th>
								</tr>
								<tbody>
									<tr ng-repeat="user in users">
										<td><% user.id %></td>
										<td><% user.name %></td>
										<td><% user.email %></td>
									</tr>
								</tbody>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
