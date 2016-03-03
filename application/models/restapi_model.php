<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class restapi_model extends CI_Model
{
    public function deletecareers($id)
    {
        $query = $this->db->query("DELETE FROM `careers` WHERE `id`=$id");

        return $query;
    }

    public function subscribe($email)
    {
        $query1 = $this->db->query("SELECT * FROM `subscribe` WHERE `email`='$email'");
        $num = $query1->num_rows();
        if ($num > 0) {
            $object = new stdClass();
            $object->value = false;
            $object->comment = 'already exists';

            return $object;
        } else {
            $this->db->query("INSERT INTO `subscribe`(`email`) VALUE('$email')");
            $id = $this->db->insert_id();

                //send email for subscription
                         $this->load->library('email');
            $this->email->from('vigwohlig@gmail.com', 'Selfcare');
            $this->email->to($email);
            $this->email->subject('Your SelfCare subscription');

            $message = "<html><body><div id=':1fn' class='a3s adM' style='overflow: hidden;'><div class='HOEnZb'><div class='adm'><div id='q_152da6db6beee01c_0' class='ajR h4' data-tooltip='Hide expanded content' aria-label='Hide expanded content'><div class='ajT'></div></div></div><div class='im'><u></u>
						 <div style='margin:0'>

						 <u></u>
						 <div style='margin:0 auto;width:90%'>
						 <div style='margin:50px auto;width:80%'>
						 <div style='text-align:center' align='center'>
							<img src='http://selfcareindia.com/img/logo.png' alt='Selfcare' class='CToWUd'>
						 </div>

						 <p style='color:#000;font-family:Roboto;font-size:20px'>Thank You for subscribing to SelfCare's health packages. Our nutritionists can't wait to interact with you.</p>


						 <p style='color:#000;font-family:Roboto;font-size:20px'>In case you have any queries regarding your package, please call us on +912261312222 or leave us a mail on info@selfcareindia.com

				</p>

						 <span style='color:#000;font-family:Roboto;font-size:20px'>Thank You,</span>
						 <span style='color:#000;display:block;font-family:Roboto;font-size:20px'>Team Selfcare !</span>
						 </div>
						 </div>
						 <u></u>
						 <footer style='background:#e96542;padding:10px 0'>
						 <div style='margin:0 auto;width:90%'>
						 <div>
						 <table>
						 <tbody><tr>
						 <td style='padding:0 15px'><div>
						 <span style='color:#ffd8ce;font-family:Roboto;font-size:14px'>COPYRIGHT@SELFCARE2016</span>
						 </div></td>
						 <td style='padding:0 15px'><div>
							<span style='color:#ffd8ce;font-family:Roboto;font-size:14px'>CONTACT US<a href='tel:+912261312222' style='color:#ffd8ce;font-family:Roboto;font-size:14px;margin:0px 10px;text-decoration:none' target='_blank'>+91 22 6131 2222</a></span>
						 </div></td>
						 <td style='padding:0 15px;vertical-align:middle' valign='middle'>
							<div>
							<span style='color:#ffd8ce;display:block;font-family:Roboto;font-size:14px'>FOLLOW US ON</span>
							<a href='https://www.facebook.com/selfcarebysuman' style='color:#ffd8ce;display:inline-block;font-family:Roboto;font-size:18px;margin:3px 5px 0 0' target='_blank'><img src='http://selfcareindia.com/img/selfcare-facebook.png' alt='Facebook' width='20' class='CToWUd'></a>
							<a href='https://twitter.com/selfcarebysuman' style='color:#ffd8ce;display:inline-block;font-family:Roboto;font-size:18px;margin:3px 5px 0 0' target='_blank'><img src='http://selfcareindia.com/img/selfcare-twitter.png' alt='Twitter' width='20' class='CToWUd'></a>
							<a href='https://www.instagram.com/selfcarebysuman' style='color:#ffd8ce;display:inline-block;font-family:Roboto;font-size:18px;margin:3px 5px 0 0' target='_blank'><img src='http://selfcareindia.com/img/selfcare-insta.png' alt='Instagram' width='20' class='CToWUd'></a>
							<a href='https://www.youtube.com/channel/UCVqKgmC6eaMrgPyXoOcOz2A' style='color:#ffd8ce;display:inline-block;font-family:Roboto;font-size:18px;margin:3px 5px 0 0' target='_blank'><img src='http://selfcareindia.com/img/selfcare-youtube.png' alt='Youtube' width='20' class='CToWUd'></a>
						 </div>
						 </td>
						 </tr>
						 </tbody></table>
						 </div>
						 </div>
						 </footer>
						 </div>


						 </div></div></div></body></html>";
            $this->email->message($message);
            $this->email->send();

            $object = new stdClass();
            $object->value = true;

            return $object;
        }
    }

    public function askSumanSubmit($category, $name, $email, $question)
    {
        $this->db->query("INSERT INTO `asksuman`(`category`,`name`,`email`,`question`) VALUE('$category','$name','$email','$question')");
        $object = new stdClass();
        $object->value = true;

        return $object;
    }

    public function commentSubmit($blogid, $name, $email, $website, $comment)
    {
        $this->db->query("INSERT INTO `selftables_comment`(`blog`,`name`,`email`,`website`,`comment`) VALUE('$blogid','$name','$email','$website','$comment')");
        $object = new stdClass();
        $object->value = true;

        return $object;
    }

    public function careersSubmit($name, $email, $mobile, $message, $resume)
    {
        $this->db->query("INSERT INTO `careers`(`name`,`email`,`mobile`,`message`,`resume`) VALUE('$name','$email','$mobile','$message','$resume')");
        $object = new stdClass();
        $object->value = true;

        return $object;
    }

    public function contactSubmit($firstname, $lastname, $mobile, $email, $message)
    {
        $this->db->query("INSERT INTO `contact`(`firstname`,`lastname`,`telephone`,`email`,`comment`) VALUE('$firstname','$lastname','$mobile','$email','$message')");
        $object = new stdClass();
        $object->value = true;

        return $object;
    }

    public function getTestimonial()
    {
        $query = $this->db->query('SELECT `name`, `location`, `weight`, `description` FROM `testimonial`')->result();
        if ($query) {
            return $query;
        } else {
            $object = new stdClass();
            $object->value = false;

            return $object;
        }
    }

    public function registeruser($firstname, $lastname, $email, $password)
    {
        $newdata = 0;
        $password = md5($password);

        //  echo 'email id  '.$email;
         $query = $this->db->query("SELECT `id` FROM `user` WHERE `email`='$email'");
        $num = $query->num_rows();

        if ($num == 0) {
            $this->db->query("INSERT INTO `user`(`name`,`firstname`, `lastname`, `email`, `password`,`accesslevel`,`status`) VALUE('$firstname $lastname','$firstname','$lastname','$email','$password','3','2')");
            $user = $this->db->insert_id();

//send email to register
         $this->load->library('email');
            $this->email->from('vigwohlig@gmail.com', 'Selfcare');
            $this->email->to($email);
            $this->email->subject('Welcome to SelfCare');

            $message = "<html><body><div id=':1fn' class='a3s adM' style='overflow: hidden;'><div class='HOEnZb'><div class='adm'><div id='q_152da6db6beee01c_0' class='ajR h4' data-tooltip='Hide expanded content' aria-label='Hide expanded content'><div class='ajT'></div></div></div><div class='im'><u></u>
		 <div style='margin:0'>

		 <u></u>
		 <div style='margin:0 auto;width:90%'>
		 <div style='margin:50px auto;width:80%'>
		 <div style='text-align:center' align='center'>
			<img src='http://selfcareindia.com/img/logo.png' alt='Selfcare' class='CToWUd'>
		 </div>
		 <p style='color:#000;font-family:Roboto;font-size:20px'>Dear <span style='color:#000;font-family:Roboto;font-size:20px'>$firstname $lastname</span>,</p>

		 <p style='color:#000;font-family:Roboto;font-size:20px'>We are very excited to have you on board SelfCare. Your registered email id is: $email</p>
		 <p style='color:#000;font-family:Roboto;font-size:20px'>Stay tuned for latest news and updates from the team at SelfCare.
</p>

		 <span style='color:#000;font-family:Roboto;font-size:20px'>Thank You,</span>
		 <span style='color:#000;display:block;font-family:Roboto;font-size:20px'>Team Selfcare !</span>
		 </div>
		 </div>
		 <u></u>
		 <footer style='background:#e96542;padding:10px 0'>
		 <div style='margin:0 auto;width:90%'>
		 <div>
		 <table>
		 <tbody><tr>
		 <td style='padding:0 15px'><div>
		 <span style='color:#ffd8ce;font-family:Roboto;font-size:14px'>COPYRIGHT@SELFCARE2016</span>
		 </div></td>
		 <td style='padding:0 15px'><div>
			<span style='color:#ffd8ce;font-family:Roboto;font-size:14px'>CONTACT US<a href='tel:+912261312222' style='color:#ffd8ce;font-family:Roboto;font-size:14px;margin:0px 10px;text-decoration:none' target='_blank'>+91 22 6131 2222</a></span>
		 </div></td>
		 <td style='padding:0 15px;vertical-align:middle' valign='middle'>
			<div>
			<span style='color:#ffd8ce;display:block;font-family:Roboto;font-size:14px'>FOLLOW US ON</span>
			<a href='https://www.facebook.com/selfcarebysuman' style='color:#ffd8ce;display:inline-block;font-family:Roboto;font-size:18px;margin:3px 5px 0 0' target='_blank'><img src='http://selfcareindia.com/img/selfcare-facebook.png' alt='Facebook' width='20' class='CToWUd'></a>
			<a href='https://twitter.com/selfcarebysuman' style='color:#ffd8ce;display:inline-block;font-family:Roboto;font-size:18px;margin:3px 5px 0 0' target='_blank'><img src='http://selfcareindia.com/img/selfcare-twitter.png' alt='Twitter' width='20' class='CToWUd'></a>
			<a href='https://www.instagram.com/selfcarebysuman' style='color:#ffd8ce;display:inline-block;font-family:Roboto;font-size:18px;margin:3px 5px 0 0' target='_blank'><img src='http://selfcareindia.com/img/selfcare-insta.png' alt='Instagram' width='20' class='CToWUd'></a>
			<a href='https://www.youtube.com/channel/UCVqKgmC6eaMrgPyXoOcOz2A' style='color:#ffd8ce;display:inline-block;font-family:Roboto;font-size:18px;margin:3px 5px 0 0' target='_blank'><img src='http://selfcareindia.com/img/selfcare-youtube.png' alt='Youtube' width='20' class='CToWUd'></a>
		 </div>
		 </td>
		 </tr>
		 </tbody></table>
		 </div>
		 </div>
		 </footer>
		 </div>


		 </div></div></div></body></html>";
            $this->email->message($message);
            $this->email->send();

            $newdata = array(
                                 'id' => $user,
                                 'email' => $email,
                                 'firstname' => $firstname,
                                 'lastname' => $lastname,
                                 'logged_in' => 'true',
                 );

            $this->session->set_userdata($newdata);
            $getuser = $this->db->query("SELECT `id`, `name`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json`, `firstname`, `lastname`, `phone`, `billingaddress`, `billingcity`, `billingstate`, `billingcountry`, `billingcontact`, `billingpincode`, `shippingaddress`, `shippingcity`, `shippingcountry`, `shippingstate`, `shippingpincode`, `shippingname`, `shippingcontact`, `currency`, `credit`, `companyname`, `registrationno`, `vatnumber`, `country`, `fax`, `gender`, `facebook`, `google`, `twitter`, `street`, `address`, `pincode`, `state`, `dob`, `city` FROM `user` WHERE `id`='$user'")->row();

            $object = $getuser;
        } else {
            $object = new stdClass();
            $object->value = false;
            $object->comment = 'Email already exists.';
        }

        return $object;
    }

    public function getallcategory()
    {
        $query = $this->db->query('SELECT `id`, `name`, `parent`, `status`, `order`, `image1`, `image2` FROM `category` WHERE `parent`=0')->result();

        return $query;
    }
    public function gethomecontent()
    {
        $query = $this->db->query('SELECT `id`, `name`, `link` as `url`, `target`, `status`, `image` as `src`, `template`, `class`, `text`, `centeralign` as `centerAlign` FROM `fynx_homeslide` WHERE `status`=1')->result();

        return $query;
    }
    public function getorderbyorderid($orderid)
    {
        $query = $this->db->query("SELECT `transactionid` FROM `fynx_order` WHERE `id`='$orderid'")->row();
        $query->amount = $this->db->query("SELECT SUM(`finalprice`) as `amount` FROM `fynx_orderitem` WHERE `order`='$orderid'")->row();

        return $query;
    }

    public function getorders($userid)
    {
        if (empty($userid)) {
            //echo "NO users found";
        } else {
            // $orders = $this->db->query("select  `fynx_order`.`id`, `fynx_orderitem`.`status` from `fynx_order` INNER JOIN `fynx_orderitem` ON `fynx_order`.`id`=`fynx_orderitem`.`order` where `user`=$userid")->result();
            // $return->plans = array();
            // $return->products = array();
            // foreach ($orders  as $plan) {
            //     if ($plan->status == 3) {
            //         $q = "SELECT `fynx_orderitem`.`order`,`fynx_product`.`id`,`plans`.`plan`,`selftables_subtype`.`name` as `subtype`,`selftables_healthpackages`.`months` ,`fynx_orderitem`.`quantity`,`fynx_orderitem`.`price` FROM `fynx_orderitem`  LEFT OUTER JOIN `plans` ON `plans`.`id`=`fynx_orderitem`.`product` LEFT OUTER JOIN `selftables_healthpackages` ON `plans`.`packageid`=`selftables_healthpackages`.`id` LEFT OUTER JOIN `selftables_subtype`ON `selftables_healthpackages`.`subtype`=`selftables_subtype`.`id` WHERE `fynx_orderitem`.`order`= '$plan->id' AND `fynx_orderitem`.`status`=3";
            //             //echo $q;
            //                 $pq = $this->db->query($q)->row();
            //         array_push($return->plans, $pq);
            //     } else {
            //         $q = "SELECT `fynx_orderitem`.`order`,`fynx_product`.`id`,`fynx_product`.`name`,`fynx_product`.`image1` as 'image' ,`fynx_orderitem`.`quantity`,`fynx_orderitem`.`price` FROM `fynx_orderitem` LEFT OUTER JOIN `fynx_product` ON `fynx_orderitem`.`product`=`fynx_product`.`id`  WHERE `fynx_orderitem`.`order`= '$plan->id' AND `fynx_orderitem`.`status`!=3";
            //         //echo $q;
            //             $pp = $this->db->query($q)->row();
            //         array_push($return->products, $pp);
            //     }
            // }

            $return->orders = $this->db->query("select DISTINCT `fynx_order`.`id` from `fynx_order` INNER JOIN `fynx_orderitem` ON `fynx_order`.`id`=`fynx_orderitem`.`order` where `fynx_order`.`user`=$userid AND `fynx_order`.`transactionid`!=''")->result();

          foreach($return->orders  as $plan)
            {
                $plan->product = $this->db->query("SELECT `fynx_orderitem`.`order`,`fynx_orderitem`.`status`,`fynx_product`.`id`,`fynx_product`.`name`,`fynx_product`.`image1` as 'image' ,`fynx_orderitem`.`quantity`,`fynx_orderitem`.`price` FROM `fynx_orderitem` LEFT OUTER JOIN `fynx_product` ON `fynx_orderitem`.`product`=`fynx_product`.`id`  WHERE `fynx_orderitem`.`order`= '$plan->id' AND `fynx_orderitem`.`status`!=3")->result();


                  $plan->plans = $this->db->query("SELECT `fynx_orderitem`.`order`,`fynx_orderitem`.`status`,`plans`.`id`,`plans`.`plan`,`selftables_subtype`.`name` as `subtype`,`selftables_healthpackages`.`months` ,`fynx_orderitem`.`quantity`,`fynx_orderitem`.`price` FROM `fynx_orderitem`  LEFT OUTER JOIN `plans` ON `plans`.`id`=`fynx_orderitem`.`product` LEFT OUTER JOIN `selftables_healthpackages` ON `plans`.`packageid`=`selftables_healthpackages`.`id` LEFT OUTER JOIN `selftables_subtype`ON `selftables_healthpackages`.`subtype`=`selftables_subtype`.`id` WHERE `fynx_orderitem`.`order`= '$plan->id' AND `fynx_orderitem`.`status`=3")->result();


                    }

          return $return;

        }

  }


    public function getUserDetails($user)
    {
        $query = $this->db->query("SELECT `id`, `name`, `password`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json`, `firstname`, `lastname`, `phone`, `billingaddress`, `billingcity`, `billingstate`, `billingcountry`, `billingcontact`, `billingpincode`, `shippingaddress`, `shippingcity`, `shippingcountry`, `shippingstate`, `shippingpincode`, `shippingname`, `shippingcontact`, `currency`, `credit`, `companyname`, `registrationno`, `vatnumber`, `country`, `fax`, `gender`, `facebook`, `google`, `twitter`, `street`, `address`, `pincode`, `state`, `dob`, `city`, `billingline1`, `billingline2`, `shippingline1`, `shippingline2`, `billingline3`, `shippingline3` FROM `user` WHERE `id`=$user")->row();

        return $query;
    }
    public function getSubCategoryProductHome($id)
    {
        $query['subcategorynames'] = $this->db->query('SELECT `homecategoryproduct`.`id`, `homecategoryproduct`.`subcategory`,`subcategory`.`name` FROM `homecategoryproduct` LEFT OUTER JOIN `subcategory` ON `subcategory`.`id`=`homecategoryproduct`.`subcategory` GROUP BY `homecategoryproduct`.`subcategory`')->result();
        $query1 = $this->db->query("SELECT `product` FROM `homecategoryproduct` WHERE `subcategory`=$id")->result();
        $productids = '(';
        foreach ($query1 as $key => $value) {
            //            $catid=$row->id;
                if ($key == 0) {
                    $productids .= $value->product;
                } else {
                    $productids .= ','.$value->product;
                }
        }
        $productids .= ')';
        if ($productids == '()') {
            $productids = '(0)';
        }
        $query['product'] = $this->db->query("SELECT `id`, `name`, `sku`, `description`, `url`, `visibility`, `price`, `wholesaleprice`, `firstsaleprice`, `secondsaleprice`, `specialpriceto`, `specialpricefrom`, `metatitle`, `metadesc`, `metakeyword`, `quantity`, `status`, `modelnumber`, `brandcolor`, `eanorupc`, `eanorupcmeasuringunits`, `type`, `compatibledevice`, `compatiblewith`, `material`, `color`, `design`, `width`, `height`, `depth`, `portsize`, `packof`, `salespackage`, `keyfeatures`, `videourl`, `modelname`, `finish`, `weight`, `domesticwarranty`, `domesticwarrantymeasuringunits`, `internationalwarranty`, `internationalwarrantymeasuringunits`, `warrantysummary`, `warrantyservicetype`, `coveredinwarranty`, `notcoveredinwarranty`, `size`, `typename`, `subcategory`, `category` FROM `product` WHERE `id` IN $productids")->result();

        return $query;
    }

    public function getFilters($catid)
    {
        $query['color'] = $this->db->query("SELECT DISTINCT  `fynx_color`.`id`,`fynx_color`.`name` FROM `fynx_product`
       LEFT OUTER JOIN `fynx_color` ON `fynx_color`.`id`=`fynx_product`.`color`
       WHERE `fynx_product`.`category`='$catid'")->result();

        $query['type'] = $this->db->query("SELECT DISTINCT  `fynx_type`.`id`,`fynx_type`.`name` FROM `fynx_product`
       LEFT OUTER JOIN `fynx_type` ON `fynx_type`.`id`=`fynx_product`.`type`
       WHERE `fynx_product`.`category`='$catid' AND `fynx_type`.`status`=2")->result();

        $query['size'] = $this->db->query("SELECT DISTINCT  `fynx_size`.`id`,`fynx_size`.`name` FROM `fynx_product`
       LEFT OUTER JOIN `fynx_size` ON `fynx_size`.`id`=`fynx_product`.`size`
       WHERE `fynx_product`.`category`='$catid' AND `fynx_size`.`status`=2")->result();

        $query['subcategory'] = $this->db->query("SELECT DISTINCT  `fynx_subcategory`.`id`,`fynx_subcategory`.`name` FROM `fynx_product`
       LEFT OUTER JOIN `fynx_subcategory` ON `fynx_subcategory`.`id`=`fynx_product`.`subcategory`
       WHERE `fynx_product`.`category`='$catid' AND `fynx_subcategory`.`status`=2 AND `fynx_subcategory`.`category`='$catid'")->result();

        return $query;
    }
    public function removeFromWishlist($user, $product, $design)
    {
        $query = $this->db->query(" DELETE FROM `fynx_wishlist` WHERE `user`='$user' AND `product`='$product' AND `design`='$design'");
        if ($query) {
            return 1;
        } else {
            return false;
        }
    }
    public function getAllSize()
    {
        $query = $this->db->query('SELECT `id`, `status`, `name` FROM `fynx_size` WHERE 1')->result();

        return $query;
    }

    public function getFiltersLater($query)
    {
        $query2 = " SELECT `id` FROM ($query) as `tab1` ";
        $query3['subcategory'] = $this->db->query(" SELECT DISTINCT `fynx_subcategory`.`name`,`fynx_subcategory`.`id`,`fynx_subcategory`.`order` FROM `fynx_product` INNER JOIN `fynx_subcategory` ON `fynx_product`.`subcategory` = `fynx_subcategory`.`id` WHERE `fynx_product`.`id` IN ($query2) ")->result();

        return $query3;
    }
    public function updateProfile($user, $firstname, $lastname, $email, $phone, $billingline1, $billingline2, $billingline3, $billingcity, $billingstate, $billingcountry, $billingpincode, $shippingline1, $shippingline2, $shippingline3, $shippingcity, $shippingstate, $shippingpincode, $shippingcountry)
    {
        $data = array(
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'phone' => $phone,
            'billingcity' => $billingcity,
            'billingstate' => $billingstate,
            'billingcountry' => $billingcountry,
            'billingpincode' => $billingpincode,
            'shippingcity' => $shippingcity,
            'shippingstate' => $shippingstate,
            'shippingcountry' => $shippingcountry,
            'shippingpincode' => $shippingpincode,
            'billingline1' => $billingline1,
            'billingline2' => $billingline2,
            'billingline3' => $billingline3,
            'shippingline1' => $shippingline1,
            'shippingline2' => $shippingline2,
            'shippingline3' => $shippingline3,
        );

        $this->db->where('id', $user);
        $query = $this->db->update('user', $data);

        $useridquery = $this->db->query("SELECT `id`, `name`,`firstname`,`lastname`,`email`, `phone`, `billingaddress`, `billingcity`, `billingstate`, `billingcountry`, `billingcontact`, `billingpincode`, `shippingaddress`, `shippingcity`, `shippingcountry`, `shippingstate`, `shippingpincode`, `shippingname`, `shippingcontact`,  `billingline1`, `billingline2`, `shippingline1`, `shippingline2`, `billingline3`, `shippingline3` FROM `user` WHERE `id`='$user'")->row();

        return $useridquery;
    }

    public function addToCart($product, $quantity, $json, $status)
    {
        if ($status == 3) {
            $getexactproduct = $this->db->query("SELECT * FROM `plans` WHERE `id`='$product'")->row();
            $exactproduct = $getexactproduct->id;
            $packageid = $getexactproduct->packageid;
            $price = $getexactproduct->price_in_INR;
            $productname = $getexactproduct->plan;
            $price = floatval($price);
            $months = $this->db->query("SELECT `months` as 'months',`subtype` as 'subtype'  FROM `selftables_healthpackages` WHERE `id`='$packageid'")->row();
            $subtype = $this->db->query("SELECT `selftables_subtype`.`name` as 'name' FROM `selftables_healthpackages` INNER JOIN `selftables_subtype` ON `selftables_healthpackages`.`subtype`=`selftables_subtype`.`id` WHERE `selftables_subtype`.`id`='$months->subtype'")->row();

            $data = array(
                   'id' => $exactproduct,
                   'qty' => 1,
                  'price' => $price,
                   'name' => $productname,
                                 'options' => array(
                                                        'status' => $status,
                                                        'subtype' => $subtype->name,
                                                        'plan' => $productname,
                                                            'months' => $months->months,
                                                ),
                );
        } else {
            $getexactproduct = $this->db->query("SELECT * FROM `fynx_product` WHERE `id`='$product'")->row();
            $size = $getexactproduct->size;
            $stockquantity = $getexactproduct->quantity;
            $productname = $getexactproduct->name;
            $price = $getexactproduct->price;
            $color = $getexactproduct->color;
            $image = $getexactproduct->image1;
            $exactproduct = $getexactproduct->id;
            $getsize = $this->db->query("SELECT `id`, `status`, `name` FROM `fynx_size` WHERE `id`='$size'")->row();
            $sizeid = $getsize->id;
            $sizename = $getsize->name;
            $getcolor = $this->db->query("SELECT `id`, `name`, `status`, `timestamp` FROM `fynx_color` WHERE `id`='$color'")->row();
            $colorid = $getcolor->id;
            $colorname = $getcolor->name;
            $data = array(
                         'id' => $exactproduct,
                         'name' => '1',
                         'qty' => $quantity,
                         'price' => $price,
                         'image' => $image,
                            'options' => array(
                                    'status' => $status,
                                    'realname' => $productname,
                            ),
            );
        }

        $userid = $this->session->userdata('id');

        if (empty($userid)) {
            $this->cart->insert($data);
            $returnval = $this->cart->insert($data);
            if (!empty($returnval)) {
                $object = new stdClass();
                $object->value = true;

                return $object;
            } else {
                $object->value = false;
                $object->comment = 'Internal Server Error';

                return $object;
            }
        } else {
            // USER ID IS PRESENT

                        if ($status == 1) {

                                //PRODUCT DETAIL
                                                            //CHECK IF PRODUCT ALREADY THERE IN CART
                                $checkcart = $this->db->query("SELECT * FROM `fynx_cart` WHERE `user`='$userid' AND `product`='$exactproduct' and `status`=0");
                            if ($checkcart->num_rows() > 0) {
                                //  //already in cart
                                        // 		 $object = new stdClass();
                                        // 		 $object->value = false;
                                        // 		 $object->comment = 'already in cart';
                                        // 		 return $object;
                                        $queryupdate = $this->db->query("UPDATE `fynx_cart` SET `quantity`='$quantity' WHERE `user`='$userid' AND `product`='$exactproduct' and `status`=0");
                                $this->cart->insert($data);
                                if ($queryupdate) {
                                    $object = new stdClass();
                                    $object->value = true;

                                    return $object;
                                } else {
                                    $object = new stdClass();
                                    $object->value = false;
                                    $object->comment = 'Internal Server Error';

                                    return $object;
                                }
                            } else {
                                if ($quantity > $stockquantity) {
                                    $object = new stdClass();
                                    $object->value = false;
                                    $object->comment = 'quantity not available ';

                                    return $object;
                                } else {
                                    // INSERT PRODUCT IN CART
                                                $query = $this->db->query("INSERT INTO `fynx_cart`(`user`, `product`, `quantity`, `timestamp`,`design`) VALUES ('$userid','$exactproduct','$quantity',NULL,'$design')");
                                    $this->cart->insert($data);
                                    if ($query) {
                                        $object = new stdClass();
                                        $object->value = true;

                                        return $object;
                                    } else {
                                        $object = new stdClass();
                                        $object->value = false;
                                        $object->comment = 'Internal Server Error';

                                        return $object;
                                    }
                                }
                            }
                        }

            if ($status == 3) {

                                //PRODUCT DETAIL
                                                            //CHECK IF PRODUCT ALREADY THERE IN CART
                                $checkcart = $this->db->query("SELECT * FROM `fynx_cart` WHERE `user`='$userid' AND `product`='$exactproduct'  and `status`=3");
                if ($checkcart->num_rows() > 0) {
                    //already in cart
                                                 $object = new stdClass();
                    $object->value = false;
                    $object->comment = 'already in cart';

                    return $object;
                } else {

                                // INSERT PRODUCT IN CART
                                                $query = $this->db->query("INSERT INTO `fynx_cart`(`user`,`quantity`, `product`, `status`, `timestamp`,`design`) VALUES ('$userid',1,'$exactproduct','$status',NULL,'$design')");
                    $this->cart->insert($data);
                    if ($query) {
                        $object = new stdClass();
                        $object->value = true;

                        return $object;
                    } else {
                        $object = new stdClass();
                        $object->value = false;
                        $object->comment = 'Internal Server Error';

                        return $object;
                    }
                }
            }

                        // else
                        // {
                        //
                        // 		$checkcartagain=$this->db->query("SELECT * FROM `fynx_cart` WHERE `user`='$userid' AND `product`='$exactproduct'");
                        // 			if ( $checkcartagain->num_rows() > 0 )
                        // 		 {
                        // 						//UPDATE DATABASE CART
                        //
                        // 				$queryupdate=$this->db->query("UPDATE `fynx_cart` SET `quantity`='$quantity' WHERE `user`='$userid' AND `product`='$exactproduct' and `status`=0");
                        // 				$this->cart->insert($data);
                        // 				if($queryupdate){
                        // 						 $object = new stdClass();
                        // 						 $object->value = true;
                        // 						 return $object;
                        // 						}
                        // 				else{
                        // 						 $object = new stdClass();
                        // 						 $object->value = false;
                        // 						 $object->comment = 'Internal Server Error';
                        // 						 return $object;
                        // 				}
                        // 		 }
                        // 		else{
                        // 				 // INSERT PRODUCT IN CART
                        // 						$query=$this->db->query("INSERT INTO `fynx_cart`(`user`, `product`, `quantity`, `timestamp`,`design`) VALUES ('$userid','$exactproduct','$quantity',NULL,'$design')");
                        // 				$this->cart->insert($data);
                        // 				if($query){
                        // 						 $object = new stdClass();
                        // 						 $object->value = true;
                        // 						return $object;
                        // 						}
                        // 				else{
                        // 						$object = new stdClass();
                        // 						 $object->value = false;
                        // 						 $object->comment = 'Internal Server Error';
                        // 						return $object;
                        // 						}
                        // 		}
                        //
                        // }
        }
    }

    public function removeFromCart($cart, $status)
    {
        $user = $this->session->userdata('id');
        if ($user != '') {
            $deletecart = $this->db->query("DELETE FROM `fynx_cart` WHERE `product`='$cart' AND `user`='$user'AND `status`='$status'");

            if (!empty($deletecart)) {
                $object = new stdClass();
                $object->value = true;

                return $object;
            } else {
                $object = new stdClass();
                $object->value = false;

                return $object;
            }
        } else {
            $id = $cart;
            $cart = $this->cart->contents();
            $newcart = array();
            foreach ($cart as $item) {
                if ($item['id'] != $id) {
                    array_push($newcart, $item);
                }
            }
            $this->cart->destroy();
            $this->cart->insert($newcart);
            $object = new stdClass();
            $object->value = true;

            return $object;
        }
    }

    public function changepassword($id, $oldpassword, $newpassword, $confirmpassword)
    {
        $oldpassword = md5($oldpassword);
        $newpassword = md5($newpassword);
        $confirmpassword = md5($confirmpassword);
        if ($newpassword == $confirmpassword) {
            $useridquery = $this->db->query("SELECT `id` FROM `user` WHERE `password`='$oldpassword'");
            if ($useridquery->num_rows() == 0) {
                $object = new stdClass();
                $object->value = false;

                return $object;
            } else {
                $query = $useridquery->row();
                $userid = $query->id;
                $updatequery = $this->db->query("UPDATE `user` SET `password`='$newpassword' WHERE `id`='$userid'");
                $object = new stdClass();
                $object->value = true;

                return $object;
            }
        } else {
            //            echo "New password and confirm password do not match!!!";
        //	return -1;
        $object = new stdClass();
            $object->value = false;

            return $object;
        }
    }
    public function checkstatus($orderid)
    {
        $query = $this->db->query("SELECT * FROM `fynx_order` WHERE `id`='$orderid'")->row();
        $orderstatus = $query->orderstatus;
        if ($orderstatus == 1) {
            return 1;
        } else {
            return 0;
        }
    }
    public function updateorderstatusafterpayment($OrderId, $nb_bid, $nb_order_no, $responsecode, $Amount)
    {
        $checkamt = $this->db->query("SELECT IFNULL(SUM(`price`),0) as `totalamount` FROM `fynx_orderitem` WHERE `order`='$orderid'")->row();
        $totalamount = $checkamt->totalamount;
        if (intval($Amount)  > 0 ) {
            $query1 = $this->db->query("UPDATE `fynx_order` SET `orderstatus`='$responsecode',`nb_bid`='$nb_bid',`transactionid`='$nb_order_no' WHERE `id`='$OrderId'");
             // DESTROY CART
                    $getuser = $this->db->query("SELECT `user` FROM `fynx_order` WHERE `id`='$OrderId'")->row();
            $user = $getuser->user;
            $this->cart->destroy();
            $deletecart = $this->db->query("DELETE FROM `fynx_cart` WHERE `user`='$user'");
            redirect('http://selfcareindia.com/#/thankyou/'.$OrderId/$totalamount);
        } else {
            $query = $this->db->query("UPDATE `fynx_order` SET `orderstatus`=5,`transactionid`='$nb_order_no' WHERE `id`='$OrderId'");
            redirect('http://selfcareindia.com/#/wentwrong/'.$OrderId);
        }
    }
    public function checkproductquantity($prodid)
    {
        $query = $this->db->query("SELECT `quantity` FROM `fynx_product` WHERE `id`='$prodid'")->row();
        $quantity = $query->quantity;

        return $quantity;
    }
}
