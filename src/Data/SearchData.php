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
     public $anneeMin;

     /**
     * @var null|integer
     */
    public $anneeMax;


}