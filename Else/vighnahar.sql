-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2016 at 01:57 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vighnahar`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Save_AdditionalCharge` (IN `sp_CreationDate` DATETIME, IN `sp_Creator` INT, IN `sp_ip` VARCHAR(25), IN `sp_ChargeName` VARCHAR(25), IN `sp_ChargePercentage` INT, IN `sp_ChargeFix` INT)  BEGIN
	INSERT INTO additionalcharge_master
		(CreationDate, Creator, ip, ChargeName, ChargePercentage, ChargeFix) 	
	VALUES 	
		(sp_CreationDate, sp_Creator, sp_ip, sp_ChargeName, sp_ChargePercentage, sp_ChargeFix);
	SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Save_Area` (IN `sp_CreationDate` DATETIME, IN `sp_Creator` INT, IN `sp_ip` VARCHAR(25), IN `sp_AreaName` VARCHAR(50))  BEGIN
	INSERT INTO area_master
		(CreationDate, Creator, ip, AreaName) 	
	VALUES 	
		(sp_CreationDate, sp_Creator, sp_ip, sp_AreaName);
	SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Save_Category` (IN `sp_CreationDate` DATETIME, IN `sp_Creator` INT, IN `sp_ip` VARCHAR(25), IN `sp_CategoryName` VARCHAR(50), IN `sp_Octroi` INT)  BEGIN
	INSERT INTO category_master
		(CreationDate, Creator, ip, CategoryName, Octroi) 	
	VALUES 	
		(sp_CreationDate, sp_Creator, sp_ip, sp_CategoryName, sp_Octroi);
	SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Save_Consignee` (IN `sp_CreationDate` DATETIME, IN `sp_Creator` INT, IN `sp_ip` VARCHAR(20), IN `sp_caid` INT, IN `sp_ConsigneeName` VARCHAR(100), IN `sp_Address` VARCHAR(150), IN `sp_AreaName` VARCHAR(50), IN `sp_Pincode` INT, IN `sp_City` VARCHAR(25), IN `sp_Telephone` VARCHAR(100), IN `sp_Email` VARCHAR(100), IN `sp_Website` VARCHAR(100))  BEGIN
	DECLARE `_rollback` BOOL DEFAULT 0;
	DECLARE `ConsigneeID` INT;
    DECLARE `AreaMasterID` INT;
    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET `_rollback` = 1;
    START TRANSACTION;
    
		INSERT INTO area_master
			(CreationDate, Creator, ip, AreaName) 	
		VALUES 	
			(sp_CreationDate, sp_Creator, sp_ip, sp_AreaName);
		set AreaMasterID=LAST_INSERT_ID();
		
		INSERT INTO consignee_master (CreationDate, Creator, ip, caid, ConsigneeName, Website)
		VALUES 	(sp_CreationDate, sp_Creator, sp_ip, sp_caid, sp_ConsigneeName, sp_Website);
		SET ConsigneeID = LAST_INSERT_ID();

		INSERT INTO consigneeaddress_master (CreationDate, Creator, ip, cnid, Address, amid, Pincode, City, Telephone, Email)
		VALUES (sp_CreationDate, sp_Creator, sp_ip, ConsigneeID, sp_Address, AreaMasterID, sp_Pincode, sp_City, sp_Telephone, sp_Email);
		
		IF `_rollback` THEN
			ROLLBACK;
			SELECT 0;
		ELSE
			COMMIT;
			SELECT 1;
		END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Save_Consignor` (IN `sp_CreationDate` DATETIME, IN `sp_Creator` INT, IN `sp_ip` VARCHAR(20), IN `sp_ConsignorName` VARCHAR(100), IN `sp_Pancard` VARCHAR(15), IN `sp_Address` VARCHAR(150), IN `sp_AreaName` VARCHAR(50), IN `sp_Pincode` INT, IN `sp_City` VARCHAR(25), IN `sp_ctmid1` INT, IN `sp_Contact1` VARCHAR(15), IN `sp_ctmid2` INT, IN `sp_Contact2` VARCHAR(15), IN `sp_ctmid3` INT, IN `sp_Contact3` VARCHAR(15), IN `sp_ctmid4` INT, IN `sp_Email` VARCHAR(100), IN `sp_ctmid5` INT, IN `sp_Website` VARCHAR(100), IN `sp_pmid` INT, IN `sp_Remark` VARCHAR(150), IN `sp_ServiceTax` INT)  BEGIN

	DECLARE `_rollback` BOOL DEFAULT 0;
	
    DECLARE `ConsignorID` INT;
    DECLARE `ConsignorAddresID` INT;
    DECLARE `AreaMasterID` INT;
    
    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET `_rollback` = 1;
    START TRANSACTION;
    
		INSERT INTO area_master
			(CreationDate, Creator, ip, AreaName) 	
		VALUES 	
			(sp_CreationDate, sp_Creator, sp_ip, sp_AreaName);
		set AreaMasterID=LAST_INSERT_ID();
		
		INSERT INTO consignor_master (CreationDate, Creator, ip, ConsignorName, Pancard, ServiceTax, Remark)
		VALUES 	(sp_CreationDate, sp_Creator, sp_ip, sp_ConsignorName, sp_Pancard, sp_ServiceTax, sp_Remark);
		SET ConsignorID = LAST_INSERT_ID();

		INSERT INTO consignoraddress_master (CreationDate, Creator, ip, cid, Address, amid, Pincode, City)
		VALUES (sp_CreationDate, sp_Creator, sp_ip, ConsignorID, sp_Address, AreaMasterID, sp_Pincode, sp_City);
        SET ConsignorAddresID = LAST_INSERT_ID();
                
        INSERT INTO consignorcontact_master (CreationDate, Creator, ip, caid, ctmid, Contact)
		VALUES (sp_CreationDate, sp_Creator, sp_ip, ConsignorAddresID, sp_ctmid1, sp_Contact1);
        
        INSERT INTO consignorcontact_master (CreationDate, Creator, ip, caid, ctmid, Contact)
		VALUES (sp_CreationDate, sp_Creator, sp_ip, ConsignorAddresID, sp_ctmid2, sp_Contact2);
        
        INSERT INTO consignorcontact_master (CreationDate, Creator, ip, caid, ctmid, Contact)
		VALUES (sp_CreationDate, sp_Creator, sp_ip, ConsignorAddresID, sp_ctmid3, sp_Contact3);
        
        INSERT INTO consignorcontact_master (CreationDate, Creator, ip, caid, ctmid, Contact)
		VALUES (sp_CreationDate, sp_Creator, sp_ip, ConsignorAddresID, sp_ctmid4, sp_Email);
        
        INSERT INTO consignorcontact_master (CreationDate, Creator, ip, caid, ctmid, Contact)
		VALUES (sp_CreationDate, sp_Creator, sp_ip, ConsignorAddresID, sp_ctmid5, sp_Website);
        
        INSERT INTO consignorproduct_master (CreationDate, Creator, ip, caid, pmid)
		VALUES (sp_CreationDate, sp_Creator, sp_ip, ConsignorAddresID, sp_pmid);
        		
		IF `_rollback` THEN
			ROLLBACK;
			SELECT 0;
		ELSE
			COMMIT;
			SELECT 1;
		END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Save_ContactType` (IN `sp_CreationDate` DATETIME, IN `sp_Creator` INT, IN `sp_ip` VARCHAR(25), IN `sp_ContactName` VARCHAR(15))  BEGIN
	INSERT INTO contacttype_master
		(CreationDate, Creator, ip, ContactName) 	
	VALUES 	
		(sp_CreationDate, sp_Creator, sp_ip, sp_ContactName);
	SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Save_Designation` (IN `sp_CreationDate` DATETIME, IN `sp_Designation` VARCHAR(30), IN `sp_Privilage` VARCHAR(60))  BEGIN
	INSERT INTO designation_master 
		(CreationDate, Designation, Privilage) 	
	VALUES 	
		(sp_CreationDate, sp_Designation, sp_Privilage);
	SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Save_Inward` (IN `sp_CreationDate` DATETIME, IN `sp_Creator` INT, IN `sp_ip` VARCHAR(25), IN `sp_fyid` INT, IN `sp_ReceivedDate` DATE, IN `sp_InvoiceNumber` VARCHAR(25), IN `sp_vmid` INT, IN `sp_caid` INT, IN `sp_cnid` INT, IN `sp_pmid` INT, IN `sp_PakageType` VARCHAR(15), IN `sp_Rate` DOUBLE(10,2), IN `sp_Quantity` INT, IN `sp_Amount` DOUBLE(10,2), IN `sp_ShippingCharges` DOUBLE(10,2), IN `sp_BiltyCharge` INT, IN `sp_ServiceTax` DOUBLE(10,2))  BEGIN

	DECLARE `_rollback` BOOL DEFAULT 0;
    DECLARE `InwardID` INT;
    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET `_rollback` = 1;
    START TRANSACTION;
	
	INSERT INTO inward
		(CreationDate, Creator, ip, fyid, ReceivedDate, InvoiceNumber, vmid, caid, cnid, pmid, PakageType, Rate, Quantity, Amount) 	
	VALUES 	
		(sp_CreationDate, sp_Creator, sp_ip, sp_fyid, sp_ReceivedDate, sp_InvoiceNumber, sp_vmid, sp_caid, sp_cnid, sp_pmid, sp_PakageType, sp_Rate, sp_Quantity, sp_Amount);
	SET InwardID=LAST_INSERT_ID();
    
    INSERT INTO inwardcharge (CreationDate, Creator, ip, iid, acmid, Amount)
	VALUES 	(sp_CreationDate, sp_Creator, sp_ip, InwardID, 1, sp_ShippingCharges);
	
    INSERT INTO inwardcharge (CreationDate, Creator, ip, iid, acmid, Amount)
	VALUES 	(sp_CreationDate, sp_Creator, sp_ip, InwardID, 2, sp_BiltyCharge);
    
    INSERT INTO inwardcharge (CreationDate, Creator, ip, iid, acmid, Amount)
	VALUES 	(sp_CreationDate, sp_Creator, sp_ip, InwardID, 3, sp_ServiceTax);
    
    IF `_rollback` THEN
		ROLLBACK;
		SELECT 0;
	ELSE
		COMMIT;
		SELECT InwardID;
	END IF;
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Save_Login` (IN `sp_CreationDate` DATETIME, IN `sp_UserName` VARCHAR(60), IN `sp_UserID` VARCHAR(30), IN `sp_UserPassword` VARCHAR(60), IN `sp_Privilage` VARCHAR(60))  BEGIN
	INSERT INTO login_master 
		(CreationDate, UserName, UserID, UserPassword, Privilage) 	
	VALUES 	
		(sp_CreationDate, sp_UserName, sp_UserID, sp_UserPassword, sp_Privilage);
	SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Save_LogPageList` (IN `sp_pagename` VARCHAR(150))  BEGIN
	INSERT INTO log_pagenamelist
		(pagename)
	VALUES 	
		(sp_pagename);
	SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Save_LogTableEnd` (IN `sp_log_tablestartid` INT, IN `sp_log_tableslistid` INT, IN `sp_ColumnID` INT, IN `sp_oldvalue` TEXT, IN `sp_outtime` TIME)  BEGIN
	INSERT INTO log_tableend
		(log_tablestartid, log_tableslistid, ColumnID, oldvalue, outtime)
	VALUES 	
		(sp_log_tablestartid, sp_log_tableslistid, sp_ColumnID, sp_oldvalue, sp_outtime);
	SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Save_LogTableList` (IN `sp_tablename` VARCHAR(100))  BEGIN
	INSERT INTO log_tablelist
		(tablename)
	VALUES 	
		(sp_tablename);
	SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Save_LogTableStart` (IN `sp_Creation_Date` DATETIME, IN `sp_Creator` INT, IN `sp_ip` VARCHAR(20), IN `sp_pagename` VARCHAR(50), IN `sp_intime` TIME)  BEGIN
	INSERT INTO log_tablestart
		(Creation_Date, Creator, ip, pagename, intime)
	VALUES 	
		(sp_Creation_Date, sp_Creator, sp_ip, sp_pagename, sp_intime);
	SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `save_log_pageaccess` (IN `sp_Creation_Date` DATETIME, IN `sp_Creator` INT, IN `sp_ip` VARCHAR(20), IN `sp_pageid` BIGINT, IN `sp_PageNameID` INT, IN `sp_intime` TIME)  BEGIN
	INSERT INTO log_pageaccess
		(Creation_Date, Creator, ip, pageid, PageNameID, intime)
	VALUES 	
		(sp_Creation_Date, sp_Creator, sp_ip, sp_pageid, sp_PageNameID, sp_intime);
	SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Save_Menu` (IN `sp_CreationDate` DATETIME, IN `sp_Creator` INT, IN `sp_ip` VARCHAR(25), IN `sp_url` VARCHAR(100))  BEGIN
	INSERT INTO 1menusub
		(CreationDate, Creator, ip, url) 	
	VALUES 	
		(sp_CreationDate, sp_Creator, sp_ip, sp_url);
	SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Save_Merchant` (IN `sp_CreationDate` DATETIME, IN `sp_Creator` INT, IN `sp_ip` VARCHAR(25), IN `sp_Company` VARCHAR(100), IN `sp_Address` VARCHAR(150), IN `sp_AreaName` VARCHAR(50), IN `sp_Pincode` INT, IN `sp_City` VARCHAR(25), IN `sp_Telephone` VARCHAR(100), IN `sp_Email` VARCHAR(100), IN `sp_Website` VARCHAR(100), IN `sp_Pancard` VARCHAR(15))  BEGIN

	DECLARE `_rollback` BOOL DEFAULT 0;
    DECLARE `AreaMasterID` INT;
    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET `_rollback` = 1;
    START TRANSACTION;

	INSERT INTO area_master
		(CreationDate, Creator, ip, AreaName) 	
	VALUES 	
		(sp_CreationDate, sp_Creator, sp_ip, sp_AreaName);
	set AreaMasterID=LAST_INSERT_ID();

	INSERT INTO merchant_master 
		(CreationDate, Creator, ip, Company, Address, amid, Pincode, City, Telephone, Email, Website, Pancard) 	
	VALUES 	
		(sp_CreationDate, sp_Creator, sp_ip, sp_Company, sp_Address, AreaMasterID, sp_Pincode, sp_City, sp_Telephone, sp_Email, sp_Website, sp_Pancard);
	SELECT LAST_INSERT_ID();
    
    
    IF `_rollback` THEN
			ROLLBACK;
			SELECT 0;
		ELSE
			COMMIT;
			SELECT 1;
		END IF;
        
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Save_PageAccess` (IN `sp_CreationDate` DATETIME, IN `sp_Creator` INT, IN `sp_ip` VARCHAR(25), IN `sp_menusub_id` INT, IN `sp_designation_id` INT)  BEGIN
	INSERT INTO pageaccess_member 
		(CreationDate, Creator, ip, menusub_id, designation_id) 	
	VALUES 	
		(sp_CreationDate, sp_Creator, sp_ip, sp_menusub_id, sp_designation_id);
	SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Save_Product` (IN `sp_CreationDate` DATETIME, IN `sp_Creator` INT, IN `sp_ip` VARCHAR(25), IN `sp_cmid` INT, IN `sp_ProductName` VARCHAR(50))  BEGIN
	INSERT INTO product_master
		(CreationDate, Creator, ip, cmid, ProductName) 	
	VALUES 	
		(sp_CreationDate, sp_Creator, sp_ip, sp_cmid, sp_ProductName);
	SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Save_Rate` (IN `sp_CreationDate` DATETIME, IN `sp_Creator` INT, IN `sp_ip` VARCHAR(25), `sp_caid` INT, `sp_cnid` INT, `sp_pmid` INT, `sp_MinimumRate` DOUBLE(10,2), `sp_CartoonRate` DOUBLE(10,2), `sp_ItemRate` DOUBLE(10,2))  BEGIN
	INSERT INTO rate_master
		(CreationDate, Creator, ip, caid, cnid, pmid, MinimumRate, CartoonRate, ItemRate) 	
	VALUES 	
		(sp_CreationDate, sp_Creator, sp_ip, sp_caid, sp_cnid, sp_pmid, sp_MinimumRate, sp_CartoonRate, sp_ItemRate);
	SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Save_Transporter` (IN `sp_CreationDate` DATETIME, IN `sp_Creator` INT, IN `sp_ip` VARCHAR(25), IN `sp_vmid` INT, IN `sp_TransporterName` VARCHAR(50), IN `sp_MobileNumber` VARCHAR(50), IN `sp_LicenceNumber` VARCHAR(25), IN `sp_Remark` VARCHAR(100))  BEGIN
	INSERT INTO transporter_master
		(CreationDate, Creator, ip, vmid, TransporterName, MobileNumber, LicenceNumber, Remark) 	
	VALUES 	
		(sp_CreationDate, sp_Creator, sp_ip, sp_vmid, sp_TransporterName, sp_MobileNumber, sp_LicenceNumber, sp_Remark);
	SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Save_Vehicle` (IN `sp_CreationDate` DATETIME, IN `sp_Creator` INT, IN `sp_ip` VARCHAR(25), IN `sp_void` INT, IN `sp_VehicleName` VARCHAR(50), IN `sp_VehicleNumber` VARCHAR(15), IN `sp_RCBookNumber` VARCHAR(25))  BEGIN
	INSERT INTO vehicle_master
		(CreationDate, Creator, ip, void, VehicleName, VehicleNumber, RCBookNumber) 	
	VALUES 	
		(sp_CreationDate, sp_Creator, sp_ip, sp_void, sp_VehicleName, sp_VehicleNumber, sp_RCBookNumber);
	SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Save_VehicleOwnership` (IN `sp_CreationDate` DATETIME, IN `sp_Creator` INT, IN `sp_ip` VARCHAR(25), IN `sp_Ownership` VARCHAR(10))  BEGIN
	INSERT INTO vehicleownership_master
		(CreationDate, Creator, ip, Ownership) 	
	VALUES 	
		(sp_CreationDate, sp_Creator, sp_ip, sp_Ownership);
	SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`SachinD`@`%` PROCEDURE `Select_LogPageAccess` (IN `sp_SocietyID` INT)  BEGIN
	select  
	log_pageaccess.id, log_pageaccess.Creation_Date, log_pageaccess.Creator, log_pageaccess.ip, log_pageaccess.pageid, log_pageaccess.PageNameID, log_pageaccess.intime, log_pageaccess.refresh, log_pageaccess.outtime,
	log_pagenamelist.pagename, users.fullName
	from log_pageaccess
	left join log_pagenamelist
	on log_pageaccess.PageNameID=log_pagenamelist.id
	left join login_master
	on log_pageaccess.Creator=login_master.loginid	
	order by log_pageaccess.id,log_pagenamelist.pagename;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_AdditionalCharge` (IN `sp_acmid` INT, IN `sp_CreationDate` DATETIME, IN `sp_Creator` INT, IN `sp_ip` VARCHAR(25), IN `sp_ChargeName` VARCHAR(25), IN `sp_ChargePercentage` INT, IN `sp_ChargeFix` INT)  BEGIN
	update `additionalcharge_master` set  
		`ModificationDate`=sp_CreationDate,
		`Creator`=sp_Creator,
		`ip`=sp_ip,
		`ChargeName`=sp_ChargeName,
        `ChargePercentage`=sp_ChargePercentage,
        `ChargeFix`=sp_ChargeFix
	WHERE `acmid`=sp_acmid;
	SELECT ROW_COUNT();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_Area` (IN `sp_amid` INT, IN `sp_CreationDate` DATETIME, IN `sp_Creator` INT, IN `sp_ip` VARCHAR(25), IN `sp_AreaName` VARCHAR(50))  BEGIN
	update `area_master` set  
		`ModificationDate`=sp_CreationDate,
		`Creator`=sp_Creator,
		`ip`=sp_ip,
		`AreaName`=sp_AreaName
	WHERE `amid`=sp_amid;
	SELECT ROW_COUNT();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_Category` (IN `sp_cmid` INT, IN `sp_CreationDate` DATETIME, IN `sp_Creator` INT, IN `sp_ip` VARCHAR(25), IN `sp_CategoryName` VARCHAR(50), IN `sp_Octroi` INT)  BEGIN
	update `category_master` set  
		`ModificationDate`=sp_CreationDate,
		`Creator`=sp_Creator,
		`ip`=sp_ip,
		`CategoryName`=sp_CategoryName,
		`Octroi`=sp_Octroi
	WHERE `cmid`=sp_cmid;
	SELECT ROW_COUNT();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_Consignee` (IN `sp_cnid` INT, IN `sp_cnaid` INT, IN `sp_amid` INT, IN `sp_CreationDate` DATETIME, IN `sp_Creator` INT, IN `sp_ip` VARCHAR(20), IN `sp_caid` INT, IN `sp_ConsigneeName` VARCHAR(100), IN `sp_Address` VARCHAR(150), IN `sp_AreaName` VARCHAR(50), IN `sp_Pincode` INT, IN `sp_City` VARCHAR(25), IN `sp_Telephone` VARCHAR(100), IN `sp_Email` VARCHAR(100), IN `sp_Website` VARCHAR(100))  BEGIN
	DECLARE `_rollback` BOOL DEFAULT 0;
    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET `_rollback` = 1;
    START TRANSACTION;
		
        update `area_master` set  
			`ModificationDate`=sp_CreationDate,
			`Creator`=sp_Creator,
			`ip`=sp_ip,
			`AreaName`=sp_AreaName
		WHERE `amid`=sp_amid;
            
		update `consignee_master` set  
			`ModificationDate`=sp_CreationDate,
			`Creator`=sp_Creator,
			`ip`=sp_ip,
            `caid`=sp_caid,
			`ConsigneeName`=sp_ConsigneeName,
            `Website`=sp_Website
		WHERE `cnid`=sp_cnid;

		update `consigneeaddress_master` set  
			`ModificationDate`=sp_CreationDate,
			`Creator`=sp_Creator,
			`ip`=sp_ip,
			`Address`=sp_Address,
            `Pincode`=sp_Pincode,
            `City`=sp_City,
            `Telephone`=sp_Telephone,
            `Email`=sp_Email
		WHERE `cnaid`=sp_cnaid;
        
		IF `_rollback` THEN
			ROLLBACK;
			SELECT 0;
		ELSE
			COMMIT;
			SELECT 1;
		END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_ContactType` (IN `sp_ctmid` INT, IN `sp_CreationDate` DATETIME, IN `sp_Creator` INT, IN `sp_ip` VARCHAR(25), IN `sp_ContactName` VARCHAR(15))  BEGIN
	update `contacttype_master` set  
		`ModificationDate`=sp_CreationDate,
		`Creator`=sp_Creator,
		`ip`=sp_ip,
		`ContactName`=sp_ContactName
	WHERE `ctmid`=sp_ctmid;
	SELECT ROW_COUNT();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_Login` (IN `sp_loginid` INT, IN `sp_CreationDate` DATETIME, IN `sp_Creator` INT, IN `sp_ip` VARCHAR(25), IN `sp_UserName` VARCHAR(60), IN `sp_UserID` VARCHAR(30))  BEGIN
	update `login_master` set  
		`ModificationDate`=sp_CreationDate,
		`Creator`=sp_Creator,
		`ip`=sp_ip,
		`UserName`=sp_UserName,
        `UserID`=sp_UserID
	WHERE `loginid`=sp_loginid;
	SELECT ROW_COUNT();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_log_pageaccess_outtime` (IN `sp_id` INT, IN `sp_outtime` TIME)  BEGIN
	update log_pageaccess set 
		outtime=sp_outtime
	where id in(sp_id);
	SELECT ROW_COUNT();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_log_pageaccess_refreshcount` (IN `sp_id` INT)  BEGIN
	update log_pageaccess set 
		refresh=refresh+1
	where id=sp_id;
	SELECT ROW_COUNT();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_Menu` (IN `sp_menusub_id` INT, IN `sp_CreationDate` DATETIME, IN `sp_Creator` INT, IN `sp_ip` VARCHAR(25), IN `sp_url` VARCHAR(100))  BEGIN
	update `1menusub` set  
		`ModificationDate`=sp_CreationDate,
		`Creator`=sp_Creator,
		`ip`=sp_ip,
		`url`=sp_url
	WHERE `menusub_id`=sp_menusub_id;
	SELECT ROW_COUNT();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_Merchant` (IN `sp_mmid` INT, IN `sp_amid` INT, IN `sp_CreationDate` DATETIME, IN `sp_Creator` INT, IN `sp_ip` VARCHAR(25), IN `sp_Company` VARCHAR(100), IN `sp_Address` VARCHAR(150), IN `sp_AreaName` VARCHAR(50), IN `sp_Pincode` INT, IN `sp_City` VARCHAR(25), IN `sp_Telephone` VARCHAR(100), IN `sp_Email` VARCHAR(100), IN `sp_Website` VARCHAR(100), IN `sp_Pancard` VARCHAR(15))  BEGIN

	DECLARE `_rollback` BOOL DEFAULT 0;
    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET `_rollback` = 1;
    START TRANSACTION;
    
			update `area_master` set  
				`ModificationDate`=sp_CreationDate,
				`Creator`=sp_Creator,
				`ip`=sp_ip,
				`AreaName`=sp_AreaName
			WHERE `amid`=sp_amid;
			
			
			update `merchant_master` set  
				`ModificationDate`=sp_CreationDate,
                `Creator`=sp_Creator,
                `ip`=sp_ip,
				`Company`=sp_Company,
				`Address`=sp_Address, 
				`Pincode`=sp_Pincode,  
				`City`=sp_City, 
				`Telephone`=sp_Telephone, 
				`Email`=sp_Email, 
				`Website`=sp_Website,
                `Pancard`=sp_Pancard
			WHERE `mmid`=sp_mmid;
			
            
		IF `_rollback` THEN
			ROLLBACK;
			SELECT 0;
		ELSE
			COMMIT;
			SELECT 1;
		END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_PageAccess` (IN `sp_id` INT, IN `sp_CreationDate` DATETIME, IN `sp_Creator` INT, IN `sp_ip` VARCHAR(25), IN `sp_menusub_id` INT, IN `sp_designation_id` INT)  BEGIN
	update `pageaccess_member` set  
		`ModificationDate`=sp_CreationDate,
		`Creator`=sp_Creator,
		`ip`=sp_ip,
		`menusub_id`=sp_menusub_id,
		`designation_id`=sp_designation_id
	WHERE `id`=sp_id;
	SELECT ROW_COUNT();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_Product` (IN `sp_pmid` INT, IN `sp_CreationDate` DATETIME, IN `sp_Creator` INT, IN `sp_ip` VARCHAR(25), IN `sp_cmid` INT, IN `sp_ProductName` VARCHAR(50))  BEGIN
	update `product_master` set  
		`ModificationDate`=sp_CreationDate,
		`Creator`=sp_Creator,
		`ip`=sp_ip,
		`cmid`=sp_cmid,
        `ProductName`=sp_ProductName
	WHERE `pmid`=sp_pmid;
	SELECT ROW_COUNT();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_Rate` (IN `sp_rmid` INT, IN `sp_CreationDate` DATETIME, IN `sp_Creator` INT, IN `sp_ip` VARCHAR(25), `sp_caid` INT, `sp_cnid` INT, `sp_pmid` INT, `sp_MinimumRate` DOUBLE(10,2), `sp_CartoonRate` DOUBLE(10,2), `sp_ItemRate` DOUBLE(10,2))  BEGIN
	update `rate_master` set  
		`ModificationDate`=sp_CreationDate,
		`Creator`=sp_Creator,
		`ip`=sp_ip,
		`caid`=sp_caid,
        `cnid`=sp_cnid,
        `pmid`=sp_pmid,
        `MinimumRate`=sp_MinimumRate,
        `CartoonRate`=sp_CartoonRate,
        `ItemRate`=sp_ItemRate
	WHERE `rmid`=sp_rmid;
	SELECT ROW_COUNT();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_Transporter` (IN `sp_tmid` INT, IN `sp_CreationDate` DATETIME, IN `sp_Creator` INT, IN `sp_ip` VARCHAR(25), IN `sp_vmid` INT, IN `sp_TransporterName` VARCHAR(50), IN `sp_MobileNumber` VARCHAR(50), IN `sp_LicenceNumber` VARCHAR(25), IN `sp_Remark` VARCHAR(100))  BEGIN
	update `transporter_master` set  
		`ModificationDate`=sp_CreationDate,
		`Creator`=sp_Creator,
		`ip`=sp_ip,
		`vmid`=sp_vmid,
        `TransporterName`=sp_TransporterName,
        `MobileNumber`=sp_MobileNumber,
        `LicenceNumber`=sp_LicenceNumber,
        `Remark`=sp_Remark
	WHERE `tmid`=sp_tmid;
	SELECT ROW_COUNT();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_Vehicle` (IN `sp_vmid` INT, IN `sp_CreationDate` DATETIME, IN `sp_Creator` INT, IN `sp_ip` VARCHAR(25), IN `sp_void` INT, IN `sp_VehicleName` VARCHAR(50), IN `sp_VehicleNumber` VARCHAR(15), IN `sp_RCBookNumber` VARCHAR(25))  BEGIN
	update `vehicle_master` set  
		`ModificationDate`=sp_CreationDate,
		`Creator`=sp_Creator,
		`ip`=sp_ip,
		`void`=sp_void,
        `VehicleName`=sp_VehicleName,
        `VehicleNumber`=sp_VehicleNumber,
        `RCBookNumber`=sp_RCBookNumber
	WHERE `vmid`=sp_vmid;
	SELECT ROW_COUNT();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_VehicleOwnership` (IN `sp_void` INT, IN `sp_CreationDate` DATETIME, IN `sp_Creator` INT, IN `sp_ip` VARCHAR(25), IN `sp_Ownership` VARCHAR(10))  BEGIN
	update `vehicleownership_master` set  
		`ModificationDate`=sp_CreationDate,
		`Creator`=sp_Creator,
		`ip`=sp_ip,
		`Ownership`=sp_Ownership
	WHERE `void`=sp_void;
	SELECT ROW_COUNT();
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `1menusub`
--

