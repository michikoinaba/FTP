<? php

//this is phpseclib library
include('Net/SFTP.php');


class FTPModel{

	protected $_connectId='';
	protected $_ftp_username='';
	protected $_ftp_password='';
	protected $_ftp_server='';


	public function __construct($server='', $username='', $password=''){

		$this->_ftp_server = $server;
		$this->_ftp_username = $username;
		$this->_ftp_password = $password;

	}//function

	/**
	 * this function checks if the selected file name exists in the directory.
	 * If so, sftp put the file to the remove server.
	 * 
	 * @param string $path, string $filename
	 */
	public function NetSftpPut($path='',$filename=''){
		
		$files=array();
		$found=false;
		
		//login to the remote server
		$sftp = new Net_SFTP($this->_ftp_server);
		if (!$sftp->login($this->_ftp_username, $this->_ftp_password))
		{
			exit('SFTP login failed');
		}
		else{
			
			//check if the selected file exists on the local server to sftp put from.
			$files = array_diff(scandir($path), array('.', '..'));
			//echo print_r($files,true);
			
			if(!empty($files)){
				
				//loop through all the file names 
				foreach($files as $key=>$value){
					
					//if the filename exists on the local server, excute SFTP PUT 
					if(stripos($filename,$value)!==false){
						
						//set the flag to true.
						$found=true;
						
						echo $sftp->pwd();  //remote server, local server
						$output = $sftp->put($filename, $path.'/'.$filename);
						echo $output;
						echo $sftp->getSFTPLog();
						$output = $sftp->exec('ls -a');
						
						echo $output;
						
					}//if(stripos()!==false){
					
				}//foreach
				
				if($found==false){
					
					echo 'The filename was not found in the directory '.$path;
					
				}//if($found==false){
				
			}//if(!empty($files)){
			else{
				
				echo 'The directory '.$path.' is not found on the server';
			}
			
			
			
		}//else
		
	}//function
	
	
	
}//class

?>
