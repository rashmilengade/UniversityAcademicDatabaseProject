<html>
<head><title>VIEW REGISTERED STUDENTS</title></head>
<body>
        <?php
                session_start();
                 /**
                 * Step #1: Open connection to the MySQL database
                 */
                // Create new mysql connection representing a connection to the MySQL database
                $link = mysql_connect('localhost', 'root', 'lakers');
                //select the database from all the databases created for root
                mysql_select_db("db_project") or die("Cannot select the database");     
        ?>
        <form method="get" name="view_registered_students" action="ViewRegisteredStudents.php" >
        <div align="center">
        <label>Welcome <?php echo $_SESSION["username"];?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="Menu.php">&lt;&lt;back</a>
        <a href="Login.php">Logout</a>
        <br/>
        <h3 align="center">VIRW REGISTERED STUDENTS</h3>        
                <?php
                        if(array_key_exists("courseNumber", $_GET)) {
                                $courseNumber = $_GET["courseNumber"];
                        }else {
                                $courseNumber = "";
                        }
                        if(array_key_exists("sectionNumber", $_GET)) {
                                $sectionNumber = $_GET["sectionNumber"];
                        }else {
                                $sectionNumber = "";
                        }
                ?>
                <table align="center">
                        <tr>
                                <td>
                                        <label id="sectionNumberLbl" title="Section Number" >Section Name</label>
                                </td>
                                <td>
                                        <input id="sectionNumberTxt" name="sectionNumber" type="text" size="60" value="<?php echo "$sectionNumber";?>" />
                                </td>
                        </tr>
                        <tr>
                                <td>
                                        <label id="courseNumberLbl" title="Course Number" >Course Number</label>
                                </td>
                                <td>
                                        <input id="courseNumberTxt" name="courseNumber" type="text"  value="<?php echo "$courseNumber";?>"/>
                                </td>
                        </tr>
                        <tr>
                                <td>
                                        <input type="submit" name="viewResgitrationbtn" value="View Registered Students" />
                                </td>
                                <td>
                                        <input type=reset value= "Reset" onClick="<?php "Location: http://127.0.0.1:8887:/PHP/ViewRegisteredStudents.php";?>">
                                </td>
                        </tr>
                </table>
                            <?php
                    $where = createWherePart($sectionNumber,$courseNumber);
                    $query = "select * from transcript t, student s, sections s1, courses c where t.sno = s.sno and s1.secid = t.secid and s1.courseid = c.courseid";
                    if(!empty($where)){
                                $query .=  $where;        
                                $result = mysql_query($query);
                                displayResults($result);
                        }else{        ?>
                        <label style="color: red; text-align: center;"><?php echo "Please enter valid data for the above fields"; ?></label>
                        <?php }
                ?>
                <?php
                        function displayResults($result){
                                if(mysql_num_rows($result) > 0) { ?>
                                <table border="1" align="center">
                                <tr>
                                        <th>Student Id</th>
                                        <th>Name</th>
                                    <th>NetId</th>
                                    <th>Grade</th>
                                </tr>
                                <?php while($row = mysql_fetch_assoc($result)) { ?>
                                        <tr>
                                                <td><?php print $row['SNO']?></td>
                                            <td><?php print $row['FNAME']?> <?php print $row['MNAME']?> <?php print $row['LNAME']?></td>
                                            <td><?php print $row['NETID']?></td>
                                            <td><?php $row['GRADE'] != NULL ? print $row['GRADE'] : "0"?></td>
                                        </tr>            
                                <?php } ?>
                                </table>
                                <?php }
                                else{        ?>        
                                        <label style="color: red; text-align: center;"><?php echo "No Records Found!!";?></label>
                                <?php }                 
                        } 
                        
                        function createWherePart($sectionNumber,$courseNumber){
                                $where = "";
                                if(!empty($courseNumber)){
                                        $where .= " AND C.COURSEID LIKE '%". $courseNumber."%'";
                                }
                                if(!empty($sectionNumber)){
                                        $where .= " AND S1.SECNO = '".$sectionNumber."'";
                                }
                                return $where;
                        }
                ?>
                </div>
                </form>
        </body>
