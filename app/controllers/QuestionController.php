<?php
namespace app\controllers;
use app\models\Question;
use app\models\Answer;

class QuestionController extends \lithium\action\Controller {
	public function index(){
		$questions = Question::getQuestions();
		return compact('questions');
	}
	
	public function add(){
		$data = $this->request->data;
		$data['timestamp'] = time();
		$question = Question::create($data);
		$question->save();
		$this->redirect('question/index');
	}
	
	public function answer(){
		$data = $this->request->data;
		$data['timestamp'] = time();
		$answer = Answer::create($data);
		$answer->save();
		$this->redirect('question/index#'.$data['parent']);		
	}
}

