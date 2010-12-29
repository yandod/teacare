<?=$this->form->create(null,array('url'=>'question/add'));?>
<?=$this->form->text('subject');?>
<?=$this->form->submit('Submit');?>
<?=$this->form->end();?>

<?php foreach($questions as $row):?>
<p>
<h3><a name="<?= $row->_id;?>"><?= $row->subject; ?></a></h3>
<?= date('Y-m-d H:i:s',$row->timestamp) ?>
<ul>
<?php foreach($row['answer'] as $answer):?>
<li><?= $answer->comment ?> (<?= date('Y-m-d H:i:s',$answer->timestamp) ?>)</li>
<?php endforeach;?>
</ul>
<?php if (count($row['answer']) <= 10): ?>
<?=$this->form->create(null,array('url'=>'question/answer'));?>
<?=$this->form->text('comment');?>
<?=$this->form->hidden('parent',array('value' => $row->_id));?>
<?=$this->form->submit('Submit');?>
<?=$this->form->end();?>
<?php endif; ?>
</p>
<?php endforeach;?>


