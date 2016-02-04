<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class healthpackages_model extends CI_Model
{

public function getPlans($sid)
{
if($sid !="")
{
    $return->plans = $this->db->query("select `id`,`consults`,`months`,`type` from `selftables_healthpackages` where `subtype`=$sid" )->result();
}
else {
    $return->plans = $this->db->query("select `id`,`consults`,`months`,`type` from `selftables_healthpackages`")->result();
}
  foreach($return->plans  as $plan)
  {
    $plan->subplans = $this->db->query("select `plan`,`title`,`description` from `plans` where `packageid`= '$plan->id' ")->result();
  }
  return $return;


}

public function getSubPackages()
{
$query= $this->db->query("select `id`,`name`,`description`,`image`,`order` from selftables_subtype where `status`=0")->result();
return $query;
}

public function create($type,$months,$visits,$plan,$price_in_INR,$price_in_dollars,$description,$title,$subtype)
{
$data=array("type" => $type,"months" => $months,"consults" => $visits,"plan" => $plan,"price_in_INR" => $price_in_INR,"price_in_dollars" => $price_in_dollars,"description" => $description,"title" => $title,"subtype" => $subtype);
$query=$this->db->insert( "selftables_healthpackages", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("selftables_healthpackages")->row();
return $query;
}
function getsinglehealthpackages($id){
$this->db->where("id",$id);
$query=$this->db->get("selftables_healthpackages")->row();
return $query;
}
public function edit($id,$type,$months,$visits,$plan,$price_in_INR,$price_in_dollars,$description,$title,$subtype)
{
if($image=="")
{
$image=$this->healthpackages_model->getimagebyid($id);
$image=$image->image;
}
$data=array("type" => $type,"months" => $months,"visits" => $visits,"plan" => $plan,"price_in_INR" => $price_in_INR,"price_in_dollars" => $price_in_dollars,"description" => $description,"title" => $title,"subtype" => $subtype);
$this->db->where( "id", $id );
$query=$this->db->update( "selftables_healthpackages", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `selftables_healthpackages` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
// $query=$this->db->query("SELECT `image` FROM `selftables_healthpackages` WHERE `id`='$id'")->row();
// return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `selftables_healthpackages` ORDER BY `id`
                    ASC")->row();
$return=array(
"" => "Select Option"
);
foreach($query as $row)
{
$return[$row->id]=$row->name;
}
return $return;
}

public function getplanrdropdown()
{
$status= array(
   "" => "Choose Plan",
   "1" => "Silver",
   "2" => "Gold",
   "3" => "Platinum",
   "4" => "Diamond"
  );
return $status;
}

public function getsubtypedropdown()
{
$query=$this->db->query("SELECT * FROM `selftables_subtype`  ORDER BY `id` ASC")->result();
$return=array(
);
foreach($query as $row)
{
  $return[$row->id]=$row->name;
}

return $return;
}

}
?>