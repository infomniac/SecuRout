<?php

/* 
 * Copyright (C) 2017 Guy-Jr.
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301  USA
 */

?>

<?PHP

    ini_set('display_errors', 1);

    session_start();
    require_once 'do/bdd.php';
    require_once 'do/form.php';
    require_once 'do/formEvent.php';
    $form = new form();
    $formev = new formEvent();
    $user = new pdo_class();
    
    

?>

<!doctype html>
<html lang="fr">
  <head>
    <title>Sortez vivant !</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGy_Q8g81qZKcwU7fznXUFS5-5JpJC0G0&callback=initMap">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="js/maps.js"></script>
    <script src="js/custom_form.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css" media="all"/>
  </head>
  <body>
    
    <?PHP
    
        if(isset($_SESSION['id']) && !empty($_SESSION['id']) && $_SESSION['id'] > 0) {
            if(isset($_GET['createevent'])) {
                $formev->AddEvent();
            }
            if(isset($_GET['manageevent'])) {
                $formev->ManageEvent($user->RetrieveOwnEvent($_SESSION['id']));
            }
            
            if(isset($_GET['edit-event']) && intval($_GET['edit-event']) > 0) {
                $formev->EditEvent(intval($_GET['edit-event']));
            }
            
            if(isset($_GET['uptraf']) && intval($_GET['ev']) > 0) {
                $user->UpdateTraffic(intval($_GET['ev']), $_POST['traffic']);
                header("Location:index.php");
            }
            
            if(isset($_GET['event']) && !empty($_GET['event'])) {
                if(intval($_GET['event']) > 0) {
                    $idevent = intval($_GET['event']);
                    $data = $user->getThreeEvent();
                    $form->manageEvent($data, $data[$idevent-1]['Titre'], $data[$idevent-1]['Description'], $user->RetrieveTraffic($idevent));
                }
            }
            if(isset($_GET['ajouter'])) {
                if(isset($_POST['titre']) && isset($_POST['adr']) && isset($_POST['ville']) && isset($_POST['cp'])) {
                    if(!empty($_POST['titre']) && !empty($_POST['adr']) && !empty($_POST['ville']) && !empty($_POST['cp'])) {
                        $user->CreateEvent($_POST['titre'], $_POST['adr']." ".$_POST['adrcompl'].", ".$_POST['cp']." ".$_POST['ville'], $_POST['desc']);
                        $user->JoinEvent($_SESSION['id'], $user->ReturnEventID(htmlspecialchars($_POST['titre'])), 1);
                    }
                }
            }
        }
    
        if(isset($_SESSION['id']) && !empty($_SESSION['id']) && $_SESSION['id'] > 0) {
            if(isset($_POST['pseudo']) && isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['date'])) {
                $data = array(htmlspecialchars($_POST['pseudo']), 
                              htmlspecialchars($_POST['prenom']), 
                              htmlspecialchars($_POST['nom']), 
                              htmlspecialchars($_POST['date']));
                $user->FillData($_SESSION['id'], $data);
                header('location:index.php');
            } else {
                
            }
        }
        
        if(isset($_SESSION['id']) && !empty($_SESSION['id']) && $_SESSION['id'] > 0) {
            switch ($user->IsComplete(intval($_SESSION['id']))) {
                case 1:
                    $data = $user->getCurrData(intval($_SESSION['id']));
                    $form->finishAcct($data);
                    break;
                case 0:
                    if(!isset($_GET['createevent']) && !isset($_GET['manageevent']) && !isset($_GET['edit-event']) && !isset($_GET['event'])) {
                        $form->manageEvent($user->getThreeEvent(), "Gestionnaire de soirée", "Bonne visite ! Bonne soirée !", " ");
                    }
                    break;
                case -1:
                    session_abort();
                    header("Location:index.php");
                    break;
                default:
                    session_abort();
                    header("Location:index.php");
                    break;
            }
        }
        
        if(isset($_GET['register'])) {
            if(isset($_POST['email']) && isset($_POST['pwd']) && isset($_POST['pwdc'])) {
                if(!empty($_POST['email']) && !empty($_POST['pwd']) && isset($_POST['pwdc'])) {
                    $pwd = htmlspecialchars($_POST['pwd']);
                    $pwdc = htmlspecialchars($_POST['pwdc']);
                    $email = htmlspecialchars($_POST['email']);

                    if($pwd == $pwdc) {
                        $user->createuser($email, $pwd);
                        $_SESSION['id'] = intval($user->connectme($email, $pwd));
                        header('location:index.php');
                    } else {
                        echo "Les mots de passes ne correspondent pas";
                        //$form->register($email, $pwd);
                    }            

                }
            }
        }
        
        if(isset($_GET['tryconnect'])) {
            if(isset($_POST['email']) && isset($_POST['pwd'])) {
                if(!empty($_POST['email']) && !empty($_POST['pwd'])) {
                    $pwd = htmlspecialchars($_POST['pwd']);
                    $email = htmlspecialchars($_POST['email']);

                    switch ($user->checkuser($email, $pwd)) {
                        case 0:
                            echo 'bad pwd';
                            $form->login(); 
                            break;
                        case 1:
                            $_SESSION['id'] = intval($user->connectme($email, $pwd));
                            header('location:index.php');
                            break;
                        case -1:
                            $form->register($email, $pwd);
                            break;
                        default:
                            $form->login(); 
                            break;
                    }
                }
            }
        }
        
        if(!isset($_SESSION['id']) && !isset($_GET['tryconnect']) && !isset($_GET['register']) && !isset($_GET['finishaccount'])) {
            $form->login();
        }
    ?>  

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </body>
</html>