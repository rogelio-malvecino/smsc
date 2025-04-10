-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.10


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema xymasterlist
--

CREATE DATABASE IF NOT EXISTS xymasterlist;
USE xymasterlist;

--
-- Definition of procedure `spEmployeeAjaxSearch`
--

DROP PROCEDURE IF EXISTS `spEmployeeAjaxSearch`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spEmployeeAjaxSearch`(IN empCode VARCHAR(15),
                                                        IN empFirstName VARCHAR(20))
BEGIN
     Select * from employeeinformation where EmpNumber like concat('%',empCode,'%') and EmpFirstName like concat('%',empFirstName,'%') and status=1;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spEmployeeDelete`
--

DROP PROCEDURE IF EXISTS `spEmployeeDelete`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spEmployeeDelete`(in mEmpNumber varchar(15))
BEGIN
update employeeinformation set Status = 5 where EmpNumber = mEmpNumber;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spemployeedetailQuery`
--

DROP PROCEDURE IF EXISTS `spemployeedetailQuery`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spemployeedetailQuery`(IN empNumber varchar(15))
BEGIN

set @MyNumber = empNumber;
set @sql = 'SELECT *  from employeeinformation_detail where EmpNumber = ?';

     PREPARE stmt FROM @sql;
     EXECUTE stmt USING @MyNumber;
     DEALLOCATE PREPARE stmt;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spemployeequeryPhoto`
--

DROP PROCEDURE IF EXISTS `spemployeequeryPhoto`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spemployeequeryPhoto`(IN empNumber varchar(50), imgDesc varchar(100))
BEGIN
     select * from employeeinformation_detail where EmpNumber = empNumber and imageDescription = imgDesc;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spEmployeeSave`
--

DROP PROCEDURE IF EXISTS `spEmployeeSave`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spEmployeeSave`(in mEmpNumber varchar(15),
                                                                in mFirstName varchar(20),
                                                                in mMiddleName varchar(20),
                                                                in mLastName varchar(20),
                                                                in mEmail varchar (20),
                                                                in mCPnum varchar (20),
                                                                in mMBnumber varchar (20),
                                                                in mGender varchar (20),
                                                                in mStatus varchar (20),
                                                                in mReligion varchar (20),
                                                                in mMonth varchar (20),
                                                                in mDay varchar (20),
                                                                in mYear varchar (20),
                                                                in mHeight varchar (20),
                                                                in mWeight varchar (20),
                                                                in mHomeAddress varchar (200),
                                                                in mCollege varchar (200),
                                                                in mYRC varchar (20),
                                                                in mHigh varchar (200),
                                                                in mYRH varchar (20),
                                                                in mELEM varchar (200),
                                                                in mYRE varchar (20))
BEGIN

insert into employeeinformation (EmpNumber,
                                EmpFirstName,
                                EmpMiddleName,
                                EmpLastName,
                                EmpEmail,
                                EmpCElpnumber,
                                EmpMobileNumber,
                                EmpGender,
                                EmpStatus,
                                EmpReligion,
                                EmpMonth,
                                EmpDay,
                                EmpYear,
                                EmpHeight,
                                EmpWeight,
                                EmpHomeAddress,
                                EmpCollege,
                                EmpCYAttended
                                ,EmpHigh,
                                EmpYRHattended,
                                EmpElem,
                                EmpELEYRattended,
                                EmpBirthDay)
                                value
                                (mEmpNumber,
                                mFirstName,
                                mMiddleName,
                                mLastName,
                                mEmail,
                                mCPnum,
                                mMBnumber,
                                mGender,
                                mStatus,
                                mReligion,
                                mMonth,
                                mDay,
                                mYear,
                                mHeight,
                                mWeight,
                                mHomeAddress,
                                mCollege,
                                mYRC,
                                mHigh,
                                mYRH,
                                mELEM,
                                mYRE,'1/1/2009') ;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spemployeesavePhoto`
--

