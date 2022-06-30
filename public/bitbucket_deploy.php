<?php
// if(function_exists('shell_exec')) {
//     echo "exec is enabled";
// } else { echo "ga ada";  };
if ($_SERVER['HTTP_X_EVENT_KEY']=='repo:push') :
    $do = shell_exec("git pull");
    // $theCommitMessage = json_decode($_POST['payload'])->commits[0]->message; // get the commit from Bitbucket
    
    // $pattern = '/\[(.*?)\]/';
    // preg_match( $pattern, $theCommitMessage, $match );
    // if (!empty($match)) : // if we have somthing like "my commit [rm file]"
        //     $theCommand = $match[1]; // get the command
        //     shell_exec($theCommand); // Execute the command
        // endif;
endif;
    
// $do = shell_exec("git pull");

$log_filename='bitbucket_autodeploy_'.date('Ymd').'.log';

if(!file_exists("../app/logs/$log_filename")):
	fopen("../app/logs/$log_filename", "w");
endif;

$myfile = fopen("../app/logs/$log_filename", "a") or die("Unable to open file!");
$txt ="pull at : ".date('Y-m-d H:i:s')."\n";
$txt.="type : git pull\n";
// $txt.="mssg : ".$theCommitMessage."\n";
$txt.="post : ".json_encode($_POST)."\n";
$txt.="request : ".json_encode($_REQUEST)."\n";
$txt.="server : ".json_encode($_SERVER)."\n";
$txt.="-----------------------------------------------------------------\n";
fwrite($myfile, $txt);
fclose($myfile);
