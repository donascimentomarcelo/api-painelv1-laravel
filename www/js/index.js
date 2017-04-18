angular.module('myApp', ['ui.router','angularTypewrite','angular-parallax','angular-carousel'])
.config(function($stateProvider, $urlRouterProvider){
	$stateProvider
	.state('home',{
		url:'/',
		templateUrl:'templates/home.html',
		controller:'myController'
	})
	.state('contact',{
		url:'/contact',
		templateUrl:'templates/contact.html',
		controller:'myController'
	})
	$urlRouterProvider.otherwise('/');
})
.controller('myController',['$scope', 'Carousel', function($scope, Carousel){
 
    		$scope.stuff = [
    		"Olá!", 
    		"Está procurando um site, sistema ou aplicativo?", 
    		"Que maravilha!!!",
    		"Você veio ao lugar certo!", 
    		"Meu nome é Marcelo, e eu posso te ajudar a conseguir seu objetivo!",
    		"Sou desenvolvedor, e por meio desse site, venho te apresentar um resumo do meu portifólio.",
    		"Desenvolvo sites e sistema com as tecnologias atuais do mercado.",
    		"Entre em contato!",
    		"Ligue para 21 982525286",
    		"Não perca mais tempo e envie um e-mail para contato@marceloprogrammer.com..." 
    		];

    		$scope.Carousel = Carousel;
}])