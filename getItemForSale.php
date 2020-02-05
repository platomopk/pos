<?php
//json format
header('Content-type:Application/json');
//including db
include 'db_connect.php';

if(isset($_GET['itemId']))
    { $itemId=$_GET['itemId']; } 

    $query= mysqli_query($con,
    "SELECT 
bank.itemId,
bank.itemName,
(bank.count - (SELECT IFNULL(SUM(sold.count),'0') FROM sold WHERE sold.itemId=bank.itemId)) as count,
(case when (bank.revisedWeight != 'empty') THEN ABS(bank.revisedWeight - (SELECT IFNULL(sum(sold.weight),'0') FROM sold WHERE sold.itemId=bank.itemId) ) ELSE ABS(bank.weight - (SELECT IFNULL(sum(sold.weight),'0') FROM sold WHERE   sold.itemId=bank.itemId))  END) as weight,
bank.unitsalesprice as unitPrice
FROM bank WHERE (bank.itemId='$itemId' or bank.itemName='$itemId') and (((bank.count - (SELECT IFNULL(SUM(sold.count),'0') FROM sold WHERE sold.itemId=bank.itemId))>0) or ((case when (bank.revisedWeight != 'empty') THEN ABS(bank.revisedWeight - (SELECT IFNULL(sum(sold.weight),'0') FROM sold WHERE sold.itemId=bank.itemId) ) ELSE ABS(bank.weight - (SELECT IFNULL(sum(sold.weight),'0') FROM sold WHERE   sold.itemId=bank.itemId))  END)>0))");
  
//making an array
$rows=array();
//filling that array
while($row=mysqli_fetch_assoc($query))
{
	$rows[]=$row;
}
//encoding that array
$json= json_encode($rows);
//prettifying that array
$pretty_json= pretty_json($json);
//echoing that prettified array
echo $pretty_json;

//function to pritify json data
function pretty_json($json) {
    $result      = '';
    $pos         = 0;
    $strLen      = strlen($json);
    $indentStr   = '  ';
    $newLine     = "\n";
    $prevChar    = '';
    $outOfQuotes = true;
 
    for ($i=0; $i<=$strLen; $i++) {
 
        // Grab the next character in the string.
        $char = substr($json, $i, 1);
 
        // Are we inside a quoted string?
        if ($char == '"' && $prevChar != '\\') {
            $outOfQuotes = !$outOfQuotes;
 
        // If this character is the end of an element, 
        // output a new line and indent the next line.
        } else if(($char == '}' || $char == ']') && $outOfQuotes) {
            $result .= $newLine;
            $pos --;
            for ($j=0; $j<$pos; $j++) {
                $result .= $indentStr;
            }
        }
 
        // Add the character to the result string.
        $result .= $char;
 
        // If the last character was the beginning of an element, 
        // output a new line and indent the next line.
        if (($char == ',' || $char == '{' || $char == '[') && $outOfQuotes) {
            $result .= $newLine;
            if ($char == '{' || $char == '[') {
                $pos ++;
            }
 
            for ($j = 0; $j < $pos; $j++) {
                $result .= $indentStr;
            }
        }
 
        $prevChar = $char;
    }
 
    return $result;
}




?>