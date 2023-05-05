<div class="header-login w-100 container-fluid m-0 p-0 d-flex justify-content-center align-items-center">
  <div class="header-full w-100 row m-0 h-100">
    <div class="col-12 d-flex justify-content-center align-items-center header-logo">
      <a class="m-0 p-0" href="./">
        <img width="80" src="imgs/logo.png" alt="Statify">
      </a>
    </div>
  </div>
</div>

<div class="toast m-0 pl-2 pr-2" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
  <div class="toast-body fz-14"></div>
</div>

<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('*[data-href]').on('click', function() {
        window.location = $(this).data("href");
    });
});
</script>