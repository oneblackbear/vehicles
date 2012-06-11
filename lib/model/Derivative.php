<?
class Derivative extends VehicleBaseModel{
  public $identifier = "model_title";
  public $unset_from_top = array('Model'=>array('models'), 'Brand'=>array('models'));
  public function setup(){
    parent::setup();
    $this->define("model_title", "CharField");
    $this->define("url", "CharField", array('editable'=>false));
    
    //link to the model
    $this->define("models", "ManyToManyField", array('target_model'=>'Model', 'group'=>'relationships', 'scaffold'=>true));
    $this->define("details", "ManyToManyField", array('target_model'=>'InformationGroup', 'group'=>'relationships'));
    $this->define("accessories", "ManyToManyField", array('target_model'=>'Accessory', 'group'=>'relationships'));
    $this->define("colours", "ManyToManyField", array('target_model'=>'VehicleColour', 'group'=>'relationships'));
  }

  public function before_save(){
    parent::before_save();
    if(!$this->model_title && $this->title){
      if(($models = $this->models) && ($model = $models->first())) $this->model_title .= $model->title." ".$this->title;
    }
    if(!$this->url) $this->url = Inflections::to_url($this->title);;
    

  }
  
  
  

}
?>