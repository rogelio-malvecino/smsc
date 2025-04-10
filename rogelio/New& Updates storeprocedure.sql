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
-- Definition of procedure `sp_ControlAccount_Insert`
--

DROP PROCEDURE IF EXISTS `sp_ControlAccount_Insert`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ControlAccount_Insert`(IN mEmployeeID_cd VARCHAR(15), IN mAccountID_cd VARCHAR(5), IN mAccountDesc_tx VARCHAR(80), IN mGroupID_cd VARCHAR(3), IN mBank_yn VARCHAR(1), IN mDebit_yn VARCHAR(1), IN mCR_yn VARCHAR(1), IN mPB_yn VARCHAR(1), IN mCS_yn VARCHAR(1), IN mBS_yn VARCHAR(1), IN mCD_yn VARCHAR(1), IN mGJ_yn VARCHAR(1), IN mBalanceSheet_yn VARCHAR(1), IN mBalanceSheetType_tx VARCHAR(1), IN mIncomeStatement_yn VARCHAR(1), IN mIncomeStatementType_tx VARCHAR(1), IN mCashFlow_yn VARCHAR(1), IN mCashFlowType_tx VARCHAR(1), IN mPerVoyageFinanceStatement_yn varCHAR(1), IN mPerVoyageFinanceStatementType_tx VARCHAR(1), IN mBaseline LONGTEXT)
BEGIN
     INSERT INTO tb_mcoahdr(AccountID_cd,
 			   AccountDesc_tx,
 			   GroupID_cd,
 			   Bank_yn,
 			   Debit_yn,
 			   CR_yn,
 			   PB_yn,
                            CS_yn,
                            BS_yn,
                            CD_yn,
 			   GJ_yn,
                            BalanceSheet_yn,
                            BalanceSheetType_tx,
                            IncomeStatement_yn,
                            IncomeStatementType_tx,
                              CashFlow_yn,
                              CashFlowType_tx,
                               PerVoyageFinanceStatement_yn,
                               PerVoyageFinanceStatementType_tx,
                            Baseline)
		     VALUES(mAccountID_cd,
 			   mAccountDesc_tx,
 			   mGroupID_cd,
 			   mBank_yn,
 			   mDebit_yn,
 			   mCR_yn,
 			   mPB_yn,
                            mCS_yn,
                            mBS_yn,
                            mCD_yn,
			    mGJ_yn,
                            mBalanceSheet_yn,
                            mBalanceSheetType_tx,
                            mIncomeStatement_yn,
                            mIncomeStatementType_tx, 
                             mCashFlow_yn,
					         mCashFlowType_tx,
                             mPerVoyageFinanceStatement_yn,
                             mPerVoyageFinanceStatementType_tx, 
         					 mBaseline);
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `sp_ControlAccount_Update`
--

DROP PROCEDURE IF EXISTS `sp_ControlAccount_Update`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ControlAccount_Update`(IN mEmployeeID_cd VARCHAR(15), IN mAccountID_cd VARCHAR(5), IN mAccountDesc_tx VARCHAR(80), IN mGroupID_cd VARCHAR(3), IN mBank_yn VARCHAR(1), IN mDebit_yn VARCHAR(1), IN mCR_yn VARCHAR(1), IN mPB_yn VARCHAR(1), IN mCS_yn VARCHAR(1), IN mBS_yn VARCHAR(1), IN mCD_yn VARCHAR(1), IN mGJ_yn VARCHAR(1), IN mBalanceSheet_yn VARCHAR(1), IN mBalanceSheetType_tx VARCHAR(1), IN mIncomeStatement_yn VARCHAR(1), IN mIncomeStatementType_tx VARCHAR(1), IN mCashFlow_yn VARCHAR(1), IN mCashFlowType_tx VARCHAR(1), IN mPerVoyageFinanceStatement_yn VARCHAR(1), IN mPerVoyageFinanceStatementType_tx vaRCHAR(1), IN mBaseline LONGTEXT)
BEGIN
     UPDATE tb_mcoahdr
     SET AccountDesc_tx = mAccountDesc_tx,
         GroupID_cd = mGroupID_cd,
         Bank_yn = mBank_yn,
         Debit_yn = mDebit_yn,
         CR_yn = mCR_yn,
         PB_yn = mPB_yn,
         CS_yn = mCS_yn,
         BS_yn = mBS_yn,
         CD_yn = mCD_yn,
         GJ_yn = mGJ_yn,
         BalanceSheet_yn = mBalanceSheet_yn,
         BalanceSheetType_tx = mBalanceSheetType_tx,
         IncomeStatement_yn = mIncomeStatement_yn,
         IncomeStatementType_tx = mIncomeStatementType_tx, 
         CashFlow_yn = mCashFlow_yn,
         CashFlowType_tx= mCashFlowType_tx,
         PerVoyageFinanceStatement_yn = mPerVoyageFinanceStatement_yn,
         PerVoyageFinanceStatementType_tx = mPerVoyageFinanceStatementType_tx,  
         Baseline = mBaseline
     WHERE AccountID_cd = mAccountID_cd;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `sp_pervoyagefinancestatementexpense`
