<?php
$postAction = (isset($this->result['postAction']) ? $this->result['postAction'] : 'posts/create');
$Theme = (isset($this->result['Theme'])) ? $this->result['Theme'] : '';
$UserId = (isset($this->result['UserId'])) ? $this->result['UserId'] : '1'; //////////////////////////
$Text = (isset($this->result['Text'])) ? $this->result['Text'] : '';
?>
<form enctype="multipart/form-data" action="<?php echo ROOT_URL; ?>?r=<?=$postAction?>" method="post">
	Theme: <input type="text" name="Theme" value="<?=$Theme?>"/>
			<input style="display:none" type="text" name="UserId" value="<?=$UserId?>"/><br>
	Text: <textarea name="Text"><?=$Text?></textarea><br>
	<input type="submit" value="Add"/>
</form>
