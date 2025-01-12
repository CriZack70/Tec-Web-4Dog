<?php
class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
    }

    public function getCategories(){
        $stmt = $this->db->prepare("SELECT * FROM categoria_prodotto");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getRandomProducts($n){
        $stmt = $this->db->prepare("SELECT CodProdotto, Nome, Percorso_Immagine FROM prodotto ORDER BY RAND() LIMIT ?");
        $stmt->bind_param('i',$n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductById($id){
        $query = "SELECT CodProdotto, Nome, Brand, Percorso_Immagine, Descrizione FROM prodotto WHERE CodProdotto=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCategoryById($idcategory){
        $stmt = $this->db->prepare("SELECT Nome FROM categoria_prodotto WHERE CodCategoria=?");
        $stmt->bind_param('i',$idcategory);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductsByCategory($idcategory){
        $query = "SELECT CodProdotto, Nome, Percorso_Immagine FROM prodotto WHERE CodCategoria=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$idcategory);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductInfos($idprodotto) {
        $query = "SELECT * FROM versione_prodotto WHERE CodProdotto=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$idprodotto);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkLogin($usermail){
        $query = "SELECT Email, Password, Nome FROM utente_registrato WHERE  Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $usermail);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getDogByUserId($useremail) {
        $query = "SELECT * FROM doggy WHERE Email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function getProductsBySize($taglia) {
        $query = "SELECT p.CodProdotto, p.Nome, p.Percorso_Immagine FROM prodotto p,
                    versione_prodotto vp WHERE vp.TagliaCane LIKE ? AND vp.CodProdotto = p.CodProdotto";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$taglia);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function createUser($usermail,  $surname, $name, $tel, $password){
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "
            INSERT INTO utente_registrato (Email, Cognome, Nome, Telefono, Password)
            VALUES (?, ?, ?, ?, ?)
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssss', $usermail,  $surname, $name, $tel, $hashedPassword);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function checkEmail($email){
        $sql = "SELECT * FROM utente_registrato WHERE Email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $exist = $result->num_rows > 0;
    }

}

?>