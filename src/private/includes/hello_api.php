<?php
    class DBConnection extends PDO{
        public final function __construct()
        {
            $user = "root";
            $pwd = "";
            $host = "localhost";
            $dbname = "hello";

            $dsn = "mysql:host=". $host .";dbname=". $dbname;

            // connection to database
            try{
                parent::__construct($dsn, $user, $pwd);
                $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (PDOException $e){
                echo "connection failed:". $e->getMessage();
            }
        }
    }
    class Accounts{
        function register($fname, $lname, $email, $password, $birthdate, $gender){
            $query =   "INSERT INTO 
                            accounts (first_name, last_name, email, pwd, birthdate, gender, join_date) 
                        VALUES
                            (?, ?, ?, ?, ?, ?, UTC_TIMESTAMP())
                        ";
            $insert_values = [
                htmlspecialchars($fname),
                htmlspecialchars($lname),
                htmlspecialchars($email),
                htmlspecialchars($password),
                $birthdate,
                $gender
            ];
            
            $dbconnect = new DBConnection();
            $stmt = $dbconnect->prepare($query);
            $execute_status = $stmt->execute($insert_values);
            
            if ($execute_status){
                header("Location: ../public/homepage.php");
            }
            else{
                echo "failed";
            }
        }
        function login ($email, $password){
            $query =    "SELECT 
                            email, pwd, id, first_name, last_name 
                        FROM 
                            accounts 
                        WHERE 
                            email = ? AND pwd = ?
                        ";

            $dbconnect = new DBConnection();
            $stmt = $dbconnect->prepare($query);
            $stmt->execute([$email, $password]);
            $user_cred = $stmt->fetch();
            if ($user_cred){
                $_SESSION["check"] = true;
                $_SESSION["id"] = $user_cred["id"];
                $_SESSION["first_name"] = $user_cred["first_name"];
                $_SESSION["last_name"] = $user_cred["last_name"];
                header("Location: ../public/inbox.php");
                exit();
            }
            else {
                header("Location: ../public/homepage.php");
                exit();
            }
        }
    }
    class Conversation{
        function fetchConversations ($first_name, $last_name, $id){
            $query =   "SELECT DISTINCT
                            c.conversation_id, a.id, a.first_name, a.last_name, c.last_interacted
                        FROM
                            accounts a
                        INNER JOIN
                            conversations c ON c.user1 = a.id OR c.user2 = a.id
                        WHERE 
                            (
                                (a.first_name <> ?) 
                                OR (a.last_name <> ?)
                            ) 
                            AND 
                            (
                                (c.user1 = ?) 
                                OR (c.user2 = ?)
                            )
                        ORDER BY c.last_interacted DESC
                        ";

            // Executes the query for getting all conversations
            $dbconnect = new DBConnection();
            $stmt = $dbconnect->prepare($query);
            $stmt->execute([$first_name, $last_name, $id, $id]);
            return $stmt;    
        }
        function messagePreview (int $conversation_id){
            $query  =   "SELECT
                            text_content, media_content, sender_id, timedate
                        FROM 
                            messages
                        WHERE 
                            conversation_id = ?
                        ORDER BY timedate DESC
                        LIMIT 1";
                        
            $dbconnect = new DBConnection();
            $stmt = $dbconnect->prepare($query);
            $stmt->execute([$conversation_id]);
            $res = $stmt->fetch();
            return $res;
        }
        function codeGenerator (){
            $chars = "123456789qwertyuiopasdfghjklzxcvbnm!@#$%^&*?";
            $otp = "";

            for($i = 0; $i < 6; $i++){
                $otp .= substr($chars, rand(0, strlen($chars) - 1), 1);
            }
            return $otp;
        }
        function generateNewConversationCode($id){
            $otp = $this->codeGenerator();
            $query =   "INSERT INTO
                            otp_new_conversation(code, sender_id)
                        VALUES 
                            (?, ?)
                       ";
            $dbconnect = new DBConnection();
            $stmt = $dbconnect->prepare($query);
            $res = $stmt->execute([$otp, $id]);
            if ($res){
                return $otp;
            }
        }
        function deleteNewConversationCode($otp){
            $query =   "DELETE FROM
                            otp_new_conversation
                        WHERE
                            code = ? 
                       ";
            $dbconnect = new DBConnection();
            $stmt = $dbconnect->prepare($query);
            $stmt->execute([$otp]);
        }
        function getSenderIDFromCode($code){
            $query =   "SELECT
                            sender_id
                        FROM
                            otp_new_conversation
                        WHERE
                            code = ?
                       ";
            $dbconnect = new DBConnection();
            $stmt = $dbconnect->prepare($query);
            $stmt->execute([$code]);
            $res = $stmt->fetchAll();
            return $res;
        }
        function addNewConversation($id1, $id2){
            $query =   "INSERT INTO
                            conversations(user1, user2)
                        VALUES 
                            (?, ?) 
                       ";
            $dbconnect = new DBConnection();
            $stmt = $dbconnect->prepare($query);
            $stmt->execute([$id1, $id2]);
        }
    }
    class Messages{
        function getMessages ($conversation_id, int $message_limit){
            $query  =   "SELECT
                            message_id, text_content, media_content, sender_id, receiver_id, timedate
                        FROM 
                            messages
                        WHERE 
                            conversation_id = ?
                        ORDER BY timedate DESC
                        LIMIT $message_limit
                        ";
            
            $dbconnect = new DBConnection();
            $stmt = $dbconnect->prepare($query);
            $stmt->execute([$conversation_id]);
            return $stmt;
        }
        function getRecepientName (int $conversation_id, int $user_id){
            $query  =   "SELECT DISTINCT
                            a.first_name, a.last_name
                        FROM
                            accounts a
                        INNER JOIN
                            conversations c ON c.user1 = a.id OR c.user2 = a.id
                        WHERE 
                            c.conversation_id = ? 
                        AND 
                            a.id != ?;
                            ";

            $dbconnect = new DBConnection();
            $stmt = $dbconnect->prepare($query);
            $stmt->execute([$conversation_id, $user_id]);
            return $stmt;
        }
        function sendMessage($sender_id, $receiver_id, $text_content, $conversation_id)
        {
            $query =   "INSERT INTO 
                            messages (sender_id, receiver_id, text_content, timedate, conversation_id) 
                        VALUES
                            (?, ?, ?, UTC_TIMESTAMP(), ?)
                        ";
            $dbconnect = new DBConnection();
            $stmt = $dbconnect->prepare($query);
            $isExecuted = $stmt->execute([$sender_id, $receiver_id, $text_content, $conversation_id]);
            if ($isExecuted){
                $stmt2 = $dbconnect->prepare("UPDATE conversations SET last_interacted = UTC_TIMESTAMP() WHERE conversation_id = $conversation_id");
                $stmt2->execute();
            }
            return $stmt;
        }
        function getLatestMessagesReceived($conversation_id){
            $query  =   "SELECT
                            message_id, text_content, media_content, sender_id, timedate
                        FROM 
                            messages
                        WHERE 
                            conversation_id = ?
                        ORDER BY timedate DESC
                        LIMIT 1";

            $dbconnect = new DBConnection();
            $stmt = $dbconnect->prepare($query);
            $stmt->execute([$conversation_id]);
            $res = $stmt->fetch();
            return $res;
        }
        function getPreviousMessages ($conversation_id, int $offset){
            $query  =   "SELECT
                            message_id, text_content, media_content, sender_id, receiver_id, timedate
                        FROM 
                            messages
                        WHERE 
                            conversation_id = ?
                        ORDER BY timedate DESC
                        LIMIT 15 OFFSET $offset";

            $dbconnect = new DBConnection();
            $stmt = $dbconnect->prepare($query);
            $stmt->execute([$conversation_id]);
            return $stmt;
        }
    }