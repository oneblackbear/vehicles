<?php
class AdminAccessoryController extends AdminComponent{
  public $module_name = "accessory";
  public $model_class = 'Accessory';
  public $display_name = "Accessories";
  public $dashboard = false;
  public $tree_layout = false;
  public $filter_fields=array(
                          'text' => array('columns'=>array('title', 'part_number', 'dealer_price', 'retail_price'), 'partial'=>'_filters_text', 'fuzzy'=>true),
                          'language' => array('columns'=>array('language'), 'partial'=>"_filters_language"),
                          'derivatives' => array('columns'=>array('derivatives'), 'partial'=>'_filters_select', 'opposite_join_column'=>'accessories'),
                        );
}
?>