<?php  
	Yii::import("application.modules.home.models.Search", true);
	class SearchWidget extends CWidget {
		public function run() {
		    $model = new Search;

		    $this->render('searchForm',array('model'=>$model));
		} 
	} 
?>