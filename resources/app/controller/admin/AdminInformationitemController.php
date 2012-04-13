<?php
class AdminInformationitemController extends AdminComponent{
  public $module_name = "informationitem";
  public $model_class = 'InformationItem';
  public $display_name = "Information Items";
  public $dashboard = false;
  public $tree_layout = false;
  public $sortable = false;
  public $sort_scope = "live";
  public $filter_fields=array(
                          'text' => array('columns'=>array('title', 'value'), 'partial'=>'_filters_text', 'fuzzy'=>true),
                          'groups' => array('columns'=>array('groups'), 'partial'=>'_filters_select', 'opposite_join_column'=>'items'),
                          'language' => array('columns'=>array('language'), 'partial'=>"_filters_language")
                        );
}
?>