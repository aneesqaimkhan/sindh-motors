
DROP TABLE IF EXISTS `members`;

CREATE TABLE `members` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `member_name` varchar(100) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `cnic_no` varchar(15) NOT NULL,
  `cell_no` varchar(15) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cnic_no` (`cnic_no`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `members` */

insert  into `members`(`id`,`member_name`,`father_name`,`cnic_no`,`cell_no`,`profile_picture`,`status`,`created_at`,`updated_at`,`user_id`) values 
(1,'Ahmed Khan','Muhammad Khan','1234567890123','03001234567',NULL,'active','2025-08-17 07:58:35','2025-08-17 07:58:35',3),
(2,'Fatima Ali','Hassan Ali','2345678901234','03012345678',NULL,'active','2025-08-17 07:58:35','2025-08-17 07:58:35',3),
(3,'Usman Ahmed','Ahmed Raza','3456789012345','03023456789',NULL,'inactive','2025-08-17 07:58:35','2025-08-17 07:58:35',3),
(4,'Ayesha Khan','Khalid Khan','4567890123456','03034567890',NULL,'active','2025-08-17 07:58:35','2025-08-17 07:58:35',2),
(5,'Muhammad Hassan','Abdul Hassan','5678901234567','03045678901',NULL,'active','2025-08-17 07:58:35','2025-08-17 07:58:35',2),
(6,'Awais','Sardar','4410249882431','03333636333','1755429162_62fd110b4d4c8a20c5f1.png','active','2025-08-17 11:12:42','2025-08-17 11:12:42',3),
(7,'Zain ','Khan','4444444444444','03153135090','1755429162_93ff6ccce361ed5db285.jpeg','active','2025-08-17 11:12:42','2025-08-17 11:12:42',10),
(9,'Awais','876876','4410249882432','03333636333','1755431909_f5350cf9a652b57c67be.png','active','2025-08-17 11:58:29','2025-08-17 11:58:29',15),
(10,'Lareina Shields','Aileen Greer','4410249882433','03333636333','1755432396_17f8506f1db5fc213b4e.png','active','2025-08-17 12:06:36','2025-08-17 12:06:36',17),
(11,'Patricia Henderson','Felicia Ford','4444444444445','03153135092','1755432396_c186ccfaa6818aa4bf8a.jpeg','active','2025-08-17 12:06:36','2025-08-17 12:06:36',17),
(12,'Jane Newman','Martena Sampson','4410249882421','03333636333','1755433476_9b198c59e33db7e8ed51.png','active','2025-08-17 12:24:36','2025-08-17 12:24:36',18),
(13,'Tatyana Clayton','Blake Salinas','4410249882422','03153135090','1755433476_a42cd13eb8eaf9c3dc96.jpeg','active','2025-08-17 12:24:36','2025-08-17 12:24:36',18),
(14,'Claudia Mayer','Amos Langley','4410249882423','03153135090','1755433476_79af495a617fda64a99d.png','active','2025-08-17 12:24:36','2025-08-17 12:24:36',18),
(17,'gdfkbk','kjkj','4410249884561','03333636333','1755439941_d285c5a097982d25111e.png','active','2025-08-17 14:12:21','2025-08-17 14:17:03',22);

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`version`,`class`,`group`,`namespace`,`time`,`batch`) values 
(1,'2024-01-01-000001','App\\Database\\Migrations\\CreateUsersTable','default','App',1755416622,1),
(2,'2024-01-01-000002','App\\Database\\Migrations\\CreateMembersTable','default','App',1755416622,1),
(3,'2024-01-01-000003','App\\Database\\Migrations\\UpdateUsersTable','default','App',1755428047,2),
(4,'2024-01-01-000004','App\\Database\\Migrations\\AddShowroomFieldsToUsers','default','App',1755428047,2),
(5,'2024-01-01-000005','App\\Database\\Migrations\\AddUserIdToMembers','default','App',1755428047,2),
(6,'2024-01-01-000006','App\\Database\\Migrations\\UpdateCategoryField','default','App',1755428521,3),
(7,'2024-01-01-000007','App\\Database\\Migrations\\UpdateStatusFieldInUsers','default','App',1755431640,4);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `cnic_no` varchar(15) NOT NULL,
  `cell_no` varchar(15) NOT NULL,
  `date_of_birth` date NOT NULL,
  `category_id` varchar(50) DEFAULT NULL,
  `status` enum('active','inactive','pending') DEFAULT 'pending',
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `showroom_name` varchar(255) DEFAULT NULL,
  `showroom_address` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cnic_no` (`cnic_no`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`fname`,`cnic_no`,`cell_no`,`date_of_birth`,`category_id`,`status`,`email`,`username`,`password`,`created_at`,`updated_at`,`is_admin`,`showroom_name`,`showroom_address`) values 
