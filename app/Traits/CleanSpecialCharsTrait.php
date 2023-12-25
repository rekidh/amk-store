<?php

namespace App\Traits;

trait CleanSpecialCharsTrait
{
   private function cleanSpecialChars($input)
   {
      return preg_replace('/[^a-zA-Z0-9.,\s]/', '', $input);
   }
   private function cleanedPrice($input)
   {
      return preg_replace('/[A-Za-z]|,|(\.[0]{2})/', '', $input);
   }
}
