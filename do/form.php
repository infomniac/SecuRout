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

class form {
    public function login() {
        ?>
            <div class="container">

                <form method="post" action="?tryconnect" class="form-signin">
                    <h2 class="form-signin-heading">Sortez vivant !</h2>
                    <label for="inputEmail" class="sr-only">Courriel</label>
                    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Courriel" required autofocus>
                    <label for="inputPassword" class="sr-only">Mot de passe</label>
                    <input type="password" name="pwd" id="inputPassword" class="form-control" placeholder="Mot de passe" required>
                    <div class="checkbox">
                    <label>
                      <input type="checkbox" value="remember-me"> Rester connecté
                    </label>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">S'enregistrer / Se connecter</button>
                </form>

            </div> <!-- /container -->
        <?PHP
    }
    
    public function register($email, $pwd) {
        ?>
            <div class="container">

                <form method="post" action="?register" class="form-signin">
                    <h2 class="form-signin-heading">Sortez vivant ! - On s'enregistre</h2>
                    <label for="inputEmail" class="sr-only">Courriel</label>
                    <input type="email" name="email" value="<?PHP echo $email; ?>" id="inputEmail" class="form-control" placeholder="Courriel" required autofocus>
                    <label for="inputPassword" class="sr-only">Mot de passe</label>
                    <input type="password" name="pwd" value="<?PHP echo $pwd; ?>" id="inputPassword" class="form-control" placeholder="Mot de passe" required>
                    <input type="password" name="pwdc" id="inputPassword" class="form-control" placeholder="Confirmez votre mot de passe" required>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Finaliser le compte</button>
                </form>

            </div> <!-- /container -->
        <?PHP
    }
    
    public function finishAcct($data) {
        ?>
            <div class="container">

                <form method="post" class="form-signin">
                    <h2 class="form-signin-heading">Sortez vivant ! - On complète ses informations</h2>
                    <label for="inputEmail" class="sr-only">Pseudo</label>
                    <input type="text" name="pseudo" value="<?PHP echo $data['Pseudo']; ?>" id="inputText" class="form-control" placeholder="Pseudo" required autofocus>
                    <label for="inputPassword" class="sr-only">Prénom</label>
                    <input type="text" name="prenom" value="<?PHP echo $data['Prenom']; ?>" id="inputText" class="form-control" placeholder="Prénom" required>
                    <label for="inputPassword" class="sr-only">Nom</label>
                    <input type="text" name="nom" value="<?PHP echo $data['Nom']; ?>" id="inputText" class="form-control" placeholder="Nom" required>
                    <label for="inputPassword" class="sr-only">Date de naissance</label>
                    <input type="date" name="date" value="<?PHP echo $data['DateNaissance']; ?>" id="inputText" class="form-control" placeholder="Date de naissance" required>
                    <label for="inputPassword" class="sr-only">Courriel</label>
                    <input type="text" value="<?PHP echo $data['AdresseMail']; ?>" id="inputText" class="form-control" placeholder="Courriel" disabled>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Compléter les informations</button>
                </form>

            </div> <!-- /container -->
        <?PHP
    }
    
    public function manageEvent() {
        ?>
            
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="#">Navigation</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <main role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-3">Hello, world!</h1>
          <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
          <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>
        </div>
      </div>

      <div class="container">
        <!-- Example row of columns -->
        <div class="row">
          <div class="col-md-4">
            <h2>Heading</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
          </div>
          <div class="col-md-4">
            <h2>Heading</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
          </div>
          <div class="col-md-4">
            <h2>Heading</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
          </div>
        </div>

        <hr>

      </div> <!-- /container -->

    </main>

    <footer class="container">
      <p>&copy; Company 2017</p>
    </footer>
            
        <?PHP
    }
}