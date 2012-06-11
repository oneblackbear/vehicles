<?
CMSApplication::register_module("brand", array("display_name"=>"Brands", "link"=>"/admin/brand/"));
CMSApplication::register_module("model", array("display_name"=>"Models", "link"=>"/admin/model/"));
CMSApplication::register_module("derivative", array("display_name"=>"Derivatives", "link"=>"/admin/derivative/"));
CMSApplication::register_module("colour", array("display_name"=>"Colours", "link"=>"/admin/colour/", 'split'=>true));
CMSApplication::register_module("informationgroup", array("display_name"=>"Information Groups", "link"=>"/admin/informationgroup/"));
CMSApplication::register_module("informationitem", array("display_name"=>"Information Items", "link"=>"/admin/informationitem/", 'split'=>true));
CMSApplication::register_module("accessory", array("display_name"=>"Accessories", "link"=>"/admin/accessory/", 'split'=>true));
?>