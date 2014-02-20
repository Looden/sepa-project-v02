<?php
$dbuser="";
$dbpass="";
$dbname="";  
$chandle = mysql_connect("localhost", $dbuser, $dbpass) or die("Connection Failure to Database");


mysql_select_db($dbname, $chandle) or die ($dbname . " Database not found." . $dbuser);
mysql_query("SET NAMES 'utf8'");

$getdate = mysql_real_escape_string($_GET['datum']);// if you integrate to a system, u can use this method


$dta = "SELECT * FROM dta WHERE date='{$getdate}' ORDER BY `no` ASC";
$dta = mysql_query($dta);

$calcs = "SELECT SUM(betrag) AS total, COUNT(betrag) AS cnt FROM dta WHERE date='{$getdate}' ORDER BY `no` ASC";
$calcs = mysql_query($calcs);
$crow = mysql_fetch_array($calcs);
//////////////////////////////////////////////////////


$MsgId = "Kennung-Msg" . date("dmY-H:i:s");
$CreDtTm = date("Y-m-d") . "T" . date("H:i:s.000") . "Z";

$total = $crow['total'];
$total = number_format($total,2,'.','');

$PmtInfId = "Kennung-PmInf" . date("dmY-H:i") . "-1";
$ReqdColltnDt = date("Y-m-d", strtotime("+7 days"));

///////////////////////////////////////////////

$name = "Lastschrift_" . date("d/m/Y_Hi") . ".xml";
header('Content-Disposition: attachment;filename=' . $name);
header('Content-type: text/xml');
header('Pragma: public');
header('Cache-control: private');
header('Expires: -1');
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>";


$xml = "
<Document xmlns='urn:iso:std:iso:20022:tech:xsd:pain.008.003.02'>
  <CstmrDrctDbtInitn>
    <GrpHdr>
      <MsgId>{$MsgId}</MsgId>
      <CreDtTm>{$CreDtTm}</CreDtTm>
      <NbOfTxs>{$crow['cnt']}</NbOfTxs>
      <CtrlSum>{$total}</CtrlSum>
      <InitgPty>
        <Nm>your company name here</Nm>
      </InitgPty>
    </GrpHdr>
    <PmtInf>
      <PmtInfId>{$PmtInfId}</PmtInfId>
      <PmtMtd>DD</PmtMtd>
      <NbOfTxs>{$crow['cnt']}</NbOfTxs>
      <CtrlSum>{$total}</CtrlSum>
      <PmtTpInf>
        <SvcLvl>
          <Cd>SEPA</Cd>
        </SvcLvl>
        <LclInstrm>
          <Cd>CORE</Cd>
        </LclInstrm>
        <SeqTp>RCUR</SeqTp>
      </PmtTpInf>
      <ReqdColltnDt>{$ReqdColltnDt}</ReqdColltnDt>
      <Cdtr>
        <Nm>your company name here again</Nm>
      </Cdtr>
      <CdtrAcct>
        <Id>
          <IBAN>your iban code here, not payer, Its yours</IBAN>
        </Id>
      </CdtrAcct>
      <CdtrAgt>
        <FinInstnId>
          <BIC>your BIC code here.</BIC>
        </FinInstnId>
      </CdtrAgt>
      <ChrgBr>SLEV</ChrgBr>
      <CdtrSchmeId>
        <Id>
          <PrvtId>
            <Othr>
              <Id>your glaubiger ID which is your bank gives you</Id>
              <SchmeNm>
                <Prtry>SEPA</Prtry>
              </SchmeNm>
            </Othr>
          </PrvtId>
        </Id>
      </CdtrSchmeId>";

$i=0;
$today = date("Y-m-d");

while($row=mysql_fetch_array($dta))	{ // so, your loop starting for multiple payers
$i++;


$EndToEndId = "Kennung-EtE" . date("dmY-H:i-") . $i;
$betrag = $row['betrag'];
$betrag = number_format($betrag,2,'.','');
$bic = $row['BIC'];
$iban = $row['iban'];
$Ustrd = "your explanation here " . ",RATE " . $row['rate']; 

$xml .= "
      <DrctDbtTxInf>
        <PmtId>
          <EndToEndId>{$EndToEndId}</EndToEndId>
        </PmtId>
        <InstdAmt Ccy='EUR'>{$betrag}</InstdAmt>
        <DrctDbtTx>
          <MndtRltdInf>
            <MndtId>Mandat</MndtId>
            <DtOfSgntr>{$today}</DtOfSgntr>
          </MndtRltdInf>
        </DrctDbtTx>
        <DbtrAgt>
          <FinInstnId>
            <BIC>{$bic}</BIC>
          </FinInstnId>
        </DbtrAgt>
        <Dbtr>
          <Nm>{$row['account_owner']}</Nm>
        </Dbtr>
        <DbtrAcct>
          <Id>
            <IBAN>{$iban}</IBAN>
          </Id>
        </DbtrAcct>
        <RmtInf>
          <Ustrd>{$Ustrd}</Ustrd>
        </RmtInf>
      </DrctDbtTxInf>";

						}



$xml .= "

    </PmtInf>
  </CstmrDrctDbtInitn>
</Document>";

echo $xml;
echo $dom->saveXML();
?>

