<?php include("requests/all-notifications-types-count.php"); ?>

<div class="block-search-and-sort p-0 m-0 mb-3">
  <table class="table table-borderless m-0">
    <tbody>        
        <tr class="notifications-sort-list-item" id="show-all-requests" data-href="notifications">
          <th scope="row">
            Уведомления
            <span class="notifications-count" id="notifications-count"><?= ($notifications_all_count > 0) ? $notifications_all_count : ''; ?></span>
          </th>
        </tr>
    </tbody>
  </table>

  <div class="pl-2">
    <table class="table table-borderless m-0">
      <tbody>
        <tr class="notifications-list-item" data-href="notifications?sort=requests">
          <th scope="row">
            Заявки в друзья
            <span class="notifications-count" id="notifications-count"><?= ($notifications_requests_count > 0) ? $notifications_requests_count : ''; ?></span>
          </th>
        </tr>
        <tr class="notifications-list-item" data-href="notifications?sort=comments">
          <th scope="row">
            Комментарии
            <span class="notifications-count" id="notifications-count"><?= ($notifications_comments_count > 0) ? $notifications_comments_count : ''; ?></span>
          </th>
        </tr>
      </tbody>
    </table>
  </div>
</div>