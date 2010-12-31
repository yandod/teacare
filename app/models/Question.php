<?php
namespace app\models;
use app\models\Answer;

class Question extends \lithium\data\Model {

	public static function getQuestions($page = 1){
		$list = Question::all(
			array(
				'order' => array(
					'timestamp' => 'desc'
				),
				'limit' => 10,
				'page' => $page
			)
		);
		
		foreach ($list as $key => $row) {
			$answer = Answer::all(
				array(
					'conditions' => array(
						'parent' => $row->_id->__toString()
					),
					'order' => array(
						'timestamp' => 'asc'
					)
				)
			);
			$list[$key]['answer'] = $answer;
		}
		return $list;
	}
	
	public static function newQuestion($form,$user){
		$data = array(
			'subject' => $form['subject'],
			'timestamp' => time(),
			'userid' => 0,
			'screen_name' => null,
			'profile_image_url' => null
		);
		
		if (is_array($user) && !isset($form['anonymous'])) {
			$data['userid'] = $user['id'];
			$data['screen_name'] = $user['screen_name'];
			$data['profile_image_url'] = $user['profile_image_url'];
		}
		$question = Question::create($data);
		$question->save();
	}
}


