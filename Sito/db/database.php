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
        $query = "SELECT Codprodotto, Codice, TagliaCane, SessoCane, EtaCane, Composizione_Materiale, FORMAT(Prezzo, 2) AS Prezzo_Form, Disponibilita FROM versione_prodotto WHERE CodProdotto=?";
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

    public function getProductDefaultInfos($idprodotto) {
        $query = "SELECT Codprodotto, Codice, TagliaCane, SessoCane, EtaCane, Composizione_Materiale, FORMAT(Prezzo, 2) AS Prezzo_Form, Disponibilita FROM versione_prodotto WHERE CodProdotto=? AND Disponibilita > 0 ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$idprodotto);
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

    public function getBrandProducts($brand){
        $stmt = $this->db->prepare("SELECT CodProdotto, Nome, Percorso_Immagine FROM prodotto WHERE Brand = ? ORDER BY RAND()");        
        $stmt->bind_param('s', $brand);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function checkLogin($usermail){
        $query = "SELECT Email, Password, Nome FROM utente_registrato WHERE  Email = ? AND Attivo = 1";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $usermail);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkDisactiveUser($usermail){
        $query = "SELECT Email, Password, Nome FROM utente_registrato WHERE  Email = ? AND Attivo = 0";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $usermail);
        $stmt->execute();
        $result = $stmt->get_result();
        return  $exist = $result->num_rows > 0;
    }

    public function checkAdmin($id) {
        $query = "SELECT Id_Adm, Password FROM admin WHERE Id_Adm = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $id);
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
        $query = "INSERT INTO utente_registrato (Email, Cognome, Nome, Telefono, Password, Attivo)
            VALUES (?, ?, ?, ?, ?, 1)";

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
        $stmt = $this->db->prepare("
            SELECT DISTINCT versione_prodotto.CodProdotto, prodotto.Nome, prodotto.Percorso_Immagine 
            FROM versione_prodotto 
            JOIN prodotto ON versione_prodotto.CodProdotto = prodotto.CodProdotto 
            WHERE versione_prodotto.TagliaCane = ? 
            OR versione_prodotto.EtaCane = ? 
            OR versione_prodotto.SessoCane = ? 
            LIMIT ?
        ");
        $stmt->bind_param('sssi', $taglia, $eta, $sesso, $n);
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

    public function  getcartCount($email){
        $query = "SELECT SUM(Quantita) AS cart FROM carrello WHERE Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return $row['cart'];
        } else {
            return 0; // Restituisce 0 se non ci sono risultati
        }
    }

    public function createNotification($orderId, $status, $data) {
        $query = "INSERT INTO notifica (Numero, Descrizione, Data, Letta) VALUES (?, ? , ? , 0)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iss", $orderId, $status, $data);

        return $stmt->execute();
    }

    public function getNotifications($email){
        $query = "SELECT notifica.Numero, notifica.Descrizione, notifica.Data, notifica.Letta, ordine.Email FROM notifica, ordine 
        WHERE notifica.Numero = ordine.Numero AND ordine.Email = ?
        ORDER BY notifica.Data DESC ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);

    }

    public function updateNotificationsStatus($num, $desc){
        $query = "UPDATE notifica SET Letta = 1 WHERE Numero = ? AND Descrizione = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("is", $num, $desc);
        return  $stmt->execute();
    }

    public function deleteNotificationsStatus($num, $desc){
        $query = "DELETE FROM notifica  WHERE Numero = ? AND Descrizione = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("is", $num, $desc);       
        return  $stmt->execute();
    }
    
    public function  getUnreadNotifications($email){
        $query = "SELECT COUNT(*) AS totalNot FROM notifica, ordine WHERE notifica.Numero = ordine.Numero AND ordine.Email = ? AND notifica.Letta = 0";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return $row['totalNot'];
        } else {
            return 0; // Restituisce 0 se non ci sono risultati
        }
    }
    
    // Inserisce un nuovo ordine e restituisce l'ID dell'ordine
    public function insertOrder($email, $dataOrdine, $total) {
        $query = "INSERT INTO ordine (Email, Data, Totale, Stato) VALUES (?, ?, ?, 'Effettuato')";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssd", $email, $dataOrdine, $total);
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
        $stmt = $this->db->prepare("SELECT d.Numero, d.CodProdotto, d.Codice, d.Quantita, d.Prezzo, p.Nome, p.Percorso_Immagine, 
                                        (SELECT ROUND(SUM(d1.Quantita * d1.Prezzo), 2) 
                                        FROM ordine_prodotto d1 
                                        WHERE d1.Numero = d.Numero) AS TotaleOrdine
                                    FROM ordine_prodotto d
                                    INNER JOIN prodotto p ON d.CodProdotto = p.CodProdotto
                                    WHERE d.Numero = ?
                                    ");
        $stmt->bind_param("i", $orderId); 
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

    public function getAllUsers() {
        $stmt = $this->db->prepare("SELECT * FROM utente_registrato");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllOrders() {
        $stmt = $this->db->prepare("SELECT * FROM ordine");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllProducts() {
        $stmt = $this->db->prepare("SELECT * FROM prodotto");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllVersions() {
        $query = "SELECT * FROM versione_prodotto ORDER BY CodProdotto";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function refreshUser($active, $user) {
        $query = "UPDATE utente_registrato SET Attivo = ? WHERE Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("is", $active, $user);

        return $stmt->execute();
    }

    public function deleteVersion($productId, $productVer) {
        $query = "DELETE FROM versione_prodotto WHERE CodProdotto = ? AND Codice = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $productId, $productVer);

        return $stmt->execute();
    }

    public function deleteProduct($productId) {
        $query = "DELETE FROM prodotto WHERE CodProdotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $productId);

        return $stmt->execute();
    }

    public function editProduct($price, $availability, $productId, $productVer, $categoryID) {
        $queryVer = "UPDATE versione_prodotto SET Prezzo = ?, Disponibilita = ? WHERE CodProdotto = ? AND Codice = ?";
        $queryProd = "UPDATE prodotto SET CodCategoria = ? WHERE CodProdotto = ?";
        
        $stmtVer = $this->db->prepare($queryVer);
        $stmtProd = $this->db->prepare($queryProd);

        $stmtVer->bind_param("diii", $price, $availability, $productId, $productVer);
        $stmtProd->bind_param("ii", $categoryID, $productId);

        $ver = $stmtVer->execute();
        $prod = $stmtProd->execute();
        
        return $ver && $prod;
    }
    
    public function addVersion($productId, $size, $age, $fabric, $price, $quantity) {
        $query = "INSERT INTO versione_prodotto (CodProdotto, TagliaCane, EtaCane, Composizione_Materiale, Prezzo, Disponibilita) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("isssdi", $productId, $size, $age, $fabric, $price, $quantity);

        return $stmt->execute();
    }

    public function addProduct($name, $brand, $desc, $img, $category) {
        $query = "INSERT INTO prodotto (Nome, Brand, Descrizione, Percorso_Immagine, CodCategoria) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssssi", $name, $brand, $desc, $img, $category);

        return $stmt->execute();
    }

    public function getOrderStates() {
        $query = "SELECT * FROM stato_ordine";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function changeOrderStatus($orderStatus, $orderID) {
        $query = "UPDATE ordine SET Stato = ? WHERE Numero = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $orderStatus, $orderID);

        return $stmt->execute();
    }

    public function getPaymentMethods($email) {
        $query = "SELECT Numero_Carta, Scadenza FROM metodo_pagamento WHERE Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addCard($email, $cardNumber, $expiryDate, $cvv) {
        
        $query = "INSERT INTO metodo_pagamento (Email, Numero_Carta, Scadenza, CVV) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssi",$email, $cardNumber, $expiryDate, $cvv);

        return $stmt->execute();
    }

    public function removeCard($email, $cardNumber) {
        $query = "DELETE FROM metodo_pagamento WHERE Email = ? AND Numero_Carta = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $email, $cardNumber);
        
        return $stmt->execute();
    }

    public function createCategory($name) {
        
        $query = "INSERT INTO categoria_prodotto (Nome) VALUES (?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s",$name);

        return $stmt->execute();
    }

    public function removeCategory($idcategory) {
        $query = "DELETE FROM categoria_prodotto WHERE CodCategoria = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idcategory);
        
        return $stmt->execute();
    }
    
    public function insertorderNotification($data, $orderId){
        $query = "INSERT INTO notifica_venditore (Email_Admin, Data, Numero) VALUES ('fedeclacri@4dogs.it', ?, ? )";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $data, $orderId);

        return $stmt->execute();
    }

    public function insertDisponibilityNotification($data, $codice){
        $query = "INSERT INTO notifica_venditore (Email_Admin, Data, Codice) VALUES ('fedeclacri@4dogs.it', ?, ? )";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $data,  $codice);

        return $stmt->execute();
    }
       

     //aggiorna la disponibilità prodotto

     public function updateQuantity($codide,$quantity){
        $quantity = (int)$quantity;
        $query = " UPDATE versione_prodotto SET Disponibilita = Disponibilita - ?
                WHERE Codice = ?";
         $stmt = $this->db->prepare($query);
         $stmt->bind_param("ii", $quantity, $codide);
         $stmt->execute();

         $querySelect = "SELECT Disponibilita FROM versione_prodotto WHERE Codice = ?";
         $stmtSelect = $this->db->prepare($querySelect);
         $stmtSelect->bind_param("i", $codide);
         $stmtSelect->execute();
         $result = $stmtSelect->get_result();
         $row = $result->fetch_assoc();
     
         return $row['Disponibilita'];
    
        }

       
        public function getNotificationsOrdersAdm(){
            $query = "SELECT notifica_venditore.Id, notifica_venditore.Data, notifica_venditore.Numero, notifica_venditore.Letta 
            FROM notifica_venditore
            WHERE notifica_venditore.Numero IS NOT NULL
            ORDER BY notifica_venditore.Data DESC ";
            $stmt = $this->db->prepare($query);            
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);    
        }

        public function getNotificationsDispAdm(){
            $query = "SELECT notifica_venditore.Id, notifica_venditore.Data, notifica_venditore.Codice, notifica_venditore.Letta, prodotto.Percorso_Immagine, prodotto.CodProdotto
            FROM notifica_venditore 
            JOIN versione_prodotto ON notifica_venditore.Codice = versione_prodotto.Codice
            JOIN prodotto ON versione_prodotto.CodProdotto = prodotto.CodProdotto
            WHERE notifica_venditore.Codice IS NOT NULL
            ORDER BY notifica_venditore.Data DESC ";
            $stmt = $this->db->prepare($query);            
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);    
        }
    
        public function updateNotificationsStatusAdm($id){
            $query = "UPDATE notifica_venditore SET Letta = 1 WHERE Id = ? ";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("i", $id);
            return  $stmt->execute();
        }
    
        public function deleteNotificationsAdm($id){
            $query = "DELETE FROM notifica_venditore  WHERE Id = ? ";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("i", $id);       
            return  $stmt->execute();
        }
        
        public function  getUnreadNotificationsAdm(){
            $query = "SELECT COUNT(*) AS totalNotAdm FROM notifica_venditore WHERE  notifica_venditore.Letta = 0";
            $stmt = $this->db->prepare($query);            
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                return $row['totalNotAdm'];
            } else {
                return 0; // Restituisce 0 se non ci sono risultati
            }
        }

   
}

?>