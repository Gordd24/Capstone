<?php
include_once '../dbconn.php';
    if(isset($_POST['type'])){
        $type = $_POST['type'];

        if($type == "admission"){

            echo '<div class="modal fade" id="exampleModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div style="margin-bottom:5px;">
                        <strong>Physician: </strong><br><span style="margin-left:50px;" class="physician"></span>
                    </div><br>

                    <div style="margin-bottom:5px;">
                        <strong>Date Admitted: </strong><br><span style="margin-left:50px;"class="date_admitted"></span>
                    </div>
                    <div style="margin-bottom:5px;">
                        <strong>Time Admitted: </strong><br><span style="margin-left:50px;" class="time_admitted"></span>
                    </div>
                  
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-12" style="word-wrap: break-word;">
                            <strong>Admission Diagnosis: </strong><br><span style="margin-left:50px;" class="admitting_diagnosis"></span>
                        </div>  
                    </div><br><br>

                    <div style="margin-bottom:5px;">
                        <strong>Date Discharged: </strong><br><span style="margin-left:50px;"class="date_discharged"></span>
                    </div>
                    <div style="margin-bottom:5px;">
                        <strong>Time Discharged: </strong><br><span style="margin-left:50px;" class="time_discharged"></span>
                    </div>

                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-12" style="word-wrap: break-word;">
                            <strong>Final Diagnosis: </strong><br><span style="margin-left:50px;" class="final_diagnosis"></span>
                        </div>  
                    </div><br>

                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-12">
                            <strong>Disposition: </strong><br><span style="margin-left:50px;" class="disposition"></span>
                        </div>  
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>

            <!-- admission -->
            <div class="row mt-5 justify-content-center">

                <div class="col-3">
                    <form>
                            <div class="form-group shadow-lg">
                                <input type="text" class="form-control" id="search_patient" data-type="admission" data-id="'.$_POST['id'].'" placeholder="Search History">
                            </div>
                    </form>
                </div>

                <div class="col-3">
                        <form>
                                <div class="form-group shadow-lg">
                                    <input type="date" class="form-control" id="search_record_date" data-type="admission" data-id="'.$_POST['id'].'">
                                </div>
                        </form>
                </div>  

                <div class="col-1">
                </div>    

                <div class="col-3">
                    <select class="form-select" data-type="admission" data-id="'.$_POST['id'].'" id="sort_by">
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
                        <tbody class="admission_tbody">';
                            $record_type="admission";

                                $get_hist_stmt = $connection->prepare("SELECT * FROM tbl_history WHERE patient_id = ? and record_type = ? ORDER BY uploaded_date_time DESC");

                                /* Prepared statement, stage 2: bind and execute */
                                $get_hist_stmt->bind_param("ss",$_POST['id'], $record_type); // "is" means that $id is bound as an integer and $label as a string
                                $get_hist_stmt->execute();
                                $hist_result = $get_hist_stmt->get_result();

                                while ($row = $hist_result->fetch_array(MYSQLI_ASSOC)) {

                                      
                                    $get_discharge_stmt = $connection->prepare("SELECT * FROM tbl_discharge WHERE patient_id = ? and discharge_id = ?;");

                                    /* Prepared statement, stage 2: bind and execute */
                                    $get_discharge_stmt->bind_param("ss",$_POST['id'], $row['record_id']); // "is" means that $id is bound as an integer and $label as a string
                                    $get_discharge_stmt->execute();
                                    $discharge_result = $get_discharge_stmt->get_result();
                                    $discharge_row = $discharge_result->fetch_array(MYSQLI_ASSOC);

                                    $record_admission_id = $discharge_row['record_admission_id'];

                                    

                                    $get_admission_stmt = $connection->prepare("SELECT * FROM tbl_admission WHERE patient_id = ? and record_admission_id = ?;");

                                    
                                    /* Prepared statement, stage 2: bind and execute */
                                    $get_admission_stmt->bind_param("ss",$_POST['id'], $record_admission_id); // "is" means that $id is bound as an integer and $label as a string
                                    $get_admission_stmt->execute();
                                    $admission_result = $get_admission_stmt->get_result();
                                    $admission_row = $admission_result->fetch_array(MYSQLI_ASSOC);
                                    
                                    echo "<tr class='show_mods' data-date_admitted=\"".$admission_row['date_admitted']."\" data-time_admitted=\"".date("h:i A",strtotime($admission_row['time_admitted']))."\" 
                                     data-attending_physician=\"".$admission_row['physician']."\" data-record_type=\"admission\" data-diagnosis=\"".$admission_row['diagnosis']."\" data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\"
                                     data-disposition=\"".$discharge_row['disposition']."\" data-date_discharged=\"".date("Y-m-d",strtotime($row['uploaded_date_time']))."\"  data-time_discharged=\"".date("h:i A",strtotime($row['uploaded_date_time']))."\"
                                     data-final_diagnosis=\"".$discharge_row['final_diagnosis']."\">
                                            <td>".$admission_row['physician']."</td>
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
            <!-- admission -->';

        }else if($type == "consultation"){

            echo ' 
            <div class="modal fade" id="exampleModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div style="margin-bottom:5px;">
                        <strong>Date Consulted: </strong><br><span style="margin-left:50px;"class="date_consulted"></span>
                    </div>
                    <div style="margin-bottom:5px;">
                        <strong>Time Consulted: </strong><br><span style="margin-left:50px;" class="time_consulted"></span>
                    </div><br>
                    <div style="margin-bottom:5px;">
                        <strong>Personnel: </strong><br><span style="margin-left:50px;" class="physician"></span>
                    </div>
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-12" style="word-wrap: break-word;">
                            <strong>Chief Complaint: </strong><br><span style="margin-left:50px;" class="complaint"></span>
                        </div>  
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>
            <!-- consultation -->
            <div class="row mt-5 justify-content-center">

                <div class="col-3">
                    <form>
                            <div class="form-group shadow-lg">
                                <input type="text" class="form-control" id="search_patient" data-type="consultation" data-id="'.$_POST['id'].'" placeholder="Search History">
                            </div>
                    </form>
                </div>

                <div class="col-3">
                        <form>
                                <div class="form-group shadow-lg">
                                    <input type="date" class="form-control" id="search_record_date" data-type="consultation" data-id="'.$_POST['id'].'">
                                </div>
                        </form>
                </div>  

                <div class="col-1">
                </div>    

                <div class="col-3">
                    <select class="form-select" data-type="consultation" data-id="'.$_POST['id'].'" id="sort_by">
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
                                <th scope="col">Personnel</th>
                                <th scope="col">Date</th>   
                                <th scope="col">Time</th>
                            </tr>
                        </thead>
                        <tbody class="cons_tbody">';
                               $record_type="consultation";

                                $get_hist_stmt = $connection->prepare("SELECT * FROM tbl_history WHERE patient_id = ? and record_type = ? ORDER BY uploaded_date_time DESC");

                                /* Prepared statement, stage 2: bind and execute */
                                $get_hist_stmt->bind_param("ss", $_POST['id'], $record_type); // "is" means that $id is bound as an integer and $label as a string
                                $get_hist_stmt->execute();
                                $hist_result = $get_hist_stmt->get_result();

                                while ($row = $hist_result->fetch_array(MYSQLI_ASSOC)) {

                                    $get_cons_stmt = $connection->prepare("SELECT * FROM tbl_consult WHERE patient_id = ? and record_cons_id = ?;");

                                    /* Prepared statement, stage 2: bind and execute */
                                    $get_cons_stmt->bind_param("ss", $_POST['id'], $row['record_id']); // "is" means that $id is bound as an integer and $label as a string
                                    $get_cons_stmt->execute();
                                    $cons_result = $get_cons_stmt->get_result();
                                    $cons_row = $cons_result->fetch_array(MYSQLI_ASSOC);
                                    
                                    echo "<tr class='show_mods' data-complaint=\"".$cons_row['personnel']."\" data-date_consulted=\"".date("Y-m-d",strtotime($row['uploaded_date_time']))."\"  data-time_consulted=\"".date("h:i A",strtotime($row['uploaded_date_time']))."\" data-physician=\"".$cons_row['personnel']."\" data-record_type=\"consultation\" data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\">
                                            <td>".$cons_row['personnel']."</td>
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
            <!-- consultation -->';

        }else if($type == "med_cert"){

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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>
            <!-- med cert -->
            <div class="row mt-5 justify-content-center">

                <div class="col-3">
                    <form>
                            <div class="form-group shadow-lg">
                                <input type="text" class="form-control" id="search_patient" data-type="med_cert" data-id="'.$_POST['id'].'" placeholder="Search History">
                            </div>
                    </form>
                </div>

                <div class="col-3">
                        <form>
                                <div class="form-group shadow-lg">
                                    <input type="date" class="form-control" id="search_record_date" data-type="med_cert" data-id="'.$_POST['id'].'">
                                </div>
                        </form>
                </div>  

                <div class="col-1">
                </div>    

                <div class="col-3">
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
                        <strong>Release By: </strong><br><span style="margin-left:50px;" class="release_by"></span>
                    </div>
                    <div style="margin-bottom:5px;">
                        <strong>Upload By: </strong><br><span style="margin-left:50px;" class="uploaded_by"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
    </div>

        <!-- lab -->
        <div class="row mt-5 justify-content-center">

            <div class="col-3">
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

            <div class="col-3">
                <form>
                        <div class="form-group shadow-lg">
                            <input type="date" class="form-control" id="search_record_date" data-type="lab_result" data-id="'.$_POST['id'].'">
                        </div>
                </form>
            </div>  

            <div class="col-1">
            </div>    

            <div class="col-3">
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
                            <th scope="col">Release By</th>   
                            <th scope="col">Uploaded By</th>
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
                                
                                echo "<tr class='show_mods' data-date_uploaded=\"".$lab_row['date']."\" data-result_type=\"".ucwords(str_replace("_"," ",$lab_row['result_type']))."\" data-release_by=\"".'Dummy Person'."\" data-uploaded_by=\"".$lab_row['uploader']."\"  data-record_type=\"lab_result\" data-pat_id=\"".ucwords(str_replace("_"," ",$lab_row['result_type']))."\" data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\">
                                        <td  '>".ucwords(str_replace("_"," ",$lab_row['result_type']))."</td>
                                        <td>".$lab_row['release_by']."</td>
                                        <td>".$lab_row['uploader']."</td>
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