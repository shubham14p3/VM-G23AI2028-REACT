

CREATE DATABASE iit_g23ai2028;
USE iit_g23ai2028;

CREATE TABLE `student` (
  `id` int(10) NOT NULL,
  `stdname` text NOT NULL,
  `stdreg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `student` (`id`, `stdname`, `stdreg`) VALUES
(3, 'komol saha', '22'),
(4, 'robin khanx', '5555555'),
(7, 'Uttam Kumar Saha', '201');

ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `student`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
