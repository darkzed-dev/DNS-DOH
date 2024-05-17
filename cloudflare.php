<?php
//DOH by Darkzed
if (isset($_SERVER['CONTENT_TYPE']) && $_SERVER['CONTENT_TYPE'] == 'application/dns-message')
{
        $request = file_get_contents("php://input");
        header("Content-Type: application/dns-message");
        $fp = fsockopen("udp://1.1.1.1", 53, $errno, $errstr);
        if ($fp)
        {
                fwrite($fp, $request);
                echo fread($fp, 4096);
                fclose($fp);
        }
}
else if (isset($_GET['dns']))
{
        $request = base64_decode(str_replace(array('-', '_'), array('+', '/'), $_GET['dns']));
        header("Content-Type: application/dns-message");
        $fp = fsockopen("udp://1.1.1.1", 53, $errno, $errstr);
        if ($fp)
        {
                fwrite($fp, $request);
                echo fread($fp, 4096);
                fclose($fp);
        }
        else
        {
            echo $errstr;
        }
}else{
        echo 'access denide';
}
?>