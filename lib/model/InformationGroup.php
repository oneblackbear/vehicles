<?
class InformationGroup extends VehicleBaseModel{

  public $identifier = "internal_title";
  public $unset_from_top = array('Brand'=>array('derivatives'), 'Model'=>array('derivatives'), 'Derivative'=>array('derivatives'));

  public function setup(){
    $this->define("internal_title", "CharField", array('required'=>true, 'scaffold'=>true, 'label'=>'Name (internal use only)'));
    parent::setup();
    unset($this->columns['categories'], $this->columns['content'], $this->columns['media'], $this->columns['excerpt']);
    $this->define("derivatives", "ManyToManyField", array('target_model'=>'Derivative', 'group'=>'relationships', 'scaffold'=>true));
    $this->define("items", "ManyToManyField", array('target_model'=>'InformationItem', 'group'=>'relationships'));
  }

}
?>