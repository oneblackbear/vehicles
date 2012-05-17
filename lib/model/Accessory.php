<?
class Accessory extends VehicleBaseModel{
  public static $times = array(''=>'-- select --','0.25'=>0.25, '0.50'=>0.5, '0.75'=>0.75, 1=>'1.00', '1.25'=>'1.25', '1.50'=>'1.50', '1.75'=>'1.75', '2.00'=>2.00, '2.25'=>'2.25', '2.50'=>'2.50', '2.75'=>'2.75', '3.00'=>'3.00');
  public $unset_from_top = array('Brand'=>array('derivatives'), 'Model'=>array('derivatives'), 'Derivative'=>array('derivatives'));
  public function setup(){
    parent::setup();

    $this->define("part_number", 'CharField', array('scaffold'=>true));
    $this->define("dealer_price", 'CharField');
    $this->define("retail_price", 'CharField', array('scaffold'=>true)); //excluding VAT

    $this->define("fitting_time", 'CharField', array('widget'=>'SelectInput', 'choices'=>self::$times));
    $this->define("components", 'TextField');

    $this->define("derivatives", "ManyToManyField", array('target_model'=>'Derivative', 'group'=>'relationships', 'scaffold'=>true));
  }


}
?>