(1,'Anees','Sardar','4410249882431','03153135090','2025-08-19','1','active','anees@example.com','anees','$2y$10$blmJDZ8mAYkTShG16GXQO.1YQQvlWGk/Bek0tZJk9i5T4QLLQfh0m','2025-08-17 07:45:28','2025-08-17 09:34:19',0,NULL,NULL),
(2,'Admin User','Admin Father','1234567890123','03001234567','1990-01-01','1','active','admin@example.com','admin','$2y$10$5Hbs5h1EoLMLOSOfsUvEBuuorVd2BYmK0KxoZ/nVVB7VZ.MnMcI9a','2025-08-17 07:47:02','2025-08-17 07:47:02',0,NULL,NULL),
(3,'Hamza','abc','4410249882432','03153135090','2025-08-20','1','active','hamza@example.com','hamza','$2y$10$O14k7rTzLIg/IutqWE2ceeCMt/dxIWwKnzR779VmL1JO1WZnJtage','2025-08-17 09:36:08','2025-08-17 09:36:08',0,NULL,NULL),
(4,'Anees','Xyz','4410249882433','03153135090','2025-08-21',NULL,'active','abc@example.com','abc','$2y$10$TYoKzNlt5axI9pSUP/E.3uVrTG/VixDFuzOg3ItakZi4c1hpSNCly','2025-08-17 10:18:50','2025-08-17 14:18:06',0,'Anees','Hyderbad pakistan'),
(7,'Admin User','System Administrator','9999999999999','03001234567','1990-01-01',NULL,'active','admin@admin.com','superadmin','$2y$10$dI3pMpTvM8vqv4YY7C1VB.v9hIdNla0BvhJZvzB5ZY7HUcblMrZYq','2025-08-17 10:55:03','2025-08-17 10:55:03',1,'System Administration','System Address'),
(10,'Anees','Khan','4410249882436','03153135090','2025-07-31','golden','active','hamza1@example.com','','','2025-08-17 11:12:42','2025-08-17 11:15:47',0,'Hamza','Hyderabad SIndh Pakistan'),
(15,'Justin Ford','Yoko Howe','4410249882430','03153135090','2002-02-14','silver','active','wepihavim@mailinator.com','justinford','$2y$10$KbMyFDw029SVVcyZMZeUouPXoBEbab/zNcVKbXfDSMX3fSsTkjpAy','2025-08-17 11:58:29','2025-08-17 12:08:30',0,'Judah Wagner','Exercitation illo po'),
(17,'Uriel Mccormick','Alfreda Johnson','4410249882438','03153135091','1990-05-29','golden','inactive','dylehivo@mailinator.com','urielmccormick','$2y$10$VoqFprb6HsWvZIXLaUPF8.BAVlLkYQiqjUV.Dhnkfjs8YYh7HClOW','2025-08-17 12:06:36','2025-08-17 12:08:14',0,'Sonia Carrillo','Nostrud rerum est vo'),
(18,'Frances Nieves','Castor Wilkerson','4410249882490','03153135090','2012-04-14','platinum','active','doxoka@mailinator.com','francesnieves','$2y$10$MABMUiHEr7Q7LPNvLhGiAOJwla2VGOMcwvH.QpRfDs/O8OtEnI8pW','2025-08-17 12:24:36','2025-08-17 12:25:09',0,'Dexter Donaldson','Recusandae Cupidita'),
(22,'Sajid','Devin Taylor','4410249882456','03153135090','1978-01-03','silver','active','javo@mailinator.com','sajid','$2y$10$WBAWI05RjuGJ530imHtc2Obl4f4FFUGTme9P.ohKjdP.t4VMGCPKC','2025-08-17 14:12:21','2025-08-17 14:17:03',0,'Sajid Motors','Est est aut sit qui');