'use strict';

angular.module('DriprApp', [
  'ngCookies',
  'ngResource',
  'ngSanitize',
  'ngRoute',
])
.config(['$routeProvider', function ($routeProvider) {
  $routeProvider
    .when('/', {
      templateUrl: 'app/views/main.html',
      controller: 'MainCtrl',
      css: [
        './bower_components/bootstrap/dist/css/bootstrap.css'
      ]
    })
    .when('/edit/:id', {
      templateUrl: 'app/views/edit.html',
      controller: 'EditCtrl',
      css: [
        'styles/main.css'
      ]
    })
    .when('/editor/:viewname', {
      templateUrl: 'app/views/editor2.html',
      controller: 'EditorCtrl',
      css: [
         'styles/editor.css'
      ]
    })
    .when('/make', {
      templateUrl: 'app/views/make.html',
      controller: 'EditorCtrl',
      css: [
        './styles/editor.css',
      ]
    })
    .otherwise({
      redirectTo: '/'
    });
}])
.directive('head', ['$rootScope','$compile',
    function($rootScope, $compile){
        return {
            restrict: 'E',
            link: function(scope, elem){
                var html =  '<link rel="stylesheet" ng-repeat="(routeCtrl, cssUrl) in routeStyles" ng-href="{{cssUrl}}" />';

                elem.append($compile(html)(scope));
                scope.routeStyles = {};

                $rootScope.$on('$routeChangeStart', function (e, next, current) {
                    if(current && current.$$route && current.$$route.css){
                        if(!Array.isArray(current.$$route.css)){
                            current.$$route.css = [current.$$route.css];
                        }
                        angular.forEach(current.$$route.css, function(sheet){
                            delete scope.routeStyles[sheet];
                        });
                    }
                    if(next && next.$$route && next.$$route.css){
                        if(!Array.isArray(next.$$route.css)){
                            next.$$route.css = [next.$$route.css];
                        }
                        angular.forEach(next.$$route.css, function(sheet){
                            scope.routeStyles[sheet] = sheet;
                        });
                    }
                });
            }
        };
    }
]);
