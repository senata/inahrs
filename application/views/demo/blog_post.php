<table class="table table-striped table-bordered">
	<tr>
		<th>Title: </th>
		<td><?php echo $post->title; ?></td>
	</tr>
	<tr>
		<th>Publish Time: </th>
		<td><?php echo $post->publish_time; ?></td>
	</tr>
	<tr>
		<th>Author: </th>
		<td><?php echo $post->author->first_name; ?> <?php echo $post->author->last_name; ?></td>
	</tr>
	<tr>
		<th>Category: </th>
		<td><?php echo $post->category->title; ?></td>
	</tr>
	<tr>
		<th>Tags: </th>
		<td>
			<?php foreach ($post->tags as $tag): ?>
				<span class="label label-primary"><?php echo $tag->title; ?></span>
			<?php endforeach; ?>
		</td>
	</tr>
</table>
	<div>
		<p>Content: </p><br/>
<?php echo $post->content; ?>
	</div>
<a class="btn btn-primary" href="demo/blog_posts">Back</a>