DROP PROCEDURE IF EXISTS `spemployeesavePhoto`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spemployeesavePhoto`(IN empNumber varchar(50),
                                                                    IN imgDesc varchar(100),
                                                                    IN img longblob)
BEGIN
       insert into employeeinformation_detail (EmpNumber, imageDescription,image) values (empNumber,imgDesc,img);
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spEmployeeSearch`
--

DROP PROCEDURE IF EXISTS `spEmployeeSearch`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spEmployeeSearch`()
BEGIN
     select * from   employeeinformation where Status <> 5;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spemployeeSearchAjax`
--

DROP PROCEDURE IF EXISTS `spemployeeSearchAjax`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spemployeeSearchAjax`(IN fname VARCHAR(20),
                                                                    IN lname VARCHAR(20))
BEGIN

    SET @fname := CONCAT('%',(fname),'%');

    SET @lname := CONCAT('%',(lname),'%');

    SELECT EmpNumber,EmpFirstName,EmpLastName FROM employeeinformation  WHERE EmpFirstName LIKE @fname and EmpLastName like @lname and Status='1';


END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spEmployeeSelect`
--

DROP PROCEDURE IF EXISTS `spEmployeeSelect`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spEmployeeSelect`(in mEmpNumber varchar(15))
BEGIN
 select * from employeeinformation where EmpNumber = mEmpNumber;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spEmpMenuUsersSelect`
--

DROP PROCEDURE IF EXISTS `spEmpMenuUsersSelect`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spEmpMenuUsersSelect`(in mEmpNumber varchar(15))
BEGIN
  select emp.EmpNumber, emp.EmpFirstName,emp.EmpLastName from usersprofile as usr, employeeinformation as emp  
  WHERE usr.EmpNumber = mEmpNumber and usr.EmpNumber = emp.EmpNumber;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spEmpUserFilter`
--

DROP PROCEDURE IF EXISTS `spEmpUserFilter`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spEmpUserFilter`()
BEGIN
      SELECT * FROM employeeinformation where Status <> 5 and EmpNumber not in (select EmpNumber from usersprofile);
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spEmpUserSaving`
--

DROP PROCEDURE IF EXISTS `spEmpUserSaving`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spEmpUserSaving`(in mEmpNumber varchar(15), in mUserName varchar(20), IN mPassword varchar(20))
BEGIN


insert into usersprofile (EmpNumber,EmpUserName,EmpPassword)
value (mEmpNumber,trim(mUserName),trim(mPassword)) ;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spEmpUsersSearch`
--

DROP PROCEDURE IF EXISTS `spEmpUsersSearch`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spEmpUsersSearch`()
BEGIN
  select emp.EmpNumber, emp.EmpFirstName,emp.EmpLastName from usersprofile as usr, employeeinformation as emp  
      WHERE usr.EmpNumber = emp.EmpNumber and emp.Status <>5;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spEmpUsersSelect`
--

DROP PROCEDURE IF EXISTS `spEmpUsersSelect`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spEmpUsersSelect`(in mEmpNumber varchar(15))
BEGIN
 select * from employeeinformation where EmpNumber = mEmpNumber;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spEmpUserUpdate`
--

DROP PROCEDURE IF EXISTS `spEmpUserUpdate`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spEmpUserUpdate`(in mEmpNumber varchar(15), in mUserName varchar(20), IN mPassword varchar(20))
BEGIN


update usersprofile SET EmpUserName=trim(mUserName) ,EmpPassword = trim(mPassword) where EmpNumber = mEmpNumber;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spFoo`
--

DROP PROCEDURE IF EXISTS `spFoo`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spFoo`()
BEGIN
SELECT 'Foo' FROM DUAL;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spmainmenuQuery`
--

DROP PROCEDURE IF EXISTS `spmainmenuQuery`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spmainmenuQuery`(in menu_Name VARCHAR(100))
BEGIN

set @MyName = menu_Name;
set @sql = 'SELECT *  from mainmenu where MenuName = ?';

     PREPARE stmt FROM @sql;
     EXECUTE stmt USING @MyName;
     DEALLOCATE PREPARE stmt;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spmainmenuQuery1`
