<?php

session_start();


if(!isset($_SESSION['ID'])){
    header("Location: ../../index.php");
}





include_once '../dbconn.php';
require_once __DIR__ . '../../../vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();
date_default_timezone_set('Asia/Manila');

/* Prepared statement, stage 1: prepare */
$today = date("Y-m-d"); 

$get_admitted_stmt = $connection->prepare("SELECT * FROM tbl_admission where date = ?;");

/* Prepared statement, stage 2: bind and execute */
$get_admitted_stmt->bind_param("s", $today); // "is" means that $id is bound as an integer and $label as a string
$get_admitted_stmt->execute();
$admitted_result = $get_admitted_stmt->get_result();




$get_discharge_stmt = $connection->prepare("SELECT * FROM tbl_discharge where date = ? and disposition = 'discharge';");

/* Prepared statement, stage 2: bind and execute */
$get_discharge_stmt->bind_param("s", $today); // "is" means that $id is bound as an integer and $label as a string
$get_discharge_stmt->execute();
$discharge_result = $get_discharge_stmt->get_result();



$get_transferred_stmt = $connection->prepare("SELECT * FROM tbl_discharge where date = ? and disposition = 'transferred';");

/* Prepared statement, stage 2: bind and execute */
$get_transferred_stmt->bind_param("s", $today); // "is" means that $id is bound as an integer and $label as a string
$get_transferred_stmt->execute();
$transferred_result = $get_transferred_stmt->get_result();

$get_hama_stmt = $connection->prepare("SELECT * FROM tbl_discharge where date = ? and disposition = 'hama';");

/* Prepared statement, stage 2: bind and execute */
$get_hama_stmt->bind_param("s", $today); // "is" means that $id is bound as an integer and $label as a string
$get_hama_stmt->execute();
$hama_result = $get_hama_stmt->get_result();

$get_absconded_stmt = $connection->prepare("SELECT * FROM tbl_discharge where date = ? and disposition = 'absconded';");

/* Prepared statement, stage 2: bind and execute */
$get_absconded_stmt->bind_param("s", $today); // "is" means that $id is bound as an integer and $label as a string
$get_absconded_stmt->execute();
$absconded_result = $get_absconded_stmt->get_result();

$get_alive_stmt = $connection->prepare("SELECT * FROM tbl_discharge where date = ? and disposition != 'died';");

/* Prepared statement, stage 2: bind and execute */
$get_alive_stmt->bind_param("s", $today); // "is" means that $id is bound as an integer and $label as a string
$get_alive_stmt->execute();
$alive_result = $get_alive_stmt->get_result();

$get_died_stmt = $connection->prepare("SELECT * FROM tbl_discharge where date = ? and disposition = 'died';");

 /* Prepared statement, stage 2: bind and execute */
$get_died_stmt->bind_param("s", $today); // "is" means that $id is bound as an integer and $label as a string
$get_died_stmt->execute();
$died_result = $get_died_stmt->get_result();

$get_total_discharge_stmt = $connection->prepare("SELECT * FROM tbl_discharge where date = ?;");

/* Prepared statement, stage 2: bind and execute */
$get_total_discharge_stmt->bind_param("s", $today); // "is" means that $id is bound as an integer and $label as a string
$get_total_discharge_stmt->execute();
$total_discharge_result = $get_total_discharge_stmt->get_result();


$id = $_SESSION['ID'];

$get_account_stmt = $connection->prepare("SELECT * FROM tbl_accounts where acc_id = ?;");

/* Prepared statement, stage 2: bind and execute */
$get_account_stmt->bind_param("s", $id); // "is" means that $id is bound as an integer and $label as a string
$get_account_stmt->execute();
$account = $get_account_stmt->get_result();
$account_row = $account->fetch_assoc();


