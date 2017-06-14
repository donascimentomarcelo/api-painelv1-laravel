angular.module('project',['cfp.loadingBar', 'angular.snackbar', 'ngFileUpload'])
.config(function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
})
.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.parentSelector = '#loading-bar-container';
    cfpLoadingBarProvider.spinnerTemplate = '<div><span class="fa fa-spinner">Carregando...</div>';
}])
.controller('projectCtrl', ['$scope','$http', 'Upload','cfpLoadingBar', '$projectAPIService', 'snackbar',
    function ($scope, $http, Upload, cfpLoadingBar, $projectAPIService, snackbar) {


     $scope.save = function(project){
        var file = project.file;

        if (file) {
            $scope.upload(project);
        }
        else
        {
            snackbar.create('Você precisa anexar uma imagem ao projeto.');
        }
    }

    $scope.upload = function (project) {
        cfpLoadingBar.start();
        var promise = $projectAPIService.saveProject(project);

        promise.then(function (data) {
            $scope.project = data.data.data;
            $projectAPIService.verifyDataProject(data);
        }, function (resp) {
            cfpLoadingBar.complete();
            snackbar.create('Houve um erro ao criar o projeto!');   
            console.log('Error status: ' + resp.status);
        }, function (evt) {
            var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
            console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
        });
    };



    $scope.edit = function(data){

        var promise = $http.get('/admin/project/edit/' + data.id);

        promise.then(function(data){
            $scope.project = data.data.data;
        }, function(dataError){
            console.log(dataError)
            if(parseInt(dataError.status) === 404){  
                snackbar.create('Esse projeto não existe!'); 
            }
        })
    };


    $scope.update = function(data){
        cfpLoadingBar.start();
        var promise = $projectAPIService.updateProject(data);
        promise.then(function(data){
            cfpLoadingBar.complete();
            $scope.project = data.data.data;
            $projectAPIService.verifyDataProject(data);
        }, function(dataError){
            console.log(dataError);
            cfpLoadingBar.complete();
            snackbar.create('Houve um erro ao atualizar o projeto!');
        })
    };

    $scope.updateImage = function(data){
        if(data.file)
        {
            var promise = $projectAPIService.updateImage(data);
            promise.then(function(data){
                console.log(data.data);
                console.log(data)
            }, function(dataError){
                console.log(dataError);
            });
        }
        else
        {
            snackbar.create('Selecione uma imagem!');
        }
    };


}])