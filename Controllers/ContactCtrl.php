<?php
require_once "../Models/ContactModel.php";

class ContactCtrl
{
   public $model;
   public function __construct()
   {
      $this->model = new ContactModel();
   }
   public function contact()
   {
      $this->headerRequest();
      $contacts = $this->model->getAllContact();
      echo json_encode(["status" => true, "data" => $contacts, "message" => "liste des contatcs enregistrés"]);
   }
   public function add()
   {
      $this->headerRequest();
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         $corpsRequete = file_get_contents("php://input");
         $donnees = json_decode($corpsRequete, true);
         if ($donnees !== null) {

            $prenom = $donnees['prenom'];
            $nom = $donnees['nom'];
            $categorie_id = $donnees['categorie'];
           
            if (!(isset($prenom) && $prenom) || !(isset($nom) && $nom) || !(isset($categorie_id) && $categorie_id)) {
               echo json_encode(["message" => "Tous les champs sont obligatoires", "status" => false, "data" => []]);
               return;
            }
            echo json_encode(["message" => "insertion réussi", "data" => $this->model->addContact($prenom, $nom, $categorie_id), "status" => true]);
            return;
         } else {
            echo json_encode(["message" => "une erreur s'est produit, veuiller recommencer", "data" => [], "status" => false]);
            return;
         }
      } else {

         echo json_encode(["message" => "Cette page accepte uniquement les requêtes POST.", "status" => false, "data" => []]);
         return;
      }
   }

   public function headerRequest(){
       header('Access-Control-Allow-Origin: *');
       header('Access-Control-Allow-Headers: Content-Type');
       header('Content-Type: application/json');
   }
}
