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

    public function getProductVersions($idprodotto) {
        $query = "SELECT * FROM versione_prodotto WHERE CodProdotto=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$idprodotto);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductInfos($idprodotto, $idversione) {
        $query = "SELECT TagliaCane, EtaCane, Composizione_Materiale, Prezzo, Disponibilita FROM versione_prodotto WHERE CodProdotto=? AND Codice=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$idprodotto, $idversione);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getRelatedProducts($ricerca){
        $stmt = $this->db->prepare("SELECT CodProdotto, Nome, Percorso_Immagine FROM prodotto WHERE Nome LIKE ? ORDER BY RAND()");
        $termine = "%" . $ricerca . "%";
        $stmt->bind_param('s', $termine);
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

    public function addToCart($userId, $prodVer, $productId, $quantity) {
        $query = "INSERT INTO carrello (Email, Codice, CodProdotto, Quantita) VALUES (?, ?, ?, ?)
                  ON DUPLICATE KEY UPDATE Quantita = Quantita + ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("siiii", $userId, $prodVer, $productId, $quantity, $quantity);
        $stmt->execute();

        return $stmt->insert_id;
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

    public function addToWishlist($userId, $productId) {
        $query = "INSERT INTO lista_desideri (CodProdotto, Email) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("is", $productId, $userId);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function getCart($userId) {
        $query = "SELECT p.CodProdotto, p.Nome, p.Percorso_Immagine, c.Quantita, vp.Codice, vp.TagliaCane, vp.EtaCane, vp.Composizione_Materiale, vp.Prezzo, vp.Disponibilita FROM prodotto p,
                    carrello c, versione_prodotto vp WHERE c.Email LIKE ? AND c.CodProdotto = p.CodProdotto AND c.CodProdotto = vp.CodProdotto AND c.Codice = vp.Codice";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$userId);
        $stmt->execute();
        $result = $stmt->get_result();

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
        $query = "SELECT lista_desideri.CodProdotto, prodotto.Nome, prodotto.Descrizione, prodotto.Brand, prodotto.Percorso_Immagine
        FROM lista_desideri, prodotto
        WHERE lista_desideri.Email= ? AND lista_desideri.CodProdotto = prodotto.CodProdotto";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteWishProduct($email, $codice) {
        $query = "DELETE FROM lista_desideri WHERE Email = ? AND CodProdotto = ?";
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

    public function removeFromCart($userId, $productId, $version) {
        $query = "DELETE FROM carrello WHERE Email = ? AND CodProdotto = ? AND Codice = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sii", $userId, $productId, $version);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function updateCart($quantity, $userId, $productId, $version) {
        $query = "UPDATE carrello SET Quantita = ? WHERE Email = ? AND CodProdotto = ? AND Codice = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("isii", $quantity, $userId, $productId, $version);
        $stmt->execute();

        return $stmt->insert_id;

    }

    public function isInWishList($userId, $productId) {
        $query = "SELECT COUNT(*) AS total FROM lista_desideri WHERE Email = ? AND CodProdotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $userId, $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc()["total"];
    }

        // Inserisce un nuovo ordine e restituisce l'ID dell'ordine
        public function insertOrder($email, $dataOrdine) {
            $query = "INSERT INTO ordine (Email, Data) VALUES (?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ss", $email, $dataOrdine);
            $stmt->execute();
            return $this->db->insert_id; // Restituisce l'ID dell'ordine appena inserito
        }

        // Inserisce i dettagli di un ordine
        public function insertOrderDetail($idOrdine, $codProdotto,$codiceVersione, $quantita, $prezzo) {
            $query = "INSERT INTO ordine_prodotto (Numero, CodProdotto,Codice,Quantita, Prezzo)
                      VALUES (?, ?, ?, ?,?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("iiiid", $idOrdine, $codProdotto, $codiceVersione,$quantita, $prezzo);
            $stmt->execute();
        }

        // Svuota il carrello dell'utente
        public function clearCart($email) {
            $query = "DELETE FROM carrello WHERE Email = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
        }

        public function getOrderDetails($orderId) {
            $stmt = $this->db->prepare("SELECT d.Numero, d.CodProdotto, d.Codice, d.Quantita, d.Prezzo, p.Nome, p.Percorso_Immagine
                                        FROM ordine_prodotto d
                                        INNER JOIN prodotto p ON d.CodProdotto = p.CodProdotto
                                        WHERE d.Numero = ?");
            $stmt->bind_param("i", $orderId); // Assicurati di legare l'ID dell'ordine come intero
            $stmt->execute();

            $result = $stmt->get_result();
            $orderDetails = [];

            while ($row = $result->fetch_assoc()) {
                $orderDetails[] = $row;
            }

            return $orderDetails;
        }

        public function getUserOrders($userId) {
            $stmt = $this->db->prepare("
                SELECT o.Numero, o.Data,
                       d.Codice, d.CodProdotto, d.Quantita, d.Prezzo,
                       p.Nome, p.Percorso_Immagine
                FROM ordine o
                INNER JOIN ordine_prodotto d ON o.Numero = d.Numero
                INNER JOIN prodotto p ON d.CodProdotto = p.CodProdotto
                WHERE o.Email = ?
                ORDER BY o.Data DESC
            ");
            $stmt->bind_param("s", $userId);
            $stmt->execute();

            $result = $stmt->get_result();
            $orders = [];

            while ($row = $result->fetch_assoc()) {
                $orders[$row['Numero']]['Data'] = $row['Data'];
                $orders[$row['Numero']]['prodotto'][] = $row;
            }

            return $orders;
        }



}

?>