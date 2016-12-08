<?php
function DB() {
    $con = mysqli_connect("localhost", "dns_db", "owe04gus", "dns_db") or die(mysqli_error());
    if (mysqli_connect_errno($con)) {
        return "Failed to connect to MySQL: " . mysqli_connect_error();
    } 
    else {
        mysqli_set_charset($con, "utf8");
        return $con;
    }
}

function updategeneral($title, $mainurl, $email, $description, $image, $image_thumb, $address, $phone, $twitter, $facebook, $skype, $linkedin, $gplus, $youtube, $flickr, $pinterest, $id) {
    $con = DB();
    $dbquery = mysqli_query($con, "SELECT * FROM general WHERE id = '$id'");
    $row = mysqli_fetch_array($dbquery);
    if ($row) {
        if (isset($title) && $title != NULL) {
            $dbupdate = mysqli_query($con, "UPDATE general SET title = '$title' WHERE id = '$id'");
            $action = "success";
        }
        if (isset($mainurl) && $mainurl != NULL) {
            $dbupdate = mysqli_query($con, "UPDATE general SET mainurl = '$mainurl' WHERE id = '$id'");
            $action = "success";
        }
        if (isset($email) && $email != NULL) {
            $dbupdate = mysqli_query($con, "UPDATE general SET email = '$email' WHERE id = '$id'");
            $action = "success";
        }
        if (isset($description) && $description != NULL) {
            $dbupdate = mysqli_query($con, "UPDATE general SET description = '$description' WHERE id = '$id'");
            $action = "success";
        }
        
        if (isset($image) && $image != NULL) {
            $url = clean_url($title);
            $image = rename_image($image, $url, "uploads/original/");
            $dbupdate = mysqli_query($con, "UPDATE general SET image = '$image' WHERE id = '$id'");
            $action = "success";
        }
        
        if (isset($image_thumb) && $image_thumb != NULL) {
            $url = clean_url($title);
            $image_thumb = rename_image($image_thumb, $url, "uploads/thumbnails/");
            $dbupdate = mysqli_query($con, "UPDATE general SET image_thumb = '$image_thumb' WHERE id = '$id'");
            $action = "success";
        }
        
        if (isset($address) && $address != NULL) {
            $dbupdate = mysqli_query($con, "UPDATE general SET address = '$address' WHERE id = '$id'");
            $action = "success";
        }
        
        if (isset($phone) && $phone != NULL) {
            $dbupdate = mysqli_query($con, "UPDATE general SET phone = '$phone' WHERE id = '$id'");
            $action = "success";
        }
        if (isset($twitter) && $twitter != NULL) {
            $dbupdate = mysqli_query($con, "UPDATE general SET twitter = '$twitter' WHERE id = '$id'");
            $action = "success";
        }
        if (isset($facebook) && $facebook != NULL) {
            $dbupdate = mysqli_query($con, "UPDATE general SET facebook = '$facebook' WHERE id = '$id'");
            $action = "success";
        }
        if (isset($skype) && $skype != NULL) {
            $dbupdate = mysqli_query($con, "UPDATE general SET skype = '$skype' WHERE id = '$id'");
            $action = "success";
        }
        if (isset($linkedin) && $linkedin != NULL) {
            $dbupdate = mysqli_query($con, "UPDATE general SET linkedin = '$linkedin' WHERE id = '$id'");
            $action = "success";
        }
        if (isset($gplus) && $gplus != NULL) {
            $dbupdate = mysqli_query($con, "UPDATE general SET gplus = '$gplus' WHERE id = '$id'");
            $action = "success";
        }
        if (isset($youtube) && $youtube != NULL) {
            $dbupdate = mysqli_query($con, "UPDATE general SET youtube = '$youtube' WHERE id = '$id'");
            $action = "success";
        }
        if (isset($flickr) && $flickr != NULL) {
            $dbupdate = mysqli_query($con, "UPDATE general SET flickr = '$flickr' WHERE id = '$id'");
            $action = "success";
        }
        if (isset($pinterest) && $pinterest != NULL) {
            $dbupdate = mysqli_query($con, "UPDATE general SET pinterest = '$pinterest' WHERE id = '$id'");
            $action = "success";
        }
    } 
    else {
        $url = clean_url($title);
        $image = rename_image($image, $url, "uploads/original/");
        $image_thumb = rename_image($image_thumb, $url, "uploads/thumbnails/");
        $dbinsert = mysqli_query($con, "INSERT INTO general (title,mainurl,email,description,image,image_thumb,address,phone,twitter,facebook,skype,linkedin,gplus,youtube,flickr,pinterest)
         VALUES ('$title','$mainurl','$email','$description','$image','$image_thumb','$address','$phone','$twitter','$facebook','$skype','$linkedin','$gplus','$youtube','$flickr','$pinterest')");
        $action = "success";
    }
    return $action;
}

function adduser($firstname, $lastname, $email, $password, $repeat_password, $isadmin) {
    $con = DB();
    if ($firstname == NULL || $lastname == NULL || $email == NULL || $password == NULL || $repeat_password == NULL || $isadmin == NULL) {

        return $action = '<p class="btn-danger"> Error: Please fill up the form </p>';
    } 
    else {
        if (md5($password) != md5($repeat_password)) {
            return $action = '<p class="btn-danger">Password doesn\'t match</p>';
        } 
        else {
            $password = md5($password);
            $sql = "INSERT INTO users (user_name, user_lastname, user_email, user_pass, is_user_admin) VALUES ('$firstname', '$lastname', '$email', '$password', '$isadmin')";
            if (!mysqli_query($con, $sql)) {
                return $action = "Database error";
            } 
            else {
                return $action = "success";
            }
        }
    }
}

function edituser($id, $firstname, $lastname, $email, $password, $repeat_password, $isadmin) {
    $con = DB();
    if (md5($password) != md5($repeat_password)) {
        return $action = '<p class="btn-danger">Password doesn\'t match</p>';
    } 
    else {

        if (isset($firstname) && $firstname != NULL) {
            $updateuser = mysqli_query($con, "UPDATE users SET user_name = '$firstname' WHERE user_id = '$id'");
            
            $action = "success";
        }
        if (isset($lastname) && $lastname != NULL) {
            $updateuser = mysqli_query($con, "UPDATE users SET user_lastname = '$lastname' WHERE user_id = '$id'");
            $action = "success";
        }
        if (isset($email) && $email != NULL) {
            $updateuser = mysqli_query($con, "UPDATE users SET user_email = '$email' WHERE user_id = '$id'");
            $action = "success";
        }
        if (isset($password) && $password != NULL) {
            $password = md5($password);
            $updateuser = mysqli_query($con, "UPDATE users SET user_pass = '$password' WHERE user_id = '$id'");
            $action = "success";
        }
        if (isset($isadmin) && $isadmin != NULL) {
            $updateuser = mysqli_query($con, "UPDATE users SET is_user_admin = '$isadmin' WHERE user_id = '$id'");
            $action = "success";
        }
        return $action;
    }
}

function deleteuser($id) {
    $con = DB();
    $dbquery = mysqli_query($con, "DELETE FROM users WHERE user_id = '$id'");
    $action = "success";
    return $action;
}

function addslider($title, $frontpage) {

    $con = DB();
    
    if ($frontpage) {
        $mainslider = '1';
        $dbupdate = mysqli_query($con, "UPDATE sliders SET mainslider = '0'");
    } 
    else {
        $mainslider = '0';
    }
    
    $dbquery = mysqli_query($con, "INSERT INTO sliders (title,mainslider) VALUES ('$title',$mainslider)");
    $action = "success";
    return $action;
}

function count_images($id) {
    $con = DB();
    $dbquery = mysqli_query($con, "SELECT COUNT(*) as total FROM slider_images WHERE sliderid = '$id'");
    $row = mysqli_fetch_array($dbquery);
    $total = $row['total'];
    return $total;
}

function deleteslider($id) {
    $con = DB();
    $dbquery = mysqli_query($con, "SELECT * FROM slider_images WHERE sliderid = '$id'");
    while ($row = mysqli_fetch_array($dbquery)) {
        unlink($row['image_thumb']);
        unlink($row['image_medium']);
        unlink($row['image_large']);
    }
    $dbdelete = mysqli_query($con, "DELETE FROM slider_images WHERE sliderid = '$id'");
    $dbdelete = mysqli_query($con, "DELETE FROM sliders WHERE id = '$id'");
    return "success";
}

function updateslider($title, $frontpage, $sliderid) {
    $con = DB();
    if (isset($title) && $title != NULL) {
        $dbupdate = mysqli_query($con, "UPDATE sliders SET title = '$title' WHERE id = '$sliderid'");
        $action = "success";
    }
    if (isset($frontpage)) {
        $dbupdate = mysqli_query($con, "UPDATE sliders SET mainslider = '0'");
        $dbupdate = mysqli_query($con, "UPDATE sliders SET mainslider = '1' WHERE id = '$sliderid'");
        $action = "success";
    }
    return $action;
}

function addbanner($title, $content) {
    $con = DB();
    if (isset($title) && $title != NULL) {
        $dbquery = mysqli_query($con, "INSERT INTO banners (title,content) VALUES ('$title','$content')");
        $action = "success";
    }
    return $action;
};

function updatebanner($id, $title, $content) {
    $con = DB();
    if (isset($title) && $title != NULL) {
        $dbquery = mysqli_query($con, "UPDATE banners SET title = '$title' WHERE id = '$id'");
        $action = "success";
    }
    if (isset($content) && $content != NULL) {
        $dbquery = mysqli_query($con, "UPDATE banners SET content = '$content' WHERE id = '$id'");
        $action = "success";
    }
    return $action;
};

function deletebanner($id) {
    $con = DB();
    $dbdelete = mysqli_query($con, "DELETE FROM banners WHERE id = '$id'");
    return "success";
};

function addimage($sliderid, $image_thumb, $image, $description, $title, $link) {
    $con = DB();
    $url = clean_url($title);
    $image = rename_image($image, $url, "uploads/original/");
    $image_thumb = rename_image($image_thumb, $url, "uploads/thumbnails/");
    $dbquery = mysqli_query($con, "INSERT INTO slider_images (image_thumb,image_medium,image_large,sliderid,description,imagetitle,link) VALUES ('$image_thumb','$image','$image','$sliderid','$description','$title','$link')");
    return "success";
}

function deleteimage($id) {
    $con = DB();
    $dbquery = mysqli_query($con, "SELECT * FROM slider_images WHERE imageid = '$id'");
    $row = mysqli_fetch_array($dbquery);
    unlink($row['image_thumb']);
    unlink($row['image_medium']);
    unlink($row['image_large']);
    $dbdelete = mysqli_query($con, "DELETE FROM slider_images WHERE imageid = '$id'");
    return "success";
}

function addblog($title, $userid, $text, $embed, $keywords, $image_thumb, $image, $sliderid) {
    $con = DB();
    $url = clean_url($title);
    $image = rename_image($image, $url, "uploads/original/");
    $image_thumb = rename_image($image_thumb, $url, "uploads/thumbnails/");
    $dbquery = mysqli_query($con, "INSERT INTO blog (title, userid, text, embed, keywords, image_thumb, image, sliderid, url)
     VALUES ('$title','$userid','$text','$embed','$keywords','$image_thumb','$image','$sliderid','$url')");
    return "success";
}

function updateblog($title, $userid, $text, $embed, $keywords, $image_thumb, $image, $sliderid, $blogid) {

    $con = DB();
    if (isset($title) && $title != NULL) {
        $updateuser = mysqli_query($con, "UPDATE blog SET title = '$title' WHERE blogid = '$blogid'");
        $url = clean_url($title);
        $updateuser = mysqli_query($con, "UPDATE blog SET url = '$url' WHERE blogid = '$blogid'");
        $action = "success";
    }
    
    if (isset($userid) && $userid != NULL) {
        $updateuser = mysqli_query($con, "UPDATE blog SET userid = '$userid' WHERE blogid = '$blogid'");
        $action = "success";
    }
    
    if (isset($text) && $text != NULL) {
        $updateuser = mysqli_query($con, "UPDATE blog SET text = '$text' WHERE blogid = '$blogid'");
        $action = "success";
    }
    
    if (isset($embed) && $embed != NULL) {
        $updateuser = mysqli_query($con, "UPDATE blog SET embed = '$embed' WHERE blogid = '$blogid'");
        $action = "success";
    }
    if (isset($keywords) && $keywords != NULL) {
        $updateuser = mysqli_query($con, "UPDATE blog SET keywords = '$keywords' WHERE blogid = '$blogid'");
        $action = "success";
    }
    
    if (isset($image_thumb) && $image_thumb != NULL) {
        $image_thumb = rename_image($image_thumb, $url, "uploads/thumbnails/");
        $updateuser = mysqli_query($con, "UPDATE blog SET image_thumb = '$image_thumb' WHERE blogid = '$blogid'");
        $action = "success";
    }
    
    if (isset($image) && $image != NULL) {
        $image = rename_image($image, $url, "uploads/original/");
        $updateuser = mysqli_query($con, "UPDATE blog SET image = '$image' WHERE blogid = '$blogid'");
        $action = "success";
    }
    
    if (isset($sliderid) && $sliderid != NULL) {
        $updateuser = mysqli_query($con, "UPDATE blog SET sliderid = '$sliderid' WHERE blogid = '$blogid'");
        $action = "success";
    }
    
    return $action;
}

function deleteblog($id) {
    $con = DB();
    $dbdelete = mysqli_query($con, "DELETE FROM blog WHERE blogid = '$id'");
    return "success";
}

function addproduct($title, $userid, $text, $keywords, $artists, $link, $cat_id, $image_thumb, $image, $sliderid, $embed) {
    $con = DB();
    $url = clean_url($title);
    $image = rename_image($image, $url, "uploads/original/");
    $image_thumb = rename_image($image_thumb, $url, "uploads/thumbnails/");
    $sql = "INSERT INTO product (title, userid, cat_id, keywords, artists, link, text, url, image, image_thumb,sliderid,embed)
    VALUES ('$title','$userid','$cat_id','$keywords','$artists','$link','$text','$url','$image','$image_thumb','$sliderid','$embed')";
    $dbquery = mysqli_query($con, $sql);
    return "success";
}

function deleteproduct($id) {
    $con = DB();
    $dbdelete = mysqli_query($con, "DELETE FROM product WHERE id = '$id'");
    return "success";
}

function updateproduct($title, $userid, $text, $keywords, $artists, $image_thumb, $image, $sliderid, $embed, $link, $cat_id, $id) {

    $con = DB();
    if (isset($title) && $title != NULL) {
        $updateuser = mysqli_query($con, "UPDATE product SET title = '$title' WHERE id = '$id'");
        $url = clean_url($title);
        $updateuser = mysqli_query($con, "UPDATE product SET url = '$url' WHERE id = '$id'");
        $action = "success";
    }
    
    if (isset($userid) && $userid != NULL) {
        $updateuser = mysqli_query($con, "UPDATE product SET userid = '$userid' WHERE id = '$id'");
        $action = "success";
    }
    
    if (isset($text) && $text != NULL) {
        $updateuser = mysqli_query($con, "UPDATE product SET text = '$text' WHERE id = '$id'");
        $action = "success";
    }
    
    if (isset($keywords) && $keywords != NULL) {
        $updateuser = mysqli_query($con, "UPDATE product SET keywords = '$keywords' WHERE id = '$id'");
        $action = "success";
    }

    if (isset($artists) && $artists != NULL) {
        $updateuser = mysqli_query($con, "UPDATE product SET artists = '$artists' WHERE id = '$id'");
        $action = "success";
    }
    
    if (isset($image_thumb) && $image_thumb != NULL) {

        $image_thumb = rename_image($image_thumb, $url, "uploads/thumbnails/");
        $updateuser = mysqli_query($con, "UPDATE product SET image_thumb = '$image_thumb' WHERE id = '$id'");
        $action = "success";
    }
    
    if (isset($image) && $image != NULL) {
        $image = rename_image($image, $url, "uploads/original/");
        $updateuser = mysqli_query($con, "UPDATE product SET image = '$image' WHERE id = '$id'");
        $action = "success";
    }
    if (isset($cat_id) && $cat_id != NULL) {
        $updateuser = mysqli_query($con, "UPDATE product SET cat_id = '$cat_id' WHERE id = '$id'");
        $action = "success";
    }
    if (isset($link) && $link != NULL) {
        $updateuser = mysqli_query($con, "UPDATE product SET link = '$link' WHERE id = '$id'");
        $action = "success";
    }
    if (isset($embed) && $embed != NULL) {
        $updateuser = mysqli_query($con, "UPDATE product SET embed = '$embed' WHERE id = '$id'");
        $action = "success";
    }
    if (isset($sliderid) && $sliderid != NULL) {
        $updateuser = mysqli_query($con, "UPDATE product SET sliderid = '$sliderid' WHERE id = '$id'");
        $action = "success";
    }
    return $action;
}

function addpage($title, $userid, $text, $embed, $keywords, $image_thumb, $image, $mainpage, $sliderid) {
    $con = DB();
    $url = clean_url($title);
    $image = rename_image($image, $url, "uploads/original/");
    $image_thumb = rename_image($image_thumb, $url, "uploads/thumbnails/");
    if ($mainpage) {
        $mainpage = "1";
    } 
    else {
        $mainpage = "0";
    }
    $dbquery = mysqli_query($con, "INSERT INTO page (title, userid, text, embed, keywords, image_thumb, image, sliderid, mainpage, url)
     VALUES ('$title','$userid','$text','$embed','$keywords','$image_thumb','$image','$sliderid','$mainpage','$url')");
    return "success";
}

function deletepage($id) {
    $con = DB();
    $dbdelete = mysqli_query($con, "DELETE FROM page WHERE pageid = '$id'");
    return "success";
}

function updatepage($title, $userid, $text, $embed, $keywords, $image_thumb, $image, $mainpage, $sliderid, $pageid) {

    $con = DB();
    if (isset($title) && $title != NULL) {
        $updateuser = mysqli_query($con, "UPDATE page SET title = '$title' WHERE pageid = '$pageid'");
        $url = clean_url($title);
        $updateuser = mysqli_query($con, "UPDATE page SET url = '$url' WHERE pageid = '$pageid'");
        $action = "success";
    }
    
    if (isset($userid) && $userid != NULL) {
        $updateuser = mysqli_query($con, "UPDATE page SET userid = '$userid' WHERE pageid = '$pageid'");
        $action = "success";
    }
    
    if (isset($text) && $text != NULL) {
        $updateuser = mysqli_query($con, "UPDATE page SET text = '$text' WHERE pageid = '$pageid'");
        $action = "success";
    }
    
    if (isset($embed) && $embed != NULL) {
        $updateuser = mysqli_query($con, "UPDATE page SET embed = '$embed' WHERE pageid = '$pageid'");
        $action = "success";
    }
    if (isset($keywords) && $keywords != NULL) {
        $updateuser = mysqli_query($con, "UPDATE page SET keywords = '$keywords' WHERE pageid = '$pageid'");
        $action = "success";
    }
    
    if (isset($image_thumb) && $image_thumb != NULL) {
        $image_thumb = rename_image($image_thumb, $url, "uploads/thumbnails/");
        $updateuser = mysqli_query($con, "UPDATE page SET image_thumb = '$image_thumb' WHERE pageid = '$pageid'");
        $action = "success";
    }
    
    if (isset($image) && $image != NULL) {
        $image = rename_image($image, $url, "uploads/original/");
        $updateuser = mysqli_query($con, "UPDATE page SET image = '$image' WHERE pageid = '$pageid'");
        $action = "success";
    }
    
    if (isset($sliderid) && $sliderid != NULL) {
        $updateuser = mysqli_query($con, "UPDATE page SET sliderid = '$sliderid' WHERE pageid = '$pageid'");
        $action = "success";
    }
    if (isset($mainpage) && $mainpage != NULL) {
        $updateuser = mysqli_query($con, "UPDATE page SET mainpage = '1' WHERE pageid = '$pageid'");
    } 
    else {
        $updateuser = mysqli_query($con, "UPDATE page SET mainpage = '0' WHERE pageid = '$pageid'");
    }
    
    return $action;
}

function clean_url($str, $options = array()) {

    // Make sure string is in UTF-8 and strip invalid UTF-8 characters
    $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
    
    $defaults = array('delimiter' => '-', 'limit' => null, 'lowercase' => true, 'replacements' => array(), 'transliterate' => true,);
    
    // Merge options
    $options = array_merge($defaults, $options);
    
    $char_map = array(

    // Latin
        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH', 'ß' => 'ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th', 'ÿ' => 'y',

    // Latin symbols
        '©' => '(c)',

    // Greek
        'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8', 'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P', 'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W', 'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I', 'Ϋ' => 'Y', 'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8', 'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p', 'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w', 'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's', 'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',

    // Turkish
        'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G', 'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',

    // Russian / Macedonian
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Ѓ' => 'Dj', 'Џ' => 'DJ', 'Ѕ' => 'DZ', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh', 'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C', 'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya', 'Љ' => 'LJ', 'Њ' => 'NJ', 'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya', 'ѕ' => 'dz', 'џ' => 'dj', 'љ' => 'lj', 'њ' => 'nj',

    // Ukrainian
        'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G', 'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',

    // Czech
        'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U', 'Ž' => 'Z', 'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u', 'ž' => 'z',

    // Polish
        'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z', 'Ż' => 'Z', 'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z', 'ż' => 'z',

    // Latvian
        'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N', 'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z', 'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n', 'š' => 's', 'ū' => 'u', 'ž' => 'z');

    // Make custom replacements
$str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);

    // Transliterate characters to ASCII
if ($options['transliterate']) {
    $str = str_replace(array_keys($char_map), $char_map, $str);
}

    // Replace non-alphanumeric characters with our delimiter
$str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);

    // Remove duplicate delimiters
$str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);

    // Truncate slug to max. characters
$str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');

    // Remove delimiter from ends
$str = trim($str, $options['delimiter']);

return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}

