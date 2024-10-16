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

    /**
     * Responsible for any functionality relating to account information
     *
     */
    class Accounts{
        /**
         * Registers an account to the application.
         *
         * @param string $fname  The first name of the registrant
         * @param string $lname The last name of the registrant
         * @param string $email The email address of the registrant
         * @param string $password The password of the registrant
         * @param string $birthdate The first name of the registrant
         * @param string $gender The first name of the registrant
         */
        function register(string $fname, string $lname, string $email, string $password, string $birthdate, string$gender){
            $inputs = [$fname, $lname, $email, $password, $birthdate, $gender];
            $error = false;
            for ($i=0; $i < count($inputs); $i++){
                if(empty($inputs[$i])){
                    $error = true;
                    break;
                }
            }
            if (!$error){
                $email_check = "
                        SELECT 
                            email
                        FROM
                            accounts
                        WHERE
                            email = ?
                        ";
                $dbconnect = new DBConnection();
                $email_stmt = $dbconnect->prepare($email_check);
                $email_stmt->execute([$email]);

                if ($email_stmt->rowCount() == 0){
                    $query =   "INSERT INTO 
                            accounts (first_name, last_name, email, pwd, birthdate, gender, join_date) 
                        VALUES
                            (?, ?, ?, ?, ?, ?, UTC_TIMESTAMP())
                        ";
                    $insert_values = [
                        htmlspecialchars($fname),
                        htmlspecialchars($lname),
                        htmlspecialchars($email),
                        password_hash($password, PASSWORD_DEFAULT),
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
                        header("Location: ../public/signup.php?error=3");
                        exit();
                    }
                }
                else{
                    header("Location: ../public/signup.php?error=2");
                    exit();
                }
            }
            else{
                header("Location: ../public/signup.php?error=1");
                exit();
            }
        }

        /**
         * Logs a user in based on the arguments they have provided
         *
         * @param string $email The email address of the user
         * @param string $password The password of the user
         */
        function login (string $email, string $password){
            $query =    "SELECT 
                            email, pwd, id, first_name, last_name 
                        FROM 
                            accounts 
                        WHERE 
                            email = ?
                        ";

            $dbconnect = new DBConnection();
            $stmt = $dbconnect->prepare($query);
            $stmt->execute([$email]);
            $user_cred = $stmt->fetch();
            $error = false;
            $inputs = [$email, $password];
            for ($i=0; $i < count($inputs); $i++){
                if(empty($inputs[$i])){
                    $error = true;
                    break;
                }
            }
            if (!$error){
                if (password_verify($password, $user_cred["pwd"])){
                    $_SESSION["check"] = true;
                    $_SESSION["id"] = $user_cred["id"];
                    $_SESSION["first_name"] = $user_cred["first_name"];
                    $_SESSION["last_name"] = $user_cred["last_name"];
                    $_SESSION["email"] = $user_cred["email"];
                    $dbconnect = new DBConnection();
                    $res =$dbconnect->prepare("UPDATE accounts SET is_online = 1 WHERE id = " . $user_cred["id"]);
                    $res->execute();
                    header("Location: ../public/inbox.php");
                    exit();
                }
                else {
                    header("Location: ../public/homepage.php?error=2");
                    exit();
                }
            }
            else{
                header("Location: ../public/homepage.php?error=1");
                exit();
            }
        }

        /**
         * Logs out a user account from the application
         *
         * @param int $id is the ID of the account in the database
         * @return bool returns the result of the execution of the query
         */
        function logout(int $id){
            $query =    "
                        UPDATE 
                            accounts 
                        SET 
                            is_online = 0
                        WHERE id = ?
                        ";
            $dbconnect = new DBConnection();
            $stmt = $dbconnect->prepare($query);
            return $stmt->execute([$id]);
        }
    }

    /**
     * Responsible for any functionality pertaining to the conversations that the user has
     */
    class Conversation{
        /**
         * Fetches all conversations that the user has
         *
         * @param string $first_name First name of the user
         * @param string $last_name Last name of the user
         * @param int $id Account ID of the user
         * @param int $limit The maximum number of conversations to be fetched
         * @param int $status Checks if the other user is online or offline
         * @param string $search_val The value in the search bar that is used to filter conversations
         */
        function fetchConversations (string $first_name, string $last_name, int $id, int $limit, int $status, string $search_val){
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
                            AND status = ?
                            AND CONCAT(a.first_name, ' ', a.last_name) LIKE CONCAT(?, '%')
                        ORDER BY c.last_interacted DESC
                        LIMIT $limit
                        ";

            // Executes the query for getting all conversations
            $dbconnect = new DBConnection();
            $stmt = $dbconnect->prepare($query);
            $stmt->execute([$first_name, $last_name, $id, $id, $status, $search_val]);
            return $stmt;    
        }

        /**
         * Retrieves the latest message that the logged-in user sent or the other user for the conversation list
         *
         * @param int $conversation_id The conversation ID of the logged-in user and the other user
         * @return mixed An array containing the text, media, sender ID, and time of the message
         */
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

        /**
         * Generates a unique code
         *
         * @return string A code of random letters and characters
         */
        function codeGenerator (){
            $chars = "123456789qwertyuiopasdfghjklzxcvbnm!@#$%^&*?";
            $otp = "";

            for($i = 0; $i < 6; $i++){
                $otp .= substr($chars, rand(0, strlen($chars) - 1), 1);
            }
            return $otp;
        }

        /**
         * Responsible for generating the code and putting it in the database
         *
         * @param int $id The account ID of the user
         * @return string The code generated
         */
        function generateNewConversationCode(int $id){
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

        /**
         * Deletes the conversation code in the database
         *
         * @param string $otp The code that is generated
         */
        function deleteNewConversationCode(string $otp){
            $query =   "DELETE FROM
                            otp_new_conversation
                        WHERE
                            code = ? 
                       ";
            $dbconnect = new DBConnection();
            $stmt = $dbconnect->prepare($query);
            $stmt->execute([$otp]);
        }

        /**
         * Gets the sender ID from the generated code
         *
         * @param string $otp The code that is generated by the one of the users
         */
        function getSenderIDFromCode(string $otp){
            $query =   "SELECT
                            sender_id
                        FROM
                            otp_new_conversation
                        WHERE
                            code = ?
                       ";
            $dbconnect = new DBConnection();
            $stmt = $dbconnect->prepare($query);
            $stmt->execute([$otp]);
            $res = $stmt->fetchAll();
            return $res;
        }

        /**
         * Adds the conversation to the database
         *
         * @param int $id1 The ID of the user
         * @param int $id2 The ID of the other user
         */
        function addNewConversation(int $id1, int $id2){
            $query =   "INSERT INTO
                            conversations(user1, user2, last_interacted)
                        VALUES 
                            (?, ?, UTC_TIMESTAMP()) 
                       ";
            $dbconnect = new DBConnection();
            $stmt = $dbconnect->prepare($query);
            $stmt->execute([$id1, $id2]);
        }

        /**
         * Relegates the conversation to the archives
         *
         * @param int $conversation_id The ID of the conversation in the database
         */
        function archiveMessage(int $conversation_id){
            $query =   "UPDATE
                            conversations
                        SET
                            status = 1
                        WHERE
                            conversation_id = ?
                       ";
            $dbconnect = new DBConnection();
            $stmt = $dbconnect->prepare($query);
            $res = $stmt->execute([$conversation_id]);
            return $res;
        }
    }

    /**
     * Responsible for retrieving and sending messages to the conversation
     */
    class Messages{
        /**
         * Gets all the messages of the conversation
         *
         * @param int $conversation_id The ID of the conversation in the database
         * @param int $message_limit The maximum number of messages to be shown
         */
        function getMessages (int $conversation_id, int $message_limit){
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

        /**
         * Gets the name of the other user in the conversation
         *
         * @param int $conversation_id The ID of the conversation in the database
         * @param int $user_id The ID of the user in the database
         */
        function getRecepientName (int $conversation_id, int $user_id){
            $query  =   "SELECT DISTINCT
                            a.first_name, a.last_name, a.is_online, c.status
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

        /**
         * Sends a message to the other user
         *
         * @param int $sender_id The account ID of the sender
         * @param int $receiver_id The account ID of the receiver
         * @param string $text_content The text message that is being sent
         * @param int $conversation_id The ID of the conversation in the database
         */
        function sendMessage($sender_id, $receiver_id, $text_content, $conversation_id)
        {
            $query =   "INSERT INTO 
                            messages (sender_id, receiver_id, text_content, timedate, conversation_id) 
                        VALUES
                            (?, ?, ?, UTC_TIMESTAMP(), ?)
                        ";
            $dbconnect = new DBConnection();
            $stmt = $dbconnect->prepare($query);
            $isExecuted = $stmt->execute([$sender_id, $receiver_id, htmlspecialchars($text_content), $conversation_id]);
            if ($isExecuted){
                $stmt2 = $dbconnect->prepare("UPDATE conversations SET last_interacted = UTC_TIMESTAMP() WHERE conversation_id = ?");
                $stmt2->execute([$conversation_id]);
            }
            return $stmt;
        }

        /**
         * Gets the latest message that is sent by the other user
         *
         * @param int $conversation_id The ID of the conversation in the database
         */
        function getLatestMessagesReceived(int $conversation_id){
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

        /**
         * Gets the previous messages that is not fetched in the getMessages() function
         *
         * @param int $conversation_id The ID of the conversation in the database
         * @param int $offset The count of rows that will be skipped in fetching the messages in the database
         */
        function getPreviousMessages (int $conversation_id, int $offset){
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