--

DROP PROCEDURE IF EXISTS `spmainmenuQuery1`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spmainmenuQuery1`(in menu_Code VARCHAR(100))
BEGIN

set @MyCode = menu_Code;
set @sql = 'SELECT *  from mainmenu where MenuCode = ?';

     PREPARE stmt FROM @sql;
     EXECUTE stmt USING @MyCode;
     DEALLOCATE PREPARE stmt;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spMainMenuSaving`
--

DROP PROCEDURE IF EXISTS `spMainMenuSaving`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spMainMenuSaving`(IN mMenuCode VARCHAR(50), IN mMenuName VARCHAR(100), IN mMenuOrder INTEGER(11), IN Author VARCHAR(15),Stamp datetime)
BEGIN

	 insert into mainmenu (MenuCode,
                                 MenuName,
                                 MenuOrder,
                                 Author,
                                 Stamp)
                                 values
                                 (mMenuCode,
                                 mMenuName,
                                 mMenuOrder,
                                 Author,
                                 now());
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spMainMenuSearch`
--

DROP PROCEDURE IF EXISTS `spMainMenuSearch`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spMainMenuSearch`(in mMenuCode varchar(50), in mMenuName varchar(100))
BEGIN
 
   select * from mainmenu where menucode like  concat(mMenucode,'%') and
                                menuname like concat(mMenuName,'%');

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spMainMenuSearchAjax`
--

DROP PROCEDURE IF EXISTS `spMainMenuSearchAjax`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spMainMenuSearchAjax`(IN menuCode VARCHAR(20),
                                                                    IN menuName VARCHAR(100))
BEGIN

    SET @menuCode := CONCAT('%',(menuCode),'%');

    SET @menuName := CONCAT('%',(menuName),'%');

   SELECT * FROM mainmenu where MenuCode like @menuCode and MenuName like @menuName;


END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spmainmenuSearchCode`
--

DROP PROCEDURE IF EXISTS `spmainmenuSearchCode`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spmainmenuSearchCode`(IN menuCode varchar(40))
BEGIN
   SELECT * from mainmenu where MenuCode like concat('%',menuCode,'%');
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spmainmenuSearchName`
--

DROP PROCEDURE IF EXISTS `spmainmenuSearchName`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spmainmenuSearchName`(IN menuName varchar(40))
BEGIN
   SELECT * from mainmenu where MenuName like concat('%',menuName,'%');
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spmainmenuSelect`
--

DROP PROCEDURE IF EXISTS `spmainmenuSelect`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spmainmenuSelect`()
BEGIN
       select * from mainmenu;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spmainmenuUpdate`
--

DROP PROCEDURE IF EXISTS `spmainmenuUpdate`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spmainmenuUpdate`(IN Menu_Code varchar(10),

                                        IN Menu_Name VARCHAR(100),
                                        IN Author varchar(50),
                                        IN Stamp Datetime)
BEGIN

          UPDATE mainmenu

          SET MenuCode =Menu_Code,
          MenuName = Menu_Name,
          Author=Author,
          Stamp=now()


          where MenuCode = Menu_Code;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spMenuAccess`
--

DROP PROCEDURE IF EXISTS `spMenuAccess`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spMenuAccess`(in mEmpNumber varchar(15))
BEGIN
 
  
select distinct a.MenuCode, b.MenuName from mainmenuaccess as a, mainmenu as b 
where a.EmpNumber = mEmpNumber and a.MenuCode=b.MenuCode order by b.MenuOrder;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spMenus`
--

DROP PROCEDURE IF EXISTS `spMenus`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spMenus`()
BEGIN
 select m.Menucode,m.MenuName,s.SubMenu,s.SubMenuName from mainmenu as m, submenu as s
 where m.MenuCode = s.MenuCode order by m.MenuOrder;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spSearchMenuLocation`
