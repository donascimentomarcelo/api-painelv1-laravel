angular.module('myApp', ['ui.router','angularTypewrite','angular-parallax','angular-carousel','duScroll'])
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
.controller('myController',['$scope', 'Carousel', function($scope, Carousel, $document){
 
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

           $scope.toTheTop = function() {
              $document.scrollTopAnimated(0, 5000).then(function() {
                console && console.log('You just scrolled to the top!');
            });
          }
          var section3 = angular.element(document.getElementById('section-3'));
          $scope.toSection3 = function() {
              $document.scrollToElementAnimated(section3);
          }
     
}]).value('duScrollOffset', 30)