function clean_url_old($str, $replace = array(), $delimiter = '-') {
    if (!empty($replace)) {
        $str = str_replace((array)$replace, ' ', $str);
    }
    
    $ts = array("/[À-Å]/", "/Æ/", "/Ç/", "/[È-Ë]/", "/[Ì-Ï]/", "/Ð/", "/Ñ/", "/[Ò-ÖØ]/", "/×/", "/[Ù-Ü]/", "/[Ý-ß]/", "/[à-å]/", "/æ/", "/ç/", "/[è-ë]/", "/[ì-ï]/", "/ð/", "/ñ/", "/[ò-öø]/", "/÷/", "/[ù-ü]/", "/[ý-ÿ]/");
    $tn = array("A", "AE", "C", "E", "I", "D", "N", "O", "X", "U", "Y", "a", "ae", "c", "e", "i", "d", "n", "o", "x", "u", "y");
    $clean = preg_replace($ts, $tn, $str);
    $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
    $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
    $clean = strtolower(trim($clean, '-'));
    return $clean;
}

function addartists($cat_id,$title,$image,$image_thumb,$clenovi,$poteklo,$zanr,$izdavachka_kukja,$email,$facebook,$twitter,$website,$soundcloud,$tekst,$youtube) {
    $con = DB();
    $url = clean_url($title);
    $image = rename_image($image, $url, "uploads/original/");
    $image_thumb = rename_image($image_thumb, $url, "uploads/thumbnails/");
    $dbquery = mysqli_query($con, "INSERT INTO artists (cat_id,title,url,image,image_thumb,clenovi,poteklo,zanr,izdavachka_kukja,email,facebook,twitter,website,soundcloud,tekst,youtube)
       VALUES ('$cat_id','$title','$url','$image','$image_thumb','$clenovi','$poteklo','$zanr','$izdavachka_kukja','$email','$facebook','$twitter','$website','$soundcloud','$tekst','$youtube')");
    return "success";
}

function editartist($id, $cat_id, $title, $image, $image_thumb, $clenovi, $poteklo, $zanr, $izdavachka_kukja, $email, $facebook, $twitter, $website, $soundcloud, $tekst, $youtube) {
    $con = DB();
    if (isset($title) && $title != NULL) {
        $updateuser = mysqli_query($con, "UPDATE artists SET title = '$title' WHERE id = '$id'");
        $url = clean_url($title);
        $updateuser = mysqli_query($con, "UPDATE artists SET url = '$url' WHERE id = '$id'");
        $action = "success";
    }
    if (isset($cat_id) && $cat_id != NULL) {
        $updateuser = mysqli_query($con, "UPDATE artists SET cat_id = '$cat_id' WHERE id = '$id'");
        $action = "success";
    }
    if (isset($text) && $text != NULL) {
        $updateuser = mysqli_query($con, "UPDATE artists SET text = '$text' WHERE id = '$id'");
        $action = "success";
    }
    if (isset($image_thumb) && $image_thumb != NULL) {
        $image_thumb = rename_image($image_thumb, $url, "uploads/thumbnails/");
        $updateuser = mysqli_query($con, "UPDATE artists SET image_thumb = '$image_thumb' WHERE id = '$id'");
        $action = "success";
    }
    if (isset($image) && $image != NULL) {
        $image = rename_image($image, $url, "uploads/original/");
        $updateuser = mysqli_query($con, "UPDATE artists SET image = '$image' WHERE id = '$id'");
        $action = "success";
    }
    if (isset($clenovi) && $clenovi != NULL) {
        $updateuser = mysqli_query($con, "UPDATE artists SET clenovi = '$clenovi' WHERE id = '$id'");
        $action = "success";
    }
    if (isset($poteklo) && $poteklo != NULL) {
        $updateuser = mysqli_query($con, "UPDATE artists SET poteklo = '$poteklo' WHERE id = '$id'");
        $action = "success";
    }
    if (isset($zanr) && $zanr != NULL) {
        $updateuser = mysqli_query($con, "UPDATE artists SET zanr = '$zanr' WHERE id = '$id'");
        $action = "success";
    }
    if (isset($izdavachka_kukja) && $izdavachka_kukja != NULL) {
        $updateuser = mysqli_query($con, "UPDATE artists SET izdavachka_kukja = '$izdavachka_kukja' WHERE id = '$id'");
        $action = "success";
    }
    if (isset($email) && $email != NULL) {
        $updateuser = mysqli_query($con, "UPDATE artists SET email = '$email' WHERE id = '$id'");
        $action = "success";
    }
    if (isset($facebook) && $facebook != NULL) {
        $updateuser = mysqli_query($con, "UPDATE artists SET facebook = '$facebook' WHERE id = '$id'");
        $action = "success";
    }
    if (isset($twitter) && $twitter != NULL) {
        $updateuser = mysqli_query($con, "UPDATE artists SET twitter = '$twitter' WHERE id = '$id'");
        $action = "success";
    }
    if (isset($website) && $website != NULL) {
        $updateuser = mysqli_query($con, "UPDATE artists SET website = '$website' WHERE id = '$id'");
        $action = "success";
    }
    if (isset($soundcloud) && $soundcloud != NULL) {
        $updateuser = mysqli_query($con, "UPDATE artists SET soundcloud = '$soundcloud' WHERE id = '$id'");
        $action = "success";
    }
    if (isset($tekst) && $tekst != NULL) {
        $updateuser = mysqli_query($con, "UPDATE artists SET tekst = '$tekst' WHERE id = '$id'");
        $action = "success";
    }
    if (isset($youtube) && $youtube != NULL) {
        $updateuser = mysqli_query($con, "UPDATE artists SET youtube = '$youtube' WHERE id = '$id'");
        $action = "success";
    }

    return $action;
}

function deleteartist($id) {
    $con = DB();
    $dbquery = mysqli_query($con, "SELECT * FROM artists WHERE id = '$id'");
    while ($row = mysqli_fetch_array($dbquery)) {
        unlink($row['image_thumb']);
        unlink($row['image']);
    }
    $dbdelete = mysqli_query($con, "DELETE FROM artists WHERE id = '$id'");
    return "success";
}

function adddownloads($title,$cat_id,$image,$image_thumb,$link,$artists) {
    $con = DB();
    $url = clean_url($title);
    $image = rename_image($image, $url, "uploads/original/");
    $image_thumb = rename_image($image_thumb, $url, "uploads/thumbnails/");
    $dbquery = mysqli_query($con, "INSERT INTO downloads (title,cat_id,image_thumb,image,link,artist_id)
       VALUES ('$title','$cat_id','$image_thumb','$image','$link','$artists')");
    return "success";
}

function editdownloads($id, $cat_id, $title, $image, $image_thumb, $link, $artists) {
 $con = DB();

 if (isset($title) && $title != NULL) {
    $updateuser = mysqli_query($con, "UPDATE downloads SET title = '$title' WHERE id = '$id'");
    $action = "success";
}
if (isset($cat_id) && $cat_id != NULL) {
    $updateuser = mysqli_query($con, "UPDATE downloads SET cat_id = '$cat_id' WHERE id = '$id'");
    $action = "success";
}
if (isset($link) && $link != NULL) {
    $updateuser = mysqli_query($con, "UPDATE downloads SET link = '$link' WHERE id = '$id'");
    $action = "success";
}

if (isset($artists) && $artists != NULL) {
    $updateuser = mysqli_query($con, "UPDATE downloads SET artist_id = '$artists' WHERE id = '$id'");
    $action = "success";
}
if (isset($image_thumb) && $image_thumb != NULL) {
    $image_thumb = rename_image($image_thumb, $url, "uploads/thumbnails/");
    $updateuser = mysqli_query($con, "UPDATE downloads SET image_thumb = '$image_thumb' WHERE id = '$id'");
    $action = "success";
}
if (isset($image) && $image != NULL) {
    $image = rename_image($image, $url, "uploads/original/");
    $updateuser = mysqli_query($con, "UPDATE downloads SET image = '$image' WHERE id = '$id'");
    $action = "success";
}

}

function deletedownload($id) {
    $con = DB();
    $dbquery = mysqli_query($con, "SELECT * FROM downloads WHERE id = '$id'");
    while ($row = mysqli_fetch_array($dbquery)) {
        unlink($row['image_thumb']);
        unlink($row['image']);
    }
    $dbdelete = mysqli_query($con, "DELETE FROM downloads WHERE id = '$id'");
    return "success";
}

function rename_image($image, $title, $path) {
    $pos = strripos($image, ".jpg");
    if ($pos) {
        $imagename = $title . ".jpg";
        copy($image, $path . $imagename);
        unlink($image);
        return $path . $imagename;
    }
    $pos = strripos($image, ".jpeg");
    if ($pos) {
        $imagename = $title . ".jpeg";
        copy($image, $path . $imagename);
        unlink($image);
        return $path . $imagename;
    }
    $pos = strripos($image, ".gif");
    if ($pos) {
        $imagename = $title . ".gif";
        copy($image, $path . $imagename);
        unlink($image);
        return $path . $imagename;
    }
    $pos = strripos($image, ".png");
    if ($pos) {
        $imagename = $title . ".png";
        copy($image, $path . $imagename);
        unlink($image);
        return $path . $imagename;
    }
}

function addcategory($title, $parent_id) {
    $con = DB();
    $url = clean_url($title);
    $dbquery = mysqli_query($con, "INSERT INTO categories (title, parent_id, cat_url) VALUES ('$title','$parent_id','$url')");
    return "success";
}

function deletecategory($id) {
    $con = DB();
    $dbdelete = mysqli_query($con, "DELETE FROM categories WHERE id = '$id'");
    return "success";
}

function category_tree($catid) {
    $con = DB();
    $dbquery = mysqli_query($con, "SELECT * FROM categories WHERE parent_id = '$catid'");
    while ($row = mysqli_fetch_array($dbquery)) {
        $i = 0;
        if ($i == 0) echo '<ul>';
        echo '<li>' . $row['title'];
        category_tree($row['id']);
        echo '</li>';
        $i++;
        if ($i > 0) echo '</ul>';
    }
}

function category_tree_form($catid, $parent) {
    $con = DB();
    $parent++;
    $dbquery = mysqli_query($con, "SELECT * FROM categories WHERE parent_id = '$catid'");
    $i = 0;
    while ($row = mysqli_fetch_array($dbquery)) {
        if ($row['parent_id'] == $catid) {
            if ($i == 0) {
                $parent.= "";
            }
            
            while (strlen($dash) < $parent) {
                $tab = '&nbsp;';
                $dash.= "-";
            }
            $dash = $tab . $tab . $dash . $tab . $tab;
        }
        
        echo '<tr>';
        echo '<td>' . $dash . ' ' . $row['title'];
        echo '<form action="" method="post">';
        
        echo '<input type="hidden" value="' . $row['id'] . '" name="cat_id" />';
        echo '<input type="hidden" value="' . $row['title'] . '" name="title" />';
        echo '<input type="hidden" value="delete" name="delete" />';
        echo '</td>';
        echo '<td>' . $row['cat_url'] . '</td>';
        echo '
        <td class="right"><button type="delete" class="btn btn-xs btn-danger">Delete</button></td>
    </form>
</tr>';
category_tree_form($row['id'], $parent);
}
}

function category_select($productid = 0, $catid, $parent) {
    $con = DB();
    $parent++;
    $dbquery = mysqli_query($con, "SELECT * FROM categories WHERE parent_id = '$catid'");
    $i = 0;
    while ($row = mysqli_fetch_array($dbquery)) {
        if ($row['parent_id'] == $catid) {
            if ($i == 0) {
                $parent.= "";
            }
            while (strlen($dash) < $parent) {
                $dash.= "-";
            }
        }
        $selected = getselected($productid);
        if (in_array($row['id'], $selected)) {
            $select = "selected";
        } 
        else {
            $select = "";
        }
        echo '<option value="' . $row['id'] . '" ' . $select . '>' . $dash . ' ' . $row['title'] . '</option>';
        category_select($productid, $row['id'], $parent);
    }
}


function category_select_product($productid = 0, $catid, $parent) {
    $con = DB();
    $parent++;
    $dbquery = mysqli_query($con, "SELECT * FROM categories WHERE parent_id = '$catid'");
    $i = 0;
    while ($row = mysqli_fetch_array($dbquery)) {
        if ($row['parent_id'] == $catid) {
            if ($i == 0) {
                $parent.= "";
            }
            while (strlen($dash) < $parent) {
                $dash.= "-";
            }
        }
        $selected = getselected_product($productid);
        if (in_array($row['id'], $selected)) {
            $select = "selected";
        } 
        else {
            $select = "";
        }
        echo '<option value="' . $row['id'] . '" ' . $select . '>' . $dash . ' ' . $row['title'] . '</option>';
        category_select($productid, $row['id'], $parent);
    }
}

function category_select_downloads($productid = 0, $catid, $parent) {
    $con = DB();
    $parent++;
    $dbquery = mysqli_query($con, "SELECT * FROM categories WHERE parent_id = '$catid'");
    $i = 0;
    while ($row = mysqli_fetch_array($dbquery)) {
        if ($row['parent_id'] == $catid) {
            if ($i == 0) {
                $parent.= "";
            }
            while (strlen($dash) < $parent) {
                $dash.= "-";
            }
        }
        $selected = getselected_downloads($productid);
        if (in_array($row['id'], $selected)) {
            $select = "selected";
        } 
        else {
            $select = "";
        }
        echo '<option value="' . $row['id'] . '" ' . $select . '>' . $dash . ' ' . $row['title'] . '</option>';
        category_select($productid, $row['id'], $parent);
    }
}

function getselected_product($id) {
    $con = DB();
    $dbquery = mysqli_query($con, "SELECT * FROM product WHERE id = '$id'");
    $categories = array();
    while ($row = mysqli_fetch_array($dbquery)) {
        $cats = explode(",", $row['cat_id']);
        foreach ($cats as $key => $value) {

            $categories[] = $value;
        }
        return $categories;
    }
}

function getselected_downloads($id) {
    $con = DB();
    $dbquery = mysqli_query($con, "SELECT * FROM downloads WHERE id = '$id'");
    $categories = array();
    while ($row = mysqli_fetch_array($dbquery)) {
        $cats = explode(",", $row['cat_id']);
        foreach ($cats as $key => $value) {

            $categories[] = $value;
        }
        return $categories;
    }
}


function getselected($id) {
    $con = DB();
    $dbquery = mysqli_query($con, "SELECT * FROM artists WHERE id = '$id'");
    $categories = array();
    while ($row = mysqli_fetch_array($dbquery)) {
        $cats = explode(",", $row['cat_id']);
        foreach ($cats as $key => $value) {

            $categories[] = $value;
        }
        return $categories;
    }
}

function getelement($element, $table, $tablerow, $input) {
    $con = DB();
    $dbquery = mysqli_query($con, "SELECT " . $element . " FROM " . $table . " WHERE " . $tablerow . " = '$input'");
    $row = mysqli_fetch_array($dbquery);
    return $row['' . $element . ''];
}
?>