</html>



<html>
<head><title>DROP SECTION</title></head>
<body>
        <?php
        
                session_start();
                 /**
                 * Step #1: Open connection to the MySQL database
                 */
                
                // Create new mysql connection representing a connection to the MySQL database
                $link = mysql_connect('localhost', 'root', 'lakers');
                //select the database from all the databases created for root
                mysql_select_db("db_project") or die("Cannot select the database");     
        ?>
        <form method="get" name="drop_section_form" action="DropSection.php" >
        <div align="center">
                <label>Welcome <?php echo $_SESSION["username"];?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="Menu.php">&lt;&lt;back</a>
                <a href="Login.php">Logout</a>
                <br/>
                <h3 align="center">DROP A SECTION</h3>
                
                <?php
                        if(array_key_exists("studentId1", $_GET)){
                                $studentId = $_GET["studentId1"];
                        }else{
                                $studentId = "";
                        }
                        if(array_key_exists("semester", $_GET)){
                                $semester = $_GET["semester"];
                        }else{
                                $semester = "";
                        }
                        if(array_key_exists("year", $_GET)){
                                $year = $_GET["year"];
                        }else{
                                $year = "";
                        }
                        if(array_key_exists("checkedSections", $_GET)){
                                $checkedSections = $_GET["checkedSections"];
                        }else{
                                $checkedSections = "";
                        }

                        if(!empty($studentId) & empty($checkedSections)){
                                //$valid = validateInput($studentId1,$semester,$year);
                                $valid = "true";
                                if($valid == "true"){
                                        $where = getWhereClause($studentId,$semester,$year);        
                                        $results = getResults($where);
                                        displayResults($results);
                                }
                        }else if(empty($checkedSections)){
                                echo "Enter valid data!!";
                        }
                        else{
                                delete();
                        }
                        
                        function getWhereClause($studentId,$semester,$year){
                                $where = "";
                                if(!empty($studentId)){
                                        $where .= " and s.sno = '".$studentId."'";
                                }
                                if(!empty($semester)){
                                        $where .= " and s1.sem = '".$semester."'";
                                }
                                if(!empty($year)){
                                        $where .= " and s1.year = '".$year."'";        
                                }
                                 
                                return $where;
                        }
                        function getResults($where){
                                $query = "select s.sno,s.lname,s.fname,s.mname,s1.secid,s1.secno,s1.courseid,s1.room,s1.from_time,s1.to_time,s1.days,t.grade from transcript t,student s,sections s1 where t.SECID = s1.SECID and t.SNO = s.SNO";
                                $query .= $where;
                                $result = mysql_query($query);
                                return $result;
                        }
                        
                        function displayResults($results){?>
                                <table border="1" align="center">
                                        <tr>
                                                <th>Select</th>
                                                <th>Student Id</th>
                                                <th>Section Id</th>
                                                <th>Section No</th>
                                                <th>Course Id</th>
                                                <th>Student Name</th>
                                                <th>Grade</th>
                                        </tr>
                                <?php
                                        while($row = mysql_fetch_assoc($results)) { ?>
                                                <tr>
                                                        <td><input type="checkbox" name="checkedSections[]" value="<?php print $row['secid'].",".$row['sno']?>"></td>
                                                        <td><?php print $row['sno']?></td>
                                                        <td><?php print $row['secid']?></td>
                                                        <td><?php print $row['secno']?></td>
                                                        <td><?php print $row['courseid']?></td>
                                                        <td><?php print $row['fname']?> <?php print $row['mname']?> <?php print $row['lname']?></td>
                                                        <td><?php print $row['grade']?></td>
                                                </tr>
                                <?php } ?>
                                </table>
                                <input type="submit" name="Drop Courses" title="Drop Courses" />
                                <?php }
                                
                                function delete(){
                                         $checkedSections = $_GET["checkedSections"];
                                        if(sizeof($checkedSections) > 0 ){
                                                for($i = 0; $i<sizeof($checkedSections) ; $i++){
                                                        echo $checkedSections[$i];
                                                        $strings = explode(",", $checkedSections[$i]);
                                                        echo $strings[0];
                                                        echo $strings[1];
                                                        $dropQuery = "Delete from transcript where sno = '".$strings[1]."' and secid = '".$strings[0]."'";
                                                        echo $dropQuery;
                                                        mysql_query($dropQuery);
                                                        $studentId = $strings[1];
                                                        $where = getWhereClause($studentId,"","");
                                                        $results = getResults($where);
                                                        displayResults($results);
                                                }
                                        } 
                                }
                                ?>
                                
        </div>
        </form>
        </body>
