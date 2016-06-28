<?php

include_once 'FTPModel.php';

  set_include_path(get_include_path() . PATH_SEPARATOR . './phpseclib');

//the file path on the local server.
  $path="/home/root/test.txt";
  
  //get the array of the path
  $path_array = explode('/', $path);
  
  //get the last element of the array which is a file name
  $filename = array_pop($path_array); 
 
 
  //get the directory location without the file name.
  $dir_location=implode("/",$path_array);
  
  //once get the dir location and file name, now it's ready to SFTP the file
  if(($dir_location!='') && ($filename!='')){
  	
  	$ftp = new FTPModel('remote-server-ip-address', 'username', 'password' );
  	
  	$ftp->NetSftpPut($dir_location,$filename);
  	
  }else{
  	
  	echo 'location or file name is unknown';
  }
 
  
  

?>
