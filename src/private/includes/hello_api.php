<?php
    class DBConnection extends PDO{
        public final function __construct()
        {
            $user = "root";
            $pwd = "";
            $host = "localhost";
            $dbname = "hello";

            $dsn = "mysql:host=". $host .";dbname=". $dbname;

            // connectton to database
            try{
                parent::__construct($dsn, $user, $pwd);
                $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (PDOException $e){
                echo "connection failed:". $e->getMessage();
            }
        }
    }
    class Conversation{
        function fetchConversations ($first_name, $last_name, $id){
            $query =   "SELECT DISTINCT
                            c.conversation_id, a.id, a.first_name, a.last_name
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
    }
    class Messages{
        function getMessages (int $conversation_id){
            $query  =   "SELECT
                            text_content, media_content, sender_id, timedate
                        FROM 
                            messages
                        WHERE 
                            conversation_id = ?
                        ORDER BY timedate DESC
                        LIMIT 15";
            
            $dbconnect = new DBConnection();
            $stmt = $dbconnect->prepare($query);
            $stmt->execute([$conversation_id]);
            $res = $stmt->fetch();
            return $res;
        }
    }