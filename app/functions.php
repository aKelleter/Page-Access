<?php

// ----------------------------------------------------------------------------
// FUNCTIONS
// ----------------------------------------------------------------------------

/**
 * Affiche le formulaire d'identification
 * @param type $msg
 */
function displayPageForm($msg = null) {
    $app_title = APP_TITLE;
    $app_subtitle = APP_SUBTITLE;
    $app_version = APP_VERSION;
    $icon_github = ICON_GITHUB;
    $url_github_prj = URL_GITHUB_PRJ;
    echo <<<END
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="shortcut icon" href="assets/img/mesa.png">         
      <link href="vendors/bootstrap/css/bootstrap.min.css"  rel="stylesheet">
      <link href="assets/css/styles.css" rel="stylesheet">
      <title>$app_title</title>
    </head>
    <body>    
       <div class="container">
          <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-8">
                  <div class="mt-5 mb-5 border rounded p-4 text-center">
                    <h1 class="text-center"><span class="text-info">$app_title</span></h1> 
                    <p class="text-center"> | $app_subtitle |</p>
                    <div class="text-center">$msg</div>
                    <form class="mt-5 mb-5 row g-1" method="post" action="">
                        <div class="mb-3 row">
                            <label class="form-label" for="code">Please enter the identification code :</label>
                            <input class="form-control" type="password" id="code" name="code" required>
                        </div>
                        <div class="mb-1 row">
                            <input type="hidden" id="_form" name="_form" value="identifcation">
                            <button type="submit" class="btn btn-primary mb-3">Sign in</button>
                        </div>        
                    </form>
                  </div>
                  <footer class="text-center small">| $app_title | $app_version | <a href="$url_github_prj" target="_blank"><img class="pa_github" src="$icon_github" alt="Icon Github" title="Github repository"/></a></footer>
                 </div>
                 <div class="col-md-2"></div>
                </div>
               </div>
               <script src="vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
          </body>
        </html>
    END;
}

/**
 * Démarrage de la session
 * @return void
 */
function startSession() {
    /**
     * Si la session n'est pas démarrée
     */
    if (session_status() == PHP_SESSION_NONE) {    
        
        /**
         * Configurer les paramètres de cookie de session : Avant de démarrer la 
         * session, vous pouvez configurer les paramètres de cookie pour améliorer 
         * la sécurité :
         */        
        session_set_cookie_params([
        'lifetime' => 0, // Le cookie expire à la fermeture du navigateur
        'path' => '/',
        'domain' => SESSION_DOMAIN,
        'secure' => true, // Utiliser uniquement HTTPS
        'httponly' => true, // Empêche l'accès au cookie via JavaScript
        'samesite' => 'Strict' // Empêche l'envoi du cookie avec des requêtes cross-site
        ]);
        
        /**
         * Démarrer la session
         */
        session_start();        

        /**
         * Régénérer l'ID de session : Pour éviter les attaques de fixation de 
         * session, régénérez l'ID de session après l'authentification de 
         * l'utilisateur :
         */
        session_regenerate_id(true);
        
        /**
         * Définir des en-têtes de sécurité : Ajoutez des en-têtes HTTP pour 
         * renforcer la sécurité :
         */
        header('Content-Security-Policy: default-src \'self\'');
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: DENY');
        header('X-XSS-Protection: 1; mode=block');
    }
}

/**
 * Fermeture de la session
 * @return void 
 */
function closeSession() {
   
    // Détruire toutes les variables de session
    $_SESSION = array();

    // Si vous souhaitez détruire complètement la session, effacer également le cookie de session
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Finalement, détruire la session
    session_destroy();

    $_SESSION['access'] = false;
}

/**
 * Gestion des requêtes POST
 * @return string
 */
function handlePostRequest() {
    $msg = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $form = $_POST['_form'] ?? '';

        if ($form == 'identifcation') {
            $code = $_POST['code'] ?? '';

            if ($code != SECRET_CODE) {
                $msg = '<div class="alert alert-danger">Incorrect code. Please try again.</div>';
                displayPageForm($msg);
                die();
            } else {
                $_SESSION['access'] = true;
                $_SESSION['user_id'] = bin2hex(random_bytes(16));
            }
        } elseif ($form == 'signout') {
            closeSession();
        }
    }

    return $msg;
}