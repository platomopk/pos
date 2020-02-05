<?php
//json format
header('Content-type:Application/json');
//including db
include 'db_connect.php';

if(isset($_GET['itemId']))
    { $itemId=$_GET['itemId']; } 

    $query= mysqli_query($con,
    "select *, date(addedOn) as addedOnRefined, (case when (revisedWeight!='empty') then (revisedWeight-(SELECT IFNULL(sum(weight),'0') from sold where sold.itemId=bank.itemId)) else (weight-(SELECT IFNULL(sum(weight),'0') from sold where sold.itemId=bank.itemId)) end) as remaining, (SELECT SUM((sold.weight)) FROM sold WHERE sold.itemId=bank.itemId) as sold, (SELECT ifnull(sum(wastage.wasted),0) from wastage WHERE wastage.itemId=bank.itemId) as wasted from bank where itemId='$itemId'");
  
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