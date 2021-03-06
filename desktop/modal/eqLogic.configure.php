<?php
if (!isConnect('admin')) {
	throw new Exception('{{401 - Accès non autorisé}}');
}
$eqLogic = eqLogic::byId(init('eqLogic_id'));
if (!is_object($eqLogic)) {
	throw new Exception('EqLogic non trouvé : ' . init('eqLogic_id'));
}

sendVarToJS('eqLogicInfo', utils::o2a($eqLogic));
?>
<div style="display: none;" id="md_displayEqLogicConfigure"></div>

<a class="btn btn-danger pull-right btn-sm" id="bt_eqLogicConfigureRemove"><i class="fa fa-times"></i> {{Supprimer}}</a>
<a class="btn btn-success pull-right btn-sm" id="bt_eqLogicConfigureSave"><i class="fa fa-check-circle"></i> {{Enregistrer}}</a>

<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#eqLogic_information" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-info-circle"></i> {{Informations}}</a></li>
    <?php if ($eqLogic->widgetPossibility('custom')) {
	?>
       <li role="presentation"><a href="#eqLogic_display" aria-controls="messages" role="tab" data-toggle="tab"><i class="fa fa-desktop"></i> {{Affichage avancé}}</a></li>
       <?php }
?>
       <li role="presentation"><a href="#eqLogic_battery" aria-controls="messages" role="tab" data-toggle="tab"><i class="icon techno-charging"></i> {{Batterie}}</a></li>
   </ul>

   <div class="tab-content" id="div_displayEqLogicConfigure">
     <div role="tabpanel" class="tab-pane active" id="eqLogic_information">
         <br/>
         <div class="row">
            <div class="col-sm-4" >
                <form class="form-horizontal">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">{{ID}}</label>
                            <div class="col-sm-4">
                                <span class="eqLogicAttr label label-primary" data-l1key="id" style="font-size : 1em;"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">{{Nom}}</label>
                            <div class="col-sm-4">
                                <span class="eqLogicAttr label label-primary" data-l1key="name" style="font-size : 1em;"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">{{ID logique}}</label>
                            <div class="col-sm-4">
                                <span class="eqLogicAttr label label-primary" data-l1key="logicalId" style="font-size : 1em;"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">{{ID de l'objet}}</label>
                            <div class="col-sm-4">
                                <span class="eqLogicAttr label label-primary" data-l1key="object_id" style="font-size : 1em;"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">{{Date de création}}</label>
                            <div class="col-sm-4">
                                <span class="eqLogicAttr label label-primary" data-l1key="configuration" data-l2key="createtime" style="font-size : 1em;"></span>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="col-sm-4" >
                <form class="form-horizontal">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"></label>
                            <div class="col-sm-8">
                               <input type="checkbox" class="eqLogicAttr bootstrapSwitch" data-label-text="{{Activer}}" data-l1key="isEnable" checked/>
                               <input type="checkbox" class="eqLogicAttr bootstrapSwitch" data-label-text="{{Visible}}" data-l1key="isVisible" checked/>
                           </div>
                       </div>

                       <div class="form-group">
                        <label class="col-sm-4 control-label">{{Type}}</label>
                        <div class="col-sm-4">
                            <span class="eqLogicAttr label label-primary" data-l1key="eqType_name" style="font-size : 1em;"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">{{Tentative échouée}}</label>
                        <div class="col-sm-4">
                            <span class="label label-primary" style="font-size : 1em;"><?php echo $eqLogic->getStatus('numberTryWithoutSuccess', 0) ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">{{Date de dernière communication}}</label>
                        <div class="col-sm-4">
                            <span class="label label-primary" style="font-size : 1em;"><?php echo $eqLogic->getStatus('lastCommunication') ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">{{Dernière mise à jour}}</label>
                        <div class="col-sm-4">
                            <span class="eqLogicAttr label label-primary" data-l1key="configuration" data-l2key="updatetime" style="font-size : 1em;"></span>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="col-sm-12" >
            <legend>{{Commandes}}</legend>
            <table class="table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>{{Nom}}</th>
                        <th>{{Action}}</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
foreach ($eqLogic->getCmd() as $cmd) {
	echo '<tr>';
	echo '<td>' . $cmd->getHumanName() . '</td>';
	echo '<td>';
	echo '<a class="btn btn-default btn-xs pull-right cursor bt_advanceCmdConfigurationOnEqLogicConfiguration" data-id="' . $cmd->getId() . '"><i class="fa fa-cogs"></i></a>';
	echo '</td>';
	echo '</tr>';
}
?>
               </tbody>
           </table>
       </div>
   </div>
