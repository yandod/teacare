<?=$this->form->create(null,array('url'=>'question/add'));?>
<?=$this->form->text('subject');?>
<?=$this->form->checkbox('anonymous');?> anonymous
<?=$this->form->submit('Question');?>
<?=$this->form->end();?>

<?php foreach($questions as $row):?>
<p>
<h3><a name="<?= $row->_id;?>"><?= $row->subject; ?></a></h3>
 (<?= date('Y-m-d H:i:s',$row->timestamp) ?>)
<?php if($row->userid): ?>
 by 
 <?= $this->html->image($row->profile_image_url,array('width'=>30,'height'=>30, 'alt' => $row->screen_name)); ?>
<?php endif;?>
<ul>
<?php foreach($row['answer'] as $answer):?>
<li>
<?= $answer->comment ?> (<?= date('Y-m-d H:i:s',$answer->timestamp) ?>)
<?php if($answer->userid): ?>
 by 
 <?= $this->html->image($answer['profile_image_url'],array('width'=>30,'height'=>30, 'alt' => $answer->screen_name)); ?>
<?php endif;?>

</li>
<?php endforeach;?>
</ul>
<?php if (count($row['answer']) <= 10): ?>
<?=$this->form->create(null,array('url'=>'question/answer'));?>
<?=$this->form->text('comment');?>
<?=$this->form->hidden('parent',array('value' => $row->_id));?>
<?=$this->form->checkbox('anonymous');?> anonymous
<?=$this->form->submit('Answer');?>
<?=$this->form->end();?>
<?php else: ?>
<?= 'Answer has closed.' ?>
<?php endif; ?>
</p>
<?php endforeach;?>


