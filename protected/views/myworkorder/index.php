<?php
$this->breadcrumbs=array(
	'Myworkorderes',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
function editdata() {
    jQuery.ajax({
        'url': '/smlive/index.php?r=myworkorder/update',
        'data': {
            'id': $.fn.yiiGridView.getSelection("datagrid")
        },
        'type': 'post',
        'dataType': 'json',
        'success': function(data) {
            document.getElementById('messages').innerHTML = '';
            if (data.status == 'success') {
                $('#createdialog div.divcreate').html(data.div);
                $('#MyWorkorder_workorderid').val(data.workorderid);
                $('#MyWorkorder_productid').val(data.productid);
                $('#productname').val(data.productname);
                $('#MyWorkorder_workstartdate').val(data.workstartdate);
                $('#workstartdate').val(data.workstartdate);
                $('#MyWorkorder_worktargetdate').val(data.worktargetdate);
                $('#worktargetdate').val(data.worktargetdate);
                $('#MyWorkorder_workorderstaffid').val(data.workorderstaffid);
                $('#useraccessid').val(data.realname);
                $('#MyWorkorder_description').val(data.description);
                $('#description').val(data.description);
                $('#MyWorkorder_workorderstatusid').val(data.workorderstatus);
                $('#laststatus').val(data.workorderstatus);
				$('#newstatus').val('');
                $('#MyWorkorder_eventrequestid').val(data.eventrequestid);
                $('#eventtitle').val(data.eventtitle);
                $('#MyWorkorder_recordstatus').val(data.recordstatus);
                if (data.recordstatus == '1') {
                    document.forms[1].elements[18].checked = true;
                } else {
                    document.forms[1].elements[18].checked = true;
                }
                $('#createdialog').dialog('open');
            } else {
                document.getElementById('messages').innerHTML = data.div;
            }
        },
        'cache': false
    });;
    return false;
}
</script>
<script type="text/javascript">
function viewdata() {
    jQuery.ajax({
        'url': '/smlive/index.php?r=myworkorder/view',
        'data': {
            'id': $.fn.yiiGridView.getSelection("datagrid")
        },
        'type': 'post',
        'dataType': 'json',
        'success': function(data) {
            document.getElementById('messages').innerHTML = '';
            if (data.status == 'success') {
			  document.getElementById('divview').innerHTML = data.div;
                $('#viewdialog').dialog('open');
            } else {
                document.getElementById('messages').innerHTML = data.div;
            }
        },
        'cache': false
    });;
    return false;
}
</script>
<script type="text/javascript">
function deletedata()
{jQuery.ajax({'url':'/smlive/index.php?r=myworkorder/delete','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML=data.div;},'cache':false});;$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function refreshdata()
{$.fn.yiiGridView.update('datagrid');return false;}
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
  'workorderstaff'=>$workorderstaff,
'eventrequest'=>$eventrequest,
'product'=>$product));
?>
<?php $this->endWidget();?>
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'viewdialog',
    'options'=>array(
        'title'=>'Form Dialog',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<div id="divview"></div>
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
<?php echo $this->renderPartial('_help'); ?>
<?php $this->endWidget();?>
<h1>My Work Orders</h1>
<?php
$imgedit=CHtml::image(Yii::app()->request->baseUrl.'/images/edit.png');
echo CHtml::link($imgedit,'#',array(
   'style'=>'cursor: pointer; text-decoration: underline;',
   'onclick'=>"{editdata()}",
	'title'=>Yii::t('app','edit data')
));
$imgview=CHtml::image(Yii::app()->request->baseUrl.'/images/view.png');
echo CHtml::link($imgview,'#',array(
   'style'=>'cursor: pointer; text-decoration: underline;',
   'onclick'=>"{viewdata()}",
	'title'=>Yii::t('app','edit data')
));
$imgdelete=CHtml::image(Yii::app()->request->baseUrl.'/images/delete.png');
echo CHtml::link($imgdelete,'#',array(
   'style'=>'cursor: pointer; text-decoration: underline;',
   'onclick'=>"{deletedata()}",
   'title'=>Yii::t('app','delete data')
));
$imgdown=CHtml::image(Yii::app()->request->baseUrl.'/images/down.png');
echo CHtml::link($imgdown,'#',array(
   'style'=>'cursor: pointer; text-decoration: underline;',
   'onclick'=>"{editdata(); $('#createdialog').dialog('open');}",
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
   'onclick'=>"$('#helpdialog').dialog('open');",
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
                                       'action'=>'index.php?r=myworkorder/upload',
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
		'id'=>'workorderid',
	  ),
	  array('name'=>'workorderid', 'value'=>'$data->workorderid','htmlOptions'=>array('width'=>'1%')),
	  array('name'=>'productid', 'value'=>'$data->product->productname'),
	  array('name'=>'workorderstaffid', 'value'=>'$data->workorderstaff->useraccess->username'),
	  array('name'=>'eventrequestid', 'value'=>'$data->eventrequest->eventtitle'),
		  'description',
	  array('name'=>'workorderstatusid', 'value'=>'$data->workorderstatus->statusname'),
		  'workstartdate',
		  'worktargetdate',
	  array(
		'class'=>'CCheckBoxColumn',
		'name'=>'recordstatus',
		'selectableRows'=>'0',
		'header'=>'Record Status',
		'checked'=>'$data->recordstatus'
	  ),
	),
));
?>
