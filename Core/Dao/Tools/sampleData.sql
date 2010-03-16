DROP TABLE IF EXISTS `kangtia1_property`.`Address`;
CREATE TABLE IF NOT EXISTS `kangtia1_property`.`Address` (
	PRIMARY KEY  (`id`),
	`id` int(8) NOT NULL auto_increment ,
	`active` int(1) NOT NULL default 1 ,
	`created` DATETIME NOT NULL ,
	`updated` TIMESTAMP NOT NULL  default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
	`CreatedById` int(8) NOT NULL ,
	`UpdatedById` int(8) NOT NULL ,
	`Line1` varchar(30) NOT NULL ,
	`Line2` varchar(30) NOT NULL ,
	`Suburb` varchar(30) NOT NULL ,
	`PostCode` varchar(30) NOT NULL ,
	`StateId` int(8) NOT NULL ,
	`CountryId` int(8) NOT NULL 
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
DROP TABLE IF EXISTS `kangtia1_property`.`Content`;
CREATE TABLE IF NOT EXISTS `kangtia1_property`.`Content` (
	PRIMARY KEY  (`id`),
	`id` int(8) NOT NULL auto_increment ,
	`active` int(1) NOT NULL default 1 ,
	`created` DATETIME NOT NULL ,
	`updated` TIMESTAMP NOT NULL  default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
	`CreatedById` int(8) NOT NULL ,
	`UpdatedById` int(8) NOT NULL ,
	`title` varchar(30) NOT NULL ,
	`intro` varchar(12000) NOT NULL ,
	`fullText` text(255) NOT NULL ,
	`onFrontPage` int(1) NOT NULL default 1 
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
DROP TABLE IF EXISTS `kangtia1_property`.`ContentCategory`;
CREATE TABLE IF NOT EXISTS `kangtia1_property`.`ContentCategory` (
	PRIMARY KEY  (`id`),
	`id` int(8) NOT NULL auto_increment ,
	`active` int(1) NOT NULL default 1 ,
	`created` DATETIME NOT NULL ,
	`updated` TIMESTAMP NOT NULL  default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
	`CreatedById` int(8) NOT NULL ,
	`UpdatedById` int(8) NOT NULL ,
	`name` varchar(30) NOT NULL 
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
DROP TABLE IF EXISTS `kangtia1_property`.`ContentCategory_content_Content_contentCategory`;
CREATE TABLE IF NOT EXISTS `kangtia1_property`.`ContentCategory_content_Content_contentCategory` (
	`contentId` int(8) NOT NULL ,
	`contentCategoryId` int(8) NOT NULL 
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
DROP TABLE IF EXISTS `kangtia1_property`.`Module`;
CREATE TABLE IF NOT EXISTS `kangtia1_property`.`Module` (
	PRIMARY KEY  (`id`),
	`id` int(8) NOT NULL auto_increment ,
	`active` int(1) NOT NULL default 1 ,
	`created` DATETIME NOT NULL ,
	`updated` TIMESTAMP NOT NULL  default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
	`CreatedById` int(8) NOT NULL ,
	`UpdatedById` int(8) NOT NULL ,
	`title` varchar(30) NOT NULL ,
	`content` varchar(64000) NOT NULL ,
	`params` varchar(64000) NOT NULL ,
	`position` varchar(30) NOT NULL ,
	`phpClass` varchar(30) NOT NULL ,
	`order` int(8) NOT NULL default 1 ,
	`showtitle` int(1) NOT NULL default 1 
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
DROP TABLE IF EXISTS `kangtia1_property`.`Country`;
CREATE TABLE IF NOT EXISTS `kangtia1_property`.`Country` (
	PRIMARY KEY  (`id`),
	`id` int(8) NOT NULL auto_increment ,
	`active` int(1) NOT NULL default 1 ,
	`created` DATETIME NOT NULL ,
	`updated` TIMESTAMP NOT NULL  default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
	`CreatedById` int(8) NOT NULL ,
	`UpdatedById` int(8) NOT NULL ,
	`Name` varchar(30) NOT NULL 
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
DROP TABLE IF EXISTS `kangtia1_property`.`Person`;
CREATE TABLE IF NOT EXISTS `kangtia1_property`.`Person` (
	PRIMARY KEY  (`id`),
	`id` int(8) NOT NULL auto_increment ,
	`active` int(1) NOT NULL default 1 ,
	`created` DATETIME NOT NULL ,
	`updated` TIMESTAMP NOT NULL  default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
	`CreatedById` int(8) NOT NULL ,
	`UpdatedById` int(8) NOT NULL ,
	`FirstName` varchar(30) NOT NULL ,
	`LastName` varchar(30) NOT NULL 
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
DROP TABLE IF EXISTS `kangtia1_property`.`Role`;
CREATE TABLE IF NOT EXISTS `kangtia1_property`.`Role` (
	PRIMARY KEY  (`id`),
	`id` int(8) NOT NULL auto_increment ,
	`active` int(1) NOT NULL default 1 ,
	`created` DATETIME NOT NULL ,
	`updated` TIMESTAMP NOT NULL  default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
	`CreatedById` int(8) NOT NULL ,
	`UpdatedById` int(8) NOT NULL ,
	`Name` varchar(30) NOT NULL 
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
DROP TABLE IF EXISTS `kangtia1_property`.`State`;
CREATE TABLE IF NOT EXISTS `kangtia1_property`.`State` (
	PRIMARY KEY  (`id`),
	`id` int(8) NOT NULL auto_increment ,
	`active` int(1) NOT NULL default 1 ,
	`created` DATETIME NOT NULL ,
	`updated` TIMESTAMP NOT NULL  default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
	`CreatedById` int(8) NOT NULL ,
	`UpdatedById` int(8) NOT NULL ,
	`Name` varchar(30) NOT NULL ,
	`CountryId` int(8) NOT NULL 
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
DROP TABLE IF EXISTS `kangtia1_property`.`UserAccount`;
CREATE TABLE IF NOT EXISTS `kangtia1_property`.`UserAccount` (
	PRIMARY KEY  (`id`),
	`id` int(8) NOT NULL auto_increment ,
	`active` int(1) NOT NULL default 1 ,
	`created` DATETIME NOT NULL ,
	`updated` TIMESTAMP NOT NULL  default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
	`CreatedById` int(8) NOT NULL ,
	`UpdatedById` int(8) NOT NULL ,
	`UserName` varchar(30) NOT NULL ,
	`Password` varchar(255) NOT NULL ,
	`PersonId` int(8) NOT NULL 
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
DROP TABLE IF EXISTS `kangtia1_property`.`UserAccount_Roles_Role_UserAccounts`;
CREATE TABLE IF NOT EXISTS `kangtia1_property`.`UserAccount_Roles_Role_UserAccounts` (
	`RolesId` int(8) NOT NULL ,
	`UserAccountsId` int(8) NOT NULL 
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
DROP TABLE IF EXISTS `kangtia1_property`.`X_Person_Address`;
CREATE TABLE IF NOT EXISTS `kangtia1_property`.`X_Person_Address` (
	PRIMARY KEY  (`id`),
	`id` int(8) NOT NULL auto_increment ,
	`active` int(1) NOT NULL default 1 ,
	`created` DATETIME NOT NULL ,
	`updated` TIMESTAMP NOT NULL  default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
	`CreatedById` int(8) NOT NULL ,
	`UpdatedById` int(8) NOT NULL ,
	`IsDefault` int(1) NOT NULL default 1 ,
	`PersonId` int(8) NOT NULL ,
	`AdressId` int(8) NOT NULL 
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
	


INSERT INTO `kangtia1_property`.`ContentCategory` (`id` ,`active` ,`created` ,`updated` ,`CreatedById` ,`UpdatedById` ,`name`)VALUES (1 , '1', NOW( ) , NOW( ) , '1', '1', 'Projects');
INSERT INTO `kangtia1_property`.`ContentCategory` (`id` ,`active` ,`created` ,`updated` ,`CreatedById` ,`UpdatedById` ,`name`)VALUES (2 , '1', NOW( ) , NOW( ) , '1', '1', 'News');

INSERT INTO `kangtia1_property`.`Content` (`id`, `active`, `created`, `updated`, `CreatedById`, `UpdatedById`, `title`, `intro`, `fullText`, `onFrontPage`) VALUES ('1', '1', NOW(), NOW(), '1', '1', 'Welcome', 'us vestibulum sed, sollicitudin ac, accumsan vestibulum. Etiam fringilla condimentum, pulvinar mollis. Suspendisse rhoncus pede eu tortor eget ipsum primis in elit. Aliquam erat volutpat. Praesent nunc. Nulla quis neque. Nulla convallis non, dolor. Pellentesque quam molestie vitae, ligula. Nam eu odio sit amet nisl. Etiam ornare a, faucibus eros. Suspendisse potenti. Quisque urna. Sed venenatis. Sed ornare, orci elit, pulvinar scelerisque. Vestibulum ante ipsum primis in faucibus augue. Sed in massa','iaculis, dui quis venenatis in, mauris. Nunc elementum. Fusce nisl eros, sit amet, consectetuer nec, mattis vel, lorem. Fusce et nisl. Fusce dui auctor mattis. Pellentesque mollis risus. Phasellus vestibulum sed, sollicitudin ac, accumsan vestibulum. Etiam fringilla condimentum, pulvinar mollis. Suspendisse rhoncus pede eu tortor eget ipsum primis in elit. Aliquam erat volutpat. Praesent nunc. Nulla quis neque. Nulla convallis non, dolor. Pellentesque quam molestie vitae, ligula. Nam eu odio sit amet nisl. Etiam ornare a, faucibus eros. Suspendisse potenti. Quisque urna. Sed venenatis. Sed ornare, orci elit, pulvinar scelerisque. Vestibulum ante ipsum primis in faucibus augue. Sed in massa<br /><br />augue. Sed quam ultricies vitae, mauris. Donec elementum consequat. Aliquam id consequat urna a auctor mattis. Aliquam in nulla orci luctus et netus et nisl. Etiam in volutpat laoreet. Donec congue. Nunc arcu congue tellus, at lorem id dolor libero nunc, ornare nulla in quam ut tortor. Praesent volutpat facilisis, quam ut metus. Curabitur lobortis velit. Mauris tortor. Maecenas diam bibendum purus lorem, pellentesque erat ac hendrerit et, placerat porta ut, consequat nunc. Suspendisse potenti. Cras vitae mauris. Nam ipsum. Suspendisse potenti. Quisque condimentum. Donec sit amet quam. Nullam ut justo ac massa. Aliquam ultricies eu, commodo wisi. Aenean id','1');
INSERT INTO `kangtia1_property`.`Content` (`id`, `active`, `created`, `updated`, `CreatedById`, `UpdatedById`, `title`, `intro`, `fullText`, `onFrontPage`) VALUES ('2', '1', NOW(), NOW(), '1', '1', 'How can we help you', 'us vestibulum sed, sollicitudin ac, accumsan vestibulum. Etiam fringilla condimentum, pulvinar mollis. Suspendisse rhoncus pede eu tortor eget ipsum primis in elit. Aliquam erat volutpat. Praesent nunc. Nulla quis neque. Nulla convallis non, dolor. Pellentesque quam molestie vitae, ligula. Nam eu odio sit amet nisl. Etiam ornare a, faucibus eros. Suspendisse potenti. Quisque urna. Sed venenatis. Sed ornare, orci elit, pulvinar scelerisque. Vestibulum ante ipsum primis in faucibus augue. Sed in massa','iaculis, dui quis venenatis in, mauris. Nunc elementum. Fusce nisl eros, sit amet, consectetuer nec, mattis vel, lorem. Fusce et nisl. Fusce dui auctor mattis. Pellentesque mollis risus. Phasellus vestibulum sed, sollicitudin ac, accumsan vestibulum. Etiam fringilla condimentum, pulvinar mollis. Suspendisse rhoncus pede eu tortor eget ipsum primis in elit. Aliquam erat volutpat. Praesent nunc. Nulla quis neque. Nulla convallis non, dolor. Pellentesque quam molestie vitae, ligula. Nam eu odio sit amet nisl. Etiam ornare a, faucibus eros. Suspendisse potenti. Quisque urna. Sed venenatis. Sed ornare, orci elit, pulvinar scelerisque. Vestibulum ante ipsum primis in faucibus augue. Sed in massa<br /><br />augue. Sed quam ultricies vitae, mauris. Donec elementum consequat. Aliquam id consequat urna a auctor mattis. Aliquam in nulla orci luctus et netus et nisl. Etiam in volutpat laoreet. Donec congue. Nunc arcu congue tellus, at lorem id dolor libero nunc, ornare nulla in quam ut tortor. Praesent volutpat facilisis, quam ut metus. Curabitur lobortis velit. Mauris tortor. Maecenas diam bibendum purus lorem, pellentesque erat ac hendrerit et, placerat porta ut, consequat nunc. Suspendisse potenti. Cras vitae mauris. Nam ipsum. Suspendisse potenti. Quisque condimentum. Donec sit amet quam. Nullam ut justo ac massa. Aliquam ultricies eu, commodo wisi. Aenean id','1');
INSERT INTO `kangtia1_property`.`Content` (`id`, `active`, `created`, `updated`, `CreatedById`, `UpdatedById`, `title`, `intro`, `fullText`, `onFrontPage`) VALUES ('3', '1', NOW(), NOW(), '1', '1', 'Over 30 years of experience', 'us vestibulum sed, sollicitudin ac, accumsan vestibulum. Etiam fringilla condimentum, pulvinar mollis. Suspendisse rhoncus pede eu tortor eget ipsum primis in elit. Aliquam erat volutpat. Praesent nunc. Nulla quis neque. Nulla convallis non, dolor. Pellentesque quam molestie vitae, ligula. Nam eu odio sit amet nisl. Etiam ornare a, faucibus eros. Suspendisse potenti. Quisque urna. Sed venenatis. Sed ornare, orci elit, pulvinar scelerisque. Vestibulum ante ipsum primis in faucibus augue. Sed in massa','iaculis, dui quis venenatis in, mauris. Nunc elementum. Fusce nisl eros, sit amet, consectetuer nec, mattis vel, lorem. Fusce et nisl. Fusce dui auctor mattis. Pellentesque mollis risus. Phasellus vestibulum sed, sollicitudin ac, accumsan vestibulum. Etiam fringilla condimentum, pulvinar mollis. Suspendisse rhoncus pede eu tortor eget ipsum primis in elit. Aliquam erat volutpat. Praesent nunc. Nulla quis neque. Nulla convallis non, dolor. Pellentesque quam molestie vitae, ligula. Nam eu odio sit amet nisl. Etiam ornare a, faucibus eros. Suspendisse potenti. Quisque urna. Sed venenatis. Sed ornare, orci elit, pulvinar scelerisque. Vestibulum ante ipsum primis in faucibus augue. Sed in massa<br /><br />augue. Sed quam ultricies vitae, mauris. Donec elementum consequat. Aliquam id consequat urna a auctor mattis. Aliquam in nulla orci luctus et netus et nisl. Etiam in volutpat laoreet. Donec congue. Nunc arcu congue tellus, at lorem id dolor libero nunc, ornare nulla in quam ut tortor. Praesent volutpat facilisis, quam ut metus. Curabitur lobortis velit. Mauris tortor. Maecenas diam bibendum purus lorem, pellentesque erat ac hendrerit et, placerat porta ut, consequat nunc. Suspendisse potenti. Cras vitae mauris. Nam ipsum. Suspendisse potenti. Quisque condimentum. Donec sit amet quam. Nullam ut justo ac massa. Aliquam ultricies eu, commodo wisi. Aenean id','1');

INSERT INTO `kangtia1_property`.`ContentCategory_content_Content_contentCategory` (`contentId` ,`contentCategoryId`)VALUES ('1', '2');
INSERT INTO `kangtia1_property`.`ContentCategory_content_Content_contentCategory` (`contentId` ,`contentCategoryId`)VALUES ('2', '2');
INSERT INTO `kangtia1_property`.`ContentCategory_content_Content_contentCategory` (`contentId` ,`contentCategoryId`)VALUES ('3', '2');