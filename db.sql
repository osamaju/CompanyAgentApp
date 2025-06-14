CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', '123');
CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `id_survey` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
CREATE TABLE `surveys` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
CREATE TABLE `users_answers` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_quastion` int(11) NOT NULL,
  `id_answer` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
CREATE TABLE `user_answer_state` (
  `id_user` int(11) NOT NULL,
  `id_survey` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO answers VALUES(1,'Yes');
INSERT INTO answers VALUES(2,'No');
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `own_survey` (`id_survey`);
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `users_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `own_quastion` (`id_quastion`),
  ADD KEY `own_id` (`id_user`),
  ADD KEY `own_answer` (`id_answer`),
  ADD KEY `own_survey` (`survey_id`);
ALTER TABLE `user_answer_state`
  ADD KEY `user_answred` (`id_user`),
  ADD KEY `survey_user_answer` (`id_survey`);
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `surveys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `users_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `questions`
  ADD CONSTRAINT `question_survey` FOREIGN KEY (`id_survey`) REFERENCES `surveys` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `users_answers`
  ADD CONSTRAINT `own_answer` FOREIGN KEY (`id_answer`) REFERENCES `answers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `own_id` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `own_quastion` FOREIGN KEY (`id_quastion`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `own_survey` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `user_answer_state`
  ADD CONSTRAINT `survey_user_answer` FOREIGN KEY (`id_survey`) REFERENCES `surveys` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_answred` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
