--
-- Dumping data for table `contributors`
--

INSERT INTO `contributors` (`id`, `name`, `phone`, `notes`, `created_at`, `updated_at`)
VALUES (1, 'Ahmad Omar Karman', '5353402539', 'Owner', NULL, NULL),
       (2, 'Yusuf Karman', '5353402539', 'Contributor in Goods.', NULL, NULL);

--
-- Dumping data for table `contributions`
--
INSERT INTO `contributions` (`id`, `amount`, `description`, `deposit_date`, `due_date`, `profits_percent`, `status`,
                             `returned_date`, `contributor_id`, `created_at`, `updated_at`)
VALUES (1, 10000, 'This is the description', '2021-10-13', '2022-10-13', 100, 0, NULL, 1, '2021-10-12 21:00:00',
        '2021-10-12 21:00:00'),
       (2, 5000, 'Yusuf Karman', '2021-10-13', '2022-10-13', 25, 0, NULL, 2, '2021-10-12 21:00:00',
        '2021-10-12 21:00:00');

--
-- Dumping data for table `bills`
--
INSERT INTO `bills` (`id`, `type`, `amount`, `description`, `quantity`, `serial`, `seller_id`, `contribution_id`,
                     `created_at`, `updated_at`)
VALUES (1, 'default', 0, 'default', 1, 1001, 1, 1, '2021-10-17 21:00:00', '2021-10-17 21:00:00'),
       (2, 'goods', 2721, '293.5 $ * 9.27 TL', 125, 1002, 1, 1, '2021-10-17 21:00:00', '2021-10-17 21:00:00'),
       (3, 'goods', 675, '72.8 $ * 9.27 TL', 20, 1003, 1, 1, '2021-10-17 21:00:00', '2021-10-17 21:00:00'),
       (4, 'goods', 1246, '132.8 $ * 9.38 TL', 78, 9905, 3, 1, '2021-10-19 13:30:00', '2021-10-19 13:30:00'),
       (5, 'goods', 335, ' ', 3, 1004, 1, 1, '2021-10-19 13:30:00', '2021-10-19 13:30:00');

