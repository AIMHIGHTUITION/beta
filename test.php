<?php 	
$cntCorrectAnswer = count(explode(",", "ee,e"));
$prodId = "ee,00";
echo strlen($prodId) ? count(explode(',', $prodId)) : 0;
//echo $cntCorrectAnswer;
?>