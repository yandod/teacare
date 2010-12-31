<?php
namespace app\controllers;
use app\models\Question;
use app\models\Answer;
use \lithium\storage\Session;

class QuestionController extends \lithium\action\Controller {
	protected function _init(){
		parent::_init();
		$this->info = Session::read('twitter.info');
	}
	
	public function index(){
		$questions = Question::getQuestions();
		$info = $this->info;
		return compact('questions','info');
	}
	
	public function add(){
		$question = Question::newQuestion($this->request->data,$this->info);
		$this->redirect('question/index');
	}
	
	public function answer(){
		Answer::appendAnswer($this->request->data,$this->info);
		$this->redirect('question/index#'.$this->request->data['parent']);		
	}
}

