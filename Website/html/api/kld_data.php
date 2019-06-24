<?php
    $event=$_GET['event']; //event number
    $temp="'";
    header( 'Content-Type: application/json' );
    //credentials
    $host = "act4dgem.cse.iitd.ac.in"; 
    $user = "debanjan_final"; 
    $pass = "Deb@12345"; 
    $db = "debanjan_media_database";
    //error handling
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $db_connection = pg_connect ("host=$host port=5432 dbname=$db user=$user password=$pass connect_timeout=5")or die("error");
    if (!$db_connection) { 
        echo "error"; 
      }
   //necessary queries
    $main_query='SELECT * FROM public.kl_div_result WHERE event_id='. $event .'';
    $main_result = pg_query($db_connection,$main_query);


    if ( !$main_result ) {
      $message  = 'Invalid query: ' . $db_connection->error . "n";
      $message .= 'Whole query: ' . $main_query;
      die( $message );
    }


   //data generation
    $data1 = array();

    while ( $row1 = pg_fetch_row($main_result) ) {
      $data1[] = $row1;
    }

    $data = array();
    $n= count($data1);

    
    for ($i = 0; $i < $n; $i++) {
      $data[$i][0]=$data1[$i][1];
      $data[$i][1]=$data1[$i][2];
  
    }
    for ($i = 0; $i < $n; $i++) {
      for ($j=1; $j < $n-$i ; $j++){
        if ($data[$j-1][1]>$data[$j][1]){
          $temporary=$data[$j-1];
          $data[$j-1]=$data[$j];
          $data[$j]=$temporary;
        }
      }
    }


    //JSON   
    echo json_encode( $data );   
    //END CONNECTION 
    pg_free_result($main_result);
    pg_close($db_connection);
?>
