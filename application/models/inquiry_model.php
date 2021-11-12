<?php

class Inquiry_model extends CI_Model{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function registerInquiry($newInquiry){
        $newInquiry['tag'] = 1;
        $this->db->insert('inquiry',$newInquiry);
    }
    public function updateInquiry($inquiryId,$newInquiry){
        $this->db->update('inquiry', $newInquiry, array(
            'id' => $inquiryId
        ));
    }
    public function deleteInquiry($inquiryId){
        $this->db->delete('inquiry', array(
            
            'id' => $inquiryId
        ));
    }
    public function updateStatus($inquiryId,$newStatus){
        $this->db->update('inquiry', array(
            'tag' => $newStatus
                ), array(
            'id' => $inquiryId
        ));
    }
    public function getOneInquiry($inquiryId){
        $query = $this->db->get_where('inquiry', array(
                'id' => $inquiryId
            ));
        $r =  $query->result();
        if(sizeof($r)==1){
            return $r[0];
        }else{
            return null;
        }
    }
    
    public function get_all($inquiryStatus = null) {
        $extraQuery = null;
        if ($inquiryStatus) {
            $extraQuery = "and i.tag = $inquiryStatus";
        } else {
            $extraQuery = "";
        }
        
        $queryString = "select 
            i.id,i.customer_name,i.customer_contact,i.customer_address,
            i.seller_name,i.seller_id,i.quoted_price,i.state_name,i.district_name,i.block_name,
            i.product_id,p.product_name,i.inquiry_time,i.tag
            from inquiry i,products p
            where (i.product_id = p.id $extraQuery)
            order by i.tag asc,i.inquiry_time desc";
        
        $query = $this->db->query($queryString);
        return $query->result();
    }
    
    public function getMinInquiryDate(){
        $queryString = "select min(inquiry_time) as inquiry_time from inquiry";
        $query = $this->db->query($queryString);
        $inquiryTime = $query->result();
        $inquiryTime = $inquiryTime[0];
        $inquiryTime = $inquiryTime->inquiry_time;
        //echo $inquiryTime;
       
        //echo explode(" ", $inquiryTime)[0];
        
        return explode(" ", $inquiryTime);
        
    }
}

