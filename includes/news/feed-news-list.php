<?
	$page = (isset($_GET['page'])) ? intval($_GET['page']) : 1;
	$num = 20;

	$feed_news_array = get_current_user_feed_news_list($page, $num);
	$total_count_feed_pages = $feed_news_array[0]['total_count_feed_pages'];

	if ($feed_news_array && count($feed_news_array) > 0)
	{
?>
<div class="m-0 p-0 feed-news-list d-flex flex-column align-items-center">
<?
		for ($feed_news_array_num = 0; $feed_news_array_num < count($feed_news_array); $feed_news_array_num++)
		{
			$feed_news_user_uuid = $feed_news_array[$feed_news_array_num]['user_uuid'];
			$feed_news_photo = $feed_news_array[$feed_news_array_num]['photos'];
			$feed_news_photo_uuid = get_photo_uuid_by_name($feed_news_photo);
			$feed_news_creation_date = $feed_news_array[$feed_news_array_num]['creation_date'];
		
			$user_avatar_preview_check = file_exists('../../users/'.$feed_news_user_uuid.'/'.get_user_avatar_preview($feed_news_user_uuid)) ? 1 : 0;
			$photo_tags_array = get_current_photo_tags($feed_news_photo_uuid);

			$feed_comments_list = get_comments_list($feed_news_photo_uuid);
			$feed_comments_list_count = ($feed_comments_list) ? rounding_number_by_places(count($feed_comments_list)) : 0;
?>

  
	  <div class="m-0 mb-3 feed-news-card w-87"> 
	    <div class="m-0 p-0 pt-3 pl-3 pr-3 w-100 feed-news-card-info d-flex flex-row align-items-center">
	      <a class="m-0 p-0 d-flex flex-row align-items-center pointer" href="./?u=<?= get_user_nickname($feed_news_user_uuid); ?>">
<?
          if (!is_null(check_user_online_status($feed_news_user_uuid)))
            if (get_user_avatar($feed_news_user_uuid))
              echo '<img class="m-0 mr-3 p-0 online"
                          src="users/'.$feed_news_user_uuid.'/'.($user_avatar_preview_check == 1 ? get_user_avatar_preview($feed_news_user_uuid) : get_user_avatar($feed_news_user_uuid)).'" 
                          alt="'.get_user_fullname($feed_news_user_uuid).'">';
            else
              echo '<img class="m-0 mr-3 p-0 online" src="imgs/no-avatar.png" alt="'.get_user_fullname($feed_news_user_uuid).'">';
          else
            if (get_user_avatar($feed_news_user_uuid))
              echo '<img class="m-0 mr-3 p-0 offline"
                          src="users/'.$feed_news_user_uuid.'/'.($user_avatar_preview_check == 1 ? get_user_avatar_preview($feed_news_user_uuid) : get_user_avatar($feed_news_user_uuid)).'" 
                          alt="'.get_user_fullname($feed_news_user_uuid).'">';
            else
              echo '<img class="m-0 mr-3 p-0 offline" src="imgs/no-avatar.png" alt="'.get_user_fullname($feed_news_user_uuid).'">';
?>
				</a>

	      <div class="w-100 m-0 p-0 d-flex flex-column">
	        <a class="m-0 mr-auto p-0 pointer" href="./?u=<?= get_user_nickname($feed_news_user_uuid); ?>">
	        	<p class="m-0 p-0 fz-16 font-weight-bold"><?= get_user_fullname($feed_news_user_uuid); ?></p>
	        </a>
	        <div class="w-100 m-0 p-0 d-flex flex-row">
	          <a class="m-0 p-0 pointer" href="./?u=<?= get_user_nickname($feed_news_user_uuid); ?>">
	          	<p class="m-0 mr-auto p-0 fz-13" style="font-style: italic;">@<?= get_user_nickname($feed_news_user_uuid); ?></p>
	          </a>

	          	<div class="m-0 ml-auto p-0 d-flex flex-row align-items-center">
				      	<p class="m-0 ml-3 p-0 d-flex flex-row align-items-center justify-content-center pointer" data-toggle="tooltip" data-placement="bottom" title="Всего оценок: <?= number_format(get_current_photo_ratings_count($feed_news_photo_uuid), 0, ',', '.'); ?> ">
						      <svg class="m-0 p-0" width="20px" height="20px" viewBox="0 0 24 24" fill="none">
						        <path d="M11.0748 3.25583C11.4141 2.42845 12.5859 2.42845 12.9252 3.25583L14.6493 7.45955C14.793 7.80979 15.1221 8.04889 15.4995 8.07727L20.0303 8.41798C20.922 8.48504 21.2841 9.59942 20.6021 10.1778L17.1369 13.1166C16.8482 13.3614 16.7225 13.7483 16.8122 14.1161L17.8882 18.5304C18.1 19.3992 17.152 20.0879 16.3912 19.618L12.5255 17.2305C12.2034 17.0316 11.7966 17.0316 11.4745 17.2305L7.60881 19.618C6.84796 20.0879 5.90001 19.3992 6.1118 18.5304L7.18785 14.1161C7.2775 13.7483 7.1518 13.3614 6.86309 13.1166L3.3979 10.1778C2.71588 9.59942 3.07796 8.48504 3.96971 8.41798L8.50046 8.07727C8.87794 8.04889 9.20704 7.80979 9.35068 7.45955L11.0748 3.25583Z" stroke="var(--main-text-color)" stroke-width="2"></path>
						      </svg>
						      <span class="fz-13 m-0 ml-2 p-0 font-weight-bold"><?= rounding_number_by_places(get_current_photo_ratings_count($feed_news_photo_uuid)); ?></span>
						    </p>

						    <a class="m-0 ml-3 p-0 d-flex flex-row align-items-center justify-content-center" href="<?= 'comments?p='.preg_replace('[-]', '', $feed_news_photo_uuid); ?>" data-toggle="tooltip" data-placement="bottom" title="Комментарии: <?= ($feed_comments_list_count) > 0 ? number_format($feed_comments_list_count, 0, ',', '.') : 0; ?>">
									<p class="m-0">
										<svg class="m-0 p-0" fill="var(--main-text-color)" width="20px" height="20px" viewBox="0 -3.5 31 31">
											<path d="m12 2.182c-.031 0-.068 0-.105 0-1.715 0-3.354.325-4.859.918l.09-.031c-1.425.526-2.633 1.347-3.599 2.394l-.006.006c-.809.847-1.314 1.99-1.338 3.251v.005c.013 1.015.35 1.948.912 2.705l-.009-.012c.675.923 1.522 1.678 2.5 2.229l.039.02 1.654.958-.597 1.432q.579-.341 1.057-.665l.75-.528.903.17c.783.15 1.684.237 2.606.24h.002.105c1.715 0 3.354-.325 4.859-.918l-.09.031c1.425-.526 2.633-1.347 3.599-2.394l.006-.006c.827-.836 1.338-1.986 1.338-3.256s-.511-2.42-1.338-3.256c-.972-1.053-2.18-1.874-3.542-2.379l-.063-.021c-1.421-.566-3.067-.895-4.79-.895-.03 0-.06 0-.09 0h.005zm0-2.182c.045 0 .098-.001.151-.001 2.119 0 4.138.429 5.974 1.206l-.101-.038c1.751.703 3.22 1.789 4.358 3.161l.014.018c.996 1.174 1.602 2.706 1.602 4.38s-.606 3.207-1.61 4.39l.008-.01c-1.152 1.389-2.621 2.475-4.299 3.152l-.073.026c-1.736.739-3.756 1.169-5.875 1.169-.053 0-.105 0-.157-.001h.008c-1.062-.003-2.099-.102-3.106-.289l.106.016c-1.352.964-2.934 1.714-4.64 2.158l-.1.022c-.389.1-.886.195-1.391.264l-.074.008h-.051c-.135-.002-.257-.053-.35-.136-.105-.088-.177-.213-.196-.355v-.003c-.011-.032-.017-.069-.017-.107 0-.001 0-.002 0-.004 0-.001 0-.001 0-.002 0-.038.003-.076.009-.113l-.001.004c.007-.038.019-.073.035-.104l-.001.002.042-.086.06-.094.068-.086.08-.086.068-.08q.086-.102.392-.426t.443-.503.383-.494c.152-.191.293-.406.415-.633l.011-.023q.179-.341.35-.75c-1.342-.759-2.454-1.773-3.303-2.985l-.021-.032c-.753-1.063-1.207-2.384-1.214-3.811v-.002c.008-1.673.611-3.203 1.609-4.391l-.009.011c1.152-1.389 2.621-2.475 4.299-3.152l.073-.026c1.736-.739 3.756-1.169 5.875-1.169.054 0 .107 0 .161.001h-.008zm14.01 19.925q.17.409.35.75c.133.25.274.465.433.665l-.007-.009q.247.315.383.494t.443.503q.306.32.392.426.017.017.068.08t.08.086c.024.026.046.054.066.083l.002.002c.02.027.04.058.058.09l.002.004.042.086.034.102.009.11-.017.11c-.029.152-.108.282-.22.374l-.001.001c-.089.075-.205.121-.331.121-.015 0-.031-.001-.046-.002h.002c-2.356-.314-4.462-1.187-6.243-2.482l.039.027c-.901.171-1.938.27-2.998.273h-.002c-.099.002-.216.004-.334.004-2.863 0-5.53-.84-7.767-2.287l.056.034q.989.068 1.5.068h.067c1.855 0 3.644-.28 5.327-.801l-.128.034c1.716-.516 3.212-1.266 4.544-2.229l-.044.03c1.336-.962 2.431-2.169 3.24-3.563l.029-.055c.718-1.244 1.142-2.736 1.142-4.327 0-.926-.143-1.818-.409-2.655l.017.062c1.401.751 2.564 1.773 3.457 3.004l.02.029c.799 1.084 1.278 2.446 1.278 3.921 0 1.433-.453 2.76-1.224 3.846l.014-.021c-.872 1.24-1.984 2.251-3.275 2.983l-.05.026z"></path>
										</svg>
									</p>
									<p class="m-0 ml-2 fz-13 font-weight-bold"><?= ($feed_comments_list_count) > 0 ? rounding_number_by_places($feed_comments_list_count) : ''; ?></p>
								</a>
							</div>

	        </div>
	      </div> 
	      
	    </div>

	    <div class="w-100 m-0 p-3">
		    <img class="w-100 pointer m-0 p-0"
		          src="<?= 'users/'.$feed_news_user_uuid.'/'.$feed_news_photo; ?>" 
		          alt="<?= get_user_fullname($feed_news_user_uuid); ?>"
		          onclick="event.preventDefault();openProfilePictureModal(<?= '\''.$user_uuid.'\',\''.$feed_news_user_uuid.'\',\''.$feed_news_photo.'\''; ?>);">
<?
				if (!is_null($photo_tags_array))
				{
					echo '<ul class="feed-news-tags-list tags-list p-2 m-0 d-flex flex-wrap align-items-center position-absolute border-radius-15">';

					$photo_tags_count = (count($photo_tags_array) > 3) ? 3 : count($photo_tags_array);

					for ($tags_num = 0; $tags_num < $photo_tags_count; $tags_num++)
						echo '<a href="search?p=tags&q='.$photo_tags_array[$tags_num].'"><li class="font-weight-bold text-white">#'.$photo_tags_array[$tags_num].'</li></a>';

					echo '<p class="m-0 ml-auto p-0">
									<a class="m-0 p-0" href="comments?p='.preg_replace('[-]', '', $feed_news_photo_uuid).'">
							      <svg class="m-0 p-0" width="15px" height="15px" viewBox="-4.5 0 20 20" fill="var(--text-border-color)">
							        <g transform="translate(-305.000000, -6679.000000)" fill="var(--text-border-color)"> 
							          <g transform="translate(56.000000, 160.000000)"> 
							            <path d="M249.365851,6538.70769 L249.365851,6538.70769 C249.770764,6539.09744 250.426289,6539.09744 250.830166,6538.70769 L259.393407,6530.44413 C260.202198,6529.66364 260.202198,6528.39747 259.393407,6527.61699 L250.768031,6519.29246 C250.367261,6518.90671 249.720021,6518.90172 249.314072,6519.28247 L249.314072,6519.28247 C248.899839,6519.67121 248.894661,6520.31179 249.302681,6520.70653 L257.196934,6528.32352 C257.601847,6528.71426 257.601847,6529.34685 257.196934,6529.73759 L249.365851,6537.29462 C248.960938,6537.68437 248.960938,6538.31795 249.365851,6538.70769"></path>
							          </g>
							        </g>
							      </svg>
							     </a>
						    </p>';

					echo '</ul>';
				}
?>
		  </div>
  	</div>
<?
		}
?>
</div>
<?
	}else
		echo '<span class="d-flex justify-content-center p-5 w-100"><strong class="h5 text-center">Ваша лента пустая</strong></span>';
?>

<div class="w-100 d-flex justify-content-center">
<?
  if ($page < $total_count_feed_pages)
    echo '<a data-page="'.$page.'" data-max="'.$total_count_feed_pages.'" id="showmore-feed-button" href="#" class="m-0 p-0 fz-14 text-center show-more-btn">Показать еще</a>';
?>
</div>
<script type="text/javascript" src="js/news.js"></script>