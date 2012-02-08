<?php
class AdminComponent extends CMSAdminComponent{
  public $operation_actions = array('edit', 'duplicate');
  public function duplicate(){
    $this->redirect_to("/".trim($this->controller,"/")."/copy/?source=".Request::get("id"));
  }
}
?>
