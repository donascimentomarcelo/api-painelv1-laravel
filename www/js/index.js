angular.module('myApp', ['ui.router','angularTypewrite','angular-parallax','angular-carousel','duScroll','circularMenu-directive','angular-loading-bar','angular.snackbar'])
.config(function($stateProvider, $urlRouterProvider){
	$stateProvider
	.state('home',{
		url:'/',
		templateUrl:'templates/home.html',
		controller:'myController'
	})
	$urlRouterProvider.otherwise('/');
})
.value('duScrollDuration', 2000)
.value('duScrollOffset', 30)
.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.parentSelector = '#loading-bar-container';
    cfpLoadingBarProvider.spinnerTemplate = '<div><span class="fa fa-spinner">Carregando...</div>';
  }])
.controller('myController',['$scope', 'Carousel', '$document', '$location', '$http','snackbar', function($scope, Carousel, $document, $location, $http, snackbar){
 
    		$scope.stuff = [
        "Procura um Programador?", 
        "Procura um Web Designer?", 
        "Procura um aplicativo para a sua empresa?", 
    		"Você veio ao lugar certo!", 
    		];

    		$scope.Carousel = Carousel;
     
          $scope.menuConfig3 = {
            "buttonWidth": 60,
            "menuRadius": 180,
            "color": "rgba(8, 8, 8, 0.57)",
            "offset":25,
            "textColor": "#ffffff",
            "showIcons":true,
            "onlyIcon":false,
            "textAndIcon": true,
            "gutter": {
              "top": 130,
              "right": 30,
              "bottom": 30,
              "left": 30
            },
            "angles": {
              "topLeft": 0,
              "topRight": 90,
              "bottomRight": 180,
              "bottomLeft": 270
            }
          };

          $scope.menuItems = [{
            "title": "inicio",
            "color": "rgba(8, 8, 8, 0.79);",
            "rotate": 0,
            "show": 0,
            "titleColor": "#fff",
            "icon":{"color":"#fff","name":"fa fa-home","size": 30}
          }, {
            "title": "perfil",
            "color": "rgba(51, 51, 51, 0.88)",
            "rotate": 0,
            "show": 0,
            "titleColor": "#fff",
            "icon":{"color":"#fff","name":"fa fa-user-circle-o","size": 30}
          }, {
            "title": "projeto",
            "color": "rgba(85, 85, 85, 0.88)",
            "rotate": 0,
            "show": 0,
            "titleColor": "#fff",
            "icon":{"color":"#fff","name":"fa fa-file-code-o","size": 30}
          }, {
            "title": "contato",
            "color": "rgba(153, 153, 153, 0.93)",
            "rotate": 0,
            "show": 0,
            "titleColor": "#fff",
            "icon":{"color":"#fff","name":"fa fa-envelope-open-o","size": 30}
          }];

         var inicio   = angular.element(document.getElementById('inicio')),
             perfil   = angular.element(document.getElementById('perfil')),
             projetos = angular.element(document.getElementById('projetos')),
             contato  = angular.element(document.getElementById('contato'));

        $scope.onWingClick = function(wing){
          if(wing.title === 'inicio')
          {
            $document.scrollTo(inicio, 0, 1000);
          }
          else if(wing.title === 'perfil')
          {
            $document.scrollTo(perfil, 0, 1000);
          }
          else if(wing.title === 'projeto')
          {
            $document.scrollTo(projetos, 0, 1000);
          }
          else if(wing.title === 'contato')
          {
            $document.scrollTo(contato, 0, 1000);
          }
          else
          {
            $document.scrollTo(inicio, 0, 1000);
          }
       };

       $scope.sendEmail = function(data){
          var promise = $http.post('http://marceloprogrammer.com/api/painel/email', data);
              promise.then(function(data){
                ignoreLoadingBar: true;
                delete $scope.data;
                 snackbar.create("E-mail enviado com sucesso!");
                console.log(data);
              }, function(responseError){
                ignoreLoadingBar: true;
                 snackbar.create("Houve um erro ao enviar o e-mail!");
                 // delete $scope.data;
                console.log(responseError);
              });

       };

       var loadProject = function(){
        var promise = $http.get('http://localhost:8000/api/project/list');
          promise.then(function (data){
            ignoreLoadingBar: true;
            console.log(data.data.data);
            $scope.dataProjects = data.data.data;
          },
           function(responseError){
            ignoreLoadingBar: true;
            console.log(responseError);
          });
       };

       loadProject();

}]).value('duScrollOffset', 30)