<?php
    include_once("dbconnect.php");
    class Conversation{
        function messagePreview (int $conversation_id){
            $query  =   "SELECT
                            text_content, media_content
                        FROM 
                            messages
                        WHERE 
                            conversation_id = ?
                        ORDER BY time DESC
                        LIMIT 1";
            $dbconnect = new DBConnection();
            $stmt = $dbconnect->prepare($query);
            $stmt->execute([$conversation_id]);
            $res = $stmt->fetch();
            return $res["text_content"];
        }
        function messageTime (int $id, int $conversation_id){

        }
    }