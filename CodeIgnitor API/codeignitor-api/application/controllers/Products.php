<?php ini_set('memory_limit', '20000M');

ini_set('max_execution_time', 30000);
defined('BASEPATH') OR exit('No direct script access allowed');
class Products extends CI_Controller 
{
	public function __construct() 
	{
        parent::__construct();
		$load_ajax = & get_instance();

        // GLOBAL DECLARATIONS
        $this->tablename 		= "users";
        $this->upload_dir 		= "./uploads/products/";
		
	}

	public function all_products()
	{
		
		$result 			= array();
		$status				= 0;
		$message 			= "";

		$type 				= $this->input->get_post('type');		
		$auth_token 		= $this->input->get_post('auth_token');		
		
		$data = array();
		
		if(isset($auth_token) && md5($auth_token)==AUTH_CHECK_TOKEN)
		{
			if(isset($type) && $type<>"")
			{
				$where = "product_type like'%".$type."%'";
			}
			else
			{
				$where = "1=1";
			}
			
			$all_products 		= $this->dbhelper->selectRows("products", "*", $where, "id", "DESC");

			if(count($all_products)>0 && $all_products <> "")
			{
				foreach($all_products as $all_products_data)
				{
					/*if($all_products_data->image<>"")
					{
						$pro_image = BASE_URL."assets/uploads/product/".$all_products_data->image;	
					}
					else
					{
						$pro_image = "";
					}*/
					
					$find_product_images 		= $this->dbhelper->selectRows("product_images", "*","product_id=".$all_products_data->id, "id", "DESC");
					
					
					$pro_image = array();
					
					$record[] = array(
							"id" 					=> $all_products_data->id,
							"product_name" 			=> $all_products_data->product_name,
							"product_type" 			=> $all_products_data->product_type,
							"product_price" 		=> $all_products_data->product_price,
							"product_recipe" 		=> $all_products_data->product_recipe,
							"created_at" 			=> $all_products_data->created_at,
							"last_updated" 			=> $all_products_data->last_updated,
							"product_image" 		=> $find_product_images,
						);
					$data = $record;
				}
			}
			


			if(count($data)>0)
			{
				$result['result'] = $data;
				$status 		= 1;
				$message 		= "Success";
			}
			else
			{
				$status 		= 0;
				$message 		= "No products found.";				
			}
		}
		else
		{
			$status 				= 0;
			$message 				= "Authenticate mismatch. Please provide valid token.";
		}
		
		$result['status'] 		= $status;
		$result['message'] 		= $message;
		header('Content-type: application/json');
		header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		echo json_encode($result);
	}
	
	public function edit_product_information()
	{
		
		$result 			= array();
		$status				= 0;
		$message 			= "";

		$id 				= $this->input->get_post('id');		
		$auth_token 		= $this->input->get_post('auth_token');		
		
		$data = array();
		
		if(isset($auth_token) && md5($auth_token)==AUTH_CHECK_TOKEN)
		{
			if($id>0)
			{
				$is_exist 		= $this->dbhelper->getSingleValue("products","count(*)","id=".$id);
				
				if($is_exist != 0)
				{
					if(isset($id) && $id<>"")
					{
						$where = "id='".$id."'";
					}
					else
					{
						$where = "1=1";
					}
					
					$all_products 		= $this->dbhelper->singleRow("products", "*", $where);
					
					if(is_object($all_products))
					{
						/*if($all_products->image<>"")
						{
							$pro_image = BASE_URL."uploads/product/".$all_products->image;	
						}
						else
						{
							$pro_image = "";
						}*/
						
						$find_product_images 		= $this->dbhelper->selectRows("product_images", "*","product_id=".$all_products->id, "id", "DESC");
						
						
						$pro_image = array();
						
						$record[] = array(
								"id" 					=> $all_products->id,
								"product_name" 			=> $all_products->product_name,
								"product_type" 			=> $all_products->product_type,
								"product_price" 		=> $all_products->product_price,
								"product_recipe" 		=> $all_products->product_recipe,
								"created_at" 			=> $all_products->created_at,
								"last_updated" 			=> $all_products->last_updated,
								"product_image" 		=> $find_product_images,
							);
						$data = $record;
					}
					


					if(count($data)>0)
					{
						$result['result'] = $data;
						$status 		= 1;
						$message 		= "Success";
					}
					else
					{
						$status 		= 0;
						$message 		= "No products found.";				
					}
				}
				else
				{
					$status 		= 0;
					$message 		= "No products found.";				
				}
			}
			else
			{
				$status 		= 0;
				$message 		= "Please provide product id to fatch information";				
			}
		}
		else
		{
			$status 				= 0;
			$message 				= "Authenticate mismatch. Please provide valid token.";
		}
		
		$result['status'] 		= $status;
		$result['message'] 		= $message;
		header('Content-type: application/json');
		header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		echo json_encode($result);
	}
	
