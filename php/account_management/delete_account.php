<?php


include_once '../dbconn.php';

$delete = $_POST['delete'];

 /* Prepared statement, stage 1: prepare */
 $del_account_stmt = $connection->prepare("DELETE FROM tbl_accounts WHERE acc_id=?");

 /* Prepared statement, stage 2: bind and execute */
 $del_account_stmt->bind_param("s", $delete); // "is" means that $id is bound as an integer and $label as a string
 $del_account_stmt->execute();


$connection->real_query("SELECT * FROM tbl_accounts ORDER BY date_created,time_created DESC");
$accounts_result = $connection->use_result();
foreach ($accounts_result as $row_account) {
    
    if($row_account['acc_id'] != 37)
    {
        echo "
        <tr>
            <th scope='row'>".$row_account["acc_id"]."</th>
            <td>".$row_account["emp_id"]."</td>
            <td>".$row_account["username"]."</td>
            <td>".$row_account["first_name"]." ".$row_account["middle_name"]." ".$row_account["last_name"]."</td>
            <td>".$row_account["position"]."</td>
            <td class='text-center'><i class='bx bxs-trash-alt btn border border-danger text-danger' id='".$row_account["acc_id"]."' title='Delete'></i></td>
        </tr>";
    }
}


?>