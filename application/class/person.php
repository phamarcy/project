<?php
require_once(__DIR__."/database.php");
require_once(__DIR__."/approval.php");
require_once(__DIR__."/manage_deadline.php");
require_once(__DIR__."/../config/configuration_variable.php");
/** This class serves manage staff,teacher,all person who involve in this system
*
* @author  Adiluck Chooprateep
* @since   4/10/2017
*/
class Person
{

  private $LOG;
  private $DB;
  private $DEADLINE;
  private $FILE_PATH;
  private $DEFAULT_DB;
  private $PERSON_DB;

  function __construct()
  {
    global $DATABASE,$FILE_PATH,$PERSON_DATABASE;
    # code...
    $this->LOG = new Log();
    $this->DB = new Database();
    $this->DEFAULT_DB = $DATABASE['NAME'];
    $this->PERSON_DB = $PERSON_DATABASE['NAME'];
    $this->DB->Change_DB($this->PERSON_DB);
    $deadline = new Deadline();
    $this->DEADLINE = $deadline->Get_Current_Semester();
    $this->FILE_PATH = $FILE_PATH;
  }
// search all staff,teacher data
  public function Get_All_Teacher()
  {
    $sql = "SELECT s.`code` as code,p.`name` as prefix,s.`fname`,s.`lname`
    FROM `staff` s,`prefix` p,`position` po
    WHERE s.`position_code` = po.`code` and s.`prefix_code` = p.`code` AND s.`position_code` = '100000'";
    $this->DB->Change_DB($this->PERSON_DB);
    $result = $this->DB->Query($sql);
    $this->DB->Change_DB($this->DEFAULT_DB);
    if($result)
    {
      $teacher = array();
      for($i=0;$i<count($result);$i++)
      {
        $name['id'] = $result[$i]['code'];
        $name['prefix'] = $result[$i]['prefix'];
        $name['name'] = $result[$i]['fname'].' '.$result[$i]['lname'];
        array_push($teacher,$name);
      }
      return $teacher;
    }
    else
    {
      $this->LOG->Write("Error person : Search Teacher failed");
      return false;
    }
  }

  //search teacher prefix and name
  public function Get_Teacher_Name($teacher_id)
  {
    //search teacher data
    $this->DB->Change_DB($this->PERSON_DB);
    $sql = "SELECT p.`name` as prefix ,s.`fname`,s.`lname` FROM `staff` s,`prefix` p WHERE s.`code` = '".$teacher_id."' AND s.`prefix_code` = p.`code` ";
    $result = $this->DB->Query($sql);
    $this->DB->Change_DB($this->DEFAULT_DB);
    if($result)
    {
      $full_name = $result[0]['prefix']." ".$result[0]['fname']." ".$result[0]['lname'];
      return $full_name;
    }
    else
    {
      return false;
    }
  }
//search special instructor name
  public function Get_Special_Instructor_Name($id)
  {
    $this->DB->Change_DB($this->DEFAULT_DB);
    $sql = "SELECT * FROM `special_instructor` WHERE `instructor_id` = ".$id;
    $result = $this->DB->Query($sql);
    if($result)
    {
      $name = $result[0]['firstname'].' '.$result[0]['lastname'];
      return $name;
    }
    else
    {
      return false;
    }
  }

  public function Get_Special_Instructor_Data($firstname,$lastname)
  {
    $sql = "SELECT `prefix`,`firstname`,`lastname`,`position`,`qualification`,`work_place`,`phone`,`phone_sub`,`phone_mobile`,`email` FROM `special_instructor` WHERE `firstname` = '".$firstname."' AND `lastname` = '".$lastname."'";
    $this->DB->Change_DB($this->DEFAULT_DB);
    $result = $this->DB->Query($sql);
    if($result)
    {
      $data = $result[0];
      return $data;
    }
    else
    {
      return false;
    }
  }
//get all prifix that exist in database
  public function Get_All_Prefix()
  {
    $this->DB->Change_DB($this->PERSON_DB);
    $sql = "SELECT `code`,`name` FROM `prefix`";
    $result = $this->DB->Query($sql);
    $this->DB->Change_DB($this->DEFAULT_DB);
    if($result)
    {
      $prefix = array();
      for($i=0;$i<count($result);$i++)
      {
        $temp['id'] = $result[$i]['code'];
        $temp['prefix'] = $result[$i]['name'];
        array_push($prefix,$temp);
      }
      return $prefix;
    }
    else
    {
      return false;
    }

  }

