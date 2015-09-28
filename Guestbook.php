<?php

include 'DBHandle.php';
showGuestbook();

	 	$comment = isset($_POST['comment']) ? $_POST['comment'] : '';
	 	$submit = isset($_POST['submit']) ? $_POST['submit'] : '';
	 	$dbHandle = new DBHandle();

 		
if($submit){
	if($comment){
 		$dbHandle->putComment($comment);
 		echo "Thanks for your comment!";
	}else{
		echo "Please fill in the comment field!";
	}

}


function showGuestbook(){

	echo "<p>Comments:</p>";

	$dbHandle = new DBHandle();
	$comments = $dbHandle->getComments();
	/*for ($i=0; $i < count($comments); $i++) { 

		$comment = $comments[$i];
//		echo $comment->user . "<br>";
		echo $comment->comment . "<br>";
		echo $comment->commentId . "<br>";
		echo "<br>";
	}*/
?>

<form action='showGuestbook.php' method='POST'>
  Comment:<br />
  <textarea name="comment" rows="20" cols="80"></textarea>
  <input name='submit' type='submit' value='Comment' />  
</form>

	<?php

	}
?>

