'use strict';

angular.module('DriprApp')
  .controller('EditCtrl', ['$scope', '$rootScope', function ($scope, $rootScope) {

      angular.extend($scope, {
      });

      angular.element('#redactor_intro').redactor({
    		focus: true,
    		air: true
    	});

    	angular.element('#redactor_content').redactor({
    /* 			imageUpload: '', */
    		focus: true,
    		air: true,
    		airButtons: ['formatting', 'bold', 'italic', 'deleted', 'unorderedlist', 'orderedlist', 'outdent', 'indent', 'image']
    	});

    	angular.element('.dripr-intro-image').on('click', function(){
        angular.element('#dripr_file_modal').show();
      });

  }]);
