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
-- Create schema smsc_main
--

CREATE DATABASE IF NOT EXISTS smsc_main;
USE smsc_main;

--
-- Definition of procedure `sp_pervoyagefinancestatementexpense`
--

DROP PROCEDURE IF EXISTS `sp_pervoyagefinancestatementexpense`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`Rogelio`@`localhost` PROCEDURE `sp_pervoyagefinancestatementexpense`(IN mStartDate DATETIME, IN mEndDate DATETIME, IN mReference VARCHAR(250), IN mStatus VARCHAR(1))
BEGIN

/*   SET @mSql =CONCAT('select AccountDesc_tx, sum(amount) as amount from (select CONCAT(''GJ'',hdr.GJID_cd) AS control, hdr.GJDate_dt AS mDate, hdr.Particular_tx, m.AccountDesc_tx, dtl.DebitAmount_no as amount from tb_tgeneraljournalhdr as hdr 
								left join  tb_tgeneraljournaldtl as dtl on dtl.GJID_cd=hdr.GJID_cd 
								left join tb_mcoahdr as m on m.AccountID_cd = dtl.AccountID_cd
								where hdr.GJDate_dt between ''',mStartDate,''' and ''',mEndDate,''' and hdr.ReferenceID_cd like concat(''',mReference,'%'') and hdr.Post_yn like concat(''',mStatus,'%'') and m.PerVoyageFinanceStatement_yn = 1 and m.PerVoyageFinanceStatementType_tx = 2

     union
      			select CONCAT(''CD'',hdr.CDID_cd) AS control, hdr.CDDate_dt AS mDate, hdr.Particular_tx, m.AccountDesc_tx, dtl.DebitAmount_no as amount from tb_tcheckdisbursementhdr as hdr 
								left join  tb_tcheckdisbursementdtl as dtl on dtl.CDID_cd=hdr.CDID_cd 
								left join tb_mcoahdr as m on m.AccountID_cd = dtl.AccountID_cd
								where hdr.CDDate_dt between ''',mStartDate,''' and ''',mEndDate,''' and hdr.ReferenceID_cd like concat(''',mReference,'%'') and hdr.Post_yn like concat(''',mStatus,'%'') and m.PerVoyageFinanceStatement_yn = 1 and m.PerVoyageFinanceStatementType_tx = 2

    union
        		select CONCAT(''PB'',hdr.PBID_cd) AS control, hdr.PBDate_dt AS mDate, hdr.Particular_tx, m.AccountDesc_tx, dtl.DebitAmount_no as amount from tb_tpurchaseshdr as hdr 
								left join  tb_tpurchasesdtl as dtl on dtl.PBID_cd=hdr.PBID_cd 
								left join tb_mcoahdr as m on m.AccountID_cd = dtl.AccountID_cd
								where hdr.PBDate_dt between ''',mStartDate,''' and ''',mEndDate,''' and hdr.ReferenceID_cd like concat(''',mReference,'%'') and hdr.Post_yn like concat(''',mStatus,'%'') and m.PerVoyageFinanceStatement_yn = 1 and m.PerVoyageFinanceStatementType_tx = 2) as A group by AccountDesc_tx');
PREPARE stmtl FROM @mSql;
EXECUTE stmtl;
DEALLOCATE PREPARE stmtl;*/


   SET @mSql =CONCAT('select AccountDesc_tx,SubsidiaryDesc_tx, sum(amount) as amount from (select CONCAT(''GJ'',hdr.GJID_cd) AS control, hdr.GJDate_dt AS mDate, hdr.Particular_tx, m.AccountDesc_tx, n.SubsidiaryDesc_tx, dtl.DebitAmount_no as amount from tb_tgeneraljournalhdr as hdr 
								left join  tb_tgeneraljournaldtl as dtl on dtl.GJID_cd=hdr.GJID_cd 
								left join tb_mcoahdr as m on m.AccountID_cd = dtl.AccountID_cd
					            left join tb_mcoadtl as n on dtl.SubsidiaryID_cd = n.SubsidiaryID_cd
								where hdr.GJDate_dt between ''',mStartDate,''' and ''',mEndDate,''' and hdr.ReferenceID_cd like concat(''',mReference,'%'') and hdr.Post_yn like concat(''',mStatus,'%'') and m.PerVoyageFinanceStatement_yn = 1 and m.PerVoyageFinanceStatementType_tx = 2

     union
      			select CONCAT(''CD'',hdr.CDID_cd) AS control, hdr.CDDate_dt AS mDate, hdr.Particular_tx, m.AccountDesc_tx, n.SubsidiaryDesc_tx, dtl.DebitAmount_no as amount from tb_tcheckdisbursementhdr as hdr 
								left join  tb_tcheckdisbursementdtl as dtl on dtl.CDID_cd=hdr.CDID_cd 
								left join tb_mcoahdr as m on m.AccountID_cd = dtl.AccountID_cd
				    	       left join tb_mcoadtl as n on dtl.SubsidiaryID_cd = n.SubsidiaryID_cd
					 			where hdr.CDDate_dt between ''',mStartDate,''' and ''',mEndDate,''' and hdr.ReferenceID_cd like concat(''',mReference,'%'') and hdr.Post_yn like concat(''',mStatus,'%'') and m.PerVoyageFinanceStatement_yn = 1 and m.PerVoyageFinanceStatementType_tx = 2

    union
        		select CONCAT(''PB'',hdr.PBID_cd) AS control, hdr.PBDate_dt AS mDate, hdr.Particular_tx, m.AccountDesc_tx, n.SubsidiaryDesc_tx, dtl.DebitAmount_no as amount from tb_tpurchaseshdr as hdr 
								left join  tb_tpurchasesdtl as dtl on dtl.PBID_cd=hdr.PBID_cd 
								left join tb_mcoahdr as m on m.AccountID_cd = dtl.AccountID_cd
                                left join tb_mcoadtl as n on dtl.SubsidiaryID_cd = n.SubsidiaryID_cd
								where hdr.PBDate_dt between ''',mStartDate,''' and ''',mEndDate,''' and hdr.ReferenceID_cd like concat(''',mReference,'%'') and hdr.Post_yn like concat(''',mStatus,'%'') and m.PerVoyageFinanceStatement_yn = 1 and m.PerVoyageFinanceStatementType_tx = 2) as A group by  SubsidiaryDesc_tx,AccountDesc_tx order by AccountDesc_tx');
PREPARE stmtl FROM @mSql;
EXECUTE stmtl;
DEALLOCATE PREPARE stmtl;


 
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
