<?
	define('mystatify', true);

	$result = '';
	
	if (!empty($_POST['current_user']) && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['current_user'])))
	{

	  require_once("../includes/connection.php");
	  include("../functions/functions.php");
	  include("../functions/database-functions.php");
	  include("../functions/functions-news.php");
	  include("../functions/functions-for-check.php");
	  include("../functions/functions-user-data.php");
	  include("../functions/functions-modals.php");

	  $user_uuid = $_POST['current_user'];
		$photos_sorted_by_number_of_comments_list = get_most_commented_photos_list(9, 91);

		if ($photos_sorted_by_number_of_comments_list)
		{
			$result .= '<div class="m-0 p-0 justify-content-center grid-with-no-large-item">';

			for ($photos_sorted_by_number_of_comments_num = 0; $photos_sorted_by_number_of_comments_num < count($photos_sorted_by_number_of_comments_list); $photos_sorted_by_number_of_comments_num++)
		  {
				$photo_user_uuid = $photos_sorted_by_number_of_comments_list[$photos_sorted_by_number_of_comments_num][1];
				$photo_user_name = get_user_fullname($photo_user_uuid);
				$photo_name = get_photo_name_by_uuid($photos_sorted_by_number_of_comments_list[$photos_sorted_by_number_of_comments_num][0]);

				$result .= '<div class="popular-picture-card m-1 grid-item position-relative">
					<div class="m-0 p-0">
						<img class="offline w-100 border-radius-10" src="users/'.$photo_user_uuid.'/'.$photo_name.'" alt="'.$photo_user_name.'" onclick="event.preventDefault();openProfilePictureModal(\''.$user_uuid.'\',\''.$photo_user_uuid.'\',\''.$photo_name.'\');">
					</div>
				</div>';
	  	}
			$result .= '</div>';
		}

	}

	echo $result;
?>