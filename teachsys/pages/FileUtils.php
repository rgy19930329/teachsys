<meta charset="utf-8" />
<?php
    
    function deldir($dir) {
      	$storage = new SaeStorage();
        $domain = 'mydir';
        $path = $dir;
        $num = 0;
        $ret = $storage->getListByPath($domain, $path, 1000, $num );
        
        $files = $ret[files];
        
        foreach($files as $file){
            $filename = $file[Name];
            $filefull = $file[fullName];
            $storage->delete($domain,$filefull);
        }
    }

?>