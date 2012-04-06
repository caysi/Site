<?php

class PostsController extends Controller{
	
	public function build($request){
		if(!empty($request->action)){
			$method = $request->action;
		}
		else{
			$method = self::DEFAULT_ACTION;
		}
		$model = $this->tf->posts;
		
		if($request->params['id']){
			$param = $request->params['id'];
		}
		else{
			$param = null;
		}
		
		$content = $model->$method($param);
		{	echo '<pre>';
			var_dump($content); echo '<br><br>';
			echo '</pre>';
		/**/}
	}
}
