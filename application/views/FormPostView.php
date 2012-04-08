
<form enctype="multipart/form-data" action="<?php echo $_SERVER['REQUEST_URI']; ?>?r=<?php if($postMethod){echo $postMethod;}else{echo 'posts/create';}?>" method="post">
	Theme: <input type="text" name="Theme" value="<?php if($Theme){	echo $Theme;	}?>"/>
			<input type="text" name="UserId" value="<?php if($UserId){	echo $UserId;	}?>"/><br>
	Text: <textarea name="Text"><?php if($Text){	echo $Text;	}?></textarea><br>
	<input type="submit" value="Add"/>
</form>
