<?
	$comments_list = get_comments_list(get_photo_uuid_by_name($picture_name));
	$comments_list_count = ($comments_list) ? rounding_number_by_places(count($comments_list)) : 0;

	if ($ban_check == 'success')
	{
?>
		<div class="mr-auto m-0 p-1 h-100 current-photo-menu photo-menu-left d-flex align-items-center justify-content-center">
			<a class="nav-link w-100 m-0 p-0 text-center"
					href="<?= 'comments?p='.preg_replace('[-]', '', get_photo_uuid_by_name($picture_name)); ?>">
				<div class="nav-item m-0 p-0 d-flex flex-row justify-content-center align-items-center">
					<p class="fz-15 m-0 p-1">
						<i class="fa fa-comments-o fz-18 m-0 <?= ($comments_list_count) > 0 ? 'mr-2' : ''; ?>" aria-hidden="true"></i>
						<?= ($comments_list_count) > 0 ? $comments_list_count : ''; ?>
					</p>
				</div>
			</a>
		</div>
<?
	}
	else
		echo '<div class="mr-auto m-0 p-1 h-100 current-photo-menu photo-menu-left banned d-flex align-items-center justify-content-center">
						<div class="nav-item m-0 p-0 d-flex flex-row justify-content-center align-items-center">
							<i class="fa fa-comments-o fz-18 p-1 m-0" aria-hidden="true"></i>
						</div>
					</div>';
?>