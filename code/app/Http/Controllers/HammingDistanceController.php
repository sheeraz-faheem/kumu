<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;

class HammingDistanceController extends BaseController
{
    /**
     * Compute hamming distance
     */
    public function hammingDistance(Request $request): int
    {
        $input = $request->input();
        $setBits = 0;

        // XOR
        $x = (int) $input['a'] ^ (int) $input['b'];
        
        while ($x > 0) {
            // AND
            $setBits += $x & 1;

            // SHIFT LEFT
            $x = $x >> 1;
        }
    
        return $setBits;
    }

}