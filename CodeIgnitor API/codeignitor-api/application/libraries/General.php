<?php    
class General {
    protected $CI;
    public function __construct() {
        $this->CI =& get_instance();
    }
    
    public function doUpload($field="",$dir="",$old_file="")
    {
		
        $uniq_img_nm = uniqid();
        $imgname = $_FILES[$field]['name'];

        $config['upload_path'] = $dir;
        $config['allowed_types'] = '*';
        $config['file_name'] = $imgname;


        if($_FILES[$field]['name'] <> "")
        {
            if(file_exists($dir.$old_file) && $old_file <> "")
            {
                unlink($dir.$old_file);
            }

            if (!is_dir($dir))
            {
                $_FILES[$field]['name'];
                mkdir($dir, 777, TRUE);
            }

            $this->CI->load->library('upload', $config);
            $this->CI->upload->initialize($config);

            if ( !  $this->CI->upload->do_upload($field,$old_file))
            {
                return $error = array('error' =>  $this->CI->upload->display_errors());
            }
            else
            {
                $data = array('upload_data' =>  $this->CI->upload->data());
                $file_name = $data['upload_data']['file_name'];
                return $file_name;
            }
        }
        else
        {
            return $old_file;
        }	
    }
    
    public function doMultipleUpload($field="",$dir="")
    {
        $config = array();
        $config['upload_path'] = $dir;
        $config['allowed_types'] = '*';

        $this->CI->load->library('upload');
        $this->CI->upload->initialize($config);

        $files = $_FILES;
        $cpt = count($_FILES[$field]['name']);

        if (!is_dir($dir))
        {
            mkdir($dir, 777, TRUE);
        }

        for($i=0; $i<$cpt; $i++)
        {
            $_FILES[$field]['name']= $files[$field]['name'][$i];
            $_FILES[$field]['type']= $files[$field]['type'][$i];
            $_FILES[$field]['tmp_name']= $files[$field]['tmp_name'][$i];
            $_FILES[$field]['error']= $files[$field]['error'][$i];
            $_FILES[$field]['size']= $files[$field]['size'][$i];    

            $this->CI->upload->initialize($config);
            if (!$this->CI->upload->do_upload($field))
            {
                return $error = array('error' => $this->CI->upload->display_errors());
            }
            else
            {
                $data = array('upload_data' => $this->CI->upload->data());
                $file_name[] = $data['upload_data']['file_name'];
            }
        }

        return $file_name;
    }
	
	public function doMultipleUpload_pdf($field="",$dir="")
    {
        $config = array();
        $config['upload_path'] = $dir;
        $config['allowed_types'] = 'pdf|PDF';

        $this->CI->load->library('upload');
        $this->CI->upload->initialize($config);

        $files = $_FILES;
        $cpt = count($_FILES[$field]['name']);

        if (!is_dir($dir))
        {
            mkdir($dir, 777, TRUE);
        }

        for($i=0; $i<$cpt; $i++)
        {
            $_FILES[$field]['name']= $files[$field]['name'][$i];
            $_FILES[$field]['type']= $files[$field]['type'][$i];
            $_FILES[$field]['tmp_name']= $files[$field]['tmp_name'][$i];
            $_FILES[$field]['error']= $files[$field]['error'][$i];
            $_FILES[$field]['size']= $files[$field]['size'][$i];    

            $this->CI->upload->initialize($config);
            if (!$this->CI->upload->do_upload($field))
            {
                return $error = array('error' => $this->CI->upload->display_errors());
            }
            else
            {
                $data = array('upload_data' => $this->CI->upload->data());
                $file_name[] = $data['upload_data']['file_name'];
            }
        }

        return $file_name;
    }
    public function createDropDown_disable($query,$value="",$fill_value,$comboname="",$ComboClass="",$selectedval="",$id="",$param="",$default="")
    {

        if($value=="")
            $value=$fill_value;

        if($query <> "")
        {
            $query = $this->CI->db->query($query);
            $Combo='<select name="'.$comboname.'" id="'.$id.'" class="'.$ComboClass.'" '.$param.' required disabled>';
            if($default <> "")
            {
                $Combo.="<option value=''>".$default."</option>";
            }
            else
            {
                $Combo.="<option value=''>Select</option>";
            }

            if($query->num_rows() > 0)
            {

                foreach ($query->result() as $get)
                {
                    if($selectedval == $get->$value)
                    {
                        $sel="selected=selected";
                    }
                    else
                    {
                        $sel="";
                    }
                    $Combo.="<option value='".$get->$value."' $sel>".$get->$fill_value."</option>";
                }

            }
        }
        else
        {
            $Combo="<select name='$comboname' id='$id' class='$ComboClass' $param>";
            if($default <> "")
            {
                $Combo.="<option value=''>".$default."</option>";
            }
            else
            {
                $Combo.="<option value=''>Select</option>";
            }
        }

        $Combo.="</select>";
        echo $Combo;    
    }

    public function createDropDown($query,$value="",$fill_value,$comboname="",$ComboClass="",$selectedval="",$id="",$param="",$default="")
    {

        if($value=="")
            $value=$fill_value;

        if($query <> "")
        {
            $query = $this->CI->db->query($query);
            $Combo='<select name="'.$comboname.'" id="'.$id.'" class="'.$ComboClass.'" '.$param.'>';
            if($default <> "")
            {
                $Combo.="<option value=''>".$default."</option>";
            }
            else
            {
                $Combo.="<option value=''>Select</option>";
            }

            if($query->num_rows() > 0)
            {

                foreach ($query->result() as $get)
                {
                    if($selectedval == $get->$value)
                    {
                        $sel="selected=selected";
                    }
                    else
                    {
                        $sel="";
                    }
                    $Combo.="<option value='".$get->$value."' $sel>".$get->$fill_value."</option>";
                }

            }
        }
        else
        {
            $Combo="<select name='$comboname' id='$id' class='$ComboClass' $param>";
            if($default <> "")
            {
                $Combo.="<option value=''>".$default."</option>";
            }
            else
            {
                $Combo.="<option value=''>Select</option>";
            }
        }

        $Combo.="</select>";
        echo $Combo;	
    }

