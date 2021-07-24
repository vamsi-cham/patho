<?php
// Cross Origin Access
require('config/cors.php');
require('config/connection.php');

$lab_id=$_POST["lab_id"];
$approval=$_POST["approval"];
$action=$_POST["action"];
$tb=$_POST["tb"];

$invalid="Not Found";
$error="An Error Occurred";

if($action=="getcustomers"){

    $sql="SELECT * FROM `$tb` WHERE lab_id=$lab_id and approval='$approval' ";
    $result = $conn->query($sql); 
    if($result){// run query
        $db_data = array();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $db_data[] = $row;
            }
         // Send back the complete records as a json

         $param=[
             'status'=>200,
             'message'=>"success",
             'data'=>$db_data,
         ];
            echo json_encode($param);
        }else{

            $param=[
                'status'=>201,
                'message'=>$invalid,
                'data'=>[],
            ];
            echo json_encode($param);

        }
    }else{

        $param=[
            'status'=>500,
            'message'=>'error',
            'data'=>[],
        ];

        echo json_encode($param);
    }
}

$conn->close();

?>