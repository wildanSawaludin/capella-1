<?php
$this->breadcrumbs=array(
	'Employeetransports',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
// here is the magic
function adddata()
{
    <?php echo CHtml::ajax(array(
			'url'=>array('employeetransport/create'),
            'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
document.getElementById('messages').innerHTML = '';
                if (data.status == 'success')
                {
                    $('#createdialog div.divcreate').html(data.div);
					$('#Employeetransport_employeetransportid').val('');
					$('#Employeetransport_employeeid').val('');
					$('#fullname').val('');
					$('#Employeetransport_transunitpriceid').val('');
					$('#pricetypename').val('');
                          // Here is the trick: on submit-> once again this function!
                    $('#createdialog').dialog('open');
                }
                else
                {
                    document.getElementById('messages').innerHTML = data.div;
                }
            } ",
            ))?>;
    return false;
}
</script>
<script type="text/javascript">
function editdata()
{
    <?php
	echo CHtml::ajax(array(
			'url'=>array('employeetransport/update'),
            'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("datagrid")'),
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
document.getElementById('messages').innerHTML = '';
                if (data.status == 'success')
                {
                    $('#createdialog div.divcreate').html(data.div);
					$('#Employeetransport_employeetransportid').val(data.employeetransportid);
					$('#Employeetransport_employeeid').val(data.employeeid);
					$('#fullname').val(data.fullname);
					$('#Employeetransport_transunitpriceid').val(data.transunitpriceid);
					$('#pricetypename').val(data.pricetypename);
					if (data.recordstatus == '1')
					{
					  document.forms[1].elements[8].checked=true;
					}
					else
					{
					  document.forms[1].elements[8].checked=false;
					}
                          // Here is the trick: on submit-> once again this function!
                    $('#createdialog').dialog('open');
                }
                else
                {
                    document.getElementById('messages').innerHTML = data.div;
                }
            } ",
            ))?>;
    return false;
}
</script>
<script type="text/javascript">
function deletedata()
{
    <?php
	echo CHtml::ajax(array(
			'url'=>array('employeetransport/delete'),
            'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("datagrid")'),
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {

            } ",
            ))?>;
	$.fn.yiiGridView.update('datagrid');
    return false;
}
</script>
<script type="text/javascript">
function refreshdata()
{
    $.fn.yiiGridView.update('datagrid');
    return false;
}
</script>
<script type="text/javascript">
function helpdata(value) {
	jQuery.ajax({
        'url': '/smlive/index.php?r=employeetransport/help',
        'data': {
            'id': value
        },
        'type': 'post',
        'dataType': 'json',
        'success': function(data) {
            if (data.status == 'success') {
				document.getElementById('divhelp').innerHTML = data.div;
                $('#helpdialog').dialog('open');
            } else {
                document.getElementById('messages').innerHTML = data.div;
            }
        },
        'cache': false
    });;
    return false;
}
</script>
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'createdialog',
    'options'=>array(
        'title'=>'Form Dialog',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<div id="divcreate"></div>
<?php echo $this->renderPartial('_form', array('model'=>$model,
	'employee'=>$employee,'transunitprice'=>$transunitprice)); ?>
<?php $this->endWidget();?>
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'helpdialog',
    'options'=>array(
        'title'=>'Help',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<div id="divhelp"></div>
<?php $this->endWidget();?>
<h1>Employee Transport</h1>
<?php
$imgcreate=CHtml::image(Yii::app()->request->baseUrl.'/images/create.png');
echo CHtml::link($imgcreate,'#',array(
   'style'=>'cursor: pointer; text-decoration: underline;',
   'onclick'=>"{adddata()}",
	'title'=>Yii::t('app','create data')
));
$imgedit=CHtml::image(Yii::app()->request->baseUrl.'/images/edit.png');
echo CHtml::link($imgedit,'#',array(
   'style'=>'cursor: pointer; text-decoration: underline;',
   'onclick'=>"{editdata()}",
	'title'=>Yii::t('app','edit data')
));
$imgdelete=CHtml::image(Yii::app()->request->baseUrl.'/images/delete.png');
echo CHtml::link($imgdelete,'#',array(
   'style'=>'cursor: pointer; text-decoration: underline;',
   'onclick'=>"{deletedata()}",
   'title'=>Yii::t('app','delete data')
));
$imgdown=CHtml::image(Yii::app()->request->baseUrl.'/images/down.png');
echo CHtml::link($imgdown,array('/employeetransport/download'),array(
   'style'=>'cursor: pointer; text-decoration: underline;',
   'title'=>Yii::t('app','download data')
));
$imgrefresh=CHtml::image(Yii::app()->request->baseUrl.'/images/refresh.png');
echo CHtml::link($imgrefresh,'#',array(
   'style'=>'cursor: pointer; text-decoration: underline;',
   'onclick'=>"{refreshdata()}",
   'title'=>Yii::t('app','refresh data')
));
$imghelp=CHtml::image(Yii::app()->request->baseUrl.'/images/help.png');
echo CHtml::link($imghelp,'#',array(
   'style'=>'cursor: pointer; text-decoration: underline;',
   'onclick'=>"{helpdata(1)}",
   'title'=>Yii::t('app','help')
));
?>Record/page <?php echo CHtml::textField($pageSize,'',array('size'=>'5',
        // change 'user-grid' to the actual id of your grid!!
        'onchange'=>"$.fn.yiiGridView.update('datagrid',{ data:{pageSize: $(this).val() }})",
	  ));  ?><?php
$this->widget('ext.EAjaxUpload.EAjaxUpload',
                 array(
                       'id'=>'uploadFile',
                       'config'=>array(
                                       'action'=>'index.php?r=employeetransport/upload',
                                       'allowedExtensions'=>array("csv"),
                                       'sizeLimit'=>(int)Yii::app()->params['sizeLimit'],
									   'onComplete'=>"js:function(id, fileName, responseJSON){ $.fn.yiiGridView.update('datagrid');  }",
                                       'messages'=>array(
                                                         'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                                                         'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                                                         'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                                                         'emptyError'=>"{file} is empty, please select files again without it.",
                                                         'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                                                        ),
                                       'showMessage'=>"js:function(message){ alert(message); }"
                                      )
                      ));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'datagrid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'selectableRows'=>1,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'ids',
    ),
	array('name'=>'employeetransportid','visible'=>false, 'value'=>'$data->employeetransportid','htmlOptions'=>array('width'=>'1%')),
	array('name'=>'employeeid', 'value'=>'$data->employee->fullname'),
	array('name'=>'transunitpriceid', 'header'=>'Price Type', 'value'=>'$data->transunitprice->pricetype->pricetypename'),
	array('name'=>'transunitpriceid', 'header'=>'Price', 'value'=>'$data->transunitprice->price'),
    array(
      'class'=>'CCheckBoxColumn',
      'name'=>'recordstatus',
      'selectableRows'=>'0',
      'header'=>'Record Status',
      'checked'=>'$data->recordstatus',
    ),
  ),
));
?>
<div id="message"></div>

