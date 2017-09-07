<?php
require_once(__DIR__."/database.php");
require_once(__DIR__."/approval.php");
require_once(__DIR__."/manage_deadline.php");
require_once(__DIR__."/../config/configuration_variable.php");
/**
 *
 */
class Person
{

  private $LOG;
  private $DB;
  private $DEADLINE;
  private $FILE_PATH;

  function __construct()
  {
    global $DATABASE,$FILE_PATH;
    # code...
    $this->LOG = new Log();
    $this->DB = new Database();
    $this->DB->Change_DB('person');
    $this->DEFAULT_DB = $DATABASE['NAME'];
    $deadline = new Deadline();
    $this->DEADLINE = $deadline->Get_Current_Semester();
    $this->FILE_PATH = $FILE_PATH;
  }

  public function Get_All_Teacher()
  {
    $sql = "SELECT s.`code` as code,p.`name` as prefix,s.`fname`,s.`lname`
    FROM `staff` s,`prefix` p,`position` po
    WHERE s.`position_code` = po.`code` and s.`prefix_code` = p.`code` AND s.`position_code` = '100000'";
    $this->DB->Change_DB('person');
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
    $this->DB->Change_DB('person');
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

  public function Get_All_Prefix()
  {
    $this->DB->Change_DB('person');
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
  public function Get_Teacher_Id($teacher_name)
  {
    $name = explode(" ",$teacher_name);
    $name_space = count($name);
    if($name_space >= 2)
    {
      $lname = $name[$name_space-1];
      $fname = $name[$name_space-2];
      $sql = "SELECT code FROM `staff` WHERE fname = '".$fname."' AND lname ='".$lname."'";
      $this->DB->Change_DB('person');
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
  public function Get_Staff_Dep($staff_id)
  {
    $sql = "SELECT s.`dep_code`,dep.`name` FROM `staff`s,`department` dep
    WHERE s.`code` = '".$staff_id."' AND s.`dep_code` = dep.`code`";

    $this->DB->Change_DB('person');
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
                for($i=0;$i<$count;$i++)
                {
                  $sql = "INSERT INTO `approval_course`(`teacher_id`, `course_id`, `status`, `level_approve`, `comment`, `semester_id`)
                  VALUES ('".$teacher_id."','".$result[$i]['course_id']."','1','1',null,".$this->DEADLINE['id'].")";
                    $result_add_new_approval = $this->DB->Insert_Update_Delete($sql);
                    if(!$result_add_new_approval)
                    {
                      $return['status'] = 'error';
                      $return['msg'] = 'ไม่สามารถเพิ่มข้อมูลได้';
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
        $this->DB->Change_DB($this->DEFAULT_DB);
        $sql = "DELETE FROM `group_assessor` WHERE `teacher_id` = '".$teacher_id."' AND `group_num` = '".$group_num."'";
        $result = $this->DB->Insert_Update_Delete($sql);
        if($result)
        {
          $sql = "SELECT `course_id` FROM `subject_assessor` WHERE `assessor_group_num` = '".$group_num."'";
          $result = $this->DB->Query($sql);
          if($result)
          {
            $count = count($result);
            for($i=0;$i<$count;$i++)
            {
              $sql = "DELETE FROM `approval_course`
              WHERE `course_id` = '".$result[$i]['course_id']."' AND teacher_id = '".$teacher_id."'";
              $result_remove_approval = $this->DB->Insert_Update_Delete($sql);
              if(!$result_remove_approval)
              {
                $return['status'] = 'error';
                $return['msg'] = 'ไม่สามารถเพิ่มข้อมูลได้';
              }
            }

          }

          $return['status'] = 'success';
          $return['msg'] = 'ลบข้อมูลสำเร็จ';
        }
        else
        {
          $return['status'] = 'error';
          $return['msg'] = 'ไม่สามารถลบข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ';
        }
      }
      else
      {
        $return['status'] = 'error';
        $return['msg'] = 'ภาควิชาผิดพลาด กรุณาติดต่อผู้ดูแลระบบ';
      }
    }
    else
    {
      $return['status'] = 'error';
      $return['msg'] = 'ไม่พบข้อมูลอาจารย์ท่านนี้ในฐานข้อมูล กรุณาติดต่อผู้ดูแลระบบ';
    }
    return $return;
  }

  public function Search_Assessor($department_id)
  {
    $DATA = array();
    if($department_id == '1202')
    {
      $group_num = '1';
    }
    else if($department_id == '1203')
    {
      $group_num = '2';
    }
    for($j=1;$j<=2;$j++)
    {
      $group['group'] = $j;
      $group['assessor'] = array();
      $sql = "SELECT `teacher_id`
      FROM `group_assessor` WHERE `group_num` = '".$group_num.$j."'";
      $this->DB->Change_DB($this->DEFAULT_DB);
      $result = $this->DB->Query($sql);
      if($result)
      {

        for($i=0;$i<count($result);$i++)
        {
            $teacher_name = $this->Get_Teacher_Name($result[$i]['teacher_id']);
            array_push($group['assessor'],$teacher_name);
        }

      }

      array_push($DATA,$group);
      unset($group);
    }
    return $DATA;
  }
  public function Get_CV($instructor_id,$course_id)
  {
    $CV_file = $this->FILE_PATH."/cv/".$course_id."_".$instructor_id."_".$this->DEADLINE['semester']."_".$this->DEADLINE['year'].".doc";
    if (file_exists(realpath($CV_file)))
    {
        $path = "/syllabus/".$course_id."_".$instructor_id."_".$this->DEADLINE['semester']."_".$this->DEADLINE['year'].".doc";
    }
    else
    {
      $CV_file = $this->FILE_PATH."/cv/".$course_id."_".$instructor_id."_".$this->DEADLINE['semester']."_".$this->DEADLINE['year'].".docx";
      if (file_exists(realpath($CV_file)))
      {
          $path = "/syllabus/".$course_id."_".$instructor_id."_".$this->DEADLINE['semester']."_".$this->DEADLINE['year'].".docx";
      }
      else
      {
        $CV_file = $this->FILE_PATH."/cv/".$course_id."_".$instructor_id."_".$this->DEADLINE['semester']."_".$this->DEADLINE['year'].".pdf";
        if (file_exists(realpath($CV_file)))
        {
          $path = "/syllabus/".$course_id."_".$instructor_id."_".$this->DEADLINE['semester']."_".$this->DEADLINE['year'].".docx";
        }
        else
        {
            $path = null;
        }
      }
    }
    return $path;
  }

}



 ?>
