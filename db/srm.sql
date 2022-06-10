-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Jun 10, 2022 at 05:23 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `srm`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('0751f8a2de242b40f84a924b5f16f40f700dd871c422e6339bcdc03a0dfaa55cbdbc160b0c6144c5', 7, 1, NULL, '[]', 0, '2020-12-21 02:38:13', '2020-12-21 02:38:13', '2021-12-21 08:08:13'),
('17415beb7ed0b606a944c1b056ab8c7e64342207a68601dd85ee3ea216e43f4136b5e8063243a136', 7, 1, 'appToken', '[]', 0, '2020-12-21 04:11:05', '2020-12-21 04:11:05', '2021-12-21 09:41:05'),
('1c5e39c66c15039f83564207a8c3021817403f8e5990d36ba2b694f9a962ab49bfa8589147f05e4a', 7, 1, NULL, '[]', 0, '2020-12-21 02:48:35', '2020-12-21 02:48:35', '2021-12-21 08:18:35'),
('2451e559c54b7789343c290d3774ce7c08f1fb777e0cd9e003c2b7b4cd4ca1f8da6b29a92dbb3364', 7, 1, 'appToken', '[]', 0, '2020-12-21 03:08:06', '2020-12-21 03:08:06', '2021-12-21 08:38:06'),
('25aaac87d8a8b5966f5d68401cb6ddade1e3f5d3ac0545495cc1d29f8e83ab02b8a14b06c2a83b63', 1, 1, 'appToken', '[]', 0, '2021-04-26 06:04:48', '2021-04-26 06:04:48', '2022-04-26 11:34:48'),
('4d88be638de5950baf6133b0b67e2f669f935d41195f8317a65766ab0be9e215b0b7f7c4bd6212bd', 7, 1, NULL, '[]', 0, '2020-12-21 02:32:03', '2020-12-21 02:32:03', '2021-12-21 08:02:03'),
('559b6413a30bb5c8ec234113119c45df53297fbf85fc67bb76a7ead0429c50df84051829bf93c53d', 1, 1, 'appToken', '[]', 0, '2021-04-26 05:53:36', '2021-04-26 05:53:36', '2022-04-26 11:23:36'),
('5aeaa0d588cbadf84436a2ba66b38cdf059273a7846bcd85ac84f39ee4b70ef80d8a9b68c7a6f852', 7, 1, NULL, '[]', 0, '2020-12-21 02:40:48', '2020-12-21 02:40:48', '2021-12-21 08:10:48'),
('68681c271e213c5708c36722546cd0c21b0c681441696f5788e497df0e2da29a49ea9ac8ffbd4c10', 1, 1, 'appToken', '[]', 0, '2021-04-26 06:24:34', '2021-04-26 06:24:34', '2022-04-26 11:54:34'),
('8b26ddbba27bc82bc253f34b83ceab55611247956a3da28b050b3e533f5175650b077a1937644d49', 1, 1, 'appToken', '[]', 0, '2021-04-05 17:21:06', '2021-04-05 17:21:06', '2022-04-05 17:21:06'),
('8f4ed74caddabe15d6333c32f9a3c9277d0b329ca985acd1d777da334b4c230527e776550ece5b37', 1, 1, 'appToken', '[]', 0, '2021-04-20 13:27:45', '2021-04-20 13:27:45', '2022-04-20 18:57:45'),
('c573ecf9a067f4ba99d76a36b91e8262d0cac4b627a249c3c48f9c4481722f3e59b7f732769db75e', 7, 1, 'appToken', '[]', 0, '2020-12-21 03:06:39', '2020-12-21 03:06:39', '2021-12-21 08:36:39'),
('c69d102b7392cbf0f773c0d8ba08e3702ada88d541e7925bb6ff87f37929da0d572633c71ab757c3', 7, 1, 'appToken', '[]', 0, '2020-12-24 07:11:40', '2020-12-24 07:11:40', '2021-12-24 12:41:40'),
('eea43faec90b82c08abc3a02efa2f1804eb7615d4cd2e28a879941e178702534425e8307e6d27221', 7, 1, 'appToken', '[]', 0, '2020-12-26 05:51:43', '2020-12-26 05:51:43', '2021-12-26 11:21:43'),
('ef12549b5bc617fd88ffdeba6af879f2ec949f309a3e2ad0022a707902dba5688fc49dde6bea35a3', 1, 1, 'appToken', '[]', 0, '2021-04-07 14:07:34', '2021-04-07 14:07:34', '2022-04-07 14:07:34'),
('f0916119a281a1cc372370b07642caeb671c23e6e70c5751a23047cc7a5bcc8a4586d55b0101307b', 1, 1, 'appToken', '[]', 0, '2021-04-26 05:29:16', '2021-04-26 05:29:16', '2022-04-26 10:59:16'),
('fc1199c906adc831ad440db0674bf6920762e12f5b53d1b3634335d1445386a92f7b8b3beadbd7d7', 1, 1, 'appToken', '[]', 0, '2021-04-08 10:26:08', '2021-04-08 10:26:08', '2022-04-08 10:26:08');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'File Tracking System Personal Access Client', 'sDNotZb1QaN2Fnrj3ZPycoCEKjx2rYYrz8YPEq4J', NULL, 'http://localhost', 1, 0, 0, '2020-12-21 02:31:24', '2020-12-21 02:31:24'),
(2, NULL, 'File Tracking System Password Grant Client', 'eQjCKHo3gP4MZFNVJ9sTa8YpTQfOWac39HqLtA2h', 'users', 'http://localhost', 0, 1, 0, '2020-12-21 02:31:24', '2020-12-21 02:31:24');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-12-21 02:31:24', '2020-12-21 02:31:24');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_allowance`
--

