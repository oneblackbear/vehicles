<?php
class AdminInformationgroupController extends AdminComponent{
  public $module_name = "informationgroup";
  public $model_class = 'InformationGroup';
  public $display_name = "Information Groups";
  public $dashboard = false;
  public $sortable = false;
  public $sort_scope = "live";
  public $tree_layout = false;
  public $filter_fields=array(
                          'text' => array('columns'=>array('title', 'internal_title'), 'partial'=>'_filters_text', 'fuzzy'=>true),
                          'derivatives' => array('columns'=>array('derivatives'), 'partial'=>'_filters_select', 'opposite_join_column'=>'details'),
                          'language' => array('columns'=>array('language'), 'partial'=>"_filters_language")
                        );
}
?>