<?php
if (!function_exists('generateQuoteNo')) {
    function generateQuoteNo($id){
        return "Quote-".time().'-'.$id;
    }
}