CREATE TABLE `tbl_allowance` (
  `code` int(11) NOT NULL,
  `allowance_type` int(10) NOT NULL,
  `name_of_allowance` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_allowance`
--

INSERT INTO `tbl_allowance` (`code`, `allowance_type`, `name_of_allowance`, `created_at`, `updated_at`) VALUES
(1, 1, 'BASIC', '2020-10-09 10:28:39', '2020-10-09 10:28:39'),
(2, 1, 'HRA', '2020-10-09 10:28:47', '2020-10-09 10:28:47'),
(3, 1, 'DA', '2020-10-09 10:29:31', '2020-10-15 00:52:18'),
(4, 2, 'PF', '2020-10-12 06:14:48', '2020-10-12 06:14:48'),
(5, 2, 'PTax', '2020-10-16 01:50:14', '2020-10-16 01:50:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `code` int(11) NOT NULL,
  `department` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`code`, `department`, `created_at`, `updated_at`) VALUES
(3, 'fgbfgf', '2020-09-02 06:12:09', '2020-09-02 06:12:09'),
(4, 'fsdgvsg', '2020-09-02 06:13:38', '2020-09-02 06:13:38'),
(5, 'gjgjgjh', '2020-09-02 06:27:42', '2020-09-02 06:27:42'),
(8, 'ascsd', '2021-01-06 15:46:24', '2021-01-06 15:46:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_designation`
--

CREATE TABLE `tbl_designation` (
  `code` int(11) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_designation`
--

INSERT INTO `tbl_designation` (`code`, `designation`, `created_at`, `updated_at`) VALUES
(1, 'EX-Serviceman With Armed', '2020-10-01 02:21:19', '2020-10-01 02:21:19'),
(2, 'EX-Serviceman Unarmed', '2020-10-01 02:21:29', '2020-10-01 02:21:29'),
(3, 'Civilian With Armed', '2020-10-01 02:21:38', '2020-10-01 02:21:38'),
(4, 'Civilian Unarmed', '2020-10-01 02:21:47', '2020-10-01 02:21:47'),
(5, 'super', '2021-01-07 12:29:44', '2021-01-06 15:42:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_designation_wise_allowance`
--

CREATE TABLE `tbl_designation_wise_allowance` (
  `code` int(11) NOT NULL,
  `designation_code` int(11) NOT NULL,
  `allowance_code` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_designation_wise_allowance`
--

INSERT INTO `tbl_designation_wise_allowance` (`code`, `designation_code`, `allowance_code`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 2, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 2, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 3, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 3, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 3, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 5, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 5, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 5, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 5, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 5, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 6, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 6, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 6, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 6, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 6, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 7, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 7, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 7, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 7, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_allowance_entry`
--

CREATE TABLE `tbl_employee_allowance_entry` (
  `code` int(11) NOT NULL,
  `emp_code` int(11) NOT NULL,
  `salary_type` int(11) NOT NULL,
  `allowance_code` int(11) NOT NULL,
  `fixed_persentage` int(10) DEFAULT NULL,
  `on_allowance_code` int(10) DEFAULT NULL,
  `amount` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_employee_allowance_entry`
--

INSERT INTO `tbl_employee_allowance_entry` (`code`, `emp_code`, `salary_type`, `allowance_code`, `fixed_persentage`, `on_allowance_code`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 0, 0, 10, '2022-06-10 05:19:31', '2022-06-10 05:19:31'),
(2, 1, 1, 2, 1, 0, 10, '2022-06-10 05:19:31', '2022-06-10 05:19:31'),
(3, 1, 1, 3, 1, 0, 10, '2022-06-10 05:19:31', '2022-06-10 05:19:31'),
(4, 1, 1, 4, 1, 0, 10, '2022-06-10 05:19:31', '2022-06-10 05:19:31'),
(5, 1, 1, 5, 1, 0, 10, '2022-06-10 05:19:31', '2022-06-10 05:19:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_details`
--

CREATE TABLE `tbl_employee_details` (
  `code` int(10) UNSIGNED NOT NULL,
  `emp_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emp_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_image` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_designation` int(10) DEFAULT NULL,
  `emp_deparment` int(10) DEFAULT NULL,
  `dob` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blood_group` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phno` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hqualification` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_no` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spouse_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `noofchildren` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userImage` text COLLATE utf8mb4_unicode_ci,
  `contact_person` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emg_address` text COLLATE utf8mb4_unicode_ci,
  `emg_phno` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emg_alt_phno` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `relationship` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c_address` text COLLATE utf8mb4_unicode_ci,
  `c_dist` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c_state` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c_pin` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `p_address` text COLLATE utf8mb4_unicode_ci,
  `p_dist` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `p_state` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `p_pin` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joining_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary_per_day` int(10) DEFAULT NULL,
  `bank_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ifsc_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(10) NOT NULL DEFAULT '0',
  `attendance_mode` int(11) NOT NULL COMMENT '1=>mobile,2=>Device,3=>both',
  `in_location_code` int(11) NOT NULL,
  `out_location_code` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_employee_details`
--

INSERT INTO `tbl_employee_details` (`code`, `emp_id`, `emp_name`, `father_name`, `mother_name`, `emp_type`, `profile_image`, `emp_designation`, `emp_deparment`, `dob`, `gender`, `blood_group`, `phno`, `hqualification`, `email`, `pan_no`, `marital_status`, `spouse_name`, `noofchildren`, `userImage`, `contact_person`, `emg_address`, `emg_phno`, `emg_alt_phno`, `relationship`, `c_address`, `c_dist`, `c_state`, `c_pin`, `p_address`, `p_dist`, `p_state`, `p_pin`, `joining_date`, `salary_per_day`, `bank_name`, `branch_name`, `acc_no`, `ifsc_code`, `status`, `attendance_mode`, `in_location_code`, `out_location_code`, `created_at`, `updated_at`) VALUES
(1, '600000', 'Test', 'ghgh', 'fgfg', '1', NULL, 1, 0, '01/01/1900', 'Male', 'A+', '7584061326', 'bnbn', 'slrahama@gmail.com', NULL, 'Yes', 'bnbn', '1', NULL, 'ghghgh', 'ghghg', '4545454545', NULL, 'ghgh', 'Village Singur', 'vbvbv', 'WEST BENGAL', '777777', 'Village Singur', 'vbvbv', 'WEST BENGAL', '777777', '10/06/2015', NULL, 'sbi', 'suri', '546546546546546', 'sbi123', 0, 3, 1, 2, '2022-06-10 05:16:51', '2022-06-10 05:18:37');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_wise_shift_allocation`
--

CREATE TABLE `tbl_employee_wise_shift_allocation` (
  `code` int(11) NOT NULL,
  `emp_code` int(11) NOT NULL,
  `shift_code` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_employee_wise_shift_allocation`
--

INSERT INTO `tbl_employee_wise_shift_allocation` (`code`, `emp_code`, `shift_code`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-06-10 05:19:43', '2022-06-10 05:19:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE `tbl_location` (
  `code` int(11) NOT NULL,
  `location_name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `ward` varchar(200) NOT NULL,
  `loc_lat` varchar(100) NOT NULL,
  `loc_long` varchar(100) NOT NULL,
  `creaded_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`code`, `location_name`, `address`, `ward`, `loc_lat`, `loc_long`, `creaded_at`, `updated_at`) VALUES
(1, 'Suri', 'Suri', '12', '32.00', '44.99', '2020-11-25 07:43:32', '2020-11-25 07:43:32'),
(2, 'Panagarh', 'Panagarh', '12', '32.00', '44.99', '2020-11-25 07:43:50', '2020-11-25 07:43:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menus`
--

CREATE TABLE `tbl_menus` (
  `code` int(11) NOT NULL,
  `menu_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `menu_icon` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `menu_link` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_order` int(10) NOT NULL,
  `view` int(11) DEFAULT NULL,
  `f_add` int(11) DEFAULT NULL,
  `f_update` int(11) DEFAULT NULL,
  `f_delete` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_menus`
--

INSERT INTO `tbl_menus` (`code`, `menu_name`, `menu_icon`, `menu_link`, `menu_order`, `view`, `f_add`, `f_update`, `f_delete`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 'fa fa-home', 'dashboard', 1, 1, 0, 0, 0, '2021-01-05 06:54:29', '0000-00-00 00:00:00'),
(2, 'Master', 'fa fa-circle-o-notch', NULL, 2, NULL, NULL, NULL, NULL, '2021-01-06 06:52:22', '0000-00-00 00:00:00'),
(3, 'Security', 'fa fa-shield', NULL, 3, NULL, NULL, NULL, NULL, '2021-01-07 11:55:20', '0000-00-00 00:00:00'),
(6, 'User', 'fa fa-user-secret', NULL, 8, NULL, NULL, NULL, NULL, '2021-01-05 08:17:59', '0000-00-00 00:00:00'),
(7, 'Logout', 'fa fa-sign-out', 'logout', 9, 1, 0, 0, 0, '2021-01-05 08:18:30', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mobile_user`
--

CREATE TABLE `tbl_mobile_user` (
  `code` int(10) UNSIGNED NOT NULL,
  `app_web_user` int(10) NOT NULL COMMENT '1=>App user, 2=>Web User',
  `emp_code` int(10) DEFAULT NULL,
  `emp_type` int(10) DEFAULT NULL,
  `user_type` int(10) DEFAULT NULL,
  `email_address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imie_no` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `userImage` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_mobile_user`
--

INSERT INTO `tbl_mobile_user` (`code`, `app_web_user`, `emp_code`, `emp_type`, `user_type`, `email_address`, `name`, `designation`, `mobile_no`, `user_id`, `password`, `imie_no`, `status`, `userImage`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 0, 0, 1, 'a@g.com', 'Admin', 'Admin', '9999999999', 'Admin@1', '$2a$10$VCfI3mLV067sFbBzYCYhuOXvcNxm83sUNLE6QCeEWS9Rr9qKZFnBG', NULL, 1, NULL, '2020-09-11 12:18:45', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post_location`
--

CREATE TABLE `tbl_post_location` (
  `code` int(11) NOT NULL,
  `location_name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_post_location`
--

INSERT INTO `tbl_post_location` (`code`, `location_name`, `created_at`, `updated_at`) VALUES
(1, 'In-site Plant', NULL, '2021-04-21 05:31:57'),
(2, 'Out-Site Plant', NULL, NULL),
(3, 'Township', NULL, NULL),
(4, 'Suri Station', '2020-12-09 12:54:18', '2020-12-09 12:54:18'),
(7, 'Suri Busstand', '2021-04-21 05:32:25', '2021-04-21 05:32:25'),
(8, 'Suri Main Gate', '2021-04-21 05:32:49', '2021-04-21 05:32:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_security_posts`
--

CREATE TABLE `tbl_security_posts` (
  `code` int(11) NOT NULL,
  `post_name` varchar(30) NOT NULL,
  `location_code` int(11) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `lat_coordianates` varchar(40) DEFAULT NULL,
  `long_coordinates` varchar(40) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_security_posts`
--

INSERT INTO `tbl_security_posts` (`code`, `post_name`, `location_code`, `designation`, `lat_coordianates`, `long_coordinates`, `created_at`, `updated_at`) VALUES
(6, 'Gate-1', 1, '1,2,3,4,5', '23.8905', '87.5312', '2021-04-21 05:35:08', '2021-04-21 05:38:56'),
(7, 'Gate-2', 1, '1,2,3,4,5', '23.905445', '87.524620', '2021-04-21 05:35:53', '2021-04-21 05:39:00'),
(8, 'Gate-1', 2, '1,2,3,4,5', '23.905445', '87.524620', '2021-04-21 05:36:43', '2021-04-21 05:39:08'),
(9, 'Gate-2', 2, '1,2,3,4,5', '23.9129', '87.5268', '2021-04-21 05:38:14', '2021-04-21 05:39:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shift`
--

CREATE TABLE `tbl_shift` (
  `code` int(11) NOT NULL,
  `shift` varchar(30) NOT NULL,
  `shift_in_time` time DEFAULT NULL,
  `shift_out_time` time DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_shift`
--

INSERT INTO `tbl_shift` (`code`, `shift`, `shift_in_time`, `shift_out_time`, `created_at`, `updated_at`) VALUES
(1, 'Morning Shift', '08:01:00', '14:00:00', '2021-01-06 10:45:04', '0000-00-00 00:00:00'),
(2, 'Evening Shift', '14:01:00', '22:00:00', '2021-01-06 10:45:04', '0000-00-00 00:00:00'),
(3, 'Night Shift', '22:01:00', '08:00:00', '2021-01-06 10:45:04', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_submenus`
--

CREATE TABLE `tbl_submenus` (
  `code` int(11) NOT NULL,
  `menu_code` int(10) NOT NULL,
  `submenu_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `submenu_icon` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `submenu_link` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `submenu_order` int(10) NOT NULL,
  `view` int(10) NOT NULL,
  `f_add` int(10) NOT NULL,
  `f_update` int(10) NOT NULL,
  `f_delete` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_submenus`
--

INSERT INTO `tbl_submenus` (`code`, `menu_code`, `submenu_name`, `submenu_icon`, `submenu_link`, `submenu_order`, `view`, `f_add`, `f_update`, `f_delete`, `created_at`, `updated_at`) VALUES
(1, 2, 'Designation', 'fa fa-credit-card', 'designation', 2, 1, 1, 1, 1, '2021-01-06 06:24:09', '0000-00-00 00:00:00'),
(2, 2, 'Department', 'fa fa-building-o', 'department_details', 3, 1, 1, 1, 1, '2021-01-05 11:45:30', '0000-00-00 00:00:00'),
(3, 2, 'Location', 'fa fa-globe', 'location', 5, 1, 1, 1, 1, '2021-01-06 06:15:54', '0000-00-00 00:00:00'),
(4, 3, 'Shift', 'fa fa-ship', 'shift_details', 1, 1, 1, 1, 1, '2021-01-06 06:16:36', '0000-00-00 00:00:00'),
(5, 3, 'Security Personal Details', 'fa fa-user', 'employee_details', 4, 1, 1, 1, 1, '2021-01-06 06:17:02', '0000-00-00 00:00:00'),
(6, 3, 'Security Post Details', 'fa fa-compass', 'security_post_master', 3, 1, 1, 1, 1, '2021-01-06 06:19:02', '0000-00-00 00:00:00'),
(7, 3, 'Shift Allocation', 'fa fa-registered', 'employee_wise_shift_allocation', 2, 1, 1, 1, 1, '2021-01-06 06:21:40', '0000-00-00 00:00:00'),
(13, 6, 'App User', 'fa fa-mobile', 'user_details', 1, 1, 1, 1, 1, '2021-01-05 10:39:44', '0000-00-00 00:00:00'),
(14, 6, 'Web User', 'fa fa-desktop', 'web_user', 2, 1, 1, 1, 1, '2021-01-05 10:41:59', '0000-00-00 00:00:00'),
(42, 3, 'ID Card Generate', 'fa fa-user', 'id_card_generate', 5, 1, 1, 1, 1, '2021-04-13 07:24:16', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_type`
--

CREATE TABLE `tbl_user_type` (
  `code` int(11) NOT NULL,
  `Type_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `permission` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_user_type`
--

INSERT INTO `tbl_user_type` (`code`, `Type_name`, `permission`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', '2,3', '2020-12-11 05:03:00', '0000-00-00 00:00:00'),
(2, 'Admin', '3', '2020-12-11 05:03:11', '0000-00-00 00:00:00'),
(3, 'User', '', '2020-12-11 05:03:20', '0000-00-00 00:00:00'),
(4, 'Employee', '', '2020-12-11 05:03:35', '0000-00-00 00:00:00'),
(5, 'Supervisor', '', '2020-12-11 05:03:47', '0000-00-00 00:00:00'),
(7, 'Admintrator', '', '2020-12-12 11:08:25', '2020-12-12 11:08:25'),
(8, 'xxx', '', '2022-06-09 06:01:15', '2022-06-09 06:01:15'),
(9, 'xxxgg', '', '2022-06-09 06:02:31', '2022-06-09 06:02:31'),
(10, 'eee', '', '2022-06-09 06:48:57', '2022-06-09 06:48:57'),
(11, 'eeeg', '', '2022-06-09 06:49:07', '2022-06-09 06:49:07'),
(12, 'vcvc', '', '2022-06-09 13:41:02', '2022-06-09 13:41:02'),
(13, 'vcvk', '', '2022-06-09 13:42:20', '2022-06-09 13:42:20'),
(14, 'vcvkv', '', '2022-06-09 13:44:28', '2022-06-09 13:44:28'),
(15, 'vcvkvg', '', '2022-06-09 13:45:15', '2022-06-09 13:45:15'),
(16, 'hhh', '', '2022-06-09 13:46:15', '2022-06-09 13:46:15'),
(17, 'hh', '', '2022-06-10 04:22:01', '2022-06-10 04:22:01'),
(18, 'hhhtt', '', '2022-06-10 04:25:22', '2022-06-10 04:25:22'),
(19, 'test', '', '2022-06-10 04:27:13', '2022-06-10 04:27:13'),
(20, 'testjj', '', '2022-06-10 04:58:37', '2022-06-10 04:58:37'),
(21, 'testjjccc', '', '2022-06-10 04:58:44', '2022-06-10 04:58:44'),
(22, 'ttttttt', '', '2022-06-10 04:59:13', '2022-06-10 04:59:13'),
(23, 'dddddd', '', '2022-06-10 04:59:49', '2022-06-10 04:59:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_wise_menu_submenu`
--

CREATE TABLE `tbl_user_wise_menu_submenu` (
  `code` int(11) NOT NULL,
  `user_code` int(10) NOT NULL,
  `menu_code` int(10) NOT NULL,
  `submenu_code` int(10) DEFAULT NULL,
  `view` int(10) NOT NULL,
  `f_add` int(10) NOT NULL,
  `f_update` int(10) NOT NULL,
  `f_delete` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_user_wise_menu_submenu`
--

INSERT INTO `tbl_user_wise_menu_submenu` (`code`, `user_code`, `menu_code`, `submenu_code`, `view`, `f_add`, `f_update`, `f_delete`, `created_at`, `updated_at`) VALUES
(46, 1, 2, 1, 1, 1, 1, 1, '2020-12-21 12:00:50', '2020-12-12 12:24:46'),
(48, 1, 2, 3, 1, 1, 1, 1, '2020-12-21 12:01:13', '2020-12-12 12:24:46'),
(49, 1, 3, 4, 1, 1, 1, 1, '2021-01-05 11:49:05', '0000-00-00 00:00:00'),
(50, 1, 3, 5, 1, 1, 1, 1, '2021-01-05 11:52:12', '0000-00-00 00:00:00'),
(51, 1, 3, 6, 1, 1, 1, 1, '2020-12-21 12:01:24', '2020-12-12 12:24:46'),
(52, 1, 3, 7, 1, 1, 1, 1, '2020-12-21 12:01:27', '2020-12-12 12:24:46'),
(58, 1, 6, 13, 1, 1, 1, 1, '2020-12-21 12:01:48', '2020-12-12 12:24:46'),
(59, 1, 6, 14, 1, 1, 1, 1, '2020-12-21 12:01:51', '2020-12-12 12:24:46'),
(60, 1, 6, 15, 1, 1, 1, 1, '2020-12-21 12:01:54', '2020-12-12 12:24:46'),
(61, 1, 1, NULL, 1, 0, 0, 0, '2020-12-21 12:01:57', '0000-00-00 00:00:00'),
(62, 1, 7, NULL, 0, 0, 0, 0, '2020-12-21 12:02:02', '0000-00-00 00:00:00'),
(63, 1, 3, 16, 1, 1, 1, 1, '2020-12-21 12:02:05', '0000-00-00 00:00:00'),
(77, 1, 3, 31, 1, 1, 1, 1, '2021-01-05 11:59:33', '0000-00-00 00:00:00'),
(78, 1, 3, 33, 1, 1, 1, 1, '2021-01-05 12:04:39', '0000-00-00 00:00:00'),
(87, 1, 3, 42, 1, 1, 1, 1, '2021-04-13 07:18:57', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indexes for table `tbl_allowance`
--
ALTER TABLE `tbl_allowance`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`code`),
  ADD UNIQUE KEY `department` (`department`);

--
-- Indexes for table `tbl_designation`
--
ALTER TABLE `tbl_designation`
  ADD PRIMARY KEY (`code`),
  ADD UNIQUE KEY `designation` (`designation`);

--
-- Indexes for table `tbl_designation_wise_allowance`
--
ALTER TABLE `tbl_designation_wise_allowance`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `tbl_employee_allowance_entry`
--
ALTER TABLE `tbl_employee_allowance_entry`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `tbl_employee_details`
--
ALTER TABLE `tbl_employee_details`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `tbl_employee_wise_shift_allocation`
--
ALTER TABLE `tbl_employee_wise_shift_allocation`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `tbl_menus`
--
ALTER TABLE `tbl_menus`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `tbl_mobile_user`
--
ALTER TABLE `tbl_mobile_user`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `tbl_post_location`
--
ALTER TABLE `tbl_post_location`
  ADD PRIMARY KEY (`code`),
  ADD UNIQUE KEY `location_name` (`location_name`);

--
-- Indexes for table `tbl_security_posts`
--
ALTER TABLE `tbl_security_posts`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `tbl_shift`
--
ALTER TABLE `tbl_shift`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `tbl_submenus`
--
ALTER TABLE `tbl_submenus`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `tbl_user_type`
--
ALTER TABLE `tbl_user_type`
  ADD PRIMARY KEY (`code`),
  ADD UNIQUE KEY `Type_name` (`Type_name`);

--
-- Indexes for table `tbl_user_wise_menu_submenu`
--
ALTER TABLE `tbl_user_wise_menu_submenu`
  ADD PRIMARY KEY (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_allowance`
--
ALTER TABLE `tbl_allowance`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_designation`
--
ALTER TABLE `tbl_designation`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_designation_wise_allowance`
--
ALTER TABLE `tbl_designation_wise_allowance`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_employee_allowance_entry`
--
ALTER TABLE `tbl_employee_allowance_entry`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_employee_details`
--
ALTER TABLE `tbl_employee_details`
  MODIFY `code` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_employee_wise_shift_allocation`
--
ALTER TABLE `tbl_employee_wise_shift_allocation`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_location`
--
ALTER TABLE `tbl_location`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_menus`
--
ALTER TABLE `tbl_menus`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_mobile_user`
--
ALTER TABLE `tbl_mobile_user`
  MODIFY `code` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_post_location`
--
ALTER TABLE `tbl_post_location`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_security_posts`
--
ALTER TABLE `tbl_security_posts`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_shift`
--
ALTER TABLE `tbl_shift`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_submenus`
--
ALTER TABLE `tbl_submenus`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_user_type`
--
ALTER TABLE `tbl_user_type`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_user_wise_menu_submenu`
--
ALTER TABLE `tbl_user_wise_menu_submenu`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
