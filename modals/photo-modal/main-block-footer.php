<div class="modal-footer --show p-2" id="footer-modal">
	<div class="m-0 p-0 w-100 d-flex flex-row align-items-center" id="footer-content">
<?
	include("btn-comments.php");

	if ($current_user_uuid != $user_uuid)
	{
		if ($type != 1 && (user_friendly_status($user_uuid, $current_user_uuid) == 'friend' || !check_only_friends_can_rate_photos($user_uuid))) include("btn-rating.php");

		include("btn-save.php");
	}else
	{
		include("btn-statistics.php");
?>
		<div class="w-40 m-0"></div>
<?
	}
?>   	      		
	</div>
</div>

<div class="modal-footer --hide p-2" id="footer-for-rating">
<?
	include("block-footer-for-rating.php");
?>
</div>