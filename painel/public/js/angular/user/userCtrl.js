angular.module('user', ['cfp.loadingBar'])
.config(function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
})
.controller('userCtrl',[ '$scope', '$http','cfpLoadingBar', 
	function($scope, $http, cfpLoadingBar){
	
	$scope.load = function(){
		cfpLoadingBar.start();
		var promise = $http.get('/admin/painel/index');
		promise.then(function(data){
			console.log(data.data.data);
			cfpLoadingBar.complete();
			$scope.users = data.data.data;
		},function(){

		});
	};


	$scope.load();

}]);