</div>
<?php if ($eqLogic->widgetPossibility('custom')) {
	?>
    <div role="tabpanel" class="tab-pane" id="eqLogic_display">
        <br/>
        <legend><i class="fa fa-tint"></i> {{Widget}}</legend>
        <table class="table table-bordered table-condensed">
            <thead>
                <tr>
                    <th></th>
                    <?php
foreach (jeedom::getConfiguration('eqLogic:displayType') as $key => $value) {
		echo '<th>{{' . $value['name'] . '}}</th>';
	}
	?>
              </tr>
          </thead>
          <tbody>
            <?php if ($eqLogic->widgetPossibility('custom::visibility')) {
		?>
              <tr>
                <td>{{Visible}}</td>
                <?php
foreach (jeedom::getConfiguration('eqLogic:displayType') as $key => $value) {
			echo '<td>';
			if ($eqLogic->widgetPossibility('custom::visibility::' . $key)) {
				echo '<input type="checkbox" class="eqLogicAttr bootstrapSwitch" data-size="small" data-l1key="display" data-l2key="showOn' . $key . '" checked />';
			}
			echo '</td>';
		}
		?>
        </tr>
        <?php }
	?>
        <?php if ($eqLogic->widgetPossibility('custom::displayName')) {
		?>
          <tr>
            <td>{{Afficher le nom}}</td>
            <?php
foreach (jeedom::getConfiguration('eqLogic:displayType') as $key => $value) {
			echo '<td>';
			if ($eqLogic->widgetPossibility('custom::displayName::' . $key)) {
				echo '<input type="checkbox" class="eqLogicAttr bootstrapSwitch" data-size="small" data-l1key="display" data-l2key="showNameOn' . $key . '" checked />';
			}
			echo '</td>';
		}
		?>
    </tr>
    <?php }
	?>
    <?php if ($eqLogic->widgetPossibility('custom::displayObjectName')) {
		?>
      <tr>
        <td>{{Afficher le nom de l'objet}}</td>
        <?php
foreach (jeedom::getConfiguration('eqLogic:displayType') as $key => $value) {
			echo '<td>';
			if ($eqLogic->widgetPossibility('custom::displayObjectName::' . $key)) {
				echo '<input type="checkbox" class="eqLogicAttr bootstrapSwitch" data-size="small" data-l1key="display" data-l2key="showObjectNameOn' . $key . '" />';
			}
			echo '</td>';
		}
		?>
</tr>
<?php }
	?>
<?php if ($eqLogic->widgetPossibility('custom::background-color')) {
		?>
  <tr>
    <td>{{Couleur de fond}}</td>
    <?php
foreach (jeedom::getConfiguration('eqLogic:displayType') as $key => $value) {
			echo '<td>';
			if ($eqLogic->widgetPossibility('custom::background-color::' . $key)) {
				echo '<label>{{Defaut}} <input type="checkbox" class="eqLogicAttr background-color-default" data-l1key="display" data-l2key="background-color-default' . $key . '" checked /></label>';
				echo '<span class="span_configureBackgroundColor" style="display:none;" >';
				echo ' <label>{{Transparent}} <input type="checkbox" class="eqLogicAttr background-color-transparent" data-l1key="display" data-l2key="background-color-transparent' . $key . '" /></label>';
				echo ' <input type="color" class="eqLogicAttr background-color" data-l1key="display" data-l2key="background-color' . $key . '" value="' . $eqLogic->getBackgroundColor($key) . '" />';
				echo '</span>';
			}
			echo '</td>';
		}
		?>
</tr>
<?php }
	?>
<?php if ($eqLogic->widgetPossibility('custom::text-color')) {
		?>
  <tr>
    <td>{{Couleur du texte}}</td>
    <?php
foreach (jeedom::getConfiguration('eqLogic:displayType') as $key => $value) {
			echo '<td>';
			if ($eqLogic->widgetPossibility('custom::text-color::' . $key)) {
				echo '<label>{{Defaut}} <input type="checkbox" class="eqLogicAttr color-default" data-l1key="display" data-l2key="color-default' . $key . '" checked /></label>';
				echo ' <input type="color" class="eqLogicAttr color" data-l1key="display" data-l2key="color' . $key . '" value="#ffffff" style="display:none;" />';
			}
			echo '</td>';
		}
		?>
</tr>
<?php }
	?>
<?php if ($eqLogic->widgetPossibility('custom::border')) {
		?>
  <tr>
    <td>{{Bordures}}</td>
    <?php
foreach (jeedom::getConfiguration('eqLogic:displayType') as $key => $value) {
			echo '<td>';
			if ($eqLogic->widgetPossibility('custom::border::' . $key)) {
				echo '<label>{{Defaut}} <input type="checkbox" class="eqLogicAttr border-default" data-l1key="display" data-l2key="border-default' . $key . '" checked /></label>';
				echo ' <input class="eqLogicAttr border form-control inline-block pull-right" data-l1key="display" data-l2key="border' . $key . '" style="display:none;width:50%" />';
			}
			echo '</td>';
		}
		?>
</tr>
<?php }
	?>
<?php if ($eqLogic->widgetPossibility('custom::border-radius')) {
		?>
  <tr>
    <td>{{Arrondit des bordures (en px)}}</td>
    <?php
foreach (jeedom::getConfiguration('eqLogic:displayType') as $key => $value) {
			echo '<td>';
			if ($eqLogic->widgetPossibility('custom::border-radius::' . $key)) {
				echo '<label>{{Defaut}} <input type="checkbox" class="eqLogicAttr border-radius-default" data-l1key="display" data-l2key="border-radius-default' . $key . '" checked /></label>';
				echo ' <input type="number" class="eqLogicAttr border-radius form-control inline-block pull-right" data-l1key="display" data-l2key="border-radius' . $key . '" style="display:none;width:50%" />';
			}
			echo '</td>';
		}
		?>
</tr>
<?php }
	?>
</tbody>
</table>
<?php if ($eqLogic->widgetPossibility('custom::optionalParameters')) {
		?>
  <legend><i class="fa fa-pencil-square-o"></i> {{Paramètres optionnels sur la tuile}} <a class="btn btn-success btn-xs pull-right" id="bt_addWidgetParameters"><i class="fa fa-plus-circle"></i> Ajouter</a></legend>
  <table class="table table-bordered table-condensed" id="table_widgetParameters">
    <thead>
        <tr>
            <th>{{Nom}}</th>
            <th>{{Valeur}}</th>
            <th>{{Action}}</th>
        </tr>
    </thead>
    <tbody>
        <?php
if ($eqLogic->getDisplay('parameters') != '') {
			foreach ($eqLogic->getDisplay('parameters') as $key => $value) {
				echo '<tr>';
				echo '<td>';
				echo '<input class="form-control key" value="' . $key . '" />';
				echo '</td>';
				echo '<td>';
				echo '<input class="form-control value" value="' . $value . '" />';
				echo '</td>';
				echo '<td>';
				echo '<a class="btn btn-danger btn-xs removeWidgetParameter"><i class="fa fa-times"></i> Supprimer</a>';
				echo '</td>';
				echo '</tr>';
			}
		}
		?>
</tbody>
</table>
<?php }
	?>
</div>

<?php }
?>
<div role="tabpanel" class="tab-pane" id="eqLogic_battery">
 <br/>
 <legend><i class="fa fa-info-circle"></i> {{Informations}}</legend>
 <div class="alert alert-info" id="nobattery">
    {{Cet équipement ne possède pas de batterie/piles ou il n'a pas encore remonté sa valeur}}
</div>
<div id="hasbattery">
    <div class="row">
        <div class="col-sm-4" >
            <form class="form-horizontal">
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">{{Type de batterie}}</label>
                        <div class="col-sm-4">
                            <span class="eqLogicAttr label label-primary" data-l1key="configuration"data-l2key="battery_type" style="font-size : 1em;"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">{{Mis à jour le}}</label>
                        <div class="col-sm-4">
                            <span class="eqLogicAttr label label-primary" data-l1key="configuration"data-l2key="batteryStatusDatetime" style="font-size : 1em;"></span>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="col-sm-4" >
            <form class="form-horizontal">
                <fieldset>
                   <div class="form-group">
                    <label class="col-sm-4 control-label">{{Niveau de batterie}}</label>
                    <div class="col-sm-4" id="batterylevel">
                        <span class="eqLogicAttr label label-primary" data-l1key="configuration" data-l2key="batteryStatus" style="font-size : 1em;"></span>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<legend><i class="icon techno-fleches"></i> {{Seuils spécifiques}}</legend>
<div class="form-group">
    <label class="col-xs-2 eqLogicAttr label label-danger" style="font-size : 1.8em">{{Danger}}</label>
    <div class="col-xs-2">
        <input class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="battery_danger_threshold" />
    </input>
</div>
<label class="col-xs-2 label label-warning" style="font-size : 1.8em">{{Warning}}</label>
<div class="col-xs-2">
    <input class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="battery_warning_threshold" />
</div>
<label class="col-xs-2 label label-success" style="font-size : 1.8em">{{Ok}}</label>
</div>
</div>
</div>
</div>


<script>
    initCheckBox();

    $('.background-color-default').off('change switchChange.bootstrapSwitch').on('change switchChange.bootstrapSwitch',function(){
        if($(this).value() == 1){
            $(this).closest('td').find('.span_configureBackgroundColor').hide();
        }else{
            $(this).closest('td').find('.span_configureBackgroundColor').show();
        }
    });

    $('.background-color-transparent').off('change switchChange.bootstrapSwitch').on('change switchChange.bootstrapSwitch',function(){
        var td = $(this).closest('td');
        if($(this).value() == 1){
            td.find('.background-color').hide();
        }else{
            td.find('.background-color').show();
        }
        td.find('.background-color-default').trigger('switchChange.bootstrapSwitch');
    });

    $('.color-default').off('change switchChange.bootstrapSwitch').on('change switchChange.bootstrapSwitch',function(){
        var td = $(this).closest('td')
        if($(this).value() == 1){
            td.find('.color').hide();
        }else{
            td.find('.color').show();
        }
    });

    $('.border-default').off('change switchChange.bootstrapSwitch').on('change switchChange.bootstrapSwitch',function(){
        var td = $(this).closest('td')
        if($(this).value() == 1){
            td.find('.border').hide();
        }else{
            td.find('.border').show();
        }
    });

    $('.border-radius-default').off('change switchChange.bootstrapSwitch').on('change switchChange.bootstrapSwitch',function(){
        var td = $(this).closest('td')
        if($(this).value() == 1){
            td.find('.border-radius').hide();
        }else{
            td.find('.border-radius').show();
        }
    });



    $(document).ready(function() {
      if(typeof $('.eqLogicAttr[data-l1key=configuration][data-l2key=batteryStatus]').value() != null) {
         $( "#nobattery" ).show();
         $( "#hasbattery" ).hide();
     }else{
        $( "#nobattery" ).hide();
        $( "#hasbattery" ).show();
    }
});

    $('#div_displayEqLogicConfigure').setValues(eqLogicInfo, '.eqLogicAttr');
    $('#table_widgetParameters').delegate('.removeWidgetParameter', 'click', function () {
        $(this).closest('tr').remove();
    });
    if($('.eqLogicAttr[data-l1key=configuration][data-l2key=batteryStatus]').html() != '') {
      $( "#nobattery" ).hide();
      $( "#hasbattery" ).show();
  }else{
    $( "#nobattery" ).show();
    $( "#hasbattery" ).hide();
}
$('#bt_addWidgetParameters').off().on('click', function () {
    var tr = '<tr>';
    tr += '<td>';
    tr += '<input class="form-control key" />';
    tr += '</td>';
    tr += '<td>';
    tr += '<input class="form-control value" />';
    tr += '</td>';
    tr += '<td>';
    tr += '<a class="btn btn-danger btn-xs removeWidgetParameter pull-right"><i class="fa fa-times"></i> Supprimer</a>';
    tr += '</td>';
    tr += '</tr>';
    $('#table_widgetParameters tbody').append(tr);
});

$('#bt_eqLogicConfigureSave').on('click', function () {
    var eqLogic = $('#div_displayEqLogicConfigure').getValues('.eqLogicAttr')[0];
    if (!isset(eqLogic.display)) {
        eqLogic.display = {};
    }
    if (!isset(eqLogic.display.parameters)) {
        eqLogic.display.parameters = {};
    }
    $('#table_widgetParameters tbody tr').each(function () {
        eqLogic.display.parameters[$(this).find('.key').value()] = $(this).find('.value').value();
    });
    jeedom.eqLogic.save({
        eqLogics: [eqLogic],
        type: eqLogic.eqType_name,
        error: function (error) {
            $('#md_displayEqLogicConfigure').showAlert({message: error.message, level: 'danger'});
        },
        success: function () {
            $('#md_displayEqLogicConfigure').showAlert({message: '{{Enregistrement réussi}}', level: 'success'});
        }
    });
});

$('#bt_eqLogicConfigureRemove').on('click',function(){
    bootbox.confirm('{{Etes-vous sûr de vouloir supprimer cet équipement ?}}', function (result) {
        if (result) {
            var eqLogic = $('#div_displayEqLogicConfigure').getValues('.eqLogicAttr')[0];
            jeedom.eqLogic.remove({
                id : eqLogic.id,
                type : eqLogic.eqType_name,
                error: function (error) {
                    $('#md_displayEqLogicConfigure').showAlert({message: error.message, level: 'danger'});
                },
                success: function (data) {
                    $('#md_displayEqLogicConfigure').showAlert({message: '{{Suppression réalisée avec succès}}', level: 'success'});
                }
            });
        }
    });
});

$('.bt_advanceCmdConfigurationOnEqLogicConfiguration').off('click').on('click', function () {
    $('#md_modal2').dialog({title: "{{Configuration de la commande}}"});
    $('#md_modal2').load('index.php?v=d&modal=cmd.configure&cmd_id=' + $(this).attr('data-id')).dialog('open');
});


</script>