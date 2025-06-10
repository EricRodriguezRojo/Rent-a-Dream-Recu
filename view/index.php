<?php
session_start();
require_once "../controller/functions.php";
if (!isset($_SESSION["activeUser"])) {
  $_SESSION["activeUser"] = [
    "email" => null,
    "name" => null,
    "dni" => null,
    "password" => null,
    "rol" => null
  ];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rent a Dream</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body>
    <div>
        <nav>
            <div id="nav1">
              <a class="logo-img" href=""><img src="img/Rent-a-dream-logo-only.png" width="110rem" alt=""></a>
            </div>
            <div id="nav2" class="display-nav2">
                <a href="index.php">HOME</a>
                <span>|</span>
                <a href="chicas.php">CHICAS</a>
                <span>|</span>
                <a href="chicos.php">CHICOS</a>
                <span>|</span>
                <a href="exotico.php">EXOTICO</a>
            </div>
            <div style="display: flex;">
                <div class="usuario-template">
                    <div
                      tabindex="0"
                      class="usuario-popup usuario-button"
                      style="padding:0 0.225rem  0; border-top-right-radius: 1.2rem;
                      border-bottom-right-radius: 1.2rem;"
                    >
                      <div class="usuario-popup-header">
                        <div>
                          <p
                          style="letter-spacing: 1px; font-weight: 600;   padding-left: 0.625rem;"
                        >
                          <?php printUserName(); ?>
                        </p>
                        <p
                          style="letter-spacing: 1px; font-weight: 600;   padding-left: 0.625rem;font-size: 0.5rem;"
                        >
                          <?php printRol(); ?>
                        </p>  
                        </div>
                  
                        <svg height="32" width="32" viewBox="0 0 1024 1024" class="usuario-icon">
                          <path
                            fill="#FFCE8B"
                            d="M1021.103385 510.551692A510.551692 510.551692 0 1 1 510.551692 0a510.551692 510.551692 0 0 1 510.551693 510.551692"
                          ></path>
                          <path
                            fill="#644646"
                            d="M809.99026 493.192935v315.26567H494.979866a317.052601 317.052601 0 0 1-66.626996-7.147724V493.192935z"
                          ></path>
                          <path
                            d="M494.979866 808.458605h-66.626996v-7.147724a317.052601 317.052601 0 0 0 66.626996 7.147724"
                          ></path>
                          <path
                            fill="#644646"
                            d="M809.99026 493.192935H428.35287v308.117946A315.010394 315.010394 0 0 1 178.693092 493.192935a310.670705 310.670705 0 0 1 21.953723-115.639958A314.755118 314.755118 0 0 1 494.979866 178.693092a308.373222 308.373222 0 0 1 82.96465 11.232138 313.989291 313.989291 0 0 1 232.045744 304.033532"
                          ></path>
                          <path
                            fill="#C7F4F1"
                            d="M758.935091 959.581906a510.551692 510.551692 0 0 1-512.338624-9.18993 268.55019 268.55019 0 0 1 512.338624 9.18993"
                          ></path>
                          <path
                            fill="#F7BEA9"
                            d="M581.263102 727.02561v86.793788a68.924478 68.924478 0 0 1-137.593681 0v-91.133477a184.309161 184.309161 0 0 0 74.285271 15.571826 178.693092 178.693092 0 0 0 63.30841-11.232137"
                          ></path>
                          <path
                            fill="#FBD1BB"
                            d="M700.987474 390.572045v163.121266a195.796574 195.796574 0 0 1-119.724372 183.798609 172.566472 172.566472 0 0 1-137.593681-4.850241 197.072953 197.072953 0 0 1-108.747511-178.693093v-163.376541a189.92523 189.92523 0 0 1 183.032782-195.796574 176.39561 176.39561 0 0 1 129.424854 57.437065 201.667919 201.667919 0 0 1 53.607928 138.359509"
                          ></path>
                          <path
                            fill="#FBD1BB"
                            d="M370.405253 553.182759a43.396894 43.396894 0 1 1-43.396894-41.099411 42.37579 42.37579 0 0 1 43.396894 41.099411"
                          ></path>
                          <path
                            fill="#F49F83"
                            d="M605.769583 590.963584v2.042207a70.966685 70.966685 0 1 1-141.93337 0v-2.042207"
                          ></path>
                          <path
                            fill="#030303"
                            d="M499.064279 517.699416a18.890413 18.890413 0 1 1-18.890412-18.890412 18.890413 18.890413 0 0 1 18.890412 18.890412M619.043927 517.699416a18.890413 18.890413 0 1 1-18.890412-18.890412 18.890413 18.890413 0 0 1 18.890412 18.890412"
                          ></path>
                          <path
                            fill="#644646"
                            d="M796.46064 401.038354a224.387469 224.387469 0 0 1-282.590362-28.590894 224.132193 224.132193 0 0 1-312.202359 5.105517A314.755118 314.755118 0 0 1 494.979866 178.693092a308.373222 308.373222 0 0 1 82.96465 11.232138 316.031498 316.031498 0 0 1 218.516124 211.878952"
                          ></path>
                        </svg>
                      </div>
                  
                      <div class="usuario-popup-main">
                        <ul class="usuario-list-box">
                          <li class="usuario-button usuario-item"><a href="userconfig.php">user config</a></li>
                          <form action="../controller/usercontroller.php" class="form" method="POST">
                            <li class="usuario-button usuario-item"><input type="submit" name="logout" value="logout" style="border: none;background: none;"></li>
                          </form>
                        </ul>
                      </div>
                    </div>
                  </div>
                  
                <a href="../view/login.html">
                    <button class="Btn">
                        <div class="sign"><svg viewBox="0 0 512 512">
                                <path
                                    d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z">
                                </path>
                            </svg></div>

            <div class="text">Login</div>
          </button>
        </a>
      </div>
    </nav>
    <nav>
      <div>
      </div>
      <div id="nav2" class="display-nav2-mobile">
        <a href="index.html">HOME</a>
        <span>|</span>
        <a href="chicas">CHICAS</a>
        <span>|</span>
        <a href="chicos">CHICOS</a>
        <span>|</span>
        <a href="exotico">EXOTICO</a>
      </div>
      <div>
      </div>
    </nav>
    <header>
      <div class="mainp">
        <div class="mainp-slogan">
          <h2 class="mainp-slogan-h2">TUS PAREJAS MÁS BELLAS</h2>
          <p class="mainp-slogan-txt">Parejas de confianza y de calidad</p>
          <p class="mainp-slogan-txt">
            ¿Buscas compañía para una ocasión especial o simplemente quieres compartir un momento agradable?
            Nuestra agencia te conecta con personas amables,
            respetuosas y que saben cómo hacerte sentir especial. Desde una cena elegante hasta un paseo por
            la ciudad,
            nuestros novios y novias de alquiler están disponibles para acompañarte en cualquier evento o
            situación.
          </p>
          <br>
          <div>
            <button class="button type1">
              <span class="btn-txt">saber más</span>
            </button>
          </div>
        </div>
        <div class="mainp-foto">
          <img src="img/Rent-a-dream-logo-only.png" alt="" width="100%">
        </div>
        <div class="mainp-ratings">
          <div class="card">
            <div class="stars">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                class="star">
                <path
                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                </path>
              </svg>

              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                class="star">
                <path
                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                </path>
              </svg>

              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                class="star">
                <path
                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                </path>
              </svg>

              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                class="star">
                <path
                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                </path>
              </svg>

              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                class="star">
                <path
                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                </path>
              </svg>
            </div>

            <div class="infos">
              <p class="date-time">

              </p>
              <p class="description">
                "Alquilé a un novio para una boda a la que no quería ir sola, ¡y fue una experiencia increíble! Estaba nerviosa al principio, pero desde que nos conocimos, Javier fue muy profesional y divertido. Me hizo sentir cómoda, y hasta mis amigas pensaron que éramos pareja de verdad. Además, me ayudó a esquivar las preguntas incómodas de mis tías sobre por qué sigo soltera. ¡Definitivamente lo haría de nuevo!"
              </p>
            </div>

            <div class="author">
              — Maria
            </div>
          </div>
          <br>
        </div>
      </div>

    </header>
    <div class="carrousel-body">
      <div class="carrousel-container">
        <div>
          <div class="carrousel-content">
            <a href="trabajadores/perfil-chicas.php?id=1" style="margin:0; padding: 0;"><h2>Maria</h2></a>
            <span>Enthusiastic traveler and coffee lover</span>
          </div>
        </div>
        <div>
          <div class="carrousel-content">
            <a href="trabajadores/perfil.php?id=2" style="margin:0; padding: 0;"><h2>Carlos</h2></a>
            <span>Divertido y extrovertido</span>
          </div>
        </div>
        <div>
          <div class="carrousel-content">
            <a href="trabajadores/perfil-chicas.php?id=5" style="margin:0; padding: 0;"><h2>Daniela</h2></a>
            <span>Pintora</span>
          </div>
        </div>
        <div>
          <div class="carrousel-content">
            <a href="trabajadores/perfil.php?id=3" style="margin:0; padding: 0;"><h2>Andrés</h2></a>
            <span>Serio y profesional</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  </div>

</body>

</html>