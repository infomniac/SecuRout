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
        $req->closeCursor();
    }
    
    public function CreateEvent($titre, $local, $desc) {
        $req = $this->bdd->prepare("INSERT INTO EVENT (Titre, Localisation, Description) VALUES (:titre, :localisation, :desc)");
        $req->execute(array(
            "titre" => htmlspecialchars($titre),
            "localisation" => htmlspecialchars($local),
            "desc" => htmlspecialchars($desc)
        ));
        $req->closeCursor();
    }
    
    public function UpdateEvent($id, $titre, $local, $desc) {
        $req = $this->bdd->prepare("UPDATE EVENT SET Titre = :titre, Localisation = :loca, Description = :desc WHERE ID = :id");
        $req->execute(array(
            "titre" => htmlspecialchars($titre),
            "localisation" => htmlspecialchars($local),
            "desc" => htmlspecialchars($desc),
            "id" => htmlspecialchars($id)
        ));
    }
    
    public function JoinEvent($idU, $idE, $idT) {
        $req = $this->bdd->prepare("INSERT INTO EVENT_USER (ID_USER, ID_EVENT, ID_TYPE) VALUES (:idu, :ide, :idt)");
        $req->execute(array(
            "idu" => htmlspecialchars(intval($idU)),
            "ide" => htmlspecialchars(intval($idE)),
            "idt" => htmlspecialchars(intval($idT))
        ));
        $req->closeCursor();
    }
    
    public function ReturnEventID($titre) {
        $req = $this->bdd->prepare("SELECT ID FROM EVENT WHERE Titre = :titre");
        $req->execute(array(
            "titre" => $titre
        ));
        $id = $req->fetch();
        
        if($id) {
            $req->closeCursor();
            return intval($id["ID"]);
        } else {
            $req->closeCursor();
            return 0;
        }
    }
    
    public function getThreeEvent() {
        $req = $this->bdd->prepare("SELECT ID, Titre, Localisation, Description FROM EVENT LIMIT 3");
        $req->execute();
        
        while($chk = $req->fetch()) {
            $data[] = $chk;
        }
        
        $req->closeCursor();
        return $data;
    }
    
    public function RetrieveOwnEvent($id) {
        //var_dump($id);
        $req = $this->bdd->prepare("SELECT EVENT.ID, EVENT.Titre, EVENT.Localisation, EVENT.Description FROM EVENT INNER JOIN EVENT_USER ON EVENT.ID = EVENT_USER.ID_EVENT WHERE EVENT_USER.ID_USER = :id");
        $req->execute(array("id" => $id));
        while($evt = $req->fetch()) {
            $ev[] = $evt;
        }
        $req->closeCursor();
        return $ev;
    }
    
    public function retrieveIDTraffic($data) {
        $req = $this->bdd->prepare("SELECT ID FROM TYPE_INFO WHERE TypeInfo = :type");
        $req->execute(array(
            "type" => $data
        ));
        $idtr = $req->fetch();
        
        if ($idtr) {
            var_dump($idtr['ID']);
            $req->closeCursor();
            return intval($idtr['ID']);
        }
    }
    
    public function RetrieveTraffic($id) {
        $req = $this->bdd->prepare("SELECT TYPE_INFO.TypeInfo FROM TYPE_INFO INNER JOIN EVENT_INFO INNER JOIN EVENT ON TYPE_INFO.ID = EVENT_INFO.ID_INFO WHERE EVENT.ID = :id");
        $req->execute(array(
            "id" => $id
        ));
        while($data = $req->fetch()){
            $traf[] = $data["TypeInfo"];
        }
        $req->closeCursor();
        return $traf;
    }
    
    public function UpdateTraffic($id, $infotraffic) {
        for($i = 0; $i < count($infotraffic); $i++) {
            $req = $this->bdd->prepare("INSERT INTO TYPE_INFO (TypeInfo) VALUES (:data)");
            $req->execute(array("data" => htmlspecialchars($infotraffic[$i])));
            $req->closeCursor();
            $idt = $this->retrieveIDTraffic($infotraffic[$i]);
            //var_dump($idt);
            $req = $this->bdd->prepare("INSERT INTO EVENT_INFO (ID_EVENT, ID_INFO) VALUES (:ide, :idi)");
            $req->execute(array(
                "ide" => $id, 
                "idi" => intval($idt)
            ));
            $req->closeCursor();
        }
    }
}

?>