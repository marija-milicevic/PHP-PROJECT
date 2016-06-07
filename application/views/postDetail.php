<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/post.css" type="text/css" />
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/post.js"></script>
<div id="main_wrapper">
	
<div id="menu_wrrap" class="box_border">
   	<ul>
   		<li><a href="<?php echo base_url(); ?>index.php">Blog Posts List</a></li>
   		<li><a href="<?php echo base_url(); ?>index.php/post/add">Create new blog post</a></li>
   	</ul>
 </div>

<div id="content_wrrap">
					
	<div id="desc_wrap">
		<div class="title_label">
			<span> Post details</span>
	    </div>
	    <div id="titleWrraper">	
			<div id="postTitle">
				<h3><?php echo $post['title']; ?></h3>
			</div>
		</div>
		<div class="post_notes">
			Posted by <?php echo $post['author']; ?> at <?php echo $post['created']; ?>
		</div>
		<div class="desc_content">
			 <?php echo $post['body']; ?>
		</div>
	</div>
   
  <!-- <div id="comm_wrrap">	
	<div class="title_label">
		<span>Comments</span>
	</div>
	<div id="accordion">
		<?php foreach ($post['comments'] as $comment): ?>
		 <h3><?php echo $comment['author']; ?><small class="comm_time">[<?php echo $comment['date']; ?>]</small></h3>
   		 <div class="comment_wrrap">
        	<p><?php echo $comment['text']; ?></p>
    		
    	</div>
		<?php endforeach ?>
	</div>
   </div>
		
	<div id="new_comment_wrraper">
			<h3>Add new comment</h3>
			<div>
				<form>
					<input type="hidden" id="post_id" value="<?php echo $post['id']; ?>">
					<div class="ui-widget" id="info">
						<div style="padding: 0 .7em;">
						<p><span class="ui-icon ui-icon-notice" style="float: left; margin-right: .3em;"></span>
						<strong></strong></p>
						</div>
					</div>
					<p>
						<label class="author_label">Your name:</label>
							<input type="text" id="author" />
						
					</p>
					<div id="post_description">
						<textarea id="comment"  onfocus="this.value=''; setbg('#EFEFEF');" onblur="setbg('white')" style="font: 13px Trebuchet MS">Add a new comment...</textarea>
					</div>
					<button id="button">Add comment</button>
				</form>
			</div>
	</div>-->
</div> 
</div>