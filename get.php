<?php
    
    require_once("clean.php");

    $id = $_GET["id"];
    $version = $_GET["version"];

    $requestOptions = array('http' => array('user_agent' => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/" . $version . " Safari/537.36", "follow_redirect" => false));
    $requestContext = stream_context_create($requestOptions);
    $request = "An error occurred";

    $request = file_get_contents("https://clients2.google.com/service/update2/crx?response=redirect&acceptformat=crx2,crx3&prodversion=" . $version . "&x=id%3D" . $id . "%26installsource%3Dondemand%26uc");
    file_put_contents(__DIR__ . "/extensions/" . $id . ".crx", $request);

    $file = __DIR__ . "/extensions/" . $id . ".crx";

    if (file_exists($file)) 
    {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);

        exit;
    }

?>