    public function createDropDown_search($query,$value="",$fill_value,$comboname="",$ComboClass="",$selectedval="",$id="",$param="",$default="")
    {
        if($value=="")
            $value=$fill_value;

        if($query <> "")
        {
            $query = $this->CI->db->query($query);
            $Combo='<select name="'.$comboname.'" id="'.$id.'" class="'.$ComboClass.'" '.$param.'data-live-search="true" style="color: #686871;background-color: #fff;">';
            if($default <> "")
            {
                $Combo.="<option value=''>".$default."</option>";
            }
            else
            {
                $Combo.="<option value=''>Select</option>";
            }

            if($query->num_rows() > 0)
            {

                foreach ($query->result() as $get)
                {
                    if($selectedval == $get->$value)
                    {
                        $sel="selected=selected";
                    }
                    else
                    {
                        $sel="";
                    }
                    $Combo.="<option value='".$get->$value."' $sel>".$get->$fill_value."</option>";
                }

            }
        }
        else
        {
            $Combo="<select name='$comboname' id='$id' class='$ComboClass' $param>";
            if($default <> "")
            {
                $Combo.="<option value=''>".$default."</option>";
            }
            else
            {
                $Combo.="<option value=''>Select</option>";
            }
        }

        $Combo.="</select>";
        echo $Combo;    
    }		public function createDropDown_search_2($query,$value="",$fill_value,$comboname="",$ComboClass="",$selectedval="",$id="",$param="",$default="")    {        if($value=="")            $value=$fill_value;        if($query <> "")        {            $query = $this->CI->db->query($query);            $Combo='<select name="'.$comboname.'" id="'.$id.'" class="'.$ComboClass.'" '.$param.' data-live-search="true" style="color: #686871;background-color: #fff;">';            if($default <> "")            {                $Combo.="<option value=''>".$default."</option>";            }            else            {                $Combo.="<option value=''>Select</option>";            }            if($query->num_rows() > 0)            {                foreach ($query->result() as $get)                {                    if($selectedval == $get->$value)                    {                        $sel="selected=selected";                    }                    else                    {                        $sel="";                    }                    $Combo.="<option value='".$get->$value."' $sel>".$get->$fill_value."</option>";                }            }        }        else        {            $Combo="<select name='$comboname' id='$id' class='$ComboClass' $param>";            if($default <> "")            {                $Combo.="<option value=''>".$default."</option>";            }            else            {                $Combo.="<option value=''>Select</option>";            }        }        $Combo.="</select>";        echo $Combo;        }

    public function createDropDown_search_product($query,$value="",$fill_value,$comboname="",$ComboClass="",$selectedval="",$id="",$param="",$default="")
    {
        if($value=="")
            $value=$fill_value;

        if($query <> "")
        {
            $query = $this->CI->db->query($query);
            $Combo='<select name="'.$comboname.'" id="'.$id.'" class="'.$ComboClass.'" '.$param.' data-live-search="true" style="color: #686871;background-color: #fff;">';
            if($default <> "")
            {
                $Combo.="<option value=''>".$default."</option>";
            }
            else
            {
                $Combo.="<option value=''>Select</option>";
            }

            if($query->num_rows() > 0)
            {

                foreach ($query->result() as $get)
                {
                    if($selectedval == $get->$value)
                    {
                        $sel="selected=selected";
                    }
                    else
                    {
                        $sel="";
                    }
                    //$Combo.="<option value='".$get->$value."' $sel>".$get->$fill_value."</option>";
                    $Combo.="<option value='".$get->$value."' $sel>".str_replace("'","",$get->$fill_value)."</option>"; 
                }

            }
        }
        else
        {
            $Combo="<select name='$comboname' id='$id' class='$ComboClass' $param>";
            if($default <> "")
            {
                $Combo.="<option value=''>".$default."</option>";
            }
            else
            {
                $Combo.="<option value=''>Select</option>";
            }
        }

        $Combo.="</select>";
        echo $Combo;    
    }

   

    public function createDropDown_ii_product($query,$value="",$fill_value,$comboname="",$ComboClass="",$selectedval="",$id="",$param="",$default="")
    {

        if($value=="")
            $value=$fill_value;

        if($query <> "")
        {
            $query = $this->CI->db->query($query);
            $Combo='<select name="'.$comboname.'" id="'.$id.'" class="'.$ComboClass.'" '.$param.'>';
            if($default <> "")
            {
                $Combo.="<option value=''>".$default."</option>";
            }
            else
            {
                $Combo.="<option value=''>Select</option>";
            }

            if($query->num_rows() > 0)
            {
                foreach ($query->result() as $get)
                {
                    if($selectedval == $get->$value)
                    {
                        $sel="selected=selected";
                    }
                    else
                    {
                        $sel="";
                    }
                    $Combo.="<option value='".$get->$value."' $sel>".str_replace("'","",$get->$fill_value)."</option>"; 
                    //$Combo.="<option value='".$get->$value."' $sel>".trim($get->$fill_value, "'")."</option>"; 
                }

            }
        }
        else
        {
            $Combo="<select name='$comboname' id='$id' class='$ComboClass' $param>";
            if($default <> "")
            {
                $Combo.="<option value=''>".$default."</option>";
            }
            else
            {
                $Combo.="<option value=''>Select</option>";
            }
        }

        $Combo.="</select>";
        echo $Combo;    
    }

    public function createDropDown_enquiry_product($query,$value="",$fill_value,$comboname="",$ComboClass="",$selectedval="",$id="",$param="",$default="")
    {

        if($value=="")
            $value=$fill_value;

        if($query <> "")
        {
            $query = $this->CI->db->query($query);
            $Combo='<select required name="'.$comboname.'" id="'.$id.'" class="'.$ComboClass.'" '.$param.' multiple="multiple" data-placeholder="Select Product" >';
            if($default <> "")
            {
                //$Combo.="<option value=''>".$default."</option>";
            }
            else
            {
                $Combo.="<option value=''>Select</option>";
            }

            if($query->num_rows() > 0)
            {

                foreach ($query->result() as $get)
                {
                    if($selectedval == $get->$value)
                    {
                        $sel="selected=selected";
                    }
                    else
                    {
                        $sel="";
                    }
                    $Combo.="<option value='".$get->$value."' $sel>".$get->$fill_value."</option>";
                }

            }
        }
        else
        {
            $Combo="<select name='$comboname' id='$id' class='$ComboClass' $param>";
            if($default <> "")
            {
                $Combo.="<option value=''>".$default."</option>";
            }
            else
            {
                $Combo.="<option value=''>Select</option>";
            }
        }

        $Combo.="</select>";
        echo $Combo;    
    }

    public function createDropDown_assign_user($query,$value="",$fill_value,$comboname="",$ComboClass="",$selectedval="",$id="",$param="",$default="")
    {

        if($value=="")
            $value=$fill_value;

        if($query <> "")
        {
            $query = $this->CI->db->query($query);
            $Combo='<select required name="'.$comboname.'" id="'.$id.'" class="'.$ComboClass.'" '.$param.' multiple="multiple" data-placeholder="Select User to Assign" >';
            if($default <> "")
            {
                //$Combo.="<option value=''>".$default."</option>";
            }
            else
            {
                $Combo.="<option value=''>Select</option>";
            }

            if($query->num_rows() > 0)
            {

                foreach ($query->result() as $get)
                {
                    if($selectedval == $get->$value)
                    {
                        $sel="selected=selected";
                    }
                    else
                    {
                        $sel="";
                    }
                    $Combo.="<option value='".$get->$value."' $sel>".$get->$fill_value."</option>";
                }

            }
        }
        else
        {
            $Combo="<select name='$comboname' id='$id' class='$ComboClass' $param>";
            if($default <> "")
            {
                $Combo.="<option value=''>".$default."</option>";
            }
            else
            {
                $Combo.="<option value=''>Select</option>";
            }
        }

        $Combo.="</select>";
        echo $Combo;    
    }

