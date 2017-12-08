<?php/*  * Copyright (C) 2017 Guy-Jr. * * This library is free software; you can redistribute it and/or * modify it under the terms of the GNU Lesser General Public * License as published by the Free Software Foundation; either * version 2.1 of the License, or (at your option) any later version. * * This library is distributed in the hope that it will be useful, * but WITHOUT ANY WARRANTY; without even the implied warranty of * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU * Lesser General Public License for more details. * * You should have received a copy of the GNU Lesser General Public * License along with this library; if not, write to the Free Software * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, * MA 02110-1301  USA */class form {        public function login() {        ?>            <div class="container">                <form method="post" action="?tryconnect" class="form-signin">                    <h2 class="form-signin-heading">Sortez vivant!</h2>                    <label for="inputEmail" class="sr-only">Courriel</label>                    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Courriel" required autofocus>                    <label for="inputPassword" class="sr-only">Mot de passe</label>                    <input type="password" name="pwd" id="inputPassword" class="form-control" placeholder="Mot de passe" required>                    <div class="checkbox">                    <label>                      <input type="checkbox" value="remember-me"> Rester connecté                    </label>                    </div>                    <button class="btn btn-lg btn-primary btn-block" type="submit">S'enregistrer / Se connecter</button>                </form>            </div> <!-- /container -->        <?PHP    }        public function register($email, $pwd) {        ?>            <div class="container">                <form method="post" action="?register" class="form-signin">                    <h2 class="form-signin-heading">Sortez vivant ! - On s'enregistre</h2>                    <label for="inputEmail" class="sr-only">Courriel</label>                    <input type="email" name="email" value="<?PHP echo $email; ?>" id="inputEmail" class="form-control" placeholder="Courriel" required autofocus>                    <label for="inputPassword" class="sr-only">Mot de passe</label>                    <input type="password" name="pwd" value="<?PHP echo $pwd; ?>" id="inputPassword" class="form-control" placeholder="Mot de passe" required>                    <input type="password" name="pwdc" id="inputPassword" class="form-control" placeholder="Confirmez votre mot de passe" required>                    <button class="btn btn-lg btn-primary btn-block" type="submit">Finaliser le compte</button>                </form>            </div> <!-- /container -->        <?PHP    }        public function finishAcct($data) {        ?>            <div class="container">                <form method="post" class="form-signin">                    <h2 class="form-signin-heading">Sortez vivant ! - On complète ses informations</h2>                    <label for="inputEmail" class="sr-only">Pseudo</label>                    <input type="text" name="pseudo" value="<?PHP echo $data['Pseudo']; ?>" id="inputText" class="form-control" placeholder="Pseudo" required autofocus>                    <label for="inputPassword" class="sr-only">Prénom</label>                    <input type="text" name="prenom" value="<?PHP echo $data['Prenom']; ?>" id="inputText" class="form-control" placeholder="Prénom" required>                    <label for="inputPassword" class="sr-only">Nom</label>                    <input type="text" name="nom" value="<?PHP echo $data['Nom']; ?>" id="inputText" class="form-control" placeholder="Nom" required>                    <label for="inputPassword" class="sr-only">Date de naissance</label>                    <input type="date" name="date" value="<?PHP echo $data['DateNaissance']; ?>" id="inputText" class="form-control" placeholder="Date de naissance" required>                    <label for="inputPassword" class="sr-only">Courriel</label>                    <input type="text" value="<?PHP echo $data['AdresseMail']; ?>" id="inputText" class="form-control" placeholder="Courriel" disabled>                    <button class="btn btn-lg btn-primary btn-block" type="submit">Compléter les informations</button>                </form>            </div> <!-- /container -->        <?PHP    }    public function menuTitre($titre, $contenu) {        ?>            <div class="jumbotron">                <div class="container">                  <h1 class="display-4"><?PHP echo $titre; ?></h1>                  <p><?PHP echo $contenu; ?></p>                </div>          </div>        <?PHP    }        public function menuEvent() {        ?>            <div class="Header">                <div class="Logo">S</div>                <div class="LogoTexte">                    ortez vivant !                <ul id="menu">                <li>                    <a href="#">Gestion des évènements</a>                    <ul>                        <li><a href="?createevent">Organiser un événement</a></li>                        <li><a href="?manageevent">Gérer mes événements</a></li>                        <li><a href="?findevent">Participer à un événement</a></li>                    </ul>                </li>                        </ul>                </div>                            </div>        <?PHP    }        public function manageNearEvent($data) {        ?>        <div class="col-md-4">            <h2>Les évènements proches</h2>                        <!-- 3 lignes pour les 3 évènements -->            <?PHP            for($i = 0; $i < count($data); $i++) {                ?>                                <p><?PHP echo $data[$i]['Titre']; ?><br />                    Chez : <?PHP echo $data[$i]['Localisation']; ?><br />                    Information : <?PHP echo substr($data[$i]["Description"], 0, 50); ?>...                </p>                <p><a class="btn btn-secondary" href="?event=<?PHP echo $data[$i]['ID']; ?>" role="button">Voir +</a></p>                <?PHP            }            ?>          </div>            <?PHP    }        public function manageMap() {        ?>            <div class="col-md-4">            <h2>La map</h2>                        <div id="map"></div>            </div>            <?PHP    }        public function manageInfo($info) {        ?>            <div class="col-md-4">            <h2>Info Trafic</h2>            <p><?PHP echo $info; ?></p>          </div>            <?PHP    }        public function manageEvent($data, $titre, $contenu) {        $this->menuEvent();        $this->menuTitre($titre, $contenu);        ?>                <main role="main">      <!-- Main jumbotron for a primary marketing message or call to action -->      <div class="container">        <div class="row">            <?PHP              $this->manageNearEvent($data);              $this->manageMap();              $this->manageInfo("INFOS TRAJET");            ?>        </div>        <hr>     </div> <!-- /container -->    </main>    <footer class="container">      <p>&copy; Company 2017</p>    </footer>                    <?PHP    }        public function display() {        ?>                    <?PHP    }}