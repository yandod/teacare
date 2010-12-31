<?php
namespace app\models;
class Answer extends \lithium\data\Model {

	public static function appendAnswer($form,$user){
		$data = array(
			'parent' => $form['parent'],
			'comment' => $form['comment'],
			'timestamp' => time(),
			'userid' => 0,
			'screen_name' => null,
			'profile_image_url' => null
		);
		
		if (is_array($user) && $form['anonymous']) {
			$data['userid'] = $user['id'];
			$data['screen_name'] = $user['screen_name'];
			$data['profile_image_url'] = $user['profile_image_url'];
		}
		$question = Answer::create($data);
		$question->save();
	}
}


