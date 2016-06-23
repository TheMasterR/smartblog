<!DOCTYPE=html>
<html>
<head>
	<title>Clients by MAC-ADDRESS</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php
		if (isset($_GET['refresh'])){
	?>
    <meta http-equiv="refresh" content="<?= intval($_GET['refresh']) ?>">
	<?php } ?>

	<style>
	body {background-color:#f1f1f1; font-family:monospace;}
	li:hover {background-color:lightgrey;}
	.mac {color:red;}
	</style>

</head>
<body>
<?php
define('USERNAME', 'ENTER_USERNAME_HERE');
define('PASSWORD', 'ENTER_PASSWORD_HERE');
define('URL', 'http://snia.go.ro:8081');
define('LOGIN_URL', 'http://snia.go.ro:8081/userRpm/LoginRpm.htm?Save=Save');

error_reporting(E_ALL);
date_default_timezone_set('Europe/Bucharest');

class TPLINK
{
    function __construct()
    {
      	$this->getKey();
    }
    private $key;

    public function deg($string) {
    	echo '<pre>';
    	print_r($string);
    	echo '</pre>';
    }
    private function encodeCookie() {
        return 'Authorization=' . rawurlencode("Basic ".base64_encode(USERNAME.":".md5(PASSWORD)));
    }
    private function getKey() {
        $opts = array(
            'http'=>array(
                'method'=>"GET",
                'header'=>"Accept-language: en\r\n" .
                    "Cookie: ".$this->encodeCookie()."\r\n" .
                    "Referer: "
        )
        );

        $context = stream_context_create($opts);
        // Open the file using the HTTP headers set above
        file_get_contents(URL,false,$context); // make a request to clear old one
        $file = file_get_contents(LOGIN_URL, false, $context);
        $RESPONSE = (explode("/",htmlspecialchars($file)));
        $KEY = $RESPONSE[3];
        $this->key = $KEY;

        return $KEY;
    }
    public function getUrl($url, $referer){

		$URL1 = URL . '/' . $this->key . '/userRpm/' . $url;
		$myReferer = URL . '/' . $this->key . '/userRpm/' . $referer;

		$opts = array(
		  'http'=>array(
		    'method'=>"GET",
		    'header'=>"Accept-language: en\r\n" .
		              "Cookie: " . $this->encodeCookie() . "\r\n" .
			    	 "Referer: " . $myReferer
		)
		);

		$context = stream_context_create($opts);

		// Open the file using the HTTP headers set above
		$file = file_get_contents($URL1, false, $context);

		return $file;
    }
    public function doLogout() {
    	$this->getUrl('LogoutRpm.htm', 'LogoutRpm.htm');
    }
    public function knownMac($mac) {
		switch(strtolower($mac)) {
		    case 'a8-9f-ba-28-09-04': return '<span style=\'background-color:LightBlue\'><b>TOTH ANDREA CARLA, Samsung Galaxy Core Prime</b></span>';	break;
		    case '80-61-8f-23-6c-10': return 'Toth Edina Marika, Philips';						break;
		    case '5c-0a-5b-31-5f-60': return 'Toth Maria Beatrix, Samsung Galaxy S3';			break;
		    case '68-76-4f-76-6e-47': return 'Toth Maria Beatrix, Sony Xperia E';				break;
		    case '2c-56-dc-a4-51-a7': return 'Toth Maria Beatrix, Zenfone 2 laser 550KL';		break;
		    case 'a4-f1-e8-ea-b2-60': return 'Furău Claudiu, Apple Iphone 5';					break;
		    case 'd0-df-9a-d2-93-67': return 'Toth Nicolae, Laptop, Asus';						break;
		    case '34-4d-f7-85-3d-65': return 'Toth Nicolae, Tableta - LG v300'; 				break;
		    case 'b0-c5-59-1a-08-c9': return 'Toth Nicolae, Samsung A5';						break;
		    case '34-4d-f7-08-60-f1': return 'Toth Nicolae, LG G3'; 							break;
		    case 'c0-d9-62-8a-75-70': return 'TV Panasonic, SUS';								break;
		    case 'c4-36-6c-64-8a-3e': return 'TV LG, webOS, jos';								break;
		    case '00-22-43-68-2a-28': return '<span style=\'background-color:DarkRed\'><b>LAPTOP MSI, fete</b></span>';								break;
		    case '64-cc-2e-45-ef-a8': return '<span style=\'background-color:Yellow\'><b>Vaida Bogdan, Redmi Note 3</b></span>';								break;
		    case '00-50-8d-95-9b-80': return '<span style=\'background-color:Cyan\'><b>Desktop pc, BIROU NICU</b></span>';							break;
		    case '00-50-8d-95-9b-81': return '<span style=\'background-color:Cyan\'><b>Desktop pc, BIROU NICU</b></span>';							break;
		    case 'ac-38-70-b6-b9-3d': return 'LENOVO, android'; 								break;
		    case '54-27-58-29-cf-52': return 'Kercsi, MOTOROLA android';						break;
		    case 'ac-9e-17-5b-3b-ed': return 'repeater ASUS, RP-n53, 2.4GHZ';					break;
		    case 'ac-9e-17-5b-3b-ef': return 'repeater ASUS, RP-n53, 5GHZ'; 					break;
		    case '64-51-06-30-9d-c7': return '<span style=\'background-color:LightGreen\'><b>Desktop pc, BIROU FETE</b></span>';							break;
		    case 'ac-9e-17-5b-3b-ec': return 'ASUS REPEATER 2.4Ghz';							break;
		    case 'ac-9e-17-5b-3b-ee': return 'ASUS REPEATER 5Ghz';								break;
		    case 'f4-42-8f-93-44-13': return 'Laszlo Moldovanyi, Samsung Galaxy GRAND'; 		break;
		    case '90-f6-52-be-4a-32': return 'router, tp-link wdr-3400'; 						break;
		    case 'ec-1f-72-04-96-67': return 'Lucian P.- 920F - Galaxy s6'; 					break;
		    case 'c4-43-8f-57-a8-ed': return 'unknown LG Mobile 1'; 							break;
		    case '': return null;																break;
		    default: return '<span style=\'background-color:Red\'><b>unknown client</b></span>';														break;
		}
    }
    public function getAssignedMac() {
    	$stuff = $this->getUrl('AssignedIpAddrListRpm.htm', 'LanDhcpServerRpm.htm');
		$stuff = $this->scrape_between($stuff, 'var DHCPDynList = new Array(', ' );');
		$stuff = str_replace('"', '', $stuff);
		$stuff = str_replace(' ', '', $stuff);
		$stuff = str_replace("\n", '', $stuff);
		$stuff = explode(',', $stuff);

		$a = [];

		$j = 0;
		$j2 = 0;

		for ($i=0; $i<count($stuff); $i++){
			switch ($j) {
				case 0:
					$a[$j2]['name'] = $stuff[$i];
					break;
				case 1:
					$a[$j2]['mac'] = $stuff[$i];
					$a[$j2]['knownIdentity'] = $this->knownMac($stuff[$i]);
					break;
				case 2:
					$a[$j2]['ip'] = $stuff[$i];
					break;
				case 3:
					$a[$j2]['lease'] = $stuff[$i];
					break;
			}
			if ($j < 3) {
				$j++;
			} else {
				$j = 0;
				$j2++;
			}
		}
		array_pop($a);

		return $a;
    }
    public function getConnectedClients24() {
    	$stuff = $this->getUrl('WlanStationRpm.htm?Page=1', 'WlanStationRpm.htm');
		$stuff = $this->scrape_between($stuff, 'var hostList = new Array(', '0,0 );');
		$stuff = str_replace('"', '', $stuff);
		$stuff = str_replace(' ', '', $stuff);
		$stuff = str_replace("\n", '', $stuff);
		$stuff = str_replace(',1,', ',', $stuff);
		$stuff = explode(',', $stuff);
		//array_pop($stuff);

		$a = [];

		$i = 0;
		$j = 0;
		$j2 = 0;

		for($i = 0; $i < count($stuff); $i++) {

			switch ($j) {
				case 0:
					$a[$j2]['mac'] = $stuff[$i];
					$a[$j2]['knownIdentity'] = $this->knownMac($stuff[$i]);
					break;
				case 1:
					$a[$j2]['received-packets'] = $stuff[$i];
					break;
				case 2:
					$a[$j2]['sent-packets'] = $stuff[$i];
					break;
			}
			if ($j < 2) {
				$j++;
			} else {
				$j = 0;
				$j2++;
			}
		}

		array_pop($a);
		return $a;
    }
    public function getConnectedClients5() {
    	$stuff = $this->getUrl('WlanStationRpm_5g.htm?Page=1', 'WlanStationRpm_5g.htm');
		$stuff = $this->scrape_between($stuff, 'var hostList = new Array(', '0,0 );');
		$stuff = str_replace('"', '', $stuff);
		$stuff = str_replace(' ', '', $stuff);
		$stuff = str_replace("\n", '', $stuff);
		$stuff = str_replace(',1,', ',', $stuff);
		$stuff = explode(',', $stuff);
		//array_pop($stuff);

		$a = [];

		$i = 0;
		$j = 0;
		$j2 = 0;

		for($i = 0; $i < count($stuff); $i++) {

			switch ($j) {
				case 0:
					$a[$j2]['mac'] = $stuff[$i];
					$a[$j2]['knownIdentity'] = $this->knownMac($stuff[$i]);
					break;
				case 1:
					$a[$j2]['received-packets'] = $stuff[$i];
					break;
				case 2:
					$a[$j2]['sent-packets'] = $stuff[$i];
					break;
			}
			if ($j < 2) {
				$j++;
			} else {
				$j = 0;
				$j2++;
			}
		}

		array_pop($a);
		return $a;
    }

	// Defining the basic cURL function
    public function curl($url) {
    	// Assigning cURL options to an array
        $options = Array(
            CURLOPT_RETURNTRANSFER => TRUE,  // Setting cURL's option to return the webpage data
            CURLOPT_FOLLOWLOCATION => TRUE,  // Setting cURL to follow 'location' HTTP headers
            CURLOPT_AUTOREFERER => TRUE, // Automatically set the referer where following 'location' HTTP headers
            CURLOPT_CONNECTTIMEOUT => 120,   // Setting the amount of time (in seconds) before the request times out
            CURLOPT_TIMEOUT => 120,  // Setting the maximum amount of time for cURL to execute queries
            CURLOPT_MAXREDIRS => 10, // Setting the maximum number of redirections to follow
            CURLOPT_USERAGENT => "Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.1a2pre) Gecko/2008073000 Shredder/3.0a2pre ThunderBrowse/3.2.1.8",  // Setting the useragent
            CURLOPT_URL => $url, // Setting cURL's URL option with the $url variable passed into the function
        );

        $ch = curl_init();  // Initialising cURL
        curl_setopt_array($ch, $options);   // Setting cURL's options using the previously assigned array data in $options
        $data = curl_exec($ch); // Executing the cURL request and assigning the returned data to the $data variable
        curl_close($ch);    // Closing cURL
        return $data;   // Returning the data from the function
    }

    // Defining the basic scraping function
    public function scrape_between($data, $start, $end) {
    	$data = stristr($data, $start); // Stripping all data from before $start string
    	$data = substr($data, strlen($start)); // Stripping $start
    	$stop = stripos($data, $end); // Getting the position of the $end of the data to scrape
    	$data = substr($data, 0, $stop); // Stripping all data from afther and including the $end of the data to scrape
    	return $data; // Returning the scraped data from the function
    }
}
class ASUS
{
	function __construct(){

	}
	public function getUrl($url) {
		$context = stream_context_create(array(
		    'http' => array(
		        'header'  => "Authorization: Basic " . base64_encode("admin:ENTER_PASSWORD_HERE")
		    )
		));


		$data = file_get_contents($url, false, $context);

		return $data;
	}
	public function getConnectedClients() {
		$mystuff = $this->getUrl('http://snia.go.ro:8082/Main_WStatus_Content.asp');
		$mystuff = $this->scrape_between($mystuff, '----------------------------------------', '</textarea>');
		$mystuff = str_replace(':', '-', $mystuff);
		$mystuff = str_replace(' ', '', $mystuff);
		$mystuff = explode("\n", $mystuff);
		array_pop($mystuff);
		array_shift($mystuff);
		$a = [];
		$tpLink = new TPLINK();
		$tpLink->doLogout();

		foreach ($mystuff as $key => $mac) {
			$a[$key]['mac'] = $mac;
			$a[$key]['knownIdentity'] = $tpLink->knownMac($mac);
		}

		return $a;

	}
	public function deg($string) {
    	echo '<pre>';
    	print_r($string);
    	echo '</pre>';
    }
        // Defining the basic scraping function
    public function scrape_between($data, $start, $end) {
    	$data = stristr($data, $start); // Stripping all data from before $start string
    	$data = substr($data, strlen($start)); // Stripping $start
    	$stop = stripos($data, $end); // Getting the position of the $end of the data to scrape
    	$data = substr($data, 0, $stop); // Stripping all data from afther and including the $end of the data to scrape
    	return $data; // Returning the scraped data from the function
    }
}



$myTpLinkConn = new TPLINK();

$leased = $myTpLinkConn->getAssignedMac();
$connected2 = $myTpLinkConn->getConnectedClients24();
$connected5 = $myTpLinkConn->getConnectedClients5();
$myTpLinkConn->doLogout();

echo '<ol class="leased"><lh><b>Clients served by DHCP on TPLINK</b></lh>';
foreach ($leased as $key => $client) {
	echo "<li>
			  [<span class='mac'>{$client['mac']}</span>]
			  [<span style='color:blue'>{$client['knownIdentity']}</span>]
			  [<span style='color:green'>{$client['name']}</span>] @
			  <span style='color:red'>{$client['ip']}</span>
			  [{$client['lease']}]
		  </li>";
}
echo '</ol>';


echo '<ol class="wifi2"><lh><b>Clients connected @ 2.4 Ghz on TPLINK</b></lh>';
foreach ($connected2 as $key => $client) {
	echo "<li>
			  [<span class='mac'>{$client['mac']}</span>]
			  <span style='color:blue'>{$client['knownIdentity']}</span>
			  [<span style='color:green'>{$client['received-packets']}</span>/<span style='color:red'>{$client['sent-packets']}</span>]
		  </li>";
}
echo '</ol>';

echo '<ol class="wifi5"><lh><b>Clients connected @ 5 Ghz on TPLINK</b></lh>';
foreach ($connected5 as $key => $client) {
	echo "<li>
			  [<span class='mac'>{$client['mac']}</span>]
			  <span style='color:blue'>{$client['knownIdentity']}</span>
			  [<span style='color:green'>{$client['received-packets']}</span>/<span style='color:red'>{$client['sent-packets']}</span>]
		  </li>";
}
echo '</ol>';


$myAsusConn = new ASUS();
$connectedAsus = $myAsusConn->getConnectedClients();


echo '<ol class="wifi5"><lh><b>Clients connected @ Asus Repreater</b></lh>';
foreach ($connectedAsus as $key => $client) {
	echo "<li>
			  [<span class='mac'>{$client['mac']}</span>]
			  <span style='color:blue'>{$client['knownIdentity']}</span>
		  </li>";
}
echo '</ol>';

echo 'Last time updated: ' . date("Y.m.d @ H:i:s") . '<br>';
if(isset($_GET['refresh'])){
	echo 'Auto refreshing each: [ ' . $_GET['refresh'] . ' seconds ]<br>';
	echo '<a href="?#">Disable auto-refresh.</a>';
} else {
	echo '<a href="?refresh=10">Enable auto-refresh.</a>';
}

// web carving with php http://www.jacobward.co.uk/working-with-the-scraped-data-part-2/

?>
</body>
</html>