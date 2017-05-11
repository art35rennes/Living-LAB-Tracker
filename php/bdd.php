<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ProjetLLT";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
    }

    $arrayToReplace = array("'", "é", "è", "à", "<", ">", '"');
    $arrayReplaceWith = array("\'", "e", "e", "a", "\<", "\>", '\"');


    /*****************************
    ****INSERTION DANS LA BASE****
    *****************************/

    function AddUser($Nom, $Type, $Mail, $Sms, $Password){
        str_replace($arrayToReplace, $arrayReplaceWith, $Nom);

        $sql = "INSERT INTO UTILISATEUR (NOM_UTILISATEUR, TYPE_UTILISATEUR, CONTACT_MAIL, CONTACT_SMS, PASSWORD) VALUES ('$Nom', $Type, '$Mail', $Sms, '$Password')";
        global $conn;
        $conn->query($sql);
    }

    function AddSupervise($IDPersonne, $IDSuperviseur){
        $sql = "INSERT INTO SUPERVISE (ID_UTILISATEUR, UTI_ID_UTILISATEUR) VALUES ($IDPersonne, $IDSuperviseur)";
        global $conn;
        $conn->query($sql);
    }

    function AddLieu($Nom){
        $sql = "INSERT INTO LIEU (NOM_LIEU) VALUES ('$Nom')";
        global $conn;
        $conn->query($sql);
    }

    function AddQui($IDLieu, $IDPersonne){
        $sql = "INSERT INTO DONNEE (ID_LIEU, ID_UTILISATEUR) VALUES ($IDLieu, $IDPersonne)";
        global $conn;
        $conn->query($sql);
    }

    function AddDonnee($IDLieu, $Valeur, $Type){
        $sql = "INSERT INTO DONNEE (ID_LIEU, VALEUR_DONNEE, TYPE_DONNEE) VALUES ($IDLieu, $Valeur, $Type)";
        global $conn;
        $conn->query($sql);
    }

    function AddAlertes($IDLieu, $TypeContact, $TypeDonnee, $SeuilH, $SeuilB=NULL, $SeuilC=NULL){
        $sql = "INSERT INTO UTILISATEUR (ID_LIEU, SEUIL_CRITIQUE, SEUIL_HAUT, SEUIL_BAS, TYPE_CONTACT, TYPE_DONNEE) VALUES ($IDLieu, $SeuilC, $SeuilH, $SeuilB, $SeuilC, $TypeDonnee)";
        global $conn;
        $conn->query($sql);
    }

    /********************************
    ****RECUPERATION DANS LA BASE****
    *********************************/

    function SuperviseBy($IDOccupant){ //recupere le/les superviseur(s) d'un occupant.
        $sql = "SELECT NOM_UTILISATEUR, UTILISATEUR.ID_UTILISATEUR, TYPE_UTILISATEUR FROM SUPERVISE, USER JOIN ON SUPERVISE.UTI_ID_UTILISATEUR, UTILISATEUR.ID_UTILISATEUR WHERE SUPERVISE.UTI_ID_UTILISATEUR = $IDOccupant";
        global $conn;
        $result = $conn->query($sql);
        return $result;
    }

    function Supervise($IDUser){//recupere tout les utilisateurs supervise par la personne.
    }

    function GetAlertFor($IDLieu){//recupere les alertes d'un lieu.

    }

    function GetDonneeFromLieu($IDLieu){//recupere les donnees liee a un lieu (tout type de donnee confondue).

    }

    function GetDonneeFromType($Type){//recupere toute les donnees du meme type de capteur (sans distinction de lieu).

    }

    function GetDonneFromTypeAndLieu($IDLieu, $Type){//recupere les donnees d'un capteur pour un lieu.

    }

    function GetSuperviseur(){//recupere la liste des superviseurs.

    }

    function GetSupervisee(){//recupere la liste des supervisee.

    }

    function GetTable($NomTable, $ListeCol = "*"){
        $sql = "SELECT $ListeCol FROM $NomTable";
        global $conn;
        $result = $conn->query($sql);
        return $result;
    }
?>
