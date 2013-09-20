<?php

class RepsalesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
    protected $menuname = 'repsales';

        public function actionHelp()
	{
		if (isset($_POST['id'])) {
			$id= (int)$_POST['id'];
			switch ($id) {
				case 1 : $this->txt = '_help'; break;
				case 2 : $this->txt = '_helpmodif'; break;
			}
		}
	  parent::actionHelp();
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
            parent::actionIndex();
			if (isset($_POST['startperiod']) && isset($_POST['endperiod']))
      {
        $this->pdf->title='Sales Report';
	  $this->pdf->AddPage('L');
		$this->pdf->iscustomborder = false;
		$this->pdf->isneedpage = true;
		$connection=Yii::app()->db;
		$sql = "
select b.cashbankno, b.transdate,
		d.accountcode,d.accountname,b.invoiceid,c.invoiceno,a.debit,c.invoicedate,e.sono,e.sodate,f.fullname,
b.amount,date_add(c.invoicedate, interval g.paydays DAY) as duedate, (h.taxvalue * c.amount /100) as taxamount,(h.taxvalue * c.amount /100) + c.amount as totalamount
from cashbankacc a
inner join cashbank b on b.cashbankid = a.cashbankid
inner join invoice c on c.invoiceid = b.invoiceid
inner join account d on d.accountid = a.accountid
inner join soheader e on e.soheaderid = c.soheaderid
inner join addressbook f on f.addressbookid = e.addressbookid 
inner join paymentmethod g on g.paymentmethodid = e.paymentmethodid
inner join tax h on h.taxid = c.taxid
where b.transdate between '". $_POST['startperiod']. "' and '". $_POST['endperiod']."'

";
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
		$this->pdf->Cell(0,10,'PERIODE : '. date(Yii::app()->params['dateviewfromdb'], strtotime($_POST['startperiod'])) . 
				' Up To '.date(Yii::app()->params['dateviewfromdb'], strtotime($_POST['endperiod'])),0,0,'C');
		
      $this->pdf->SetY($this->pdf->gety()+15);
		$this->pdf->setFont('Arial','B',8);
      $this->pdf->colalign = array('C','C','C','C','C','C','C','C','C','C','C','C');
      $this->pdf->setwidths(array(10,20,20,20,30,20,20,20,20,20,20,30));
	  $this->pdf->colheader = array(
		'No',
		'VOU No',
		'VOU Date',
		'SO No',
		'Customer',
		'INV No',
		'INV Date',
		'ACC No',
		'ACC Name',
		'INV Amount',
		'VAT',
		'Total'
		);
      $this->pdf->RowHeader();
		$this->pdf->setFont('Arial','',8);
      $this->pdf->coldetailalign = array('L','L','L','L','L','L','L','L','L','R','R','R');
	  $totalamount = 0;$i=0;$totaltax=0;$total=0;
		foreach($dataReader as $row)
          {
		  $i+=1;
$this->pdf->Row(array(
		$i,
		$row['cashbankno'],
		date(Yii::app()->params['dateviewfromdb'], strtotime($row['transdate'])),
		$row['sono'],
		$row['fullname'],
		$row['invoiceno'],
		date(Yii::app()->params['dateviewfromdb'], strtotime($row['invoicedate'])),
		$row['accountcode'],
		$row['accountname'],
		Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$row['amount']),
		Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$row['debit']),		
		));
		      $this->pdf->text(12,$this->pdf->gety()+10,'NOTE : Print Report as per Voucher Date and Account Name');
			  $totalamount += $row['amount'];
			  $totaltax += $row['debit'];
			  $total += $totalamount + $totaltax;
		  		  }
				  $this->pdf->Row(array(
		'',
		'',
		'',
		'',
		'',
		'',
		'',
		'Total',
		'',
		Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$totalamount),
		Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$totaltax),		
		Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$total),		
		));
          $this->pdf->Output();
	  }
	  else
	  {
		$this->render('index');
	  }
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Genledger::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='genledger-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
