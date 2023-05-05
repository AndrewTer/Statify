<?
$search_tag_text = strtolower(str_replace(' ', '_', preg_replace('/[^-_a-zа-яё\d]/ui', '', trim($search_text))));
$search_result_photos_list = get_search_result_of_photos_list_by_tag($search_tag_text, $page, $num);

if ($search_result_photos_list)
{
	$total_count_search_pages = $search_result_photos_list[0]['total_count_search_pages'];
	echo '<div class="w-100 m-0 p-0 block-search-and-sort d-flex flex-column">';
		echo '<p class="w-100 m-0 fz-15" style="padding: 8px 13px 0 13px !important;">Тег:<span class="m-0 ml-2 p-0 fz-15 font-weight-bold">'.$search_tag_text.'</span></p>';
		echo '<hr class="hr-user-info w-100 mb-0">';
		echo '<div class="w-100 m-0 p-0 d-flex justify-content-start" id="block-search-all-photos-by-tag">
						<div class="m-0 p-2 w-100 d-flex flex-wrap user-photo-cards-list">';

		for ($search_photos_by_tag_num = 0; $search_photos_by_tag_num < count($search_result_photos_list); $search_photos_by_tag_num++)
			echo '<div class="user-photo-card">
							<div class="mx-auto d-block user-photo-card-content">
								<img class="offline border-radius-15 pointer" 
											src="users/'.$search_result_photos_list[$search_photos_by_tag_num]['user_uuid'].'/'.$search_result_photos_list[$search_photos_by_tag_num]['photo_name'].'" 
											alt="'.get_user_fullname($search_result_photos_list[$search_photos_by_tag_num]['user_uuid']).'" 
											onclick="event.preventDefault();openProfilePictureModal(\''.$user_uuid.'\',\''.$search_result_photos_list[$search_photos_by_tag_num]['user_uuid'].'\',\''.$search_result_photos_list[$search_photos_by_tag_num]['photo_name'].'\');">
							</div>
						</div>';

		echo '</div></div>';
	echo '</div>';
}else
	echo '<span class="d-flex justify-content-center p-5 w-100 text-center"><strong class="h5" id="search-notification">Поиск не дал результатов</strong></span>';
?>