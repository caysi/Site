<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">


<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?=$this->title?></title>
	<link rel="stylesheet" type="text/css" href="styles/style.css" />
</head>
<body>
	<div id="site_sections">
		<a href="<?=ROOT_URL?>">Home</a>
		<a href="<?=ROOT_URL.'?r=chat'?>">Chat</a>
	</div>

	<div class="content">
		<?=$content;?>
	</div>
	
</body>

</html>
