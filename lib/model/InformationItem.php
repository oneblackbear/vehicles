<?
class InformationItem extends WaxModel{

  public $unset_from_top = array('Model'=>array('groups'), 'Brand'=>array('groups'), 'Derivative'=>array('groups'));
  public function setup(){
    $this->define("title", "CharField", array('required'=>true, 'scaffold'=>true));
    $this->define("value", "CharField", array('scaffold'=>true));
    $this->define("extra", "CharField"); //used for things like colours that need RGB & price
    $this->define("content", "TextField", array('widget'=>"TinymceTextareaInput"));
    $this->define("groups", "ManyToManyField", array('target_model'=>'InformationGroup', 'group'=>'relationships', 'scaffold'=>true));
    //this is so any piece of info can have images etc to go with it
    //planned to be used to derivative->detail(colour)->image
    $this->define("media", "ManyToManyField", array('target_model'=>"WildfireMedia", "eager_loading"=>true, "join_model_class"=>"WildfireOrderedTagJoin", "join_order"=>"join_order", 'group'=>'media'));
    parent::setup();
  }

  public function before_save(){
    if(!$this->title) $this->title = "ITEM";
    if($this->columns['content']) $this->content =  CmsTextFilter::filter("before_save", $this->content);
  }

  public function get_keys($top_level=false, $called_stack=array()){
    $keys = $this->columns;
    if($unset = $this->unset_from_top[$top_level]) foreach($unset as $column) unset($keys[$column]);
    return $keys;
  }
  public function api_cols($top_level=false, $stack){
    $col_names = array_keys($this->get_keys($top_level, $stack));
    return $col_names;
  }

}
?>