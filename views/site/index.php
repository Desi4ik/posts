<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <?php if (!empty($post)) { ?>
			<h1><?= $post->title ?></h1>
		<?php } else { ?>
			<h1>Посты отсутствуют</h1>
		<?php } ?>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

			<p><?= $post->content ?></p>

            </div>
            
        </div>
		<div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php if (!empty($comments)) { ?>
					<h2>Comments</h2>
						<div class="comments-block" >
							<?php 
								function viewTreeRecursive($tree,$parent_id = 0, $prefix = '') {
									if(empty($tree[$parent_id])) {
										return;
									}
									$space = "............";
									$prefix = ($parent_id > 0) ? $prefix.$space : '';
									for($i = 0; $i < count($tree[$parent_id]); $i++) {
							?>			
										<div class="comments-line">
											<?php echo $prefix."- ".$tree[$parent_id][$i]['content']."  ".$tree[$parent_id][$i]['name']." (".$tree[$parent_id][$i]['create_at'].")" ?>
										</div>
										
							<?php		
											viewTreeRecursive($tree,$tree[$parent_id][$i]['id'], $prefix);
									}
								}
								viewTreeRecursive($comments);
							?>		
									
							
								
							
						
							
						</div>
                <?php } ?>
            </div>
            
        </div>

    </div>
</div>
