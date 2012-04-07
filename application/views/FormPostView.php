
<form enctype="multipart/form-data" action="<?php echo $_SERVER['REQUEST_URI'].'?r=posts/create'; ?>" method="post">
	Theme: <input type="text" name="Theme" value=""/><input type="text" name="UserId" value="1"/><br>
	Text: <textarea name="Text"></textarea><br>
	<input type="submit" value="Add"/>
</form>
