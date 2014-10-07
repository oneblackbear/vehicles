<?
class InformationItem extends WaxModel{

  public $unset_from_top = array('Model'=>array('groups'), 'Brand'=>array('groups'), 'Derivative'=>array('groups'));
  public function setup(){
    $this->define("title", "CharField", array('required'=>true, 'scaffold'=>true, 'group'=>'content', 'primary_group'=>1));
    $this->define("value", "CharField", array('scaffold'=>true, 'group'=>'content', 'primary_group'=>1));
    $this->define("extra", "CharField"); //used for things like colours that need RGB & price
    $this->define("content", "TextField", array('widget'=>"TinymceTextareaInput"));
    $this->define("groups", "ManyToManyField", array('target_model'=>'InformationGroup', 'group'=>'relationships', 'scaffold'=>true));
    //this is so any piece of info can have images etc to go with it
    //planned to be used to derivative->detail(colour)->image
    $this->define("media", "ManyToManyField", array('target_model'=>"WildfireMedia", "eager_loading"=>true, "join_model_class"=>"WildfireOrderedTagJoin", "join_order"=>"join_order", 'group'=>'media', 'primary_group'=>1));
    $this->define("featured", "BooleanField");
    $this->define("url", "CharField", array('editable'=>false));
    $this->define("sort", "IntegerField", array('maxlength'=>6, 'default'=>0, 'widget'=>"HiddenInput"));
    parent::setup();
  }

  public function before_save(){
    if(!$this->title) $this->title = "ITEM";
    if($this->title != "ITEM" && !$this->url) $this->url = Inflections::to_url($this->title);;
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

   //this will need updating when the framework can handle manipulating join columns
  public function file_meta_set($fileid, $tag, $order=0, $title=''){
    $model = new WaxModel;
    if($this->table < "wildfire_media") $model->table = $this->table."_wildfire_media";
    else $model->table = "wildfire_media_".$this->table;

    $col = $this->table."_".$this->primary_key;
    if(!$order) $order = 0;
    if(($found = $model->filter($col, $this->primval)->filter("wildfire_media_id", $fileid)->all()) && $found->count()){
      foreach($found as $r){
        $sql = "UPDATE `".$model->table."` SET `join_order`=$order, `tag`='$tag', `title`='$title' WHERE `id`=$r->primval";
        $model->query($sql);
      }
    }else{
      $sql = "INSERT INTO `".$model->table."` (`wildfire_media_id`, `$col`, `join_order`, `tag`, `title`) VALUES ('$fileid', '$this->primval', '$order', '$tag', '$title')";
      $model->query($sql);
    }
  }
  public function file_meta_get($fileid=false, $tag=false){
    $model = new WaxModel;
    if($this->table < "wildfire_media") $model->table = $this->table."_wildfire_media";
    else $model->table = "wildfire_media_".$this->table;
    $col = $this->table."_".$this->primary_key;
    if($fileid) return $model->filter($col, $this->primval)->filter("wildfire_media_id", $fileid)->order('join_order ASC')->first();
    elseif($tag=="all") return $model->filter($col, $this->primval)->order('join_order ASC')->all();
    elseif($tag) return $model->filter($col, $this->primval)->filter("tag", $tag)->order('join_order ASC')->all();
    else return false;
  }

}
?>
