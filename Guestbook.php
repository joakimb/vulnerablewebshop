<?php

include 'DBHandle.php';
include 'CSRFProtector.php';


	 	$comment = isset($_GET['comment']) ? $_GET['comment'] : '';
	 	$submit = isset($_GET['submit']) ? $_GET['submit'] : '';
	 	$csrfp = isset($_GET['csrfp']) ? $_GET['csrfp'] : '';
	 	$dbHandle = new DBHandle();

 		
if($submit){
	if($comment){
		if(!CSRFProtector::nonceIsValid($csrfp)){
			echo "MALICIOUS LINK, ABORTING!!!!";
			die();
		}
 		$dbHandle->putComment(htmlspecialchars($comment));
 		echo "Thanks for your comment!";
	}else{
		echo "Please fill in the comment field!";
	}

}

showGuestbook();


function showGuestbook(){

	echo "<p>Comments:</p>";

	$dbHandle = new DBHandle();
	$comments = $dbHandle->getComments();
	for ($i=0; $i < count($comments); $i++) { 

		$comment = $comments[$i];
//		echo $comment->user . "<br>";
//		echo $comment->comment . "<br>";
//		echo $comment->commentId . "<br>";
//		echo "<br>";
		echo $i . '. ' . $comment . '<br /> <br />';
	}
?>

<form action='index.php' method='GET'>
  Comment:<br />
  <textarea name="comment" rows="20" cols="80"></textarea>
  <input name='submit' type='submit' value='Comment' />  
  <input name='content' type='hidden' value='guestbook' />  
  <input name='csrfp' type='hidden' value='<?php echo CSRFProtector::CSRFNonce(); ?>' />  
</form>

	<?php

	}
?>

