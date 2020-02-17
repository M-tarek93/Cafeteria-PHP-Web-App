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

        private function connectDB(){
            try {
                $this->conn = new PDO(self::dsn, self::user, self::pass, self::options);
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
        }
        private function disconnectDB(){
            $this->conn = null;
        }
        public function insertUser($usernaem, $password, $email, $room, $ext, $profilePic, $role=0) : int {
            $this->connectDB();
            $sql = "INSERT INTO users( username, password, email, room, ext, profile_pic, role) values(?,?,?,?,?,?,?);";
            try{
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue( 1, $usernaem );
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

    }

