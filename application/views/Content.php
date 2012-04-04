<div id="posts">
<?php
	foreach($content as $id){	?>
		<div>
		<h3><?=$id['Theme']?></h3>
		<p><?=nl2br($id['Text'])?></p>
		<a href="?r=post/set/id/<?=$id['id']?>" >Change</a>
		<a href="?r=post/del/id/<?=$id['id']?>" >Delete</a>
		</div>
	<?php	
	}
	//print_r($post);
?>
</div>
