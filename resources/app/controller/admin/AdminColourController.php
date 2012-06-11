<?php
class AdminDerivativeController extends AdminComponent{
  public $module_name = "colour";
  public $model_class = 'VehicleColour';
  public $display_name = "Colours";
  public $dashboard = false;
  public $tree_layout = false;
  public $filter_fields=array(
                          'text' => array('columns'=>array('title'), 'partial'=>'_filters_text', 'fuzzy'=>true),
                          'models' => array('columns'=>array('models'), 'partial'=>'_filters_select', 'opposite_join_column'=>'derivatives')
                        );
}
?>
