<?php
//include the S3 class              
if (!class_exists('S3'))
    require_once('S3.php');

//AWS access info
if (!defined('awsAccessKey'))
    define('awsAccessKey', 'AKIAJRGPDHXGHK4CSJJQ');
if (!defined('awsSecretKey'))
    define('awsSecretKey', '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');

//instantiate the class
$s3 = new S3(awsAccessKey, awsSecretKey);

//we'll continue our script from here in step 4!
//check whether a form was submitted
if (isset($_POST['Submit'])) {

    //retreive post variables
    $fileName = $_FILES['theFile']['name'];
    $fileTempName = $_FILES['theFile']['tmp_name'];

    //we'll continue our script from here in the next step!
    //create a new bucket
    $s3->putBucket("tbrs3", S3::ACL_PUBLIC_READ);

//move the file
    if ($s3->putObjectFile($fileTempName, "tbrs3", $fileName, S3::ACL_PUBLIC_READ)) {
        echo "We successfully uploaded your file.";
    } else {
        echo "Something went wrong while uploading your file... sorry.";
    }
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <input name="theFile" type="file" />
    <input name="Submit" type="submit" value="Upload">
</form>

<?php
// Get the contents of our bucket
$bucket_contents = $s3->getBucket("tbrs3");
 
foreach ($bucket_contents as $file){
 
    $fname = $file['name'];
    $furl = "http://tbrs3.s3.amazonaws.com/".$fname;
     
    //output a link to the file
    echo "<a href=\"$furl\">$fname</a><br />";
    echo '<img src="'.$furl.'" />';
}
?>
