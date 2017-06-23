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

    $scope.project = [];
     $scope.save = function(){
        if($scope.project.file)
        {
            $scope.upload($scope.project);
        }
        else if(!$scope.project.file && $scope.project.id)
        {
            $scope.update($scope.project);
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
        cfpLoadingBar.start();
        var promise = $http.get('/admin/project/edit/' + data.id);

        promise.then(function(data){
            cfpLoadingBar.complete();
            $scope.project = data.data.data;
            console.log(data.data.data)
            $scope.containerImg = true;
        }, function(dataError){
            cfpLoadingBar.complete();
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
    $scope.img = [];
    $scope.updateImage = function(){
        if(!$scope.img.id)
        {
            return snackbar.create('Selecione um projeto!');
        };

        if($scope.img.file)
        {
            cfpLoadingBar.start();
            var promise = $projectAPIService.updateImage($scope.img);
            promise.then(function(data){
                $scope.img = data.data.img.data;
                $scope.project = data.data.project.data;
                cfpLoadingBar.complete();
                snackbar.create('Imagem atualizada com sucesso!');
            }, function(dataError){
                cfpLoadingBar.complete();
                console.log(dataError);
                snackbar.create('Houve um erro ao atualizar a imagem!');
            });
        }
        else
        {
            snackbar.create('Selecione uma imagem!');
        };
    };

    $scope.editImage = function(data){
        cfpLoadingBar.start();
        var promise = $http.get('/admin/image/edit/' + data.id);

        promise.then(function(data){
            cfpLoadingBar.complete();
            $scope.img = data.data.data;
        },function(dataError){
            cfpLoadingBar.complete();
            console.log(dataError);
            snackbar.create('Houve um erro ao realizar a busca!')
        })
    };

    $scope.deleteImage = function(data){
        cfpLoadingBar.start();
        var promise = $http.post('/admin/image/destroy/' + data.id);

        promise.then(function(data){
            delete $scope.img;
            delete $scope.codImg;
            cfpLoadingBar.complete();
            snackbar.create('Imagem excluida com sucesso!');
            $scope.project = data.data.data;
        }, function(dataError){
            cfpLoadingBar.complete();
            console.log(dataError);
            snackbar.create('Houve um erro ao excluir a imagem!');
        })
    };

    $scope.addImage = function(){
        if(!$scope.project.id){
            snackbar.create('Selecione um projeto');
        };

        if($scope.project.file){
            var promise = $projectAPIService.addImage($scope.project);
            promise.then(function(data){
                snackbar.create('Imagem inserida com sucesso!');
                $scope.project = data.data.data;
            }, function(dataError){
                snackbar.create('Imagem excluida com sucesso!');
                console.log(dataError);
            });
        };
    };

    $scope.fillImage = function(data){
        $scope.codImg = data;
        $scope.img = data;
    };

    $scope.clear = function(){
        delete $scope.project;
        delete $scope.cod;
    }

    $scope.clearImage = function(){
        delete $scope.cod;
        delete $scope.codImg;
        delete $scope.img;
        $scope.containerImg = false;
    }


}])