-- MySQL dump 10.11
--
-- Host: localhost    Database: kyfrm
-- ------------------------------------------------------
-- Server version	5.0.51b-community-nt

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ky_form`
--

DROP TABLE IF EXISTS `ky_form`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `ky_form` (
  `id` int(10) NOT NULL auto_increment,
  `title` varchar(100) NOT NULL,
  `content` mediumtext NOT NULL,
  `f_date` varchar(30) NOT NULL,
  `pid` int(11) default '0',
  `ischeck` int(2) NOT NULL default '0',
  `sortid` int(10) default '0',
  `upfile` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=gbk;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `ky_form`
--

LOCK TABLES `ky_form` WRITE;
/*!40000 ALTER TABLE `ky_form` DISABLE KEYS */;
INSERT INTO `ky_form` VALUES (2,'故障频发拷问中国地铁安全 高速发展存隐忧','<p class=\"first\">扶梯故障、线路失电、方向开错、车门无法打开……近期，京、沪、穗等城市曝出地铁故障多发，引起社会关注。对于这一每天运输数十万乃至数百万人的“高密度”交通工具来说，一个小小的疏忽，都可能酿成严重的后果。</p>\r\n<p>“新华视点”记者采访发现，国内一些城市轨道交通存在运能“超负荷”、人才短缺、技术“摊薄”等诸多问题。眼下不少地方“大建地铁”，从安全运营的角度看，填补技术、管理、人才等各种“软肋”迫在眉睫。</p>\r\n<p><b>故障频发拷问“地铁安全”</b></p>\r\n<p>进入暑期以来，多个城市地铁故障时有发生。</p>\r\n<p>在北京，7月2日，地铁10号线信号系统出现故障，导致行车间隔加大；4日，地铁4号线安河桥北站至北宫门站隧道一侧电缆脱落，区间轨道停电；5日，北京地铁4号线动物园地铁站发生电梯逆行事故，造成1死30伤；8月3日，地铁13号线一列车一节车厢发生抱闸故障，随后退出正线运行回库检修……</p>\r\n<p>在上海，7月28日，地铁10号线因信号升级调试过程发生故障，使一趟列车开错方向；31日，地铁3号线上海南站至龙漕路区段供电线路失电，该区段列车限速运行；8月4日，地铁2号线因设备故障，发生延误超过半个小时……</p>\r\n<p>在广州，7月18日，地铁5号线三溪站往滘口方向一处道岔出现故障；8月2日，4号线信号设备故障问题……</p>\r\n<p>调查表明，近年来随着越来越多的城市迈入“地铁时代”，轨道交通故障、事故成多发态势，公众对“地铁安全”的关注持续升温。</p>','2011-08-08 13:08:31',0,0,1,NULL),(3,'故障频发拷问“地铁安全”','<p class=\"first\">扶梯故障、线路失电、方向开错、车门无法打开……近期，京、沪、穗等城市曝出地铁故障多发，引起社会关注。对于这一每天运输数十万乃至数百万人的“高密度”交通工具来说，一个小小的疏忽，都可能酿成严重的后果。</p>\r\n<p>“新华视点”记者采访发现，国内一些城市轨道交通存在运能“超负荷”、人才短缺、技术“摊薄”等诸多问题。眼下不少地方“大建地铁”，从安全运营的角度看，填补技术、管理、人才等各种“软肋”迫在眉睫。</p>\r\n<p><b>故障频发拷问“地铁安全”</b></p>\r\n<p>进入暑期以来，多个城市地铁故障时有发生。</p>\r\n<p>在北京，7月2日，地铁10号线信号系统出现故障，导致行车间隔加大；4日，地铁4号线安河桥北站至北宫门站隧道一侧电缆脱落，区间轨道停电；5日，北京地铁4号线动物园地铁站发生电梯逆行事故，造成1死30伤；8月3日，地铁13号线一列车一节车厢发生抱闸故障，随后退出正线运行回库检修……</p>\r\n<p>在上海，7月28日，地铁10号线因信号升级调试过程发生故障，使一趟列车开错方向；31日，地铁3号线上海南站至龙漕路区段供电线路失电，该区段列车限速运行；8月4日，地铁2号线因设备故障，发生延误超过半个小时……</p>\r\n<p>在广州，7月18日，地铁5号线三溪站往滘口方向一处道岔出现故障；8月2日，4号线信号设备故障问题……</p>\r\n<p>调查表明，近年来随着越来越多的城市迈入“地铁时代”，轨道交通故障、事故成多发态势，公众对“地铁安全”的关注持续升温。</p>','2011-08-08 13:08:46',2,0,1,NULL),(4,'郑州官方称巡防队“阻志愿者下水救人”说法不实','<p class=\"first\">中新网郑州8月8日电(记者齐永)针对媒体报道《郑州义务搜救队欲下水搜寻溺水者 遭巡防队阻止》一事，郑州市委宣传部回应称，“冬泳队员”提出下水也仅是实施“打捞”，而非“紧急情况下”的“救援”和“救人”。</p>\r\n<p>针对媒体报道称，郑州一名市民在郑州郑东新区如意湖溺水，当地一个公益团体郑州市水上义务搜救队东区队长牛振西带人赶到现场施救，却遭到了巡防队员的阻止，他们要求牛振西必须出示“打捞许可证”，否则不能下水。最终，溺水市民抢救无效死亡。</p>\r\n<p>对此，郑州市委宣传部回应称，事发后，郑东新区管委会立即组成了联合调查组，进行了调查。</p>\r\n<p>据介绍，8月4日早上，负责郑东新区河道管养工作的河南水利建筑工程有限公司人员宋师傅在昆丽河众意路至九如路段(并非网友反映的“如意湖”)巡逻时，发现了许多白酒瓶玻璃碎片及白色运动外衣一件，疑有人在河中游泳溺水，通过其遗落在现场的手机与其家人联系，家人反映此人为孟姓女士，半年前被确诊为癌症晚期，有重度抑郁症，8月3日晚酒后外出至今未归。</p>\r\n<p>结合现场遗落物品和家人所述情况，河道管养人员在不确定孟女士是否落水的情况下，通知其家人迅速赶到现场进行寻找，并第一时间向公安和消防部门报警。</p>\r\n<p>郑东新区公安部门和消防大队中午接到报警后，迅速赶赴现场，并在怀疑其极有可能跳水的地方，派出打捞船只和消防人员实施打捞。经过2个多小时的打捞，搜救范围不断缩小，但仍未发现人员溺亡迹象。</p>','2011-08-08 13:08:21',1,0,1,NULL),(5,'心情','555555555555555','2011-08-08 13:08:47',1,0,1,NULL),(6,'心情','11111','2011-08-08 13:08:55',1,0,2,NULL),(7,'心情','wwww','2011-08-08 13:08:01',0,0,1,NULL),(8,'心情','111','2011-08-08 13:08:08',0,1,1,NULL),(9,'心情','222','2011-08-08 13:08:15',0,1,2,NULL),(10,'测试发表','qqq','2011-08-08 15:08:41',0,1,1,NULL),(11,'测试发表','qqq','2011-08-08 15:08:44',0,0,1,NULL),(12,'测试发表','qqq','2011-08-08 15:08:22',0,0,1,NULL),(13,'心情','111','2011-08-08 13:08:22',0,1,1,NULL),(14,'心情','www','2011-08-08 13:08:28',0,0,1,NULL),(18,'这是','<p>呵呵</p>\r\n<p>不知道</p>','2011-08-08 18:08:09',0,1,1,NULL),(19,'有惊无险“梅花”绕过辽宁在朝鲜西部登陆','&lt;br /&gt;\r\n&amp;nbsp;&lt;img src=\\&quot;http://image1.chinanews.com.cn/cnsupload/big/2011/08-07/4-426/bd467db1ac644ee49f78e8e1eace72bf.jpg\\&quot; /&gt; &lt;p align=\\&quot;left\\&quot;&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;8月7日，台风“梅花”抵近山东半岛，海边巨浪涛天。自7日8时起山东海事局启动防抗台风一级应急响应程序，全力防范即将到来的台风“梅花”。中新社发 毕华明 摄 图片来源：CNSPHOTO&amp;nbsp;&amp;nbsp;&lt;/p&gt;\r\n&lt;!--图片搜索--&gt;&lt;!--正文--&gt;&lt;div class=\\&quot;left_zw\\&quot;&gt;&lt;!--放大缩小字体功能--&gt;&lt;span id=\\&quot;fontzoom\\&quot;&gt; &lt;p&gt;　　中新网大连8月8日电 (宋太盛 董永君)第9号强热带风暴“梅花”减弱为热带风暴后，8日上午绕过大连袭向丹东，并于19时再次与丹东擦肩而过。据最新“梅花”路径概率预报图显示，“梅花”已于傍晚前后在朝鲜西部沿海登陆。 &lt;table border=\\&quot;0\\&quot; cellspacing=\\&quot;0\\&quot; cellpadding=\\&quot;0\\&quot; align=\\&quot;left\\&quot; class=\\&quot;ke-zeroborder\\&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;!--[4,175,19] published at 2011-08-08 08:39:22 from #202 by 194--&gt;&lt;!--大运会--&gt;&lt;div id=\\&quot;adhzh\\&quot; name=\\&quot;hzh\\&quot;&gt;\r\n&lt;table border=\\&quot;0\\&quot; cellspacing=\\&quot;0\\&quot; cellpadding=\\&quot;0\\&quot; align=\\&quot;left\\&quot; class=\\&quot;ke-zeroborder\\&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;/div&gt;\r\n&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;　　大连市区的天气在下午3时左右已见晴朗。傍晚时，有些地方已可以见到阳光透过云层。记者驱车从大连赶往丹东跟随“梅花”行踪的路上，18时左右在城子坦附近遇到降雨强风。到达庄河市地段时，天空云层变薄，丹东方向的云层也渐渐由深灰变浅。&lt;/p&gt;\r\n&lt;p&gt;　　据中央气象台8月8日18时发布台风蓝色预警：今年第9号强热带风暴“梅花”于8月8日17时减弱为热带风暴，17时其中心位于朝鲜西部近海海面，就是北纬39.3度、东经124.8度，中心附近最大风力9级(23米/秒)，中心最低气压为980百帕。&lt;/p&gt;\r\n&lt;p&gt;　　据辽宁海事局负责人介绍，截至8月8日16时，辽宁海事局共出动防抗台风执法人员756人次，执法车辆346台次，提供船舶助航信息847次，避免海上险情44次，辽宁辖区在港避风船舶1222艘安全无事故。自8月7日早晨至17时，庄河辖区共抢运游客6299人次安全出岛。从8月6日下午起至8月7日中午14时，将滞留在獐岛和大鹿岛的1万多名游客全部安全疏散出岛。&lt;/p&gt;\r\n&lt;p&gt;　　该负责人还介绍，该局下属的丹东海事局从8月6日下午起至8月7日中午14时，将滞留在獐岛和大鹿岛的1万多名游客全部安全疏散出岛，船舶营运秩序良好，未发生任何水上事故，并于“梅花”到来之前，在巡视鸭绿江水道时协调“辽丹115”轮救助拖带无动力船舶“珑源6”至码头，将鸭绿江上所有安全隐患船舶清除完毕。(&lt;/p&gt;\r\n&lt;/span&gt;&lt;/div&gt;','2013-10-27 08:10:20',0,0,1,NULL),(23,'11test','&lt;p&gt;test&lt;/p&gt;','2013-10-27 08:10:46',0,0,1,NULL),(24,'232323eeeee','33322222222222222222','2013-10-27 09:10:31',0,0,1,NULL);
/*!40000 ALTER TABLE `ky_form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ky_sort`
--

DROP TABLE IF EXISTS `ky_sort`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `ky_sort` (
  `id` int(11) NOT NULL auto_increment,
  `sortname` varchar(50) NOT NULL,
  `parentid` int(11) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=gbk;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `ky_sort`
--

LOCK TABLES `ky_sort` WRITE;
/*!40000 ALTER TABLE `ky_sort` DISABLE KEYS */;
INSERT INTO `ky_sort` VALUES (1,'心情',0),(2,'原创',0),(3,'心情子菜单3',1),(4,'心情子菜单2',1),(5,'1111',0),(6,'test1111',0);
/*!40000 ALTER TABLE `ky_sort` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ky_user`
--

DROP TABLE IF EXISTS `ky_user`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `ky_user` (
  `id` int(10) NOT NULL auto_increment,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `ky_user`
--

LOCK TABLES `ky_user` WRITE;
/*!40000 ALTER TABLE `ky_user` DISABLE KEYS */;
INSERT INTO `ky_user` VALUES (1,'admin','c3284d0f94606de143894a0e4a801fc3');
/*!40000 ALTER TABLE `ky_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-11-03 16:39:43
