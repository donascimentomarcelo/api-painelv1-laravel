angular.module('user', ['cfp.loadingBar', 'angular.snackbar'])
.config(function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
})
.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
	cfpLoadingBarProvider.parentSelector = '#loading-bar-container';
	cfpLoadingBarProvider.spinnerTemplate = '<div><span class="fa fa-spinner">Carregando...</div>';
}])
.controller('userCtrl',[ '$scope', '$http','cfpLoadingBar', '$window', 'snackbar', '$userAPIService',
	function($scope, $http, cfpLoadingBar, $window, snackbar, $userAPIService){
	
	$scope.load = function(){
		cfpLoadingBar.start();
		var promise = $userAPIService.listUser();
		promise.then(function(data){
			cfpLoadingBar.complete();
			$scope.users = data.data.data;
		},function(dataError){
			console.log(dataError);
		});
	};

	$scope.save = function(data){
		$userAPIService.validateConfirmPassword(data);
			cfpLoadingBar.start();
			var promise = $userAPIService.saveUser(data);
				promise.then(function(data){
					$userAPIService.verifyDataUser(data);
			},function(dataError){
				cfpLoadingBar.complete();
				console.log(dataError);
			});
	};
	// $scope.load();

}]);