  //search teacher id
  public function Get_Teacher_Id($teacher_name)
  {
    $name = explode(" ",$teacher_name);
    $name_space = count($name);
    if($name_space >= 2)
    {
      $lname = $name[$name_space-1];
      $fname = $name[$name_space-2];
      $sql = "SELECT code FROM `staff` WHERE fname = '".$fname."' AND lname ='".$lname."'";
      $this->DB->Change_DB($this->PERSON_DB);
      $result = $this->DB->Query($sql);
      $this->DB->Change_DB($this->DEFAULT_DB);
      if($result)
      {
        $id = $result[0]['code'];
        return $id;
      }
      else
      {
        return false;
      }
    }
    else
    {
      return false;
    }
  }
//search teacher email
  public function Get_Teacher_Email($teacher_id)
  {
    $sql = "SELECT `email` FROM `staff` WHERE `code` = '".$teacher_id."'";
    $this->DB->Change_DB($this->PERSON_DB);
    $result = $this->DB->Query($sql);
    $this->DB->Change_DB($this->DEFAULT_DB);
    if($result)
    {
      return $result[0]['email'];
    }
    else
    {
      return false;
    }
  }
//search staff's department
  public function Get_Staff_Dep($staff_id)
  {
    $sql = "SELECT s.`dep_code`,dep.`name` FROM `staff`s,`department` dep
    WHERE s.`code` = '".$staff_id."' AND s.`dep_code` = dep.`code`";

    $this->DB->Change_DB($this->PERSON_DB);
    $result = $this->DB->Query($sql);
    $this->DB->Change_DB($this->DEFAULT_DB);
    if($result)
    {
      $department_id['code'] = $result[0]['dep_code'];
      $department_id['name'] = $result[0]['name'];
      return $department_id;
    }
    else
    {
      return false;
    }
  }

  //get document approval status
  private function Get_Doc_Status($course_id)
  {
      $status = 7;
      $sql = "SELECT `status` FROM `approval_course`
      WHERE `course_id` = '".$course_id."' AND `semester_id` = ".$this->DEADLINE['id'];
      $this->DB->Change_DB($this->DEFAULT_DB);
      $result = $this->DB->Query($sql);
      if($result)
      {
        for($i=0;$i<count($result);$i++)
        {
          $temp_status = $result[$i]['status'];
          if($temp_status < $status)
          {
            $status = $temp_status;
          }
        }
        return $status;
      }
      else
      {
        //not found on database, assume not creating
        return "0";
      }
  }

