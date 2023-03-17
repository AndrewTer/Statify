<div class="main-menu m-0 p-0">
    <a class="w-100 m-0 p-0 pt-2 pb-2 d-flex flex-row align-items-center font-weight-bold" data-href="./" aria-label="Профиль">
        <p class="fz-13 m-0 p-0 pt-1 pb-1 icon-main-menu text-center"><i class="fa fa-user-o" aria-hidden="true"></i></p>
        <p class="fz-13 w-100 m-0 ml-2 p-0 pt-1 pb-1 text-left">Профиль</p>
    </a>

    <a class="w-100 m-0 p-0 pt-2 pb-2 d-flex flex-row align-items-center font-weight-bold" data-href="news?sort=popular" aria-label="Новости">
        <p class="fz-13 m-0 p-0 pt-1 pb-1 icon-main-menu text-center"><i class="fa fa-newspaper-o" aria-hidden="true"></i></p>
        <p class="fz-13 w-100 m-0 ml-2 p-0 pt-1 pb-1 text-left">Новости</p>
    </a>

    <a class="w-100 m-0 p-0 pt-2 pb-2 d-flex flex-row align-items-center font-weight-bold" data-href="friends?sort=all-friends" aria-label="Друзья">
        <p class="fz-13 m-0 p-0 pt-1 pb-1 icon-main-menu text-center"><i class="fa fa-users" aria-hidden="true"></i></p>
        <p class="fz-13 w-100 m-0 ml-2 p-0 pt-1 pb-1 text-left">Друзья</p>
    </a>

    <a class="w-100 m-0 p-0 pt-2 pb-2 d-flex flex-row align-items-center font-weight-bold" data-href="search" aria-label="Поиск">
        <p class="fz-13 m-0 p-0 pt-1 pb-1 icon-main-menu text-center"><i class="fa fa-search" aria-hidden="true"></i></p>
        <p class="fz-13 w-100 m-0 ml-2 p-0 pt-1 pb-1 text-left">Поиск</p>
    </a>

    <div class="w-100 m-0 p-0 pt-2 pb-2 d-flex flex-row font-weight-bold">
        <p class="fz-13 m-0 p-0 icon-main-menu"></p>
        <hr class="ml-2 p-0 hr-user-info" style="width: 60% !important;">
    </div>

    <a class="w-100 m-0 p-0 pt-2 pb-2 d-flex flex-row align-items-center font-weight-bold" data-href="rate" aria-label="Оценить">
        <p class="fz-13 m-0 p-0 pt-1 pb-1 icon-main-menu text-center"><i class="fa fa-star-o" aria-hidden="true"></i></p>
        <p class="fz-13 w-100 m-0 ml-2 p-0 pt-1 pb-1 text-left">Оценить</p>
    </a>
</div>

<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('*[data-href]').on('click', function() {
        window.location = $(this).data("href");
    });
});
</script>