--

DROP PROCEDURE IF EXISTS `spSearchMenuLocation`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spSearchMenuLocation`(IN mSubMenu varchar(20))
BEGIN
 select main.MenuName, sub.SubMenuName from submenu as sub ,mainmenu as main WHERE
 sub.SubMenu = mSubMenu and sub.MenuCode = main.MenuCode;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spSigningIn`
--

DROP PROCEDURE IF EXISTS `spSigningIn`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spSigningIn`(in mUserName varchar(20), IN mUserPassword varchar(20))
BEGIN
 Select CONCAT(empinfo.EmpFirstName,' ',empinfo.EmpLastName) as EmployeeName, users.EmpNumber,users.EmpUserName,users.EmpPassword  from usersprofile as users left join employeeinformation as empinfo 
 on users.EmpNumber = empinfo.EmpNumber
 where BINARY users.EmpUserName = mUserName and BINARY users.EmpPassword = mUserPassword;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spSubMenuAccess`
--

DROP PROCEDURE IF EXISTS `spSubMenuAccess`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spSubMenuAccess`(IN mEmpNumber VARCHAR(15), IN mMenuCode VARCHAR(40))
BEGIN


  

  select submnu.SubMenu,submnu.SubMenuName, submnu.Pages, subaccess.EmpNumber,subaccess.MenuCode,subaccess.SubMenuCode from submenuaccess  as subaccess
  left join submenu as submnu on submnu.SubMenu = subaccess.SubMenuCode
  where subaccess.EmpNumber = mEmpNumber
  and subaccess.MenuCode = mMenuCode order by submnu.SubMenuOrder;  
 
 
 
  


END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spsubmenuDelete`
--

DROP PROCEDURE IF EXISTS `spsubmenuDelete`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spsubmenuDelete`(in subMenu_Code varchar(10))
BEGIN

set @MyCode= subMenu_Code;
set @sql = 'DELETE from submenu where SubMenu = ? ';

     PREPARE stmt FROM @sql;
     EXECUTE stmt USING @MyCode;
     DEALLOCATE PREPARE stmt;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spsubmenuQuery`
--

DROP PROCEDURE IF EXISTS `spsubmenuQuery`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spsubmenuQuery`(in submenu_Name VARCHAR(100))
BEGIN

set @MyName = submenu_Name;
set @sql = 'SELECT *  from submenu where SubMenuName = ?';

     PREPARE stmt FROM @sql;
     EXECUTE stmt USING @MyName;
     DEALLOCATE PREPARE stmt;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spsubmenuQuery1`
--

DROP PROCEDURE IF EXISTS `spsubmenuQuery1`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spsubmenuQuery1`(in submenu_Code VARCHAR(100))
BEGIN

set @MyCode = submenu_Code;
set @sql = 'SELECT *  from submenu where SubMenu = ?';

     PREPARE stmt FROM @sql;
     EXECUTE stmt USING @MyCOde;
     DEALLOCATE PREPARE stmt;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spsubmenuSaving`
--

DROP PROCEDURE IF EXISTS `spsubmenuSaving`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spsubmenuSaving`(IN mMenuCode varchar(100),
                                                 In mSubMenuCode varchar(100),
                                                 IN mSubMenuName varchar(100),
                                                 IN mSubMenuPage varchar(100),
                                                 IN SubOrder int(11)
                                                 )
BEGIN
        insert into submenu (MenuCode,
                            SubMenu,
                            SubMenuName,
                            Pages,
                            SubMenuOrder)
                            values
                            (
                            mMenuCode,
                            mSubMenuCode,
                            mSubMenuName,
                            mSubMenuPage,
                            SubOrder

                            ) ;


END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spSubMenuSearch`
--

DROP PROCEDURE IF EXISTS `spSubMenuSearch`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spSubMenuSearch`(iN mMenuCode varchar(20))
BEGIN
 select * from submenu where MenuCode= mMenuCode;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spsubmenuSearchAjax`
