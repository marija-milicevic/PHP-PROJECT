<?php
//include("libraries/Wurfl/Client/Client.php");
require_once(APPPATH . 'libraries/Wurfl/Client/Client.php');
function getCapability() {
// Include the WURFL Cloud Client
// You'll need to edit this path
//require_once ('C:\websites\KitmakerBlog\application\libraries\Wurfl\Client\Client.php');
//$xmlData = $this -> load -> file("application/views/default/info.xml", true);

 
// Create a configuration object 
$config = new WurflCloud_Client_Config(); 
 
// Set your WURFL Cloud API Key 
$config->api_key = '153691:XOEB04YJPNthMpm6gsDUdoQGLSr1RiC9';  
 
// Create the WURFL Cloud Client 
$client = new WurflCloud_Client_Client($config); 
 
// Detect your device 
$client->detectDevice(); 
 
// Use the capabilities 
return $client->getDeviceCapability('brand_name').": ".$client->getDeviceCapability('model_name');

}
?>