    public function createDropDown_product($query,$value="",$fill_value,$comboname="",$ComboClass="",$selectedval="",$id="",$param="",$default="")
    {

        if($value=="")
            $value=$fill_value;

        if($query <> "")
        {
            $query = $this->CI->db->query($query);
            $Combo='<select name="'.$comboname.'" id="'.$id.'" class="'.$ComboClass.'" '.$param.'>';
            if($default <> "")
            {
                $Combo.="<option value=''>".$default."</option>";
            }
            else
            {
                $Combo.="<option value=''>Select</option>";
            }

            if($query->num_rows() > 0)
            {

                foreach ($query->result() as $get)
                {
                    if($selectedval == $get->$value)
                    {
                        $sel="selected=selected";
                    }
                    else
                    {
                        $sel="";
                    }
                    $Combo.="<option value='".$get->$value."' $sel>".$get->$fill_value."</option>";
                }

            }
        }
        else
        {
            $Combo="<select name='$comboname' id='$id' class='$ComboClass' $param>";
            if($default <> "")
            {
                $Combo.="<option value=''>".$default."</option>";
            }
            else
            {
                $Combo.="<option value=''>Select</option>";
            }
        }

        $Combo.="</select>";
        echo $Combo;    
    }

    public function createDropDown_nn($query,$value="",$fill_value,$comboname="",$ComboClass="",$selectedval="",$id="",$param="",$default="")
    {

        if($value=="")
            $value=$fill_value;

        if($query <> "")
        {
            $query = $this->CI->db->query($query);
            $Combo='<select name="'.$comboname.'" id="'.$id.'" class="'.$ComboClass.'" '.$param.'>';
            if($default <> "")
            {
                $Combo.="<option value='0'>".$default."</option>";
            }
            else
            {
                $Combo.="<option value=''>Select</option>";
            }

            if($query->num_rows() > 0)
            {

                foreach ($query->result() as $get)
                {
                    if($selectedval == $get->$value)
                    {
                        $sel="selected=selected";
                    }
                    else
                    {
                        $sel="";
                    }
                    $Combo.="<option value='".$get->$value."' $sel>".$get->$fill_value."</option>";
                }

            }
        }
        else
        {
            $Combo="<select name='$comboname' id='$id' class='$ComboClass' $param>";
            if($default <> "")
            {
                $Combo.="<option value='0'>".$default."</option>";
            }
            else
            {
                $Combo.="<option value=''>Select</option>";
            }
        }

        $Combo.="</select>";
        echo $Combo;    
    }

    public function createDropDown_nn2($query,$value="",$fill_value,$comboname="",$ComboClass="",$selectedval="",$id="",$param="",$default="")
    {

        if($value=="")
            $value=$fill_value;

        if($query <> "")
        {
            $query = $this->CI->db->query($query);
            $Combo='<select name="'.$comboname.'" id="'.$id.'" class="'.$ComboClass.'" '.$param.'>';
            if($default <> "")
            {
                $Combo.="<option value=''>".$default."</option>";
            }
            else
            {
                $Combo.="<option value=''>Select</option>";
            }

            if($query->num_rows() > 0)
            {

                foreach ($query->result() as $get)
                {
                    if($selectedval == $get->$value)
                    {
                        $sel="selected=selected";
                    }
                    else
                    {
                        $sel="";
                    }
                    $Combo.="<option value='".$get->$value."' $sel>".$get->$fill_value."</option>";
                }

            }
        }
        else
        {
            $Combo="<select name='$comboname' id='$id' class='$ComboClass' $param>";
            if($default <> "")
            {
                $Combo.="<option value=''>".$default."</option>";
            }
            else
            {
                $Combo.="<option value=''>Select</option>";
            }
        }

        $Combo.="</select>";
        echo $Combo;    
    }

    public function createDropDownBox($query,$value="",$fill_value,$comboname="",$ComboClass="",$selectedval="",$id="",$param="",$default="")
    {
        if($value=="")
            $value=$fill_value;

        if($query <> "")
        {
            $query = $this->CI->db->query($query);
            $Combo="<select name='$comboname' id='$id' class='$ComboClass' $param>";
            if($default <> "")
            {
                $Combo.="<option value='' disabled selected>".$default."</option>";
            }
            else
            {
                $Combo.="<option value='' disabled>Select</option>";
            }

            if($query->num_rows() > 0)
            {

                foreach ($query->result() as $get)
                {
                    if($selectedval == $get->$value)
                    {
                        $sel="selected=selected";
                    }
                    else
                    {
                        $sel="";
                    }
                    $Combo.="<option value=\"".$get->$value."\" $sel>".$get->$fill_value."</option>";
                }

            }
        }
        else
        {
            $Combo="<select name='$comboname' id='$id' class='$ComboClass' $param>";
            if($default <> "")
            {
                $Combo.="<option value=''>".$default."</option>";
            }
            else
            {
                $Combo.="<option value=''>Select</option>";
            }
        }

        $Combo.="</select>";
        echo $Combo;	
    }

    

    public function validChr($str)
    {
        return preg_match('/^[A-Za-z0-9_~\-!@#\$%\^,.?&*\(\)]+$/',$str);
    }

    
    
    public function generate_id($num) 
    {
        $start_dig = 4;
        $num_dig = strlen($num);

        $id = $num;
        if($num_dig <= $start_dig) 
        {
            $num_zero = $start_dig - $num_dig;
            for($i=0;$i< $num_zero; $i++) 
            {
                $id = '0' . $id;
            }   
        }
        
        $id = 'INV-' . $id;
        return $id;
    }

    

    function generateEmailtemplate($msg="",$userinfo="",$eventAry="")
	{
		print_r($eventAry);
		$output="";
		$output.='
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		   <tbody>
			  <tr>
				 <td style="padding: 10px 0px 30px;">
					<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid rgb(00, 00, 00); border-collapse: collapse;">
					   <tbody> 
						  <tr>
							 <td bgcolor="#b4b9b7" style="border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(164, 141, 75);"><a href="[BASE_URL]" target="_blank"><img src="[DOMAIN]assets/images/logo.png" border="0" style="width: 25%;"></a></td>
						  </tr>
						  <tr>
							 <td bgcolor="#ffffff" style="padding: 12px;">
								<table border="0" cellpadding="0" cellspacing="0" width="100%">
								   <tbody>
									  <tr>
										 <td height="25" valign="top" style="color: rgb(21, 54, 67); font-family: Arial, sans-serif; font-size: 15px;">
											<p>Hello [USER_NAME],</p>
										 </td>
									  </tr>
									  <tr>
										 <td height="25" style="color: rgb(21, 54, 67); font-family: Arial, sans-serif; font-size: 15px;">'.$msg.'</td>
									  </tr>
									  <tr>
										 <td height="25" style="color: rgb(21, 54, 67); font-family: Arial, sans-serif; font-size: 15px;"></td>
									  </tr>';
                                      
									  if($userinfo <> "")
										{
											 $output.='<tr>
											 <td height="25">
												<table>';
												if(count($userinfo) > 0 && $userinfo <> "")
												{
													foreach($userinfo as $data_key=>$data_val)
													{
													  $output.='
													  <tr>
														<td>'.$data_key.': '.$data_val.'</td>
													  </tr>';
													}
												}	 
												$output.='</table>
											 </td>
										  </tr><tr>
										<td height="25"></td></tr>';
										}
									   $output.='<tr>
										 <td height="25" style="color: rgb(21, 54, 67); font-family: Arial, sans-serif; font-size: 15px;"></td>
									  </tr>
									  <tr>
										 <td style="color: rgb(21, 54, 67); font-family: Arial, sans-serif; font-size: 15px;">Thank You</td>
									  </tr>
								   </tbody>
								</table>
								
							 </td>
						  </tr>
						
					   </tbody>
					</table>
				 </td>
			  </tr>
		   </tbody>
		</table>
		';
		return $output;
	}
	
