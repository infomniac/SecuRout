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

class pdo_class {
    public $bdd;
    public function __construct() {
        try
        {
            $this->bdd = new PDO('mysql:host=localhost;dbname=c5_bdd1', 'c5_bdd', 'zZwgb2JX_2');
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }
    
    public function checkuser($email, $pwd) {
        $req = $this->bdd->prepare("SELECT AdresseMail, Password FROM UTILISATEUR WHERE AdresseMail =:email");
        $req->execute(array(
            "email" => $email
        ));
        
        $isexist = $req->fetch();
        
        if($isexist) {
            if(password_verify($pwd, $isexist['Password'])) {
                $req->closeCursor();
                return 1;
            } else {
                $req->closeCursor();
                return 0;
            }
        } else {
            $req->closeCursor();
            return -1;
        }
    }
    
    public function createuser($email, $pwd) {
        $req = $this->bdd->prepare("INSERT INTO UTILISATEUR (AdresseMail, Password) VALUES (:email, :pwd)");
        $req->execute(array(
            "email" => $email,
            "pwd" => password_hash($pwd, PASSWORD_BCRYPT)
        ));
        
    }
    
    public function connectme($email, $pwd) {
        $req = $this->bdd->prepare("SELECT ID, AdresseMail, Password FROM UTILISATEUR WHERE AdresseMail =:email");
        $req->execute(array(
            "email" => $email
        ));
        
        $isexist = $req->fetch();
        
        if($isexist) {
            if(password_verify($pwd, $isexist['Password'])) {
                $req->closeCursor();
                return $isexist['ID'];
            } else {
                $req->closeCursor();
                return 0;
            }
        } else {
            $req->closeCursor();
            return 0;
        }
    }
    
    public function IsComplete($id) {
        $req = $this->bdd->prepare("SELECT Pseudo, Nom, Prenom, Age, DateNaissance, AdresseMail FROM UTILISATEUR WHERE ID = :id");
        $req->execute(array(
            "id" => $id
        ));
        $chk = $req->fetch();
        if($chk) {
            if(empty($chk['Pseudo']) || empty($chk['Nom']) || empty($chk['DateNaissance'])) {
                $req->closeCursor();
                return 1;
            } else {
                $req->closeCursor();
                return 0;
            }
        } else {
            $req->closeCursor();
            return -1;
        }
    }
    
    public function getCurrData($id) {
        $req = $this->bdd->prepare("SELECT Pseudo, Nom, Prenom, DateNaissance, AdresseMail FROM UTILISATEUR WHERE ID = :id");
        $req->execute(array(
            "id" => $id
        ));
        $chk = $req->fetch();
        if($chk) {
            $req->closeCursor();
            return $chk;
        }
    }
    
    public function FillData($id, $data) {
        $req = $this->bdd->prepare("UPDATE UTILISATEUR SET Pseudo = :pseudo, Nom = :nom, Prenom = :prenom, DateNaissance = :date WHERE ID = :id");
        $req->execute(array(
            "pseudo" => $data[0],
            "nom" => $data[1],
            "prenom" => $data[2],
            "date" => date($data[3]),
            "id" => $id
        ));
    }
}

?>