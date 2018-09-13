<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView(__FILE__);

if(!check_login_bool()) {
	refresh('/'.$languageURL.'sign_in/');
}

	$quizClass = new quiz();
	$answersClass = new answers();
	
	$questions = $quizClass->getAll(0, 0, '', 'RAND()');
	abr('questions', $questions);
	
	$answers = $answersClass->getAll(0, 0, '', true);
	abr('answers', $answers);
	
	if($_SESSION['user']['quiz'] != 'false') {
		refresh('/'.$languageURL.'author_dashboard/');
	} 
	
#CHECK QUIZ
	if(isset($_POST['submit'])) {
		$rightAnswers = 0;
		if(isset($_POST['answers']) && is_array($_POST['answers'])) {
			foreach($_POST['answers'] as $question=>$answer) {
				if(isset($answers[$question][$answer]) && $answers[$question][$answer]['right'] == 'true') {
					$rightAnswers++;
				}
			}				
		}
		
		if($rightAnswers > 0 && count($questions) == $rightAnswers) {
			$_SESSION['user']['quiz'] = 'true';
			
			require_once ROOT_PATH.'/scripthub/apps/users/models/users.class.php';
			$usersClass = new users();
			
			$usersClass->updateQuiz($_SESSION['user']['user_id'], 'true');
			
			refresh('/'.$languageURL.'users/dashboard/', $langArray['complete_score_quiz'], 'complete');
		}
		else {
			addErrorMessage(langMessageReplace($langArray['error_quiz'], array('RIGHT' => $rightAnswers, 'TOTAL' => count($questions))), '', 'error');
		}
	}	
	
#BREADCRUMB	
	abr('breadcrumb', '<a href="/'.$languageURL.'" title="">'.$langArray['home'].'</a> \ <a href="/'.$languageURL.'quiz/" title="">'.$langArray['quiz'].'</a>');		
	

?>