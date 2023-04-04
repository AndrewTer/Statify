<div class="block-search-and-sort p-0 m-0">
  <table class="table table-borderless m-0">
    <tbody>
        <tr class="friends-sort-list-item first-item letter-spacing-05" data-href="friends?sort=all-friends">
          <th scope="row">
            Все друзья
            <span id="friends-count">
              <? 
                $friends_all = all_friends_count($user_uuid);
                echo ($friends_all > 0) ? $friends_all : '';
              ?>  
            </span>
          </th>
        </tr>

        <tr class="friends-sort-list-item letter-spacing-05" data-href="friends?sort=online">
          <th scope="row">
            Друзья онлайн
          </th>
        </tr>

        <tr class="friends-sort-list-item letter-spacing-05" data-href="friends?sort=subscribers">
          <th scope="row">
            Подписчики
            <span id="friends-count">
              <?
                $subscribers_all = all_subscribers_count($user_uuid);
                echo ($subscribers_all > 0) ? $subscribers_all : '';
              ?>
            </span>
          </th>
        </tr>

        <tr class="friends-sort-list-item letter-spacing-05" data-href="friends?sort=subscriptions">
          <th scope="row">
            Подписки
            <span id="friends-count">
              <?
                $subscriptions_all = all_subscriptions_count($user_uuid);
                echo ($subscriptions_all > 0) ? $subscriptions_all : '';
              ?>
            </span>
          </th>
        </tr>
        
        <tr class="friends-sort-list-item last-item collapsed letter-spacing-05" id="show-all-requests" data-toggle="collapse" role="button" href="#friendshipRequestsOptions" aria-expanded="false" aria-controls="friendshipRequestsOptions">
          <th scope="row">
            Заявки в друзья 
            
            <svg class="m-0 mb-1" fill="var(--main-text-color)" width="14px" height="14px" viewBox="-1 0 19 19" xmlns="http://www.w3.org/2000/svg">
              <path d="M8.5 15.313a1.026 1.026 0 0 1-.728-.302l-6.8-6.8a1.03 1.03 0 0 1 1.455-1.456L8.5 12.828l6.073-6.073a1.03 1.03 0 0 1 1.455 1.456l-6.8 6.8a1.026 1.026 0 0 1-.728.302z"></path>
            </svg>

            <span id="friends-count">
              <?
                $sort_requests_rec = all_requests_count($user_uuid, 'receiver');
                echo ($sort_requests_rec > 0) ? $sort_requests_rec : '';
              ?>
            </span>
          </th>
        </tr>
    </tbody>
  </table>

  <div id="friendshipRequestsOptions" class="collapse pl-2">
    <table class="table table-borderless m-0">
      <tbody>
        <tr class="friendships-list-item" data-href="friends?sort=received">
          <th scope="row">
            Полученные
            <span id="friends-count">
              <?
                $sort_requests_rec = all_requests_count($user_uuid, 'receiver');
                echo ($sort_requests_rec > 0) ? $sort_requests_rec : '';
              ?>
            </span>
          </th>
        </tr>
        <tr class="friendships-list-item" data-href="friends?sort=submitted">
          <th scope="row">
            Отправленные
            <span id="friends-count">
              <?
                $sort_requests_auth = all_requests_count($user_uuid, 'author');
                echo ($sort_requests_auth > 0) ? $sort_requests_auth : '';
              ?>
            </span>
          </th>
        </tr>
      </tbody>
    </table>
  </div>
</div>