<?php
//controller for displaying media
class ColourController extends WaxController{

  //should accept either all or part of the hash column to show the file, this is what show will be used for
  public function method_missing(){
    $route = get("route");
    $path_parts = pathinfo($route);
    $dirname = $path_parts['dirname'];
    $filename = $path_parts['filename'];

    $extension = $path_parts['extension'];
    $asset = new VehicleColourAsset($dirname.".".$extension);
    $asset->show($filename);
    exit;
  }



}