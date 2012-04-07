<div id="posts">
<?php foreach($result as $val){	?>
	<div>
		<h3><?=$val['Theme']?></h3>
		<p><?=nl2br($val['Text'])?></p>
		<a href="?r=posts/update/id/<?=$val['id']?>" >Change</a>
		<a href="?r=posts/delete/id/<?=$val['id']?>" >Delete</a>
	</div>
<?php	
}	
require_once('FormPostView.php');
?>
</div>
