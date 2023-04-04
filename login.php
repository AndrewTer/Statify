<?php
  include("functions/functions.php");
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Авторизация на сайте Statify! Оценивайте других пользователей, просматривайте свою статистику, оставляйте комментарии, добавляйте друзей!">
    <meta name="Keywords" content="сервис, оценка, оценивание, просмотр статистики, фотографии, рейтинг, авторизация, регистрация">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main/main.css">
    <link rel="stylesheet" type="text/css" href="css/main/svg.css">
    <link rel="stylesheet" type="text/css" href="css/main/header-footer.css">
    <link rel="stylesheet" type="text/css" href="css/main/menu.css">
    <link rel="stylesheet" type="text/css" href="css/main/login.css">
    <link rel="stylesheet" type="text/css" href="css/main/modals.css">
    <link rel="stylesheet" type="text/css" href="css/main/animation.css">
    <link rel="stylesheet" type="text/css" href="css/main/adaptive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <noscript>
      <meta http-equiv="refresh" content="0; url=noscript">
    </noscript>

    <title>Statify</title>
  </head>
  <body>

    <div class="row main-header fixed-top"><? include("includes/header/header-login.php"); ?></div>

    <div class="container-fluid main-body p-0 d-flex align-items-center">
      <div class="w-100 h-100 text-white d-flex justify-content-center align-items-center" id="login-container">
        <div class="row w-100 d-flex flex-row align-self-stretch" id="login-content">

          <div class="p-5 h-100 d-flex justify-content-center align-items-center" id="content-info-section">
            <section class="w-100 m-0 p-3 d-flex flex-column align-items-center" id="content-info">
              <img width="130" src="imgs/logo.png">
              <p class="w-100 text-center m-0 mt-3 p-0 fz-14 font-weight-bold letter-spacing-05">Сервис для оценивания фотографий людей</p>

              <div class="w-100 m-0 mt-2 p-5">
                <div class="m-0 p-0 d-flex flex-row align-items-center">
                  <p class="m-0 p-0">
                    <svg fill="url('#login-photo-share-icon')" width="23px" height="23px" viewBox="0 0 31.06 32.001" xml:space="preserve">
                      <defs>  
                        <linearGradient id="login-photo-share-icon" x1="50%" y1="0%" x2="50%" y2="100%"> 
                          <stop offset="0%" stop-color="#7A5FFF">
                            <animate attributeName="stop-color" values="#7A5FFF; #01FF89; #7A5FFF" dur="4s" repeatCount="indefinite"></animate>
                          </stop>
                          <stop offset="100%" stop-color="#01FF89">
                            <animate attributeName="stop-color" values="#01FF89; #7A5FFF; #01FF89" dur="4s" repeatCount="indefinite"></animate>
                          </stop>
                        </linearGradient> 
                      </defs>
                      <path d="M29.341,11.405L13.213,7.383c-1.21-0.301-2.447,0.441-2.748,1.652L6.443,25.163c-0.303,1.211,0.44,2.445,1.65,2.748 l16.127,4.023c1.21,0.301,2.447-0.443,2.748-1.652l4.023-16.127C31.293,12.944,30.551,11.708,29.341,11.405z M28.609,14.338 l-2.926,11.731c-0.1,0.402-0.513,0.65-0.915,0.549l-14.662-3.656c-0.403-0.1-0.651-0.512-0.551-0.916l2.926-11.729 c0.1-0.404,0.513-0.65,0.916-0.551l14.661,3.658C28.462,13.522,28.71,13.936,28.609,14.338z"></path>
                      <circle cx="15.926" cy="13.832" r="2.052"></circle>
                      <path d="M22.253,16.813c-0.136-0.418-0.505-0.51-0.82-0.205l-2.943,2.842c-0.315,0.303-0.759,0.244-0.985-0.133l-0.471-0.781 c-0.227-0.377-0.719-0.5-1.095-0.273l-4.782,2.852c-0.377,0.225-0.329,0.469,0.096,0.576l3.099,0.771 c0.426,0.107,1.122,0.281,1.549,0.389l3.661,0.912c0.426,0.105,1.123,0.279,1.549,0.385l3.098,0.773 c0.426,0.107,0.657-0.121,0.521-0.539L22.253,16.813z"></path>
                      <path d="M2.971,7.978l14.098-5.439c0.388-0.149,0.828,0.045,0.977,0.432l1.506,3.933l2.686,0.67l-2.348-6.122 c-0.449-1.163-1.768-1.748-2.931-1.299L1.45,6.133C0.287,6.583-0.298,7.902,0.151,9.065L5.156,22.06l0.954-3.827L2.537,8.954 C2.389,8.565,2.583,8.126,2.971,7.978z"></path>
                    </svg>
                  </p>
                  <p class="m-0 ml-4 p-0 fz-14">Делитесь своими фотографиями</p>
                </div>

                <div class="m-0 mt-3 p-0 d-flex flex-row align-items-center">
                  <p class="m-0 p-0">
                    <svg fill="url('#login-rate-icon')" width="23px" height="23px" viewBox="0 0 279.092 279.092" xml:space="preserve">
                      <defs>  
                        <linearGradient id="login-rate-icon" x1="50%" y1="0%" x2="50%" y2="100%"> 
                          <stop offset="0%" stop-color="#7A5FFF">
                            <animate attributeName="stop-color" values="#7A5FFF; #01FF89; #7A5FFF" dur="4s" repeatCount="indefinite"></animate>
                          </stop>
                          <stop offset="100%" stop-color="#01FF89">
                            <animate attributeName="stop-color" values="#01FF89; #7A5FFF; #01FF89" dur="4s" repeatCount="indefinite"></animate>
                          </stop>
                        </linearGradient> 
                      </defs>
                      <path d="M11.958,120.628l-0.042,0.579c-0.133,3.689,1.036,7.024,3.307,9.376c3.355,3.484,8.746,4.335,13.74,2.083l14.127-7.67 l13.64,7.438l0.483,0.238c1.888,0.852,3.794,1.286,5.677,1.286c3.111,0,5.974-1.195,8.067-3.37 c2.271-2.352,3.442-5.682,3.302-9.376l-1.874-16.069l10.356-10.646l0.574-0.665c2.735-3.599,3.542-7.871,2.217-11.729 c-1.318-3.857-4.579-6.732-8.944-7.895L60.564,71.6l-6.726-13.534l-0.415-0.724c-2.518-3.864-6.366-6.072-10.553-6.072 c-3.953,0-7.688,2.016-10.256,5.538l-8.454,14.783l-13.959,2.341l-0.784,0.177c-4.32,1.237-7.533,4.158-8.823,8.018 c-1.286,3.867-0.462,8.13,2.252,11.709l10.935,11.306L11.958,120.628z M33.259,84.589l9.474-16.664l8.272,16.65l18.484,2.968 l-12.148,12.482l2.074,17.539l-16.335-8.898l-16.33,8.894l2.075-17.534L16.527,87.394L33.259,84.589z"></path>
                      <path d="M179.709,93.827c2.735-3.598,3.543-7.871,2.217-11.729c-1.325-3.857-4.583-6.732-8.946-7.894l-16.022-2.609l-6.726-13.535 l-0.415-0.723c-2.521-3.864-6.366-6.074-10.552-6.074c-3.953,0-7.689,2.019-10.256,5.54l-8.455,14.783l-13.959,2.34l-0.784,0.177 c-4.319,1.237-7.533,4.156-8.816,8.018c-1.291,3.867-0.469,8.13,2.25,11.71l10.935,11.306l-1.829,15.495l-0.044,0.574 c-0.138,3.689,1.039,7.024,3.302,9.381c3.356,3.484,8.742,4.336,13.74,2.084l14.123-7.67l13.637,7.437l0.485,0.238 c1.886,0.852,3.795,1.286,5.676,1.286c3.112,0,5.974-1.195,8.069-3.37c2.268-2.352,3.439-5.682,3.3-9.376l-1.872-16.066 l10.361-10.648L179.709,93.827z M153.733,100.025l2.076,17.539l-16.334-8.898l-16.325,8.894l2.07-17.534l-12.295-12.632 l16.731-2.81l9.472-16.664l8.272,16.65l18.482,2.968L153.733,100.025z"></path>
                      <path d="M269.523,74.2l-16.026-2.609l-6.721-13.534l-0.411-0.724c-2.521-3.859-6.366-6.074-10.552-6.074 c-3.953,0-7.691,2.019-10.259,5.54l-8.452,14.783l-13.959,2.34l-0.784,0.178c-4.321,1.237-7.532,4.156-8.82,8.018 c-1.288,3.867-0.467,8.13,2.254,11.709l10.935,11.306l-1.834,15.495l-0.042,0.579c-0.131,3.689,1.036,7.024,3.31,9.376 c3.355,3.484,8.741,4.335,13.739,2.083l14.127-7.67l13.638,7.438l0.485,0.238c1.886,0.852,3.794,1.286,5.675,1.286 c3.113,0,5.975-1.195,8.069-3.37c2.269-2.352,3.44-5.682,3.3-9.376l-1.871-16.066l10.355-10.648l0.574-0.665 c2.73-3.599,3.543-7.871,2.217-11.729C277.149,78.242,273.886,75.359,269.523,74.2z M250.281,100.025l2.076,17.539l-16.334-8.898 l-16.33,8.894l2.067-17.534l-12.293-12.632l16.727-2.81l9.474-16.664l8.275,16.65l18.481,2.968L250.281,100.025z"></path>
                      <path d="M86.457,145.142c-3.953,0-7.691,2.021-10.256,5.535l-8.459,14.785l-13.959,2.343l-0.784,0.178 c-4.322,1.241-7.538,4.163-8.823,8.027s-0.46,8.13,2.261,11.705l10.93,11.299l-1.832,15.5l-0.042,0.573 c-0.14,3.692,1.036,7.024,3.302,9.376c3.36,3.482,8.746,4.341,13.75,2.082l14.118-7.668l13.64,7.435l0.474,0.233 c1.885,0.858,3.799,1.288,5.687,1.288c3.11,0,5.974-1.194,8.062-3.365c2.268-2.352,3.44-5.68,3.302-9.376l-1.874-16.073 l10.361-10.65l0.569-0.653c2.733-3.604,3.545-7.869,2.226-11.724c-1.318-3.859-4.583-6.739-8.951-7.901l-16.024-2.618 l-6.723-13.53l-0.415-0.728C94.484,147.354,90.643,145.142,86.457,145.142z M113.071,181.433l-12.148,12.48l2.074,17.538 l-16.33-8.895l-16.33,8.886l2.07-17.529l-12.293-12.634l16.727-2.81l9.472-16.667l8.272,16.652L113.071,181.433z"></path>
                      <path d="M225.792,168.09l-16.022-2.618l-6.725-13.53l-0.416-0.728c-2.52-3.86-6.365-6.072-10.552-6.072 c-3.953,0-7.687,2.021-10.249,5.535l-8.462,14.785l-13.959,2.343l-0.784,0.178c-4.321,1.241-7.537,4.163-8.82,8.027 c-1.288,3.859-0.467,8.13,2.254,11.705l10.931,11.299l-1.83,15.5l-0.042,0.578c-0.135,3.688,1.036,7.024,3.305,9.376 c3.36,3.486,8.746,4.336,13.744,2.077l14.118-7.668l13.646,7.435l0.472,0.233c1.885,0.858,3.799,1.288,5.689,1.288 c3.107,0,5.974-1.194,8.06-3.365c2.269-2.352,3.439-5.68,3.304-9.376l-1.876-16.073l10.356-10.65l0.569-0.653 c2.735-3.604,3.547-7.873,2.227-11.733C233.414,172.127,230.156,169.252,225.792,168.09z M206.55,193.913l2.072,17.538 l-16.335-8.895l-16.33,8.886l2.067-17.529l-12.288-12.634l16.727-2.81l9.47-16.667l8.274,16.652l18.481,2.974L206.55,193.913z"></path>
                    </svg>
                  </p>
                  <p class="m-0 ml-4 p-0 fz-14">Оценивайте фотографии других пользователей</p>
                </div>

                <div class="m-0 mt-3 p-0 d-flex flex-row align-items-center">
                  <p class="m-0 p-0">
                    <svg class="m-0 p-0" width="23px" height="23px" viewBox="0 0 256 256" fill="url('#login-saves-icon')">
                      <defs>  
                        <linearGradient id="login-saves-icon" x1="50%" y1="0%" x2="50%" y2="100%"> 
                          <stop offset="0%" stop-color="#7A5FFF">
                            <animate attributeName="stop-color" values="#7A5FFF; #01FF89; #7A5FFF" dur="4s" repeatCount="indefinite"></animate>
                          </stop>
                          <stop offset="100%" stop-color="#01FF89">
                            <animate attributeName="stop-color" values="#01FF89; #7A5FFF; #01FF89" dur="4s" repeatCount="indefinite"></animate>
                          </stop>
                        </linearGradient> 
                      </defs>
                      <path d="M192,24H96A16.01833,16.01833,0,0,0,80,40V56H64A16.01833,16.01833,0,0,0,48,72V224a8.00026,8.00026,0,0,0,12.65039,6.50977l51.34277-36.67872,51.35743,36.67872A7.99952,7.99952,0,0,0,176,224V184.6897l19.35059,13.82007A7.99952,7.99952,0,0,0,208,192V40A16.01833,16.01833,0,0,0,192,24Zm0,152.45508-16-11.42676V72a16.01833,16.01833,0,0,0-16-16H96V40h96Z"></path>
                    </svg>
                  </p>
                  <p class="m-0 ml-4 p-0 fz-14">Сохраняйте понравившиеся фотографии</p>
                </div>

                <div class="m-0 mt-3 p-0 d-flex flex-row align-items-center">
                  <p class="m-0 p-0">
                    <svg class="m-0 p-0" width="23px" height="23px" viewBox="0 0 24 24" fill="none">
                      <defs>  
                        <linearGradient id="login-rating-icon" x1="50%" y1="0%" x2="50%" y2="100%"> 
                          <stop offset="0%" stop-color="#7A5FFF">
                            <animate attributeName="stop-color" values="#7A5FFF; #01FF89; #7A5FFF" dur="4s" repeatCount="indefinite"></animate>
                          </stop>
                          <stop offset="100%" stop-color="#01FF89">
                            <animate attributeName="stop-color" values="#01FF89; #7A5FFF; #01FF89" dur="4s" repeatCount="indefinite"></animate>
                          </stop>
                        </linearGradient> 
                      </defs>
                      <path d="M11.0748 3.25583C11.4141 2.42845 12.5859 2.42845 12.9252 3.25583L14.6493 7.45955C14.793 7.80979 15.1221 8.04889 15.4995 8.07727L20.0303 8.41798C20.922 8.48504 21.2841 9.59942 20.6021 10.1778L17.1369 13.1166C16.8482 13.3614 16.7225 13.7483 16.8122 14.1161L17.8882 18.5304C18.1 19.3992 17.152 20.0879 16.3912 19.618L12.5255 17.2305C12.2034 17.0316 11.7966 17.0316 11.4745 17.2305L7.60881 19.618C6.84796 20.0879 5.90001 19.3992 6.1118 18.5304L7.18785 14.1161C7.2775 13.7483 7.1518 13.3614 6.86309 13.1166L3.3979 10.1778C2.71588 9.59942 3.07796 8.48504 3.96971 8.41798L8.50046 8.07727C8.87794 8.04889 9.20704 7.80979 9.35068 7.45955L11.0748 3.25583Z" stroke-width="2" stroke="url('#login-rating-icon')"></path>
                    </svg>
                  </p>
                  <p class="m-0 ml-4 p-0 fz-14">Формируйте свой рейтинг</p>
                </div>

                <div class="m-0 mt-3 p-0 d-flex flex-row align-items-center">
                  <p class="m-0 p-0">
                    <svg class="m-0 p-0" fill="url('#login-comment-icon')" width="23px" height="23px" viewBox="796 796 200 200" enable-background="new 796 796 200 200" xml:space="preserve">
                      <defs>  
                        <linearGradient id="login-comment-icon" x1="50%" y1="0%" x2="50%" y2="100%"> 
                          <stop offset="0%" stop-color="#7A5FFF">
                            <animate attributeName="stop-color" values="#7A5FFF; #01FF89; #7A5FFF" dur="4s" repeatCount="indefinite"></animate>
                          </stop>
                          <stop offset="100%" stop-color="#01FF89">
                            <animate attributeName="stop-color" values="#01FF89; #7A5FFF; #01FF89" dur="4s" repeatCount="indefinite"></animate>
                          </stop>
                        </linearGradient> 
                      </defs>
                      <path d="M975.771,935.469c12.24-9.523,19.702-22.13,19.702-35.958c0-22.787-20.226-42.25-48.777-50.084 c-13.191-18.566-39.921-31.304-70.701-31.304c-43.818,0-79.467,25.793-79.467,57.498c0,14.631,7.523,28.544,21.183,39.173 c0.88,0.685,1.292,1.829,1.05,2.915l-5.043,22.702c-0.909,4.092,0.741,8.264,4.203,10.624c1.7,1.16,3.686,1.773,5.744,1.773 c2.032,0,3.996-0.6,5.684-1.733l27.088-18.205c0.434-0.292,0.912-0.496,1.404-0.654c14.028,12.803,36.061,21.074,60.878,21.074 c5.319,0,10.511-0.386,15.524-1.111c2.963-0.428,5.982,0.259,8.469,1.932l28.327,19.037c1.463,0.98,3.376,0.975,4.833-0.017 c1.454-0.995,2.161-2.774,1.777-4.495l-5.275-23.735C971.589,941.366,972.913,937.69,975.771,935.469z M826.62,938.285l3.987-17.945 c1.253-5.638-0.884-11.572-5.443-15.123c-10.642-8.28-16.501-18.791-16.501-29.597c0-25.013,30.204-45.362,67.331-45.362 c37.124,0,67.326,20.349,67.326,45.362c0,25.013-30.202,45.363-67.326,45.363c-4.675,0-9.378-0.337-13.978-1.002 c-4.312-0.619-8.735,0.389-12.351,2.816L826.62,938.285z"></path>
                    </svg>
                  </p>
                  <p class="m-0 ml-4 p-0 fz-14">Комментируйте</p>
                </div>

                <div class="m-0 mt-3 p-0 d-flex flex-row align-items-center">
                  <p class="m-0 p-0">
                    <svg class="m-0 p-0" width="23px" height="23px" viewBox="0 0 24 24" fill="none">
                      <defs>  
                        <linearGradient id="login-friends-icon" x1="50%" y1="0%" x2="50%" y2="100%"> 
                          <stop offset="0%" stop-color="#7A5FFF">
                            <animate attributeName="stop-color" values="#7A5FFF; #01FF89; #7A5FFF" dur="4s" repeatCount="indefinite"></animate>
                          </stop>
                          <stop offset="100%" stop-color="#01FF89">
                            <animate attributeName="stop-color" values="#01FF89; #7A5FFF; #01FF89" dur="4s" repeatCount="indefinite"></animate>
                          </stop>
                        </linearGradient> 
                      </defs>
                      <path d="M15.5385 11.4899C17.7949 11.4899 19.641 9.65316 19.641 7.40826C19.641 5.16336 17.7949 3.32663 15.5385 3.32663C15.4359 3.32663 15.3334 3.32663 15.2308 3.32663C15.8462 4.34704 16.2564 5.57153 16.2564 6.79602C16.2564 8.53071 15.5385 10.1634 14.4103 11.3879C14.718 11.4899 15.1282 11.4899 15.5385 11.4899Z" fill="url('#login-friends-icon')"></path>
                      <path d="M17.2821 13.6326H16.2565C17.7949 14.9591 18.8206 17 18.8206 19.2448C18.8206 19.7551 18.718 20.1632 18.6154 20.5714C19.9488 20.3673 20.7693 20.0612 21.2821 19.7551C21.7949 19.4489 22.0001 18.9387 22.0001 18.3265C22.0001 15.7755 19.8462 13.6326 17.2821 13.6326Z" fill="url('#login-friends-icon')"></path>
                      <path d="M9.38459 11.4898C10.6154 11.4898 11.641 11.0817 12.5641 10.2654C13.5897 9.44903 14.1025 8.1225 14.1025 6.79597C14.1025 5.77556 13.7948 4.75515 13.1795 4.04087C12.3589 2.81638 11.0256 2.00005 9.38459 2.00005C6.82049 2.00005 4.66664 4.14291 4.66664 6.69393C4.66664 9.34699 6.82049 11.4898 9.38459 11.4898Z" fill="url('#login-friends-icon')"></path>
                      <path d="M12.1538 13.9389C11.8462 13.9389 11.641 13.8369 11.3333 13.8369H7.4359C4.46154 13.8369 2 16.2859 2 19.245C2 19.9593 2.30769 20.4695 2.82051 20.8777C3.64103 21.3879 5.58974 22.0001 9.38461 22.0001C13.1795 22.0001 15.0256 21.3879 15.9487 20.8777C15.9487 20.8777 16.0513 20.7757 16.1538 20.7757C16.5641 20.4695 16.8718 19.9593 16.8718 19.245C16.7692 16.592 14.8205 14.3471 12.1538 13.9389Z" fill="url('#login-friends-icon')"></path>
                    </svg>
                  </p>
                  <p class="m-0 ml-4 p-0 fz-15">Добавляйте новых друзей</p>
                </div>
              </div>

            </section>
          </div>

          <div class="p-1 pl-3 pr-3" id="logreg-section">
            <div class="m-0 p-0 h-100 d-flex flex-column justify-content-center align-items-center">
              <div class="m-0 p-3" id="log-section">
                <h2 class="fz-25 text-white p-2">Авторизация</h2>

                <form name="loginform" class="login-form m-0 mt-4" action="" method="POST" onSubmit="return loginValidation();">      
                  <div class="form-group m-0 mb-4">
                    <!--<label class="fz-15 font-weight-bold">Email</label>-->
                    <input type="email" id="email-login" name="loginEmail" class="form-control" placeholder="Email" autocomplete="off">
                    <em class="m-0 p-0" id="email-login-message"></em>             
                  </div>

                  <div class="form-group m-0 mb-4">
                    <!--<label class="fz-15 font-weight-bold">Пароль</label>-->
                    <input type="password" id="password-login" name="loginPassword" class="form-control" placeholder="Пароль">
                    <em id="password-login-message"></em>
                  </div>
                        
                  <input type="submit" class="btn btn-standard w-100 m-0 fz-15" name="login" value="Войти">

                  <div class="text-center mt-2">
                    <a class="fz-15 font-weight-bold letter-spacing-05 text-white pe-auto recovery-link" onclick="event.preventDefault();openRecoveryPasswordModal();">Забыли пароль?</a>
                  </div>
                </form>
              </div>

              <hr class="hr-user-info w-75 mt-4 mb-4">

              <div class="m-0 p-3" id="reg-section">
                <h2 class="fz-25 text-white p-2">Регистрация</h2>

                <form name="regform" action="" method="POST" onSubmit="return regValidation();">
                    <div class="form-group m-0">
                      <div class="input-group mt-2">
                        <input type="email" name="regEmail" id="email-reg" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                          <button type="button" class="btn btn-standard m-0 border-0" onClick="return emailCheck();">
                            <svg width="18px" height="18px" viewBox="0 0 48 48" fill="#ffffff">
                              <path d="M0 0h48v48H0z" fill="none"></path>
                              <path d="M42.371,8.8C41.705,8.304,40.89,8,40,8H8C7.11,8,6.295,8.304,5.629,8.8L24,27.172L42.371,8.8z"></path>
                              <path d="M4,12.828V36c0,2.2,1.8,4,4,4h32c2.2,0,4-1.8,4-4V12.828l-20,20L4,12.828z"></path>
                            </svg>
                          </button>
                        </div>
                      </div>
                      <em id="email-reg-message"></em>
                    </div>

                    <div id="full-reg-form" class="collapse m-0">
                      <div class="form-group m-0 mt-3 mb-2">
                        <label class="fz-13 font-weight-bold">Ваше имя</label>
                        <input type="text" name="regUsername" id="username-reg" class="form-control">
                        <em id="username-reg-message"></em>
                      </div>
                      
                      <div class="form-group m-0 mb-2">
                        <label class="fz-13 font-weight-bold">Ваша фамилия</label>
                        <input type="text" name="regUsersurname" id="usersurname-reg" class="form-control">
                        <em id="usersurname-reg-message"></em>
                      </div>
                      
                      <div class="form-group m-0 mb-2">
                        <label class="fz-13 font-weight-bold">Пароль</label>
                        <input type="password" name="regPassword" id="userpassword-reg" class="form-control" placeholder="*******">
                        <em id="userpassword-reg-message"></em>
                      </div>
                      
                      <div class="form-group m-0 mb-4">
                        <label class="fz-13 font-weight-bold">Подтвердить пароль</label>
                        <input type="password" name="regConfirm" id="userconfirm-reg" class="form-control" placeholder="*******">
                        <em id="userconfirm-reg-message"></em>
                      </div>
                      
                      <div class="form-group m-0 mb-4 p-0">
                        <p class="m-0 fz-13 text-center">Создавая аккаунт, я соглашаюсь с <a id="login-link" href="about?sort=rules" target="_blank">правилами сайта</a> и даю согласие на <a id="login-link" href="about?sort=consent" target="_blank">обработку персональных данных</a>.</p>
                      </div>
                      
                      <input type="submit" class="btn btn-success w-100 m-0 fz-15" id="reg-btn" name="registration" value="Зарегистрироваться">
                    </div> 
                </form>
              </div>
            </div>
          </div>
    
        </div>
      </div>
    </div>

    <div class="row main-footer w-100"><? include("includes/footer.php"); ?></div>
  </body>

  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="js/login.js"></script>
</html>