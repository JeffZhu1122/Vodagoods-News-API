<?php include("includes/connection.php");
 	  include("includes/function.php"); 	
	
	$file_path = 'https://'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']).'/';
 	 
	if(isset($_GET['cat_list']))
 	{
 		$jsonObj= array();
		
		$cat_order=API_CAT_ORDER_BY;


		$query="SELECT cid,category_name,category_text FROM tbl_category ORDER BY tbl_category.".$cat_order."";
		$sql = mysqli_query($mysqli,$query)or die(mysql_error());

		while($data = mysqli_fetch_assoc($sql))
		{
			 

			$row['cid'] = $data['cid'];
			$row['category_name'] = $data['category_name'];
			$row['category_text'] = $data['category_text'];
			 
			array_push($jsonObj,$row);
		
		}

		$set['NEWS_APP'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
 	}
	else if(isset($_GET['cat_id']))
	{
		$post_order_by=API_CAT_POST_ORDER_BY;

		$cat_id=$_GET['cat_id'];	

		$jsonObj= array();	
	
	    $query="SELECT * FROM tbl_news
		LEFT JOIN tbl_category ON tbl_news.cat_id= tbl_category.cid 
		where tbl_news.cat_id='".$cat_id."' AND tbl_news.status='1' ORDER BY tbl_news.id ".$post_order_by."";

		$sql = mysqli_query($mysqli,$query)or die(mysqli_error());

		while($data = mysqli_fetch_assoc($sql))
		{
			$row['id'] = $data['id'];
			$row['cat_id'] = $data['cat_id'];
			$row['news_type'] = $data['news_type'];
			$row['news_title'] = $data['news_title'];
			$row['video_url'] = $data['video_url'];
			$row['video_id'] = $data['video_id'];
			
			if($data['news_type']=='image')
			{
				$row['news_image_b'] = $file_path.'images/'.$data['news_image'];
				$row['news_image_s'] = $file_path.'images/thumbs/'.$data['news_image'];
			}
			else
			{
				$row['news_image_b'] = $data['news_image'];
				$row['news_image_s'] = $data['news_image'];
			}
 
 			$row['news_description'] = $data['news_description'];
 			$row['news_date'] = date('m/d/Y',$data['news_date']);
 			$row['news_views'] = $data['news_views'];


			$row['cid'] = $data['cid'];
			$row['category_name'] = $data['category_name'];
			$row['category_text'] = $data['category_text'];
			 

			array_push($jsonObj,$row);
		
		}

		$set['NEWS_APP'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();

		
	}	 
	else if(isset($_GET['latest']))
	{
		//$limit=$_GET['latest'];	 

		$limit=API_LATEST_LIMIT;

		$jsonObj= array();	
 
 
		$query="SELECT * FROM tbl_news
		LEFT JOIN tbl_category ON tbl_news.cat_id= tbl_category.cid 
		WHERE tbl_news.status='1' ORDER BY tbl_news.id DESC LIMIT $limit";

		$sql = mysqli_query($mysqli,$query)or die(mysqli_error());

		while($data = mysqli_fetch_assoc($sql))
		{
			$row['id'] = $data['id'];
			$row['cat_id'] = $data['cat_id'];
			$row['news_type'] = $data['news_type'];
			$row['news_title'] = $data['news_title'];
			$row['video_url'] = $data['video_url'];
			$row['video_id'] = $data['video_id'];
			
			if($data['news_type']=='image')
			{
				$row['news_image_b'] = $file_path.'images/'.$data['news_image'];
				$row['news_image_s'] = $file_path.'images/thumbs/'.$data['news_image'];
			}
			else
			{
				$row['news_image_b'] = $data['news_image'];
				$row['news_image_s'] = $data['news_image'];
			}
 
 			$row['news_description'] = $data['news_description'];
 			$row['news_date'] = date('m/d/Y',$data['news_date']);
 			$row['news_views'] = $data['news_views'];


			$row['cid'] = $data['cid'];
			$row['category_name'] = $data['category_name'];
			$row['category_text'] = $data['category_text'];
			 

			array_push($jsonObj,$row);
		
		}

		$set['NEWS_APP'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();

	}
	else if(isset($_GET['search']))
	{
		//$limit=$_GET['latest'];	 

 
		$jsonObj= array();	
 
 
		$query="SELECT * FROM tbl_news
		LEFT JOIN tbl_category ON tbl_news.cat_id= tbl_category.cid 
		WHERE tbl_news.status='1' AND tbl_news.news_title LIKE '%".$_GET['search']."%' ORDER BY tbl_news.news_title DESC";

		$sql = mysqli_query($mysqli,$query)or die(mysqli_error());

		while($data = mysqli_fetch_assoc($sql))
		{
			$row['id'] = $data['id'];
			$row['cat_id'] = $data['cat_id'];
			$row['news_type'] = $data['news_type'];
			$row['news_title'] = $data['news_title'];
			$row['video_url'] = $data['video_url'];
			$row['video_id'] = $data['video_id'];
			
			if($data['news_type']=='image')
			{
				$row['news_image_b'] = $file_path.'images/'.$data['news_image'];
				$row['news_image_s'] = $file_path.'images/thumbs/'.$data['news_image'];
			}
			else
			{
				$row['news_image_b'] = $data['news_image'];
				$row['news_image_s'] = $data['news_image'];
			}
 
 			$row['news_description'] = $data['news_description'];
 			$row['news_date'] = date('m/d/Y',$data['news_date']);
 			$row['news_views'] = $data['news_views'];


			$row['cid'] = $data['cid'];
			$row['category_name'] = $data['category_name'];
			$row['category_text'] = $data['category_text'];
			 

			array_push($jsonObj,$row);
		
		}

		$set['NEWS_APP'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();

	}
	else if(isset($_GET['home_banner']))
 	{
 		$jsonObj= array();
		
		 
		$query="SELECT id,banner_name,banner_image,banner_url FROM tbl_home_banner ORDER BY tbl_home_banner.id";
		$sql = mysqli_query($mysqli,$query)or die(mysql_error());

		while($data = mysqli_fetch_assoc($sql))
		{
			 

			$row['id'] = $data['id'];
			$row['banner_name'] = $data['banner_name'];
			$row['banner_image'] = $file_path.'images/'.$data['banner_image'];
			$row['banner_image_thumb'] = $file_path.'images/thumbs/'.$data['banner_image'];
			$row['banner_url'] = $data['banner_url'];
 
			array_push($jsonObj,$row);
		
		}

		$set['NEWS_APP'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    	echo $val= str_replace('\\\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
 	}		
	else if(isset($_GET['news_id']))
	{
		  
				 
		$jsonObj= array();	

		$query="SELECT * FROM tbl_news
		LEFT JOIN tbl_category ON tbl_news.cat_id= tbl_category.cid 
		WHERE tbl_news.status='1' AND tbl_news.id='".$_GET['news_id']."'";

		$sql = mysqli_query($mysqli,$query)or die(mysqli_error());

		while($data = mysqli_fetch_assoc($sql))
		{
			$row['id'] = $data['id'];
			$row['cat_id'] = $data['cat_id'];
			$row['news_type'] = $data['news_type'];
			$row['news_title'] = $data['news_title'];
			$row['video_url'] = $data['video_url'];
			$row['video_id'] = $data['video_id'];
			
			if($data['news_type']=='image')
			{
				$row['news_image_b'] = $file_path.'images/'.$data['news_image'];
				$row['news_image_s'] = $file_path.'images/thumbs/'.$data['news_image'];
			}
			else
			{
				$row['news_image_b'] = $data['news_image'];
				$row['news_image_s'] = $data['news_image'];
			}
 
 			$row['news_description'] = $data['news_description'];
 			$row['news_date'] = date('m/d/Y',$data['news_date']);
 			$row['news_views'] = $data['news_views'];


			$row['cid'] = $data['cid'];
			$row['category_name'] = $data['category_name'];
			$row['category_text'] = $data['category_text'];
			 

			array_push($jsonObj,$row);
		
		}

		$view_qry=mysqli_query($mysqli,"update tbl_news set news_views=news_views+1 where id='".$_GET['news_id']."'");

 

		$set['NEWS_APP'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
		
$val= str_replace('\\\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                echo $val;
		die();	
 

	}	  	 
	else 
	{
		$jsonObj= array();	

		$query="SELECT * FROM tbl_settings WHERE id='1'";
		$sql = mysqli_query($mysqli,$query)or die(mysqli_error());

		while($data = mysqli_fetch_assoc($sql))
		{
			 
			$row['app_name'] = $data['app_name'];
			$row['app_logo'] = $data['app_logo'];
			$row['app_version'] = $data['app_version'];
			$row['app_author'] = $data['app_author'];
			$row['app_contact'] = $data['app_contact'];
			$row['app_email'] = $data['app_email'];
			$row['app_website'] = $data['app_website'];
			$row['app_description'] = $data['app_description'];
 			$row['app_developed_by'] = $data['app_developed_by'];

			$row['app_privacy_policy'] = stripslashes($data['app_privacy_policy']);
			
			$row['publisher_id'] = $data['publisher_id'];
			$row['interstital_ad'] = $data['interstital_ad'];
			$row['interstital_ad_id'] = $data['interstital_ad_id'];
			$row['interstital_ad_click'] = $data['interstital_ad_click'];
 			$row['banner_ad'] = $data['banner_ad'];
 			$row['banner_ad_id'] = $data['banner_ad_id'];
			
			$row['publisher_id_ios'] = $data['publisher_id_ios'];
 			$row['app_id_ios'] = $data['app_id_ios'];
			$row['interstital_ad_ios'] = $data['interstital_ad_ios'];
			$row['interstital_ad_id_ios'] = $data['interstital_ad_id_ios'];
			$row['interstital_ad_click_ios'] = $data['interstital_ad_click_ios'];
 			$row['banner_ad_ios'] = $data['banner_ad_ios'];
 			$row['banner_ad_id_ios'] = $data['banner_ad_id_ios'];

			array_push($jsonObj,$row);
		
		}

		$set['NEWS_APP'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();	
	}		
	 
	 
?>