    SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
    START TRANSACTION;
    SET time_zone = "+00:00";
    --
    -- Database: `hello`
    --

    -- --------------------------------------------------------

    --
    -- Table structure for table `accounts`
    --

    CREATE TABLE `accounts` (
      `id` int(11) NOT NULL,
      `first_name` varchar(25) NOT NULL,
      `last_name` varchar(25) NOT NULL,
      `email` varchar(50) NOT NULL,
      `pwd` varchar(255) NOT NULL,
      `birthdate` date NOT NULL,
      `gender` tinyint(4) NOT NULL COMMENT '1 for male, 2 for female, 3 for other',
      `gender_details` text DEFAULT NULL COMMENT 'In case the user selects the "other" option in registration',
      `pronouns` text COMMENT 'In case the user selects the "other" option in registration',
      `join_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'in UTC timezone',
      `is_online` tinyint(1) NOT NULL DEFAULT 0
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    --
    -- Dumping data for table `accounts`
    -- All password values are just password
    --

    INSERT INTO `accounts` (`id`, `first_name`, `last_name`, `email`, `pwd`, `birthdate`, `gender`, `gender_details`, `pronouns`, `join_date`, `is_online`) VALUES
    (57, 'Mary', 'Elsher', 'mary@email.com', '$2y$10$PKwibnpKjeowXcq4IBwJH.x5SFYHoGSTV.MAJQsjrSWcYIeHdB0l.', '1995-07-12', 1, NULL, '', '2024-10-17 22:57:23', 0),
    (58, 'James', 'Collymore', 'james@email.com', '$2y$10$kSiwfbrHHsmuEy6T92mwb.UT2k7pahcKau0d55Ji3G8wRry6P1gDq', '1998-02-25', 0, NULL, '', '2024-10-17 22:57:23', 0),
    (59, 'Michael', 'Stoll', 'michael@email.com', '$2y$10$N3xC2xzoN48Q.p0Kd5Z5OeLeaER2y6fuagNMUe0bZFt6j.lsHXro2', '1997-11-09', 0, NULL, '', '2024-10-17 22:57:23', 0),
    (60, 'Patricia', 'Solace', 'patricia@email.com', '$2y$10$IWSccQz.X7Q22gXqOLh63OWnVHy4ipVJ5GIN3L1UFFVWxO6321kQq', '1996-03-17', 1, NULL, '', '2024-10-17 22:57:23', 0),
    (61, 'Robert', 'Verlice', 'robert@email.com', '$2y$10$ITTMDgF7YKASaZxeAOXqKudVTCItkusbERHYahBFcYjMZfoYmruy.', '1999-05-04', 0, NULL, '', '2024-10-17 22:57:23', 0),
    (62, 'Jennifer', 'Levine', 'jennifer@email.com', '$2y$10$/4e..FaeIeYdQiexv63F5eaT6Fl2e6E3zwuHktfXMb/5c7OZETOYa', '1994-08-28', 1, NULL, '', '2024-10-17 22:57:23', 0),
    (63, 'David', 'Adler', 'david@email.com', '$2y$10$Q9ZHvj97/8qvl/U1ne3p/uxPCzOpFP6XPB4GYm7q24ld0v/ygkjWy', '1998-01-01', 0, NULL, '', '2024-10-17 22:57:23', 0),
    (64, 'Elizabeth', 'Raven', 'elizabeth@email.com', '$2y$10$3fF6qxAEwNbwLsFi.LvviOSt.UXAuUPeftaxQt9lpleWgNM5PPGf2', '1996-06-30', 1, NULL, '', '2024-10-17 22:57:24', 0),
    (65, 'William', 'Huxley', 'william@email.com', '$2y$10$eokf6IBdDdTxdqB8QB9BmOGMfxRD0a/ohct4zw53vVL10pLuS1IyW', '1997-12-15', 0, NULL, '', '2024-10-17 22:57:24', 0),
    (66, 'Barbara', 'Amos', 'barbara@email.com', '$2y$10$tIKn0GEOf/2I9V6i2.vLCuPnG.jU74jM7.EA6Wxs27eyajbxX6LnG', '1995-09-22', 1, NULL, '', '2024-10-17 22:57:24', 0),
    (67, 'Richard', 'Beam', 'richard@email.com', '$2y$10$8thBB67x4ES6XLQ1SqRSE.HFYJqDj168xQhkV/AaZen0FXxG9IYhO', '1999-04-07', 0, NULL, '', '2024-10-17 22:57:24', 0),
    (68, 'Susan', 'Dash', 'susan@email.com', '$2y$10$gI80AS6BKo4rLJDStDa9zeQrusAHve83zNZnanhEUeiyKHPazUnTu', '1998-08-19', 1, NULL, '', '2024-10-17 22:57:24', 0),
    (69, 'Joseph', 'Duke', 'joseph@email.com', '$2y$10$nqCz28X9ynP.NezKdvN42.amfxjmDndyLHTTreOxEYXHAKqpVm5wK', '1996-03-05', 0, NULL, '', '2024-10-17 22:57:24', 0),
    (70, 'Jessica', 'Fleet', 'jessica@email.com', '$2y$10$uiyCMyGnl5FT3uvfDOfEe.dD6cgvPZyrrJfUQJ3ncX03WI9eXPp4.', '1997-11-26', 1, NULL, '', '2024-10-17 22:57:24', 0),
    (71, 'Thomas', 'Moses', 'thomas@email.com', '$2y$10$EEN9/HrBxajtCZ4ai.vxf.uo7ezBd6MWWdTscep0XddT7orxuFnTC', '1995-02-13', 0, NULL, '', '2024-10-17 22:57:24', 0),
    (72, 'Karen', 'Pierce', 'karen@email.com', '$2y$10$JU/m0pFEUz8B5hI3E4FQ4OkkvOYfxaoRgqPRkP.uyqzPLzQcDI6zC', '1998-07-08', 1, NULL, '', '2024-10-17 22:57:24', 0),
    (73, 'Christopher', 'Remington', 'christopher@email.com', '$2y$10$APLTp9mbaDpvWfd27WBlBO21izT7vJcKZl7OLiZpwengw64HEKr2m', '1996-11-20', 0, NULL, '', '2024-10-17 22:57:24', 0),
    (74, 'Sarah', 'Sharp', 'sarah@email.com', '$2y$10$hwqDkijq1I2r0luvCtARyOPQtPMjmgyXeQUq1xIMbXhCOt162e3ge', '1999-05-03', 1, NULL, '', '2024-10-17 22:57:24', 0),
    (75, 'Charles', 'Stallard', 'charles@email.com', '$2y$10$rFmud/J77LUBC4xESqz3hOJNl.jg5oVW5wtXyZTb2e5VfkV028p1S', '1994-02-27', 0, NULL, '', '2024-10-17 22:57:24', 0),
    (76, 'Lisa', 'West', 'lisa@email.com', '$2y$10$7wHF4HA1g0vvMLGgxlTcVezT0tcY9hrh5K3C27eINPgF5c8yOGg8q', '1997-09-14', 1, NULL, '', '2024-10-17 22:57:24', 0),
    (77, 'Daniel', 'Crawford', 'daniel@email.com', '$2y$10$Hvx5tN.AwmNBqTmYSg6VtuvZp6Gs4S6wYxMSDGYy1Bk4tYnXT4Pw6', '1995-08-31', 0, NULL, '', '2024-10-17 22:57:24', 0),
    (78, 'Nancy', 'Cunningham', 'nancy@email.com', '$2y$10$jmX4IGwdFHAerb80l25OEO3Mk7I3GpfeuDnw8nj9zJajkbwBmw/hK', '1998-04-16', 1, NULL, '', '2024-10-17 22:57:25', 0),
    (79, 'Matthew', 'Driscoll', 'matthew@email.com', '$2y$10$TKYq5qHUhb52VUH2O3W9zu.jvLQ.ItTLP4GbnwxzpEYTquOpNGpQi', '1996-03-02', 0, NULL, '', '2024-10-17 22:57:25', 0),
    (80, 'Sandra', 'Ellis', 'sandra@email.com', '$2y$10$1PwhsmVcMeeeX8gzwHMBc.qo2YlppaT3Mrk4t1kmtXVRYWyA6ySu.', '1997-11-29', 1, NULL, '', '2024-10-17 22:57:25', 0),
    (81, 'Anthony', 'Finch', 'anthony@email.com', '$2y$10$/Lp4udpSz88kLTzsqPz/hukVmgWz72YdvL7lckJtJowBaCLbOeGoC', '1995-07-10', 0, NULL, '', '2024-10-17 22:57:25', 0),
    (82, 'Betty', 'Webb', 'betty@email.com', '$2y$10$iDbGXnkfQo8rkKhk6xFlgeKWEqWZYoJTRRDyQHzdsorS/sjO480lO', '1998-02-06', 1, NULL, '', '2024-10-17 22:57:25', 0),
    (83, 'Mark', 'Simmons', 'mark@email.com', '$2y$10$mYsj1ceFDNYavABr1fvAUO9kX9RTKjV1JE51e9JMXym4QYnKUa1U6', '1996-11-18', 0, NULL, '', '2024-10-17 22:57:25', 0),
    (84, 'Ashley', 'Ashford', 'ashley@email.com', '$2y$10$oCC6Lbq0raW0jQnMrrF9cOnOelFEhHgKRqaS2GB6GQujsat5fco9i', '1999-05-01', 1, NULL, '', '2024-10-17 22:57:25', 0),
    (85, 'Donald', 'Griffin', 'donald@email.com', '$2y$10$P9ZhioC9I6xQa7a1eENTceSTP.ThQzb6GjeaD8Shy2UNRbDRQZwjS', '1994-08-24', 0, NULL, '', '2024-10-17 22:57:25', 0),
    (86, 'Emily', 'Whitlock', 'emily@email.com', '$2y$10$3MvGfKUrZyqJkXK78zFSduS./EkIyo.xUcm2pct.sU/dvH5RgwaSa', '1997-09-11', 1, NULL, '', '2024-10-17 22:57:25', 0);

    -- --------------------------------------------------------

    --
    -- Table structure for table `conversations`
    --

    CREATE TABLE `conversations` (
      `conversation_id` int(11) NOT NULL,
      `user1` int(11) NOT NULL,
      `user2` int(11) NOT NULL,
      `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 for active, 1 for archived, ',
      `last_interacted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    -- --------------------------------------------------------

    --
    -- Table structure for table `messages`
    --

    CREATE TABLE `messages` (
      `message_id` int(11) NOT NULL,
      `sender_id` int(11) NOT NULL,
      `receiver_id` int(11) NOT NULL,
      `text_content` text NOT NULL,
      `media_content` text,
      `timedate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
      `conversation_id` int(11) NOT NULL,
      `is_seen` tinyint(1) NOT NULL DEFAULT 0,
      `is_media` tinyint(1) NOT NULL DEFAULT 0
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    -- --------------------------------------------------------

    --
    -- Table structure for table `otp_new_conversation`
    --

    CREATE TABLE `otp_new_conversation` (
      `code` varchar(6) NOT NULL COMMENT 'code generated',
      `sender_id` int(11) NOT NULL COMMENT 'user starting new conversation'
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    --
    -- Indexes for dumped tables
    --

    --
    -- Indexes for table `accounts`
    --
    ALTER TABLE `accounts`
      ADD PRIMARY KEY (`id`);

    --
    -- Indexes for table `conversations`
    --
    ALTER TABLE `conversations`
      ADD PRIMARY KEY (`conversation_id`),
      ADD KEY `user1` (`user1`),
      ADD KEY `user2` (`user2`);

    --
    -- Indexes for table `messages`
    --
    ALTER TABLE `messages`
      ADD PRIMARY KEY (`message_id`),
      ADD KEY `conversation_id` (`conversation_id`),
      ADD KEY `sender_id` (`sender_id`),
      ADD KEY `receiver_id` (`receiver_id`);

    --
    -- Indexes for table `otp_new_conversation`
    --
    ALTER TABLE `otp_new_conversation`
      ADD KEY `sender_id` (`sender_id`);

    --
    -- AUTO_INCREMENT for dumped tables
    --

    --
    -- AUTO_INCREMENT for table `accounts`
    --
    ALTER TABLE `accounts`
      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

    --
    -- AUTO_INCREMENT for table `conversations`
    --
    ALTER TABLE `conversations`
      MODIFY `conversation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

    --
    -- AUTO_INCREMENT for table `messages`
    --
    ALTER TABLE `messages`
      MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

    --
    -- Constraints for dumped tables
    --

    --
    -- Constraints for table `conversations`
    --
    ALTER TABLE `conversations`
      ADD CONSTRAINT `conversations_ibfk_1` FOREIGN KEY (`user1`) REFERENCES `accounts` (`id`),
      ADD CONSTRAINT `conversations_ibfk_2` FOREIGN KEY (`user2`) REFERENCES `accounts` (`id`);

    --
    -- Constraints for table `messages`
    --
    ALTER TABLE `messages`
      ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`conversation_id`);

    --
    -- Constraints for table `otp_new_conversation`
    --
    ALTER TABLE `otp_new_conversation`
      ADD CONSTRAINT `otp_new_conversation_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `accounts` (`id`);
    COMMIT;

    /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
    /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
    /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
