<div class="block-search-and-sort p-0 m-0">
  <table class="table table-borderless m-0">
    <tbody>        
        <tr class="notifications-sort-list-item" id="read-all-notifications" onclick="readAllNotifications(<?= '\''.$user_uuid.'\''; ?>);">
          <th scope="row" class="m-0 d-flex flex-row justify-content-center align-items-center">
            <p class="m-0 p-0 mr-auto">Прочитать все уведомления</p>
            <i class="fa fa-check-circle-o menu-icon fz-20 ml-auto" aria-hidden="true"></i>
          </th>
        </tr>
    </tbody>
  </table>
</div>

<script type="text/javascript" src="js/notifications.js"></script>