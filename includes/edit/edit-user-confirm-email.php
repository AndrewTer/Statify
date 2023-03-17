<p class="title-awards-info text-center mt-2 mb-2 fz-17">Подтверждение email</p>
<hr class="hr-user-info"> 
<div class="modal-body">
  <div class="form-group col-12 row m-0 p-0 mb-3">
    <label class="col-6 fz-13 font-weight-bold m-0 p-0 h-100">Текущий email</label>
    <p class="col-6 m-0 p-0 h-100 text-right" id="current-user-email"><?= get_user_email($user_uuid); ?></p>
  </div>
  <input type="submit" class="btn btn-standard w-100 m-0" onclick="event.preventDefault();getConfirmEmailCode();" value="Получить код">
  <div class="w-100 text-center m-0 mt-2 p-0" id="have-email-verification-code">
    <a class="fz-13 m-0 p-0 font-weight-bold" onclick="event.preventDefault();showComfirmCodeBlock();">Уже есть код</a>
  </div>
</div>
<div class="m-0 p-0" id="email-verification-code-block"></div>