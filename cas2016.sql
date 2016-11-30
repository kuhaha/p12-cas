-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- ホスト: 127.0.0.1
-- 生成日時: 2016 年 11 月 22 日 10:09
-- サーバのバージョン: 5.5.27
-- PHP のバージョン: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- データベース: `cas2016`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_course`
--

CREATE TABLE IF NOT EXISTS `tb_course` (
  `cid` int(11) DEFAULT NULL,
  `abbrev` varchar(32) NOT NULL,
  `cname` varchar(32) DEFAULT NULL,
  `detail` text,
  `min_credit` int(11) DEFAULT NULL,
  `min_gpa` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `tb_course`
--

INSERT INTO `tb_course` (`cid`, `abbrev`, `cname`, `detail`, `min_credit`, `min_gpa`) VALUES
(1, '応用', '情報技術応用コース', '履修モデルの中から興味・適性のある情報技術および適用分野をいくつか選択し、それらの専門的知識を身につけ、実問題へ応用する方法を学ぶコース。', NULL, NULL),
(2, '総合', '情報科学総合コース', '情報科学・情報技術を基礎から総合的に学んだ上で、履修モデルの中から興味・適性のある情報技術および適用分野を選択するコース。', 38, 2);

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_entry`
--

CREATE TABLE IF NOT EXISTS `tb_entry` (
  `sid` varchar(16) NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `etime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `note` text NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `tb_entry`
--

INSERT INTO `tb_entry` (`sid`, `cid`, `etime`, `note`) VALUES
('16JK201', 1, '2016-11-21 10:05:21', '頑張ります。'),
('16JK202', 1, '2016-11-18 03:32:02', ''),
('16JK203', 1, '2016-11-18 03:32:13', ''),
('16JK205', 2, '2016-11-18 03:32:32', '');

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_schedule`
--

CREATE TABLE IF NOT EXISTS `tb_schedule` (
  `stime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ltime` datetime DEFAULT NULL,
  `etime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`stime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `tb_schedule`
--

INSERT INTO `tb_schedule` (`stime`, `ltime`, `etime`) VALUES
('2016-11-30 14:40:00', '2017-01-20 17:00:00', '2016-11-30 10:08:15');

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_student`
--

CREATE TABLE IF NOT EXISTS `tb_student` (
  `sid` varchar(16) NOT NULL,
  `uid` varchar(16) NOT NULL,
  `sname` varchar(32) NOT NULL,
  `halfgp` int(11) DEFAULT NULL,
  `halfgpa` double DEFAULT NULL,
  `allgp` int(11) DEFAULT NULL,
  `allgpa` double DEFAULT NULL,
  `decision` int(11) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `tb_student`
--

INSERT INTO `tb_student` (`sid`, `uid`, `sname`, `halfgp`, `halfgpa`, `allgp`, `allgpa`, `decision`) VALUES
('16JK201', 'k16jk201', '入江 隆司', 20, 3.1, 42, 3.5, 0),
('16JK202', 'k16jk202', '日野 昌宏', 23, 2.3, 46, 3.4, 0),
('16JK203', 'k16jk203', '今田 一平', 11, 1.5, 23, 1.4, 0),
('16JK204', 'k16jk204', '畠中 浩志', 19, 2.3, 30, 2.5, 0),
('16JK205', 'k16jk205', '佐治 慧', 20, 3.1, 42, 2.9, 0),
('16JK206', 'k16jk206', '西住 慶一', 10, 1.3, 21, 1.5, 0),
('16JK207', 'k16jk207', '安谷 史樹', 23, 2.6, 47, 2.9, 0),
('16JK208', 'k16jk208', '烏野 基広', 21, 3.3, 41, 3.1, 0),
('16JK209', 'k16jk209', '田積 純生', 24, 2.9, 48, 3.5, 0),
('16JK210', 'k16jk210', '府内 進', 18, 2.4, 30, 1.9, 0),
('16JK211', 'k16jk211', '下部 堅二', 9, 1, 20, 1.2, 0),
('16JK212', 'k16jk212', '山後 広夢', 21, 2.2, 44, 2.8, 0),
('16JK213', 'k16jk213', '中郷 翔貴', 11, 1.7, 27, 1.6, 0),
('16JK214', 'k16jk214', '茂井 凱', 20, 2.5, 46, 3.1, 0),
('16JK215', 'k16jk215', '力本 明央', 19, 2.8, 38, 2.6, 0),
('16JK216', 'k16jk216', '信楽 太希', 26, 3.8, 48, 4.1, 0),
('16JK217', 'k16jk217', '高 浩次', 19, 2.7, 37, 2.5, 0),
('16JK218', 'k16jk218', '若吉 元弘', 22, 2.4, 44, 2.8, 0),
('16JK219', 'k16jk219', '船着 のり', 17, 2.2, 36, 1.9, 0),
('16JK220', 'k16jk220', '成ヶ澤 岳司', 21, 3.1, 40, 3.3, 0),
('16JK221', 'k16jk221', '信海 太希', 26, 3.8, 48, 4.1, 0),
('16JK222', 'k16jk222', '高海 浩次', 19, 2.7, 37, 2.5, 0),
('16JK223', 'k16jk223', '若海 元弘', 22, 2.4, 44, 2.8, 0),
('16JK224', 'k16jk224', '船海 のり', 17, 2.2, 36, 1.9, 0),
('16JK225', 'k16jk225', '成ヶ海 岳司', 21, 3.1, 40, 3.3, 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
  `uid` varchar(16) NOT NULL,
  `uname` varchar(32) NOT NULL,
  `upass` varchar(16) NOT NULL,
  `urole` int(11) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `tb_user`
-- urole: 1 - 学生、　2- 教員, 3-教員
--

INSERT INTO `tb_user` (`uid`, `uname`, `upass`, `urole`) VALUES
('admin', '管理者', '1234', 9),
('joho1', '教員担当者', '1234', 3),
('joho2', '教員一般', '1234', 2),
('k16jk201', '入江 隆司', 'abcd', 1),
('k16jk202', '日野 昌宏', 'abcd', 1),
('k16jk203', '今田 一平', 'abcd', 1),
('k16jk204', '畠中 浩志', 'abcd', 1),
('k16jk205', '佐治 慧', 'abcd', 1),
('k16jk206', '西住 慶一', 'abcd', 1),
('k16jk207', '安谷 史樹', 'abcd', 1),
('k16jk208', '烏野 基広', 'abcd', 1),
('k16jk209', '田積 純生', 'abcd', 1),
('k16jk210', '府内 進', 'abcd', 1),
('k16jk211', '下部 堅二', 'abcd', 1),
('k16jk212', '山後 広夢', 'abcd', 1),
('k16jk213', '中郷 翔貴', 'abcd', 1),
('k16jk214', '茂井 凱', 'abcd', 1),
('k16jk215', '力本 明央', 'abcd', 1),
('k16jk216', '信楽 太希', 'abcd', 1),
('k16jk217', '高 浩次', 'abcd', 1),
('k16jk218', '若吉 元弘', 'abcd', 1),
('k16jk219', '船着 のり', 'abcd', 1),
('k16jk220', '成ヶ澤 岳司', 'abcd', 1),
('k16jk221', '信海 太希', 'abcd', 1),
('k16jk222', '高海 浩次', 'abcd', 1),
('k16jk223', '若海 元弘', 'abcd', 1),
('k16jk224', '船海 のり', 'abcd', 1),
('k16jk225', '成ヶ海 岳司', 'abcd', 1);

-- --------------------------------------------------------

--
-- ビュー `vw_kibo`
--
CREATE VIEW vw_kibo AS
SELECT s.*, e.cid, c.cname,e.note 
FROM tb_course c,tb_entry e, tb_student s
WHERE c.cid=e.cid and e.sid=s.sid
UNION
SELECT *, 0 as cid, '未提出' as cname,null
FROM tb_student WHERE sid NOT IN 
 (SELECT sid FROM tb_entry)
ORDER BY sid;