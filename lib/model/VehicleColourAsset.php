<?php

class VehicleColourAsset {
  
  public $url              = FALSE;
  public $dirname          = FALSE;
  public $filename         = FALSE;
  public $extension        = FALSE;
  public $controller_url   = "colour";

  public function __construct($url) {
    $this->url = $url;
    $path_parts = pathinfo($url);
    $this->dirname = $path_parts['dirname'];
    $this->filename = $path_parts['filename'];
    $this->extension = $path_parts['extension'];
  }
  
  //should return a url to display the image
  public function get($size=false){
    return "/".$this->controller_url."/".$this->dirname."/".$this->filename."_".$size.".".$this->extension;
  }
  
  
  //this will actually render the contents of the image
  public function show($size=false){
    if(!$size) $size = 100; //default size
    $cache_file = PUBLIC_DIR.$this->get($size);
    if(!is_readable($dir)) mkdir($dir, 0777, true);
    if(!is_readable($cache_file)) File::smart_resize_image(PUBLIC_DIR.$this->get($size), $cache_file, $size, false, "nocrop");
    File::display_image($cache_file);
  }
  //generates the tag to be displayed - return generic icon if not an image
  public function render($size, $title="preview"){
    return "<img src='".$this->get($size)."' alt='".$title."'>";
  }
  

}