	public function add_product()
	{
		$result 			= array();
		$data 				= array();
		$status				= 0;
		$message 			= "";
		
		$auth_token 		= $this->input->post('auth_token');		
		
		if(isset($auth_token) && md5($auth_token)==AUTH_CHECK_TOKEN)
		{
			$product_name 								= $this->input->post('product_name');
			$product_type 								= $this->input->post('product_type');
			$product_price 								= $this->input->post('product_price');
			$product_recipe 							= $this->input->post('product_recipe');
			
			if($product_name<>"" && $product_price<>"" && $product_type<>"")
			{
				$data['product_name'] 					= $product_name;
				$data['product_type'] 					= $product_type;
				$data['product_price'] 					= $product_price;
				$data['product_recipe'] 				= $product_recipe;
				$last_inserted_id 						= $this->dbhelper->addRow("products",$data);
				
				if (isset($_FILES['product_images']) && is_array($_FILES['product_images']['name'])) {
					$attachment = $_FILES['product_images'];

					for ($i = 0; $i < count($attachment['name']); $i++) {
						
						$image_response 					= array();
						
						$_FILES['attachment']['name'] 		= $attachment['name'][$i];
						$_FILES['attachment']['type'] 		= $attachment['type'][$i];
						$_FILES['attachment']['tmp_name'] 	= $attachment['tmp_name'][$i];
						$_FILES['attachment']['error'] 		= $attachment['error'][$i];
						$_FILES['attachment']['size'] 		= $attachment['size'][$i];
						
						$image_response = $this->upload_doc_func('products', 'attachment');
						if (is_array($image_response) && count($image_response) > 0 && isset($image_response['file']) && $image_response['file'] != "") {
							$attachment_arr[] = $image_response['file'];
							
							$add_attach						= array();
							$add_attach['product_id']		= $last_inserted_id;
							$add_attach['image_name']		= $image_response['file'];
							$this->dbhelper->addRow("product_images",$add_attach);
						}
					}
				}
				
				$status 							= 1;
				$message 							= "Product added successfully.";	
			}
			else
			{
				$status 							= 0;
				$message 							= "Please provide product name, Product Type and Product price.";
			}
		}
		else
		{
			$status 				= 0;
			$message 				= "Authenticate mismatch. Please provide valid token.";
		}
		
		$result['status'] 						= $status;
		$result['message'] 						= $message;

		header('Content-type: application/json');
		header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		echo json_encode($result);
	}
	