    public function check_number_duplicate($table_name,$number)
    {
		$chkdata_vail =  $this->CI->dbhelper->getSingleValue($table_name,"count(*)","phone_no = '".$number."'");

        if($chkdata_vail == 0)
        {
           $result = "0";
        }
        else
        {
            $result = "1";
        }
		
		return $result;
    }
	
	public function check_email_duplicate($table_name,$email)
    {
		$chkdata_vail =  $this->CI->dbhelper->getSingleValue($table_name,"count(*)","email = '".$email."'");

        if($chkdata_vail == 0)
        {
           $result = "0";
        }
        else
        {
            $result = "1";
        }
		
		return $result;
    }

    function GetCats($parent, $level, $par,$m_id,$disable=false)
    {

        $result =$this->CI->dbhelper->selectRows("competition_category a LEFT OUTER JOIN (SELECT parent_id, COUNT(*) AS Count FROM competition_category GROUP BY parent_id) Deriv1 ON a.category_id = Deriv1.parent_id","a.category_id, a.category_name,a.category_order,Deriv1.Count","a.parent_id=".$parent."","a.category_order","ASC");
    
        // echo "<pre>";
        // print_r($result);exit;
        $lstcnt=0;
        for($i=1;$i<=$level;$i++)
        {
            $des.='&mdash;&mdash;';
        }
        foreach($result as $result_val)
        {
            if ($result_val->Count > 0) 
            {
                if($result_val->category_id == $par)
                {
                    $selected='selected="selected"';
                }else{
                    $selected='';
                }
                if($disable)
                {
                    $dis="disabled='disabled'";
                }
                if($result_val->category_id <> $m_id)
                {
                    echo  "<option ".$dis." value='".$result_val->category_id."' $selected>".$des."&rsaquo;".$result_val->category_name."</option>";
                }
                $this->General->GetCats($result_val->category_id, $level + 1,$par,$m_id);
            }
            elseif ($result_val->Count==0) 
            {
                if($result_val->category_id==$par)
                {
                    $selected='selected="selected"';
                }else{
                    $selected='';
                }
                if($result_val->category_id <> $m_id)
                {
                    echo  "<option value='".$result_val->category_id."' $selected>".$des."&rsaquo;".$result_val->category_name."</option>";
                }
            } 
        
        }   
    }

    function GetCats_nnn($uu_id,$parent, $level, $par,$m_id)
    {
    	$result = $this->CI->dbhelper->selectRows("category a LEFT OUTER JOIN (SELECT c_parent_id, COUNT(*) AS Count FROM category GROUP BY c_parent_id) Deriv1 ON a.c_id = Deriv1.c_parent_id","a.c_id, a.c_name,a.c_order,Deriv1.Count","a.c_parent_id=".$parent." and a.company_id=".$uu_id."","a.c_order","ASC","","",true); 
 
		$lstcnt=0; 
        for($i=1;$i<=$level;$i++)  
        {
            $des.='&mdash;&mdash;';
        }
        foreach($result as $result_val)
        {
            if ($result_val->Count > 0) 
            {
                if($result_val->c_id == $par)
                {
                    $selected='selected="selected"';
                }
                else
                {
                    $selected='';
                }
                if($disable)
                {
                    $dis="disabled='disabled'";
                }
                if($result_val->c_id <> $m_id)
                {
                    echo  "<option ".$dis." value='".$result_val->c_id."' $selected>".$des."&rsaquo;".$result_val->c_name."</option>";
                }
                $this->GetCats_nnn($uu_id,$result_val->c_id, $level + 1,$par,$m_id);  
            }
            elseif ($result_val->Count==0) 
            {
                if($result_val->c_id==$par)
                {
                    $selected='selected="selected"';
                }
                else
                {
                    $selected='';
                }
                if($result_val->c_id <> $m_id)
                {
                    echo  "<option value='".$result_val->c_id."' $selected>".$des."&rsaquo;".$result_val->c_name."</option>";
                }
            } 
        
        }   
    }

    function GetCats_api($uu_id,$parent, $level, $par,$m_id)
    {
        $result = $this->CI->dbhelper->selectRows("category a LEFT OUTER JOIN (SELECT c_parent_id, COUNT(*) AS Count FROM category GROUP BY c_parent_id) Deriv1 ON a.c_id = Deriv1.c_parent_id","a.c_id, a.c_name,a.c_order,Deriv1.Count,a.c_parent_id","a.c_parent_id=".$parent." and a.company_id=".$uu_id."","a.c_order","ASC"); 
 
        $lstcnt=0; 
        for($i=1;$i<=$level;$i++)  
        {
            $des.='&mdash;&mdash;';
        }
        foreach($result as $result_val)
        {
            if ($result_val->Count > 0) 
            {
                if($result_val->c_id <> $m_id)
                {
                    $data['cat_name']     = $result_val->c_name;
                    $data['c_id']         = $result_val->c_id;
                    $data['parent_id']    = $result_val->c_parent_id;
                
                }
                $this->GetCats_api($uu_id,$result_val->c_id, $level + 1,$par,$m_id);  
            }
            elseif ($result_val->Count==0) 
            {
                if($result_val->c_id <> $m_id)
                {
                   /* echo  $des."&rsaquo;".$result_val->c_name."/<br>";
                    echo  $des."&rsaquo;".$result_val->c_id."-<br>";*/
                    
                    // echo  $des."&rsaquo;".$data['cat_name'] = $result_val->c_name."-<br>";
                    // echo  $des."&rsaquo;".$data['c_id'] = $result_val->c_id."-<br>";
                    // echo  $des."&rsaquo;".$data['parent_id'] = $result_val->c_parent_id."-<br>";

                    $data['cat_name']   = $result_val->c_name;
                    $data['c_id']       = $result_val->c_id;
                    $data['parent_id']  = $result_val->c_parent_id;
                }
            } 
        }
        return $data; 
    }

