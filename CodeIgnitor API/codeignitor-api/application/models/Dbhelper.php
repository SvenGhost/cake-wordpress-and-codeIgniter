<?php
class Dbhelper extends CI_Model {

	function addRow($tab,$array,$disp=false)	
	{
		$array['created_at'] = date("Y-m-d H:i:s");
		$this->db->insert($tab, $array); 
		return $this->db->insert_id();
	}
	
	//................update record from database [start].................................
	
	function updateRow($tab,$array,$where_field,$where_id)	
	{
		$array['last_updated'] = date("Y-m-d H:i:s");
		$this->db->where($where_field, $where_id);
		$this->db->update($tab, $array); 
	}
	
	function updateAll($tab,$array)	
	{
		$array['last_updated'] = date("Y-m-d H:i:s");
		$this->db->update($tab, $array); 
	}
	
	function updateRowIn($tab,$array,$where_field,$where_id)	
	{
		$array['last_updated'] = date("Y-m-d H:i:s");
		$this->db->where_in($where_field, $where_id);
		$this->db->update($tab, $array); 
	}
	
	//................delete record from database [start].................................
	
	function delRow($tab,$where_field="",$where_id="",$files="")
	{
		/*if(count($files) > 0 && $files <> "")
		{ 
			foreach($files as $field=>$path)
			{ 
			    $file_name = $this->dbhelper->getSingleValue($tab,$field,"$where_field='$where_id'");
				
				if(file_exists($path.$file_name) && $file_name <> "")
				{
					unlink($path.$file_name);
				}
				if(file_exists($path.'thumb/'.$file_name) && $file_name <> "")
				{
					unlink($path.'thumb/'.$file_name);
				}
			}
		}*/
			
		$this->db->where($where_field,$where_id);
		$this->db->delete($tab); 
	}

	function delMultiRowImage($tab,$where_field="",$where_id="",$files="")
	{ //echo 1; exit;
		if(count($files) > 0 && $files <> "")
		{
			foreach($files as $field=>$path)
			{
				foreach($where_id as $k=>$v)
				{  
					$this->db->where_in($where_field, $v);
					$query = $this->db->get($tab); 
					
					foreach ($query->result() as $row)
					{  
						$file_name = $this->dbhelper->getSingleValue($tab,$field,"$where_field=".$row->$where_field,"","","","",true);
						if(file_exists($path.$file_name) && $file_name <> "")
						{
							unlink($path.$file_name);
						}
				    }	
				}
			}
		}
		
		$this->db->where_in($where_field,$where_id);
		$this->db->delete($tab); 
	}

	
	function delRowIn($tab,$where_field="",$where_id="",$files="")
	{
		if(count($files) > 0 && $files <> "")
		{
			foreach($files as $field=>$path)
			{
				$this->db->where_in($where_field, $where_id);
				$query = $this->db->get($tab); 
				
				foreach ($query->result() as $row)
				{
					$file_name = $this->dbhelper->getSingleValue($tab,$field,"$where_field=".$row->$where_field);
					if(file_exists($path.$file_name) && $file_name <> "")
					{
						unlink($path.$file_name);
					}
				}
			}
		}
		
		$this->db->where_in($where_field,$where_id);
		$this->db->delete($tab); 
	}
	
	//................select record from database [start].................................
	
	function selectRows($tab,$fields="*",$where="1=1",$orderby="1",$order="asc",$start="",$end="",$disp=false)
	{	
		$data = array();
		
		if($start <> "" && $end <> "")
		{
			  $qry = "select $fields from $tab where $where order by $orderby $order limit $start ,$end";
		}
		else
		{
			   $qry = "select $fields from $tab where $where order by $orderby $order";
		}	
		
		if($disp)
			echo $qry;
			
		$query = $this->db->query($qry);
		
		foreach ($query->result() as $row)
		{
			$row = $this->stripArraySlashes($row);
			$data[] = $row;
		}
		return $data;	
	}
	
	function selectRowsGroupBy($tab,$fields="*",$where="1=1",$groupBy="",$start="",$end="",$disp=false)
	{	
		$data = array();
		
		if($start <> "" && $end <> "")
		{
			  $qry = "select $fields from $tab where $where $groupBy limit $start ,$end";
		}
		else
		{
			   $qry = "select $fields from $tab where $where $groupBy";
		}	
		
		if($disp)
			echo $qry;
			
		$query = $this->db->query($qry);
		
		foreach ($query->result() as $row)
		{
			$row = $this->stripArraySlashes($row);
			$data[] = $row;
		}
		return $data;	
	}
	
        
    function singleRow($tab,$fields="*",$where="1=1",$disp=false)
	{	
            $data = null;
            $qry = "select $fields from $tab where $where";


            if($disp)
                echo $qry;

            $query = $this->db->query($qry);

            foreach ($query->result() as $row)
            {
                    $row = $this->stripArraySlashes($row);
                    $data = $row;
            }
            return $data;	
	}
	
	//................select innner join record from database [start].................................
	
	function selectRowsInnerJoin($tab1,$tab2,$fields="*",$on,$where="1=1",$disp=false)
	{	
		$data = array();
		
			 $qry = "select $fields from $tab1 inner join $tab2 on $on where $where";
		
		
		if ($disp)
			echo $qry;
			
		$query = $this->db->query($qry);
		foreach ($query->result() as $row)
		{
			$row = $this->stripArraySlashes($row);
			$data[] = $row;
		}
		return $data;	
	}
	
	//................select single record from database [start].................................
	
	function getSingleValue($tab,$field,$where,$disp=false)
	{
		if($where <> "")
		{
			$wheret=" where $where";
		}
		
		$qry = "select $field from $tab $wheret";
		
		if ($disp)
			 echo ($qry); 
			
		$query = $this->db->query($qry);
		if($query)
		{
		
			foreach ($query->result() as $row)
			{
				return $val = stripslashes($row->$field);
			}
		}
		else
		{
			return false;
		}	
		
	}

	

	
	
	function addArraySlashes($arr) 
	{ 
		$ReturnArray = new stdClass;
		foreach ($arr as $k => $v)
		{
			$ReturnArray->$k = (is_array($v)) ? StripArraySlashes($v) : addslashes($v);
		}
		return $ReturnArray;
	}
	
	function stripArraySlashes($arr) 
	{ 
		$ReturnArray = new stdClass;
		foreach ($arr as $k => $v)
		{
			$ReturnArray->$k = (is_array($v)) ? StripArraySlashes($v) : stripslashes($v);
		}
		return $ReturnArray;
	}
}