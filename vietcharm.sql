-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 21, 2024 lúc 06:39 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `vietcharm`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT 'Tên danh mục: Miền Nam, Miền Bắc, Miền Trung',
  `describe` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `describe`) VALUES
(1, 'Miền Nam', 'Miền Nam Việt Nam là vùng đất tràn đầy sức sống, nổi bật với vẻ đẹp thiên nhiên tươi mát, văn hóa đa dạng và ẩm thực phong phú. Từ những bãi biển tuyệt đẹp của Phú Quốc đến những con kênh xanh mát của miền Tây sông nước, nơi đây mang đến cho du khách những trải nghiệm thú vị và độc đáo. Bạn sẽ được khám phá thành phố Hồ Chí Minh nhộn nhịp với những khu chợ sôi động, các công trình lịch sử như Dinh Độc Lập và Nhà thờ Đức Bà. Miền Tây mang đến khung cảnh yên bình với những vườn trái cây sai trĩu, cùng những hoạt động như đi thuyền trên các kênh rạch. Ẩm thực miền Nam cũng vô cùng hấp dẫn, từ phở, hủ tiếu đến các món đặc sản như cá lóc nướng trui và bánh xèo. Hãy đến miền Nam Việt Nam để trải nghiệm sự hiếu khách của người dân, khám phá những nét văn hóa độc đáo và thưởng thức những món ăn ngon tuyệt!'),
(2, 'Miền Bắc', 'Miền Bắc Việt Nam là một điểm đến hấp dẫn, nơi bạn sẽ được trải nghiệm vẻ đẹp thiên nhiên kỳ vĩ, văn hóa phong phú và lịch sử lâu đời. Từ những ngọn núi trùng điệp của Sa Pa, những cánh đồng xanh mướt ở Mộc Châu đến những di sản văn hóa thế giới như Vịnh Hạ Long, miền Bắc tỏa sáng với cảnh sắc hùng vĩ và sự đa dạng trong nền văn hóa dân tộc. Bên cạnh đó, con người miền Bắc nổi tiếng với sự thân thiện và hiếu khách, khiến du khách cảm thấy như ở nhà. Đến miền Bắc, bạn không chỉ được khám phá những địa danh nổi tiếng mà còn có cơ hội trải nghiệm ẩm thực đặc sắc, tham gia vào các lễ hội truyền thống và tìm hiểu về những phong tục tập quán độc đáo của các dân tộc nơi đây. Hãy cùng lên đường và khám phá miền Bắc Việt Nam, một thiên đường du lịch không thể bỏ lỡ!'),
(3, 'Miền Trung', 'Miền Trung Việt Nam là một vùng đất quyến rũ với những bãi biển tuyệt đẹp, di sản văn hóa                         phong phú và cảnh quan thiên nhiên đa dạng. Từ thành phố Đà Nẵng hiện đại với bãi biển Mỹ                         Khê xanh mướt, đến cố đô Huế trầm mặc với những công trình kiến trúc cổ kính, miền Trung                         mang đến cho du khách những trải nghiệm thú vị và độc đáo. Bạn có thể khám phá phố cổ Hội An                         với những ngôi nhà cổ và ánh đèn lồng lung linh, hay tham gia vào các hoạt động thể thao mạo                         hiểm tại các khu nghỉ dưỡng ven biển. Không chỉ nổi tiếng với cảnh đẹp, miền Trung còn chinh                         phục du khách bằng ẩm thực đặc sắc, từ bún bò Huế đậm đà đến cao lầu Hội An thơm ngon. Hãy                         cùng khám phá miền Trung Việt Nam, nơi hội tụ của văn hóa, lịch sử và vẻ đẹp thiên nhiên                         tuyệt vời!'),
(4, 'Đặc biệt', 'Tiết kiệm hơn, trải nghiệm thú vị hơn!');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tour_id` int(11) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT '',
  `gender` enum('Male','Female','Other') NOT NULL,
  `birthday` datetime DEFAULT NULL,
  `email` varchar(100) DEFAULT '',
  `phone_number` varchar(20) NOT NULL,
  `address` varchar(200) NOT NULL,
  `number_of_people` int(11) NOT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `status` enum('pending','completed','cancelled') DEFAULT NULL,
  `total_money` float NOT NULL CHECK (`total_money` >= 0),
  `active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `tour_id`, `fullname`, `gender`, `birthday`, `email`, `phone_number`, `address`, `number_of_people`, `order_date`, `status`, `total_money`, `active`) VALUES
