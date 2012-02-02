<?
class Accessory extends VehicleBaseModel{
  public $unset_from_top = array('Brand'=>array('derivatives'), 'Model'=>array('derivatives'), 'Derivative'=>array('derivatives'));
  public function setup(){
    parent::setup();

    $this->define("part_number", 'CharField', array('scaffold'=>true));
    $this->define("dealer_price", 'CharField');
    $this->define("retail_price", 'CharField', array('scaffold'=>true)); //excluding VAT

    $this->define("fitting_time", 'TextField');
    $this->define("fitting_instructions", 'TextField');
    $this->define("components", 'TextField');

    $this->define("derivatives", "ManyToManyField", array('target_model'=>'Derivative', 'group'=>'relationships', 'scaffold'=>true));
  }


}
?>