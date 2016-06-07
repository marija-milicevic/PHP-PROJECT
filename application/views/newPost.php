<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/post.css" type="text/css" />
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/post.js"></script>
<div id="main_wrapper">
   
   <div id="menu_wrrap" class="box_border">
   	<ul>
   		<li><a href="<?php echo base_url(); ?>index.php">Blog Posts List</a></li>
   		<li><a href="<?php echo base_url(); ?>index.php/post/add">Create new blog post</a></li>
   	</ul>
   </div>
   
   <div id="content_wrrap" class="box_border">
   		<div class="title_label">
			<span>New post</span>
		</div>
   		<form method="post" action="<?php echo base_url(); ?>index.php/post/add">
   			<br/>
   			<span style="color: red;"><?php echo validation_errors(); ?></span>
			<div>
				<br/>
				<button id="button" style="float:right; margin-right: 20px;">Add post</button>
				Author: <br/><input type="text" name="author" /><br/><br/>
			</div>
			<div>
				Title: <br/><input type="text" name="title" style="width: 400px;" /><br/><br/>
			</div>
			<div>
				Lead:<br/> <textarea name="lead" style="font: 13px Trebuchet MS; width: 400px" ></textarea>
				<br/><br/>
			</div>
			<div id="view_description">
				
				<textarea name="content" id="content" ></textarea><br/><br/>
				<?php echo display_ckeditor($ckeditor); ?>
			</div>
			
		</form>
   </div>

</div> 