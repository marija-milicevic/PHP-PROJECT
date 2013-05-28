<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/post.css" type="text/css" />
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/post.js"></script>
<div id="main_wrapper">
   
    <div id="menu_wrrap" class="box_border">
   	<ul>
   		<li><a href="<?php echo base_url(); ?>index.php/admin/post">Unauthorized Posts List</a></li>
 
   	</ul>
   </div>
   
   <div id="content_wrrap" class="box_border">
   		<div class="title_label">
			<span>Post detail</span>
		</div>
   		<form method="post" action="<?php echo base_url(); ?>index.php/admin/post/authorize">
   			<br/>
   			<span style="color: red;"><?php echo validation_errors(); ?></span>
			<div>
				<br/>
				<button name="submit" value="delete" style="float:right; margin-right: 20px;"/>Delete</button>
				<button name="submit" value="authorize" style="float:right; margin-right: 20px;">Authorize</button>
				
				Author: <br/><input type="text" name="author" value="<?php echo $post['author'] ?>" /><br/><br/>
			</div>
			<div>
				Title: <br/><input type="text" name="title" style="width: 400px;" value="<?php echo $post['title'] ?>" /><br/><br/>
			</div>
			<div>
				Lead:<br/> <textarea name="lead" style="font: 13px Trebuchet MS; width: 400px" ><?php echo $post['lead'] ?>
				</textarea>
				<br/><br/>
			</div>
			<div id="view_description">
				
				<textarea name="content" id="content" ><?php echo $post['body'] ?></textarea><br/><br/>
				<?php echo display_ckeditor($ckeditor); ?>
			</div>
			<input type="hidden" name="post_id" value="<?php echo $post['id'] ?>">
		</form>
   </div>

</div> 