angular.module('project').factory('$projectAPIService',
	 ['$rootScope', '$http', 'snackbar', 'cfpLoadingBar', '$window', 'Upload', 
	 		function($rootScope, $http, snackbar, cfpLoadingBar, $window, Upload){

			 var _verifyDataProject = function(data){
			 	if(parseInt(data.data.status) === 1)
			 	{
			 		cfpLoadingBar.complete();
			 		snackbar.create('Operação realizada com sucesso!');
			 		// $window.location.href = '/admin/project/list';
			 	}
			 	else if(parseInt(data.data) === 3)
			 	{
			 		cfpLoadingBar.complete();
			 		snackbar.create('Só serão aceitas imagens no formato jpg, jpeg e png.');	
			 	}
			 	else
			 	{
			 		console.log(data.data); 
			 		cfpLoadingBar.complete();
			 		snackbar.create('Houve um erro ao criar o projeto!');	
			 	}
			 }

			var _saveProject = function(project){
				return Upload.upload({
						url: '/admin/project/save',
						data: {

							file         : project.file, 
							'name'       : project.name, 
							'link'       : project.link, 
							'description': project.description, 
							'category'   : project.category
						}

					});
			};

			var _updateProject = function(project){
				return Upload.upload({
						url: '/admin/project/update',
						data: {

							'name'       : project.name, 
							'id'         : project.id, 
							'link'       : project.link, 
							'description': project.description, 
							'category'   : project.category
						}

					});
			};

			var _updateImage = function(data){
				return Upload.upload({
                        url: '/admin/image/update',
                        data: {
                            file               : data.file,
                            'id'               : data.id,
                            'original_filename': data.original_filename
                        }
                    });
			};

			var _addImage = function(data){
				return Upload.upload({
                        url: '/admin/image/save',
                        data: {
                            file               : data.file,
                            'id'               : data.id
                        }
                    });
			}

	 return {

	 	verifyDataProject : _verifyDataProject,

		saveProject       : _saveProject,

		updateProject     : _updateProject,

		updateImage       : _updateImage,

		addImage          : _addImage
	 };

}])