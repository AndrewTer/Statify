<?
$search_top_tags_array = get_top_tags(10);

if (!is_null($search_top_tags_array))
{
	echo '<div class="w-100 m-0 mb-3 p-2 d-flex flex-wrap justify-content-start block-search-and-sort">';

	for ($search_top_tags_num = 0; $search_top_tags_num < count($search_top_tags_array); $search_top_tags_num++)
	{
		$search_tag_text = $search_top_tags_array[$search_top_tags_num]['tag_text'];
		$search_result_photos_list = get_photos_list_by_tag($search_tag_text);
		$search_result_photos_list_max_count = (count($search_result_photos_list) > 3) ? 3 : count($search_result_photos_list);

		echo '<div class="border-radius-15 m-0 p-0 top-tags-card d-flex flex-column">
						<div class="top-tags-cover-card m-0 p-0">';

			for ($search_photos_by_tag_num = 0; $search_photos_by_tag_num < $search_result_photos_list_max_count; $search_photos_by_tag_num++)
			{
				echo '<div class="mx-auto d-block top-tags-card-photo-content">
								<a class="m-0 p-0" href="search?p=tags&q='.$search_tag_text.'">
									<img class="border-none pointer" 
												src="users/'.$search_result_photos_list[$search_photos_by_tag_num]['user_uuid'].'/'.$search_result_photos_list[$search_photos_by_tag_num]['photo_name'].'" 
												alt="'.get_user_fullname($search_result_photos_list[$search_photos_by_tag_num]['user_uuid']).'">
								</a>
							</div>';
			}

			if ($search_result_photos_list_max_count < 3)
			{
				$search_photos_by_tag_num_max = 3 - $search_result_photos_list_max_count;
				for ($search_photos_by_tag_num = 0; $search_photos_by_tag_num < $search_photos_by_tag_num_max; $search_photos_by_tag_num++)
					echo '<div class="mx-auto d-block top-tags-card-photo-content">
									<a class="m-0 p-0" href="search?p=tags&q='.$search_tag_text.'">
										<p class="border-none pointer top-tags-photo-empty"></p>
									</a>
								</div>';
			}

			echo '</div>';

			echo '<div class="w-100 m-0 p-0 pt-2 pl-2 pr-2 top-tags-card-description">
							<a class="w-100 m-0 p-0 d-flex flex-column justify-content-center align-items-start" href="search?p=tags&q='.$search_tag_text.'">
								<p class="w-100 m-0 p-0 font-weight-bold main-text text-break">#'.cut_string_to_N_character($search_tag_text, 15).'</p>
								<p class="m-0 p-0 font-weight-bold d-flex flex-row align-items-center">
									<svg width="17px" height="17px" viewBox="0 0 24 24" fill="none">
										<path d="M3 9C3 7.89543 3.89543 7 5 7H6.5C7.12951 7 7.72229 6.70361 8.1 6.2L9.15 4.8C9.52771 4.29639 10.1205 4 10.75 4H13.25C13.8795 4 14.4723 4.29639 14.85 4.8L15.9 6.2C16.2777 6.70361 16.8705 7 17.5 7H19C20.1046 7 21 7.89543 21 9V18C21 19.1046 20.1046 20 19 20H5C3.89543 20 3 19.1046 3 18V9Z" stroke="var(--main-text-color)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
										<circle cx="12" cy="13" r="4" stroke="var(--main-text-color)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></circle>
									</svg>
									<span class="m-0 ml-1 p-0 font-weight-bold">'.rounding_number_by_places(count($search_result_photos_list)).'</span>
								</p>
							</a>
						</div>';
		echo '</div>';
	}

	echo '</div>';
}else
	echo '<span class="d-flex justify-content-center p-5 w-100 text-center"><strong class="h5" id="search-notification">Список тегов пуст</strong></span>';
?>