<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

DEBUG - 2025-08-29 05:02:48 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 05:02:48 --> No URI present. Default controller set.
DEBUG - 2025-08-29 05:02:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 10:32:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 10:32:50 --> Total execution time: 2.1426
DEBUG - 2025-08-29 05:02:54 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 05:02:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 10:32:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2025-08-29 10:32:54 --> Severity: Notice --> Undefined variable: rememberme D:\wamp64\www\climateplus\application\controllers\Login.php 46
ERROR - 2025-08-29 10:32:54 --> Severity: Notice --> session_write_close(): Skipping numeric key 0 Unknown 0
DEBUG - 2025-08-29 05:02:54 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 05:02:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 10:32:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 10:32:55 --> Total execution time: 0.5329
DEBUG - 2025-08-29 05:03:00 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 05:03:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 09:03:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 09:03:00 --> Date: 2025-08-29
ERROR - 2025-08-29 09:03:00 --> Query error: Incorrect DATE value: 'Admin' - Invalid query: SELECT `jm`.*, `jt`.`report_abbr`, `cm`.`cust_name`, `u1`.`user_name` as `sales`, `u2`.`user_name` as `staff`
FROM `job_master` `jm`
LEFT JOIN `job_types` `jt` ON `jm`.`job_type` = `jt`.`id`
LEFT JOIN `customer_master` `cm` ON `jm`.`customer` = `cm`. `customer_id`
LEFT JOIN `users` `u1` ON `jm`.`sales` = `u1`.`user_id`
LEFT JOIN `users` `u2` ON `jm`.`staff_assign` = `u2`.`user_id`
WHERE `completed` = 0
AND `job_date` = 'Admin'
AND `cancelled` = 0
ORDER BY `job_id` DESC
ERROR - 2025-08-29 09:03:00 --> Severity: error --> Exception: Call to a member function result() on bool D:\wamp64\www\climateplus\application\models\Operations_model.php 396
DEBUG - 2025-08-29 05:03:08 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 05:03:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 09:03:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 09:03:09 --> Total execution time: 0.4652
DEBUG - 2025-08-29 05:07:41 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 05:07:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 09:07:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 09:07:41 --> Total execution time: 0.0991
DEBUG - 2025-08-29 05:07:47 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 05:07:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 09:07:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 09:07:47 --> Total execution time: 0.0415
DEBUG - 2025-08-29 05:08:04 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 05:08:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 05:08:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 09:08:05 --> Total execution time: 0.4097
DEBUG - 2025-08-29 05:08:09 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 05:08:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 05:08:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 05:08:09 --> Total execution time: 0.1768
DEBUG - 2025-08-29 05:08:19 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 05:08:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 09:08:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 09:08:19 --> Date: 2025-08-29
ERROR - 2025-08-29 09:08:19 --> Query error: Incorrect DATE value: 'Admin' - Invalid query: SELECT `jm`.*, `jt`.`report_abbr`, `cm`.`cust_name`, `u1`.`user_name` as `sales`, `u2`.`user_name` as `staff`
FROM `job_master` `jm`
LEFT JOIN `job_types` `jt` ON `jm`.`job_type` = `jt`.`id`
LEFT JOIN `customer_master` `cm` ON `jm`.`customer` = `cm`. `customer_id`
LEFT JOIN `users` `u1` ON `jm`.`sales` = `u1`.`user_id`
LEFT JOIN `users` `u2` ON `jm`.`staff_assign` = `u2`.`user_id`
WHERE `completed` = 0
AND `job_date` = 'Admin'
AND `cancelled` = 0
ORDER BY `job_id` DESC
ERROR - 2025-08-29 09:08:19 --> Severity: error --> Exception: Call to a member function result() on bool D:\wamp64\www\climateplus\application\models\Operations_model.php 396
DEBUG - 2025-08-29 05:08:24 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 05:08:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 09:08:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 09:08:24 --> Date: 2025-08-29
ERROR - 2025-08-29 09:08:24 --> Query error: Incorrect DATE value: 'Admin' - Invalid query: SELECT `jm`.*, `jt`.`report_abbr`, `cm`.`cust_name`, `u1`.`user_name` as `sales`, `u2`.`user_name` as `staff`
FROM `job_master` `jm`
LEFT JOIN `job_types` `jt` ON `jm`.`job_type` = `jt`.`id`
LEFT JOIN `customer_master` `cm` ON `jm`.`customer` = `cm`. `customer_id`
LEFT JOIN `users` `u1` ON `jm`.`sales` = `u1`.`user_id`
LEFT JOIN `users` `u2` ON `jm`.`staff_assign` = `u2`.`user_id`
WHERE `completed` = 0
AND `job_date` = 'Admin'
AND `cancelled` = 0
ORDER BY `job_id` DESC
ERROR - 2025-08-29 09:08:24 --> Severity: error --> Exception: Call to a member function result() on bool D:\wamp64\www\climateplus\application\models\Operations_model.php 396
DEBUG - 2025-08-29 05:08:27 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 05:08:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 09:08:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 09:08:27 --> Total execution time: 0.0511
DEBUG - 2025-08-29 06:37:52 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 06:37:52 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 10:37:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 10:37:52 --> Date: 2025-08-29
DEBUG - 2025-08-29 10:37:53 --> Total execution time: 0.5961
DEBUG - 2025-08-29 06:37:59 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 06:37:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 10:37:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 10:37:59 --> Date: 2025-08-13
DEBUG - 2025-08-29 10:37:59 --> Total execution time: 0.0397
DEBUG - 2025-08-29 06:38:12 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 06:38:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 10:38:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 10:38:12 --> Total execution time: 0.0807
DEBUG - 2025-08-29 06:40:53 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 06:40:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 10:40:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 10:40:53 --> Date: 2025-08-29
ERROR - 2025-08-29 10:40:53 --> Query error: Incorrect DATE value: 'Admin' - Invalid query: SELECT `jm`.*, `jt`.`report_abbr`, `cm`.`cust_name`, `u1`.`user_name` as `sales`, `u2`.`user_name` as `staff`
FROM `job_master` `jm`
LEFT JOIN `job_types` `jt` ON `jm`.`job_type` = `jt`.`id`
LEFT JOIN `customer_master` `cm` ON `jm`.`customer` = `cm`. `customer_id`
LEFT JOIN `users` `u1` ON `jm`.`sales` = `u1`.`user_id`
LEFT JOIN `users` `u2` ON `jm`.`staff_assign` = `u2`.`user_id`
WHERE `completed` = 0
AND `job_date` = 'Admin'
AND `cancelled` = 0
ORDER BY `job_id` DESC
ERROR - 2025-08-29 10:40:53 --> Severity: error --> Exception: Call to a member function result() on bool D:\wamp64\www\climateplus\application\models\Operations_model.php 396
DEBUG - 2025-08-29 06:42:33 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 06:42:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 10:42:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 10:42:33 --> Total execution time: 0.0861
DEBUG - 2025-08-29 06:42:48 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 06:42:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 10:42:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 10:42:48 --> Total execution time: 0.0442
DEBUG - 2025-08-29 06:57:02 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 06:57:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 10:57:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 10:57:02 --> Total execution time: 0.3127
DEBUG - 2025-08-29 06:59:13 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 06:59:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 10:59:13 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 10:59:13 --> Total execution time: 0.1630
DEBUG - 2025-08-29 07:00:17 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 07:00:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 11:00:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 11:00:18 --> Total execution time: 0.1425
DEBUG - 2025-08-29 07:01:35 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 07:01:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 11:01:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 11:01:35 --> Total execution time: 0.1322
DEBUG - 2025-08-29 07:02:30 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 07:02:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 11:02:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 11:02:30 --> Total execution time: 0.1057
DEBUG - 2025-08-29 07:03:05 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 07:03:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 11:03:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 11:03:05 --> Total execution time: 0.1197
DEBUG - 2025-08-29 07:04:33 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 07:04:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 11:04:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 11:04:33 --> Total execution time: 0.1409
DEBUG - 2025-08-29 07:06:10 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 07:06:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 11:06:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 11:06:10 --> Total execution time: 0.1565
DEBUG - 2025-08-29 07:06:26 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 07:06:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 12:36:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 07:06:26 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 07:06:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 12:36:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 12:36:26 --> Total execution time: 0.0309
DEBUG - 2025-08-29 07:06:31 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 07:06:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 12:36:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2025-08-29 12:36:31 --> Severity: Notice --> Undefined variable: rememberme D:\wamp64\www\climateplus\application\controllers\Login.php 46
ERROR - 2025-08-29 12:36:31 --> Severity: Notice --> session_write_close(): Skipping numeric key 0 Unknown 0
DEBUG - 2025-08-29 07:06:31 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 07:06:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 12:36:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 12:36:31 --> Total execution time: 0.1215
DEBUG - 2025-08-29 07:06:34 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 07:06:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 11:06:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 11:06:34 --> Total execution time: 0.0803
DEBUG - 2025-08-29 07:06:41 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 07:06:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 11:06:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 11:06:41 --> Total execution time: 0.0599
DEBUG - 2025-08-29 07:08:28 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 07:08:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 11:08:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 11:08:28 --> Total execution time: 0.1456
DEBUG - 2025-08-29 07:27:04 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 07:27:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 11:27:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 11:27:04 --> Total execution time: 0.1179
DEBUG - 2025-08-29 07:27:07 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 07:27:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 11:27:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 11:27:07 --> Total execution time: 0.0506
DEBUG - 2025-08-29 07:40:21 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 07:40:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 13:10:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 13:10:21 --> Total execution time: 0.8045
DEBUG - 2025-08-29 07:40:26 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 07:40:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 13:10:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 13:10:26 --> Total execution time: 0.1765
DEBUG - 2025-08-29 07:40:38 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 07:40:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 13:10:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 07:40:38 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 07:40:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 13:10:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 13:10:38 --> Total execution time: 0.0579
DEBUG - 2025-08-29 10:52:41 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 10:52:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 14:52:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 10:52:46 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 10:52:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 16:22:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 16:22:46 --> Total execution time: 0.0346
DEBUG - 2025-08-29 10:52:49 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 10:52:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 16:22:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2025-08-29 16:22:49 --> Severity: Notice --> Undefined variable: rememberme D:\wamp64\www\climateplus\application\controllers\Login.php 46
ERROR - 2025-08-29 16:22:49 --> Severity: Notice --> session_write_close(): Skipping numeric key 0 Unknown 0
DEBUG - 2025-08-29 10:52:49 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 10:52:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 16:22:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 16:22:49 --> Total execution time: 0.0478
DEBUG - 2025-08-29 10:52:56 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 10:52:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 14:52:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 14:52:56 --> Total execution time: 0.0471
DEBUG - 2025-08-29 10:53:46 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 10:53:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 14:53:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 14:53:46 --> Total execution time: 0.0819
DEBUG - 2025-08-29 10:53:52 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 10:53:52 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 14:53:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 14:53:52 --> Total execution time: 0.0611
DEBUG - 2025-08-29 11:23:27 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 11:23:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 15:23:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 15:23:27 --> Total execution time: 0.1165
DEBUG - 2025-08-29 11:54:29 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 11:54:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 15:54:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 15:54:29 --> Date: 2025-08-29
DEBUG - 2025-08-29 15:54:29 --> Total execution time: 0.1857
DEBUG - 2025-08-29 11:54:33 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 11:54:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 15:54:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 15:54:33 --> Total execution time: 0.1957
DEBUG - 2025-08-29 11:54:44 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 11:54:44 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 15:54:44 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 11:54:44 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 11:54:44 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 15:54:44 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 15:54:44 --> Date: 2025-08-29
DEBUG - 2025-08-29 15:54:44 --> Total execution time: 0.0810
DEBUG - 2025-08-29 11:56:19 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 11:56:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 15:56:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 15:56:19 --> Total execution time: 0.1120
DEBUG - 2025-08-29 12:37:11 --> UTF-8 Support Enabled
DEBUG - 2025-08-29 12:37:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-29 16:37:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-29 16:37:11 --> Date: 2025-08-29
DEBUG - 2025-08-29 16:37:11 --> Total execution time: 0.2792
