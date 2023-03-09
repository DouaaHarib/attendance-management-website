<?php
$EST = simplexml_load_file('../../data/database.xml');$id=array();
// $id=array();
// foreach ($EST->absences->absence as $absence) {
//     $id[]=$absence['id'];
// } 
//     foreach($id as $id){
//         echo $id;
//     }
//     echo max($id);


$values = array();
foreach ($EST->absences->absence as $element) {
    $values[] = (int) $element['id'];
}

$max_value = max($values);

echo "The maximum value is: " . $max_value;
    
?>