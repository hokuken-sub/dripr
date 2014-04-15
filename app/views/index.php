<!doctype html>
<html ng-app="DriprApp">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dripr</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <!-- build:css styles/vendor.css -->
    <!-- bower:css -->
    <!-- endbower -->
    <!-- endbuild -->
    <!-- build:css({.tmp,app}) styles/main.css -->
    <!-- endbuild -->
  </head>
  <body>

    <!-- Add your site or application content here -->
    <div ng-view=""></div>

    <!-- build:js scripts/vendor.js -->
    <!-- bower:js -->
    <script src="bower_components/jquery/jquery.js"></script>
    <script src="bower_components/angular/angular.js"></script>
    <script src="bower_components/angular-resource/angular-resource.js"></script>
    <script src="bower_components/angular-cookies/angular-cookies.js"></script>
    <script src="bower_components/angular-sanitize/angular-sanitize.js"></script>
    <script src="bower_components/angular-route/angular-route.js"></script>
    <!-- endbower -->
    <!-- endbuild -->

    <script src="assets/redactor/redactor.min.js"></script>


    <!-- build:js({.tmp,app}) scripts/scripts.js -->
    <script src="app/app.js"></script>
    <script src="app/controllers/intro.js"></script>
    <script src="app/controllers/edit.js"></script>
    <!-- endbuild -->



  </body>
</html>