--

DROP PROCEDURE IF EXISTS `spsubmenuSearchAjax`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spsubmenuSearchAjax`(IN subCode VARCHAR(20),
                                                                    IN subName VARCHAR(100))
BEGIN

    SET @subCode := CONCAT('%',(subCode),'%');

    SET @subName := CONCAT('%',(subName),'%');

    SELECT * FROM submenu WHERE Submenu LIKE @subCode and SubMenuName like @subName;


END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spsubmenuSelect`
--

DROP PROCEDURE IF EXISTS `spsubmenuSelect`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spsubmenuSelect`()
BEGIN
    SELECT * FROM submenu;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spsubmenuUpdate`
--

DROP PROCEDURE IF EXISTS `spsubmenuUpdate`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spsubmenuUpdate`()
BEGIN
  
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spSubMenuUsersSearch`
--

DROP PROCEDURE IF EXISTS `spSubMenuUsersSearch`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spSubMenuUsersSearch`(in mEmpNumber vaRCHAR(15))
BEGIN
  select emp.EmpNumber, emp.EmpFirstName,emp.EmpLastName,smenu.SubMenu,smenu.SubMenuName
  from usersprofile as usr, employeeinformation as emp, mainmenuaccess as menuaccess, submenu as smenu
  WHERE usr.EmpNumber = mEmpNumber and usr.EmpNumber = emp.EmpNumber and menuaccess.MenuCode = smenu.MenuCode
  and menuaccess.EmpNumber = mEmpNumber;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spsupplierDelete`
--

DROP PROCEDURE IF EXISTS `spsupplierDelete`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spsupplierDelete`(in Supplier_Code varchar(20))
BEGIN

set @MyGroup = Supplier_Code;
set @sql = 'DELETE from suppliers_record  where SupplierCode = ?';

     PREPARE stmt FROM @sql;
     EXECUTE stmt USING @MyGroup;
     DEALLOCATE PREPARE stmt;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spsupplierQuery`
--

DROP PROCEDURE IF EXISTS `spsupplierQuery`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spsupplierQuery`(in sCode VARCHAR(20))
BEGIN

set @MyCode = sCode;
set @sql = 'SELECT *  from suppliers_record where SupplierCode = ?';

     PREPARE stmt FROM @sql;
     EXECUTE stmt USING @MyCode;
     DEALLOCATE PREPARE stmt;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spsupplierSaving`
--

DROP PROCEDURE IF EXISTS `spsupplierSaving`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spsupplierSaving`(
IN sCode VARCHAR(10),
IN sName VARCHAR(40),
IN sAdd VARCHAR(100),
IN sContact VARCHAR(100),
IN sPhone VARCHAR(100),
IN sMobile VARCHAR(100),
IN sEmail VARCHAR(100),
IN sFax VARCHAR(100),
IN sAuthor VARCHAR(100),
IN sStamp datetime
 )
BEGIN

insert into suppliers_record (SupplierCode,
                             SupplierName,
                             SupplierAddress,
                             ContactPerson,
                             SupplierPhone,
                             SupplierMobile,
                             SupplierEmail,
                             SupplierFax,
                             Author,
                             Stamp

                             ) value

                             (sCode,
                             sName,
                             sAdd,
                             sContact,
                             sPhone,
                             sMobile,
                             sEmail,
                             sFax,
                             sAuthor,
                             now()

                             );


END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spsuppliersDelete`
--

DROP PROCEDURE IF EXISTS `spsuppliersDelete`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spsuppliersDelete`()
BEGIN
  
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spsupplierSelect`
--

DROP PROCEDURE IF EXISTS `spsupplierSelect`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spsupplierSelect`()
BEGIN
        select * from suppliers_record;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spsupplierUpdate`
--