    public function convert_number($number) {
        if (($number < 0) || ($number > 999999999)) {
            throw new Exception("Number is out of range");
        }

        $Gn = floor($number / 1000000);
        /* Millions (giga) */
        $number -= $Gn * 1000000;
        $kn = floor($number / 1000);
        /* Thousands (kilo) */
        $number -= $kn * 1000;
        $Hn = floor($number / 100);
        /* Hundreds (hecto) */
        $number -= $Hn * 100;
        $Dn = floor($number / 10);
        /* Tens (deca) */
        $n = $number % 10;
        /* Ones */

        $res = "";

        if ($Gn) {
            $res .= $this->convert_number($Gn) .  "Million";
        }

        if ($kn) {
            $res .= (empty($res) ? "" : " ") .$this->convert_number($kn) . " Thousand";
        }

        if ($Hn) {
            $res .= (empty($res) ? "" : " ") .$this->convert_number($Hn) . " Hundred";
        }

        $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
        $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");

        if ($Dn || $n) {
            if (!empty($res)) {
                $res .= " and ";
            }

            if ($Dn < 2) {
                $res .= $ones[$Dn * 10 + $n];
            } else {
                $res .= $tens[$Dn];

                if ($n) {
                    $res .= "-" . $ones[$n];
                }
            }
        }

        if (empty($res)) {
            $res = "zero";
        }

        return $res;
    }

    public function convert_number_nn($number) {
        $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two','3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six','7' => 'seven', '8' => 'eight', '9' => 'nine','10' => 'ten', '11' => 'eleven', '12' => 'twelve','13' => 'thirteen', '14' => 'fourteen','15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen','18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty','60' => 'sixty', '70' => 'seventy','80' => 'eighty', '90' => 'ninety');

   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    " ," . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';

      if($points<>"")
      {
        $res = $result . "Rupees  " . $points . " Paise";      
      }  
      else
      {
        $res = $result . "Rupees  ";      
      }

        return $res;
    }

    function get_child_class($uu_id,$parent, $par,$m_id)
    {
        $result = $this->CI->dbhelper->selectRows("category a LEFT OUTER JOIN (SELECT c_parent_id, COUNT(*) AS Count FROM category GROUP BY c_parent_id) Deriv1 ON a.c_id = Deriv1.c_parent_id","a.c_id, a.c_name,a.c_order,Deriv1.Count,a.c_parent_id","a.c_parent_id=".$uu_id."","a.c_order","desc"); 
        foreach($result as $result_val)
        {
            if ($result_val->Count > 0) 
            {
                if($result_val->c_id <> $m_id)
                {
                    $sub_data[] = array(
                            "c_id"          => $result_val->c_id,
                            "c_name"        => $result_val->c_name,
                            "c_parent_id"   => $result_val->c_parent_id,
                            //"is_sub_cat"    => $result_val->Count,
                            "children"      => $this->get_child_class($result_val->c_id,"0","0","9999","0"),
                    );
                }
                //$this->get_child_class($uu_id,$result_val->c_id, $level + 1,$par,$m_id);  
            }
            elseif ($result_val->Count==0) 
            {
                if($result_val->c_id <> $m_id)
                {

                    $sub_data[] = array(
                            "c_id"          => $result_val->c_id,
                            "c_name"        => $result_val->c_name,
                            "c_parent_id"   => $result_val->c_parent_id,
                            //"is_sub_cat"    => $result_val->Count,
                            "children"      => "0",
                    );
                }
            } 
        }
        return $sub_data; 
    }

    function get_child_class_new($uu_id,$parent, $par,$m_id)
    {
        $result = $this->CI->dbhelper->selectRows("category a LEFT OUTER JOIN (SELECT c_parent_id, COUNT(*) AS Count FROM category GROUP BY c_parent_id) Deriv1 ON a.c_id = Deriv1.c_parent_id","a.c_id, a.c_name,a.c_order,Deriv1.Count,a.c_parent_id","a.c_parent_id=".$uu_id."","a.c_order","desc"); 
        foreach($result as $result_val)
        {
            if ($result_val->Count > 0) 
            {
                if($result_val->c_id <> $m_id)
                {
                    $tot_products = $this->CI->dbhelper->getSingleValue("products","count(*)","c_id = '".$result_val->c_id."'");

                    if($tot_products>0)
                    {
                        $product_ids = $this->CI->dbhelper->getSingleValue("products","GROUP_CONCAT(p_id)","c_id = '".$result_val->c_id."'");

                         $sub_data[] = array(
                            "c_id"          => $result_val->c_id,
                            "product_ids"   => $product_ids,
                            "children"      => $this->get_child_class_new($result_val->c_id,"0","0","9999","0"),
                    );
                    }
                }
            }
            elseif ($result_val->Count==0) 
            {
                if($result_val->c_id <> $m_id)
                {
                    $tot_products = $this->CI->dbhelper->getSingleValue("products","count(*)","c_id = '".$result_val->c_id."'");

                    if($tot_products>0)
                    {
                        $product_ids = $this->CI->dbhelper->getSingleValue("products","GROUP_CONCAT(p_id)","c_id = '".$result_val->c_id."'");

                         $sub_data[] = array(
                            "c_id"          => $result_val->c_id,
                            "product_ids"   => $product_ids,
                            "children"      => "",
                        );
                    }
                }
            } 
        }
        return $sub_data; 
    }

    function GetCats_filter($uu_id,$parent, $level, $par,$m_id)
    {
        $result = $this->CI->dbhelper->selectRows("category a LEFT OUTER JOIN (SELECT c_parent_id, COUNT(*) AS Count FROM category GROUP BY c_parent_id) Deriv1 ON a.c_id = Deriv1.c_parent_id","a.c_id, a.c_name,a.c_order,Deriv1.Count","a.c_parent_id=".$parent." and a.company_id=".$uu_id."","a.c_order","ASC"); 
        
        if($level==0)
        {
            $sssttt = "style='font-size:18px;color: #2b2b2b;'";
        }
        else if($level==1)
        {
            $sssttt = "style='font-size:16px;'";
        }
        else if($level==2)
        {
            $sssttt = "style='font-size:15px;'";
        }
        else if($level==3)
        {
            $sssttt = "style='font-size:15px;'";
        }

        $lstcnt=0; 
        for($i=1;$i<=$level;$i++)  
        {
            $des.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        }
        foreach($result as $result_val)
        {
            if ($result_val->Count > 0) 
            {
                if($result_val->c_id == $par)
                {
                    $selected='selected="selected"';
                }
                else
                {
                    $selected='';
                }
                if($disable)
                {
                    $dis="disabled='disabled'";
                }
                if($result_val->c_id <> $m_id)
                {
                    $tot_products="";
                    $find_total_product = $this->CI->dbhelper->getSingleValue("products","count(*)","c_id=".$result_val->c_id);

                    if($find_total_product>0)
                    {
                        $tot_products.= "(".$find_total_product.")";
                    }
                    
                    echo  "<option ".$dis." value='".$result_val->c_id."' $selected $sssttt>".$des.$result_val->c_name." $tot_products</option>";
                }
                $this->GetCats_filter($uu_id,$result_val->c_id, $level + 1,$par,$m_id);  
            }
            elseif ($result_val->Count==0) 
            {
                if($result_val->c_id==$par)
                {
                    $selected='selected="selected"';
                }
                else
                {
                    $selected='';
                }
                if($result_val->c_id <> $m_id)
                {
                    $tot_products="";
                    $find_total_product = $this->CI->dbhelper->getSingleValue("products","count(*)","c_id=".$result_val->c_id);

                    if($find_total_product>0)
                    {
                        $tot_products.= "(".$find_total_product.")";
                    }


                    echo  "<option value='".$result_val->c_id."' $selected $sssttt>".$des.$result_val->c_name." $tot_products</option>";
                }
            } 
        
        }   
    }
	
