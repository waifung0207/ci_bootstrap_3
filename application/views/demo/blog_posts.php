<?php foreach ($posts as $post): ?>
	<table class="table table-striped table-bordered">
		<tr>
			<th>Title: </th>
			<td><a href="demo/blog_post/<?php echo $post->id; ?>"><?php echo $post->title; ?></a></td>
		</tr>
		<tr>
			<th>Content Brief: </th>
			<td><?php echo $post->content_brief; ?></td>
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
				<?php $count_tags = count($post->tags); ?>
				<?php for ($i=0; $i<$count_tags; $i++): ?>
					<?php echo ($i<$count_tags-1) ? $post->tags[$i]->title.',' : $post->tags[$i]->title; ?>
				<?php endfor; ?>
			</td>
		</tr>
	</table>
	<hr/>
<?php endforeach; ?>

<div class="row text-center">
	<div class="col col-md-12">
		<p>Results: <strong><?php echo $counts['from_num']; ?></strong> to <strong><?php echo $counts['to_num']; ?></strong> (total <strong><?php echo $counts['total_num']; ?></strong> results)</p>
		<?php echo $pagination; ?>
	</div>
</div>