DROP PROCEDURE IF EXISTS `spsupplierUpdate`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spsupplierUpdate`(
IN sCode VARCHAR(10),
IN sName VARCHAR(40),
IN sAdd VARCHAR(100),
IN sContact VARCHAR(100),
IN sPhone VARCHAR(100),
IN sMobile VARCHAR(100),
IN sEmail VARCHAR(100),
IN sFax VARCHAR(100),
IN sAuthor VARCHAR(100),
IN sStamp datetime
 )
BEGIN

Update suppliers_record Set SupplierCode=sCode,
                             SupplierName=sName,
                             SupplierAddress=sAdd,
                             ContactPerson=sContact,
                             SupplierPhone=sPhone,
                             SupplierMobile=sMobile,
                             SupplierEmail=sEmail,
                             SupplierFax=sFax,
                             Author=sAuthor,
                             Stamp=   now()
                             where SupplierCode=sCode;


END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spUserCommandSaving`
--

DROP PROCEDURE IF EXISTS `spUserCommandSaving`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spUserCommandSaving`(in mEmpNumber varchar(15), in mValues longtext)
BEGIN
declare mSql longtext;

     delete from commandaccess where EmpNumber = mEmpNumber;

           set mSql = concat('insert into commandaccess (EmpNumber,MenuCode,SubMenuCode, CmdName) values ', mValues);

     SET @sql = mSql;
     PREPARE stmt FROM @sql;
     EXECUTE stmt;
     DEALLOCATE PREPARE stmt;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spUserCommandSearch`
--

DROP PROCEDURE IF EXISTS `spUserCommandSearch`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spUserCommandSearch`(in mEmpNumber varchar(15))
BEGIN

select a.SubMenuCode,a.EmpNumber,a.MenuCode,a.MenuOrder,a.SubMenuOrder, a.CmdName, a.CmdOrder, (select CmdName from commandaccess where EmpNumber = mEmpnumber and MenuCode = a.MenuCode and SubMenuCode= a.SubMenuCode and CmdName = a.CmdName)as active from
(select distinct subaccess.SubMenuCode,emp.EmpNumber, mainaccess.MenuCode, main.MenuOrder,sub.SubMenuOrder, cmd.CmdName,cmd.CmdOrder  from usersprofile as emp
left join mainmenuaccess as mainaccess on mainaccess.EmpNumber = emp.EmpNumber
left join submenuaccess as subaccess  on subaccess.MenuCode = mainaccess.MenuCode
left join mainmenu as main on main.MenuCode = mainaccess.MenuCode
left join submenu as sub on sub.SubMenu = subaccess.SubMenuCode
left join commands as cmd on cmd.SubMenu = sub.SubMenu
where emp.EmpNumber = mEmpNumber and mainaccess.EmpNumber = mEmpNumber and subaccess.EmpNumber = mEmpNumber order by main.MenuOrder, sub.SubMenuOrder
) as a order by a.MenuOrder, a.SubMenuOrder, a.CmdOrder;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spUserMainModuleSaving`
--

DROP PROCEDURE IF EXISTS `spUserMainModuleSaving`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spUserMainModuleSaving`(IN mEmpNumber VARCHAR(15), IN mValues LONGTEXT)
BEGIN
	 declare mSql longtext;

     delete from mainmenuaccess where EmpNumber = mEmpNumber;
     set mSql = concat('insert into mainmenuaccess (EmpNumber,MenuCode) values ', mValues);
     SET @sql = mSql;
     PREPARE stmt FROM @sql;
     EXECUTE stmt;
     DEALLOCATE PREPARE stmt;

     delete from submenuaccess where EmpNumber = mEmpNumber and MenuCode not in(select MenuCode from mainmenuaccess where EmpNumber = mEmpNumber);  
     
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spUserMainModuleSearch`
--

DROP PROCEDURE IF EXISTS `spUserMainModuleSearch`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spUserMainModuleSearch`(in mEmpNumber varchar(20))
BEGIN
   
 
 select MenuCode, MenuName, (select Menucode from mainmenuaccess where MenuCode = menu.MenuCode and EmpNumber = mEmpNumber) as active from mainmenu as menu 
 ;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spUsersDelete`
