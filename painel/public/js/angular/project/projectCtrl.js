angular.module('project',['ngFileUpload'])
.controller('projectCtrl', ['$scope','Upload', '$timeout', function ($scope, Upload, $timeout) {
	$scope.save = function(file){
		file.upload = Upload.upload({
			// url: 'https://angular-file-upload-cors-srv.appspot.com/upload',
			data: {file: file}
		});
			console.log(data)
	}
}])