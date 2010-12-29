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
				'limit' => 5,
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
						'timestamp' => 'desc'
					)
				)
			);
			$list[$key]['answer'] = $answer;
		}
		return $list;
	}
}


