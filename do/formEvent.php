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

class formEvent {
    public function AddEvent() {
        ?>
        <div class="Header">
            <div class="Logo">S</div>
            <div class="LogoTexte">
                ortez vivant !
            </div>
        
        </div>
        <div class="FormulaireCreateEvent">
        <form method="POST" action="?ajouter">
            <div class="form-group">
              <label for="inputAddress">Titre</label>
              <input type="text" name="titre" class="form-control" id="inputAddress" required placeholder="Ex : Super soirée">
            </div>
            <div class="form-group">
              <label for="inputAddress">Adresse</label>
              <input type="text" name="adr" class="form-control" id="inputAddress" required placeholder="Ex : 59 rue des chocolats">
            </div>
            <div class="form-group">
              <label for="inputAddress2">Complément d'adresse</label>
              <input type="text" name="adrcompl" class="form-control" id="inputAddress2" placeholder="Ex : Numéro d'appartement, étage, code de porte">
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputCity">Ville</label>
                <input type="text" name="ville" class="form-control" required id="inputCity">
              </div>
              <div class="form-group col-md-2">
                <label for="inputZip">Code Postal</label>
                <input type="text" name="cp" class="form-control" required id="inputZip">
              </div>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Description</label>
                <textarea class="form-control" name="desc" required id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Proposez cet événement</button>
        </form>
        </div>

        <?PHP
    }
    
    public function EditEvent($id) {
        ?>
            <form method="POST" action="?uptraf&ev=<?PHP echo $_GET['edit-event']; ?>">
                <div class="container1">
                    <button class="add_form_field">Add New Field &nbsp; <span style="font-size:16px; font-weight:bold;">+ </span></button>
                    <div><input type="text" name="traffic[]"></div>
                </div>
                <input type="submit" />
            </form>
            
        <?PHP
    }
    
    public function ManageEvent($event) {
        ?>
            <div class="Header">
            <div class="Logo">S</div>
            <div class="LogoTexte">
                ortez vivant !
            </div>
            <div id="listeEvent">
                <?PHP
                if(!isset($event)) {
                    echo "Pas d'événement proposé";
                } else {
                    echo '<ul>';
                    //var_dump(count($event));
                   for($i = 0; $i < count($event); $i++) {
                    ?>
                        
                <li><a href="?edit-event=<?PHP echo $event[$i]["ID"]; ?>" ><?PHP echo $event[$i]["Titre"]; ?></a></li>
                        
                    <?PHP
                    }
                    echo '</ul>';
                } 
                ?>
            </div>
        </div>
        <?PHP
    }
    
    
}