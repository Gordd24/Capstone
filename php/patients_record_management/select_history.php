<?php
    if(isset($_POST['type'])){
        $type = $_POST['type'];

        if($type == "admission"){

            echo '<!-- admission -->
                <div class="row mt-5 justify-content-center">

                    <div class="col-3">
                        <form>
                                <div class="form-group shadow-lg">
                                    <input type="text" class="form-control" id="search_patient" placeholder="Search History">
                                </div>
                        </form>
                    </div>


                    <div class="col-4">
                    </div>    

                    <div class="col-3">
                        <select class="form-select" id="sort_by">
                            <option value="date_asc">Date Ascending</option>
                            <option value="date_desc">Date Descending</option>
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
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- table row end -->
                <!-- admission -->';

        }else if($type == "consultation"){

            echo '<!-- consultation -->
            <div class="row mt-5 justify-content-center">

                <div class="col-3">
                    <form>
                            <div class="form-group shadow-lg">
                                <input type="text" class="form-control" id="search_patient" placeholder="Search History">
                            </div>
                    </form>
                </div>


                <div class="col-4">
                </div>    

                <div class="col-3">
                    <select class="form-select" id="sort_by">
                        <option value="date_asc">Date Ascending</option>
                        <option value="date_desc">Date Descending</option>
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
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- table row end -->
            <!-- consultation -->';

        }else if($type == "med_cert"){

            echo '<!-- med_cert -->
                <div class="row mt-5 justify-content-center">

                    <div class="col-3">
                        <form>
                                <div class="form-group shadow-lg">
                                    <input type="text" class="form-control" id="search_patient" placeholder="Search History">
                                </div>
                        </form>
                    </div>


                    <div class="col-4">
                    </div>    

                    <div class="col-3">
                        <select class="form-select" id="sort_by">
                            <option value="date_asc">Date Ascending</option>
                            <option value="date_desc">Date Descending</option>
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
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- table row end -->
                <!-- med_cert -->';

        }else if($type == "lab_res"){

            echo '<div class="row mt-5 justify-content-center">

                    <div class="col-3">
                        <form>
                                <div class="form-group shadow-lg">
                                    <input type="text" class="form-control" id="search_patient" placeholder="Search History">
                                </div>
                        </form>
                    </div>

                    <div class="col-2">
                        <select class="form-select" id="search_by">
                            <option value="date">Search By Date</option>
                            <option value="type" Selected>Search By Type</option>
                        </select>
                    </div>    

                    <div class="col-2">
                    </div>    

                    <div class="col-3">
                        <select class="form-select" id="sort_by">
                            <option value="date_asc">Date Ascending</option>
                            <option value="date_desc">Date Descending</option>
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
                                    <th scope="col">Followed Up On</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- table row end -->
            ';
        }
    }

?>