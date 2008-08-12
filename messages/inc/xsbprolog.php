<?php
class Xsbprolog {

  /**
   * Constructs XSB Prolog class
   * 
   * @param systemPath the path to the system rules
   * @param XsbPath path to XSB binary
   */

  private $systemPath;
  private $xsb;
  function  __construct($systemPath="/var/www/HIPAA",$xsbBinary="/var/www/XSB/bin/xsb") {
    $this->systemPath = $systemPath;
    $this->xsb = $xsbBinary;
    
  }


  
  public function ask($query) {
    $command = "";
    $command .= "cd $this->systemPath;";
    $command .= "echo \"$query\" | $this->xsb -e \"['shh.pl'].\" 2>&1";
    return shell_exec($command);
  }
  
  public function askHIPAA($query) {
    //    $str = $this->ask($query);
    $query = str_replace("\n", "", $query);
    $cmd = 'cd ' . $this->systemPath . '; ../prolog "' . $query . '"';
    return shell_exec($cmd);
  }

}

?>