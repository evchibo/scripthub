<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView(__FILE__);
_setLayout('blank');
	
	$commentID = get_id(2);
	
	$commentsClass = new comments();
	
	$comment = $commentsClass->get($commentID);
	if(!is_array($comment)) {
		addErrorMessage($langArray['wrong_comment'], '', 'error');
	}
	else {
		abr('show_form', 'yes');
		abr('comment', $comment);
	}

?>