  //search special instructor approval status and comment
  private function Get_Instructor_Status($instructor_id,$course_id)
  {
    $sql = "SELECT status FROM `approval_special`
    WHERE instructor_id = ".$instructor_id. " AND `semester_id` = ".$this->DEADLINE['id'];
    $status = 7;
    $this->DB->Change_DB($this->DEFAULT_DB);
    $result = $this->DB->Query($sql);
        if($result)
        {
          for($i=0;$i<count($result);$i++)
          {
            $temp_status = $result[$i]['status'];
            if($temp_status < $status)
            {
              $status = $temp_status;
            }
          }
          return $status;
        }
        else
        {
          return false;
        }

  }
// add assessor to group assessor
  public function Add_Assessor($group_num,$teacher_name,$department_id)
  {
    $teacher_id = $this->Get_Teacher_Id($teacher_name);
    if($teacher_id != false)
    {
      if($department_id != false)
      {
        if($department_id == '1202')
        {
          $group_num = '1'.$group_num;
        }
        else if($department_id == '1203')
        {
          $group_num = '2'.$group_num;
        }

        //check if teacher is already exist in group
        $this->DB->Change_DB($this->DEFAULT_DB);
        $sql = "SELECT * FROM `group_assessor` WHERE `teacher_id` = '".$teacher_id."' AND `group_num` = '".$group_num."'";
        $result = $this->DB->Query($sql);
        if($result == null) //if not insert to group
        {
            $sql = "INSERT INTO `group_assessor`(`teacher_id`, `group_num`)
            VALUES ('".$teacher_id."','".$group_num."')";

            $result = $this->DB->Insert_Update_Delete($sql);
            if($result)
            {
              $sql = "SELECT `course_id` FROM `subject_assessor` WHERE `assessor_group_num` = '".$group_num."'";
              $result = $this->DB->Query($sql);
              if($result)
              {
                $count = count($result);
                $updated_date = date("Y-m-d H:i:s");
                for($i=0;$i<$count;$i++)
                {
                  $status = $this->Get_Doc_Status($result[$i]['course_id']);
                  if((int)$status > 0)
                  {
                    $status = 1;
                  }
                  else
                  {
                    $status = 0;
                  }
                  $sql = "INSERT INTO `approval_course`(`teacher_id`, `course_id`, `status`, `level_approve`, `comment`, `semester_id`,`date`)
                  VALUES ('".$teacher_id."','".$result[$i]['course_id']."','".$status."','1',null,".$this->DEADLINE['id'].",'".$updated_date."')";
                    $result_add_new_approval = $this->DB->Insert_Update_Delete($sql);
                    if(!$result_add_new_approval)
                    {
                      $return['status'] = 'error';
                      $return['msg'] = 'ไม่สามารถเพิ่มข้อมูลได้';
                    }
                    $sql = "SELECT `instructor_id` FROM `approval_special`
                    WHERE `course_id` = '".$result[$i]['course_id']."' AND `semester_id` = ".$this->DEADLINE['id'];
                    $result_instructor = $this->DB->Query($sql);
                    if($result_instructor)
                    {
                      $count_instructor = count($result_instructor);
                      for($j=0;$j<$count_instructor;$j++)
                      {
                        $status_instructor = $this->Get_Instructor_Status($result_instructor[$j]['instructor_id'],$result[$i]['course_id']);
                        if((int)$status_instructor > 0)
                        {
                          $status_instructor = 1;
                        }
                        else
                        {
                          $status_instructor = 0;
                        }
                        $sql ="INSERT INTO `approval_special`(`instructor_id`,`teacher_id`,`course_id`,`level_approve`, `status`, `comment`, `semester_id`, `updated_date`)
                        VALUES ('".$result_instructor[$j]['instructor_id']."','".$teacher_id."','".$result[$i]['course_id']."','1','".$status_instructor."',null,".$this->DEADLINE['id'].",'".$updated_date."')";
                        $result_add_new_instructor = $this->DB->Insert_Update_Delete($sql);
                        if(!$result_add_new_instructor)
                        {
                          $return['status'] = 'error';
                          $return['msg'] = 'ไม่สามารถเพิ่มข้อมูลได้';
                        }
                      }
                    }
                }
              }
              $return['status'] = 'success';
              $return['msg'] = 'เพิ่มข้อมูลสำเร็จ';
            }
            else
            {
              $return['status'] = 'error';
              $return['msg'] = 'ไม่สามารถเพิ่มข้อมูลได้';
            }
        }
        else
        {
          $return['status'] = 'error';
          $return['msg'] = 'อาจารย์ท่านนี้อยู่ในคณะกรรมการแล้ว';
        }
      }
      else
      {
        $return['status'] = 'error';
        $return['msg'] = 'ภาควิชาผิดพลาด กรุณาติดต่อผู้ดูแลระบบ';
      }
      return $return;
    }
    else
    {
      $return['status'] = 'error';
      $return['msg'] = 'ไม่พบข้อมูลอาจารย์ท่านนี้ในฐานข้อมูล กรุณาติดต่อผู้ดูแลระบบ';
      return $return;
    }

  }

// delete assessor in group
  public function Delete_Assessor($group_num,$teacher_name,$department_id)
  {
    $teacher_id = $this->Get_Teacher_Id($teacher_name);
    if($teacher_id != false)
    {
      if($department_id != false)
      {
        if($department_id == '1202')
        {
          $group_num = '1'.$group_num;
        }
        else if($department_id == '1203')
        {
          $group_num = '2'.$group_num;
        }
        else
        {
          $return['status'] = 'error';
          $return['msg'] = 'ไม่สามารถลบข้อมูลได้';
          $this->LOG->Write("delete assessor failed : teacher is in department ".$department_id );
          return $return;
        }
        $this->DB->Change_DB($this->DEFAULT_DB);
        $sql = "DELETE FROM `group_assessor` WHERE `teacher_id` = '".$teacher_id."' AND `group_num` = '".$group_num."'";
        $result = $this->DB->Insert_Update_Delete($sql);
        if($result)
        {
          $sql = "SELECT `course_id` FROM `subject_assessor`
          WHERE `assessor_group_num` = '".$group_num."'
            AND `semester_id` = '".$this->DEADLINE['id']."'";
          $result = $this->DB->Query($sql);
          if($result || $result == null)
          {
            $count = count($result);
            for($i=0;$i<$count;$i++)
            {
              $sql = "DELETE FROM `approval_course`
              WHERE `course_id` = '".$result[$i]['course_id']."' AND teacher_id = '".$teacher_id."'
              AND `semester_id` = ".$this->DEADLINE['id'];
              $result_remove_approval = $this->DB->Insert_Update_Delete($sql);
              if($result_remove_approval)
              {
                $sql = "DELETE FROM `approval_special`
                WHERE `course_id` = '".$result[$i]['course_id']."' AND teacher_id = '".$teacher_id."'
                AND `semester_id` = ".$this->DEADLINE['id'];
                $result_remove_approval = $this->DB->Insert_Update_Delete($sql);
                if($result_remove_approval)
                {
                  $return['status'] = 'success';
                  $return['msg'] = 'ลบข้อมูลสำเร็จ';
                }
                else
                {
                  $return['status'] = 'error';
                  $return['msg'] = 'ไม่สามารถลบข้อมูลได้';
                  $this->LOG->Write("delete assessor failed : cannot delete approval_special table" );
                  return $return;
                }
              }
              else
              {
                $return['status'] = 'error';
                $return['msg'] = 'ไม่สามารถลบข้อมูลได้';
                $this->LOG->Write("delete assessor failed : cannot delete approval_course table" );
                return $return;
              }
            }
          }
          else
          {
            $return['status'] = 'error';
            $return['msg'] = 'ไม่สามารถลบข้อมูลได้';
            $this->LOG->Write("delete assessor failed : cannot search course_id in subject_assessor table" );
            return $return;
          }
        }
        else
        {
          $return['status'] = 'error';
          $return['msg'] = 'ไม่สามารถลบข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ';
          $this->LOG->Write("delete assessor failed : cannot delete group_assessor table" );
          return $return;
        }
      }
      else
      {
        $return['status'] = 'error';
        $return['msg'] = 'ภาควิชาผิดพลาด กรุณาติดต่อผู้ดูแลระบบ';
        $this->LOG->Write("delete assessor failed : not found department id" );
        return $return;
      }
    }
    else
    {
      $return['status'] = 'error';
      $return['msg'] = 'ไม่พบข้อมูลอาจารย์ท่านนี้ในฐานข้อมูล กรุณาติดต่อผู้ดูแลระบบ';
      $this->LOG->Write("delete assessor failed : not found teacher id" );
      return $return;
    }
    $return['status'] = 'success';
    $return['msg'] = 'ลบข้อมูลสำเร็จ';
    return $return;
  }

//search assessor data
  public function Search_Assessor($department_id)
  {
    $DATA = array();
    if($department_id == '1202')
    {
      $dept_group = '1';
    }
    else if($department_id == '1203')
    {
      $dept_group = '2';
    }
    else
    {
      $dept_group = '0';
    }
    $sql = "SELECT `teacher_id`,`group_num` FROM `group_assessor` WHERE group_num LIKE '".$dept_group."%' ORDER BY cast(group_num as unsigned) ASC ";
    $this->DB->Change_DB($this->DEFAULT_DB);
    $result = $this->DB->Query($sql);
    if($result)
    {
      for($i=0;$i<count($result);$i++)
      {
          $group_num = substr($result[$i]['group_num'], 1);
          $teacher_name = $this->Get_Teacher_Name($result[$i]['teacher_id']);
          $check = 0;
          for($j=0;$j<count($DATA);$j++)
          {
            if($DATA[$j]['group'] == $group_num)
            {
              array_push($DATA[$j]['assessor'],$teacher_name);
              $check = 1;
              break;
            }
            unset($data);
          }
          if($check == 0)
          {
            $data['group'] = $group_num;
            $data['assessor'] = array();
            array_push($data['assessor'],$teacher_name);
            array_push($DATA,$data);
          }
      }
    }
    else
    {
      $DATA['status'] = 'error';
      $DATA['msg'] = 'เกิดข้อผิดพลาด กรุณาติดต่อผู้ดูแลระบบ';
    }
    return $DATA;
  }
// get CV file path
  public function Get_CV($instructor_id)
  {
    $sql = "SELECT `cv` FROM `special_instructor` WHERE `instructor_id` = '".$instructor_id."'";
    $this->DB->Change_DB($this->DEFAULT_DB);
    $result = $this->DB->Query($sql);
    if($result)
    {
      $file_name = $result[0]['cv'];
      $path = "/cv/".$file_name;
      return $path;
    }
    else
    {
        return null;
    }
  }

//search teacher signature file
  public function Get_Teacher_Signature($teacher_id)
  {
    global $SIGNATURE_PATH;
    $this->DB->Change_DB($this->PERSON_DB);
    $sql = "SELECT `files_sig` FROM `staff` WHERE `code` = '".$teacher_id."'";
    $result = $this->DB->Query($sql);
    $this->DB->Change_DB($this->DEFAULT_DB);
    if($result)
    {
      $filename = $result[0]['files_sig'];
      if($filename != '')
      {
        if(file_exists($SIGNATURE_PATH."/".$filename))
        {
          $file_path = $SIGNATURE_PATH."/".$filename;
          return $file_path;
        }
        else
        {
          return null;
        }
      }
      else
      {
        return null;
      }

    }
    else
    {
      return null;
    }

  }

//get head of department id
  public function Get_Head_Department($dept_id,$course_id)
  {
    if($dept_id == null)
    {
      $this->DB->Change_DB($this->DEFAULT_DB);
      $sql = "SELECT `department_id` FROM `department_course_responsible` WHERE `course_id` = '".$course_id."' AND `semester_id` = ".$this->DEADLINE['id'];
      $result = $this->DB->Query($sql);
      if($result)
      {
        $dept_id = $result[0]['department_id'];
      }
    }
    //1203,X011 = science, 1202,X012 = care
    if($dept_id == '1202')
    {
      $position_dean = 'X012';
    }
    else if ($dept_id == '1203')
    {
      $position_dean = 'X011';
    }
    else
    {
      return false;
    }
    $this->DB->Change_DB($this->PERSON_DB);
    $sql = "SELECT `code` FROM `staff` WHERE `position_dean` = '".$position_dean."'";
    $result = $this->DB->Query($sql);
    if($result)
    {
      return $result[0]['code'];
    }
    else
    {
      return false;
    }
  }
  public function Get_Grant(){
    $DATA="";
    $this->DB->Change_DB($this->DEFAULT_DB);
    $sql    = 'SELECT * FROM grant_approve';
    $result = $this->DB->Query($sql);
    if ($result) {
      $name   = $this->Get_Teacher_Name($result[0]['user_id']);
      $DATA   = array('user_id' => $result[0]["user_id"] ,'user_name' =>$name,'status'=>$result[0]['status'],'startdate'=>$result[0]['date_start'],'enddate'=>$result[0]['date_end'] );
    }
    return $DATA;
  }

