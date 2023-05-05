<div class="block-search-and-sort p-0 m-0">
  <table class="table table-borderless m-0">
    <tbody>        
        <tr class="notifications-sort-list-item" id="read-all-notifications" onclick="readAllNotifications(<?= '\''.$user_uuid.'\''; ?>);">
          <th scope="row" class="m-0 d-flex flex-row justify-content-center align-items-center">
            <p class="m-0 p-0 mr-auto font-weight-bold fz-14">Прочитать все уведомления</p>
            <p class="m-0 p-0 ml-auto">
              <svg class="svg-main-menu-icon" width="20px" height="20px" viewBox="0 0 20 20" fill="none">
                <path fill-rule="evenodd" d="M3 10a7 7 0 019.307-6.611 1 1 0 00.658-1.889 9 9 0 105.98 7.501 1 1 0 00-1.988.22A7 7 0 113 10zm14.75-5.338a1 1 0 00-1.5-1.324l-6.435 7.28-3.183-2.593a1 1 0 00-1.264 1.55l3.929 3.2a1 1 0 001.38-.113l7.072-8z"></path>
              </svg>
            </p>
          </th>
        </tr>
    </tbody>
  </table>
</div>

<script type="text/javascript" src="js/notifications.js"></script>