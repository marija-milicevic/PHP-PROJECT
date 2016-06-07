<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/post.css" type="text/css" />
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/post.js"></script>
<div id="main_wrapper">
   
   <div id="menu_wrrap" class="box_border">
   	<ul>
   		<li><a href="<?php echo base_url(); ?>index.php/admin/post">Unauthorized Posts List</a></li>
   	</ul>
   </div>
   
   <div id="content_wrrap" class="box_border">
   	<?php if(sizeof($posts)>0){ ?>	
		<div class="title_label">
			<span>Posts</span>
		</div>
	
		<div id="accordion">
			<?php foreach ($posts as $post): ?>
		 	<h3><?php echo $post['title']; ?>
		 		<small class="comm_time">By <?php echo $post['author']; ?> on [<?php echo $post['created']; ?>]</small>
		 	</h3>
   		 	<div class="comment_wrrap">
        		<p><?php echo $post['lead']; ?>...<a href="<?php echo base_url(); ?>index.php/admin/post/display/<?php echo $post['id'] ?>">More</a></p>
    		
    		</div>
			<?php endforeach ?>
		</div>
	<?php }else{?>
		
	<span style='color: orange'>There are no unauthorized posts.</span>
		
	<?php } ?>
   </div>

</div> 