
<form enctype="multipart/form-data" action="<?php echo ROOT_URL; ?>?r=<?php if(isset($postAction)){echo $postAction;}else{echo 'posts/create';}?>" method="post">
	Theme: <input type="text" name="Theme" value="<?php 	if(isset($Theme))	{	echo $Theme;	}?>"/>
			<input style="display:none" type="text" name="UserId" value="<?php 	if(isset($UserId))	{	echo $UserId;	} else{echo '1';}?>"/><br>
	Text: <textarea name="Text"><?php 						if(isset($Text))	{	echo $Text;	}?></textarea><br>
	<input type="submit" value="Add"/>
</form>
