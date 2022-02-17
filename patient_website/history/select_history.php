<?php
include_once '../dbconn.php';
    if(isset($_POST['type'])){
        $type = $_POST['type'];

        if($type == "med_cert"){

            echo '<div class="modal fade" id="exampleModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div style="margin-bottom:5px;">
                        <strong>Date: </strong><br><span style="margin-left:50px;"class="date"></span>
                    </div>
                    <div style="margin-bottom:5px;">
                        <strong>Time: </strong><br><span style="margin-left:50px;" class="time"></span>
                    </div><br>
                    <div style="margin-bottom:5px;">
                        <strong>Physician: </strong><br><span style="margin-left:50px;" class="physician"></span>
                    </div>
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-12" style="word-wrap: break-word;">
                            <strong>Diagnosis: </strong><br><span style="margin-left:50px;" class="diagnosis"></span>
                        </div>  
                    </div>
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-12" style="word-wrap: break-word;">
                            <strong>Recommendation: </strong><br><span style="margin-left:50px;" class="recommendation"></span>
                        </div>  
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>
            <!-- med cert -->
            <div class="row mt-5 justify-content-center">

                <div class="col-10 col-md-3  mt-1">
                    <form>
                            <div class="form-group shadow-lg">
                                <input type="text" class="form-control" id="search_patient" data-type="med_cert" data-id="'.$_POST['id'].'" placeholder="Search History">
                            </div>
                    </form>
                </div>

                <div class="col-10 col-md-3  mt-1">
                        <form>
                                <div class="form-group shadow-lg">
                                    <input type="date" class="form-control" id="search_record_date" data-type="med_cert" data-id="'.$_POST['id'].'">
                                </div>
                        </form>
                </div>  

                <div class="col-10 col-md-1 mt-1">
                </div>    

                <div class="col-10 col-md-3  mt-1">
                    <select class="form-select" data-type="med_cert" data-id="'.$_POST['id'].'" id="sort_by">
                        <option value="date_asc">Date Ascending</option>
                        <option value="date_desc" selected>Date Descending</option>
                    </select>
                </div> 

            </div>

            <!-- table row  -->
            <div class="row justify-content-center my-3">
                <div class="col-10">

                    <table class="table">
                        <thead class="text-white">
                            <tr>
                                <th scope="col">Physician</th>
                                <th scope="col">Date</th>   
                                <th scope="col">Time</th>
                            </tr>
                        </thead>
                        <tbody class="med_tbody">';
                          
                            $record_type="med_cert";

                                $get_hist_stmt = $connection->prepare("SELECT * FROM tbl_history WHERE patient_id = ? and record_type = ? ORDER BY uploaded_date_time DESC");

                                /* Prepared statement, stage 2: bind and execute */
                                $get_hist_stmt->bind_param("ss", $_POST['id'], $record_type); // "is" means that $id is bound as an integer and $label as a string
                                $get_hist_stmt->execute();
                                $hist_result = $get_hist_stmt->get_result();

                                while ($row = $hist_result->fetch_array(MYSQLI_ASSOC)) {

                                    $get_med_stmt = $connection->prepare("SELECT * FROM tbl_med_cert WHERE patient_id = ? and record_med_cert_id = ?;");

                                    /* Prepared statement, stage 2: bind and execute */
                                    $get_med_stmt->bind_param("ss", $_POST['id'], $row['record_id']); // "is" means that $id is bound as an integer and $label as a string
                                    $get_med_stmt->execute();
                                    $med_result = $get_med_stmt->get_result();
                                    $med_row = $med_result->fetch_array(MYSQLI_ASSOC);
                                    
                                    echo "<tr class='show_mods' data-diagnosis=\"".$med_row['diagnosis']."\" data-recommendation=\"".$med_row['recommendation']."\" data-physician=\"".$med_row['physician']."\" 
                                    data-date=\"".date("Y-m-d",strtotime($row['uploaded_date_time']))."\" data-time=\"".date("h:i A",strtotime($row['uploaded_date_time']))."\" data-record_type=\"med_cert\" data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\">
                                            <td>".$med_row['physician']."</td>
                                            <td>".date("Y-m-d",strtotime($row['uploaded_date_time']))."</td>
                                            <td>".date("h:i A",strtotime($row['uploaded_date_time']))."</td>
                                        </tr>";

                                }
                    echo'
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- table row end -->
            <!-- med cert -->';

        }else if($type == "lab_res"){

            echo ' <div class="modal fade" id="exampleModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <strong>Date Uploaded: </strong><br><span class="date_uploaded"></span><br><br>
                    </div>
                    <div style="margin-bottom:5px;">
                        <strong>Type of Result: </strong><br><span style="margin-left:50px;" class="result_type"></span>
                    </div>
                    <div style="margin-bottom:5px;">
                        <strong>Released By: </strong><br><span style="margin-left:50px;" class="release_by"></span>
                    </div>
                    <div style="margin-bottom:5px;">
                        <strong>Uploaded By: </strong><br><span style="margin-left:50px;" class="uploaded_by"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
    </div>

        <!-- lab -->
        <div class="row mt-5 justify-content-center">

            <div class="col-10 col-md-3  mt-1">
                <select class="form-select" data-type="lab_result" data-id="'.$_POST['id'].'" id="select_by_type">
                    <option value="all" selected>Select All</option>
                    <option value="complete_blood_count">Complete Blood Count</option>
                    <option value="platelet_count">Platelet Count</option>
                    <option value="blood_typing">Blood Typing</option>
                    <option value="cross_matching">Cross Matching</option>
                    <option value="hepatitis_b">Hepatitis B</option>
                    <option value="blood_urea_nitrogen">Blood Urea Nitrogen</option>
                    <option value="creatinine">Creatinine</option>
                    <option value="fasting_blood_sugar">Fasting Blood Sugar</option>
                    <option value="fecalysis">Fecalysis</option>
                    <option value="cholesterol">Cholesterol</option>
                    <option value="uric_acid">Uric Acid</option>
                    <option value="urinalysis">Urinalysis</option>
                </select>
            </div> 

            <div class="col-10 col-md-3  mt-1">
                <form>
                        <div class="form-group shadow-lg">
                            <input type="date" class="form-control" id="search_record_date" data-type="lab_result" data-id="'.$_POST['id'].'">
                        </div>
                </form>
            </div>  

            <div class="col-10 col-md-1  mt-1">
            </div>    

            <div class="col-10 col-md-3  mt-1">
                <select class="form-select" data-type="lab_result" data-id="'.$_POST['id'].'" id="sort_by">
                    <option value="date_asc">Date Ascending</option>
                    <option value="date_desc" selected>Date Descending</option>
                </select>
            </div> 

        </div>

        <!-- table row  -->
        <div class="row justify-content-center my-3">
            <div class="col-10">

                <table class="table">
                    <thead class="text-white">
                        <tr>
                            <th scope="col">Result Type</th>
                            <th scope="col">Uploaded On</th>
                        </tr>
                    </thead>
                    <tbody class="lab_tbody">';

                            /* Prepared statement, stage 1: prepare */
                            $record_type="lab_result";
                           
                            $get_hist_stmt = $connection->prepare("SELECT * FROM tbl_history WHERE patient_id = ? and record_type = ? ORDER BY uploaded_date_time DESC");

                            /* Prepared statement, stage 2: bind and execute */
                            $get_hist_stmt->bind_param("ss", $_POST['id'], $record_type); // "is" means that $id is bound as an integer and $label as a string
                            $get_hist_stmt->execute();
                            $hist_result = $get_hist_stmt->get_result();

                            while ($row = $hist_result->fetch_array(MYSQLI_ASSOC)) {

                                $get_lab_stmt = $connection->prepare("SELECT * FROM tbl_lab_result WHERE patient_id = ? and lab_result_id = ?;");

                                /* Prepared statement, stage 2: bind and execute */
                                $get_lab_stmt->bind_param("ss", $_POST['id'], $row['record_id']); // "is" means that $id is bound as an integer and $label as a string
                                $get_lab_stmt->execute();
                                $lab_result = $get_lab_stmt->get_result();
                                $lab_row = $lab_result->fetch_array(MYSQLI_ASSOC);
                                
                                echo "<tr class='show_mods' data-date_uploaded=\"".$lab_row['date']."\" data-result_type=\"".ucwords(str_replace("_"," ",$lab_row['result_type']))."\" data-release_by=\"".$lab_row['release_by']."\" data-uploaded_by=\"".$lab_row['uploader']."\"  data-record_type=\"lab_result\" data-pat_id=\"".ucwords(str_replace("_"," ",$lab_row['result_type']))."\" data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\">
                                        <td  '>".ucwords(str_replace("_"," ",$lab_row['result_type']))."</td>
                                        <td>".$lab_row['date']."</td>
                                    </tr>";

                            }

                    echo'
                    </tbody>
                </table>
            </div>
        </div>
        <!-- table row end -->
        <!-- lab -->
            ';
        }
    }

?>