<?php
set_time_limit(300);

function MakeDir($path) {
   return is_dir($path) || mkdir($path);
}

function CreateIcon($fileName, $size, $name) {

	list( $uploadWidth, $uploadHeight, $uploadType ) = getimagesize( $fileName );

	$srcImage = imagecreatefrompng( $fileName );    
	$targetImage = imagecreatetruecolor( $size, $size );

	imagealphablending( $targetImage, false );
	imagesavealpha( $targetImage, true );

	imagecopyresampled( $targetImage, $srcImage, 
	                    0, 0, 
	                    0, 0, 
	                    $size, $size, 
	                    $uploadWidth, $uploadHeight );

	imagepng($targetImage, $name, 9);
}


$randomName = substr(str_shuffle(md5(time())), 0, 20);
MakeDir("upload/" . $randomName);


move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $randomName . "/upload.png");

CreateIcon("upload/" . $randomName . "/upload.png", 29, "upload/" . $randomName . "/Icon-Small.png");
CreateIcon("upload/" . $randomName . "/upload.png", 58, "upload/" . $randomName . "/Icon-Small@2x.png");
CreateIcon("upload/" . $randomName . "/upload.png", 50, "upload/" . $randomName . "/Icon-Small-50.png");
CreateIcon("upload/" . $randomName . "/upload.png", 100, "upload/" . $randomName . "/Icon-Small-50@2x.png");
CreateIcon("upload/" . $randomName . "/upload.png", 57, "upload/" . $randomName . "/Icon.png");
CreateIcon("upload/" . $randomName . "/upload.png", 114, "upload/" . $randomName . "/Icon@2x.png");
CreateIcon("upload/" . $randomName . "/upload.png", 72, "upload/" . $randomName . "/Icon-72.png");
CreateIcon("upload/" . $randomName . "/upload.png", 144, "upload/" . $randomName . "/Icon-72@2x.png");
CreateIcon("upload/" . $randomName . "/upload.png", 40, "upload/" . $randomName . "/Icon-40.png");
CreateIcon("upload/" . $randomName . "/upload.png", 80, "upload/" . $randomName . "/Icon-40@2x.png");
CreateIcon("upload/" . $randomName . "/upload.png", 60, "upload/" . $randomName . "/Icon-60.png");
CreateIcon("upload/" . $randomName . "/upload.png", 120, "upload/" . $randomName . "/Icon-60@2x.png");
CreateIcon("upload/" . $randomName . "/upload.png", 76, "upload/" . $randomName . "/Icon-76.png");
CreateIcon("upload/" . $randomName . "/upload.png", 152, "upload/" . $randomName . "/Icon-76@2x.png");
CreateIcon("upload/" . $randomName . "/upload.png", 512, "upload/" . $randomName . "/iTunesArtwork.png");
CreateIcon("upload/" . $randomName . "/upload.png", 1024, "upload/" . $randomName . "/iTunesArtwork@2x.png");

// New Icons
CreateIcon("upload/" . $randomName . "/upload.png", 16, "upload/" . $randomName . "/Icon-16.png");
CreateIcon("upload/" . $randomName . "/upload.png", 24, "upload/" . $randomName . "/Icon-24.png");
CreateIcon("upload/" . $randomName . "/upload.png", 32, "upload/" . $randomName . "/Icon-32.png");
CreateIcon("upload/" . $randomName . "/upload.png", 64, "upload/" . $randomName . "/Icon-64.png");
CreateIcon("upload/" . $randomName . "/upload.png", 120, "upload/" . $randomName . "/Icon-120.png");
CreateIcon("upload/" . $randomName . "/upload.png", 152, "upload/" . $randomName . "/Icon-152.png");
CreateIcon("upload/" . $randomName . "/upload.png", 40, "upload/" . $randomName . "/Icon-Small-40.png");
CreateIcon("upload/" . $randomName . "/upload.png", 80, "upload/" . $randomName . "/Icon-Small-40@2x.png");

// Iphone 6
CreateIcon("upload/" . $randomName . "/upload.png", 180, "upload/" . $randomName . "/Icon-60@3x.png");
CreateIcon("upload/" . $randomName . "/upload.png", 87, "upload/" . $randomName . "/Icon-Small@3x.png");
CreateIcon("upload/" . $randomName . "/upload.png", 120, "upload/" . $randomName . "/Icon-Small-40@3x.png");



CreateIcon("upload/" . $randomName . "/upload.png", 114, "upload/" . $randomName . "/Icon-Amazon.png");

CreateIcon("upload/" . $randomName . "/upload.png", 192, "upload/" . $randomName . "/Icon-xxxhdpi.png");
CreateIcon("upload/" . $randomName . "/upload.png", 144, "upload/" . $randomName . "/Icon-xxhdpi.png");
CreateIcon("upload/" . $randomName . "/upload.png", 96, "upload/" . $randomName . "/Icon-xhdpi.png");
CreateIcon("upload/" . $randomName . "/upload.png", 72, "upload/" . $randomName . "/Icon-hdpi.png");
CreateIcon("upload/" . $randomName . "/upload.png", 48, "upload/" . $randomName . "/Icon-mdpi.png");
CreateIcon("upload/" . $randomName . "/upload.png", 36, "upload/" . $randomName . "/Icon-ldpi.png");





$images = "upload/" . $randomName . "/";
$zip_file = "upload/" . $randomName . ".zip";

if ($handle = opendir($images))  
{
    $zip = new ZipArchive();

    if ($zip->open($zip_file, ZIPARCHIVE::CREATE)!==TRUE) 
    {
        exit("cannot open <$filename>\n");
    }

    while (false !== ($file = readdir($handle))) 
    {
        if (substr($file, 0, 1) != ".") {
            $zip->addFile($images . $file, $file);
        
        }
    }
    closedir($handle);
    $zip->close();
}

//echo "<a href='upload/" . $randomName . ".zip'>Show Files</a>";
header("Location: index.html#" . $randomName);
?>
