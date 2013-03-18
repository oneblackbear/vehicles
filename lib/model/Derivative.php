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

  /*
   * this loops over filters and fills data array with these
   * the filters should look like
   * array( group_title => array( item_titles ), group_title => array( item_titles ), ... )
   */
  public function get_data($groups_filter){
    $data = array();
    foreach($groups_filter as $group_filter=>$items_filter){
      if($group_filter) $details_filter = array("title"=>$group_filter);
      foreach($this->details($details_filter) as $group){
        if($items_filter) $item_filter = array("title"=>$items_filter);
        foreach($group->items($item_filter) as $item){
          $data[$group->title][$item->title][$this->id] = $item;
        }
      }
    }
    return $data;
  }
  

}
?>