(1, 6, 2, 'Trần Minh Hòa', 'Male', '1985-05-15 00:00:00', 'tranminhhoa@gmail.com', '0357111123', 'Quận 1, TP. Hồ Chí Minh', 2, '2024-12-01 08:00:00', 'completed', 5000000, 1),
(2, 7, 4, 'Nguyễn Thị Lan', 'Female', '1990-08-22 00:00:00', 'nguyenlan@gmail.com', '0357222234', 'Quận 3, TP. Hồ Chí Minh', 4, '2024-12-02 10:00:00', 'completed', 7000000, 1),
(3, 8, 6, 'Lê Hoàng Anh', 'Male', '1988-12-05 00:00:00', 'hoanganh@gmail.com', '0357333345', 'Quận 7, TP. Hồ Chí Minh', 1, '2024-12-03 09:00:00', 'pending', 3500000, 1),
(4, 9, 8, 'Phạm Văn Đức', 'Male', '1982-03-19 00:00:00', 'phamduc@gmail.com', '0357444456', 'Quận 5, TP. Hồ Chí Minh', 3, '2024-12-04 14:00:00', 'cancelled', 8000000, 1),
(5, 10, 10, 'Đỗ Thị Hương', 'Female', '1995-06-30 00:00:00', 'huongdo@gmail.com', '0357555567', 'Quận 10, TP. Hồ Chí Minh', 5, '2024-12-05 16:00:00', 'completed', 12000000, 1),
(6, 11, 12, 'Ngô Đức Thịnh', 'Male', '1980-09-25 00:00:00', 'ngothinh@gmail.com', '0357666678', 'Quận Bình Thạnh, TP. Hồ Chí Minh', 2, '2024-12-06 08:00:00', 'pending', 6000000, 1),
(7, 12, 14, 'Vũ Hải Yến', 'Female', '1989-11-11 00:00:00', 'yenhai@gmail.com', '0357777789', 'Quận Gò Vấp, TP. Hồ Chí Minh', 4, '2024-12-07 11:00:00', 'completed', 9000000, 1),
(8, 13, 16, 'Phan Anh Tú', 'Male', '1992-02-28 00:00:00', 'tuanh@gmail.com', '0357888890', 'Quận Phú Nhuận, TP. Hồ Chí Minh', 3, '2024-12-08 13:00:00', 'completed', 8000000, 1),
(9, 14, 18, 'Bùi Minh Ngọc', 'Female', '1997-04-18 00:00:00', 'ngocbui@gmail.com', '0357999911', 'Quận Tân Bình, TP. Hồ Chí Minh', 1, '2024-12-09 15:00:00', 'pending', 4500000, 1),
(10, 15, 20, 'Trịnh Thùy Linh', 'Female', '1993-07-07 00:00:00', 'linhthuy@gmail.com', '0357111012', 'Quận 12, TP. Hồ Chí Minh', 2, '2024-12-10 09:30:00', 'completed', 5500000, 1),
(11, 6, 2, 'Trần Minh Hòa', 'Male', '1985-05-15 00:00:00', 'tranminhhoa@gmail.com', '0357111123', 'Quận 1, TP. Hồ Chí Minh', 2, '2024-12-01 08:00:00', 'completed', 5000000, 1),
(12, 7, 4, 'Nguyễn Thị Lan', 'Female', '1990-08-22 00:00:00', 'nguyenlan@gmail.com', '0357222234', 'Quận 3, TP. Hồ Chí Minh', 4, '2024-12-02 10:00:00', 'completed', 7000000, 1),
(13, 8, 6, 'Lê Hoàng Anh', 'Male', '1988-12-05 00:00:00', 'hoanganh@gmail.com', '0357333345', 'Quận 7, TP. Hồ Chí Minh', 1, '2024-12-03 09:00:00', 'pending', 3500000, 1),
(14, 9, 8, 'Phạm Văn Đức', 'Male', '1982-03-19 00:00:00', 'phamduc@gmail.com', '0357444456', 'Quận 5, TP. Hồ Chí Minh', 3, '2024-12-04 14:00:00', 'cancelled', 8000000, 1),
(15, 10, 10, 'Đỗ Thị Hương', 'Female', '1995-06-30 00:00:00', 'huongdo@gmail.com', '0357555567', 'Quận 10, TP. Hồ Chí Minh', 5, '2024-12-05 16:00:00', 'completed', 12000000, 1),
(16, 11, 12, 'Ngô Đức Thịnh', 'Male', '1980-09-25 00:00:00', 'ngothinh@gmail.com', '0357666678', 'Quận Bình Thạnh, TP. Hồ Chí Minh', 2, '2024-12-06 08:00:00', 'pending', 6000000, 1),
(17, 12, 14, 'Vũ Hải Yến', 'Female', '1989-11-11 00:00:00', 'yenhai@gmail.com', '0357777789', 'Quận Gò Vấp, TP. Hồ Chí Minh', 4, '2024-12-07 11:00:00', 'completed', 9000000, 1),
(18, 13, 16, 'Phan Anh Tú', 'Male', '1992-02-28 00:00:00', 'tuanh@gmail.com', '0357888890', 'Quận Phú Nhuận, TP. Hồ Chí Minh', 3, '2024-12-08 13:00:00', 'completed', 8000000, 1),
(19, 14, 18, 'Bùi Minh Ngọc', 'Female', '1997-04-18 00:00:00', 'ngocbui@gmail.com', '0357999911', 'Quận Tân Bình, TP. Hồ Chí Minh', 1, '2024-12-09 15:00:00', 'pending', 4500000, 1),
(20, 15, 20, 'Trịnh Thùy Linh', 'Female', '1993-07-07 00:00:00', 'linhthuy@gmail.com', '0357111012', 'Quận 12, TP. Hồ Chí Minh', 2, '2024-12-10 09:30:00', 'completed', 5500000, 1),
(21, 17, 3, 'Võ Thanh Nhàn', 'Other', '2024-12-10 00:00:00', 'thanhiscoding@gmail.com', '0702562318', 'thôn Thọ Vức, xã Hòa Kiến, thành phố Tuy Hòa, Phú Yên', 6, '2024-12-21 06:27:29', 'pending', 2200000, 1),
(32, 17, 3, 'Võ Thanh Nhàn', 'Other', '2024-12-10 00:00:00', 'thanhiscoding@gmail.com', '0702562318', 'thôn Thọ Vức, xã Hòa Kiến, thành phố Tuy Hòa, Phú Yên', 6, '2024-12-21 07:59:04', 'pending', 12400000, 1),
(35, 17, 3, 'Võ Thanh Nhàn', 'Other', '2024-12-10 00:00:00', 'thanhiscoding@gmail.com', '0702562318', 'thôn Thọ Vức, xã Hòa Kiến, thành phố Tuy Hòa, Phú Yên', 6, '2024-12-21 08:04:23', 'pending', 9000000, 1),
(36, 17, 2, 'Võ Thanh Nhàn', 'Other', '2024-12-10 00:00:00', 'thanhiscoding@gmail.com', '0702562318', 'thôn Thọ Vức, xã Hòa Kiến, thành phố Tuy Hòa, Phú Yên', 6, '2024-12-21 08:06:39', 'pending', 24400000, 1),
(37, 17, 2, 'Võ Thanh Nhàn', 'Other', '2024-12-10 00:00:00', 'thanhiscoding@gmail.com', '0702562318', 'thôn Thọ Vức, xã Hòa Kiến, thành phố Tuy Hòa, Phú Yên', 6, '2024-12-21 08:09:16', 'pending', 21000000, 1),
(38, 17, 2, 'Võ Thanh Nhàn', 'Other', '2024-12-10 00:00:00', 'thanhiscoding@gmail.com', '0702562318', 'thôn Thọ Vức, xã Hòa Kiến, thành phố Tuy Hòa, Phú Yên', 6, '2024-12-21 08:12:48', 'pending', 24500000, 1),
(39, 17, 4, 'Võ Thanh Nhàn', 'Other', '2024-12-10 00:00:00', 'thanhiscoding@gmail.com', '0702562318', 'thôn Thọ Vức, xã Hòa Kiến, thành phố Tuy Hòa, Phú Yên', 6, '2024-12-21 08:19:08', 'pending', 12000000, 1),
(40, 17, 4, 'Võ Thanh Nhàn', 'Other', '2024-12-10 00:00:00', 'thanhiscoding@gmail.com', '0702562318', 'thôn Thọ Vức, xã Hòa Kiến, thành phố Tuy Hòa, Phú Yên', 6, '2024-12-21 08:21:16', 'pending', 12000000, 1),
(41, 17, 4, 'Võ Thanh Nhàn', 'Other', '2024-12-10 00:00:00', 'thanhiscoding@gmail.com', '0702562318', 'thôn Thọ Vức, xã Hòa Kiến, thành phố Tuy Hòa, Phú Yên', 6, '2024-12-21 08:21:51', 'pending', 12000000, 1),
(42, 17, 4, 'Võ Thanh Nhàn', 'Other', '2024-12-10 00:00:00', 'thanhiscoding@gmail.com', '0702562318', 'thôn Thọ Vức, xã Hòa Kiến, thành phố Tuy Hòa, Phú Yên', 6, '2024-12-21 08:22:30', 'pending', 12000000, 1),
(43, 17, 4, 'Võ Thanh Nhàn', 'Other', '2024-12-10 00:00:00', 'thanhiscoding@gmail.com', '0702562318', 'thôn Thọ Vức, xã Hòa Kiến, thành phố Tuy Hòa, Phú Yên', 6, '2024-12-21 08:25:43', 'pending', 14800000, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `tour_id` int(11) DEFAULT NULL,
  `tour_price` float NOT NULL CHECK (`tour_price` >= 0),
  `service_id` int(11) DEFAULT NULL,
  `service_price` float NOT NULL CHECK (`service_price` >= 0),
  `number_of_services` int(11) NOT NULL CHECK (`number_of_services` > 0),
  `total_money_service` float DEFAULT NULL CHECK (`total_money_service` >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `tour_id`, `tour_price`, `service_id`, `service_price`, `number_of_services`, `total_money_service`) VALUES
(1, 1, 2, 4000000, 1, 500000, 2, 1000000),
(2, 2, 4, 5600000, 2, 350000, 4, 1400000),
(3, 3, 6, 2800000, 3, 700000, 1, 700000),
(4, 4, 8, 6400000, 4, 533333, 3, 1600000),
(5, 5, 10, 9600000, 5, 400000, 5, 2000000),
(6, 6, 12, 4800000, 2, 600000, 2, 1200000),
(7, 7, 14, 7200000, 3, 450000, 4, 1800000),
(8, 8, 16, 6400000, 4, 533333, 3, 1600000),
(9, 9, 18, 3600000, 1, 900000, 1, 900000),
(10, 10, 20, 4400000, 5, 550000, 2, 1100000),
(11, 1, 2, 4000000, 1, 500000, 2, 1000000),
(12, 2, 4, 5600000, 2, 350000, 4, 1400000),
(13, 3, 6, 2800000, 3, 700000, 1, 700000),
(14, 4, 8, 6400000, 4, 533333, 3, 1600000),
(15, 5, 10, 9600000, 5, 400000, 5, 2000000),
(16, 6, 12, 4800000, 2, 600000, 2, 1200000),
(17, 7, 14, 7200000, 3, 450000, 4, 1800000),
(18, 8, 16, 6400000, 4, 533333, 3, 1600000),
(19, 9, 18, 3600000, 1, 900000, 1, 900000),
(20, 10, 20, 4400000, 5, 550000, 2, 1100000),
(24, 32, 3, 0, 1, 700000, 1, 3400000),
(25, 32, 3, 0, 2, 1500000, 1, 3400000),
(26, 32, 3, 0, 3, 1200000, 1, 3400000),
(27, 36, 2, 0, 1, 700000, 1, 3400000),
(28, 36, 2, 0, 2, 1500000, 1, 3400000),
(29, 36, 2, 0, 3, 1200000, 1, 3400000),
(30, 38, 2, 0, 22, 800000, 1, 3500000),
(31, 38, 2, 0, 23, 1200000, 1, 3500000),
(32, 38, 2, 0, 2, 1500000, 1, 3500000),
(33, 43, 4, 0, 2, 1500000, 1, 2800000),
(34, 43, 4, 0, 6, 1300000, 1, 2800000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tour_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` >= 0 and `rating` <= 5),
  `note` longtext DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `tour_id`, `rating`, `note`) VALUES
(1, 6, 1, 4, 'Chuyến đi tuyệt vời, rất đáng giá! Hướng dẫn viên rất nhiệt tình và chuyên nghiệp.'),
(2, 7, 4, 4, 'Chuyến đi tốt, nhưng dịch vụ có thể cải thiện thêm chút nữa.'),
(3, 8, 6, 3, 'Chuyến đi bình thường, không có gì đặc biệt như mong đợi.'),
(4, 9, 8, 5, 'Chuyến đi tuyệt vời! Mọi thứ đều hoàn hảo từ đầu đến cuối.'),
(5, 10, 10, 2, 'Không đáng giá so với giá tiền. Rất thất vọng với chuyến đi này.'),
(6, 11, 12, 4, 'Chuyến đi tốt, nhưng đồ ăn chỉ ở mức trung bình thôi.'),
(7, 12, 14, 5, 'Trải nghiệm xuất sắc! Tôi sẽ quay lại nếu có dịp.'),
(8, 13, 16, 3, 'Chuyến đi cũng ổn, nhưng không có gì đặc sắc như mình mong đợi.'),
(9, 14, 18, 4, 'Chuyến đi khá hay, nhưng hướng dẫn viên hơi trễ và không có nhiều sự giải thích.'),
(10, 15, 20, 5, 'Đây là chuyến đi tuyệt vời nhất tôi từng tham gia! Mọi thứ đều hoàn hảo, từ phong cảnh đến dịch vụ.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `position` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `position`) VALUES
(1, 'CUSTOMER'),
(2, 'ADMIN'),
(3, 'EMPLOYEE'),
(4, 'MANAGER');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug_service` varchar(500) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `price` float NOT NULL CHECK (`price` >= 0),
  `service_category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `services`
--

INSERT INTO `services` (`id`, `name`, `slug_service`, `image_url`, `price`, `service_category_id`) VALUES
(1, 'Honda Wave Alpha', 'Honda-Wave-Alpha', 'public/uploads/images/services/honda_wave_alpha.jpg', 700000, 1),
(2, 'Yamaha Exciter 150', 'Yamaha-Exciter-50', 'public/uploads/images/services/yamaha_exciter_150.jpg', 1500000, 1),
(3, 'Honda Air Blade', 'Honda-Air-Blade', 'public/uploads/images/services/honda_air_blade.jpg', 1200000, 1),
(4, 'Honda SH 125i', 'Honda-SH-125i', 'public/uploads/images/services/honda_sh_125i.jpg', 1500000, 1),
(5, 'Suzuki GSX-R150', 'Suzuki-GSX-R150', 'public/uploads/images/services/suzuki_gsx_r150.jpg', 1350000, 1),
(6, 'Honda CBR 150R', 'Honda-CBR-150R', 'public/uploads/images/services/honda_cbr_150r.jpg', 1300000, 1),
(7, 'Piaggio Liberty 125', 'Piaggio-Liberty-125', 'public/uploads/images/services/piaggio_liberty_125.jpg', 1250000, 1),
(8, 'Vision bản thể thao', 'Vision-ban-the-thao', 'public/uploads/images/services/vision-the-thao.png', 1400000, 1),
(9, 'Vision 2024', 'Vision-2024', 'public/uploads/images/services/vision-2024.jpg', 1600000, 1),
(10, 'Vespa Primavera 150', 'Vespa-Primavera-150', 'public/uploads/images/services/vespa_primavera_150.jpg', 1500000, 1),
(11, 'Toyota Vios 2024', 'Toyota-Vios-2024', 'public/uploads/images/services/toyota_vios_2024.jpg', 2500000, 2),
(12, 'Hyundai Accent', 'Hyundai-Accent', 'public/uploads/images/services/hyundai_accent.jpg', 2300000, 2),
(13, 'Mazda 3', 'Mazda-3', 'public/uploads/images/services/mazda_3.jpg', 2800000, 2),
(14, 'Honda City', 'Honda-City', 'public/uploads/images/services/honda_city.jpg', 2400000, 2),
(15, 'Kia Cerato', 'Kia-Cerato', 'public/uploads/images/services/kia_cerato.jpg', 2600000, 2),
(16, 'VinFast VF 8', 'VinFast-VF-8', 'public/uploads/images/services/vinfast_vf8.jpg', 3200000, 2),
(17, 'Ford Ranger Wildtrak', 'Ford-Ranger-Wildtrak', 'public/uploads/images/services/ford_ranger_wildtrak.jpg', 3500000, 2),
(18, 'Toyota Fortuner', 'Toyota-Fortuner', 'public/uploads/images/services/toyota_fortuner.jpg', 4000000, 2),
(19, 'Mercedes-Benz C-Class', 'Mercedes-Benz-C-Class', 'public/uploads/images/services/mercedes_c_class.jpg', 5000000, 2),
(20, 'BMW 5 Series', 'BMW-5-Series', 'public/uploads/images/services/bmw_5_series.jpg', 5500000, 2),
(21, 'Combo Lều 2 Người', 'Combo-leu-2-nguoi', 'public/uploads/images/services/combo_leu_2_nguoi.jpg', 500000, 3),
(22, 'Combo Lều 4 Người', 'Combo-leu-4-nguoi', 'public/uploads/images/services/combo_leu_4_nguoi.jpg', 800000, 3),
(23, 'Combo Lều Gia Đình 6 Người', 'Combo-Leu-Gia-Dinh-6-Nguoi', 'public/uploads/images/services/combo_leu_gia_dinh_6_nguoi.jpg', 1200000, 3),
(24, 'Combo Lều Siêu Nhẹ 1 Người', 'Combo-Leu-Sieu-Nhe-1-Nguoi', 'public/uploads/images/services/combo_leu_sieu_nhe_1_nguoi.jpg', 400000, 3),
(25, 'Combo Lều Glamping Sang Trọng', 'Combo-Leu-Glamping-Sang-Trong', 'public/uploads/images/services/combo_leu_glamping.jpg', 2000000, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `service_categories`
--

CREATE TABLE `service_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `service_categories`
--

INSERT INTO `service_categories` (`id`, `name`) VALUES
(1, 'Xe máy'),
(2, 'Ô tô'),
(3, 'Combo cắm trại');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slugs`
--

CREATE TABLE `slugs` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `slugs`
--

INSERT INTO `slugs` (`id`, `name`, `category_id`) VALUES
(1, 'Mui-Ne-Kham-pha-Bai-Rang-Doi-Cat-Bay', 1),
(2, 'Phu-Quoc-Kham-pha-Dao-Ngoc', 1),
(3, 'Vung-Tau-Tham-quan-Bai-Truoc-Bai-Sau', 1),
(4, 'Can-Tho-Cho-Noi-Lang-Du-Lich-My-Khanh', 1),
(5, 'Da-Lat-Ho-Xuan-Huong-Thac-Datanla', 1),
(6, 'Tay-Ninh-Nui-Ba-Den-Chua-Linh-Son', 1),
(7, 'Ben-Tre-Vuon-Dua-Chua-Vinh-Trang', 1),
(8, 'Ca-Mau-Mui-Ca-Mau-Rung-U-Minh', 1),
(9, 'Rach-Gia-Khu-Du-Lich-Phu-Quoc', 1),
(10, 'Long-An-Dong-Thap-Muoi-Chua-Vinh-Nguyen', 1),
(11, 'Tien-Giang-Vuon-Cay-Chua-Vinh-Trang', 1),
(12, 'Mui-Ne-Kham-pha-Bai-Rang-Doi-Cat-Bay', 1),
(13, 'Phu-Quoc-Kham-pha-Dao-Ngoc', 1),
(14, 'Vung-Tau-Tham-quan-Bai-Truoc-Bai-Sau', 1),
(15, 'Can-Tho-Cho-Noi-Lang-Du-Lich-My-Khanh', 1),
(16, 'Da-Lat-Ho-Xuan-Huong-Thac-Datanla', 1),
(17, 'Tay-Ninh-Nui-Ba-Den-Chua-Linh-Son', 1),
(18, 'Ben-Tre-Vuon-Dua-Chua-Vinh-Trang', 1),
(19, 'Ca-Mau-Mui-Ca-Mau-Rung-U-Minh', 1),
(20, 'Rach-Gia-Khu-Du-Lich-Phu-Quoc', 1),
(21, 'Long-An-Dong-Thap-Muoi-Chua-Vinh-Nguyen', 1),
(22, 'Tien-Giang-Vuon-Cay-Chua-Vinh-Trang', 1),
(23, 'Ha-Long-Tham-quan-Vinh-Ha-Long', 2),
(24, 'Sa-Pa-Kham-pha-Fansipan', 2),
(25, 'Moc-Chau-Doi-che-thac-Dai-Yem', 2),
(26, 'Ninh-Binh-Trang-An-Bai-Dinh', 2),
(27, 'Ha-Giang-Dong-Van-Lung-Cu', 2),
(28, 'Mai-Chau-Ban-Lang-Thac', 2),
(29, 'Tam-Dao-Chua-Tay-Thien-Thac-Bac', 2),
(30, 'Cat-Ba-Vinh-Lan-Ha-Dao-Khi', 2),
(31, 'Yen-Bai-Ruong-Bac-Thang-Mu-Cang-Chai', 2),
(32, 'Hoa-Binh-Suoi-Nuoc-Nong-Kim-Boi', 2),
(33, 'Thai-Nguyen-Bao-Tang-Tra-Doi-Che', 2),
(34, 'Hue-Tham-quan-Kinh-Thanh-Hue', 3),
(35, 'Da-Nang-Ngu-Hanh-Son-Ba-Na-Hills', 3),
(36, 'Quang-Nam-Hoi-An-My-Son', 3),
(37, 'Nha-Trang-Vinpearl-Land-Thap-Ba-Ponagar', 3),
(38, 'Quang-Binh-Phong-Nha-Ke-Bang', 3),
(39, 'Quang-Tri-Cua-Tung-Ho-Con-Rua', 3),
(40, 'Binh-Dinh-Ky-Co-Eo-Gio', 3),
(41, 'Kon-Tum-Rung-Tram-Doi-Che', 3),
(42, 'Thanh-Hoa-Sam-Son-Cua-Lo', 3),
(43, 'Quang-Ngai-Ly-Son-Nui-Thien-An', 3),
(44, 'Phu-Yen-Ghenh-Da-Dia-Bai-Xep', 3),
(45, 'Gia-Lai-Ho-Tnung-Nui-Ham-Rong', 3),
(46, 'Ha-Noi-Da-Nang-Hoi-An', 4),
(47, 'Ho-Chi-Minh-Nha-Trang-Da-Lat', 4),
(48, 'Ha-Noi-Phu-Quoc', 4),
(49, 'Ha-Noi-Can-Tho', 4),
(50, 'Da-Nang-Ha-Noi', 4),
(51, 'Ha-Noi-Ninh-Binh-Sapa', 4),
(52, 'Da-Nang-Phu-Yen-Nha-Trang', 4),
(53, 'Ha-Noi-Ha-Long-Sapa', 4),
(54, 'Ho-Chi-Minh-Vung-Tau-Phan-Thiet', 4),
(55, 'Da-Lat-Ho-Chi-Minh', 4),
(56, 'Nha-Trang-Da-Lat', 4),
(57, 'Ha-Noi-Hue-Phu-Quoc', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tokenlogin`
--

CREATE TABLE `tokenlogin` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tours`
--

CREATE TABLE `tours` (
  `id` int(11) NOT NULL,
  `name` varchar(350) DEFAULT NULL COMMENT 'Tên tour',
  `slug` varchar(300) DEFAULT NULL,
  `price` float NOT NULL CHECK (`price` >= 0),
  `destination` varchar(200) DEFAULT '',
  `pick_up` varchar(200) DEFAULT '',
  `duration` varchar(100) DEFAULT NULL,
  `itinerary` varchar(300) DEFAULT NULL,
  `date_start` datetime NOT NULL,
  `thumbnail` varchar(300) DEFAULT '' COMMENT 'Ảnh preview tour/combo',
  `description` longtext DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `is_love` tinyint(1) DEFAULT 0,
  `loved_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tours`
--

INSERT INTO `tours` (`id`, `name`, `slug`, `price`, `destination`, `pick_up`, `duration`, `itinerary`, `date_start`, `thumbnail`, `description`, `created_at`, `updated_at`, `category_id`, `is_love`, `loved_by`) VALUES
(1, 'Mũi Né: Khám phá Bãi Rạng - Đồi Cát Bay', 'Mui-Ne-Kham-pha-Bai-Rang-Doi-Cat-Bay', 2500000, 'Mũi Né', 'Hồ Chí Minh', '2 Ngày 1 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-01-10 07:00:00', 'public/uploads/images/tours/mui-ne.jpg', 'Ẩm thực: Đặc sản biển, Bánh canh; Đối tượng thích hợp: Gia đình, Cặp đôi, Bạn bè; Thời gian lý tưởng: Mùa hè; Khuyến mãi: Giảm 15% cho nhóm từ 4 người trở lên.', '2024-12-13 08:00:00', NULL, 1, 0, NULL),
(2, 'Phú Quốc: Khám phá Đảo Ngọc', 'Phu-Quoc-Kham-pha-Dao-Ngoc_1', 3500000, 'Phú Quốc', 'Hồ Chí Minh', '3 Ngày 2 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-01-12 06:00:00', 'public/uploads/images/tours/phu-quoc.jpg', 'Ẩm thực: Hải sản tươi ngon, Đặc sản Phú Quốc; Đối tượng thích hợp: Gia đình, Cặp đôi, Du khách khám phá thiên nhiên; Thời gian lý tưởng: Mùa hè; Khuyến mãi: Giảm 20% cho khách đặt trước.', '2024-12-13 09:30:00', NULL, 1, 0, NULL),
(3, 'Vũng Tàu: Tham quan Bãi Trước - Bãi Sau', 'Vung-Tau-Tham-quan-Bai-Truoc-Bai-Sau', 1500000, 'Vũng Tàu', 'Hồ Chí Minh', '1 Ngày', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-01-15 07:30:00', 'public/uploads/images/tours/vung-tau.jpg', 'Ẩm thực: Hải sản tươi sống, Món ăn miền biển; Đối tượng thích hợp: Gia đình, Bạn bè; Thời gian lý tưởng: Mùa hè; Khuyến mãi: Giảm 10% cho nhóm từ 5 người trở lên.', '2024-12-13 10:15:00', NULL, 1, 0, NULL),
(4, 'Cần Thơ: Chợ Nổi - Làng Du Lịch Mỹ Khánh', 'Can-Tho-Cho-Noi-Lang-Du-Lich-My-Khanh_1', 2000000, 'Cần Thơ', 'Hồ Chí Minh', '2 Ngày 1 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-01-18 06:30:00', 'public/uploads/images/tours/can-tho.jpg', 'Ẩm thực: Đặc sản miền Tây, Món ăn từ cá, tôm; Đối tượng thích hợp: Gia đình, Bạn bè, Du khách yêu thích thiên nhiên; Thời gian lý tưởng: Mùa xuân và mùa hè; Khuyến mãi: Giảm 15% cho khách đặt trước.', '2024-12-13 11:00:00', NULL, 1, 0, NULL),
(5, 'Đà Lạt: Hồ Xuân Hương - Thác Datanla', 'Da-Lat-Ho-Xuan-Huong-Thac-Datanla_1', 2800000, 'Đà Lạt', 'Hồ Chí Minh', '2 Ngày 1 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-01-25 07:00:00', 'public/uploads/images/tours/da-lat.jpg', 'Ẩm thực: Đặc sản Đà Lạt, Mứt dâu, Bánh tráng nướng; Đối tượng thích hợp: Gia đình, Cặp đôi, Bạn bè; Thời gian lý tưởng: Mùa xuân và mùa thu; Khuyến mãi: Giảm 10% cho nhóm từ 4 người trở lên.', '2024-12-13 12:30:00', NULL, 1, 0, NULL),
(6, 'Tây Ninh: Núi Bà Đen - Chùa Linh Sơn', 'Tay-Ninh-Nui-Ba-Den-Chua-Linh-Son', 1200000, 'Tây Ninh', 'Hồ Chí Minh', '1 Ngày', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-02-05 06:00:00', 'public/uploads/images/tours/tay-ninh.jpg', 'Ẩm thực: Đặc sản miền Đông Nam Bộ, Các món từ thịt bò; Đối tượng thích hợp: Gia đình, Bạn bè, Du khách yêu thích văn hóa; Thời gian lý tưởng: Mùa xuân và mùa hè; Khuyến mãi: Giảm 10% cho nhóm từ 5 người.', '2024-12-13 14:30:00', NULL, 1, 0, NULL),
(7, 'Bến Tre: Vườn Dừa - Chùa Vĩnh Tràng', 'Ben-Tre-Vuon-Dua-Chua-Vinh-Trang', 1800000, 'Bến Tre', 'Hồ Chí Minh', '2 Ngày 1 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-02-10 07:30:00', 'public/uploads/images/tours/ben-tre.jpg', 'Ẩm thực: Món ăn từ dừa, đặc sản miền Tây; Đối tượng thích hợp: Gia đình, Bạn bè; Thời gian lý tưởng: Mùa xuân và mùa hè; Khuyến mãi: Giảm 5% cho khách đăng ký trước 30 ngày.', '2024-12-13 15:00:00', NULL, 1, 0, NULL),
(8, 'Cà Mau: Mũi Cà Mau - Rừng U Minh', 'Ca-Mau-Mui-Ca-Mau-Rung-U-Minh', 2200000, 'Cà Mau', 'Hồ Chí Minh', '2 Ngày 1 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-02-20 07:00:00', 'public/uploads/images/tours/ca-mau.jpg', 'Ẩm thực: Đặc sản biển, các món ăn từ cá, tôm; Đối tượng thích hợp: Gia đình, Bạn bè, Du khách yêu thích thiên nhiên; Thời gian lý tưởng: Mùa thu và mùa xuân; Khuyến mãi: Giảm 10% cho khách đăng ký trước.', '2024-12-13 16:00:00', NULL, 1, 0, NULL),
(9, 'Rạch Giá: Khu Du Lịch Phú Quốc', 'Rach-Gia-Khu-Du-Lich-Phu-Quoc', 3000000, 'Rạch Giá', 'Hồ Chí Minh', '3 Ngày 2 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-02-22 06:30:00', 'public/uploads/images/tours/rach-gia.jpg', 'Ẩm thực: Hải sản tươi ngon, các món ăn địa phương; Đối tượng thích hợp: Gia đình, Cặp đôi, Bạn bè; Thời gian lý tưởng: Mùa hè; Khuyến mãi: Giảm 20% cho khách đăng ký trước.', '2024-12-13 17:00:00', NULL, 1, 0, NULL),
(10, 'Long An: Đồng Tháp Mười - Chùa Vĩnh Nguyên', 'Long-An-Dong-Thap-Muoi-Chua-Vinh-Nguyen', 1600000, 'Long An', 'Hồ Chí Minh', '2 Ngày 1 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-03-01 07:00:00', 'public/uploads/images/tours/long-an.jpg', 'Ẩm thực: Đặc sản miền Tây, Món ăn từ gạo, cá; Đối tượng thích hợp: Gia đình, Bạn bè, Du khách yêu thích thiên nhiên; Thời gian lý tưởng: Mùa xuân và mùa thu; Khuyến mãi: Giảm 10% cho nhóm từ 5 người.', '2024-12-13 18:00:00', NULL, 1, 0, NULL),
(11, 'Tiền Giang: Vườn Cây - Chùa Vĩnh Tràng', 'Tien-Giang-Vuon-Cay-Chua-Vinh-Trang', 1500000, 'Tiền Giang', 'Hồ Chí Minh', '1 Ngày', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-03-05 07:30:00', 'public/uploads/images/tours/tien-giang.jpg', 'Ẩm thực: Món ăn đặc sản miền Tây, các món ăn từ gạo; Đối tượng thích hợp: Gia đình, Bạn bè, Du khách yêu thích khám phá; Thời gian lý tưởng: Mùa xuân và mùa hè; Khuyến mãi: Giảm 10% cho nhóm từ 4 người.', '2024-12-13 19:30:00', NULL, 1, 0, NULL),
(12, 'Mũi Né: Khám phá Bãi Rạng - Đồi Cát Bay', 'Mui-Ne-Kham-pha-Bai-Rang-Doi-Cat-Bay_1', 2500000, 'Mũi Né', 'Hồ Chí Minh', '2 Ngày 1 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-01-10 07:00:00', 'public/uploads/images/tours/mui-ne.jpg', 'Ẩm thực: Đặc sản biển, Bánh canh; Đối tượng thích hợp: Gia đình, Cặp đôi, Bạn bè; Thời gian lý tưởng: Mùa hè; Khuyến mãi: Giảm 15% cho nhóm từ 4 người trở lên.', '2024-12-13 08:00:00', NULL, 1, 0, NULL),
(13, 'Phú Quốc: Khám phá Đảo Ngọc', 'Phu-Quoc-Kham-pha-Dao-Ngoc', 3500000, 'Phú Quốc', 'Hồ Chí Minh', '3 Ngày 2 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-01-12 06:00:00', 'public/uploads/images/tours/phu-quoc.jpg', 'Ẩm thực: Hải sản tươi ngon, Đặc sản Phú Quốc; Đối tượng thích hợp: Gia đình, Cặp đôi, Du khách khám phá thiên nhiên; Thời gian lý tưởng: Mùa hè; Khuyến mãi: Giảm 20% cho khách đặt trước.', '2024-12-13 09:30:00', NULL, 1, 0, NULL),
(14, 'Vũng Tàu: Tham quan Bãi Trước - Bãi Sau', 'Vung-Tau-Tham-quan-Bai-Truoc-Bai-Sau', 1500000, 'Vũng Tàu', 'Hồ Chí Minh', '1 Ngày', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-01-15 07:30:00', 'public/uploads/images/tours/vung-tau.jpg', 'Ẩm thực: Hải sản tươi sống, Món ăn miền biển; Đối tượng thích hợp: Gia đình, Bạn bè; Thời gian lý tưởng: Mùa hè; Khuyến mãi: Giảm 10% cho nhóm từ 5 người trở lên.', '2024-12-13 10:15:00', NULL, 1, 0, NULL),
(15, 'Cần Thơ: Chợ Nổi - Làng Du Lịch Mỹ Khánh', 'Can-Tho-Cho-Noi-Lang-Du-Lich-My-Khanh', 2000000, 'Cần Thơ', 'Hồ Chí Minh', '2 Ngày 1 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-01-18 06:30:00', 'public/uploads/images/tours/can-tho.jpg', 'Ẩm thực: Đặc sản miền Tây, Món ăn từ cá, tôm; Đối tượng thích hợp: Gia đình, Bạn bè, Du khách yêu thích thiên nhiên; Thời gian lý tưởng: Mùa xuân và mùa hè; Khuyến mãi: Giảm 15% cho khách đặt trước.', '2024-12-13 11:00:00', NULL, 1, 0, NULL),
(16, 'Đà Lạt: Hồ Xuân Hương - Thác Datanla', 'Da-Lat-Ho-Xuan-Huong-Thac-Datanla', 2800000, 'Đà Lạt', 'Hồ Chí Minh', '2 Ngày 1 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-01-25 07:00:00', 'public/uploads/images/tours/da-lat.jpg', 'Ẩm thực: Đặc sản Đà Lạt, Mứt dâu, Bánh tráng nướng; Đối tượng thích hợp: Gia đình, Cặp đôi, Bạn bè; Thời gian lý tưởng: Mùa xuân và mùa thu; Khuyến mãi: Giảm 10% cho nhóm từ 4 người trở lên.', '2024-12-13 12:30:00', NULL, 1, 0, NULL),
(17, 'Tây Ninh: Núi Bà Đen - Chùa Linh Sơn', 'Tay-Ninh-Nui-Ba-Den-Chua-Linh-Son', 1200000, 'Tây Ninh', 'Hồ Chí Minh', '1 Ngày', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-02-05 06:00:00', 'public/uploads/images/tours/tay-ninh.jpg', 'Ẩm thực: Đặc sản miền Đông Nam Bộ, Các món từ thịt bò; Đối tượng thích hợp: Gia đình, Bạn bè, Du khách yêu thích văn hóa; Thời gian lý tưởng: Mùa xuân và mùa hè; Khuyến mãi: Giảm 10% cho nhóm từ 5 người.', '2024-12-13 14:30:00', NULL, 1, 0, NULL),
(18, 'Bến Tre: Vườn Dừa - Chùa Vĩnh Tràng', 'Ben-Tre-Vuon-Dua-Chua-Vinh-Trang', 1800000, 'Bến Tre', 'Hồ Chí Minh', '2 Ngày 1 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-02-10 07:30:00', 'public/uploads/images/tours/ben-tre.jpg', 'Ẩm thực: Món ăn từ dừa, đặc sản miền Tây; Đối tượng thích hợp: Gia đình, Bạn bè; Thời gian lý tưởng: Mùa xuân và mùa hè; Khuyến mãi: Giảm 5% cho khách đăng ký trước 30 ngày.', '2024-12-13 15:00:00', NULL, 1, 0, NULL),
(19, 'Cà Mau: Mũi Cà Mau - Rừng U Minh', 'Ca-Mau-Mui-Ca-Mau-Rung-U-Minh', 2200000, 'Cà Mau', 'Hồ Chí Minh', '2 Ngày 1 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-02-20 07:00:00', 'public/uploads/images/tours/ca-mau.jpg', 'Ẩm thực: Đặc sản biển, các món ăn từ cá, tôm; Đối tượng thích hợp: Gia đình, Bạn bè, Du khách yêu thích thiên nhiên; Thời gian lý tưởng: Mùa thu và mùa xuân; Khuyến mãi: Giảm 10% cho khách đăng ký trước.', '2024-12-13 16:00:00', NULL, 1, 0, NULL),
(20, 'Rạch Giá: Khu Du Lịch Phú Quốc', 'Rach-Gia-Khu-Du-Lich-Phu-Quoc', 3000000, 'Rạch Giá', 'Hồ Chí Minh', '3 Ngày 2 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-02-22 06:30:00', 'public/uploads/images/tours/rach-gia.jpg', 'Ẩm thực: Hải sản tươi ngon, các món ăn địa phương; Đối tượng thích hợp: Gia đình, Cặp đôi, Bạn bè; Thời gian lý tưởng: Mùa hè; Khuyến mãi: Giảm 20% cho khách đăng ký trước.', '2024-12-13 17:00:00', NULL, 1, 0, NULL),
(21, 'Long An: Đồng Tháp Mười - Chùa Vĩnh Nguyên', 'Long-An-Dong-Thap-Muoi-Chua-Vinh-Nguyen', 1600000, 'Long An', 'Hồ Chí Minh', '2 Ngày 1 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-03-01 07:00:00', 'public/uploads/images/tours/long-an.jpg', 'Ẩm thực: Đặc sản miền Tây, Món ăn từ gạo, cá; Đối tượng thích hợp: Gia đình, Bạn bè, Du khách yêu thích thiên nhiên; Thời gian lý tưởng: Mùa xuân và mùa thu; Khuyến mãi: Giảm 10% cho nhóm từ 5 người.', '2024-12-13 18:00:00', NULL, 1, 0, NULL),
(22, 'Tiền Giang: Vườn Cây - Chùa Vĩnh Tràng', 'Tien-Giang-Vuon-Cay-Chua-Vinh-Trang', 1500000, 'Tiền Giang', 'Hồ Chí Minh', '1 Ngày', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-03-05 07:30:00', 'public/uploads/images/tours/tien-giang.jpg', 'Ẩm thực: Món ăn đặc sản miền Tây, các món ăn từ gạo; Đối tượng thích hợp: Gia đình, Bạn bè, Du khách yêu thích khám phá; Thời gian lý tưởng: Mùa xuân và mùa hè; Khuyến mãi: Giảm 10% cho nhóm từ 4 người.', '2024-12-13 19:30:00', NULL, 1, 0, NULL),
(23, 'Hạ Long: Tham quan Vịnh Hạ Long', 'Ha-Long-Tham-quan-Vinh-Ha-Long', 3500000, 'Hạ Long', 'Hà Nội', '3 Ngày 2 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-01-15 08:00:00', 'public/uploads/images/tours/ha-long.jpg', 'Ẩm thực: Buffet sáng, Theo thực đơn, Đặc sản địa phương; Đối tượng thích hợp: Cặp đôi, Gia đình nhiều thế hệ, Thanh niên; Thời gian lý tưởng: Mùa hè; Khuyến mãi: Giảm 20% cho các khách hàng đặt trước.', '2024-12-13 10:00:00', NULL, 2, 0, NULL),
(24, 'Sa Pa: Khám phá Fansipan', 'Sa-Pa-Kham-pha-Fansipan', 2500000, 'Sa Pa', 'Hà Nội', '2 Ngày 1 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-01-20 06:00:00', 'public/uploads/images/tours/sapa.png', 'Ẩm thực: Đặc sản vùng cao; Đối tượng: Gia đình, Thanh niên; Thời gian lý tưởng: Mùa đông; Khuyến mãi: Giảm 10% cho nhóm từ 4 người trở lên.', '2024-12-13 10:00:00', NULL, 2, 0, NULL),
(25, 'Mộc Châu: Đồi chè - thác Dải Yếm', 'Moc-Chau-Doi-che-thac-Dai-Yem', 2200000, 'Mộc Châu', 'Hà Nội', '2 Ngày 1 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-02-05 07:00:00', 'public/uploads/images/tours/moc-chau.jpg', 'Ẩm thực: Đặc sản vùng núi; Đối tượng thích hợp: Gia đình, Bạn bè; Thời gian lý tưởng: Mùa xuân và mùa thu; Khuyến mãi: Giảm giá 15% cho nhóm từ 4 người trở lên.', '2024-12-13 10:00:00', NULL, 2, 0, NULL),
(26, 'Ninh Bình: Tràng An - Bái Đính', 'Ninh-Binh-Trang-An-Bai-Dinh', 1200000, 'Ninh Bình', 'Hà Nội', '1 Ngày', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-01-10 07:30:00', 'public/uploads/images/tours/ninh-binh.jpg', 'Ẩm thực: Món đặc sản Ninh Bình; Đối tượng thích hợp: Gia đình, Bạn bè; Thời gian lý tưởng: Mùa xuân; Khuyến mãi: Giảm 10% cho nhóm từ 5 người trở lên.', '2024-12-13 10:00:00', NULL, 2, 0, NULL),
(27, 'Hà Giang: Đồng Văn - Lũng Cú', 'Ha-Giang-Dong-Van-Lung-Cu', 3000000, 'Hà Giang', 'Hà Nội', '3 Ngày 2 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-01-22 06:00:00', 'public/uploads/images/tours/ha-giang.jpg', 'Ẩm thực: Đặc sản dân tộc vùng cao, như bánh cuốn, thịt trâu gác bếp; Đối tượng thích hợp: Phượt thủ, Gia đình; Thời gian lý tưởng: Mùa xuân và mùa thu; Khuyến mãi: Giảm 5% cho khách đăng ký trước 30 ngày.', '2024-12-13 10:00:00', NULL, 2, 0, NULL),
(28, 'Mai Châu: Bản Làng - Thác', 'Mai-Chau-Ban-Lang-Thac', 1500000, 'Mai Châu', 'Hà Nội', '2 Ngày 1 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-03-10 08:00:00', 'public/uploads/images/tours/mai-chau.jpg', 'Ẩm thực: Thực đơn đặc trưng dân tộc Thái; Đối tượng thích hợp: Cặp đôi, Gia đình; Thời gian lý tưởng: Mùa hè và mùa thu; Khuyến mãi: Giảm 10% cho khách đặt sớm.', '2024-12-13 10:00:00', NULL, 2, 0, NULL),
(29, 'Tam Đảo: Chùa Tây Thiên - Thác Bạc', 'Tam-Dao-Chua-Tay-Thien-Thac-Bac', 1800000, 'Tam Đảo', 'Hà Nội', '1 Ngày', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-01-15 07:00:00', 'public/uploads/images/tours/tam-dao.jpeg', 'Ẩm thực: Món ăn đặc sản Tam Đảo; Đối tượng thích hợp: Gia đình, Bạn bè; Thời gian lý tưởng: Mùa xuân và mùa hè; Khuyến mãi: Giảm 10% cho các đoàn nhóm.', '2024-12-13 10:00:00', NULL, 2, 0, NULL),
(30, 'Cát Bà: Vịnh Lan Hạ - Đảo Khỉ', 'Cat-Ba-Vinh-Lan-Ha-Dao-Khi', 3200000, 'Cát Bà', 'Hà Nội', '3 Ngày 2 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-04-05 08:00:00', 'public/uploads/images/tours/cat-ba.jpg', 'Ẩm thực: Hải sản tươi ngon, đặc sản Cát Bà; Đối tượng thích hợp: Gia đình, Bạn bè, Cặp đôi; Thời gian lý tưởng: Mùa hè; Khuyến mãi: Giảm 10% cho các khách đặt sớm.', '2024-12-13 10:00:00', NULL, 2, 0, NULL),
(31, 'Yên Bái: Ruộng Bậc Thang - Mù Cang Chải', 'Yen-Bai-Ruong-Bac-Thang-Mu-Cang-Chai', 2700000, 'Yên Bái', 'Hà Nội', '2 Ngày 1 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-02-18 06:30:00', 'public/uploads/images/tours/yen-bai.jpg', 'Ẩm thực: Đặc sản vùng núi Tây Bắc; Đối tượng thích hợp: Phượt thủ, Gia đình; Thời gian lý tưởng: Mùa thu; Khuyến mãi: Giảm 10% cho nhóm từ 4 người trở lên.', '2024-12-13 10:00:00', NULL, 2, 0, NULL),
(32, 'Hòa Bình: Suối Nước Nóng Kim Bôi', 'Hoa-Binh-Suoi-Nuoc-Nong-Kim-Boi', 2000000, 'Hòa Bình', 'Hà Nội', '2 Ngày 1 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-02-25 07:00:00', 'public/uploads/images/tours/hoa-binh.jpg', 'Ẩm thực: Đặc sản Hòa Bình, các món ăn từ thịt trâu, cá suối; Đối tượng thích hợp: Người yêu thiên nhiên, Gia đình, Cặp đôi; Thời gian lý tưởng: Mùa xuân và mùa thu; Khuyến mãi: Giảm 20% cho các khách hàng đặt trước.', '2024-12-13 10:00:00', NULL, 2, 0, NULL),
(33, 'Thái Nguyên: Bảo Tàng Trà - Đồi Chè', 'Thai-Nguyen-Bao-Tang-Tra-Doi-Che', 1000000, 'Thái Nguyên', 'Hà Nội', '1 Ngày', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-03-12 07:00:00', 'public/uploads/images/tours/thai-nguyen.jpg', 'Ẩm thực: Đặc sản Đà Lạt, Mứt dâu, Bánh tráng nướng; Đối tượng thích hợp: Gia đình, Cặp đôi, Bạn bè; Thời gian lý tưởng: Mùa xuân và mùa thu; Khuyến mãi: Giảm 10% cho nhóm từ 4 người trở lên.', '2024-12-13 10:00:00', NULL, 2, 0, NULL),
(34, 'Huế: Tham quan Kinh Thành Huế', 'Hue-Tham-quan-Kinh-Thanh-Hue', 3000000, 'Huế', 'Đà Nẵng', '2 Ngày 1 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-02-01 08:00:00', 'public/uploads/images/tours/hue.jpg', 'Ẩm thực: Đặc sản Huế, Bánh bèo, Bánh cuốn; Đối tượng thích hợp: Gia đình, Cặp đôi, Du khách yêu thích lịch sử; Thời gian lý tưởng: Mùa xuân, mùa hè; Khuyến mãi: Giảm 10% cho nhóm từ 5 người.', '2024-12-13 09:00:00', NULL, 3, 0, NULL),
(35, 'Đà Nẵng: Ngũ Hành Sơn - Bà Nà Hills', 'Da-Nang-Ngu-Hanh-Son-Ba-Na-Hills', 2500000, 'Đà Nẵng', 'Hà Nội', '2 Ngày 1 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-02-05 07:30:00', 'public/uploads/images/tours/da-nang.png', 'Ẩm thực: Mì Quảng, Bánh tráng cuốn thịt heo; Đối tượng thích hợp: Gia đình, Bạn bè, Du khách thích khám phá thiên nhiên; Thời gian lý tưởng: Mùa hè, mùa thu; Khuyến mãi: Giảm 15% cho khách đặt trước.', '2024-12-13 10:15:00', NULL, 3, 0, NULL),
(36, 'Quảng Nam: Hội An - Mỹ Sơn', 'Quang-Nam-Hoi-An-My-Son', 2800000, 'Quảng Nam', 'Đà Nẵng', '3 Ngày 2 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-02-10 06:30:00', 'public/uploads/images/tours/quang-nam.jpg', 'Ẩm thực: Cao Lầu, Hoành Thánh, Bánh Đập; Đối tượng thích hợp: Gia đình, Cặp đôi, Du khách yêu thích văn hóa; Thời gian lý tưởng: Mùa xuân, mùa hè; Khuyến mãi: Giảm 10% cho nhóm từ 4 người.', '2024-12-13 11:30:00', NULL, 3, 0, NULL),
(37, 'Nha Trang: Vinpearl Land - Tháp Bà Ponagar', 'Nha-Trang-Vinpearl-Land-Thap-Ba-Ponagar', 3500000, 'Nha Trang', 'Hà Nội', '3 Ngày 2 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-02-15 07:00:00', 'public/uploads/images/tours/nha-trang.jpg', 'Ẩm thực: Hải sản tươi ngon, Món ăn đặc trưng Nha Trang; Đối tượng thích hợp: Gia đình, Cặp đôi, Bạn bè; Thời gian lý tưởng: Mùa hè; Khuyến mãi: Giảm 20% cho khách đặt trước.', '2024-12-13 12:00:00', NULL, 3, 0, NULL),
(38, 'Quảng Bình: Phong Nha - Kẻ Bàng', 'Quang-Binh-Phong-Nha-Ke-Bang', 3200000, 'Quảng Bình', 'Hà Nội', '3 Ngày 2 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-02-20 06:45:00', 'public/uploads/images/tours/quang-binh.jpeg', 'Ẩm thực: Món ăn Quảng Bình, Hải sản tươi ngon; Đối tượng thích hợp: Gia đình, Bạn bè, Du khách yêu thích thiên nhiên; Thời gian lý tưởng: Mùa xuân, mùa thu; Khuyến mãi: Giảm 15% cho khách đăng ký trước.', '2024-12-13 13:15:00', NULL, 3, 0, NULL),
(39, 'Quảng Trị: Cửa Tùng - Hồ Con Rùa', 'Quang-Tri-Cua-Tung-Ho-Con-Rua', 2200000, 'Quảng Trị', 'Đà Nẵng', '2 Ngày 1 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-02-25 08:00:00', 'public/uploads/images/tours/quang-tri.jpg', 'Ẩm thực: Đặc sản Quảng Trị, Món ăn dân dã miền Trung; Đối tượng thích hợp: Gia đình, Bạn bè, Du khách yêu thích lịch sử; Thời gian lý tưởng: Mùa xuân, mùa thu; Khuyến mãi: Giảm 10% cho nhóm từ 3 người.', '2024-12-13 14:00:00', NULL, 3, 0, NULL),
(40, 'Bình Định: Kỳ Co - Eo Gió', 'Binh-Dinh-Ky-Co-Eo-Gio', 2400000, 'Bình Định', 'Đà Nẵng', '2 Ngày 1 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-03-01 06:30:00', 'public/uploads/images/tours/binh-dinh.jpg', 'Ẩm thực: Bánh xèo, Mỳ Quảng, Hải sản tươi sống; Đối tượng thích hợp: Gia đình, Cặp đôi, Bạn bè; Thời gian lý tưởng: Mùa hè; Khuyến mãi: Giảm 15% cho khách đặt nhóm.', '2024-12-13 15:00:00', NULL, 3, 0, NULL),
(41, 'Kon Tum: Rừng Tràm - Đồi Chè', 'Kon-Tum-Rung-Tram-Doi-Che', 2600000, 'Kon Tum', 'Đà Nẵng', '3 Ngày 2 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-03-05 07:15:00', 'public/uploads/images/tours/kon-tum.jpg', 'Ẩm thực: Món ăn miền Tây, Đặc sản Kon Tum; Đối tượng thích hợp: Gia đình, Du khách yêu thích khám phá thiên nhiên; Thời gian lý tưởng: Mùa thu, mùa xuân; Khuyến mãi: Giảm 10% cho nhóm từ 4 người.', '2024-12-13 16:00:00', NULL, 3, 0, NULL),
(42, 'Thanh Hóa: Sầm Sơn - Cửa Lò', 'Thanh-Hoa-Sam-Son-Cua-Lo', 2700000, 'Thanh Hóa', 'Hà Nội', '3 Ngày 2 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-03-10 09:00:00', 'public/uploads/images/tours/thanh-hoa.jpg', 'Ẩm thực: Hải sản, Đặc sản biển; Đối tượng thích hợp: Gia đình, Bạn bè, Du khách yêu thích biển; Thời gian lý tưởng: Mùa hè; Khuyến mãi: Giảm 10% cho nhóm từ 5 người.', '2024-12-13 17:30:00', NULL, 3, 0, NULL),
(43, 'Quảng Ngãi: Lý Sơn - Núi Thiên Ấn', 'Quang-Ngai-Ly-Son-Nui-Thien-An', 3300000, 'Quảng Ngãi', 'Hồ Chí Minh', '3 Ngày 2 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-03-15 08:30:00', 'public/uploads/images/tours/quang-ngai.jpg', 'Ẩm thực: Hải sản Lý Sơn, Đặc sản Quảng Ngãi; Đối tượng thích hợp: Gia đình, Bạn bè, Du khách yêu thích thiên nhiên; Thời gian lý tưởng: Mùa xuân, mùa hè; Khuyến mãi: Giảm 15% cho khách đặt trước.', '2024-12-13 18:00:00', NULL, 3, 0, NULL),
(44, 'Phú Yên: Ghềnh Đá Đĩa - Bãi Xép', 'Phu-Yen-Ghenh-Da-Dia-Bai-Xep', 3200000, 'Phú Yên', 'Hà Nội', '2 Ngày 1 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-03-20 07:00:00', 'public/uploads/images/tours/phu-yen.jpg', 'Ẩm thực: Hải sản tươi sống, Bánh hỏi; Đối tượng thích hợp: Gia đình, Bạn bè, Du khách yêu thích khám phá thiên nhiên; Thời gian lý tưởng: Mùa hè, mùa thu; Khuyến mãi: Giảm 10% cho khách đặt nhóm.', '2024-12-13 18:30:00', NULL, 3, 0, NULL),
(45, 'Gia Lai: Hồ T’nưng - Núi Hàm Rồng', 'Gia-Lai-Ho-Tnung-Nui-Ham-Rong', 3100000, 'Gia Lai', 'Đà Nẵng', '3 Ngày 2 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-03-25 08:00:00', 'public/uploads/images/tours/gia-lai.jpeg', 'Ẩm thực: Món ăn Gia Lai, đặc sản Tây Nguyên; Đối tượng thích hợp: Gia đình, Bạn bè, Du khách yêu thích thiên nhiên; Thời gian lý tưởng: Mùa xuân, mùa hè; Khuyến mãi: Giảm 15% cho khách đặt nhóm.', '2024-12-13 19:00:00', NULL, 3, 0, NULL),
(46, 'Hà Nội - Đà Nẵng - Hội An', 'Ha-Noi-Da-Nang-Hoi-An', 4000000, 'Hà Nội, Đà Nẵng, Hội An', 'Hà Nội', '4 Ngày 3 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-01-20 08:00:00', 'public/uploads/images/tours/hanoi-da-nang-hoi-an.jpg', 'Ẩm thực: Mì Quảng, Cao Lầu, Phở, Đặc sản miền Trung; Đối tượng thích hợp: Gia đình, Cặp đôi, Du khách yêu thích di sản và lịch sử; Thời gian lý tưởng: Mùa xuân, Mùa thu; Khuyến mãi: Giảm 15% cho nhóm từ 5 người.', '2024-12-13 08:00:00', NULL, 4, 0, NULL),
(47, 'Hồ Chí Minh - Nha Trang - Đà Lạt', 'Ho-Chi-Minh-Nha-Trang-Da-Lat', 4500000, 'Hồ Chí Minh, Nha Trang, Đà Lạt', 'Hồ Chí Minh', '5 Ngày 4 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-02-15 09:00:00', 'public/uploads/images/tours/ho-chi-minh-nha-trang-da-lat.jpg', 'Ẩm thực: Hải sản tươi sống, Bánh căn, Bánh tráng nướng, Đặc sản Đà Lạt; Đối tượng thích hợp: Gia đình, Bạn bè, Du khách yêu thích biển và núi; Thời gian lý tưởng: Mùa xuân, Mùa hè; Khuyến mãi: Giảm 10% cho khách nhóm từ 6 người.', '2024-12-13 09:00:00', NULL, 4, 0, NULL),
(48, 'Hà Nội - Phú Quốc', 'Ha-Noi-Phu-Quoc', 5000000, 'Hà Nội, Phú Quốc', 'Hà Nội', '4 Ngày 3 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-03-10 08:00:00', 'public/uploads/images/tours/ha-noi-phu-quoc.jpg', 'Ẩm thực: Hải sản Phú Quốc, Đặc sản địa phương, Món ăn Việt Nam; Đối tượng thích hợp: Cặp đôi, Gia đình, Du khách yêu thích nghỉ dưỡng và biển; Thời gian lý tưởng: Mùa hè, Mùa thu; Khuyến mãi: Giảm 20% cho khách đặt sớm.', '2024-12-13 10:00:00', NULL, 4, 0, NULL),
(49, 'Hà Nội - Cần Thơ', 'Ha-Noi-Can-Tho', 3700000, 'Hà Nội, Cần Thơ', 'Hà Nội', '3 Ngày 2 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-03-15 07:30:00', 'public/uploads/images/tours/ha-noi-can-tho.jpg', 'Ẩm thực: Đặc sản miền Tây, Cơm gà, Gỏi cuốn, Bánh xèo; Đối tượng thích hợp: Gia đình, Bạn bè, Du khách yêu thích khám phá miền sông nước; Thời gian lý tưởng: Mùa xuân, Mùa hè; Khuyến mãi: Giảm 15% cho nhóm từ 4 người.', '2024-12-13 11:00:00', NULL, 4, 0, NULL),
(50, 'Đà Nẵng - Hà Nội', 'Da-Nang-Ha-Noi', 4200000, 'Đà Nẵng, Hà Nội', 'Đà Nẵng', '3 Ngày 2 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-04-01 08:00:00', 'public/uploads/images/tours/da-nang-ha-noi.jpg', 'Ẩm thực: Phở, Bánh cuốn, Đặc sản Hà Nội; Đối tượng thích hợp: Du khách yêu thích lịch sử và di sản văn hóa; Thời gian lý tưởng: Mùa thu, Mùa xuân; Khuyến mãi: Giảm 20% cho khách đăng ký nhóm từ 5 người.', '2024-12-13 12:00:00', NULL, 4, 0, NULL),
(51, 'Hà Nội - Ninh Bình - Sapa', 'Ha-Noi-Ninh-Binh-Sapa', 4700000, 'Hà Nội, Ninh Bình, Sapa', 'Hà Nội', '5 Ngày 4 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-04-10 08:00:00', 'public/uploads/images/tours/ha-noi-ninh-binh-sapa.jpg', 'Ẩm thực: Cơm cháy Ninh Bình, Lẩu cá Sapa, Đặc sản địa phương; Đối tượng thích hợp: Du khách yêu thích thiên nhiên, gia đình, nhóm bạn; Thời gian lý tưởng: Mùa xuân, Mùa thu; Khuyến mãi: Giảm 10% cho khách đặt trước.', '2024-12-13 13:00:00', NULL, 4, 0, NULL),
(52, 'Đà Nẵng - Phú Yên - Nha Trang', 'Da-Nang-Phu-Yen-Nha-Trang', 4800000, 'Đà Nẵng, Phú Yên, Nha Trang', 'Đà Nẵng', '4 Ngày 3 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-05-05 09:00:00', 'public/uploads/images/tours/da-nang-phu-yen-nha-trang.jpg', 'Ẩm thực: Hải sản, Bánh căn, Phở, Đặc sản miền Trung; Đối tượng thích hợp: Gia đình, Bạn bè, Du khách yêu thích biển và đảo; Thời gian lý tưởng: Mùa hè, Mùa thu; Khuyến mãi: Giảm 15% cho nhóm từ 4 người.', '2024-12-13 14:00:00', NULL, 4, 0, NULL),
(53, 'Hà Nội - Hạ Long - Sapa', 'Ha-Noi-Ha-Long-Sapa', 5200000, 'Hà Nội, Hạ Long, Sapa', 'Hà Nội', '5 Ngày 4 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-06-01 10:00:00', 'public/uploads/images/tours/ha-noi-ha-long-sapa.jpg', 'Ẩm thực: Phở, Lẩu cá Sapa, Đặc sản Hạ Long, Bánh cuốn Hà Nội; Đối tượng thích hợp: Du khách yêu thích thiên nhiên, lịch sử và di sản; Thời gian lý tưởng: Mùa xuân, Mùa thu; Khuyến mãi: Giảm 20% cho khách đăng ký sớm.', '2024-12-13 15:00:00', NULL, 4, 0, NULL),
(54, 'Hồ Chí Minh - Vũng Tàu - Phan Thiết', 'Ho-Chi-Minh-Vung-Tau-Phan-Thiet', 4500000, 'Hồ Chí Minh, Vũng Tàu, Phan Thiết', 'Hồ Chí Minh', '4 Ngày 3 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-07-10 08:30:00', 'public/uploads/images/tours/ho-chi-minh-vung-tau-phan-thiet.jpg', 'Ẩm thực: Hải sản Vũng Tàu, Bánh canh, Đặc sản Phan Thiết; Đối tượng thích hợp: Gia đình, Du khách yêu thích biển và nghỉ dưỡng; Thời gian lý tưởng: Mùa hè, Mùa thu; Khuyến mãi: Giảm 10% cho khách nhóm từ 5 người.', '2024-12-13 16:00:00', NULL, 4, 0, NULL),
(55, 'Đà Lạt - Hồ Chí Minh', 'Da-Lat-Ho-Chi-Minh', 4600000, 'Đà Lạt, Hồ Chí Minh', 'Đà Lạt', '3 Ngày 2 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-08-05 08:00:00', 'public/uploads/images/tours/da-lat-ho-chi-minh.jpg', 'Ẩm thực: Cơm tấm, Phở, Bánh xèo; Đối tượng thích hợp: Du khách yêu thích khám phá, gia đình, bạn bè; Thời gian lý tưởng: Mùa xuân, Mùa hè; Khuyến mãi: Giảm 15% cho khách nhóm từ 4 người.', '2024-12-13 17:00:00', NULL, 4, 0, NULL),
(56, 'Nha Trang - Đà Lạt', 'Nha-Trang-Da-Lat', 4300000, 'Nha Trang, Đà Lạt', 'Nha Trang', '3 Ngày 2 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-09-01 08:00:00', 'public/uploads/images/tours/nha-trang-da-lat.jpg', 'Ẩm thực: Bánh căn, Lẩu thả, Đặc sản Đà Lạt; Đối tượng thích hợp: Gia đình, Du khách yêu thích nghỉ dưỡng và khám phá thiên nhiên; Thời gian lý tưởng: Mùa xuân, Mùa thu; Khuyến mãi: Giảm 10% cho nhóm từ 3 người.', '2024-12-13 18:00:00', NULL, 4, 0, NULL),
(57, 'Hà Nội - Huế - Phú Quốc', 'Ha-Noi-Hue-Phu-Quoc', 4900000, 'Hà Nội, Huế, Phú Quốc', 'Hà Nội', '5 Ngày 4 Đêm', 'Ngày 1: Hồ Chí Minh - Mũi Né: ăn trưa tại nhà hàng, tham quan Bãi Rạng, Đồi Cát Bay; Ngày 2: Hồ Chí Minh - Bình Thuận:Ăn sáng tại khách sạn, tham quan các địa danh khác, ăn trưa tại nhà hàng, trở về Hồ Chí Minh, ăn tối tại nhà hàng.', '2024-10-01 09:00:00', 'public/uploads/images/tours/ha-noi-hue-phu-quoc.jpg', 'Ẩm thực: Bánh bèo Huế, Hải sản Phú Quốc, Đặc sản Hà Nội; Đối tượng thích hợp: Du khách yêu thích lịch sử, biển đảo và nghỉ dưỡng; Thời gian lý tưởng: Mùa hè, Mùa thu; Khuyến mãi: Giảm 20% cho khách đặt tour sớm.', '2024-12-13 19:00:00', NULL, 4, 0, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tour_images`
--

CREATE TABLE `tour_images` (
  `id` int(11) NOT NULL,
  `tour_id` int(11) DEFAULT NULL,
  `image_url` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT '',
  `avatar_url` varchar(300) DEFAULT 'public/uploads/images/user/avt-default.png',
  `fullname` varchar(100) DEFAULT '',
  `phone_number` varchar(10) NOT NULL,
  `email` varchar(100) DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `activeToken` varchar(100) NOT NULL DEFAULT '',
  `forgotToken` varchar(100) NOT NULL DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `avatar_url`, `fullname`, `phone_number`, `email`, `password`, `activeToken`, `forgotToken`, `created_at`, `updated_at`, `status`, `role_id`) VALUES
(1, 'Admin', 'public/uploads/images/user/avt-default.png', 'Admin', '0357151521', 'admin@gmail.com', '$2y$10$K75zlRmNEejqMx1/lyt4heniBt860lwLxuaFU7bjs1SLm29pknUAq', '', '', '2024-12-13 15:24:17', NULL, 1, 2),
(2, 'Employee', 'public/uploads/images/user/avt-default.png', 'Employee', '0832847284', 'employee@gmail.com', '$2y$10$pSbKaXQ50/1cxBZtfHMfGOIHtKBWthpgKzLgXov4Rq5K60nVSAB4C', '', '', '2024-12-13 15:30:37', NULL, 1, 3),
(3, 'ManagerN', 'public/uploads/images/user/avt-default.png', 'Manager Miền Nam', '0473847284', 'managerN@gmail.com', '$2y$10$mtMZX0fHAOfhSh3DkzGRxulflXJ9quwD3aNdvC3hQOrwWbC5gb.i2', '', '', '2024-12-13 15:31:53', NULL, 1, 4),
(4, 'ManagerT', 'public/uploads/images/user/avt-default.png', 'Manager Miền Trung', '0836837363', 'managerT@gmail.com', '$2y$10$2qnx96ijy7RDscjFRzFNwOsNp/Tt4/85qQFQ3bQBe.wYjdcNMLHCm', '', '', '2024-12-13 15:32:56', NULL, 1, 4),
(5, 'ManagerB', 'public/uploads/images/user/avt-default.png', 'Manager Miền Bắc', '0758374829', 'managerB@gmail.com', '$2y$10$JsPN/4/Xm9EmSI9S2r5SJuwioso1OXgRFyoZsGltuZb0UXwJ5JUD2', '', '', '2024-12-13 15:33:36', NULL, 1, 4),
(6, 'tranminhhoa', 'public/uploads/images/user/avavt-default.png', 'Trần Minh Hòa', '0971234567', 'hoa.tran@gmail.com', '$2y$10$abcdEFghIjklmnopQRStuvWxYz1234567890abcdefgHIJKLmnoPQRStuv', '', '', '2024-12-14 09:00:00', NULL, 1, 1),
(7, 'nguyenthilan', 'public/uploads/images/user/avt-default.png', 'Nguyễn Thị Lan', '0912345678', 'lan.nguyen@gmail.com', '$2y$10$abcdEFghIjklmnopQRStuvWxYz1234567890abcdefgHIJKLmnoPQRStuv', '', '', '2024-12-14 09:15:00', NULL, 1, 1),
(8, 'lehoanganh', 'public/uploads/images/user/avt-default.png', 'Lê Hoàng Anh', '0934567890', 'hoanganh.le@gmail.com', '$2y$10$abcdEFghIjklmnopQRStuvWxYz1234567890abcdefgHIJKLmnoPQRStuv', '', '', '2024-12-14 09:30:00', NULL, 1, 1),
(9, 'phamvanduc', 'public/uploads/images/user/avt-default.png', 'Phạm Văn Đức', '0945678901', 'duc.pham@gmail.com', '$2y$10$abcdEFghIjklmnopQRStuvWxYz1234567890abcdefgHIJKLmnoPQRStuv', '', '', '2024-12-14 09:45:00', NULL, 1, 1),
(10, 'dothihuong', 'public/uploads/images/user/avt-default.png', 'Đỗ Thị Hương', '0966789012', 'huong.do@gmail.com', '$2y$10$abcdEFghIjklmnopQRStuvWxYz1234567890abcdefgHIJKLmnoPQRStuv', '', '', '2024-12-14 10:00:00', NULL, 1, 1),
(11, 'ngoducthinh', 'public/uploads/images/user/avt-default.png', 'Ngô Đức Thịnh', '0987890123', 'thinh.ngo@gmail.com', '$2y$10$abcdEFghIjklmnopQRStuvWxYz1234567890abcdefgHIJKLmnoPQRStuv', '', '', '2024-12-14 10:15:00', NULL, 1, 1),
(12, 'vuhaien', 'public/uploads/images/user/avt-default.png', 'Vũ Hải Yến', '0928901234', 'yen.vu@gmail.com', '$2y$10$abcdEFghIjklmnopQRStuvWxYz1234567890abcdefgHIJKLmnoPQRStuv', '', '', '2024-12-14 10:30:00', NULL, 1, 1),
(13, 'phananhtu', 'public/uploads/images/user/avt-default.png', 'Phan Anh Tú', '0939012345', 'tu.phan@gmail.com', '$2y$10$abcdEFghIjklmnopQRStuvWxYz1234567890abcdefgHIJKLmnoPQRStuv', '', '', '2024-12-14 10:45:00', NULL, 1, 1),
(14, 'buiminhngoc', 'public/uploads/images/user/avt-default.png', 'Bùi Minh Ngọc', '0950123456', 'ngoc.bui@gmail.com', '$2y$10$abcdEFghIjklmnopQRStuvWxYz1234567890abcdefgHIJKLmnoPQRStuv', '', '', '2024-12-14 11:00:00', NULL, 1, 1),
(15, 'trinhthuylinh', 'public/uploads/images/user/avt-default.png', 'Trịnh Thùy Linh', '0971234568', 'linh.trinh@gmail.com', '$2y$10$abcdEFghIjklmnopQRStuvWxYz1234567890abcdefgHIJKLmnoPQRStuv', '', '', '2024-12-14 11:15:00', NULL, 1, 1),
(16, 'V&otilde; Thanh Nh&agrave;n', 'public/uploads/images/user/avt-default.png', 'V&otilde; Thanh Nh&agrave;n', '0702562318', 'vothanhnhan06@gmail.com', '$2y$10$twrQ847y1sMWaUEvTH08LO3T.nVwpAbMCjV2q8Vqh5zKi5ATRPFYS', '84054b25b215870c17235b8cc4abd18c45243f7c', '', '2024-12-18 12:29:15', NULL, 0, 1),
(17, 'V&otilde; Thanh Nh&agrave;n', 'public/uploads/images/user/avt-default.png', 'V&otilde; Thanh Nh&agrave;n', '0702562318', 'thanhiscoding@gmail.com', '$2y$10$xcFw4XMoGoPtjPcoyk5mBOmt1GNPhJohsIvFc.IUuGXKMa3byn96e', '', '', '2024-12-19 05:31:13', NULL, 1, 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `tour_id` (`tour_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_category_id` (`service_category_id`);

--
-- Chỉ mục cho bảng `service_categories`
--
ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `slugs`
--
ALTER TABLE `slugs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tokenlogin`
--
ALTER TABLE `tokenlogin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `fk_loved_by` (`loved_by`);

--
-- Chỉ mục cho bảng `tour_images`
--
ALTER TABLE `tour_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_images_tour_id` (`tour_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `service_categories`
--
ALTER TABLE `service_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tokenlogin`
--
ALTER TABLE `tokenlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tours`
--
ALTER TABLE `tours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT cho bảng `tour_images`
--
ALTER TABLE `tour_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`);

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`),
  ADD CONSTRAINT `order_details_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Các ràng buộc cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`);

--
-- Các ràng buộc cho bảng `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`service_category_id`) REFERENCES `service_categories` (`id`);

--
-- Các ràng buộc cho bảng `slugs`
--
ALTER TABLE `slugs`
  ADD CONSTRAINT `slugs_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tours` (`id`);

--
-- Các ràng buộc cho bảng `tokenlogin`
--
ALTER TABLE `tokenlogin`
  ADD CONSTRAINT `tokenlogin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `tours`
--
ALTER TABLE `tours`
  ADD CONSTRAINT `fk_loved_by` FOREIGN KEY (`loved_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tours_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Các ràng buộc cho bảng `tour_images`
--
ALTER TABLE `tour_images`
  ADD CONSTRAINT `fk_images_tour_id` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tour_images_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