	//All Products for manage products - Ketan @ 11-12-2017
	function GetCats_filter_pro($uu_id,$parent, $level, $par,$m_id)
    {
        $result = $this->CI->dbhelper->selectRows("category a LEFT OUTER JOIN (SELECT c_parent_id, COUNT(*) AS Count FROM category GROUP BY c_parent_id) Deriv1 ON a.c_id = Deriv1.c_parent_id","a.c_id, a.c_name,a.c_order,Deriv1.Count","a.c_parent_id=".$parent." and a.company_id=".$uu_id."","a.c_order","ASC"); 
        
        if($level==0)
        {
            $sssttt = "style='font-size:18px;color: #2b2b2b;'";
			echo  "<option value='0' $selected $sssttt> All Products </option>";
        }
        else if($level==1)
        {
            $sssttt = "style='font-size:16px;'";
        }
        else if($level==2)
        {
            $sssttt = "style='font-size:15px;'";
        }
        else if($level==3)
        {
            $sssttt = "style='font-size:15px;'";
        }

        $lstcnt=0; 
        for($i=1;$i<=$level;$i++)  
        {
            $des.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        }
		
        foreach($result as $result_val)
        {
            if ($result_val->Count > 0) 
            {
                if($result_val->c_id == $par)
                {
                    $selected='selected="selected"';
                }
                else
                {
                    $selected='';
                }
                if($disable)
                {
                    $dis="disabled='disabled'";
                }
                if($result_val->c_id <> $m_id)
                {
                    $tot_products="";
                    $find_total_product = $this->CI->dbhelper->getSingleValue("products","count(*)","c_id=".$result_val->c_id);

                    if($find_total_product>0)
                    {
                        $tot_products.= "(".$find_total_product.")";
                    }
                    
                    echo  "<option ".$dis." value='".$result_val->c_id."' $selected $sssttt>".$des.$result_val->c_name." $tot_products </option>";
                }
                $this->GetCats_filter_pro($uu_id,$result_val->c_id, $level + 1,$par,$m_id);  
            }
            elseif ($result_val->Count==0) 
            {
                if($result_val->c_id==$par)
                {
                    $selected='selected="selected"';
                }
                else
                {
                    $selected='';
                }
                if($result_val->c_id <> $m_id)
                {
                    $tot_products="";
                    $find_total_product = $this->CI->dbhelper->getSingleValue("products","count(*)","c_id=".$result_val->c_id);

                    if($find_total_product>0)
                    {
                        $tot_products.= "(".$find_total_product.")";
                    }
					echo  "<option value='".$result_val->c_id."' $selected $sssttt>".$des.$result_val->c_name." $tot_products</option>";
                }
            } 
        
        }   
    }
	
	//Change Category Order - Ketan @ 12-11-2019
	function GetCats_change_order($uu_id,$parent, $level, $par,$m_id)
    {
        $result = $this->CI->dbhelper->selectRows("category a LEFT OUTER JOIN (SELECT c_parent_id, COUNT(*) AS Count FROM category GROUP BY c_parent_id) Deriv1 ON a.c_id = Deriv1.c_parent_id","a.c_id, a.c_name,a.c_order,Deriv1.Count","a.c_parent_id=".$parent." and a.company_id=".$uu_id."","a.c_order","ASC"); 
        
        if($level==0)
        {
            $sssttt = "style='font-size:18px;color: #2b2b2b;'";
			echo  "<option value='0' $selected $sssttt> All Products </option>";
        }
        else if($level==1)
        {
            $sssttt = "style='font-size:16px;'";
        }
        else if($level==2)
        {
            $sssttt = "style='font-size:15px;'";
        }
        else if($level==3)
        {
            $sssttt = "style='font-size:15px;'";
        }

        $lstcnt=0; 
        for($i=1;$i<=$level;$i++)  
        {
            $des.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        }
		
        foreach($result as $result_val)
        {
            if ($result_val->Count > 0) 
            {
                if($result_val->c_id == $par)
                {
                    $selected='selected="selected"';
                }
                else
                {
                    $selected='';
                }
                if($disable)
                {
                    $dis="disabled='disabled'";
                }
                if($result_val->c_id <> $m_id)
                {
                    $tot_products="";
                    $find_total_product = $this->CI->dbhelper->getSingleValue("products","count(*)","c_id=".$result_val->c_id);

                    if($find_total_product>0)
                    {
                        $tot_products.= "(".$find_total_product.")";
                    }
                    
                    echo  "<option ".$dis." value='".$result_val->c_id."' $selected $sssttt>".$des.$result_val->c_name." $tot_products </option>";
                }
                $this->GetCats_change_order($uu_id,$result_val->c_id, $level + 1,$par,$m_id);  
            }
            elseif ($result_val->Count==0) 
            {
                /*if($result_val->c_id==$par)
                {
                    $selected='selected="selected"';
                }
                else
                {
                    $selected='';
                }
                if($result_val->c_id <> $m_id)
                {
                    $tot_products="";
                    $find_total_product = $this->CI->dbhelper->getSingleValue("products","count(*)","c_id=".$result_val->c_id);

                    if($find_total_product>0)
                    {
                        $tot_products.= "(".$find_total_product.")";
                    }
					echo  "<option value='".$result_val->c_id."' $selected $sssttt>".$des.$result_val->c_name." $tot_products</option>";
                }*/
            } 
        
        }   
    }
	
