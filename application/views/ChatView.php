<script type="text/javascript" src="<?=ROOT_URL?>js/xmlhttprequest.js"></script>
<script type="text/javascript" src="<?=ROOT_URL?>js/chat.js"></script>
<div id="chat">
<?php foreach($this->result as $val){	?>
	<p id="<?=$val['id']?>"><b><?=$val['user']?>:</b> <?=$val['text']?></p>
<?php	
}
?>
</div>
<?php	require_once('ChatFormView.php');	?>