  public function Check_Grant($teacher){

    $this->DB->Change_DB($this->DEFAULT_DB);
    $sql = 'SELECT * FROM grant_approve WHERE user_id = "'.$teacher.'"';
    $result = $this->DB->Query($sql);
    $now = strtotime(date("Y-m-d")) ;
    $start = strtotime($result[0]['date_start']);

    $end = strtotime($result[0]['date_end']);

    if ($result) {
      if ($now>=$start && $now<=$end ) {

          if ($_SESSION['level']==1) {
            $_SESSION['admission']=1;//permission teacher
          }
          if ($_SESSION['level']==2) {
            $_SESSION['admission']=2;//permission staff department
          }
          if($_SESSION['level']==3){
            $_SESSION['admission']=3;//permission staff faculty
          }

          //check assessor
          if ($_SESSION['level']==4) {
            $_SESSION['level']==4;
          }elseif ($_SESSION['level']==5) {
            $_SESSION['level']==5;
          }else {
            $_SESSION['level']=6;
          }
      }
    }else {
      $_SESSION['admission']=0;
    }
    return false;
  }

  public function Is_Assessor($teacher_id)
  {
    $return = array();
    $this->DB->Change_DB($this->DEFAULT_DB);
    $sql = "SELECT `status` FROM `approval_course` WHERE `teacher_id` = '".$teacher_id."' AND `semester_id` = ".$this->DEADLINE['id'];
    $result = $this->DB->Query($sql);
    if($result)
    {
      if(isset($result[0]['status']))
      {
         $return[1] = true;
      }
      else
      {
         $return[1] = false;
      }
    }
    else
    {
       $return[1] = false;
    }

    $sql = "SELECT `education` as level FROM `staff_mis` WHERE `code`='".$teacher_id."'";
    $this->DB->Change_DB($this->PERSON_DB);
    $result = $this->DB->Query($sql);
    $this->DB->Change_DB($this->DEFAULT_DB);
    if($result)
    {
      $return[0] = $result[0]['level'];
    }
    else
     {
        $return[0] = false;
    }
    return $return;
  }

  //close database connection
  public function Close_connection()
  {
    $this->DB->Close_connection();
  }
}



 ?>
