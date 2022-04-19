<?php

namespace App\Data;

use App\Entity\Movie;

class SearchData
{

   /**
    * @var string
    */ 
   public $q = ''; 

   /**
    * @var Genres[]
    */
    public $genres = [];

    /**
     * @var null|integer
     */
     public $annéeMin;

     /**
     * @var null|integer
     */
    public $annéeMax;


}