	function moneyFormatIndia($number)
	{
		//implode('.', $value);
		
		if (strpos($number,'.') !== false) 
		{
			$nn 	= explode('.', $number);
			$number = $number;
		}
		else 
		{
			$number = $number.".00";
		}
		$lenggg = strlen($number);
		
		if($lenggg>=7)
		{	
			if ($number >= 0)
				$sing = ' ';
			else			
				$sing = '-';

			if($number==0)
				return 0;
			
			$n = strval(abs($number));

			$pos = strpos($n, '.');
			
			$whole_num = '';
			$fraction = '00';
			if ($pos === false) {
				$whole_num = $n;
				
			} else {
				$num_arr = explode('.', $n);
				$whole_num = $num_arr[0];
				$fraction = $num_arr[1];
			}
			

			if (strlen($fraction) < 2)
				$fraction .= '0';

			/*  DETERMINE THE FRACTION PART */
			if (intval($fraction) > 0) {
				
				$thired_dig = substr($fraction, 2, 1);

				if (intval($thired_dig) >= 5) {
					$fraction_dig = substr($fraction, 0, 2);
					$fraction_dig_final = $fraction_dig + 1;
				} else {
					$fraction_dig = substr($fraction, 0, 2);
					$fraction_dig_final = $fraction_dig;
				}

			} else {
				$fraction_dig_final = '00';
			}


			$n = strval(abs($whole_num));
			
			$len = strlen($n); //lenght of the no
			
			$thousend = substr($n, $len - 3, 3);
			
			$n = strval(substr($n, 0, $len - 3)); //omit the last 3 digits already stored in $num

			$arr_nums = array();
			while ($n > 1) {
				$len = strlen($n);
				echo $len;
				array_push($arr_nums, substr($n, $len - 2, 2));
				$n = strval(substr($n, 0, $len - 2));
			}

			$arr_nums = array_reverse($arr_nums);
			$whole_num_final = implode(',', $arr_nums) . ',' . $thousend;

			$final_result = $sing . $whole_num_final . '.' . $fraction_dig_final;
			return $final_result;
		}
		else
		{
			return $number;
		}
	}
	
	public function createDropDown_search_new_product($query,$value="",$fill_value,$fill_value_2,$comboname="",$ComboClass="",$selectedval="",$id="",$param="",$default="")
    {
        if($value=="")
            $value=$fill_value;

        if($query <> "")
        {
            $query = $this->CI->db->query($query);
            $Combo='<select name="'.$comboname.'" id="'.$id.'" class="'.$ComboClass.'" '.$param.' data-live-search="true" style="color: #686871;background-color: #fff;">';
            if($default <> "")
            {
                $Combo.="<option value=''>".$default."</option>";
            }
            else
            {
                $Combo.="<option value=''>Select</option>";
            }

            if($query->num_rows() > 0)
            {

                foreach ($query->result() as $get)
                {
					if($selectedval == $get->$value)
                    {
                        $sel="selected=selected";
                    }
                    else
                    {
                        $sel="";
                    }
					
                    //$Combo.="<option value='".$get->$value."' $sel>".$get->$fill_value."</option>";
                    $Combo.="<option value='".$get->$value."' $sel>".$get->$fill_value_2.' - '.str_replace("'","",$get->$fill_value)."</option>"; 
                }

            }
        }
        else
        {
            $Combo="<select name='$comboname' id='$id' class='$ComboClass' $param>";
            if($default <> "")
            {
                $Combo.="<option value=''>".$default."</option>";
            }
            else
            {
                $Combo.="<option value=''>Select</option>";
            }
        }

        $Combo.="</select>";
        echo $Combo;    
    }
	
	public function createDropDown_search_func($query,$value="",$fill_value,$fill_value_2,$comboname="",$ComboClass="",$selectedval="",$id="",$param="",$default="",$onchange="")
    {
        if($value=="")
            $value=$fill_value;

        if($query <> "")
        {
            $query = $this->CI->db->query($query);
            $Combo='<select name="'.$comboname.'" id="'.$id.'" class="'.$ComboClass.'" '.$param.' data-live-search="true" style="color: #686871;background-color: #fff;" '.$onchange.'>';
            if($default <> "")
            {
                $Combo.="<option value=''>".$default."</option>";
            }
            else
            {
                $Combo.="<option value=''>Select</option>";
            }

            if($query->num_rows() > 0)
            {

                foreach ($query->result() as $get)
                {
					if($selectedval == $get->$value)
                    {
                        $sel="selected=selected";
                    }
                    else
                    {
                        $sel="";
                    }
					
                    //$Combo.="<option value='".$get->$value."' $sel>".$get->$fill_value."</option>";
                    $Combo.="<option value='".$get->$value."' $sel>".$get->$fill_value_2.' - '.str_replace("'","",$get->$fill_value)."</option>"; 
                }

            }
        }
        else
        {
            $Combo="<select name='$comboname' id='$id' class='$ComboClass' $param>";
            if($default <> "")
            {
                $Combo.="<option value=''>".$default."</option>";
            }
            else
            {
                $Combo.="<option value=''>Select</option>";
            }
        }

        $Combo.="</select>";
        echo $Combo;    
    }
	
	function mnf($num){
        $nums = explode(".",$num);
        if(count($nums)>2){
            return "0";
        }else{
        if(count($nums)==1){
            $nums[1]="00";
        }
        $num = $nums[0];
        $explrestunits = "" ;
        if(strlen($num)>3){
            $lastthree = substr($num, strlen($num)-3, strlen($num));
            $restunits = substr($num, 0, strlen($num)-3); 
            $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; 
            $expunit = str_split($restunits, 2);
            for($i=0; $i<sizeof($expunit); $i++){

                if($i==0)
                {
                    $explrestunits .= (int)$expunit[$i].","; 
                }else{
                    $explrestunits .= $expunit[$i].",";
                }
            }
            $thecash = $explrestunits.$lastthree;
        } else {
            $thecash = $num;
        }
        return $thecash.".".$nums[1]; 
        }
    }
	
	function rupees_nno($num)
	{
		
		$number = $num;
		$no = round($number);
		$point = round($number - $no, 2) * 100;
		$hundred = null;
		$digits_1 = strlen($no);
		$i = 0;
		$str = array();
		$words = array('0' => '', '1' => 'one', '2' => 'two',
		'3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
		'7' => 'seven', '8' => 'eight', '9' => 'nine',
		'10' => 'ten', '11' => 'eleven', '12' => 'twelve',
		'13' => 'thirteen', '14' => 'fourteen',
		'15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
		'18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
		'30' => 'thirty', '40' => 'forty', '50' => 'fifty',
		'60' => 'sixty', '70' => 'seventy',
		'80' => 'eighty', '90' => 'ninety');
		$digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
		while ($i < $digits_1) 
		{
		$divider = ($i == 2) ? 10 : 100;
		$number = floor($no % $divider);
		$no = floor($no / $divider);
		$i += ($divider == 10) ? 1 : 2;
		if ($number) {
		$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
		$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
		$str [] = ($number < 21) ? $words[$number] .
			" " . $digits[$counter] . $plural . " " . $hundred
			:
			$words[floor($number / 10) * 10]
			. " " . $words[$number % 10] . " "
			. $digits[$counter] . $plural . " " . $hundred;
		} else $str[] = null;
		}
		$str = array_reverse($str);
		$result = implode('', $str);
		$points = ($point) ?
		"." . $words[$point / 10] . " " . 
		  $words[$point = $point % 10] : '';
		//$no = round($number,2);
		if($points<>"")
		{
			//$fin_return = $result . "Rials  " . $no . " Paise";
			$fin_return = $result . "Rials.";
		}
		else
		{
			$fin_return = $result . "Rials  ";
		}
		
		 
		return $fin_return;
	}
	
