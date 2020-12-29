<?php
	$total_pages = ceil($vdos['body']['total']/$vdos['body']['per_page']); 
	$page = $vdos['body']['page'];
	$result_per_page = $vdos['body']['per_page'];
?>
<div style="text-align: center;">
	<?php if ($total_pages > 1): ?>
		<ul class="pagination">
			<?php if ($page > 1): ?>
			<li class="prev"><a href="{{url()->current()}}?page=<?php echo $page-1 ?>">Prev</a></li>
			<?php endif; ?>

			<?php if ($page > 3): ?>
			<li class="start"><a href="{{url()->current()}}?page=1">1</a></li>
			<li class="dots">...</li>
			<?php endif; ?>

			<?php if ($page-2 > 0): ?><li class="page"><a href="{{url()->current()}}?page=<?php echo $page-2 ?>"><?php echo $page-2 ?></a></li><?php endif; ?>
			<?php if ($page-1 > 0): ?><li class="page"><a href="{{url()->current()}}?page=<?php echo $page-1 ?>"><?php echo $page-1 ?></a></li><?php endif; ?>

			<li class="currentpage"><a href="{{url()->current()}}?page=<?php echo $page ?>"><?php echo $page ?></a></li>

			<?php if ($page+1 < $total_pages+1): ?><li class="page"><a href="{{url()->current()}}?page=<?php echo $page+1 ?>"><?php echo $page+1 ?></a></li><?php endif; ?>
			<?php if ($page+2 < $total_pages+1): ?><li class="page"><a href="{{url()->current()}}?page=<?php echo $page+2 ?>"><?php echo $page+2 ?></a></li><?php endif; ?>

			<?php if ($page < $total_pages-2): ?>
			<li class="dots">...</li>
			<li class="end"><a href="{{url()->current()}}?page=<?php echo $total_pages ?>"><?php echo $total_pages ?></a></li>
			<?php endif; ?>

			<?php if ($page < $total_pages): ?>
			<li class="next"><a href="{{url()->current()}}?page=<?php echo $page+1 ?>">Next</a></li>
			<?php endif; ?>
		</ul>
	<?php endif; ?>
</div>