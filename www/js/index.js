angular.module('myApp', ['ui.router','angularTypewrite','angular-parallax','angular-carousel','duScroll','circularMenu-directive'])
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
.controller('myController',['$scope', 'Carousel', '$document', '$location', function($scope, Carousel, $document, $location, $http){
 
    		$scope.stuff = [
    		"Olá!", 
    		"Está procurando um site, sistema ou aplicativo?", 
    		"Que maravilha!!! Você veio ao lugar certo!", 
    		"Meu nome é Marcelo, e eu posso te ajudar a conseguir seu objetivo!",
    		"Sou desenvolvedor, e por meio desse site, venho te apresentar um resumo do meu portifólio.",
    		"Desenvolvo sites e sistema com as tecnologias atuais do mercado.",
    		"Entre em contato!",
    		"Ligue para 21 982525286",
    		"Não perca mais tempo e envie um e-mail para contato@marceloprogrammer.com..." 
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
          var promise = $http.post('http://localhost:8081/email.php', data);
              promise.then(function(data){
                console.log(data);
              }, function(responseError){
                console.log(responseError);
              });
       };

}]).value('duScrollOffset', 30)