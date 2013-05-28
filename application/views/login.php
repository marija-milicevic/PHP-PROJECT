<script type="text/javascript" src="<?php echo base_url(); ?>public/js/post.js"></script>
<div id="main_wrapper">
   
   <div id="menu_wrrap" class="box_border">
   	<ul>
   		<li><a href="<?php echo base_url(); ?>index.php">Blog Posts List</a></li>
   		<li><a href="<?php echo base_url(); ?>index.php/post/add">Create new blog post</a></li>
   	</ul>
   </div>
   
   <div id="content_wrrap" class="box_border">
   	    <br/><br/>
   	    <?php if($message != '') { ?>
   			<span style="color: red"><?php echo $message;?></span><br/><br/>
   		<?php } ?>
   	    
   		<?php
   			echo form_open('/login/do_login');
			echo form_label('Username: ', 'username');
			echo form_input('username'); ?>
		<br/><br/>
		<?php
			echo form_label('Password: ', 'username');
			echo form_password('password'); ?>
		<br/><br/>
		<?php
			echo form_submit('submit','Login');
   		?>
   </div>

</div> 