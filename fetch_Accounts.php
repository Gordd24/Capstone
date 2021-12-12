
      <?php
        $sql = "SELECT * FROM tbl_accounts";
        $result = $conn -> query($sql);
       
         
        if($result->num_rows>0)
        {
           while($row = $result -> fetch_assoc())
           {
            
               echo "  <tr>
                        <td>".$row["emp_id"]."</td>
                        <td>".$row["username"]."</td>
                        <td>".$row["first_name"]." ".$row["middle_name"]." ".$row["last_name"]."</td>
                        <td>
                            <button>Edit</button>
                            <button>Archive</button>
                        </td>
                        </tr>";
           }
        }    
      ?>