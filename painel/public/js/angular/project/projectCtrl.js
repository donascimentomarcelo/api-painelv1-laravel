angular.module('project',['cfp.loadingBar', 'angular.snackbar', 'ngFileUpload'])
.config(function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
})
.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.parentSelector = '#loading-bar-container';
    cfpLoadingBarProvider.spinnerTemplate = '<div><span class="fa fa-spinner">Carregando...</div>';
}])
.controller('projectCtrl', ['$scope','$http', 'Upload','cfpLoadingBar', '$projectAPIService',
        function ($scope, $http, Upload, cfpLoadingBar, $projectAPIService) {
	

	$scope.save = function(){
		if ($scope.form.file.$valid && $scope.file) {
        $scope.upload($scope.file);
      }
	}

	$scope.upload = function (file) {
        cfpLoadingBar.start();
        Upload.upload({
            url: '/admin/project/save',
            data: {

                 file: file, 
                'name': $scope.name, 
                'link': $scope.link, 
                'description': $scope.description, 
                'category': $scope.category
            }

        }).then(function (data) {
            // console.log('Success ' + resp.config.data.file.name + 'uploaded. Response: ' + resp.data);
            $projectAPIService.verifyDataProject(data);
            console.log(data)
        }, function (resp) {
            cfpLoadingBar.complete();
            snackbar.create('Houve um erro ao criar o projeto!');   
            console.log('Error status: ' + resp.status);
        }, function (evt) {
            var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
            console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
        });
    };


}])