<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'gidetail-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>
<?php
$imghelp1=CHtml::image(Yii::app()->request->baseUrl.'/images/help.png');
echo CHtml::link($imghelp1,'#',array(
   'style'=>'cursor: pointer; text-decoration: underline;',
   'onclick'=>"{helpdata(4)}",
));  ?>
<?php echo $form->hiddenField($model,'gidetailid'); ?>
<?php echo $form->hiddenField($model,'giheaderid'); ?>
	

    <div class="row">
		<?php echo $form->labelEx($model,'productstockid'); ?>
<?php echo $form->hiddenField($model,'productstockid'); ?>
	  <input type="text" name="account_name" id="productname" title="Account name" readonly value="<?php echo (Productstock::model()->findByPk($model->productstockid)!==null)?Productstock::model()->findByPk($model->productstockid)->productname:'';?>">
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'product_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Material Master'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));
$product=new Product('searchwstatus');
	  $product->unsetAttributes();  // clear any default values
	  if(isset($_GET['Product']))
		$product->attributes=$_GET['Product'];
    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'product-grid',
      'dataProvider'=>$product->Searchwstatus(),
      'filter'=>$product,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#product_dialog\").dialog(\"close\"); $(\"#productname\").val(\"$data->productname\"); $(\"#Gidetail_productid\").val(\"$data->productid\");
		  "))',
          ),
        'productid',
        'productname',
        array(
          'class'=>'CCheckBoxColumn',
          'name'=>'recordstatus',
          'selectableRows'=>'0',
          'header'=>'Record Status',
          'checked'=>'$data->recordstatus'
        ),
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$("#product_dialog").dialog("open"); return false;',
                       ))?>		
		<?php echo $form->error($model,'productid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'qty'); ?>
		<?php echo $form->textField($model,'qty'); ?>
		<?php echo $form->error($model,'qty'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'unitofmeasureid'); ?>
		<?php echo $form->hiddenField($model,'unitofmeasureid'); ?>
	  <input type="text" name="account_name" id="uomcode" title="Account name" readonly value="<?php echo (Unitofmeasure::model()->findByPk($model->unitofmeasureid)!==null)?Unitofmeasure::model()->findByPk($model->unitofmeasureid)->uomcode:'';?>">
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'uom_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Unit of Measure'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));
$unitofmeasure=new Unitofmeasure('searchwstatus');
	  $unitofmeasure->unsetAttributes();  // clear any default values
	  if(isset($_GET['Unitofmeasure']))
		$unitofmeasure->attributes=$_GET['Unitofmeasure'];
    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'uom-grid',
      'dataProvider'=>$unitofmeasure->Searchwstatus(),
      'filter'=>$unitofmeasure,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#uom_dialog\").dialog(\"close\"); $(\"#uomcode\").val(\"$data->uomcode\"); $(\"#Gidetail_unitofmeasureid\").val(\"$data->unitofmeasureid\");
		  "))',
          ),
        'unitofmeasureid',
        'uomcode',
        array(
          'class'=>'CCheckBoxColumn',
          'name'=>'recordstatus',
          'selectableRows'=>'0',
          'header'=>'Record Status',
          'checked'=>'$data->recordstatus'
        ),
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$("#uom_dialog").dialog("open"); return false;',
                       ))?>
		<?php echo $form->error($model,'unitofmeasureid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'slocid'); ?>
		<?php echo $form->hiddenField($model,'slocid'); ?>
	  <input type="text" name="account_name" id="sloccode" title="Account name" readonly value="<?php echo (Sloc::model()->findByPk($model->slocid)!==null)?Sloc::model()->findByPk($model->slocid)->sloccode:'';?>">
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'sloc_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Storage Location'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));
$sloc=new Sloc('searchwstatus');
	  $sloc->unsetAttributes();  // clear any default values
	  if(isset($_GET['Sloc']))
		$sloc->attributes=$_GET['Sloc'];
    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'sloc-grid',
      'dataProvider'=>$sloc->Searchwstatus(),
      'filter'=>$sloc,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#sloc_dialog\").dialog(\"close\"); $(\"#sloccode\").val(\"$data->sloccode\"); $(\"#Gidetail_slocid\").val(\"$data->slocid\");
		  "))',
          ),
        'slocid',
        'sloccode',
        array(
          'class'=>'CCheckBoxColumn',
          'name'=>'recordstatus',
          'selectableRows'=>'0',
          'header'=>'Record Status',
          'checked'=>'$data->recordstatus'
        ),
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$("#sloc_dialog").dialog("open"); return false;',
                       ))?>
		<?php echo $form->error($model,'slocid'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::ajaxSubmitButton('Save',
		array('giheader/writedetail'),
	  array(
	  'success'=>'function(data1)
		{
			var x = eval("(" + data1 + ")");
			document.getElementById("messages").innerHTML = x.div;
			if (x.status == "success")
			{
			  $.fn.yiiGridView.update("detaildatagrid");
			  $("#createdialog1").dialog("close");
			document.getElementById("messages").innerHTML = "";
			}
        }')); ?>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->