--

DROP PROCEDURE IF EXISTS `sp_pervoyagefinancestatementexpense`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`Rogelio`@`localhost` PROCEDURE `sp_pervoyagefinancestatementexpense`(IN mStartDate DATETIME, IN mEndDate DATETIME, IN mReference VARCHAR(250), IN mStatus VARCHAR(1))
BEGIN

   SET @mSql =CONCAT('select CONCAT(''GJ'',hdr.GJID_cd) AS control, hdr.GJDate_dt AS mDate, hdr.Particular_tx, m.AccountDesc_tx, dtl.DebitAmount_no as amount from tb_tgeneraljournalhdr as hdr 
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
								where hdr.PBDate_dt between ''',mStartDate,''' and ''',mEndDate,''' and hdr.ReferenceID_cd like concat(''',mReference,'%'') and hdr.Post_yn like concat(''',mStatus,'%'') and m.PerVoyageFinanceStatement_yn = 1 and m.PerVoyageFinanceStatementType_tx = 2');
PREPARE stmtl FROM @mSql;
EXECUTE stmtl;
DEALLOCATE PREPARE stmtl;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `sp_pervoyagefinancestatementincome`
--

DROP PROCEDURE IF EXISTS `sp_pervoyagefinancestatementincome`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`Rogelio`@`localhost` PROCEDURE `sp_pervoyagefinancestatementincome`(IN mStartDate DATETIME, IN mEndDate datetime, IN mReference VARCHAR(250), IN mStatus varchar(1))
BEGIN

 SET @mSql = CONCAT('select CONCAT(''CR'',hdr.CRID_cd) as control,hdr.CRDate_dt as mDate,hdr.Particular_tx, m.AccountDesc_tx, dtl.CreditAmount_no as amount from tb_tcashreceiptshdr as hdr 
								left join  tb_tcashreceiptsdtl as dtl on dtl.CRID_cd=hdr.CRID_cd 
								left join tb_mcoahdr as m on m.AccountID_cd = dtl.AccountID_cd
								where hdr.CRDate_dt between ''',mStartDate,''' and ''',mEndDate,''' and 
                                hdr.ReferenceID_cd like concat(''',mReference,'%'') and 
                                hdr.Post_yn like concat(''',mStatus,'%'') and 
                                m.PerVoyageFinanceStatement_yn = 0 and
                                m.PerVoyageFinanceStatementType_tx =0');


PREPARE stmtl FROM @mSql;
EXECUTE stmtl;
DEALLOCATE PREPARE stmtl;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `sp_voyagereference_lookup`
--

DROP PROCEDURE IF EXISTS `sp_voyagereference_lookup`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_voyagereference_lookup`(IN mVoyageReference varchar(30))
BEGIN
select distinct(VoyageReference) from (
select ReferenceID_cd as VoyageReference  from tb_tcheckdisbursementhdr where ReferenceID_cd like concat('',mVoyageReference,'%')
	union all
select ReferenceID_cd as VoyageReference  from tb_tgeneraljournalhdr where ReferenceID_cd like concat('',mVoyageReference,'%')
	union all
 select ReferenceID_cd as VoyageReference  from tb_tcashsaleshdr where ReferenceID_cd like concat('',mVoyageReference,'%')
	union all 
 select ReferenceID_cd as VoyageReference  from tb_tcashreceiptshdr where ReferenceID_cd like concat('',mVoyageReference,'%')
	union all  
 select ReferenceID_cd as VoyageReference  from tb_tpurchaseshdr where ReferenceID_cd like concat('',mVoyageReference,'%')
) as a;	   
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
