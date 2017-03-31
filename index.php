<?php 


function getUser($ip)
{
    session_start();

    if(!isset($_SESSION['current_user']))
    {
        $file ='counter.txt';

        if(file_exists($file)){

        }else{
        	 $file = fopen($file, 'wb');
        	 chmod($file, 0777);

        }

        if(!$data = @file_get_contents($file))
        {

            file_put_contents($file,$ip);

            $_SESSION['count'] = 1;
        }
        else{
            
            $ipList = explode(';', $data);

            if(!in_array($ip, $ipList)){
              array_push($ipList, $ip);
              file_put_contents($file,implode(';', $ipList));
            }
            $_SESSION['count'] = count($ipList);
        }

        $_SESSION['current_user'] = $ip;

    }
    else{
    	 	
    	 	$ipList = explode(';', $data);
            if(!in_array($ip, $ipList)){
              array_push($ipList, $ip);
              file_put_contents($file,implode(';', $ipList));
            }

            $_SESSION['count'] = count($ipList);
        

    }
}

 
$ip = $_SERVER['REMOTE_ADDR'];
getUser($ip);
echo "current $ip </br>";

echo 'count: ' . $_SESSION['count'];

?>