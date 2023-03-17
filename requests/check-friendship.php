<?
  // Проверка: не совпадают ли uuid пользователей
  if ($friendship_user_uuid != $user_uuid)
  {
    
    $friendly_status = user_friendly_status($user_uuid, $friendship_user_uuid);

    switch ($friendly_status) 
    {
      case 'user':
?>
        <input type="submit" class="btn btn-standard m-0 mb-3" value="Добавить в друзья" data-adduser = '<?= $user_uuid; ?>' data-addfriend = '<?= $friendship_user_uuid; ?>' onclick="event.preventDefault();goAddFriend(this);">
<?
      break;

      case 'friend':
?>
        <input type="submit" class="btn btn-red m-0 mb-3" value="Убрать из друзей" data-deluser = '<?= $user_uuid; ?>' data-delfriend = '<?= $friendship_user_uuid; ?>' onclick="event.preventDefault();goDelFriend(this);">
<?
      break;

      case 'submitter':
      case 'subscribed':
?>
        <input type="submit" class="btn btn-red m-0 mb-3" value="Отписаться" data-delrequser = '<?= $user_uuid; ?>' data-delreqfriend = '<?= $friendship_user_uuid; ?>' onclick="event.preventDefault();goDelRequest(this);">
<?
      break;

      default:
      break;
    }

  }
?>
 
<script type="text/javascript">
  function goAddFriend(identifier)
  {
    var add_user = $(identifier).data('adduser');
    var add_friend = $(identifier).data('addfriend');

    var addFriendFunc = new Function(addFriend(add_user, add_friend));
    addFriendFunc();
  }

  function goDelRequest(identifier)
  {
    var del_req_user = $(identifier).data('delrequser');
    var del_req_friend = $(identifier).data('delreqfriend');

    var delRequestFunc = new Function(delRequest(del_req_user, del_req_friend));
    delRequestFunc();
  }

  function goDelFriend(identifier)
  {
    var del_user = $(identifier).data('deluser');
    var del_friend = $(identifier).data('delfriend');

    var delFriendFunc = new Function(delFriend(del_user, del_friend));
    delFriendFunc();
  }
</script>
<script type="text/javascript" src="js/friendship.js"></script>