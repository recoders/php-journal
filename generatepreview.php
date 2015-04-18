<?php
    $xshift = 56;
    $yshift = 73;
    if(isset($_GET['id'])) {
        $issue = intval($_GET['id']);
        $files = scandir("pages/$issue/large/");
        sort($files, SORT_NUMERIC);
        $image = imagecreatetruecolor (2 * $xshift, (sizeof($files) / 2) * $yshift); // haha! '.' and '..' add 1 page what we want!
        $row = 0;
        $col = 0;
        foreach ($files as $file) {
            if ($file == '.' || $file == '..') continue;
            $img = imagecreatefromjpeg("pages/$issue/large/$file");
            imagecopyresized($image, $img, $col * $xshift, $row * $yshift, 0, 0,$xshift,$yshift,imagesx($img),imagesy($img));
            
            $col++;
            if ($col == 2 || $row == 0) {
                $col = 0;
                $row++;
            }
        }
        imagejpeg($image, "pages/$issue/preview.jpg");
        header("Content-type: image/jpg"); 
        imagejpeg($image);
    }
?>