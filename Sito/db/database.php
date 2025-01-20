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
        $query = "INSERT INTO utente_registrato (Email, Cognome, Nome, Telefono, Password)
            VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssss', $usermail,  $surname, $name, $tel, $hashedPassword);
        return $stmt->execute();
    }

    public function checkEmail($email){
        $sql = "SELECT * FROM utente_registrato WHERE Email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $exist = $result->num_rows > 0;
    }

    public function getDogByEmail($email) {
        $query = "SELECT * FROM doggy WHERE Email = ?";
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            die("Errore nella preparazione della query: " . $this->db->error);
        }

        $stmt->bind_param("s", $email);
        if (!$stmt->execute()) {
            die("Errore nell'esecuzione della query: " . $stmt->error);
        }

        $result = $stmt->get_result();
        if ($result === false) {
            die("Errore nel recupero dei risultati: " . $stmt->error);
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertDog($email, $nome, $taglia, $sesso, $eta) {
        $query = "INSERT INTO doggy (Email, Nome, Taglia, Sesso, Eta)
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssss", $email, $nome, $taglia, $sesso, $eta);
        return $stmt->execute();

    }

    public function updateDog($email, $nome, $taglia, $sesso, $eta) {
        $query = "UPDATE doggy
                  SET Nome = ?, Taglia = ?, Sesso = ?, Eta = ?
                  WHERE Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssss", $nome, $taglia, $sesso, $eta, $email);
        return $stmt->execute();     
    }
    public function deleteDog($idUtente) {
        $query = "DELETE FROM doggy WHERE Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $idUtente);
        return $stmt->execute();
    }

    public function getUserByEmail($email) {
        $query = "SELECT * FROM utente_registrato WHERE Email = ?";
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            die("Errore nella preparazione della query: " . $this->db->error);
        }

        $stmt->bind_param("s", $email);
        if (!$stmt->execute()) {
            die("Errore nell'esecuzione della query: " . $stmt->error);
        }

        $result = $stmt->get_result();
        if ($result === false) {
            die("Errore nel recupero dei risultati: " . $stmt->error);
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function updateUser($email, $cognome, $nome, $phone){
        $query = "UPDATE utente_registrato
                  SET Cognome = ? , Nome = ?, Telefono = ?
                  WHERE Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssss", $cognome, $nome, $phone, $email);
        return $stmt->execute(); 

    }

    public function getWishlistInfoes($email) {
        $query = "SELECT lista_desideri.CodProdotto, lista_desideri.Codice, prodotto.Nome,prodotto.Descrizione, 
        versione_prodotto.TagliaCane, prodotto.Brand, versione_prodotto.Prezzo,versione_prodotto.SessoCane, 
        versione_prodotto.EtaCane, versione_prodotto.Colore, versione_prodotto.Composizione_Materiale, prodotto.Percorso_Immagine
        FROM lista_desideri, versione_prodotto, prodotto
        WHERE lista_desideri.Email= ? AND lista_desideri.CodProdotto = prodotto.CodProdotto AND 
        prodotto.CodProdotto = versione_prodotto.CodProdotto AND versione_prodotto.Codice = lista_desideri.Codice";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function deleteWishProduct($email, $codice) {
        $query = "DELETE FROM lista_desideri WHERE Email = ? AND Codice = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $email, $codice);
        return $stmt->execute();
    }

    public function casualProdDoggy($taglia, $eta, $sesso, $n) {
        $stmt = $this->db->prepare("SELECT versione_prodotto.CodProdotto, prodotto.Nome, prodotto.Percorso_Immagine FROM versione_prodotto, prodotto
         WHERE versione_prodotto.CodProdotto= prodotto.CodProdotto AND ( versione_prodotto.TagliaCane = ? OR EtaCane= ? OR SessoCane = ? ) LIMIT ? ");
        $stmt->bind_param('sssi',$taglia, $eta, $sesso,  $n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);

    }
}


   
?>