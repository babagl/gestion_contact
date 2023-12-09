<?php
require_once "../Config/ConnexionDb.php";

class ContactModel
{
    private $connection;
    public function __construct()
    {
        $db = new ConnexionDb();
        $this->connection = $db->connexion();
    }
    public function getAllContact()
    {
        $request = "SELECT contacts.id, contacts.prenom, contacts.nom, categories.libelle FROM contacts 
                    JOIN categories ON contacts.categorie_id = categories.id ORDER BY contacts.id DESC; ";
        $request = $this->connection->prepare($request);
        $request->execute();
        return $request->fetchAll();
    }

    public function categorieIdExist($categorie_id)
    {
        $request = "select * from categories where id = :categorie_id";
        $request = $this->connection->prepare($request);
        $request->bindParam(':categorie_id', $categorie_id);
        $request->execute();
        return $request->fetchAll();
    }
    public function insertContact($prenom, $nom, $categorie_id)
    {
        if (count($this->categorieIdExist($categorie_id)) == 0) {
            return ["status" => false, "data" => [], "message" => "categorie inexistant"];
        }
        $request = "insert into contacts(prenom, nom, categorie_id) values(:prenom, :nom, :categorie_id)";
        $request = $this->connection->prepare($request);
        $request->bindParam(':prenom', $prenom);
        $request->bindParam(':nom', $nom);
        $request->bindParam(':categorie_id', $categorie_id);
        $request->execute();
    }
    public function addContact($prenom, $nom, $categorie_id)
    {
        $this->insertContact($prenom, $nom, $categorie_id);
        $request = "SELECT contacts.id, contacts.prenom, contacts.nom, categories.libelle from contacts JOIN  categories ON contacts.categorie_id = categories.id ORDER BY contacts.id DESC LIMIT 1";
        $request = $this->connection->prepare($request);
        $request->execute();
        return $request->fetchAll();
    }


}
