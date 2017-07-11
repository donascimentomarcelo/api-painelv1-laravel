angular.module('project').factory('$projectAPIService',
	 ['$rootScope', '$http', 'snackbar', 'cfpLoadingBar', '$window', 'Upload', 
	 		function($rootScope, $http, snackbar, cfpLoadingBar, $window, Upload){

			 var _verifyDataProject = function(data){
			 	if(parseInt(data.data.status) === 1)
			 	{
			 		cfpLoadingBar.complete();
			 		snackbar.create('Operação realizada com sucesso!');
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
			};

			var _verifyDataImage = function(data){
				if(parseInt(data.data.status) === 1)
				{
					cfpLoadingBar.complete();
                	snackbar.create('Imagem inserida com sucesso!');
                	$rootScope.project = data.data.return.data;
				}
				else if(parseInt(data.data.status) === 3)
				{
					cfpLoadingBar.complete();
                	snackbar.create('Só serão aceitas imagens jpeg, jpg e png!');
				}
				else
				{
					cfpLoadingBar.complete();
                	snackbar.create('Houve um erro ao inserir a imagem!');
				}

                	
			};

			var _getEdit = function(data){
				return $http.get('/admin/project/edit/' + data.id);
			};

			var _getEditImage = function(data){
				return $http.get('/admin/image/edit/' + data.id);
			};

			var _getDeleteImage = function(data){
				return $http.post('/admin/image/destroy/' + data.id);
			};

			var _updateOrder = function(data){
				
				return $http.post('/admin/image/updateOrder', data);
			};

	 return {

	 	verifyDataProject : _verifyDataProject,

		saveProject       : _saveProject,

		updateProject     : _updateProject,

		updateImage       : _updateImage,

		addImage          : _addImage,

		verifyDataImage   : _verifyDataImage,

		getEdit           : _getEdit,

		getEditImage      : _getEditImage,

		getDeleteImage    : _getDeleteImage,

		updateOrder		  : _updateOrder
	 };

}])