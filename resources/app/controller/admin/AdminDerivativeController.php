<?php
class AdminDerivativeController extends AdminComponent{
  public $module_name = "derivative";
  public $model_class = 'Derivative';
  public $display_name = "Derivatives";
  public $dashboard = false;
  public $tree_layout = false;
  public $filter_fields=array(
                          'text' => array('columns'=>array('title'), 'partial'=>'_filters_text', 'fuzzy'=>true),
                          'models' => array('columns'=>array('models'), 'partial'=>'_filters_select', 'opposite_join_column'=>'derivatives'),
                          'language' => array('columns'=>array('language'), 'partial'=>"_filters_language")
                        );
}
?>