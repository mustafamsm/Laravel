<?php
/**
 * Created by PhpStorm.
 * User: tsc
 * Date: 02/08/22
 * Time: 06:49 م
 */
namespace App\Traits;

Trait OfferTrait{
      function saveImage($photo,$folder){
        $file_extension=$photo->getClientOriginalExtension();
        $file_name=time().'.'.$file_extension;
        $path=$folder;
        $photo->move($path,$file_name);
        return $file_name;
    }
}