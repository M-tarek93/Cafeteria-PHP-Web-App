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

        public function disconnectDB(){
            $this->conn = null;
        }

        public function getUsers(){
            $stmt=$this->conn->prepare('select * from users');
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function getUserNames(){
            $stmt=$this->conn->prepare('select username from users');
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

        function selectAllProducts (){
            $this->connectDB();
            $stmt= $this->conn->prepare("SELECT * FROM products;");
            $stmt->execute();
            $allProducts = $stmt->fetchAll();
            return $allProducts;
        }

        public function displayUserOrders($username){
            $this->connectDB();
            $sql = "SELECT * from orders_items, orders, products WHERE `orders_items`.`order_id` = `orders`.`id` and `products`.`id` = `orders_items`.`product_id` AND `orders`.`username` = ? LIMIT 10";
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

        public function insertProduct($name, $price, $category, $image){
            $this->connectDB();
    
            // prepare sql and bind parameters
            $stmt = $this->conn->prepare("INSERT INTO products ( name, price , category , image) VALUES (:name, :price, :category, :image)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':category', $category);
            $stmt->bindParam(':image', $image);
            $stmt->execute();
        }
    
        public function updateProduct($name, $price, $category, $image, $isAvailable=1,$id) {
            $sql = 'update products set name = ?, price = ?, category = ?, image = ?, isAvailable = ? where id = ?';
            try{
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(1, $name);
                $stmt->bindValue(2, $price);
                $stmt->bindValue(3, $category);
                $stmt->bindValue(4, $image);
                $stmt->bindValue(5, $isAvailable);
                $stmt->bindValue(6, $id);
    
    
                $stmt->execute();
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
     
        public function getMyOrders($username,$from_date,$to_date){
            $stmt=$this->conn->prepare('SELECT id,date,status,total_price FROM orders WHERE username=? AND date BETWEEN ? AND ?');
            $stmt->execute([$username,$from_date,$to_date]);
            return $stmt->fetchAll();
        }
     
        public function getAllOrdersWithUsername($username){
            $stmt=$this->conn->prepare('SELECT * FROM orders WHERE username=?');
            $stmt->execute([$username]);
            return $stmt->fetchAll();
        }
        public function getAllOrders(){
            $stmt=$this->conn->prepare('SELECT * FROM orders');
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function cancelOrder($order_id){
            $stmt=$this->conn->prepare('DELETE FROM orders WHERE id= ?');
            $stmt->execute([$order_id]);
            return $stmt->rowCount();
        }
        public function getOrderDetails($order_id){
            $stmt=$this->conn->prepare('SELECT product_id FROM orders_items WHERE order_id= ?');
            $stmt->execute([$order_id]);
            $products=$stmt->fetchAll();
            $order_items=array();
            foreach ($products as $element ){
                $stmt=$this->conn->prepare('SELECT  name,price,image FROM products WHERE id= ?');
                $stmt->execute([$element["product_id"]]);
                $item=$stmt->fetchAll();
                $order_items[]=$item;
            }
            echo (json_encode($order_items));   
        }


        public function getCurrentOrders(){
            $stmt=$this->conn->prepare('SELECT * FROM orders WHERE status=?');
            $stmt->execute([1]);
            return $stmt->fetchAll();
        }
        public function deliverOrder($order_id){
            $stmt=$this->conn->prepare('UPDATE orders SET status=? WHERE id= ?');
            $stmt->execute([3,$order_id]);
            return $stmt->rowCount();
        }

        public function getChecks($from_date,$to_date){
            $stmt=$this->conn->prepare('SELECT username,id,date,SUM(total_price) AS total_price FROM orders WHERE date BETWEEN ? AND ? GROUP BY username');
            $stmt->execute([$from_date,$to_date]);
            return $stmt->fetchAll();
        }
        public function getChecks1($user,$from_date,$to_date){
            $stmt=$this->conn->prepare('SELECT username,id,date,SUM(total_price) AS total_price FROM orders WHERE username=? AND date BETWEEN ? AND ?');
            $stmt->execute([$user,$from_date,$to_date]);
            return $stmt->fetchAll();
        }
        public function getChecks2(){
            $stmt=$this->conn->prepare('SELECT username,id,date,SUM(total_price) AS total_price FROM orders GROUP BY username');
            $stmt->execute();
            return $stmt->fetchAll();
        }
        public function getOrderId($from_date,$to_date){
            $stmt=$this->conn->prepare('SELECT id FROM orders WHERE date BETWEEN ? AND ?');
            $stmt->execute([$from_date,$to_date]);
            return $stmt->fetchAll();
        }
        public function getOrderId1($user,$from_date,$to_date){
            $stmt=$this->conn->prepare('SELECT id FROM orders WHERE username=? AND date BETWEEN ? AND ?');
            $stmt->execute([$user,$from_date,$to_date]);
            return $stmt->fetchAll();
        }
        public function getAllOrderId(){
            $stmt=$this->conn->prepare('SELECT id FROM orders');
            $stmt->execute();
            return $stmt->fetchAll();
        }
        public function getCheckOrder($order_id){
            $stmt=$this->conn->prepare('SELECT username,date,id,total_price FROM orders WHERE id=?');
            $stmt->execute([$order_id]);
            return $stmt->fetchAll();
        }
        
        public function getOrderDetails1($order_id){
            $x=1;
            $stmt=$this->conn->prepare('SELECT product_id FROM orders_items WHERE order_id= ?');
            $stmt->execute([$order_id]);
            $order_items=array();
            while ($element=$stmt->fetch() ){
                $stmt1=$this->conn->prepare('SELECT  name,price,image FROM products WHERE id= ?');
                $stmt1->execute([$element["product_id"]]);
                $item=$stmt1->fetchAll();
                $order_items[$x]=$item;
                $x++;
            }
            return ($order_items);   
        }

        public function getCategory($id){
            $stmt = $this->conn->prepare('select name from category where id = ?');
            $stmt->bindValue(1, $id);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        public function getAllCategories(){
            $stmt = $this->conn->prepare('select * from category');
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

