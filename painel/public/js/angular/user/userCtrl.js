angular.module('user', ['cfp.loadingBar', 'angular.snackbar', 'simplePagination'])
.config(function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
})
.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
	cfpLoadingBarProvider.parentSelector = '#loading-bar-container';
	cfpLoadingBarProvider.spinnerTemplate = '<div><span class="fa fa-spinner">Carregando...</div>';
}])
.controller('userCtrl',[ '$scope', '$http','cfpLoadingBar', '$window', 'snackbar', '$userAPIService', 'Pagination',
	function($scope, $http, cfpLoadingBar, $window, snackbar, $userAPIService, Pagination){
	

	$scope.load = function(){
		cfpLoadingBar.start();
		var promise = $userAPIService.listUser();
		promise.then(function(data){
			cfpLoadingBar.complete();
			$scope.users = data.data.data;
			$scope.pagination = Pagination.getNew(10);
			$scope.pagination.numPages = Math.ceil($scope.users.length/$scope.pagination.perPage);
		},function(dataError){
			console.log(dataError);
		});
	};



	$scope.save = function(data){
		$userAPIService.validateConfirmPassword(data);
			cfpLoadingBar.start();
			var promise = $userAPIService.verifyIfExistId(data);
				promise.then(function(data){
					$userAPIService.verifyDataUser(data);
			},function(dataError){
				cfpLoadingBar.complete();
				console.log(dataError);
			});
	};

	$scope.edit =  function(data){
		var id = data.id;
		cfpLoadingBar.start();
		var promise = $http.get('/admin/painel/edit/' + id);
			promise.then(function(data){
				cfpLoadingBar.complete();
				$scope.user = data.data.data;
			}, function(dataError){
				cfpLoadingBar.complete();
				if(parseInt(dataError.status) == 404)
				{
					snackbar.create('Usuário não encontrado!');
				};
			});
	};

	$scope.clear = function(){
		delete $scope.user;
		delete $scope.cod;
	}

}]);