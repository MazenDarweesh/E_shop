<?php
    function redirect_to($new_location)
    {
        header("Location: " . $new_location);
        exit;
    }

    function mysql_prep($string)
    {
        global $connection;
        
        $escaped_string = mysqli_real_escape_string($connection,$string);
        return $escaped_string;
    }

    function confirm_query($result_set)
    {
        if(!$result_set)
        {
            die("DB query failed");
        }
    }
    function form_errors($errors=array())
    {
        $output = "";
        if(!empty($errors))
        {
            $output .= "<div class=\"error\">";
            $output .= "Please fix the following errors:";
            $output .= "<ul>";
            foreach($errors as $key =>$error)
            {
                $output .= "<li>";
                $output .= htmlentities($error);
                $output .= "</li>";
            }
            $output .= "</ul>";
            $output .= "</div>";
        }
        return $output ;
    }

 
     //takes 2 args 
     //1- the current subj arr or null
     //2- the current page arr or null
  /*done*/  function navigation ($product_array) 
    {
     $output= "  <ul class =\"product\">";
     $product_set=find_all_product(false); 
      while($product = mysqli_fetch_assoc($product_set))
       {
            $output .= "<li";
            if($product_array && $product["product_id"]==$product_array["product_id"])
             {
                $output .= " class=\"selected\"";
             }
             $output .= ">";  
             $output .="<a href=\"Main.php?product="; 
             $output .= urlencode($product["product_id"]);
             $output .="\">";
             $output .= htmlentities($product["name"]);
             $output .="</a>";

                     $output .= "</ul>";
                     $output .="</li>";
        }    
            
                     mysqli_free_result($product_set);
    
    
                     $output .="</ul>";  

                     return $output ;
    }

   /*done*/  function public_navigation ($product_array) 
    {
     $output= "  <ul class =\"product\">";
     $product_set=find_all_product(); 
      while($product = mysqli_fetch_assoc($product_set))
       {
            $output .= "<li";
            if($product_array && $product["product_id"]==$product_array["product_id"])
             {
                $output .= " class=\"selected\"";
             }
             $output .= ">";  
             $output .="<a href=\"index.php?product="; 
             $output .= urlencode($product["product_id"]);
             $output .="\">";
             $output .= htmlentities($product["name"]);
             $output .="</a>";
                    
             $output .= "</ul>";
            
             $output .="</li>"; // end of product li
        }    
            
                     mysqli_free_result($product_set);
    
    
                     $output .="</ul>";  

                     return $output ;
    }


    /*Done*/  function find_all_product($public=true) 
{
    global $connection;

    $query = "SELECT * ";
    $query .= "FROM product ";
    if($public)
    {
        $query .= "WHERE visible =1 ";
        
    }
    $query .= "ORDER BY name ASC ";
    $product_set = mysqli_query($connection,$query);
    confirm_query($product_set);
    return $product_set;
}

 

  /*Done*/ function find_product_by_id($product_id)
{
    global $connection;

    $safe_product_id = mysqli_real_escape_string($connection,$product_id);
    $query = "SELECT * ";
    $query .= "FROM product ";
    $query .= "WHERE product_id= {$safe_product_id} ";
    $query .= "Limit 1 ";
    $product_set = mysqli_query($connection,$query);
    confirm_query($product_set);
     if($product = mysqli_fetch_assoc($product_set))
     {
        return $product;
     }
     else
     { 
        return null;
     }
}



 /*Done*/function find_selected_product()
    {
        global $current_product;
        /*global $current_product_img;*/
        
        if(isset($_GET["product"]))
        {
            $current_product = find_product_by_id($_GET["product"]);
        }
        
        /*else if(isset($_FILES["img"]))
        {
            $current_product_img =find_product_by_id($_FILES["img"]);
        }*/


        else
        {
            $current_product =null;
        }
    }
    
   
   
   
   
   
   
   
   
    /*
    -->  function display_pages_for_current_subject($subject_id)
    {
        $subject_pages= find_pages_for_subject($subject_id); 
        $output =  "<ul class=\"pages\">";

        while($page = mysqli_fetch_assoc($subject_pages))
        {
            $output .= "<li";
            $output .= " class=\"selected\"";
            $output .= ">";      
            $output .=  "<a href =\"manage_content.php?page=";
            $output .= urlencode($page["id"]);
            $output .="\">";
            $output .= htmlentities($page["menu_name"]);
            $output .=  "</a>";
            $output .="</li>";
              
        } 
        mysqli_free_result($subject_pages);
        $output .= "</ul>";
        $output .="</li>";
        return $output;   
        
    }
    */
    /*-->   function find_pages_for_subject($product_id , $public=true)
    {
        global $connection;

        $query = "SELECT * ";
        $query .= "FROM pages ";
        $query .= "WHERE product_id={$product_id} ";
        if($public)
        {
            $query .= "AND visible =1 ";

        }
        $query .= "ORDER BY position ASC ";
        $page_set = mysqli_query($connection,$query);
        confirm_query($page_set);
        return $page_set;
    }*/

/* function  find_page_by_id($page_id)
{
    global $connection;

    $safe_page_id = mysqli_real_escape_string($connection,$page_id);
    
    $query = "SELECT * ";
    $query .= "FROM pages ";
    $query .= "WHERE id= {$safe_page_id} ";
    $query .= "Limit 1 ";
    $page_set = mysqli_query($connection,$query);
    confirm_query($page_set);
     if($page = mysqli_fetch_assoc($page_set))
     {
        return $page;
     }
     else
     { 
        return null;
     }
}
*/

?>