<section class="content-header">
  <h1>
    Add
    <small>Songs</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url() . '/admin/dashboard'; ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="<?php echo base_url() . '/admin/songs'; ?>"><i class="fa fa-dashboard"></i> Songs</a></li>
    <li class="active">Add</li>
</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-info">
				<div class="box-header with-border">
					<h3 class="box-title">Song</h3>
				</div>
				<?php $this->renderPartial('_form', array('model'=>$model,'genres'=>$genres)); ?>
			</div>
		</div>
	</div>
</section>