	function rupees_nno_2($num)
	{
		$number = $num;
		$decimal = round($number - ($no = floor($number)), 2) * 100;
		$hundred = null;
		$digits_length = strlen($no);
		$i = 0;
		$str = array();
		$words = array(0 => '', 1 => 'one', 2 => 'two',
			3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
			7 => 'seven', 8 => 'eight', 9 => 'nine',
			10 => 'ten', 11 => 'eleven', 12 => 'twelve',
			13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
			16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
			19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
			40 => 'forty', 50 => 'fifty', 60 => 'sixty',
			70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
		$digits = array('', 'hundred','thousand','lakh', 'crore');
		while( $i < $digits_length ) {
			$divider = ($i == 2) ? 10 : 100;
			$number = floor($no % $divider);
			$no = floor($no / $divider);
			$i += $divider == 10 ? 1 : 2;
			if ($number) {
				$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
				$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
				$str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
			} else $str[] = null;
		}
		$Rupees = implode('', array_reverse($str));
		$paise = ($decimal) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
		$aa = ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
		
		return $aa;
	}
	
	public function createDropDown_job($query,$value="",$fill_value,$comboname="",$ComboClass="",$selectedval="",$id="",$param="",$default="",$extra="")
    {
        if($value=="")
            $value=$fill_value;

        if($query <> "")
        {
            $query = $this->CI->db->query($query);
            $Combo='<select name="'.$comboname.'" id="'.$id.'" class="'.$ComboClass.'" '.$param.' data-live-search="true" style="color: #686871;background-color: #fff;">';
            if($default <> "")
            {
                $Combo.="<option value=''>".$default."</option>";
            }
            else
            {
                $Combo.="<option value=''>Select</option>";
            }

            if($query->num_rows() > 0)
            {
				foreach ($query->result() as $get)
                {
                    if($selectedval == $get->$value)
                    {
                        $sel="selected=selected";
                    }
                    else
                    {
                        $sel="";
                    }
                    $Combo.="<option value='".$get->$value."' $sel>".$get->$fill_value." - ".$get->$extra."</option>";
                }

            }
        }
        else
        {
            $Combo="<select name='$comboname' id='$id' class='$ComboClass' $param>";
            if($default <> "")
            {
                $Combo.="<option value=''>".$default."</option>";
            }
            else
            {
                $Combo.="<option value=''>Select</option>";
            }
        }

        $Combo.="</select>";
        echo $Combo;    
    }
	
	public function find_branch_id($user_id)
	{
		if($user_id<>"")
		{
			$find_role			= $this->CI->dbhelper->getSingleValue("USERS","ROLE_ID","USER_ID='$user_id'");
			
			if($find_role==1 || $find_role==15)
			{
				$selected_branch 	= $this->CI->dbhelper->getSingleValue("STORE_BRANCH","BRANCH_ID","USER_ID='$user_id'");
			}
			else
			{
				$selected_branch 	= $this->CI->dbhelper->getSingleValue("USERS","BRANCH_ID","USER_ID='$user_id'");
			}
			//echo $selected_branch;exit;
			if($selected_branch<>"" && $selected_branch<>0)
			{
				$sel_branch 	= $selected_branch;
			}
			else
			{
				$sel_branch 	= 0;
			}
		}
		else
		{
			$sel_branch 	= 0;
		}
		
		return $sel_branch;
	}
	
	public function find_date_diff($date1,$date2)
	{
		$date_diff = abs(strtotime($date1) - strtotime($date2));

		$years = floor($date_diff / (365*60*60*24));
		$months = floor(($date_diff - $years * 365*60*60*24) / (30*60*60*24));
		$days = floor(($date_diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

		//printf("%d years, %d months, %d days", $years, $months, $days);
		/*printf("%d",$days);
		printf("\n");*/ 
		
		return $days;
	}
	
	public function room_withhotel($query,$value="",$fill_value,$comboname="",$ComboClass="",$selectedval="",$id="",$param="",$default="",$branch_id="")
    {
        if($value=="")
            $value=$fill_value;

        if($query <> "")
        {
            $query = $this->CI->db->query($query);
            $Combo='<select name="'.$comboname.'" id="'.$id.'" class="'.$ComboClass.'" '.$param.'data-live-search="true" style="color: #686871;background-color: #fff;">';
            if($default <> "")
            {
                $Combo.="<option value=''>".$default."</option>";
            }
            else
            {
                $Combo.="<option value=''>Select</option>";
            }

            if($query->num_rows() > 0)
            {

                foreach ($query->result() as $get)
                {
					$find_hotel_name = $this->CI->dbhelper->getSingleValue("branch","BRANCH_NAME","branch_id='$branch_id'");
					
					
                    if($selectedval == $get->$value)
                    {
                        $sel="selected=selected";
                    }
                    else
                    {
                        $sel="";
                    }
                    $Combo.="<option value='".$get->$value."' $sel>".$get->$fill_value.'-'.$find_hotel_name."</option>";
                }

            }
        }
        else
        {
            $Combo="<select name='$comboname' id='$id' class='$ComboClass' $param>";
            if($default <> "")
            {
                $Combo.="<option value=''>".$default."</option>";
            }
            else
            {
                $Combo.="<option value=''>Select</option>";
            }
        }

        $Combo.="</select>";
        echo $Combo;    
    }	
	
function numberTowords(float $amount)
{
	$amount_after_decimal = round($amount - ($num = floor($amount)), 3) * 100;
	// Check if there is any number after decimal
	$amt_hundred = null;
	$count_length = strlen($num);
	$x = 0;
	$string = array();
	$change_words = array(0 => '', 1 => 'One', 2 => 'Two',
	 3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
	 7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
	 10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
	 13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
	 16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
	 19 => 'Nineteen', 20 => 'Twenty', 25 => 'Twenty Five', 30 => 'Thirty',
	 40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
	 70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
	$here_digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
	while( $x < $count_length ) {
	   $get_divider = ($x == 2) ? 10 : 100;
	   $amount = floor($num % $get_divider);
	   $num = floor($num / $get_divider);
	   $x += $get_divider == 10 ? 1 : 2;
	   if ($amount) {
		 $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
		 $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
		 $string [] = ($amount < 21) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.' 
		 '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. ' 
		 '.$here_digits[$counter].$add_plural.' '.$amt_hundred;
		 }else $string[] = null;
	   }
	$implode_to_Rupees = implode('', array_reverse($string));
	$get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
	" . $change_words[$amount_after_decimal % 10]) . ' Baisa' : '';
	return ($implode_to_Rupees ? $implode_to_Rupees . 'Rials ' : '') . $get_paise;
}

	
}