	public function edit_product()
	{
		$result 			= array();
		$data 				= array();
		$status				= 0;
		$message 			= "";
		
		$auth_token 		= $this->input->post('auth_token');		
		
		if(isset($auth_token) && md5($auth_token)==AUTH_CHECK_TOKEN)
		{
			$id 										= $this->input->post('id');
			$product_name 								= $this->input->post('product_name');
			$product_type 								= $this->input->post('product_type');
			$product_price 								= $this->input->post('product_price');
			$product_recipe 							= $this->input->post('product_recipe');
			
			if($product_name<>"" && $product_price<>"" && $product_type<>"" && $id>0)
			{
				$data['product_name'] 					= $product_name;
				$data['product_type'] 					= $product_type;
				$data['product_price'] 					= $product_price;
				$data['product_recipe'] 				= $product_recipe;
				$this->dbhelper->updateRow("products",$data,"id",$id); 
				
				if (isset($_FILES['product_images']) && is_array($_FILES['product_images']['name'])) {
					$attachment = $_FILES['product_images'];

					for ($i = 0; $i < count($attachment['name']); $i++) {
						
						$image_response 					= array();
						
						$_FILES['attachment']['name'] 		= $attachment['name'][$i];
						$_FILES['attachment']['type'] 		= $attachment['type'][$i];
						$_FILES['attachment']['tmp_name'] 	= $attachment['tmp_name'][$i];
						$_FILES['attachment']['error'] 		= $attachment['error'][$i];
						$_FILES['attachment']['size'] 		= $attachment['size'][$i];
						
						$image_response = $this->upload_doc_func('products', 'attachment');
						if (is_array($image_response) && count($image_response) > 0 && isset($image_response['file']) && $image_response['file'] != "") {
							$attachment_arr[] = $image_response['file'];
							
							$add_attach						= array();
							$add_attach['product_id']		= $id;
							$add_attach['image_name']		= $image_response['file'];
							$this->dbhelper->addRow("product_images",$add_attach);
						}
					}
				}
				
				$status 							= 1;
				$message 							= "Product Edited successfully.";	
			}
			else
			{
				$status 							= 0;
				$message 							= "Please provide product name, Product Type, Product price and Product id to edit.";
			}
		}
		else
		{
			$status 				= 0;
			$message 				= "Authenticate mismatch. Please provide valid token.";
		}
		
		$result['status'] 						= $status;
		$result['message'] 						= $message;

		header('Content-type: application/json');
		header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		echo json_encode($result);
	}
	
	public function delete_product()
	{
		$result 			= array();
		$data 				= array();
		$status				= 0;
		$message 			= "";
		
		$auth_token 		= $this->input->post('auth_token');		
		
		if(isset($auth_token) && md5($auth_token)==AUTH_CHECK_TOKEN)
		{
			$id 								= $this->input->post('id');
			
			if($id<>"" && $id>0)
			{
				$is_exist 		= $this->dbhelper->getSingleValue("products","count(*)","id=".$id);
				//echo $this->db->last_query();
				
				if($is_exist != 0)
				{
					$this->dbhelper->delRow("products", "id", $id);

					$status 							= 1;
					$message 							= "Product Deleted successfully.";	
				}
				else
				{
					$status 							= 0;
					$message 							= "Sorry this product not exists.";	
				}
			}
			else
			{
				$status 							= 0;
				$message 							= "Please provide product id to delete product.";
			}
		}
		else
		{
			$status 				= 0;
			$message 				= "Authenticate mismatch. Please provide valid token.";
		}
		
		$result['status'] 						= $status;
		$result['message'] 						= $message;

		header('Content-type: application/json');
		header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		echo json_encode($result);
	}
	
	function upload_doc_func($inner_dir, $name) {
        ini_set('gd.jpeg_ignore_warning', 1);
        $upload_path = UPLOAD_DIR_ROOT . $inner_dir;
	

        $config['upload_path'] = $upload_path;
        $config['encrypt_name'] = FALSE;
        $config['allowed_types'] = '*';
        $config['max_size'] = '60480000';
        $this->load->library('upload', $config);

        if (!is_dir(UPLOAD_DIR))
            mkdir(UPLOAD_DIR, 0755);

        if (!is_dir($upload_path))
            mkdir($upload_path, 0755);

        $userfile = $name;
        //check if a file is being uploaded
        if (strlen($_FILES[$userfile]["name"]) > 0) {

            if (!$this->upload->do_upload($userfile)) {//Check if upload is unsuccessful
                $response['error'] = $this->upload->display_errors('', '');
            } else {
                $response = array('file' => $this->upload->file_name);
            }
            return $response;
        }
    }

}