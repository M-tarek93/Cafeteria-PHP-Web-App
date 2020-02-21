<?php


    class databaseHandler{
        private $conn;
        private const host = '127.0.0.1';
        private const db   = 'cafeteria';
        private const user = 'root';
        private const pass = '';
        private const charset = 'utf8mb4';
        private const dsn = "mysql:host=" . self::host . ";dbname=" . self::db . ";charset=" . self::charset . ";";
        private const options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        public function __construct(){
            $this->connectDB();
        }
        public function connectDB(){
            try {
                $this->conn = new PDO(self::dsn, self::user, self::pass, self::options);
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
        }

        public function getUsers(){
            $stmt=$this->conn->prepare('select * from users');
            $stmt->execute();
            return $stmt->fetchAll();
        }
        
        public function deleteUser($username){
            $stmt=$this->conn->prepare('delete from users where username = ?');
            $stmt->bindValue( 1, $username );
            $stmt->execute();
            return $stmt->rowCount();
        }

        public function updateUser($username, $email, $room, $ext, $profilePic, $role=0) {
            $sql = 'update users set email = ?, room = ?, ext = ?, role = ?, profile_pic = ? where username = ?';
            try{
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(1, $email);
                $stmt->bindValue(2, $room);
                $stmt->bindValue(3, $ext);
                $stmt->bindValue(4, $role);
                $stmt->bindValue(5, $profilePic);
                $stmt->bindValue(6, $username);
                $stmt->execute();
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        public function insertUser($username, $password, $email, $room, $ext, $profilePic, $role=0) : int {
            $sql = "INSERT INTO users( username, password, email, room, ext, profile_pic, role) values(?,?,?,?,?,?,?);";
            try{
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue( 1, $username );
                $stmt->bindValue( 2, $password );
                $stmt->bindValue( 3, $email );
                $stmt->bindValue( 4, $room );
                $stmt->bindValue( 5, $ext );
                $stmt->bindValue( 6, $profilePic );
                $stmt->bindValue( 7, $role );
                $stmt->execute();
                return $stmt->rowCount();
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function displayUserOrders($username){
            $this->connectDB();
            $sql = "SELECT * from orders_items, orders, products WHERE `orders_items`.`order_id` = `orders`.`order_id` and `products`.`id` = `orders_items`.`product_id` AND `orders`.`username` = ? LIMIT 10";
            try{
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(1,$username);
                $stmt->execute();
                $result = $stmt->fetchAll();
                return $result;
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function displayProducts(){
            $this->connectDB();
            $sql = "SELECT * FROM products;";
            try{
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll();
                return $result;
            } catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function getDistinctRooms(){
            $this->connectDB();
            $sql = "SELECT DISTINCT room FROM users;";
            try{
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll();
                return $result;
            } catch( PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function getDistinctExt(){
            $this->connectDB();
            $sql = "SELECT DISTINCT ext FROM users;";
            try{
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll();
                return $result;
            } catch( PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function insertOrder($notes, $room, $ext, $totalPrice, $username){
            $this->connectDB();
            $sql = "INSERT INTO orders(Notes, date, room, ext, total_price, status, username) VALUES( ?, CURRENT_DATE(), ?, ?, ?, 'processing', ?);";
            try{
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(1,$notes);
                $stmt->bindValue(2,$room);
                $stmt->bindValue(3,$ext);
                $stmt->bindValue(4,$totalPrice);
                $stmt->bindValue(5,$username);
                $stmt->execute();

            } catch( PDOException $e){
                echo $e->getMessage();
            }
        }

        public function insertOrderItem($orderID, $productID){
            $this->connectDB();
            $sql = "INSERT INTO orders_items(order_id, product_id) VALUES(?, ?);";
            try{
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(1, $orderID);
                $stmt->bindValue(2, $productID);
                $stmt->execute();
            } catch( PDOException $e){
                echo $e->getMessage();
            }
        }

        public function lastInsertId(){
            return $this->conn->lastInsertId();
        }

        public function getNormalUsers(){
            $this->connectDB();
            $sql = "SELECT username FROM users WHERE role !=1;";
            
            try{
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll();
                return $result;
            } catch( PDOException $e){
                echo $e->getMessage();
            }
        }
        public function insertProduct($productname,$price, $category, $image,$IsAvailable)
        {
    
            $this->connectDB();
    
            // prepare sql and bind parameters
            $stmt = $this->conn->prepare("INSERT INTO products ( productname,price , category ,image, IsAvailable
                )
                VALUES (:productname,:price,:category,:image,:IsAvailable)");
            $stmt->bindParam(':productname', $productname);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':category', $category);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':IsAvailable', $IsAvailable);
    
            $stmt->execute();
            $this->disconnectDB();
    
        }
        public function insertCategory($productname,$price, $category, $image,$IsAvailable)
        {
    
            $this->connectDB();
    
            // prepare sql and bind parameters
            $stmt = $this->conn->prepare("INSERT INTO products ( productname,price , category ,image, IsAvailable
            )
            VALUES (:productname,:price,:category,:image,:IsAvailable)");
        $stmt->bindParam(':productname', $productname);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':IsAvailable', $IsAvailable);
    
        $stmt->execute();
        $this->disconnectDB();
            
    
    
        }
    
        function selectAll (){ 
           
             $this->connectDB();
            $stmt= $this->conn->prepare("SELECT * FROM products;");
            $stmt->execute();
            $allProducts = $stmt->fetchAll();
            return $allProducts;
           
    // $this->disconnectDB();
        }
    
        public function updateProduct($productname, $price, $category, $image, $IsAvailable=1,$id) {
            $sql = 'update products set productname = ?, price = ?, category = ?, image = ?, IsAvailable = ? where id = ?';
            try{
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(1, $productname);
                $stmt->bindValue(2, $price);
                $stmt->bindValue(3, $category);
                $stmt->bindValue(4, $image);
                $stmt->bindValue(5, $IsAvailable);
                $stmt->bindValue(6, $id);
    
    
                $stmt->execute();
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
     
        

    }

    // $db = new databaseHandler();
    // $data = $db->displayUserOrders();
    // foreach($data as $order ){
    //     echo $order["name"] . " " . $order['username'];
    // }
