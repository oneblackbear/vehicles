<?
class Model extends VehicleBaseModel{
  public $unset_from_top = array('Brand'=>array('brands'));
  public function setup(){
    parent::setup();
    //remove categories & media
    unset($this->columns['categories']);
    $this->define("brands", "ManyToManyField", array('target_model'=>'Brand', 'group'=>'relationships'));
    $this->define("derivatives", "ManyToManyField", array('target_model'=>'Derivative', 'group'=>'relationships'));
  }

}
?>