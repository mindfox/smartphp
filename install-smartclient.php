<?php

function printLine($line) {
	print $line . "\n";
}

function progress($resource,$download_size, $downloaded, $upload_size, $uploaded)
{
    $progress = 0;
    if($download_size > 0) {
	    $progress = round($downloaded / $download_size  * 100);
        
	    // if ($progress <= 100) {
        //     printLine($progress);
    	// }
        echo "$progress%";
    }
    echo ".";
    ob_flush();
    flush();
    sleep(1); // just to see effect
}

function download($url) {

    printLine("Downloading: $url");

    ob_start();
    ob_flush();
    flush();
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    //curl_setopt($ch, CURLOPT_BUFFERSIZE,128);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, 'progress');
    curl_setopt($ch, CURLOPT_NOPROGRESS, false); // needed to make progress function work
    curl_setopt($ch, CURLOPT_HEADER, 0);
    //curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    $data = curl_exec($ch);
    curl_close($ch);
    ob_flush();
    flush();

    printLine("Done");

    return $data;

}

function extractZip($zipPath, $dstPath) {
    printLine("Extracting zip into $dstPath");
    $zip = new ZipArchive();
    if ($zip->open($zipPath) === true) {
        $zip->extractTo($dstPath);
        $zip->close();
    }
    else {
        printLine("Extracting failed!");
    }
    printLine("Done");
}

$url = "http://www.smartclient.com/builds/SmartClient/11.0p/LGPL/2017-04-07/SmartClient_v110p_2017-04-07_LGPL.zip";
// $url = "http://stackoverflow.com";
$tmp = "./tmp";
$dst = "./isomporphic";

file_put_contents($tmp, download($url));
extractZip($tmp, $dst);