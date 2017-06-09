angular.module('project').factory('$projectAPIService',
	 ['$rootScope', '$http', 'snackbar', 'cfpLoadingBar', '$window', 
	 		function($rootScope, $http, snackbar, cfpLoadingBar, $window){

			 var _verifyDataProject = function(data){
			 	if(parseInt(data.data) === 1)
			 	{
			 		cfpLoadingBar.complete();
			 		$window.location.href = '/admin/project/list';
			 	}
			 	else if(parseInt(data.data) === 3)
			 	{
			 		cfpLoadingBar.complete();
			 		snackbar.create('Só serão aceitas imagens no formato jpg, jpeg e png.');	
			 	}
			 	else
			 	{
			 		cfpLoadingBar.complete();
			 		snackbar.create('Houve um erro ao criar o projeto!');	
			 	}
			 }

	 return {

	 	verifyDataProject : _verifyDataProject
	 };

}])