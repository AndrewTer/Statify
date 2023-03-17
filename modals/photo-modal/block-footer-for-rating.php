<div class="mr-auto m-0 p-1 current-photo-menu photo-menu-rating-left d-flex align-items-center justify-content-center">
	<div class="nav-item w-100 m-0 p-0 d-flex flex-row justify-content-center align-items-center">
		<a class="nav-link w-100 m-0 p-0 text-center" onclick="displayPhotoMenuBlock();">
			<i class="fa fa-chevron-left fz-18 p-1 m-0" aria-hidden="true"></i>
		</a>
	</div>
</div>

<div class="m-0 p-1 text-center d-flex flex-row justify-content-center align-items-center photo-menu-rating-center">
	<div class="rating-area m-0 p-0 d-flex flex-row-reverse justify-content-center" id="rate-user">
		<input type="radio" class="rating-radio p-1" id="star-5" name="rating" value="5">
		<label for="star-5" class="fz-18 m-0 p-1 pl-2 pr-2" title="Оценка «5»"><i class="fa fa-star-o"></i></label>

		<input type="radio" class="rating-radio p-1 pl-2 pr-2" id="star-4" name="rating" value="4">
		<label for="star-4" class="fz-18 m-0 p-1 pl-2 pr-2" title="Оценка «4»"><i class="fa fa-star-o"></i></label>

		<input type="radio" class="rating-radio p-1 pl-2 pr-2" id="star-3" name="rating" value="3">
		<label for="star-3" class="fz-18 m-0 p-1 pl-2 pr-2" title="Оценка «3»"><i class="fa fa-star-o"></i></label>

		<input type="radio" class="rating-radio p-1 pl-2 pr-2" id="star-2" name="rating" value="2">
		<label for="star-2" class="fz-18 m-0 p-1 pl-2 pr-2" title="Оценка «2»"><i class="fa fa-star-o"></i></label>

		<input type="radio" class="rating-radio p-1" id="star-1" name="rating" value="1">
		<label for="star-1" class="fz-18 m-0 p-1 pl-2 pr-2" title="Оценка «1»"><i class="fa fa-star-o"></i></label>
	</div>
</div>

<div class="ml-auto m-0 p-1 current-photo-menu photo-menu-rating-right d-flex align-items-center justify-content-center">
	<div class="nav-item w-100 m-0 p-0 d-flex flex-row justify-content-center align-items-center">
		<a class="nav-link w-100 m-0 p-0 text-center rate-btn" id="rate-btn" onclick="event.preventDefault();addRatingOnPhoto(<?= '\''.$current_user_uuid.'\', \''.$user_uuid.'\', \''.$picture_name.'\''; ?>);">
			<i class="fa fa-check fz-18 p-1 m-0" aria-hidden="true"></i>
		</a>
	</div>
</div>