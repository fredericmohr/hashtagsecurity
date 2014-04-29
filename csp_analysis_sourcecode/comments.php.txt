<?php
	/**
	 * Edited by @hashtagsecurity
	 * Original script by @sofasurfer.ch
	 * http://blog.sofasurfer.ch/wp-content/uploads/2011/03/comment.txt
	 */
 
 	/* path to comments data file */
 	$commentsFile = 'data/comments.json';
 	
 	/* variable for error message */
 	$errorMessage = false;
 	

	/* check if comments file exist */
	if( file_exists($commentsFile) ){
	
		/* get comments from file */
		$commentsText = file_get_contents($commentsFile);

		/* create array list from comments */
		$commentsList = json_decode($commentsText,true);
		
	}


	/* check if new comment is posted */
	if( !empty($_POST['comment']) ){
	 
	 	
	 	/* get posted comment */
	 	$sComment = $_POST['comment'];
#                $sComment = strip_tags($_POST['comment']);


			/* add comment to array */
			$commentsList[] = array(
				'text' => $sComment,
			);
		
			/* convert comments to string */
			$commentsText = json_encode($commentsList);
		
			/* save comment to file */
			file_put_contents($commentsFile, $commentsText);			
	 }

	/* check if comments exist */
	if( !empty($commentsList) ){
			
		/* reverse array so latest comment is first */
		$commentsList = array_reverse($commentsList,true);

		/* sort list by date */

		/* create html list */		
		$commentsHTML = "<ul>";

		/* loop all comments */
		foreach( $commentsList as $commentItem ){

			// add comment to html list
			$commentsHTML.= "<li>" . $commentItem["text"] . "</li>";
		}

		/* close html comments list */		
		$commentsHTML .= "</ul>";
	}
	
	if (isset($_POST['resetjson'])) 
	{ 
	   file_put_contents($commentsFile, '[{"text":"html-tags are not filtered on purpose, js however is blocked by our CSP"}]'); 
	}  

?>
<html>
	<head>
		<title>JSON Comments</title>
		<meta charset="utf-8"/>
		</head>
	<body>
			<form method="POST" action=""> 
				<input type="submit" name="resetjson" value="Reset JSON File">
			</form>
			<form id="comments" method="POST">
				<h3>Post your comments.</h3>
				<div class="error"></div>
				<textarea id="comment" name="comment" cols="70"> </textarea><br/>
				<input type="submit" value="Post" />
				<?=$commentsHTML?>			
			</form>


	</body>
</html>
