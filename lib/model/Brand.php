<?
class Brand extends VehicleBaseModel{
  public $unset_from_top = array('Model'=>array('models'), 'Derivative'=>array('models'));

  public function setup(){
    parent::setup();
    //remove categories & media
    unset($this->columns['categories'], $this->columns['excerpt']);
    $this->define("models", 'ManyToManyField', array('target_model'=>'Model', 'group'=>'relationships'));
  }

  public function before_save(){
    if(!$this->title) $this->title = "BRAND";
  }
}
?>