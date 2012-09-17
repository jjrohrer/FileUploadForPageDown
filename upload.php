<?
$allowedExts = array("jpg", "jpeg", "gif", "png","mp4","mov");
$allowedTypes = array("image/gif", "image/jpeg", "image/pjpeg");
$extension = end(explode(".", @$_FILES["file"]["name"]));
if (!in_array($extension, $allowedExts)) {
  $allowedPretty = implode($allowedExts,",");
  print '{"succes":false, "message":"Invalid file type.  You gave a '.$extension.' but only '.$allowedPretty.' are allowed "}';
  exit;
}

if (!in_array(@$_FILES["file"]["type"], $allowedTypes)) {
  $allowedPretty = implode($allowedTypes,",");
  print '{"succes":false, "message":"Invalid file meta type.  You gave a '.$_FILES["file"]["type"].' but only '.$allowedPretty.' are allowed "}';
  exit;
}


$maxSizeBytes = convertToBytes( ini_get( 'upload_max_filesize' ));
if ($_FILES["file"]["size"] > $maxSizeBytes) {
  print '{"succes":false, "message":"too big.  You gave a '.$_FILES["file"]["size"].' byte file but it must be less than '.$maxSizeBytes.' in size"}';
  exit;
}

if ($_FILES["file"]["error"] > 0)
  {
  print '{"success":false, "message": "Misc error code:'.$_FILES["file"]["error"].'"}';//echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
  }
else
  {
  // echo "Upload: " . $_FILES["file"]["name"] . "<br />";
  // echo "Type: " . $_FILES["file"]["type"] . "<br />";
  // echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
  // echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

  if (file_exists("upload/" . $_FILES["file"]["name"]))
    {
    //echo $_FILES["file"]["name"] . " already exists. ";
      print '{"success":false, "message":"File already exists"}';
    }
  else
    {
    move_uploaded_file($_FILES["file"]["tmp_name"],
                              "upload/" . $_FILES["file"]["name"]);
    print '{"success":true, "imagePath":"upload/'.$_FILES["file"]["name"].'"}';
    //echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
    }
  }

  /** http://php.net/manual/en/faq.using.php#78405
 * Convert a shorthand byte value from a PHP configuration directive to an integer value
 * @param    string   $value
 * @return   int
 */
function convertToBytes( $value ) {
    if ( is_numeric( $value ) ) {
        return $value;
    } else {
        $value_length = strlen( $value );
        $qty = substr( $value, 0, $value_length - 1 );
        $unit = strtolower( substr( $value, $value_length - 1 ) );
        switch ( $unit ) {
            case 'k':
                $qty *= 1024;
                break;
            case 'm':
                $qty *= 1048576;
                break;
            case 'g':
                $qty *= 1073741824;
                break;
        }
        return $qty;
    }
}
