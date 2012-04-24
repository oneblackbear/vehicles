<?
class VehicleBaseModel extends WildfireContent{
  public $unset_from_top = array();

  public function setup(){
    parent::setup();
    $this->columns['status'][1]['group'] = 'status';
    $this->columns['status'][1]['editable'] = true;
  }

  public function get_keys($top_level=false, $called_stack=array()){
    $keys = $this->columns;
    unset($keys['parent'],
          $keys['children'],
          $keys['auth_token'],
          $keys['permalink'],
          $keys['author']
          );
    if($unset = $this->unset_from_top[$top_level]) foreach($unset as $column) unset($keys[$column]);
    return $keys;
  }
  public function api_cols($top_level=false, $stack){
    $col_names = array_keys($this->get_keys($top_level, $stack));
    return $col_names;
  }

  public function css_selector(){
    return str_replace("/", "-", Inflections::to_url(strip_tags($this->title), "/"));
  }
}
?>