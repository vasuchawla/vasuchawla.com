<?php

function download_file ($url, $path) {
  $newfilename = $path;
if(!is_file($newfilename)){
  $file = fopen ($url, "rb");
  if ($file) {
    $newfile = fopen ($newfilename, "wb");

    if ($newfile)
    while(!feof($file)) {
      fwrite($newfile, fread($file, 1024 * 8 ), 1024 * 8 );
      $i++;
    }
  }

  if ($file) {
    fclose($file);
  }
  if ($newfile) {
    fclose($newfile);
  }
 }}

 if(isset($_GET['url']) && $_GET['url']!=""){
 
download_file ($_GET['url'], $_GET['name']) ;

 

$curdir = dirname($_SERVER['REQUEST_URI'])."/";



echo 'Download the file from <a href="'.$curdir."/".$_GET['name'].'">here</a> now !!!';


}else{

?>
<form>
Video Url:<br />
<input type="text" name="url" /><br />
Name of file to be stored on site:<br />
<input type="text" name="name" /><br />
<input type="submit"  />
<?php }
?>
