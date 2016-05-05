<?php
	require './assets/aws/aws-autoloader.php';
	use Aws\S3\S3Client;
	use Aws\Credentials\Credentials;
	use Aws\Exception\AwsException;
	use Aws\S3\Exception\S3Exception;
	class AS3 {
		public $s3Client;
		public function __construct()
		{
			
			$credentials = new Credentials(Yii::app()->params['access_key_id'], Yii::app()->params['secret_access_key']);
			// Instantiate the S3 client with your AWS credentials
			$this->s3Client = S3Client::factory([
												'version'     => 'latest',
											    'region'      => 'us-west-2',
											    /*'http'  =>  [
														       'verify' => dirname(__FILE__).'/../../../../assets/cert/cacert.pem'
														    ],*/
											    'credentials' => $credentials
												]);
			/*$s3 = new S3Client([
				    'version'     => 'latest',
				    'region'      => 'us-west-2',
				    'credentials' => [
				        'key'    => Yii::app()->params['access_key_id'],
				        'secret' => Yii::app()->params['secret_access_key']
				    ]
				]);*/
		}

		public function addBucket($bucket)
		{
			if($this->s3Client->createBucket(['Bucket' => $bucket])){
				return true;
			} else {
				return false;
			}
			/*try {
			    $this->s3Client->createBucket(['Bucket' => $bucket]);
			    return true;
			} catch (S3Exception $e) {
			    // Catch an S3 specific exception.
			    echo $e->getMessage();
			    die;
			} catch (AwsException $e) {
			    // This catches the more generic AwsException. You can grab information
			    // from the exception using methods of the exception object.
			    echo $e->getAwsRequestId() . "\n";
			    echo $e->getAwsErrorType() . "\n";
			    echo $e->getAwsErrorCode() . "\n";
			    die;
			}*/
		}

	}
?>