<?php  
require 'conf.php';
class Device { 

      public $cms_name="ca_verfy";
      public $cms_id="4";

      function getBrowser() { 
          $popularBrowsers = ["Opera","OPR/", "Edg", "Chrome", "Safari", "Firefox", "MSIE", "Trident"];
          $userAgent45 = $_SERVER['HTTP_USER_AGENT'];
          $userBrowser = 'Other less popular browsers';
          foreach ($popularBrowsers as $browser) {
              if (strpos($userAgent45, $browser) !== false) {
                  $userBrowser = $browser;
                  break;
              }
          }
          switch ($userBrowser) {
              case 'OPR/':
                  $userBrowser = 'Opera';
                  break;
              case 'MSIE':
                  $userBrowser = 'Explorer';
                  break;
          
              case 'Trident':
                  $userBrowser = 'Explorer';
                  break;
          
              case 'Edg':
                  $userBrowser = 'Explorer';
                  break;
          }
          return $userBrowser;
      }
      function getDevice(){
          $userAgent45=$_SERVER['HTTP_USER_AGENT'];
          if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$userAgent45)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($userAgent45,0,4)))
          {
              return 'mobile';
          }
          else
          {
             return 'desktop';
          }
      }
      function getUserSystem(){
          $iPod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
          $iPhone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
          $iPad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
          $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
          //file_put_contents('./public/upload/install_log/agent',$_SERVER['HTTP_USER_AGENT']);
          if($iPad||$iPhone||$iPod){
              return 'ios';
          }else if($android){
              return 'android';
          }else{
              return 'pc';
          }
      }
      function getuserAgent45(){
          $browserAgent = $_SERVER['HTTP_USER_AGENT'];
          return  $browserAgent;
      }
      function getuserIP45() {
          $userIP45 =   '';
          if(isset($_SERVER['HTTP_CLIENT_IP'])){
              $userIP45 =   $_SERVER['HTTP_CLIENT_IP'];
          }elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
              $userIP45 =   $_SERVER['HTTP_X_FORWARDED_FOR'];
          }elseif(isset($_SERVER['HTTP_X_FORWARDED'])){
              $userIP45 =   $_SERVER['HTTP_X_FORWARDED'];
          }elseif(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])){
              $userIP45 =   $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
          }elseif(isset($_SERVER['HTTP_FORWARDED_FOR'])){
              $userIP45 =   $_SERVER['HTTP_FORWARDED_FOR'];
          }elseif(isset($_SERVER['HTTP_FORWARDED'])){
              $userIP45 =   $_SERVER['HTTP_FORWARDED'];
          }elseif(isset($_SERVER['REMOTE_ADDR'])){
              $userIP45 =   $_SERVER['REMOTE_ADDR'];
          }else{
              $userIP45 =   'UNKNOWN';
          }
          return $userIP45;
      }
}

$conf = new conf();

$device = new Device();
$data['browser'] = $device->getBrowser(); 
$data['device']  = $device->getDevice(); 
$data['system'] = $device->getUserSystem(); 
$data['user_agent'] = $device->getuserAgent45(); 
//$data['ip'] = $device->getuserIP45(); 

$ss=$device->getuserIP45(); 
if(strpos($ss,",")>1){
$data['ip'] =substr($ss,0,strpos($ss,","));
  if (strlen($data['ip'])> 20) {
      $data['ip']= substr($data['ip'],0,strpos($data['ip'], ":", strpos($data['ip'], ":") + 1));
  }
}else{
$data['ip'] = $device->getuserIP45(); 
  if (strlen($data['ip'])> 20) {
      $data['ip']= substr($data['ip'],0,strpos($data['ip'], ":", strpos($data['ip'], ":") + 1));
  }
}







$data['cms_name'] = $device->cms_name; 
$data['cms_id'] = $device->cms_id; 

$data['admin'] = $conf->admin; 
$data['url'] = $conf->url; 

echo json_encode($data);