// Write some HTML code:
    $mpdf->WriteHTML('
    <div  style="position:relative;">
    <table style="width:100%">
        <tr>
        <td><img src="..\..\images\ofelia_logo.png" style="width:30mm; font-weight: bold;" /></td>
        <td style="text-align:Center; font-family:arial; ">OFELIA L. MENDOZA MATERNITY AND GENERAL HOSPITAL <br/>
                                            MOJON, CITY OF MALOLOS, BULACAN <br/>
                                                TEL NO. (044)794-7113
                                                    <hr></td>
        </tr>
    </table>
    </div>
    <caption style="font-family:sans-serif; font-size:20px; padding:30px;">Admission and Discharge Census</caption>
    <table border=1 style="width:100%; white-space: nowrap; border-collapse: collapse; text-align:center; font-family:sans-serif;">

            <tr>
                <th style="padding: 10px; color: white; background-color: rgb(27, 73, 101);">Available Census Today</th>
                <th style="padding: 10px; color: white; background-color: rgb(27, 73, 101);">Count</th>
            </tr>
            <tr>
                <td style="padding: 10px; color: white;">...</td>
                <td style="padding: 10px; color: white;">...</td>
            </tr>
            <tr>
                <td style="padding: 10px; text-align:left; font-weight: bolder; background-color: rgb(190, 233, 232);"><strong>Total Admission</strong></td>
                <td style="padding: 10px; text-align:left; font-weight: bolder; background-color: rgb(190, 233, 232);">'.$admitted_result->num_rows.'</td>
            </tr>

            <tr>
                <td style="padding: 10px; color: white;">...</td>
                <td style="padding: 10px; color: white;">...</td>
            </tr>

            <tr>
                <td style="padding: 10px; text-align:left;">Discharge (Discharge)</td>
                <td style="padding: 10px; text-align:left;">'.$discharge_result->num_rows.'</td>
            </tr>
            <tr>
                <td style="padding: 10px; text-align:left;">Discharge (Transferred)</td>
                <td style="padding: 10px; text-align:left;">'.$transferred_result->num_rows.'</td>
            </tr>
            <tr>
                <td style="padding: 10px; text-align:left;">Discharge (HAMA)</td>
                <td style="padding: 10px; text-align:left;">'.$hama_result->num_rows.'</td>
            </tr>
            <tr>
                <td style="padding: 10px; text-align:left;">Discharge (Absconded)</td>
                <td style="padding: 10px; text-align:left;">'.$absconded_result->num_rows.'</td>
            </tr>
            <tr>
                <td style="padding: 10px; text-align:left;"><strong>Discharges (Alive)</strong></td>
                <td style="padding: 10px; text-align:left;">'.$alive_result->num_rows.'</td>
            </tr>
            <tr>
                <td style="padding: 10px; text-align:left;"><strong>Discharges (Deaths)</strong></td>
                <td style="padding: 10px; text-align:left;">'.$died_result->num_rows.'</td>
            </tr>
            <tr>
                <td style="padding: 10px; text-align:left; font-weight: bolder; background-color: rgb(190, 233, 232);"><strong>Total Discharges</strong></td>
                <td style="padding: 10px; text-align:left; font-weight: bolder; background-color: rgb(190, 233, 232);">'.$total_discharge_result->num_rows.'</td>
            </tr>
            
        </table>
    '
    );



    $arr = array (
        'odd' => array (
          'L' => array (
            'content' => $account_row['first_name'].' '.$account_row['last_name'],
            'font-size' => 10,
            'font-style' => 'B',
            'font-family' => 'serif',
            'color'=>'#000000'
          ),
          'C' => array (
            'content' => '1/1',
            'font-size' => 10,
            'font-style' => 'B',
            'font-family' => 'serif',
            'color'=>'#000000'
          ),
          'R' => array (
            'content' => $today,
            'font-size' => 10,
            'font-style' => 'B',
            'font-family' => 'serif',
            'color'=>'#000000'
          ),
          'line' => 1,
        ),
        'even' => array ()
      );
      
      $mpdf->SetFooter($arr);
// Output a PDF file directly to the browser
$mpdf->Output();



?>