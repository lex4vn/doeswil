ALTER TABLE `quiz` CHANGE `name` `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `quiz` CHANGE `quiztype` `quiztype` ENUM('Free','Paid','Write') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Free';

ALTER TABLE  `user_quiz_results` ADD  `content_exam` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE  `user_quiz_results_history` ADD  `content_exam` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `user_quiz_results_history` CHANGE `content` `content_exam` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `user_quiz_results` CHANGE `content_exam` `content_exam` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

// Xem xet
ALTER TABLE `questions` CHANGE `questiontype` `questiontype` ENUM('SingleAnswer','MultiAnswer','WriteAnswer','Write') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'SingleAnswer';