CREATE TABLE `1menusub` (
  `menusub_id` smallint(6) NOT NULL,
  `CreationDate` datetime NOT NULL,
  `ModificationDate` datetime NOT NULL,
  `Creator` int(11) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `url` varchar(100) CHARACTER SET latin1 NOT NULL,
  `Active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `1menusub`
--

INSERT INTO `1menusub` (`menusub_id`, `CreationDate`, `ModificationDate`, `Creator`, `ip`, `url`, `Active`) VALUES
(1, '2016-08-13 02:05:01', '0000-00-00 00:00:00', 6, '::1', 'add_menu.php', 1),
(3, '2016-08-13 02:17:00', '2016-08-14 07:26:08', 6, '::1', 'add_login.php', 1),
(4, '2016-08-14 07:48:30', '0000-00-00 00:00:00', 6, '::1', 'add_pageaccess.php', 1),
(5, '2016-08-14 11:00:36', '0000-00-00 00:00:00', 6, '::1', 'add_merchant.php', 1),
(6, '2016-08-14 12:23:01', '0000-00-00 00:00:00', 6, '::1', 'add_consignee.php', 1),
(7, '2016-08-15 07:46:44', '0000-00-00 00:00:00', 6, '::1', 'add_vehicleownership.php', 1),
(8, '2016-08-15 08:10:28', '0000-00-00 00:00:00', 6, '::1', 'add_vehicle.php', 1),
(9, '2016-08-15 09:23:08', '0000-00-00 00:00:00', 6, '::1', 'add_transporter.php', 1),
(10, '2016-08-15 11:32:06', '0000-00-00 00:00:00', 6, '::1', 'add_category.php', 1),
(11, '2016-08-15 11:54:43', '0000-00-00 00:00:00', 6, '::1', 'add_product.php', 1),
(12, '2016-08-15 01:06:59', '0000-00-00 00:00:00', 6, '::1', 'add_contacttype.php', 1),
(13, '2016-08-15 01:46:00', '0000-00-00 00:00:00', 6, '::1', 'add_consignor.php', 1),
(14, '2016-08-16 07:58:06', '0000-00-00 00:00:00', 6, '::1', 'add_area.php', 1),
(15, '2016-08-16 08:17:09', '0000-00-00 00:00:00', 6, '::1', 'add_additionalcharge.php', 1),
(16, '2016-08-16 09:11:39', '0000-00-00 00:00:00', 6, '::1', 'add_rate.php', 1),
(17, '2016-08-19 08:52:29', '0000-00-00 00:00:00', 6, '::1', 'lrentry.php', 1),
(18, '2016-08-20 07:04:49', '0000-00-00 00:00:00', 6, '::1', 'add_financialyear.php', 1);

-- --------------------------------------------------------

--
-- Table structure for table `additionalcharge_master`
--

CREATE TABLE `additionalcharge_master` (
  `acmid` int(6) NOT NULL,
  `CreationDate` datetime NOT NULL,
  `ModificationDate` datetime DEFAULT NULL,
  `Creator` int(11) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `ChargeName` varchar(25) NOT NULL,
  `ChargePercentage` tinyint(4) NOT NULL,
  `ChargeFix` mediumint(9) NOT NULL,
  `AdditionalCharge` tinyint(4) NOT NULL DEFAULT '0',
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `additionalcharge_master`
--

INSERT INTO `additionalcharge_master` (`acmid`, `CreationDate`, `ModificationDate`, `Creator`, `ip`, `ChargeName`, `ChargePercentage`, `ChargeFix`, `AdditionalCharge`, `Active`) VALUES
(1, '2016-08-20 12:02:22', NULL, 6, '::1', 'ShippingCharges', 0, 0, 0, 1),
(2, '2016-08-16 08:47:09', '2016-08-17 08:27:14', 6, '::1', 'BiltyCharge', 0, 10, 0, 1),
(3, '2016-08-19 02:53:14', NULL, 6, '::1', 'ServiceTax', 15, 0, 0, 1),
(4, '2016-08-19 03:46:41', NULL, 6, '::1', 'PhotocopyCharges', 0, 0, 1, 1),
(5, '2016-08-19 03:47:04', NULL, 6, '::1', 'Warai', 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `area_master`
--

CREATE TABLE `area_master` (
  `amid` int(6) NOT NULL,
  `CreationDate` datetime NOT NULL,
  `ModificationDate` datetime DEFAULT NULL,
  `Creator` int(11) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `AreaName` varchar(50) NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `area_master`
--

INSERT INTO `area_master` (`amid`, `CreationDate`, `ModificationDate`, `Creator`, `ip`, `AreaName`, `Active`) VALUES
(3, '2016-08-17 02:42:32', '2016-08-19 10:25:46', 6, '::1', 'Bhiwandi1', 1),
(4, '2016-08-18 01:06:20', '2016-08-18 01:10:08', 6, '::1', 'Dombivli East1', 1),
(5, '2016-08-19 06:49:36', NULL, 6, '::1', 'Friday', 1),
(6, '2016-08-19 07:52:45', NULL, 6, '::1', 'Dombivli West', 1),
(7, '2016-08-19 08:15:48', '2016-08-19 08:18:39', 6, '::1', 'Dombivli East', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `bid` int(6) NOT NULL,
  `CreationDate` datetime NOT NULL,
  `ModificationDate` datetime DEFAULT NULL,
  `Creator` int(11) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `BillingDate` date NOT NULL,
  `cid` int(11) NOT NULL,
  `FromDate` date NOT NULL,
  `ToDate` date NOT NULL,
  `Quantity` smallint(6) NOT NULL,
  `Amount` double(10,2) NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `billlr`
--

CREATE TABLE `billlr` (
  `blrid` int(6) NOT NULL,
  `CreationDate` datetime NOT NULL,
  `ModificationDate` datetime DEFAULT NULL,
  `Creator` int(11) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `bid` int(11) NOT NULL COMMENT 'Bill ID',
  `iid` int(11) NOT NULL COMMENT 'Inward ID',
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category_master`
--

CREATE TABLE `category_master` (
  `cmid` int(6) NOT NULL,
  `CreationDate` datetime NOT NULL,
  `ModificationDate` datetime DEFAULT NULL,
  `Creator` int(11) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `CategoryName` varchar(50) NOT NULL,
  `Octroi` tinyint(4) NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_master`
--

INSERT INTO `category_master` (`cmid`, `CreationDate`, `ModificationDate`, `Creator`, `ip`, `CategoryName`, `Octroi`, `Active`) VALUES
(1, '2016-08-15 11:37:45', '2016-08-15 11:47:10', 6, '::1', 'Category1', 1, 1),
(2, '2016-08-15 00:00:00', NULL, 6, '::1', 'Category2', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `consigneeaddress_master`
--

CREATE TABLE `consigneeaddress_master` (
  `cnaid` int(6) NOT NULL,
  `CreationDate` datetime NOT NULL,
  `ModificationDate` datetime DEFAULT NULL,
  `Creator` int(11) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `cnid` int(11) NOT NULL DEFAULT '0',
  `Address` varchar(150) CHARACTER SET latin1 NOT NULL,
  `amid` int(11) NOT NULL,
  `Pincode` mediumint(9) NOT NULL,
  `City` varchar(50) NOT NULL,
  `Telephone` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `consigneeaddress_master`
--

INSERT INTO `consigneeaddress_master` (`cnaid`, `CreationDate`, `ModificationDate`, `Creator`, `ip`, `cnid`, `Address`, `amid`, `Pincode`, `City`, `Telephone`, `Email`, `Active`) VALUES
(1, '2016-08-14 04:44:52', NULL, 6, '::1', 1, 's', 3, 1, 's', '1', 'sa@sa.com', 1),
(2, '2016-08-15 05:48:21', '2016-08-15 06:23:07', 6, '::1', 2, 'Test', 3, 123456, 'Thane', '987654321', 'test@test.com', 1),
(3, '2016-08-17 08:24:09', '2016-08-19 10:25:46', 6, '::1', 3, 'Borivli East', 3, 400001, 'Mumbai', '123', 'sa@sa.com', 1),
(4, '2016-08-18 01:06:20', '2016-08-18 01:10:08', 6, '::1', 4, 't1', 4, 400001, 't', '1', 'sa@sa.com', 1),
(5, '2016-08-19 07:52:45', NULL, 6, '::1', 5, 'New', 6, 123456, 'Thane', '1212121212', 'sa@sa.com', 1),
(6, '2016-08-19 08:15:48', '2016-08-19 08:18:39', 6, '::1', 6, 'New Friday', 7, 123, 'Thane', '987654321', 'sa@sa.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `consignee_master`
--

CREATE TABLE `consignee_master` (
  `cnid` int(6) NOT NULL,
  `CreationDate` datetime NOT NULL,
  `ModificationDate` datetime DEFAULT NULL,
  `Creator` int(11) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `caid` int(11) NOT NULL,
  `ConsigneeName` varchar(100) CHARACTER SET latin1 NOT NULL,
  `Website` varchar(100) NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `consignee_master`
--

INSERT INTO `consignee_master` (`cnid`, `CreationDate`, `ModificationDate`, `Creator`, `ip`, `caid`, `ConsigneeName`, `Website`, `Active`) VALUES
(1, '2016-08-14 04:44:52', NULL, 6, '::1', 22, 's', 'http://www.sa.com', 1),
(2, '2016-08-15 05:48:21', '2016-08-15 06:23:07', 6, '::1', 22, 'Test', 'http://www.test.com', 1),
(3, '2016-08-17 08:24:09', '2016-08-19 10:25:46', 6, '::1', 21, 'Chimanlal Sons', 'http://www.sa.com', 1),
(4, '2016-08-18 01:06:20', '2016-08-18 01:10:08', 6, '::1', 22, 't1', 'http://www.sa.com', 1),
(5, '2016-08-19 07:52:45', NULL, 6, '::1', 22, 'New Consignee', 'http://www.sa.com', 1),
(6, '2016-08-19 08:15:48', '2016-08-19 08:18:39', 6, '::1', 21, 'New Friday', 'http://www.sa.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `consignoraddress_master`
--

CREATE TABLE `consignoraddress_master` (
  `caid` int(6) NOT NULL,
  `CreationDate` datetime NOT NULL,
  `ModificationDate` datetime DEFAULT NULL,
  `Creator` int(11) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `cid` int(11) NOT NULL,
  `Address` varchar(150) NOT NULL,
  `amid` int(11) NOT NULL,
  `Pincode` smallint(6) NOT NULL,
  `City` varchar(25) NOT NULL,
  `acmid` int(11) NOT NULL COMMENT 'additional charge master id',
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `consignoraddress_master`
--

INSERT INTO `consignoraddress_master` (`caid`, `CreationDate`, `ModificationDate`, `Creator`, `ip`, `cid`, `Address`, `amid`, `Pincode`, `City`, `acmid`, `Active`) VALUES
(20, '2016-08-15 05:34:35', NULL, 6, '::1', 20, 's', 3, 1, 's', 0, 1),
(21, '2016-08-15 05:36:42', NULL, 6, '::1', 21, 's', 3, 1, 's', 0, 1),
(22, '2016-08-17 08:20:03', NULL, 6, '::1', 22, 'Building No C 12 Gala No 9 15 Sri Arihant Compound Kalher Bhiwandi', 4, 32767, 'Thane', 0, 1),
(23, '2016-08-19 06:49:36', NULL, 6, '::1', 23, 'Friday', 5, 32767, 'Friday', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `consignorcontact_master`
--

CREATE TABLE `consignorcontact_master` (
  `ccid` int(6) NOT NULL,
  `CreationDate` datetime NOT NULL,
  `ModificationDate` datetime DEFAULT NULL,
  `Creator` int(11) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `caid` int(11) NOT NULL,
  `ctmid` int(11) NOT NULL,
  `Contact` varchar(15) NOT NULL,
  `PrimaryContact` tinyint(4) NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `consignorcontact_master`
--

INSERT INTO `consignorcontact_master` (`ccid`, `CreationDate`, `ModificationDate`, `Creator`, `ip`, `caid`, `ctmid`, `Contact`, `PrimaryContact`, `Active`) VALUES
(28, '2016-08-15 05:34:35', NULL, 6, '::1', 20, 1, '1', 0, 1),
(29, '2016-08-15 05:34:35', NULL, 6, '::1', 20, 1, '2', 0, 1),
(30, '2016-08-15 05:34:35', NULL, 6, '::1', 20, 1, '3', 0, 1),
(31, '2016-08-15 05:34:35', NULL, 6, '::1', 20, 2, 'sa@sa.com', 0, 1),
(32, '2016-08-15 05:34:35', NULL, 6, '::1', 20, 3, 'http://www.sa.c', 0, 1),
(33, '2016-08-15 05:36:42', NULL, 6, '::1', 21, 1, '1', 0, 1),
(34, '2016-08-15 05:36:42', NULL, 6, '::1', 21, 1, '2', 0, 1),
(35, '2016-08-15 05:36:42', NULL, 6, '::1', 21, 1, '3', 0, 1),
(36, '2016-08-15 05:36:42', NULL, 6, '::1', 21, 2, 'sa@sa.com', 0, 1),
(37, '2016-08-15 05:36:42', NULL, 6, '::1', 21, 3, 'http://www.sa.c', 0, 1),
(38, '2016-08-17 08:20:03', NULL, 6, '::1', 22, 1, '123', 0, 1),
(39, '2016-08-17 08:20:03', NULL, 6, '::1', 22, 0, '0', 0, 1),
(40, '2016-08-17 08:20:03', NULL, 6, '::1', 22, 0, '0', 0, 1),
(41, '2016-08-17 08:20:03', NULL, 6, '::1', 22, 2, 'sa@sa.com', 0, 1),
(42, '2016-08-17 08:20:03', NULL, 6, '::1', 22, 3, 'http://www.sa.c', 0, 1),
(43, '2016-08-19 06:49:36', NULL, 6, '::1', 23, 1, '123456789', 0, 1),
(44, '2016-08-19 06:49:36', NULL, 6, '::1', 23, 1, '123456789', 0, 1),
(45, '2016-08-19 06:49:36', NULL, 6, '::1', 23, 1, '123456789', 0, 1),
(46, '2016-08-19 06:49:36', NULL, 6, '::1', 23, 2, 'sa@sa.com', 0, 1),
(47, '2016-08-19 06:49:36', NULL, 6, '::1', 23, 3, 'http://www.sa.c', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `consignorproduct_master`
--

CREATE TABLE `consignorproduct_master` (
  `cpid` int(6) NOT NULL,
  `CreationDate` datetime NOT NULL,
  `ModificationDate` datetime DEFAULT NULL,
  `Creator` int(11) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `caid` int(11) NOT NULL,
  `pmid` int(11) NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `consignorproduct_master`
--

INSERT INTO `consignorproduct_master` (`cpid`, `CreationDate`, `ModificationDate`, `Creator`, `ip`, `caid`, `pmid`, `Active`) VALUES
(4, '2016-08-15 05:34:35', NULL, 6, '::1', 20, 1, 1),
(5, '2016-08-15 05:36:42', NULL, 6, '::1', 21, 1, 1),
(6, '2016-08-17 08:20:03', NULL, 6, '::1', 22, 1, 1),
(7, '2016-08-19 06:49:36', NULL, 6, '::1', 23, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `consignor_master`
--

CREATE TABLE `consignor_master` (
  `cid` int(6) NOT NULL,
  `CreationDate` datetime NOT NULL,
  `ModificationDate` datetime DEFAULT NULL,
  `Creator` int(11) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `ConsignorName` varchar(100) NOT NULL,
  `Pancard` varchar(15) NOT NULL,
  `ServiceTax` tinyint(4) NOT NULL DEFAULT '0',
  `Remark` varchar(150) NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `consignor_master`
--

INSERT INTO `consignor_master` (`cid`, `CreationDate`, `ModificationDate`, `Creator`, `ip`, `ConsignorName`, `Pancard`, `ServiceTax`, `Remark`, `Active`) VALUES
(20, '2016-08-15 05:34:35', NULL, 6, '::1', 'Consignor1', '1', 1, 'asas', 1),
(21, '2016-08-15 05:36:42', NULL, 6, '::1', 'Consignor2', '1', 1, 'asas', 1),
(22, '2016-08-17 08:20:03', NULL, 6, '::1', 'Macleods Pharmaceuticals LTD', '123', 1, '', 1),
(23, '2016-08-19 06:49:36', NULL, 6, '::1', 'Friday', '123456', 1, 'Ramark', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contacttype_master`
--

CREATE TABLE `contacttype_master` (
  `ctmid` tinyint(6) NOT NULL,
  `CreationDate` datetime NOT NULL,
  `ModificationDate` datetime DEFAULT NULL,
  `Creator` int(11) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `ContactName` varchar(15) CHARACTER SET latin1 NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contacttype_master`
--

INSERT INTO `contacttype_master` (`ctmid`, `CreationDate`, `ModificationDate`, `Creator`, `ip`, `ContactName`, `Active`) VALUES
(1, '2016-08-15 01:13:18', '2016-08-15 01:20:08', 6, '::1', 'Mobile', 1),
(2, '2016-08-15 00:00:00', NULL, 6, '::1', 'Email', 1),
(3, '2016-08-15 00:00:00', NULL, 6, '::1', 'Website', 1);

-- --------------------------------------------------------

--
-- Table structure for table `designation_master`
--

CREATE TABLE `designation_master` (
  `designationid` smallint(6) NOT NULL,
  `CreationDate` datetime NOT NULL,
  `ModificationDate` datetime DEFAULT NULL,
  `Creator` int(11) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `Designation` varchar(30) NOT NULL,
  `Privilage` binary(60) NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `designation_master`
--

INSERT INTO `designation_master` (`designationid`, `CreationDate`, `ModificationDate`, `Creator`, `ip`, `Designation`, `Privilage`, `Active`) VALUES
(8, '2016-08-08 01:17:54', NULL, 0, '', 'Admin', 0x2432792431302474346f576c5854674e5378343161306d5a655a5157653961372e54422f7a595a495050467256302f555334354771556c456c747879, 1),
(9, '2016-08-13 03:38:24', NULL, 0, '', 'User', 0x2432792431302470624d71324b44494a6f78736a4d714d51453443736556746f4b4e597864314c526836734c74435162624b6b524769476c5358616d, 1);

-- --------------------------------------------------------

--
-- Table structure for table `financialyear_master`
--

CREATE TABLE `financialyear_master` (
  `fyid` smallint(6) NOT NULL,
  `CreationDate` datetime NOT NULL,
  `ModificationDate` datetime DEFAULT NULL,
  `Creator` int(11) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `CurrentYear` year(4) NOT NULL,
  `FinancialYear` varchar(50) NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `financialyear_master`
--

INSERT INTO `financialyear_master` (`fyid`, `CreationDate`, `ModificationDate`, `Creator`, `ip`, `CurrentYear`, `FinancialYear`, `Active`) VALUES
(1, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2010, '2010-2011', 0),
(2, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2011, '2011-2012', 0),
(3, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2012, '2012-2013', 0),
(4, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2013, '2013-2014', 0),
(5, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2014, '2014-2015', 0),
(6, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2015, '2015-2016', 0),
(7, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2016, '2016-2017', 1),
(8, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2017, '2017-2018', 0),
(9, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2018, '2018-2019', 0),
(10, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2019, '2019-2020', 0),
(11, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2020, '2020-2021', 0),
(12, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2021, '2021-2022', 0),
(13, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2022, '2022-2023', 0),
(14, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2023, '2023-2024', 0),
(15, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2024, '2024-2025', 0),
(16, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2025, '2025-2026', 0),
(17, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2026, '2026-2027', 0),
(18, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2027, '2027-2028', 0),
(19, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2028, '2028-2029', 0),
(20, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2029, '2029-2030', 0),
(21, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2030, '2030-2031', 0),
(22, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2031, '2031-2032', 0),
(23, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2032, '2032-2033', 0),
(24, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2033, '2033-2034', 0),
(25, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2034, '2034-2035', 0),
(26, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2035, '2035-2036', 0),
(27, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2036, '2036-2037', 0),
(28, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2037, '2037-2038', 0),
(29, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2038, '2038-2039', 0),
(30, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2039, '2039-2040', 0),
(31, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2040, '2040-2041', 0),
(32, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2041, '2041-2042', 0),
(33, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2042, '2042-2043', 0),
(34, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2043, '2043-2044', 0),
(35, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2044, '2044-2045', 0),
(36, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2045, '2045-2046', 0),
(37, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2046, '2046-2047', 0),
(38, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2047, '2047-2048', 0),
(39, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2048, '2048-2049', 0),
(40, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2049, '2049-2050', 0),
(41, '2016-08-20 10:30:30', '0000-00-00 00:00:00', 1, '::1', 2050, '2050-2051', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inward`
--

CREATE TABLE `inward` (
  `iid` int(6) NOT NULL,
  `CreationDate` datetime NOT NULL,
  `ModificationDate` datetime DEFAULT NULL,
  `Creator` int(11) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `fyid` smallint(6) NOT NULL,
  `ReceivedDate` date NOT NULL,
  `InvoiceNumber` varchar(50) NOT NULL,
  `vmid` int(11) NOT NULL,
  `caid` int(11) NOT NULL,
  `cnid` int(11) NOT NULL,
  `pmid` int(11) NOT NULL,
  `PakageType` varchar(15) NOT NULL,
  `Rate` decimal(10,2) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inward`
--

INSERT INTO `inward` (`iid`, `CreationDate`, `ModificationDate`, `Creator`, `ip`, `fyid`, `ReceivedDate`, `InvoiceNumber`, `vmid`, `caid`, `cnid`, `pmid`, `PakageType`, `Rate`, `Quantity`, `Amount`, `Active`) VALUES
(10, '2016-08-20 12:57:12', NULL, 6, '::1', 7, '0000-00-00', 'AS', 1, 21, 3, 2, 'CartoonRate', '214.00', 2, '532.20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inwardcharge`
--

CREATE TABLE `inwardcharge` (
  `icid` int(6) NOT NULL,
  `CreationDate` datetime NOT NULL,
  `ModificationDate` datetime DEFAULT NULL,
  `Creator` int(11) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `iid` int(11) NOT NULL,
  `acmid` int(11) NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inwardcharge`
--

INSERT INTO `inwardcharge` (`icid`, `CreationDate`, `ModificationDate`, `Creator`, `ip`, `iid`, `acmid`, `Amount`, `Active`) VALUES
(28, '2016-08-20 12:57:12', NULL, 6, '::1', 10, 1, '428.00', 1),
(29, '2016-08-20 12:57:12', NULL, 6, '::1', 10, 2, '10.00', 1),
(30, '2016-08-20 12:57:12', NULL, 6, '::1', 10, 3, '64.20', 1),
(31, '2016-08-20 12:57:12', NULL, 6, '::1', 10, 4, '10.00', 1),
(32, '2016-08-20 12:57:12', NULL, 6, '::1', 10, 5, '20.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `login_master`
--

CREATE TABLE `login_master` (
  `loginid` int(11) NOT NULL,
  `CreationDate` datetime NOT NULL,
  `ModificationDate` datetime NOT NULL,
  `Creator` int(11) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `UserName` varchar(60) NOT NULL,
  `UserID` varchar(30) NOT NULL,
  `UserPassword` binary(60) NOT NULL,
  `Privilage` binary(60) NOT NULL,
  `last_login` datetime NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_master`
--

INSERT INTO `login_master` (`loginid`, `CreationDate`, `ModificationDate`, `Creator`, `ip`, `UserName`, `UserID`, `UserPassword`, `Privilage`, `last_login`, `Active`) VALUES
(6, '2016-08-08 01:18:14', '0000-00-00 00:00:00', 0, '', 'Sachin Deshmukh', 'sa', 0x24327924313024644c5a756f47793142336f3170645a7766325637664f4742706b30386a63564d4f326d3532746c6e446341677a7a56322e416f524b, 0x2432792431302474346f576c5854674e5378343161306d5a655a5157653961372e54422f7a595a495050467256302f555334354771556c456c747879, '0000-00-00 00:00:00', 1),
(7, '2016-08-13 03:51:41', '0000-00-00 00:00:00', 0, '', 'Om Deshmukh', 'om', 0x243279243130245649504359504e6a7172623936733745793156614d65434d44694b4b544d696f454c7873752e6d49775631513951554c3949326743, 0x2432792431302470624d71324b44494a6f78736a4d714d51453443736556746f4b4e597864314c526836734c74435162624b6b524769476c5358616d, '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `log_pageaccess`
--

CREATE TABLE `log_pageaccess` (
  `id` int(11) NOT NULL,
  `Creation_Date` datetime NOT NULL,
  `Creator` int(11) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `pageid` bigint(11) NOT NULL,
  `PageNameID` int(11) NOT NULL,
  `intime` time NOT NULL,
  `refresh` smallint(6) NOT NULL DEFAULT '1',
  `outtime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_pageaccess`
--

INSERT INTO `log_pageaccess` (`id`, `Creation_Date`, `Creator`, `ip`, `pageid`, `PageNameID`, `intime`, `refresh`, `outtime`) VALUES
(903, '2016-08-14 08:55:56', 6, '::1', 620160814085225, 25, '08:55:56', 6, '00:00:00'),
(904, '2016-08-14 10:59:44', 6, '::1', 620160814105943, 26, '10:59:44', 1, '00:00:00'),
(905, '2016-08-14 11:00:01', 6, '::1', 620160814105959, 25, '11:00:01', 4, '11:00:56'),
(906, '2016-08-14 11:00:56', 6, '::1', 620160814105959, 26, '11:00:56', 1, '11:02:19'),
(907, '2016-08-14 11:02:19', 6, '::1', 620160814105959, 27, '11:02:19', 2, '11:04:26'),
(908, '2016-08-14 11:04:26', 6, '::1', 620160814105959, 26, '11:04:26', 1, '11:04:28'),
(909, '2016-08-14 11:04:28', 6, '::1', 620160814105959, 25, '11:04:28', 2, '11:05:13'),
(910, '2016-08-14 11:05:13', 6, '::1', 620160814105959, 28, '11:05:13', 21, '12:22:53'),
(911, '2016-08-14 12:22:53', 6, '::1', 620160814105959, 27, '12:22:53', 1, '12:23:04'),
(912, '2016-08-14 12:23:05', 6, '::1', 620160814105959, 25, '12:23:05', 1, '12:23:22'),
(913, '2016-08-14 12:23:22', 6, '::1', 620160814105959, 29, '12:23:22', 6, '00:00:00'),
(914, '2016-08-14 15:04:26', 6, '::1', 620160814150420, 29, '15:04:26', 1, '00:00:00'),
(915, '2016-08-14 15:14:41', 6, '::1', 620160814151359, 26, '15:14:41', 2, '15:31:55'),
(916, '2016-08-14 15:31:55', 6, '::1', 620160814151359, 29, '15:31:55', 7, '00:00:00'),
(917, '2016-08-15 05:46:47', 6, '::1', 620160815054645, 26, '05:46:47', 1, '05:46:49'),
(918, '2016-08-15 05:46:49', 6, '::1', 620160815054645, 29, '05:46:49', 12, '07:46:29'),
(919, '2016-08-15 07:46:29', 6, '::1', 620160815054645, 27, '07:46:29', 1, '07:46:50'),
(920, '2016-08-15 07:46:50', 6, '::1', 620160815054645, 25, '07:46:50', 1, '00:00:00'),
(921, '2016-08-15 07:47:21', 6, '::1', 620160815074710, 30, '07:47:21', 1, '00:00:00'),
(922, '2016-08-15 07:47:41', 6, '::1', 620160815074738, 30, '07:47:41', 1, '00:00:00'),
(923, '2016-08-15 07:48:06', 6, '::1', 620160815074743, 30, '07:48:06', 13, '08:10:16'),
(924, '2016-08-15 08:10:16', 6, '::1', 620160815074743, 27, '08:10:16', 1, '08:10:31'),
(925, '2016-08-15 08:10:31', 6, '::1', 620160815074743, 25, '08:10:31', 1, '08:11:01'),
(926, '2016-08-15 08:11:01', 6, '::1', 620160815074743, 31, '08:11:01', 14, '09:22:59'),
(927, '2016-08-15 09:22:59', 6, '::1', 620160815074743, 27, '09:22:59', 1, '09:23:12'),
(928, '2016-08-15 09:23:12', 6, '::1', 620160815074743, 25, '09:23:12', 1, '09:23:28'),
(929, '2016-08-15 09:23:28', 6, '::1', 620160815074743, 27, '09:23:28', 1, '09:23:28'),
(930, '2016-08-15 09:23:28', 6, '::1', 620160815074743, 31, '09:23:28', 1, '09:23:36'),
(931, '2016-08-15 09:23:37', 6, '::1', 620160815074743, 32, '09:23:37', 16, '11:31:55'),
(932, '2016-08-15 11:31:55', 6, '::1', 620160815074743, 27, '11:31:55', 1, '11:32:09'),
(933, '2016-08-15 11:32:09', 6, '::1', 620160815074743, 25, '11:32:09', 1, '11:32:15'),
(934, '2016-08-15 11:32:15', 6, '::1', 620160815074743, 29, '11:32:15', 1, '11:32:18'),
(935, '2016-08-15 11:32:18', 6, '::1', 620160815074743, 33, '11:32:18', 5, '11:54:36'),
(936, '2016-08-15 11:54:37', 6, '::1', 620160815074743, 27, '11:54:37', 1, '11:54:46'),
(937, '2016-08-15 11:54:46', 6, '::1', 620160815074743, 25, '11:54:46', 1, '11:55:02'),
(938, '2016-08-15 11:55:02', 6, '::1', 620160815074743, 34, '11:55:02', 8, '13:06:50'),
(939, '2016-08-15 13:06:50', 6, '::1', 620160815074743, 27, '13:06:50', 1, '13:07:03'),
(940, '2016-08-15 13:07:03', 6, '::1', 620160815074743, 25, '13:07:03', 1, '13:07:21'),
(941, '2016-08-15 13:07:21', 6, '::1', 620160815074743, 35, '13:07:21', 9, '13:45:42'),
(942, '2016-08-15 13:45:42', 6, '::1', 620160815074743, 27, '13:45:42', 1, '13:46:03'),
(943, '2016-08-15 13:46:03', 6, '::1', 620160815074743, 25, '13:46:03', 1, '13:46:11'),
(944, '2016-08-15 13:46:11', 6, '::1', 620160815074743, 29, '13:46:11', 1, '13:46:16'),
(945, '2016-08-15 13:46:16', 6, '::1', 620160815074743, 36, '13:46:16', 10, '16:39:06'),
(946, '2016-08-15 16:39:07', 6, '::1', 620160815074743, 35, '16:39:07', 4, '17:03:46'),
(947, '2016-08-15 17:03:46', 6, '::1', 620160815074743, 36, '17:03:46', 5, '00:00:00'),
(948, '2016-08-16 06:33:22', 6, '::1', 620160816063320, 26, '06:33:22', 1, '06:39:31'),
(949, '2016-08-16 06:39:31', 6, '::1', 620160816063320, 36, '06:39:31', 1, '06:41:49'),
(950, '2016-08-16 06:41:49', 6, '::1', 620160816063320, 26, '06:41:49', 1, '06:43:35'),
(951, '2016-08-16 06:43:35', 6, '::1', 620160816063320, 36, '06:43:35', 1, '06:52:19'),
(952, '2016-08-16 06:52:19', 6, '::1', 620160816063320, 26, '06:52:19', 3, '07:58:00'),
(953, '2016-08-16 07:58:01', 6, '::1', 620160816063320, 27, '07:58:01', 1, '07:58:09'),
(954, '2016-08-16 07:58:09', 6, '::1', 620160816063320, 25, '07:58:09', 1, '07:58:18'),
(955, '2016-08-16 07:58:18', 6, '::1', 620160816063320, 37, '07:58:18', 13, '08:16:57'),
(956, '2016-08-16 08:16:57', 6, '::1', 620160816063320, 27, '08:16:57', 1, '08:17:11'),
(957, '2016-08-16 08:17:12', 6, '::1', 620160816063320, 25, '08:17:12', 1, '08:17:23'),
(958, '2016-08-16 08:17:23', 6, '::1', 620160816063320, 38, '08:17:23', 9, '09:11:32'),
(959, '2016-08-16 09:11:33', 6, '::1', 620160816063320, 27, '09:11:33', 1, '09:11:42'),
(960, '2016-08-16 09:11:43', 6, '::1', 620160816063320, 25, '09:11:43', 1, '09:11:53'),
(961, '2016-08-16 09:11:53', 6, '::1', 620160816063320, 39, '09:11:53', 1, '10:19:44'),
(962, '2016-08-16 10:19:44', 6, '::1', 620160816063320, 27, '10:19:44', 1, '10:19:50'),
(963, '2016-08-16 10:19:50', 6, '::1', 620160816063320, 25, '10:19:50', 2, '11:29:10'),
(964, '2016-08-16 11:29:11', 6, '::1', 620160816063320, 27, '11:29:11', 1, '11:29:12'),
(965, '2016-08-16 11:29:12', 6, '::1', 620160816063320, 26, '11:29:12', 1, '11:38:21'),
(966, '2016-08-16 11:38:21', 6, '::1', 620160816063320, 25, '11:38:21', 1, '11:42:45'),
(967, '2016-08-16 11:42:45', 6, '::1', 620160816063320, 36, '11:42:45', 1, '11:52:19'),
(968, '2016-08-16 11:52:19', 6, '::1', 620160816063320, 25, '11:52:19', 1, '11:54:26'),
(969, '2016-08-16 11:54:26', 6, '::1', 620160816063320, 36, '11:54:26', 1, '11:54:27'),
(970, '2016-08-16 11:54:27', 6, '::1', 620160816063320, 25, '11:54:27', 1, '11:54:28'),
(971, '2016-08-16 11:54:28', 6, '::1', 620160816063320, 27, '11:54:28', 1, '12:02:30'),
(972, '2016-08-16 12:02:30', 6, '::1', 620160816063320, 26, '12:02:30', 1, '12:08:27'),
(973, '2016-08-16 12:08:27', 6, '::1', 620160816063320, 29, '12:08:27', 1, '12:10:31'),
(974, '2016-08-16 12:10:31', 6, '::1', 620160816063320, 26, '12:10:31', 1, '12:13:21'),
(975, '2016-08-16 12:13:21', 6, '::1', 620160816063320, 27, '12:13:21', 1, '12:13:22'),
(976, '2016-08-16 12:13:22', 6, '::1', 620160816063320, 39, '12:13:22', 1, '12:13:23'),
(977, '2016-08-16 12:13:23', 6, '::1', 620160816063320, 25, '12:13:23', 1, '12:13:26'),
(978, '2016-08-16 12:13:27', 6, '::1', 620160816063320, 39, '12:13:27', 1, '12:13:30'),
(979, '2016-08-16 12:13:30', 6, '::1', 620160816063320, 27, '12:13:30', 1, '12:13:31'),
(980, '2016-08-16 12:13:31', 6, '::1', 620160816063320, 26, '12:13:31', 1, '12:13:36'),
(981, '2016-08-16 12:13:36', 6, '::1', 620160816063320, 29, '12:13:36', 1, '12:18:01'),
(982, '2016-08-16 12:18:01', 6, '::1', 620160816063320, 26, '12:18:01', 1, '12:18:02'),
(983, '2016-08-16 12:18:02', 6, '::1', 620160816063320, 27, '12:18:02', 1, '12:18:03'),
(984, '2016-08-16 12:18:03', 6, '::1', 620160816063320, 39, '12:18:03', 1, '12:20:23'),
(985, '2016-08-16 12:20:23', 6, '::1', 620160816063320, 25, '12:20:23', 1, '12:20:33'),
(986, '2016-08-16 12:20:33', 6, '::1', 620160816063320, 29, '12:20:33', 1, '12:21:15'),
(987, '2016-08-16 12:21:15', 6, '::1', 620160816063320, 39, '12:21:15', 1, '12:21:35'),
(988, '2016-08-16 12:21:35', 6, '::1', 620160816063320, 29, '12:21:35', 1, '12:32:04'),
(989, '2016-08-16 12:32:04', 6, '::1', 620160816063320, 36, '12:32:04', 1, '12:33:35'),
(990, '2016-08-16 12:33:35', 6, '::1', 620160816063320, 28, '12:33:35', 1, '12:37:51'),
(991, '2016-08-16 12:37:51', 6, '::1', 620160816063320, 36, '12:37:51', 1, '12:38:47'),
(992, '2016-08-16 12:38:47', 6, '::1', 620160816063320, 28, '12:38:47', 1, '12:41:13'),
(993, '2016-08-16 12:41:13', 6, '::1', 620160816063320, 36, '12:41:13', 1, '12:42:02'),
(994, '2016-08-16 12:42:02', 6, '::1', 620160816063320, 29, '12:42:02', 1, '12:42:03'),
(995, '2016-08-16 12:42:03', 6, '::1', 620160816063320, 25, '12:42:03', 1, '12:42:04'),
(996, '2016-08-16 12:42:04', 6, '::1', 620160816063320, 39, '12:42:04', 1, '12:42:05'),
(997, '2016-08-16 12:42:05', 6, '::1', 620160816063320, 25, '12:42:05', 3, '12:44:29'),
(998, '2016-08-16 12:44:29', 6, '::1', 620160816063320, 28, '12:44:29', 1, '12:46:01'),
(999, '2016-08-16 12:46:01', 6, '::1', 620160816063320, 25, '12:46:01', 1, '12:46:04'),
(1000, '2016-08-16 12:46:04', 6, '::1', 620160816063320, 39, '12:46:04', 2, '12:47:31'),
(1001, '2016-08-16 12:47:31', 6, '::1', 620160816063320, 28, '12:47:31', 4, '13:18:12'),
(1002, '2016-08-16 13:18:13', 6, '::1', 620160816063320, 25, '13:18:13', 1, '13:18:51'),
(1003, '2016-08-16 13:18:51', 6, '::1', 620160816063320, 28, '13:18:51', 18, '14:01:50'),
(1004, '2016-08-16 14:01:50', 6, '::1', 620160816063320, 25, '14:01:50', 1, '14:02:39'),
(1005, '2016-08-16 14:02:39', 6, '::1', 620160816063320, 28, '14:02:39', 21, '14:47:40'),
(1006, '2016-08-16 14:47:40', 6, '::1', 620160816063320, 27, '14:47:40', 1, '14:47:43'),
(1007, '2016-08-16 14:47:43', 6, '::1', 620160816063320, 26, '14:47:43', 9, '14:56:13'),
(1008, '2016-08-16 14:56:13', 6, '::1', 620160816063320, 28, '14:56:13', 2, '15:01:21'),
(1009, '2016-08-16 15:01:21', 6, '::1', 620160816063320, 26, '15:01:21', 4, '15:05:32'),
(1010, '2016-08-16 15:05:32', 6, '::1', 620160816063320, 38, '15:05:32', 7, '15:12:27'),
(1011, '2016-08-16 15:12:27', 6, '::1', 620160816063320, 37, '15:12:27', 6, '15:17:19'),
(1012, '2016-08-16 15:17:19', 6, '::1', 620160816063320, 33, '15:17:19', 2, '15:20:59'),
(1013, '2016-08-16 15:21:00', 6, '::1', 620160816063320, 29, '15:21:00', 1, '15:22:56'),
(1014, '2016-08-16 15:22:56', 6, '::1', 620160816063320, 36, '15:22:56', 16, '15:36:19'),
(1015, '2016-08-16 15:36:19', 6, '::1', 620160816063320, 35, '15:36:19', 1, '15:38:15'),
(1016, '2016-08-16 15:38:15', 6, '::1', 620160816063320, 27, '15:38:15', 1, '15:38:42'),
(1017, '2016-08-16 15:38:42', 6, '::1', 620160816063320, 26, '15:38:42', 1, '15:40:54'),
(1018, '2016-08-16 15:40:54', 6, '::1', 620160816063320, 25, '15:40:54', 20, '15:50:30'),
(1019, '2016-08-16 15:50:30', 6, '::1', 620160816063320, 34, '15:50:30', 21, '16:03:23'),
(1020, '2016-08-16 16:03:23', 6, '::1', 620160816063320, 39, '16:03:23', 2, '16:07:24'),
(1021, '2016-08-16 16:07:24', 6, '::1', 620160816063320, 32, '16:07:24', 1, '16:08:39'),
(1022, '2016-08-16 16:08:39', 6, '::1', 620160816063320, 39, '16:08:39', 2, '16:09:14'),
(1023, '2016-08-16 16:09:14', 6, '::1', 620160816063320, 32, '16:09:14', 2, '16:10:49'),
(1024, '2016-08-16 16:10:49', 6, '::1', 620160816063320, 39, '16:10:49', 1, '16:11:59'),
(1025, '2016-08-16 16:12:00', 6, '::1', 620160816063320, 30, '16:12:00', 1, '16:12:05'),
(1026, '2016-08-16 16:12:05', 6, '::1', 620160816063320, 31, '16:12:05', 2, '16:14:23'),
(1027, '2016-08-16 16:14:23', 6, '::1', 620160816063320, 30, '16:14:23', 1, '16:14:24'),
(1028, '2016-08-16 16:14:25', 6, '::1', 620160816063320, 39, '16:14:25', 1, '16:14:29'),
(1029, '2016-08-16 16:14:29', 6, '::1', 620160816063320, 32, '16:14:29', 1, '16:14:37'),
(1030, '2016-08-16 16:14:37', 6, '::1', 620160816063320, 39, '16:14:37', 1, '16:14:40'),
(1031, '2016-08-16 16:14:40', 6, '::1', 620160816063320, 30, '16:14:40', 1, '16:14:40'),
(1032, '2016-08-16 16:14:40', 6, '::1', 620160816063320, 31, '16:14:40', 1, '16:16:00'),
(1033, '2016-08-16 16:16:00', 6, '::1', 620160816063320, 30, '16:16:00', 2, '16:16:41'),
(1034, '2016-08-16 16:16:41', 6, '::1', 620160816063320, 36, '16:16:41', 1, '16:16:55'),
(1035, '2016-08-16 16:16:55', 6, '::1', 620160816063320, 31, '16:16:55', 1, '16:16:56'),
(1036, '2016-08-16 16:16:56', 6, '::1', 620160816063320, 30, '16:16:56', 1, '16:16:57'),
(1037, '2016-08-16 16:16:57', 6, '::1', 620160816063320, 39, '16:16:57', 2, '16:18:29'),
(1038, '2016-08-16 16:18:29', 6, '::1', 620160816063320, 36, '16:18:29', 1, '00:00:00'),
(1039, '2016-08-17 06:23:19', 6, '::1', 620160817062314, 39, '06:23:19', 1, '06:24:11'),
(1040, '2016-08-17 06:24:11', 6, '::1', 620160817062314, 38, '06:24:11', 1, '06:27:29'),
(1041, '2016-08-17 06:27:29', 6, '::1', 620160817062314, 39, '06:27:29', 23, '08:05:55'),
(1042, '2016-08-17 08:05:55', 6, '::1', 620160817062314, 26, '08:05:55', 2, '08:11:27'),
(1043, '2016-08-17 08:11:27', 6, '::1', 620160817062314, 36, '08:11:27', 1, '08:20:59'),
(1044, '2016-08-17 08:20:59', 6, '::1', 620160817062314, 29, '08:20:59', 1, '08:24:16'),
(1045, '2016-08-17 08:24:16', 6, '::1', 620160817062314, 39, '08:24:16', 1, '08:24:35'),
(1046, '2016-08-17 08:24:35', 6, '::1', 620160817062314, 37, '08:24:35', 1, '08:24:45'),
(1047, '2016-08-17 08:24:45', 6, '::1', 620160817062314, 39, '08:24:45', 1, '08:26:24'),
(1048, '2016-08-17 08:26:24', 6, '::1', 620160817062314, 38, '08:26:24', 1, '08:31:52'),
(1049, '2016-08-17 08:31:52', 6, '::1', 620160817062314, 25, '08:31:52', 1, '08:31:58'),
(1050, '2016-08-17 08:31:58', 6, '::1', 620160817062314, 26, '08:31:58', 1, '08:58:48'),
(1051, '2016-08-17 08:58:48', 6, '::1', 620160817062314, 29, '08:58:48', 1, '09:14:46'),
(1052, '2016-08-17 09:14:46', 6, '::1', 620160817062314, 33, '09:14:46', 1, '09:15:15'),
(1053, '2016-08-17 09:15:15', 6, '::1', 620160817062314, 36, '09:15:15', 1, '09:15:58'),
(1054, '2016-08-17 09:15:58', 6, '::1', 620160817062314, 25, '09:15:58', 1, '09:15:59'),
(1055, '2016-08-17 09:15:59', 6, '::1', 620160817062314, 34, '09:15:59', 1, '09:21:13'),
(1056, '2016-08-17 09:21:13', 6, '::1', 620160817062314, 36, '09:21:13', 1, '00:00:00'),
(1057, '2016-08-17 14:10:41', 6, '::1', 620160817140542, 26, '14:10:41', 4, '14:23:50'),
(1058, '2016-08-17 14:23:50', 6, '::1', 620160817140542, 25, '14:23:50', 1, '14:40:05'),
(1059, '2016-08-17 14:40:06', 6, '::1', 620160817140542, 26, '14:40:06', 1, '00:00:00'),
(1060, '2016-08-18 11:39:43', 6, '::1', 620160818113937, 26, '11:39:43', 12, '12:28:47'),
(1061, '2016-08-18 12:28:47', 6, '::1', 620160818113937, 29, '12:28:47', 20, '13:14:15'),
(1062, '2016-08-18 13:14:15', 6, '::1', 620160818113937, 36, '13:14:15', 9, '13:31:27'),
(1063, '2016-08-18 13:31:27', 6, '::1', 620160818113937, 26, '13:31:27', 1, '13:35:05'),
(1064, '2016-08-18 13:35:05', 6, '::1', 620160818113937, 25, '13:35:05', 1, '13:43:53'),
(1065, '2016-08-18 13:43:53', 6, '::1', 620160818113937, 26, '13:43:53', 16, '14:12:36'),
(1066, '2016-08-18 14:12:36', 6, '::1', 620160818113937, 40, '14:12:36', 1, '00:00:00'),
(1067, '2016-08-18 14:17:13', 6, '::1', 620160818141708, 26, '14:17:13', 10, '14:39:00'),
(1068, '2016-08-18 14:39:00', 6, '::1', 620160818141708, 37, '14:39:00', 1, '15:00:58'),
(1069, '2016-08-18 15:00:58', 6, '::1', 620160818141708, 26, '15:00:58', 2, '00:00:00'),
(1070, '2016-08-18 19:43:36', 6, '::1', 620160818194322, 36, '19:43:36', 1, '19:46:28'),
(1071, '2016-08-18 19:46:28', 6, '::1', 620160818194322, 25, '19:46:28', 1, '19:46:29'),
(1072, '2016-08-18 19:46:29', 6, '::1', 620160818194322, 34, '19:46:29', 1, '19:47:06'),
(1073, '2016-08-18 19:47:06', 6, '::1', 620160818194322, 36, '19:47:06', 6, '00:00:00'),
(1074, '2016-08-19 06:37:27', 6, '::1', 620160819063645, 36, '06:37:27', 5, '06:45:31'),
(1075, '2016-08-19 06:45:31', 6, '::1', 620160819063645, 25, '06:45:31', 3, '07:09:34'),
(1076, '2016-08-19 07:09:34', 6, '::1', 620160819063645, 36, '07:09:34', 1, '07:09:41'),
(1077, '2016-08-19 07:09:41', 6, '::1', 620160819063645, 25, '07:09:41', 4, '07:39:25'),
(1078, '2016-08-19 07:39:25', 6, '::1', 620160819063645, 29, '07:39:25', 2, '07:41:38'),
(1079, '2016-08-19 07:41:38', 6, '::1', 620160819063645, 26, '07:41:38', 1, '07:41:48'),
(1080, '2016-08-19 07:41:48', 6, '::1', 620160819063645, 25, '07:41:48', 1, '07:42:30'),
(1081, '2016-08-19 07:42:30', 6, '::1', 620160819063645, 29, '07:42:30', 29, '08:52:18'),
(1082, '2016-08-19 08:52:18', 6, '::1', 620160819063645, 27, '08:52:18', 1, '08:52:32'),
(1083, '2016-08-19 08:52:32', 6, '::1', 620160819063645, 25, '08:52:32', 1, '08:52:48'),
(1084, '2016-08-19 08:52:49', 6, '::1', 620160819063645, 41, '08:52:49', 27, '10:17:43'),
(1085, '2016-08-19 10:17:43', 6, '::1', 620160819063645, 36, '10:17:43', 1, '10:17:47'),
(1086, '2016-08-19 10:17:47', 6, '::1', 620160819063645, 29, '10:17:47', 7, '12:07:40'),
(1087, '2016-08-19 12:07:40', 6, '::1', 620160819063645, 41, '12:07:40', 13, '12:44:17'),
(1088, '2016-08-19 12:44:17', 6, '::1', 620160819063645, 39, '12:44:17', 21, '13:30:17'),
(1089, '2016-08-19 13:30:17', 6, '::1', 620160819063645, 41, '13:30:17', 25, '14:36:48'),
(1090, '2016-08-19 14:36:49', 6, '::1', 620160819063645, 36, '14:36:49', 3, '14:49:56'),
(1091, '2016-08-19 14:49:56', 6, '::1', 620160819063645, 41, '14:49:56', 1, '14:52:51'),
(1092, '2016-08-19 14:52:51', 6, '::1', 620160819063645, 38, '14:52:51', 1, '14:53:29'),
(1093, '2016-08-19 14:53:29', 6, '::1', 620160819063645, 41, '14:53:29', 11, '15:46:07'),
(1094, '2016-08-19 15:46:07', 6, '::1', 620160819063645, 38, '15:46:07', 1, '15:47:24'),
(1095, '2016-08-19 15:47:24', 6, '::1', 620160819063645, 41, '15:47:24', 2, '00:00:00'),
(1096, '2016-08-20 06:46:18', 6, '::1', 620160820064616, 41, '06:46:18', 1, '06:56:13'),
(1097, '2016-08-20 06:56:13', 6, '::1', 620160820064616, 25, '06:56:13', 1, '07:03:01'),
(1098, '2016-08-20 07:03:01', 6, '::1', 620160820064616, 27, '07:03:01', 2, '07:04:52'),
(1099, '2016-08-20 07:04:52', 6, '::1', 620160820064616, 25, '07:04:52', 1, '07:05:08'),
(1100, '2016-08-20 07:05:09', 6, '::1', 620160820064616, 42, '07:05:09', 1, '00:00:00'),
(1101, '2016-08-20 07:05:20', 6, '::1', 620160820070510, 42, '07:05:20', 1, '00:00:00'),
(1102, '2016-08-20 07:05:43', 6, '::1', 620160820070541, 42, '07:05:43', 1, '07:21:10'),
(1103, '2016-08-20 07:21:10', 6, '::1', 620160820070541, 41, '07:21:10', 75, '12:01:45'),
(1104, '2016-08-20 12:01:45', 6, '::1', 620160820070541, 38, '12:01:45', 1, '12:15:12'),
(1105, '2016-08-20 12:15:12', 6, '::1', 620160820070541, 41, '12:15:12', 14, '13:11:22'),
(1106, '2016-08-20 13:11:22', 6, '::1', 620160820070541, 31, '13:11:22', 1, '13:13:00'),
(1107, '2016-08-20 13:13:00', 6, '::1', 620160820070541, 39, '13:13:00', 1, '13:21:35'),
(1108, '2016-08-20 13:21:35', 6, '::1', 620160820070541, 25, '13:21:35', 2, '13:23:21'),
(1109, '2016-08-20 13:23:21', 6, '::1', 620160820070541, 41, '13:23:21', 13, '13:28:13'),
(1110, '2016-08-20 13:28:13', 6, '::1', 620160820070541, 25, '13:28:13', 1, '13:28:36'),
(1111, '2016-08-20 13:28:36', 6, '::1', 620160820070541, 41, '13:28:36', 3, '13:29:01'),
(1112, '2016-08-20 13:29:01', 6, '::1', 620160820070541, 25, '13:29:01', 1, '13:29:11'),
(1113, '2016-08-20 13:29:11', 6, '::1', 620160820070541, 41, '13:29:11', 2, '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `log_pagenamelist`
--

CREATE TABLE `log_pagenamelist` (
  `id` int(2) NOT NULL,
  `pagename` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `log_pagenamelist`
--

INSERT INTO `log_pagenamelist` (`id`, `pagename`) VALUES
(25, 'add_pageaccess.php'),
(26, 'add_merchant.php'),
(27, 'add_menu.php'),
(28, 'add_login.php'),
(29, 'add_consignee.php'),
(30, 'add_vehicleownership.php'),
(31, 'add_vehicle.php'),
(32, 'add_transporter.php'),
(33, 'add_category.php'),
(34, 'add_product.php'),
(35, 'add_contacttype.php'),
(36, 'add_consignor.php'),
(37, 'add_area.php'),
(38, 'add_additionalcharge.php'),
(39, 'add_rate.php'),
(40, 'form_controls_extended.php'),
(41, 'lrentry.php'),
(42, 'add_financialyear.php');

-- --------------------------------------------------------

--
-- Table structure for table `log_tableend`
--

CREATE TABLE `log_tableend` (
  `id` int(11) NOT NULL,
  `log_tablestartid` int(11) NOT NULL,
  `log_tableslistid` smallint(6) NOT NULL DEFAULT '0',
  `ColumnID` int(11) NOT NULL,
  `oldvalue` varchar(65000) NOT NULL,
  `outtime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_tableend`
--

INSERT INTO `log_tableend` (`id`, `log_tablestartid`, `log_tableslistid`, `ColumnID`, `oldvalue`, `outtime`) VALUES
(1, 9, 1, 1, '1|~|2016-08-12 08:53:52|~|2016-08-12 10:57:59|~|6|~|::1|~|s|~|s|~|1|~|s|~|s|~|sa@sa.com|~|http://www.sa.com|~|s|~|1', '10:58:44'),
(2, 10, 1, 1, '1|~|2016-08-12 08:53:52|~|2016-08-12 10:58:44|~|6|~|::1|~|s|~|s|~|1|~|s|~|s|~|sa@sa.com|~|http://www.sa.com|~|s|~|1', '11:02:19'),
(3, 11, 1, 1, '1|~|2016-08-12 08:53:52|~|2016-08-12 11:02:19|~|6|~|::1|~|s|~|s|~|1|~|s|~|s|~|sa@sa.com|~|http://www.sa.com|~|s|~|1', '12:47:26'),
(4, 12, 1, 1, '1|~|2016-08-12 08:53:52|~|2016-08-12 12:47:25|~|6|~|::1|~|s|~|s|~|1|~|s|~|s|~|sa@sa.com|~|http://www.sa.com|~|s|~|1', '12:48:45'),
(5, 13, 1, 1, '1|~|2016-08-12 08:53:52|~|2016-08-12 12:48:45|~|6|~|::1|~|s|~|s|~|1|~|s|~|s|~|sa@sa.com|~|http://www.sa.com|~|s|~|1', '12:49:07'),
(6, 14, 1, 1, '1|~|2016-08-12 08:53:52|~|2016-08-12 12:49:07|~|6|~|::1|~|s|~|s|~|1|~|s|~|s|~|sa@sa.com|~|http://www.sa.com|~|s|~|1', '12:51:26'),
(7, 15, 1, 1, '1|~|2016-08-12 08:53:52|~|2016-08-12 12:51:26|~|6|~|::1|~|s|~|s|~|1|~|s|~|s|~|sa@sa.com|~|http://www.sa.com|~|s|~|1', '14:05:39'),
(8, 16, 1, 0, '', '07:49:44'),
(9, 17, 1, 2, '2|~|2016-08-13 07:49:44|~||~|6|~|::1|~|Vighnahar Logistics|~|Bhiwandi|~|32767|~|Thane|~|6578945213|~|v@v.com|~|http://www.v.com|~|AHJS78DD4|~|1', '13:07:19'),
(10, 18, 1, 2, '2|~|2016-08-13 07:49:44|~|2016-08-13 01:07:19|~|6|~|::1|~|Vighnahar Logistics|~|Bhiwandi|~|32767|~|Thane|~|6578945213|~|v@v.com|~|http://www.v.com|~|AHJS78DD4|~|1', '13:08:10'),
(11, 21, 2, 0, '', '14:05:01'),
(12, 22, 2, 0, '', '14:15:28'),
(13, 23, 2, 0, '', '14:17:01'),
(14, 25, 2, 3, '3|~|2016-08-13 02:17:00|~|0000-00-00 00:00:00|~|6|~|::1|~|add_login.php|~|1', '14:27:23'),
(15, 26, 2, 3, '3|~|2016-08-13 02:17:00|~|2016-08-13 02:27:23|~|6|~|::1|~|add_login1.php|~|1', '14:27:30'),
(16, 27, 2, 3, '3|~|2016-08-13 02:17:00|~|2016-08-13 02:27:29|~|6|~|::1|~|add_login.php|~|1', '14:37:57'),
(17, 28, 2, 3, '3|~|2016-08-13 02:17:00|~|2016-08-13 02:37:57|~|6|~|::1|~|add_login.php|~|1', '14:39:21'),
(18, 29, 2, 3, '3|~|2016-08-13 02:17:00|~|2016-08-13 02:39:20|~|6|~|::1|~|add_login.php|~|1', '14:39:44'),
(19, 30, 2, 3, '3|~|2016-08-13 02:17:00|~|2016-08-13 02:39:43|~|6|~|::1|~|add_login.php|~|1', '14:40:11'),
(20, 31, 2, 3, '3|~|2016-08-13 02:17:00|~|2016-08-13 02:40:11|~|6|~|::1|~|add_login.php|~|1', '14:41:27'),
(21, 32, 2, 3, '3|~|2016-08-13 02:17:00|~|2016-08-13 02:41:27|~|6|~|::1|~|add_login.php|~|1', '14:41:52'),
(22, 33, 2, 3, '3|~|2016-08-13 02:17:00|~|2016-08-13 02:41:51|~|6|~|::1|~|add_login.php|~|1', '15:34:23'),
(23, 34, 3, 0, '', '16:33:08'),
(24, 39, 3, 1, '1|~|2016-08-13 04:33:08|~|0000-00-00 00:00:00|~|6|~|::1|~|3|~|6|~|1', '17:15:04'),
(25, 40, 3, 1, '1|~|2016-08-13 04:33:08|~|2016-08-13 05:15:03|~|6|~|::1|~|3|~|7|~|1', '17:16:08'),
(26, 41, 3, 1, '1|~|2016-08-13 04:33:08|~|2016-08-13 05:16:08|~|6|~|::1|~|3|~|6|~|1', '17:17:59'),
(27, 42, 3, 1, '1|~|2016-08-13 04:33:08|~|2016-08-13 05:17:59|~|6|~|::1|~|3|~|6|~|1', '17:19:43'),
(28, 43, 3, 1, '1|~|2016-08-13 04:33:08|~|2016-08-13 05:19:42|~|6|~|::1|~|3|~|6|~|1', '17:21:59'),
(29, 44, 3, 1, '1|~|2016-08-13 04:33:08|~|2016-08-13 05:21:59|~|6|~|::1|~|3|~|6|~|1', '17:24:47'),
(30, 45, 3, 1, '1|~|2016-08-13 04:33:08|~|2016-08-13 05:24:47|~|6|~|::1|~|3|~|6|~|1', '17:27:24'),
(31, 46, 3, 1, '1|~|2016-08-13 04:33:08|~|2016-08-13 05:27:24|~|6|~|::1|~|3|~|6|~|1', '17:29:08'),
(32, 47, 3, 1, '1|~|2016-08-13 04:33:08|~|2016-08-13 05:29:08|~|6|~|::1|~|3|~|6|~|1', '17:40:59'),
(33, 48, 3, 0, '', '06:49:17'),
(34, 49, 2, 3, '3|~|2016-08-13 02:17:00|~|2016-08-13 03:34:23|~|6|~|::1|~|add_login.php|~|1', '07:25:59'),
(35, 50, 2, 3, '3|~|2016-08-13 02:17:00|~|2016-08-14 07:25:59|~|6|~|::1|~|add_login.php|~|1', '07:26:08'),
(36, 51, 1, 2, '2|~|2016-08-13 07:49:44|~|2016-08-13 01:08:10|~|6|~|::1|~|Vighnahar Logistics|~|Bhiwandi|~|32767|~|Thane|~|6578945213|~|v@v.com|~|http://www.v.com|~|AHJS78DD4|~|1', '07:36:53'),
(37, 52, 2, 0, '', '07:48:30'),
(38, 53, 3, 0, '', '07:48:54'),
(39, 54, 3, 2, '2|~|2016-08-14 06:49:17|~|0000-00-00 00:00:00|~|6|~|::1|~|3|~|8|~|1', '07:49:11'),
(40, 55, 3, 0, '', '07:50:01'),
(41, 56, 2, 0, '', '11:00:37'),
(42, 57, 3, 0, '', '11:00:48'),
(43, 58, 3, 0, '', '11:05:00'),
(44, 61, 2, 0, '', '12:23:01'),
(45, 62, 3, 0, '', '12:23:10'),
(46, 68, 5, 0, '', '16:44:52'),
(47, 69, 6, 0, '', '16:44:52'),
(48, 70, 5, 0, '', '05:48:21'),
(49, 71, 6, 0, '', '05:48:21'),
(50, 78, 5, 2, '2|~|2016-08-15 05:48:21|~|2016-08-15 06:22:18|~|6|~|::1|~|Test1|~|http://www.test.com|~|1', '06:23:00'),
(51, 79, 6, 2, '2|~|2016-08-15 05:48:21|~|2016-08-15 06:22:18|~|6|~|::1|~|2|~|Test|~|123456|~|Thane|~|987654321|~|test@test.com|~|1', '06:23:00'),
(52, 80, 5, 2, '2|~|2016-08-15 05:48:21|~|2016-08-15 06:22:59|~|6|~|::1|~|Test1|~|http://www.test.com|~|1', '06:23:07'),
(53, 81, 6, 2, '2|~|2016-08-15 05:48:21|~|2016-08-15 06:22:59|~|6|~|::1|~|2|~|Test|~|123456|~|Thane|~|987654321|~|test@test.com|~|1', '06:23:07'),
(54, 82, 2, 0, '', '07:46:44'),
(55, 83, 3, 0, '', '07:46:55'),
(56, 84, 7, 0, '', '07:53:51'),
(57, 89, 7, 1, '1|~|2016-08-15 07:53:50|~||~|6|~|::1|~|Owner|~|1', '08:07:03'),
(58, 90, 7, 1, '1|~|2016-08-15 07:53:50|~|2016-08-15 08:07:03|~|6|~|::1|~|Owner1|~|1', '08:07:32'),
(59, 91, 2, 0, '', '08:10:28'),
(60, 92, 3, 0, '', '08:10:36'),
(61, 93, 8, 0, '', '08:24:41'),
(62, 94, 8, 1, '1|~|2016-08-15 08:24:41|~||~|6|~|::1|~|1|~|s|~|s|~|s|~|1', '08:49:11'),
(63, 95, 2, 0, '', '09:23:08'),
(64, 96, 3, 0, '', '09:23:18'),
(65, 97, 9, 0, '', '09:44:04'),
(66, 98, 9, 1, '1|~|2016-08-15 09:44:04|~||~|6|~|::1|~|1|~|s|~|s|~|s|~|s|~|1', '10:24:35'),
(67, 99, 9, 1, '1|~|2016-08-15 09:44:04|~|2016-08-15 10:24:35|~|6|~|::1|~|1|~|s1|~|s|~|s|~|s|~|1', '10:26:07'),
(68, 100, 2, 0, '', '11:32:06'),
(69, 101, 3, 0, '', '11:32:13'),
(70, 102, 10, 0, '', '11:37:45'),
(71, 103, 10, 1, '1|~|2016-08-15 11:37:45|~||~|6|~|::1|~|s|~|0|~|1', '11:47:04'),
(72, 104, 10, 1, '1|~|2016-08-15 11:37:45|~|2016-08-15 11:47:04|~|6|~|::1|~|s1|~|0|~|1', '11:47:10'),
(73, 105, 2, 0, '', '11:54:43'),
(74, 106, 3, 0, '', '11:54:55'),
(75, 108, 11, 0, '', '11:58:15'),
(76, 109, 11, 1, '1|~|2016-08-15 11:58:15|~||~|6|~|::1|~|1|~|s|~|1', '12:15:58'),
(77, 110, 11, 1, '1|~|2016-08-15 11:58:15|~|2016-08-15 12:15:58|~|6|~|::1|~|2|~|s2222|~|1', '12:16:31'),
(78, 111, 2, 0, '', '13:07:00'),
(79, 112, 3, 0, '', '13:07:10'),
(80, 114, 12, 0, '', '13:13:18'),
(81, 115, 12, 1, '1|~|2016-08-15 01:13:18|~||~|6|~|::1|~|Mobile|~|1', '13:19:27'),
(82, 116, 12, 1, '1|~|2016-08-15 01:13:18|~|2016-08-15 01:19:27|~|6|~|::1|~|Mobile|~|1', '13:20:00'),
(83, 117, 12, 1, '1|~|2016-08-15 01:13:18|~|2016-08-15 01:20:00|~|6|~|::1|~|Mobiles|~|1', '13:20:08'),
(84, 118, 2, 0, '', '13:46:00'),
(85, 119, 3, 0, '', '13:46:08'),
(86, 124, 13, 0, '', '17:12:28'),
(87, 125, 14, 0, '', '17:12:28'),
(88, 126, 15, 0, '', '17:12:29'),
(89, 127, 16, 0, '', '17:12:29'),
(90, 136, 13, 0, '', '17:34:36'),
(91, 137, 14, 0, '', '17:34:36'),
(92, 138, 15, 0, '', '17:34:36'),
(93, 139, 16, 0, '', '17:34:36'),
(94, 140, 13, 0, '', '17:36:42'),
(95, 141, 14, 0, '', '17:36:43'),
(96, 142, 15, 0, '', '17:36:43'),
(97, 143, 16, 0, '', '17:36:43'),
(98, 144, 1, 2, '2|~|2016-08-13 07:49:44|~|2016-08-14 07:36:52|~|6|~|::1|~|Vighnahar Logistics|~|Bhiwandi|~|32767|~|Thane|~|6578945213|~|v@v.com|~|http://www.v.com|~|AHJS78DD4|~|1', '06:37:32'),
(99, 145, 2, 0, '', '07:58:06'),
(100, 146, 3, 0, '', '07:58:13'),
(101, 148, 17, 0, '', '08:09:14'),
(102, 149, 17, 1, '1|~|2016-08-16 08:09:14|~||~|6|~|::1|~|Dombivli|~|1', '08:12:14'),
(103, 150, 17, 1, '1|~|2016-08-16 08:09:14|~|2016-08-16 08:12:13|~|6|~|::1|~|Dombivli1|~|1', '08:12:22'),
(104, 151, 2, 0, '', '08:17:09'),
(105, 152, 3, 0, '', '08:17:16'),
(106, 153, 18, 0, '', '08:47:09'),
(107, 154, 18, 1, '1|~|2016-08-16 08:47:09|~||~|6|~|::1|~|sa|~|1|~|1|~|1', '08:53:42'),
(108, 155, 18, 1, '1|~|2016-08-16 08:47:09|~|2016-08-16 08:53:42|~|6|~|::1|~|sa1|~|1|~|1|~|1', '08:54:33'),
(109, 156, 2, 0, '', '09:11:39'),
(110, 157, 3, 0, '', '09:11:48'),
(111, 159, 19, 0, '', '06:48:04'),
(112, 160, 19, 1, '1|~|2016-08-17 06:48:04|~||~|6|~|::1|~|20|~|1|~|1|~|1.00|~|2.00|~|3.00|~|1', '07:35:07'),
(113, 161, 19, 1, '1|~|2016-08-17 06:48:04|~|2016-08-17 07:35:06|~|6|~|::1|~|20|~|1|~|1|~|10.00|~|2.00|~|3.00|~|1', '07:35:17'),
(114, 162, 19, 1, '1|~|2016-08-17 06:48:04|~|2016-08-17 07:35:17|~|6|~|::1|~|20|~|1|~|1|~|10.00|~|22.00|~|37.00|~|1', '07:35:28'),
(115, 163, 1, 2, '2|~|2016-08-13 07:49:44|~|2016-08-16 06:37:32|~|6|~|::1|~|Vighnahar Logistics|~|Bhiwandi|~|32767|~|Thane|~|6578945213|~|v@v.com|~|http://www.v.com|~|AHJS78DD4|~|1', '08:08:49'),
(116, 164, 13, 0, '', '08:20:04'),
(117, 165, 14, 0, '', '08:20:04'),
(118, 166, 15, 0, '', '08:20:04'),
(119, 167, 16, 0, '', '08:20:04'),
(120, 168, 5, 0, '', '08:24:09'),
(121, 169, 6, 0, '', '08:24:09'),
(122, 170, 17, 0, '', '08:24:41'),
(123, 171, 19, 0, '', '08:25:15'),
(124, 172, 18, 1, '1|~|2016-08-16 08:47:09|~|2016-08-16 08:54:33|~|6|~|::1|~|sa|~|1|~|1|~|1', '08:27:15'),
(125, 173, 1, 0, '', '14:42:32'),
(126, 174, 1, 3, '3|~|2016-08-17 02:42:32|~||~|6|~|::1|~|Shree Vighnahar Logistics|~|Shed No 1 Gala No 1 Arihant Complex Kopar Bus Stop Purna Village Bhivandi|~|3|~|32767|~|Thane|~|9272217794,9272217795|~|chetannalawade@tttsvl.com|~|http://www.tttsvl.com|~|PANCARD|~|1', '12:17:18'),
(127, 177, 5, 0, '', '13:06:20'),
(128, 178, 6, 0, '', '13:06:20'),
(129, 179, 5, 4, '4|~|2016-08-18 01:06:20|~||~|6|~|::1|~|t1|~|http://www.sa.com|~|1', '13:10:09'),
(130, 180, 6, 4, '4|~|2016-08-18 01:06:20|~||~|6|~|::1|~|4|~|t1|~|4|~|400001|~|t|~|1|~|sa@sa.com|~|1', '13:10:09'),
(131, 181, 11, 0, '', '19:46:47'),
(132, 182, 11, 0, '', '19:46:57'),
(133, 183, 11, 0, '', '19:47:04'),
(134, 184, 13, 0, '', '06:49:36'),
(135, 185, 14, 0, '', '06:49:36'),
(136, 186, 15, 0, '', '06:49:36'),
(137, 187, 16, 0, '', '06:49:36'),
(138, 188, 5, 0, '', '07:52:45'),
(139, 189, 6, 0, '', '07:52:45'),
(140, 190, 5, 3, '3|~|2016-08-17 08:24:09|~||~|6|~|::1|~|22|~|Chimanlal Sons|~|http://www.sa.com|~|1', '08:08:25'),
(141, 191, 6, 3, '3|~|2016-08-17 08:24:09|~||~|6|~|::1|~|3|~|Borivli East|~|3|~|400001|~|Mumbai|~|123|~|sa@sa.com|~|1', '08:08:25'),
(142, 192, 5, 3, '3|~|2016-08-17 08:24:09|~|2016-08-19 08:08:25|~|6|~|::1|~|20|~|Chimanlal Sons|~|http://www.sa.com|~|1', '08:12:16'),
(143, 193, 6, 3, '3|~|2016-08-17 08:24:09|~|2016-08-19 08:08:25|~|6|~|::1|~|3|~|Borivli East|~|3|~|400001|~|Mumbai|~|123|~|sa@sa.com|~|1', '08:12:16'),
(144, 194, 5, 3, '3|~|2016-08-17 08:24:09|~|2016-08-19 08:12:15|~|6|~|::1|~|21|~|Chimanlal Sons|~|http://www.sa.com|~|1', '08:13:02'),
(145, 195, 6, 3, '3|~|2016-08-17 08:24:09|~|2016-08-19 08:12:15|~|6|~|::1|~|3|~|Borivli East|~|3|~|400001|~|Mumbai|~|123|~|sa@sa.com|~|1', '08:13:02'),
(146, 196, 5, 3, '3|~|2016-08-17 08:24:09|~|2016-08-19 08:13:01|~|6|~|::1|~|21|~|Chimanlal Sons|~|http://www.sa.com|~|1', '08:13:48'),
(147, 197, 6, 3, '3|~|2016-08-17 08:24:09|~|2016-08-19 08:13:01|~|6|~|::1|~|3|~|Borivli East|~|3|~|400001|~|Mumbai|~|123|~|sa@sa.com|~|1', '08:13:48'),
(148, 198, 5, 3, '3|~|2016-08-17 08:24:09|~|2016-08-19 08:13:48|~|6|~|::1|~|20|~|Chimanlal Sons|~|http://www.sa.com|~|1', '08:14:53'),
(149, 199, 6, 3, '3|~|2016-08-17 08:24:09|~|2016-08-19 08:13:48|~|6|~|::1|~|3|~|Borivli East|~|3|~|400001|~|Mumbai|~|123|~|sa@sa.com|~|1', '08:14:53'),
(150, 200, 5, 0, '', '08:15:48'),
(151, 201, 6, 3, '3|~|2016-08-17 08:24:09|~|2016-08-19 08:14:53|~|6|~|::1|~|3|~|Borivli East|~|3|~|400001|~|Mumbai|~|123|~|sa@sa.com|~|1', '08:15:48'),
(152, 202, 5, 6, '6|~|2016-08-19 08:15:48|~||~|6|~|::1|~|23|~|New Friday|~|http://www.sa.com|~|1', '08:18:14'),
(153, 203, 6, 6, '6|~|2016-08-19 08:15:48|~||~|6|~|::1|~|6|~|New Friday|~|7|~|123|~|Thane|~|987654321|~|sa@sa.com|~|1', '08:18:14'),
(154, 204, 5, 6, '6|~|2016-08-19 08:15:48|~|2016-08-19 08:18:14|~|6|~|::1|~|21|~|New Friday|~|http://www.sa.com|~|1', '08:18:39'),
(155, 205, 6, 6, '6|~|2016-08-19 08:15:48|~|2016-08-19 08:18:14|~|6|~|::1|~|6|~|New Friday|~|7|~|123|~|Thane|~|987654321|~|sa@sa.com|~|1', '08:18:39'),
(156, 206, 2, 0, '', '08:52:30'),
(157, 207, 3, 0, '', '08:52:43'),
(158, 208, 5, 3, '3|~|2016-08-17 08:24:09|~|2016-08-19 08:14:53|~|6|~|::1|~|20|~|Chimanlal Sons|~|http://www.sa.com|~|1', '10:25:39'),
(159, 209, 6, 3, '3|~|2016-08-17 08:24:09|~|2016-08-19 08:14:53|~|6|~|::1|~|3|~|Borivli East|~|3|~|400001|~|Mumbai|~|123|~|sa@sa.com|~|1', '10:25:39'),
(160, 210, 5, 3, '3|~|2016-08-17 08:24:09|~|2016-08-19 10:25:39|~|6|~|::1|~|20|~|Chimanlal Sons|~|http://www.sa.com|~|1', '10:25:46'),
(161, 211, 6, 3, '3|~|2016-08-17 08:24:09|~|2016-08-19 10:25:39|~|6|~|::1|~|3|~|Borivli East|~|3|~|400001|~|Mumbai|~|123|~|sa@sa.com|~|1', '10:25:46'),
(162, 213, 19, 0, '', '13:03:07'),
(163, 214, 19, 0, '', '13:03:57'),
(164, 215, 19, 3, '3|~|2016-08-19 01:03:07|~||~|6|~|::1|~|21|~|3|~|2|~|100.00|~|214.00|~|532.00|~|1', '13:27:57'),
(165, 216, 18, 0, '', '14:53:15'),
(166, 217, 18, 0, '', '15:46:41'),
(167, 218, 18, 0, '', '15:47:05'),
(168, 219, 2, 0, '', '07:04:49'),
(169, 220, 3, 0, '', '07:05:01'),
(170, 221, 18, 0, '', '12:02:22'),
(171, 228, 20, 0, '', '12:54:19'),
(172, 230, 20, 0, '', '12:54:19'),
(173, 229, 20, 0, '', '12:54:19'),
(174, 231, 20, 0, '', '12:55:35'),
(175, 232, 20, 0, '', '12:56:15'),
(176, 233, 20, 0, '', '12:56:15'),
(177, 235, 20, 0, '', '12:57:12');

-- --------------------------------------------------------

--
-- Table structure for table `log_tablelist`
--

CREATE TABLE `log_tablelist` (
  `id` smallint(6) NOT NULL,
  `tablename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_tablelist`
--

INSERT INTO `log_tablelist` (`id`, `tablename`) VALUES
(1, 'merchant_master'),
(2, '1menusub'),
(3, 'pageaccess_member'),
(4, 'login_master'),
(5, 'consignee_master'),
(6, 'consigneeaddress_master'),
(7, 'vehicleownership_master'),
(8, 'vehicle_master'),
(9, 'transporter_master'),
(10, 'category_master'),
(11, 'product_master'),
(12, 'contacttype_master'),
(13, 'consignor_master'),
(14, 'consignoraddress_master'),
(15, 'consignorcontact_master'),
(16, 'consignorproduct_master'),
(17, 'area_master'),
(18, 'additionalcharge_master'),
(19, 'rate_master'),
(20, 'inward');

-- --------------------------------------------------------

--
-- Table structure for table `log_tablestart`
--

CREATE TABLE `log_tablestart` (
  `id` int(11) NOT NULL,
  `Creation_Date` datetime NOT NULL,
  `Creator` int(11) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `pagename` varchar(50) NOT NULL,
  `intime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_tablestart`
--

INSERT INTO `log_tablestart` (`id`, `Creation_Date`, `Creator`, `ip`, `pagename`, `intime`) VALUES
(1, '2016-08-12 10:52:09', 6, '::1', 'save_merchant.php', '10:52:09'),
(2, '2016-08-12 10:52:38', 6, '::1', 'save_merchant.php', '10:52:38'),
(3, '2016-08-12 10:53:26', 6, '::1', 'save_merchant.php', '10:53:26'),
(4, '2016-08-12 10:53:51', 6, '::1', 'save_merchant.php', '10:53:51'),
(5, '2016-08-12 10:55:29', 6, '::1', 'save_merchant.php', '10:55:29'),
(6, '2016-08-12 10:55:57', 6, '::1', 'save_merchant.php', '10:55:57'),
(7, '2016-08-12 10:56:54', 6, '::1', 'save_merchant.php', '10:56:54'),
(8, '2016-08-12 10:57:59', 6, '::1', 'save_merchant.php', '10:57:59'),
(9, '2016-08-12 10:58:44', 6, '::1', 'save_merchant.php', '10:58:44'),
(10, '2016-08-12 11:02:19', 6, '::1', 'save_merchant.php', '11:02:19'),
(11, '2016-08-12 12:47:25', 6, '::1', 'save_merchant.php', '12:47:25'),
(12, '2016-08-12 12:48:45', 6, '::1', 'save_merchant.php', '12:48:45'),
(13, '2016-08-12 12:49:07', 6, '::1', 'save_merchant.php', '12:49:07'),
(14, '2016-08-12 12:51:26', 6, '::1', 'save_merchant.php', '12:51:26'),
(15, '2016-08-12 02:05:39', 6, '::1', 'save_merchant.php', '14:05:39'),
(16, '2016-08-13 07:49:44', 6, '::1', 'save_merchant.php', '07:49:44'),
(17, '2016-08-13 01:07:19', 6, '::1', 'save_merchant.php', '13:07:19'),
(18, '2016-08-13 01:08:10', 6, '::1', 'save_merchant.php', '13:08:10'),
(19, '2016-08-13 01:59:08', 6, '::1', 'save_menu.php', '13:59:08'),
(20, '2016-08-13 02:04:17', 6, '::1', 'save_menu.php', '14:04:17'),
(21, '2016-08-13 02:05:01', 6, '::1', 'save_menu.php', '14:05:01'),
(22, '2016-08-13 02:15:28', 6, '::1', 'save_menu.php', '14:15:28'),
(23, '2016-08-13 02:17:00', 6, '::1', 'save_menu.php', '14:17:00'),
(24, '2016-08-13 02:24:28', 6, '::1', 'save_menu.php', '14:24:28'),
(25, '2016-08-13 02:27:23', 6, '::1', 'save_menu.php', '14:27:23'),
(26, '2016-08-13 02:27:29', 6, '::1', 'save_menu.php', '14:27:29'),
(27, '2016-08-13 02:37:57', 6, '::1', 'save_menu.php', '14:37:57'),
(28, '2016-08-13 02:39:20', 6, '::1', 'save_menu.php', '14:39:20'),
(29, '2016-08-13 02:39:43', 6, '::1', 'save_menu.php', '14:39:43'),
(30, '2016-08-13 02:40:11', 6, '::1', 'save_menu.php', '14:40:11'),
(31, '2016-08-13 02:41:27', 6, '::1', 'save_menu.php', '14:41:27'),
(32, '2016-08-13 02:41:51', 6, '::1', 'save_menu.php', '14:41:51'),
(33, '2016-08-13 03:34:23', 6, '::1', 'save_menu.php', '15:34:23'),
(34, '2016-08-13 04:33:08', 6, '::1', 'save_pageaccess.php', '16:33:08'),
(35, '2016-08-13 05:12:37', 6, '::1', 'save_pageaccess.php', '17:12:37'),
(36, '2016-08-13 05:13:00', 6, '::1', 'save_pageaccess.php', '17:13:00'),
(37, '2016-08-13 05:13:53', 6, '::1', 'save_pageaccess.php', '17:13:53'),
(38, '2016-08-13 05:14:37', 6, '::1', 'save_pageaccess.php', '17:14:37'),
(39, '2016-08-13 05:15:03', 6, '::1', 'save_pageaccess.php', '17:15:03'),
(40, '2016-08-13 05:16:08', 6, '::1', 'save_pageaccess.php', '17:16:08'),
(41, '2016-08-13 05:17:59', 6, '::1', 'save_pageaccess.php', '17:17:59'),
(42, '2016-08-13 05:19:42', 6, '::1', 'save_pageaccess.php', '17:19:42'),
(43, '2016-08-13 05:21:59', 6, '::1', 'save_pageaccess.php', '17:21:59'),
(44, '2016-08-13 05:24:47', 6, '::1', 'save_pageaccess.php', '17:24:47'),
(45, '2016-08-13 05:27:24', 6, '::1', 'save_pageaccess.php', '17:27:24'),
(46, '2016-08-13 05:29:08', 6, '::1', 'save_pageaccess.php', '17:29:08'),
(47, '2016-08-13 05:40:59', 6, '::1', 'save_pageaccess.php', '17:40:59'),
(48, '2016-08-14 06:49:17', 6, '::1', 'save_pageaccess.php', '06:49:17'),
(49, '2016-08-14 07:25:59', 6, '::1', 'save_menu.php', '07:25:59'),
(50, '2016-08-14 07:26:08', 6, '::1', 'save_menu.php', '07:26:08'),
(51, '2016-08-14 07:36:52', 6, '::1', 'save_merchant.php', '07:36:52'),
(52, '2016-08-14 07:48:30', 6, '::1', 'save_menu.php', '07:48:30'),
(53, '2016-08-14 07:48:54', 6, '::1', 'save_pageaccess.php', '07:48:54'),
(54, '2016-08-14 07:49:10', 6, '::1', 'save_pageaccess.php', '07:49:10'),
(55, '2016-08-14 07:50:01', 6, '::1', 'save_pageaccess.php', '07:50:01'),
(56, '2016-08-14 11:00:36', 6, '::1', 'save_menu.php', '11:00:36'),
(57, '2016-08-14 11:00:48', 6, '::1', 'save_pageaccess.php', '11:00:48'),
(58, '2016-08-14 11:05:00', 6, '::1', 'save_pageaccess.php', '11:05:00'),
(59, '2016-08-14 11:55:59', 6, '::1', 'save_addlogin.php', '11:55:59'),
(60, '2016-08-14 12:00:38', 6, '::1', 'save_addlogin.php', '12:00:38'),
(61, '2016-08-14 12:23:01', 6, '::1', 'save_menu.php', '12:23:01'),
(62, '2016-08-14 12:23:10', 6, '::1', 'save_pageaccess.php', '12:23:10'),
(63, '2016-08-14 12:34:51', 6, '::1', 'save_consignee.php', '12:34:51'),
(64, '2016-08-14 12:35:01', 6, '::1', 'save_consignee.php', '12:35:01'),
(65, '2016-08-14 12:35:25', 6, '::1', 'save_consignee.php', '12:35:25'),
(66, '2016-08-14 04:40:49', 6, '::1', 'save_consignee.php', '16:40:49'),
(67, '2016-08-14 04:40:49', 6, '::1', 'save_consignee.php', '16:40:49'),
(68, '2016-08-14 04:44:52', 6, '::1', 'save_consignee.php', '16:44:52'),
(69, '2016-08-14 04:44:52', 6, '::1', 'save_consignee.php', '16:44:52'),
(70, '2016-08-15 05:48:21', 6, '::1', 'save_consignee.php', '05:48:21'),
(71, '2016-08-15 05:48:21', 6, '::1', 'save_consignee.php', '05:48:21'),
(72, '2016-08-15 06:20:29', 6, '::1', 'save_consignee.php', '06:20:29'),
(73, '2016-08-15 06:20:29', 6, '::1', 'save_consignee.php', '06:20:29'),
(74, '2016-08-15 06:21:38', 6, '::1', 'save_consignee.php', '06:21:38'),
(75, '2016-08-15 06:21:38', 6, '::1', 'save_consignee.php', '06:21:38'),
(76, '2016-08-15 06:22:18', 6, '::1', 'save_consignee.php', '06:22:18'),
(77, '2016-08-15 06:22:18', 6, '::1', 'save_consignee.php', '06:22:18'),
(78, '2016-08-15 06:22:59', 6, '::1', 'save_consignee.php', '06:22:59'),
(79, '2016-08-15 06:22:59', 6, '::1', 'save_consignee.php', '06:22:59'),
(80, '2016-08-15 06:23:07', 6, '::1', 'save_consignee.php', '06:23:07'),
(81, '2016-08-15 06:23:07', 6, '::1', 'save_consignee.php', '06:23:07'),
(82, '2016-08-15 07:46:44', 6, '::1', 'save_menu.php', '07:46:44'),
(83, '2016-08-15 07:46:55', 6, '::1', 'save_pageaccess.php', '07:46:55'),
(84, '2016-08-15 07:53:50', 6, '::1', 'save_addvehicleownership.php', '07:53:50'),
(85, '2016-08-15 08:06:23', 6, '::1', 'save_addvehicleownership.php', '08:06:23'),
(86, '2016-08-15 08:06:30', 6, '::1', 'save_addvehicleownership.php', '08:06:30'),
(87, '2016-08-15 08:06:38', 6, '::1', 'save_addvehicleownership.php', '08:06:38'),
(88, '2016-08-15 08:06:46', 6, '::1', 'save_addvehicleownership.php', '08:06:46'),
(89, '2016-08-15 08:07:03', 6, '::1', 'save_addvehicleownership.php', '08:07:03'),
(90, '2016-08-15 08:07:31', 6, '::1', 'save_addvehicleownership.php', '08:07:31'),
(91, '2016-08-15 08:10:28', 6, '::1', 'save_menu.php', '08:10:28'),
(92, '2016-08-15 08:10:36', 6, '::1', 'save_pageaccess.php', '08:10:36'),
(93, '2016-08-15 08:24:41', 6, '::1', 'save_addvehicle.php', '08:24:41'),
(94, '2016-08-15 08:49:11', 6, '::1', 'save_addvehicle.php', '08:49:11'),
(95, '2016-08-15 09:23:08', 6, '::1', 'save_menu.php', '09:23:08'),
(96, '2016-08-15 09:23:18', 6, '::1', 'save_pageaccess.php', '09:23:18'),
(97, '2016-08-15 09:44:04', 6, '::1', 'save_addtransporter.php', '09:44:04'),
(98, '2016-08-15 10:24:35', 6, '::1', 'save_addtransporter.php', '10:24:35'),
(99, '2016-08-15 10:26:07', 6, '::1', 'save_addtransporter.php', '10:26:07'),
(100, '2016-08-15 11:32:06', 6, '::1', 'save_menu.php', '11:32:06'),
(101, '2016-08-15 11:32:13', 6, '::1', 'save_pageaccess.php', '11:32:13'),
(102, '2016-08-15 11:37:45', 6, '::1', 'save_addcategory.php', '11:37:45'),
(103, '2016-08-15 11:47:04', 6, '::1', 'save_addcategory.php', '11:47:04'),
(104, '2016-08-15 11:47:10', 6, '::1', 'save_addcategory.php', '11:47:10'),
(105, '2016-08-15 11:54:43', 6, '::1', 'save_menu.php', '11:54:43'),
(106, '2016-08-15 11:54:55', 6, '::1', 'save_pageaccess.php', '11:54:55'),
(107, '2016-08-15 11:57:45', 6, '::1', 'save_addproduct.php', '11:57:45'),
(108, '2016-08-15 11:58:15', 6, '::1', 'save_addproduct.php', '11:58:15'),
(109, '2016-08-15 12:15:58', 6, '::1', 'save_addproduct.php', '12:15:58'),
(110, '2016-08-15 12:16:31', 6, '::1', 'save_addproduct.php', '12:16:31'),
(111, '2016-08-15 01:06:59', 6, '::1', 'save_menu.php', '13:06:59'),
(112, '2016-08-15 01:07:10', 6, '::1', 'save_pageaccess.php', '13:07:10'),
(113, '2016-08-15 01:12:54', 6, '::1', 'save_addcontacttype.php', '13:12:54'),
(114, '2016-08-15 01:13:18', 6, '::1', 'save_addcontacttype.php', '13:13:18'),
(115, '2016-08-15 01:19:27', 6, '::1', 'save_addcontacttype.php', '13:19:27'),
(116, '2016-08-15 01:20:00', 6, '::1', 'save_addcontacttype.php', '13:20:00'),
(117, '2016-08-15 01:20:08', 6, '::1', 'save_addcontacttype.php', '13:20:08'),
(118, '2016-08-15 01:46:00', 6, '::1', 'save_menu.php', '13:46:00'),
(119, '2016-08-15 01:46:08', 6, '::1', 'save_pageaccess.php', '13:46:08'),
(120, '2016-08-15 05:11:33', 6, '::1', 'save_addconsignor.php', '17:11:33'),
(121, '2016-08-15 05:11:33', 6, '::1', 'save_addconsignor.php', '17:11:33'),
(122, '2016-08-15 05:11:33', 6, '::1', 'save_addconsignor.php', '17:11:33'),
(123, '2016-08-15 05:11:33', 6, '::1', 'save_addconsignor.php', '17:11:33'),
(124, '2016-08-15 05:12:28', 6, '::1', 'save_addconsignor.php', '17:12:28'),
(125, '2016-08-15 05:12:28', 6, '::1', 'save_addconsignor.php', '17:12:28'),
(126, '2016-08-15 05:12:28', 6, '::1', 'save_addconsignor.php', '17:12:28'),
(127, '2016-08-15 05:12:28', 6, '::1', 'save_addconsignor.php', '17:12:28'),
(128, '2016-08-15 05:13:55', 6, '::1', 'save_addconsignor.php', '17:13:55'),
(129, '2016-08-15 05:13:55', 6, '::1', 'save_addconsignor.php', '17:13:55'),
(130, '2016-08-15 05:13:55', 6, '::1', 'save_addconsignor.php', '17:13:55'),
(131, '2016-08-15 05:13:55', 6, '::1', 'save_addconsignor.php', '17:13:55'),
(132, '2016-08-15 05:34:25', 6, '::1', 'save_addconsignor.php', '17:34:25'),
(133, '2016-08-15 05:34:25', 6, '::1', 'save_addconsignor.php', '17:34:25'),
(134, '2016-08-15 05:34:25', 6, '::1', 'save_addconsignor.php', '17:34:25'),
(135, '2016-08-15 05:34:25', 6, '::1', 'save_addconsignor.php', '17:34:25'),
(136, '2016-08-15 05:34:35', 6, '::1', 'save_addconsignor.php', '17:34:35'),
(137, '2016-08-15 05:34:35', 6, '::1', 'save_addconsignor.php', '17:34:35'),
(138, '2016-08-15 05:34:35', 6, '::1', 'save_addconsignor.php', '17:34:35'),
(139, '2016-08-15 05:34:35', 6, '::1', 'save_addconsignor.php', '17:34:35'),
(140, '2016-08-15 05:36:42', 6, '::1', 'save_addconsignor.php', '17:36:42'),
(141, '2016-08-15 05:36:42', 6, '::1', 'save_addconsignor.php', '17:36:42'),
(142, '2016-08-15 05:36:42', 6, '::1', 'save_addconsignor.php', '17:36:42'),
(143, '2016-08-15 05:36:42', 6, '::1', 'save_addconsignor.php', '17:36:42'),
(144, '2016-08-16 06:37:32', 6, '::1', 'save_merchant.php', '06:37:32'),
(145, '2016-08-16 07:58:06', 6, '::1', 'save_menu.php', '07:58:06'),
(146, '2016-08-16 07:58:13', 6, '::1', 'save_pageaccess.php', '07:58:13'),
(147, '2016-08-16 08:02:06', 6, '::1', 'save_addarea.php', '08:02:06'),
(148, '2016-08-16 08:09:14', 6, '::1', 'save_addarea.php', '08:09:14'),
(149, '2016-08-16 08:12:13', 6, '::1', 'save_addarea.php', '08:12:13'),
(150, '2016-08-16 08:12:22', 6, '::1', 'save_addarea.php', '08:12:22'),
(151, '2016-08-16 08:17:09', 6, '::1', 'save_menu.php', '08:17:09'),
(152, '2016-08-16 08:17:16', 6, '::1', 'save_pageaccess.php', '08:17:16'),
(153, '2016-08-16 08:47:09', 6, '::1', 'save_addadditionalcharge.php', '08:47:09'),
(154, '2016-08-16 08:53:42', 6, '::1', 'save_addadditionalcharge.php', '08:53:42'),
(155, '2016-08-16 08:54:33', 6, '::1', 'save_addadditionalcharge.php', '08:54:33'),
(156, '2016-08-16 09:11:39', 6, '::1', 'save_menu.php', '09:11:39'),
(157, '2016-08-16 09:11:47', 6, '::1', 'save_pageaccess.php', '09:11:47'),
(158, '2016-08-17 06:46:13', 6, '::1', 'save_addrate.php', '06:46:13'),
(159, '2016-08-17 06:48:04', 6, '::1', 'save_addrate.php', '06:48:04'),
(160, '2016-08-17 07:35:06', 6, '::1', 'save_addrate.php', '07:35:06'),
(161, '2016-08-17 07:35:17', 6, '::1', 'save_addrate.php', '07:35:17'),
(162, '2016-08-17 07:35:28', 6, '::1', 'save_addrate.php', '07:35:28'),
(163, '2016-08-17 08:08:49', 6, '::1', 'save_merchant.php', '08:08:49'),
(164, '2016-08-17 08:20:03', 6, '::1', 'save_addconsignor.php', '08:20:03'),
(165, '2016-08-17 08:20:03', 6, '::1', 'save_addconsignor.php', '08:20:03'),
(166, '2016-08-17 08:20:03', 6, '::1', 'save_addconsignor.php', '08:20:03'),
(167, '2016-08-17 08:20:03', 6, '::1', 'save_addconsignor.php', '08:20:03'),
(168, '2016-08-17 08:24:09', 6, '::1', 'save_consignee.php', '08:24:09'),
(169, '2016-08-17 08:24:09', 6, '::1', 'save_consignee.php', '08:24:09'),
(170, '2016-08-17 08:24:40', 6, '::1', 'save_addarea.php', '08:24:40'),
(171, '2016-08-17 08:25:15', 6, '::1', 'save_addrate.php', '08:25:15'),
(172, '2016-08-17 08:27:14', 6, '::1', 'save_addadditionalcharge.php', '08:27:14'),
(173, '2016-08-17 02:42:32', 6, '::1', 'save_merchant.php', '14:42:32'),
(174, '2016-08-18 12:17:18', 6, '::1', 'save_merchant.php', '12:17:18'),
(175, '2016-08-18 01:05:44', 6, '::1', 'save_consignee.php', '13:05:44'),
(176, '2016-08-18 01:05:44', 6, '::1', 'save_consignee.php', '13:05:44'),
(177, '2016-08-18 01:06:20', 6, '::1', 'save_consignee.php', '13:06:20'),
(178, '2016-08-18 01:06:20', 6, '::1', 'save_consignee.php', '13:06:20'),
(179, '2016-08-18 01:10:08', 6, '::1', 'save_consignee.php', '13:10:08'),
(180, '2016-08-18 01:10:08', 6, '::1', 'save_consignee.php', '13:10:08'),
(181, '2016-08-18 07:46:47', 6, '::1', 'save_addproduct.php', '19:46:47'),
(182, '2016-08-18 07:46:57', 6, '::1', 'save_addproduct.php', '19:46:57'),
(183, '2016-08-18 07:47:04', 6, '::1', 'save_addproduct.php', '19:47:04'),
(184, '2016-08-19 06:49:36', 6, '::1', 'save_addconsignor.php', '06:49:36'),
(185, '2016-08-19 06:49:36', 6, '::1', 'save_addconsignor.php', '06:49:36'),
(186, '2016-08-19 06:49:36', 6, '::1', 'save_addconsignor.php', '06:49:36'),
(187, '2016-08-19 06:49:36', 6, '::1', 'save_addconsignor.php', '06:49:36'),
(188, '2016-08-19 07:52:45', 6, '::1', 'save_consignee.php', '07:52:45'),
(189, '2016-08-19 07:52:45', 6, '::1', 'save_consignee.php', '07:52:45'),
(190, '2016-08-19 08:08:25', 6, '::1', 'save_consignee.php', '08:08:25'),
(191, '2016-08-19 08:08:25', 6, '::1', 'save_consignee.php', '08:08:25'),
(192, '2016-08-19 08:12:15', 6, '::1', 'save_consignee.php', '08:12:15'),
(193, '2016-08-19 08:12:15', 6, '::1', 'save_consignee.php', '08:12:15'),
(194, '2016-08-19 08:13:01', 6, '::1', 'save_consignee.php', '08:13:01'),
(195, '2016-08-19 08:13:01', 6, '::1', 'save_consignee.php', '08:13:01'),
(196, '2016-08-19 08:13:48', 6, '::1', 'save_consignee.php', '08:13:48'),
(197, '2016-08-19 08:13:48', 6, '::1', 'save_consignee.php', '08:13:48'),
(198, '2016-08-19 08:14:53', 6, '::1', 'save_consignee.php', '08:14:53'),
(199, '2016-08-19 08:14:53', 6, '::1', 'save_consignee.php', '08:14:53'),
(200, '2016-08-19 08:15:48', 6, '::1', 'save_consignee.php', '08:15:48'),
(201, '2016-08-19 08:15:48', 6, '::1', 'save_consignee.php', '08:15:48'),
(202, '2016-08-19 08:18:14', 6, '::1', 'save_consignee.php', '08:18:14'),
(203, '2016-08-19 08:18:14', 6, '::1', 'save_consignee.php', '08:18:14'),
(204, '2016-08-19 08:18:39', 6, '::1', 'save_consignee.php', '08:18:39'),
(205, '2016-08-19 08:18:39', 6, '::1', 'save_consignee.php', '08:18:39'),
(206, '2016-08-19 08:52:29', 6, '::1', 'save_menu.php', '08:52:29'),
(207, '2016-08-19 08:52:43', 6, '::1', 'save_pageaccess.php', '08:52:43'),
(208, '2016-08-19 10:25:39', 6, '::1', 'save_consignee.php', '10:25:39'),
(209, '2016-08-19 10:25:39', 6, '::1', 'save_consignee.php', '10:25:39'),
(210, '2016-08-19 10:25:46', 6, '::1', 'save_consignee.php', '10:25:46'),
(211, '2016-08-19 10:25:46', 6, '::1', 'save_consignee.php', '10:25:46'),
(212, '2016-08-19 01:02:39', 6, '::1', 'save_addrate.php', '13:02:39'),
(213, '2016-08-19 01:03:07', 6, '::1', 'save_addrate.php', '13:03:07'),
(214, '2016-08-19 01:03:56', 6, '::1', 'save_addrate.php', '13:03:56'),
(215, '2016-08-19 01:27:57', 6, '::1', 'save_addrate.php', '13:27:57'),
(216, '2016-08-19 02:53:14', 6, '::1', 'save_addadditionalcharge.php', '14:53:14'),
(217, '2016-08-19 03:46:41', 6, '::1', 'save_addadditionalcharge.php', '15:46:41'),
(218, '2016-08-19 03:47:04', 6, '::1', 'save_addadditionalcharge.php', '15:47:04'),
(219, '2016-08-20 07:04:49', 6, '::1', 'save_menu.php', '07:04:49'),
(220, '2016-08-20 07:05:01', 6, '::1', 'save_pageaccess.php', '07:05:01'),
(221, '2016-08-20 12:02:22', 6, '::1', 'save_addadditionalcharge.php', '12:02:22'),
(222, '2016-08-20 12:14:16', 6, '::1', 'save_lrentry.php', '12:14:16'),
(223, '2016-08-20 12:14:46', 6, '::1', 'save_lrentry.php', '12:14:46'),
(224, '2016-08-20 12:17:55', 6, '::1', 'save_lrentry.php', '12:17:55'),
(225, '2016-08-20 12:18:22', 6, '::1', 'save_lrentry.php', '12:18:22'),
(226, '2016-08-20 12:18:48', 6, '::1', 'save_lrentry.php', '12:18:48'),
(227, '2016-08-20 12:25:07', 6, '::1', 'save_lrentry.php', '12:25:07'),
(228, '2016-08-20 12:54:18', 6, '::1', 'save_lrentry.php', '12:54:18'),
(229, '2016-08-20 12:54:19', 6, '::1', 'save_lrentry.php', '12:54:19'),
(230, '2016-08-20 12:54:19', 6, '::1', 'save_lrentry.php', '12:54:19'),
(231, '2016-08-20 12:55:35', 6, '::1', 'save_lrentry.php', '12:55:35'),
(232, '2016-08-20 12:56:15', 6, '::1', 'save_lrentry.php', '12:56:15'),
(233, '2016-08-20 12:56:15', 6, '::1', 'save_lrentry.php', '12:56:15'),
(234, '2016-08-20 12:56:28', 6, '::1', 'save_lrentry.php', '12:56:28'),
(235, '2016-08-20 12:57:12', 6, '::1', 'save_lrentry.php', '12:57:12');

-- --------------------------------------------------------

--
-- Table structure for table `merchant_master`
--

CREATE TABLE `merchant_master` (
  `mmid` smallint(6) NOT NULL,
  `CreationDate` datetime NOT NULL,
  `ModificationDate` datetime DEFAULT NULL,
  `Creator` int(11) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `Company` varchar(100) NOT NULL,
  `Address` varchar(150) NOT NULL,
  `amid` int(11) NOT NULL,
  `Pincode` smallint(6) NOT NULL,
  `City` varchar(25) NOT NULL,
  `Telephone` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Website` varchar(100) NOT NULL,
  `Pancard` varchar(15) NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `merchant_master`
--

INSERT INTO `merchant_master` (`mmid`, `CreationDate`, `ModificationDate`, `Creator`, `ip`, `Company`, `Address`, `amid`, `Pincode`, `City`, `Telephone`, `Email`, `Website`, `Pancard`, `Active`) VALUES
(3, '2016-08-17 02:42:32', '2016-08-18 12:17:18', 6, '::1', 'Shree Vighnahar Logistics', 'Shed No 1 Gala No 1 Arihant Complex Kopar Bus Stop Purna Village Bhivandi', 3, 32767, 'Thane', '9272217794,9272217795', 'chetannalawade@tttsvl.com', 'http://www.tttsvl.com', 'PANCARD', 1);

-- --------------------------------------------------------

--
-- Table structure for table `outward`
--

CREATE TABLE `outward` (
  `oid` int(6) NOT NULL,
  `CreationDate` datetime NOT NULL,
  `ModificationDate` datetime DEFAULT NULL,
  `Creator` int(11) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `TransitDate` date NOT NULL,
  `vmid` int(11) NOT NULL,
  `tmid` int(11) NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `outwardlr`
--

CREATE TABLE `outwardlr` (
  `olrid` int(6) NOT NULL,
  `CreationDate` datetime NOT NULL,
  `ModificationDate` datetime DEFAULT NULL,
  `Creator` int(11) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `oid` int(11) NOT NULL,
  `iid` int(11) NOT NULL,
  `DeliveryStatus` tinyint(11) NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pageaccess_member`
--

CREATE TABLE `pageaccess_member` (
  `id` int(11) NOT NULL,
  `CreationDate` datetime NOT NULL,
  `ModificationDate` datetime NOT NULL,
  `Creator` int(11) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `menusub_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `Active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pageaccess_member`
--

INSERT INTO `pageaccess_member` (`id`, `CreationDate`, `ModificationDate`, `Creator`, `ip`, `menusub_id`, `designation_id`, `Active`) VALUES
(2, '2016-08-14 06:49:17', '2016-08-14 07:49:10', 6, '::1', 1, 8, 1),
(3, '2016-08-14 07:48:54', '0000-00-00 00:00:00', 6, '::1', 4, 8, 1),
(4, '2016-08-14 07:50:01', '0000-00-00 00:00:00', 6, '::1', 3, 8, 1),
(5, '2016-08-14 11:00:48', '0000-00-00 00:00:00', 6, '::1', 5, 8, 1),
(6, '2016-08-14 11:05:00', '0000-00-00 00:00:00', 6, '::1', 3, 8, 1),
(7, '2016-08-14 12:23:10', '0000-00-00 00:00:00', 6, '::1', 6, 8, 1),
(8, '2016-08-15 07:46:55', '0000-00-00 00:00:00', 6, '::1', 7, 8, 1),
(9, '2016-08-15 08:10:36', '0000-00-00 00:00:00', 6, '::1', 8, 8, 1),
(10, '2016-08-15 09:23:18', '0000-00-00 00:00:00', 6, '::1', 9, 8, 1),
(11, '2016-08-15 11:32:13', '0000-00-00 00:00:00', 6, '::1', 10, 8, 1),
(12, '2016-08-15 11:54:55', '0000-00-00 00:00:00', 6, '::1', 11, 8, 1),
(13, '2016-08-15 01:07:10', '0000-00-00 00:00:00', 6, '::1', 12, 8, 1),
(14, '2016-08-15 01:46:08', '0000-00-00 00:00:00', 6, '::1', 13, 8, 1),
(15, '2016-08-16 07:58:13', '0000-00-00 00:00:00', 6, '::1', 14, 8, 1),
(16, '2016-08-16 08:17:16', '0000-00-00 00:00:00', 6, '::1', 15, 8, 1),
(17, '2016-08-16 09:11:47', '0000-00-00 00:00:00', 6, '::1', 16, 8, 1),
(18, '2016-08-19 08:52:43', '0000-00-00 00:00:00', 6, '::1', 17, 8, 1),
(19, '2016-08-20 07:05:01', '0000-00-00 00:00:00', 6, '::1', 18, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_master`
--

CREATE TABLE `product_master` (
  `pmid` int(6) NOT NULL,
  `CreationDate` datetime NOT NULL,
  `ModificationDate` datetime DEFAULT NULL,
  `Creator` int(11) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `cmid` int(11) NOT NULL,
  `ProductName` varchar(50) NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_master`
--

INSERT INTO `product_master` (`pmid`, `CreationDate`, `ModificationDate`, `Creator`, `ip`, `cmid`, `ProductName`, `Active`) VALUES
(1, '2016-08-15 11:58:15', '2016-08-15 12:16:31', 6, '::1', 1, 'Medicine', 1),
(2, '2016-08-18 07:46:47', NULL, 6, '::1', 1, 'Chocolate', 1),
(3, '2016-08-18 07:46:57', NULL, 6, '::1', 1, 'Plastics', 1),
(4, '2016-08-18 07:47:04', NULL, 6, '::1', 1, 'Rubber', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rate_master`
--

CREATE TABLE `rate_master` (
  `rmid` int(6) NOT NULL,
  `CreationDate` datetime NOT NULL,
  `ModificationDate` datetime DEFAULT NULL,
  `Creator` int(11) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `caid` int(11) NOT NULL COMMENT 'Consignor Address ID',
  `cnid` int(11) NOT NULL COMMENT 'Consignee Master ID',
  `pmid` int(11) NOT NULL COMMENT 'Product Master ID',
  `MinimumRate` double(10,2) NOT NULL,
  `CartoonRate` double(10,2) NOT NULL,
  `ItemRate` double(10,2) NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rate_master`
--

INSERT INTO `rate_master` (`rmid`, `CreationDate`, `ModificationDate`, `Creator`, `ip`, `caid`, `cnid`, `pmid`, `MinimumRate`, `CartoonRate`, `ItemRate`, `Active`) VALUES
(3, '2016-08-19 01:03:07', '2016-08-19 01:27:57', 6, '::1', 21, 3, 2, 101.00, 214.00, 532.00, 1),
(4, '2016-08-19 01:03:56', NULL, 6, '::1', 21, 6, 1, 125.00, 253.00, 563.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transporter_master`
--

CREATE TABLE `transporter_master` (
  `tmid` int(6) NOT NULL,
  `CreationDate` datetime NOT NULL,
  `ModificationDate` datetime DEFAULT NULL,
  `Creator` int(11) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `vmid` int(11) NOT NULL,
  `TransporterName` varchar(50) NOT NULL,
  `MobileNumber` varchar(50) NOT NULL,
  `LicenceNumber` varchar(25) NOT NULL,
  `Remark` varchar(100) NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transporter_master`
--

INSERT INTO `transporter_master` (`tmid`, `CreationDate`, `ModificationDate`, `Creator`, `ip`, `vmid`, `TransporterName`, `MobileNumber`, `LicenceNumber`, `Remark`, `Active`) VALUES
(1, '2016-08-15 09:44:04', '2016-08-15 10:26:07', 6, '::1', 1, 's', 's', 's', 's', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicleownership_master`
--

CREATE TABLE `vehicleownership_master` (
  `void` int(6) NOT NULL,
  `CreationDate` datetime NOT NULL,
  `ModificationDate` datetime DEFAULT NULL,
  `Creator` int(11) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `Ownership` varchar(10) NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicleownership_master`
--

INSERT INTO `vehicleownership_master` (`void`, `CreationDate`, `ModificationDate`, `Creator`, `ip`, `Ownership`, `Active`) VALUES
(1, '2016-08-15 07:53:50', '2016-08-15 08:07:31', 6, '::1', 'Owner', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_master`
--

CREATE TABLE `vehicle_master` (
  `vmid` int(6) NOT NULL,
  `CreationDate` datetime NOT NULL,
  `ModificationDate` datetime DEFAULT NULL,
  `Creator` int(11) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `void` tinyint(4) NOT NULL,
  `VehicleName` varchar(50) NOT NULL,
  `VehicleNumber` varchar(15) NOT NULL,
  `RCBookNumber` varchar(25) NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicle_master`
--

INSERT INTO `vehicle_master` (`vmid`, `CreationDate`, `ModificationDate`, `Creator`, `ip`, `void`, `VehicleName`, `VehicleNumber`, `RCBookNumber`, `Active`) VALUES
(1, '2016-08-15 08:24:41', '2016-08-15 08:49:11', 6, '::1', 1, 'Tata Truck', 'MH-04 AH-5468', 'RCBook', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `1menusub`
--
ALTER TABLE `1menusub`
  ADD PRIMARY KEY (`menusub_id`);

--
-- Indexes for table `additionalcharge_master`
--
ALTER TABLE `additionalcharge_master`
  ADD PRIMARY KEY (`acmid`);

--
-- Indexes for table `area_master`
--
ALTER TABLE `area_master`
  ADD PRIMARY KEY (`amid`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `billlr`
--
ALTER TABLE `billlr`
  ADD PRIMARY KEY (`blrid`);

--
-- Indexes for table `category_master`
--
ALTER TABLE `category_master`
  ADD PRIMARY KEY (`cmid`);

--
-- Indexes for table `consigneeaddress_master`
--
ALTER TABLE `consigneeaddress_master`
  ADD PRIMARY KEY (`cnaid`),
  ADD UNIQUE KEY `Designation` (`Address`);

--
-- Indexes for table `consignee_master`
--
ALTER TABLE `consignee_master`
  ADD PRIMARY KEY (`cnid`),
  ADD UNIQUE KEY `Designation` (`ConsigneeName`);

--
-- Indexes for table `consignoraddress_master`
--
ALTER TABLE `consignoraddress_master`
  ADD PRIMARY KEY (`caid`);

--
-- Indexes for table `consignorcontact_master`
--
ALTER TABLE `consignorcontact_master`
  ADD PRIMARY KEY (`ccid`);

--
-- Indexes for table `consignorproduct_master`
--
ALTER TABLE `consignorproduct_master`
  ADD PRIMARY KEY (`cpid`);

--
-- Indexes for table `consignor_master`
--
ALTER TABLE `consignor_master`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `contacttype_master`
--
ALTER TABLE `contacttype_master`
  ADD PRIMARY KEY (`ctmid`),
  ADD UNIQUE KEY `Designation` (`ContactName`);

--
-- Indexes for table `designation_master`
--
ALTER TABLE `designation_master`
  ADD PRIMARY KEY (`designationid`);

--
-- Indexes for table `financialyear_master`
--
ALTER TABLE `financialyear_master`
  ADD PRIMARY KEY (`fyid`);

--
-- Indexes for table `inward`
--
ALTER TABLE `inward`
  ADD PRIMARY KEY (`iid`);

--
-- Indexes for table `inwardcharge`
--
ALTER TABLE `inwardcharge`
  ADD PRIMARY KEY (`icid`);

--
-- Indexes for table `login_master`
--
ALTER TABLE `login_master`
  ADD PRIMARY KEY (`loginid`),
  ADD UNIQUE KEY `emailid` (`UserID`);

--
-- Indexes for table `log_pageaccess`
--
ALTER TABLE `log_pageaccess`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_pagenamelist`
--
ALTER TABLE `log_pagenamelist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_tableend`
--
ALTER TABLE `log_tableend`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_tablelist`
--
ALTER TABLE `log_tablelist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_tablestart`
--
ALTER TABLE `log_tablestart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merchant_master`
--
ALTER TABLE `merchant_master`
  ADD PRIMARY KEY (`mmid`);

--
-- Indexes for table `outward`
--
ALTER TABLE `outward`
  ADD PRIMARY KEY (`oid`);

--
-- Indexes for table `outwardlr`
--
ALTER TABLE `outwardlr`
  ADD PRIMARY KEY (`olrid`);

--
-- Indexes for table `pageaccess_member`
--
ALTER TABLE `pageaccess_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_master`
--
ALTER TABLE `product_master`
  ADD PRIMARY KEY (`pmid`);

--
-- Indexes for table `rate_master`
--
ALTER TABLE `rate_master`
  ADD PRIMARY KEY (`rmid`);

--
-- Indexes for table `transporter_master`
--
ALTER TABLE `transporter_master`
  ADD PRIMARY KEY (`tmid`);

--
-- Indexes for table `vehicleownership_master`
--
ALTER TABLE `vehicleownership_master`
  ADD PRIMARY KEY (`void`);

--
-- Indexes for table `vehicle_master`
--
ALTER TABLE `vehicle_master`
  ADD PRIMARY KEY (`vmid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `1menusub`
--
ALTER TABLE `1menusub`
  MODIFY `menusub_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `additionalcharge_master`
--
ALTER TABLE `additionalcharge_master`
  MODIFY `acmid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `area_master`
--
ALTER TABLE `area_master`
  MODIFY `amid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `bid` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `billlr`
--
ALTER TABLE `billlr`
  MODIFY `blrid` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category_master`
--
ALTER TABLE `category_master`
  MODIFY `cmid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `consigneeaddress_master`
--
ALTER TABLE `consigneeaddress_master`
  MODIFY `cnaid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `consignee_master`
--
ALTER TABLE `consignee_master`
  MODIFY `cnid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `consignoraddress_master`
--
ALTER TABLE `consignoraddress_master`
  MODIFY `caid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `consignorcontact_master`
--
ALTER TABLE `consignorcontact_master`
  MODIFY `ccid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `consignorproduct_master`
--
ALTER TABLE `consignorproduct_master`
  MODIFY `cpid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `consignor_master`
--
ALTER TABLE `consignor_master`
  MODIFY `cid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `contacttype_master`
--
ALTER TABLE `contacttype_master`
  MODIFY `ctmid` tinyint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `designation_master`
--
ALTER TABLE `designation_master`
  MODIFY `designationid` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `financialyear_master`
--
ALTER TABLE `financialyear_master`
  MODIFY `fyid` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `inward`
--
ALTER TABLE `inward`
  MODIFY `iid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `inwardcharge`
--
ALTER TABLE `inwardcharge`
  MODIFY `icid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `login_master`
--
ALTER TABLE `login_master`
  MODIFY `loginid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `log_pageaccess`
--
ALTER TABLE `log_pageaccess`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1114;
--
-- AUTO_INCREMENT for table `log_pagenamelist`
--
ALTER TABLE `log_pagenamelist`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `log_tableend`
--
ALTER TABLE `log_tableend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;
--
-- AUTO_INCREMENT for table `log_tablelist`
--
ALTER TABLE `log_tablelist`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `log_tablestart`
--
ALTER TABLE `log_tablestart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;
--
-- AUTO_INCREMENT for table `merchant_master`
--
ALTER TABLE `merchant_master`
  MODIFY `mmid` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `outward`
--
ALTER TABLE `outward`
  MODIFY `oid` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `outwardlr`
--
ALTER TABLE `outwardlr`
  MODIFY `olrid` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pageaccess_member`
--
ALTER TABLE `pageaccess_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `product_master`
--
ALTER TABLE `product_master`
  MODIFY `pmid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `rate_master`
--
ALTER TABLE `rate_master`
  MODIFY `rmid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `transporter_master`
--
ALTER TABLE `transporter_master`
  MODIFY `tmid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `vehicleownership_master`
--
ALTER TABLE `vehicleownership_master`
  MODIFY `void` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `vehicle_master`
--
ALTER TABLE `vehicle_master`
  MODIFY `vmid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