</html>




<html>
<head><title>REGISTER A STUDENT</title></head>
<body>
        <?php
                session_start();
                 /**
                 * Step #1: Open connection to the MySQL database
                 */
                
                // Create new mysql connection representing a connection to the MySQL database
                $link = mysql_connect('localhost', 'root', 'lakers');
                //select the database from all the databases created for root
                mysql_select_db("db_project") or die("Cannot select the database");     
        ?>
        <form method="get" name="register_form" action="registerStudent.php" >
        <div align="center">
                <label>Welcome <?php echo $_SESSION["username"];?>></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="Menu.php">&lt;&lt;back</a>
                <a href="Login.php">Logout</a>
                <br/>
                <h3 align="center">REGISTER A STUDENT</h3>
                <?php
                        if(array_key_exists("sectionNumber", $_GET)) {
                                $sectionNumber = $_GET["sectionNumber"];
                        }else {
                                $sectionNumber = "";
                        }
                        if(array_key_exists("courseNumber", $_GET)) {
                                $courseNumber = $_GET["courseNumber"];
                        }else {
                                $courseNumber = "";
                        }
                        if(array_key_exists("studentId1", $_GET)){
                                $studentId1 = $_GET["studentId1"];
                        }else{
                                $studentId1 = "";
                        }
                        if(array_key_exists("semesterValue", $_GET)){
                                $semester = $_GET["semesterValue"];
                        }else{
                                $semester = "";
                        }
                        if(array_key_exists("year", $_GET)){
                                $year = $_GET["year"];
                        }else{
                                $year = "";
                        }                        
                ?>
                <table align="center">
                        <tr>
                                <td>
                                        <label id="semesterList" title="Semester">Select the Semester you want to enroll for</label>
                                </td>
                                <td>
                                        <select id="semsterValue" name="semesterValue" >
                                                <option value=" ">Select</option>
                                                  <option value="S" <?php echo $semester == 'S' ? "selected = \"true\"" : ""?>>Spring</option>
                                                  <option value="F" <?php echo $semester == 'F' ? "selected = \"true\"" : ""?>>Fall</option>
                                                  <option value="U" <?php echo $semester == 'U' ? "selected = \"true\"" : ""?>>Summer</option>
                                        </select>                
                                </td>
                        </tr>
                        <tr>
                                <td>
                                        <label id="yearLbl" title="Year" >Year</label>
                                </td>
                                <td>
                                        <input id="yearTxt" name="year" type="text" value="<?php echo "$year";?>"/>
                                </td>
                        </tr>
                        <tr>
                                <td>
                                        <label id="studentIdLbl1" title="Student Id" >Student Id</label>
                                </td>
                                <td>
                                        <input id="studentIdTxt1" name="studentId1" type="text" value="<?php echo "$studentId1";?>"/>
                                </td>
                        </tr>
                        <tr>
                                <td>
                                        <label id="sectionNumberLbl" title="Section Number" >Section Number</label>
                                </td>
                                <td>
                                        <input id="sectionNumberTxt" name="sectionNumber" type="text" value="<?php echo "$sectionNumber";?>" />
                                </td>
                        </tr>
                        <tr>
                                <td>
                                        <label id="courseNumberLbl" title="Course Number" >Course Number</label>
                                </td>
                                <td>
                                        <input id="courseNumberTxt" name="courseNumber" type="text" value="<?php echo "$courseNumber";?>"/>
                                </td>
                        </tr>
                        
                        <tr>
                                <td>
                                        <input type="submit" name="registerbtn" value="Register" />
                                </td>
                                <td>
                                        <input type=reset value= "Reset" onClick="document.search_form.SearchString.focus();">
                                </td>
                        </tr>
                </table>
            <?php
            if(!empty($studentId1) & !empty($sectionNumber) & !empty($courseNumber) & !empty($semester) & !empty($year)){
                    registerStudent($studentId1,$sectionNumber,$courseNumber,$semester,$year);
            }else{ ?>
                    <label style="color: red; text-align: center;"> <?php echo "Please enter valid data for all the above fields!!"; ?> </label>
            <?php }
                    
            function registerStudent($studentId1,$sectionNumber,$courseNumber,$semester,$year){
                    $studentQuery = "SELECT SNO FROM STUDENT WHERE SNO = '".$studentId1."'";
                        $studentQueryResult = mysql_query($studentQuery);
                        if(mysql_num_rows($studentQueryResult) > 0){
                                $sectionQuery1 = "SELECT SECID FROM SECTIONS WHERE SECNO = '".$sectionNumber."' AND COURSEID = '".$courseNumber."' AND SEM = '".$semester."' AND YEAR = '".$year."'";
                                $sectionQueryResult1 = mysql_query($sectionQuery1);
                                $row = mysql_fetch_assoc($sectionQueryResult1);
                                if(mysql_num_rows($sectionQueryResult1) > 0){
                                        $result = validateAlreadyRegistered($studentId1,$row['SECID']);
                                        if($result == "true"){
                                                $isFull = checkCapacity($studentId1,$row['SECID']);
                                                if($isFull == "true"){
                                                        $query = "INSERT INTO TRANSCRIPT VALUES ('".$studentId1."','".$row['SECID']."',NULL)";
                                                        $queryResult = mysql_query($query);
                                                        if($queryResult > 0){
                                                                $updateQuery = ""; ?>
                                                                <label style="color: red; text-align: center;"><?php echo "Student with ID ".$studentId1." is successfully registered for section with section number and course number as ".$sectionNumber.",".$courseNumber; ?> </label>
                                                        <?php }
                                                }else{ ?>
                                                        <label style="color: red; text-align: center;"><?php echo "Section is already full!!"; ?></label>
                                        <?php }
                                        }else{ ?>
                                                <label style="color: red; text-align: center;"><?php echo "Student has already registered for this course."; ?></label>
                                        <?php }        
                                }else{ ?>
                                        <label style="color: red; text-align: center;"><?php echo "Section is not being offered."; ?> </label>
                                <?php }
                        }else{ ?>
                                <label style="color: red; text-align: center;"><?php echo "Student does not exists."; ?> </label>        
                        <?php  }
                }
                
                function validateAlreadyRegistered($studentId1,$sectionId){
                        $validationQuery = "Select * from transcript where SNO = '".$studentId1."' and SECID = '".$sectionId."'";
                        $validationQueryResult = mysql_query($validationQuery);
                        if(mysql_num_rows($validationQueryResult) > 0){
                                ?> <label style="color: red; text-align: center;"><?php echo "Student already registered for this section."; ?></label>
                                <?php return "false";
                        }
                        return "true";
                }
                function checkCapacity(){
                        $capacityQuery = "Select count from transcript where SECID = '".$sectionId."'";
                        $enrolled = mysql_query($capacityQuery);
                        
                        $sectionCapacityQuery = "Select capacity from sections where SECID = '".$sectionId."'";
                        $total = mysql_query($sectionCapacityQuery);
        
                        if($total == $enrolled){ ?>
                                <label style="color: red; text-align: center;"><?php echo "Section Capacity is full!!";?> </label>
                                <?php return false;
                        }
                        return "true";
                }
            ?>
            </div>
            </form>
        </body>
</html>