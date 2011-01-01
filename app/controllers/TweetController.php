<?php

namespace app\controllers;

use \li3_oauth\models\Consumer;
use \lithium\storage\Session;

class TweetController extends \lithium\action\Controller {

	protected function _init() {
		parent::_init();
		Consumer::config(array(
			'host' => 'twitter.com',
			'oauth_consumer_key' => OAUTH_CONSUMER_KEY,
			'oauth_consumer_secret' => OAUTH_CONSUMER_SECRET,
		));
	}

	public function index() {
		$message = null;
		$token = Session::read('oauth.access');

		if (empty($token) && !empty($this->request->query['oauth_token'])) {
			$this->redirect('Tweet::access');
		}
		if (empty($token)) {
			$this->redirect('Tweet::authorize');
		}
		$this->redirect('Question::index');
	}

	public function authorize() {
		$token = Consumer::token('request');
		if (is_string($token)) {
			return $token;
		}
		Session::write('oauth.request', $token);
		$this->redirect(Consumer::authorize($token));
	}

	public function access() {
		$token = Session::read('oauth.request');
		$access = Consumer::token('access', compact('token'));
		Session::write('oauth.access', $access);

		//get identity
		$result = Consumer::get('/account/verify_credentials.json',
			array(),
			array('token' => $access)
		);
		$message = json_decode($result,true);
		Session::write('twitter.info', $message);
		
		$this->redirect('Question::index');
	}

	public function login() {
		Session::clear();
		$token = Session::read('oauth.request');
		if (empty($token)) {
			$this->redirect('Tweet::authorize');
		}
		$this->redirect(Consumer::authenticate($token));
	}
	
	public function logout() {
		Session::clear();
		$this->redirect('Question::index');
	}
}

?>