<?php
    if(isset($_GET['issue']) && isset($_GET['page'])) {
        $issue = intval($_GET['issue']);
        $page = intval($_GET['page']);
        
        $src = imagecreatefromjpeg("pages/$issue/large/$page.jpg");
        $size = isset($_GET['size']) && $_GET['size'] == 's' ? 'small' : 'medium';
        
        $swidth = imagesx($src);
        $sheight = imagesy($src);

        $height = $size == 'small' ? 100 : 500;
        
        
        $width = intval($swidth * ($height / $sheight));
       
        $dst = imagecreatetruecolor ($width, $height);
        imagecopyresized($dst, $src, 0, 0, 0, 0,$width,$height, $swidth, $sheight);
        
        if (!file_exists("pages/$issue/$size")) { mkdir("pages/$issue/$size"); }
        
        imagejpeg($dst, "pages/$issue/$size/$page.jpg");
        header("Content-type: image/jpg"); 
        
        imagejpeg($dst);
    }
?>