<?php
class VehicleColour extends WaxModel{
  
  public $identifier = "internal_title";
  public $base_url = "public/files/vehicles/";
  

  public function setup(){
    $this->define("title", "CharField", array('required'=>true, 'scaffold'=>true));
    $this->define("internal_title", "CharField", array('required'=>true, 'scaffold'=>true));
    $this->define("rgb_value", "CharField", array('scaffold'=>true));
    $this->define("price_modifier", "CharField", array("default"=>"0"));
    $this->define("base_image_folder", "CharField", array("group"=>"Folders"));
    $this->define("front_folder", "CharField", array("default"=>"Front","group"=>"Folders"));
    $this->define("side_folder", "CharField", array("default"=>"Side","group"=>"Folders"));
    $this->define("rear_folder", "CharField", array("default"=>"Rear","group"=>"Folders"));
    $this->define("360_folder", "CharField", array("default"=>"360","group"=>"Folders"));

    $this->define("url", "CharField", array('editable'=>false));
    $this->define("sort", "IntegerField", array('maxlength'=>3, 'default'=>0, 'widget'=>"HiddenInput", 'group'=>'advanced'));
    $this->define("derivatives", "ManyToManyField", array('target_model'=>'Derivative', 'group'=>'relationships'));
    
  }
  
  public function before_save() {
    if(!$this->url) $this->url = Inflections::to_url($this->title);;
    if(!$this->image_folder) $this->url = Inflections::to_url($this->title);;
    
  }
  
  public function images($type="front") {
    if(!count($this->derivatives)) return FALSE;
    $model_url = $this->derivatives[0]->models[0]->url;
    $der_url =  $this->derivatives[0]->url;
    $folder = $type."_folder";
    $files = preg_grep('/^([^.])/', scandir(PUBLIC_DIR.$this->base_url.$model_url."/".$der_url."/".$this->url."/".$this->$folder));
    $file_objects = array();
    foreach($files as $file) {
      $file_objects[] = new VehicleColourAsset($file);
    }
    return $file_objects;
  }
  
  
  

}
?>
