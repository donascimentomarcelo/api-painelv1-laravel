angular.module('user').factory('$userAPIService',
	['$rootScope', '$http' , 'snackbar', 'cfpLoadingBar', '$window',
			function ($rootScope, $http, snackbar, cfpLoadingBar, $window) {
	
				var _validateConfirmPassword = function(data){
					if(data)
					{
						if(data.password != data.confirmpassword)
							return snackbar.create('A senha precisa ser igual a confirmação de senha.');
						return;
					}
				};

				var _verifyDataUser = function(data){
					if(parseInt(data.data) === 1)
					{
						cfpLoadingBar.complete();
						$window.location.href = '/admin/painel/list';
					}
					else if(parseInt(data.data) === 3)
					{
						cfpLoadingBar.complete();
						snackbar.create('Preencha todos os campos!');	
					}
				};

				var _verifyIfExistId = function(data){
					
					if(!data.id)
					{
						return _saveUser(data)
					}
					else
					{
						return _updateUser(data)
					}
				}

				var _saveUser = function(data){
					return $http.post('/admin/painel/save', data);
				};

				var _updateUser = function(data){
					return $http.post('/admin/painel/update', data);
				};

				var _listUser = function(){
					return $http.get('/admin/painel/index');
				};
	return {
		validateConfirmPassword : _validateConfirmPassword,

		verifyDataUser          : _verifyDataUser,

		saveUser                : _saveUser,

		updateUser              : _updateUser,

		listUser                : _listUser,

		verifyIfExistId         : _verifyIfExistId
	};
}])