--

DROP PROCEDURE IF EXISTS `spUsersDelete`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spUsersDelete`(in mEmpNumber varchar(15))
BEGIN
 delete from usersprofile where EmpNumber = mEmpNumber;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spuserSearchFirstName`
--

DROP PROCEDURE IF EXISTS `spuserSearchFirstName`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spuserSearchFirstName`(IN fname varchar(20))
BEGIN
      SELECT EmpFirstName from employeeinformation where EmpFirstName like concat('%',fname,'%')and Status='1' ;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spuserSearchLastName`
--

DROP PROCEDURE IF EXISTS `spuserSearchLastName`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spuserSearchLastName`(IN lname varchar(20))
BEGIN
      SELECT EmpLastName from employeeinformation where EmpLastName like concat('%',lname,'%')and Status='1' ;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spUsersEditSearch`
--

DROP PROCEDURE IF EXISTS `spUsersEditSearch`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spUsersEditSearch`()
BEGIN
  select emp.EmpNumber, emp.EmpFirstName,emp.EmpLastName from usersprofile as usr, employeeinformation as emp  
      WHERE usr.EmpNumber = emp.EmpNumber;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spusersQuery`
--

DROP PROCEDURE IF EXISTS `spusersQuery`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spusersQuery`(in myId VARCHAR(15))
BEGIN
  Select * from usersprofile where EmpNumber=myId;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spUsersSearch`
--

DROP PROCEDURE IF EXISTS `spUsersSearch`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spUsersSearch`()
BEGIN
  select emp.EmpNumber, emp.EmpFirstName,emp.EmpLastName from usersprofile as usr, employeeinformation as emp  
      WHERE usr.EmpNumber = emp.EmpNumber and emp.Status <> 5;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spUsersSearch_`
--

DROP PROCEDURE IF EXISTS `spUsersSearch_`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spUsersSearch_`(in mEmpNumber varchar(15))
BEGIN
  select emp.EmpNumber, emp.EmpFirstName,emp.EmpLastName from usersprofile as usr, employeeinformation as emp  
  WHERE usr.EmpNumber = mEmpNumber and usr.EmpNumber = emp.EmpNumber;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spUserSubMenuSaving`
--

DROP PROCEDURE IF EXISTS `spUserSubMenuSaving`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spUserSubMenuSaving`(in mEmpNumber varchar(15), in mValues longtext)
BEGIN
declare mSql longtext;

     delete from submenuaccess where EmpNumber = mEmpNumber;

	 set mSql = concat('insert into submenuaccess (EmpNumber,MenuCode,SubMenuCode) values ', mValues); 
     SET @sql = mSql;
     PREPARE stmt FROM @sql;
     EXECUTE stmt;
     DEALLOCATE PREPARE stmt;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spUserSubMenuSearch`
--

DROP PROCEDURE IF EXISTS `spUserSubMenuSearch`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spUserSubMenuSearch`(IN mEmpNumber VARCHAR(20), IN mMenuCode varchar(40), IN mQuery VARCHAR(1))
BEGIN
    if mQuery = 1 then
 	   Select * from mainmenuaccess as menuaccess where menuaccess.EmpNumber = mEmpNumber;
    end if;
    if mQuery = 2 then

        
 
        
        
        
        select smenu.SubMenu, smenu.SubMenuName, (select SubMenuCode from submenuaccess where SubMenuCode = smenu.SubMenu and EmpNumber = mEmpNumber) as active 
        from submenu as smenu where smenu.MenuCode = mMenuCode; 
        
        
	end if;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `spuserUpdatePassword`
--

DROP PROCEDURE IF EXISTS `spuserUpdatePassword`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spuserUpdatePassword`(IN myId varchar(20),
                                                      IN newUserName varchar(20),
                                                      IN newPassword varchar(20))
BEGIN
     UPDATE usersprofile SET EmpUserName=newUserName, EmpPassword=newPassword WHERE EmpNumber=myId;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
