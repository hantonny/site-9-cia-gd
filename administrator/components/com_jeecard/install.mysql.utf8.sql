CREATE TABLE IF NOT EXISTS `#__jeecard_category` (
  `catid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `description` longtext NOT NULL,
  `catparent` int(11) NOT NULL,
  `published` tinyint(4) NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`catid`)
) DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `#__jeecard_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `send_id` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8 ;

DROP TABLE IF EXISTS `#__jeecard_configration`;
CREATE TABLE IF NOT EXISTS `#__jeecard_configration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail_tempt` longtext NOT NULL,
  `cat_id` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8;

INSERT INTO `#__jeecard_configration` (`id`, `mail_tempt`, `cat_id`) VALUES
(1, '<table border="0" cellspacing="0" cellpadding="15">\r\n<tbody>\r\n<tr>\r\n<td valign="top">\r\n<div id="host">\r\n<p style="font-family: Helvetica,Arial,sans-serif; font-size: 13px; color: #000000; line-height: 15px; margin: 0pt;">{host_name} invited you to</p>\r\n<h1 style="color: #000000; font-size: 20px; line-height: 24px; margin-top: 5px;">{event_title}</h1>\r\n</div>\r\n<div id="event_details" style="padding: 0pt 0pt 10px;">\r\n<p style="font-family: Helvetica,Arial,sans-serif; font-size: 13px; color: #666666;">{date}</p>\r\n<p style="font-family: Helvetica,Arial,sans-serif; font-size: 13px; color: #666666;"><span style="font-size: 10px; color: #999999; text-transform: uppercase;">Where:</span><br /> {location}<br /> {address}<br /> {city}</p>\r\n<p>{yes}{maybe}{no}</p>\r\n</div>\r\n<div id="more">\r\n<p style="font-family: Helvetica,Arial,sans-serif; font-size: 15px;">{view_invitation}</p>\r\n</div>\r\n</td>\r\n<td valign="top">{image}</td>\r\n</tr>\r\n</tbody>\r\n</table>', '1,2');


CREATE TABLE IF NOT EXISTS `#__jeecard_contact` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `hostid` int(11) NOT NULL,
  `contact_name` varchar(200) NOT NULL,
  `contact_email` varchar(250) NOT NULL,
  `groupid` int(11) NOT NULL,
  PRIMARY KEY (`cid`)
) DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `#__jeecard_event` (
  `eventid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `b_image` varchar(100) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `color` varchar(11) NOT NULL,
  `description` longtext NOT NULL,
  `catid` int(11) NOT NULL,
  `published` tinyint(4) NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`eventid`)
) DEFAULT CHARSET=utf8 ;
CREATE TABLE IF NOT EXISTS `#__jeecard_eventlist` (
  `eventlist_id` int(11) NOT NULL AUTO_INCREMENT,
  `eventid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_title` varchar(100) NOT NULL,
  `catid` int(11) NOT NULL,
  `host` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `location_name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `event_time` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `message` longtext NOT NULL,
  `rsvp` tinyint(4) NOT NULL,
  `comment` tinyint(4) NOT NULL,
  `hideguest` tinyint(4) NOT NULL,
  `noguests` varchar(100) NOT NULL,
  `inviteother` tinyint(4) NOT NULL,
  `bringother` tinyint(4) NOT NULL,
  `limit` varchar(100) NOT NULL,
  `indicateattending` tinyint(4) NOT NULL,
  `host_email` varchar(100) NOT NULL,
  PRIMARY KEY (`eventlist_id`)
) DEFAULT CHARSET=utf8 ;
CREATE TABLE IF NOT EXISTS `#__jeecard_eventsent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eventlist_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `yes` tinyint(4) NOT NULL,
  `maybe` tinyint(4) NOT NULL,
  `no` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8 ;
CREATE TABLE IF NOT EXISTS `#__jeecard_group` (
  `groupid` int(11) NOT NULL AUTO_INCREMENT,
  `groupname` varchar(500) NOT NULL,
  `uid` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `published` tinyint(4) NOT NULL,
  PRIMARY KEY (`groupid`)
) DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `#__jeecard_groupcontact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupid` int(11) NOT NULL,
  `contactid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `#__jeecard_register` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `sex` tinyint(4) NOT NULL,
  PRIMARY KEY (`r_id`)
) DEFAULT CHARSET=utf8 ;
CREATE TABLE IF NOT EXISTS `#__jeecard_style` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `style` varchar(100) NOT NULL,
  `who` varchar(100) NOT NULL,
  `yes` varchar(100) NOT NULL,
  `maybe` varchar(100) NOT NULL,
  `no` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8 ;