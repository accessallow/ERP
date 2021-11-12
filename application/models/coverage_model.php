<?php

class Coverage_model extends CI_Model{
    var $tableName = 'coverage';
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function insertMapping($mapping){
        $this->db->insert($this->tableName,$mapping);
    }
    public function updateMapping($mappingId,$mapping){
        $this->db->update($this->tableName,$mapping,array(
            'id'=>$mappingId
        ));
    }
    public function deleteMapping($mappingId){
        $this->db->delete($this->tableName,array(
            'id'=>$mappingId
        ));
    }
    public function getMapping($sellerId=null){
        $query = null;
        if($sellerId!=null){
            $queryString = "select 
                        m.id,
                        b.block_name,
                        d.district_name,
                        s.state_name,
                        m.state_id,
                        m.district_id,
                        m.seller_id
                        from 
                        coverage m,block b,districts d,states s
                        where
                        m.state_id = s.id and
                        m.district_id = d.id and
                        m.block_id = b.id and
                        m.seller_id=$sellerId
                         order by
                        s.state_name asc,
                        d.district_name asc,
                        b.block_name asc";
        $query = $this->db->query($queryString);
        }else{
            $queryString = "select 
                        m.id,
                        b.block_name,
                        d.district_name,
                        s.state_name,
                        m.state_id,
                        m.district_id,
                        m.seller_id
                        from 
                        coverage m,block b,districts d,states s
                        where
                        m.state_id = s.id and
                        m.district_id = d.id and
                        m.block_id = b.id 
                        
                         order by
                        s.state_name asc,
                        d.district_name asc,
                        b.block_name asc";
        $query = $this->db->query($queryString);
        }
        return $query->result();
    }
    public function getMappingFromId($mappingId){
        $query = $this->db->get_where($this->tableName,array(
            'id'=>$mappingId
        ));
        return $query->result();
    }
    public function isMappingExist($mapping){
        
        $query = $this->db->get_where($this->tableName,array(
            'seller_id'=>$mapping['seller_id'],
            'state_id'=>$mapping['state_id'],
            'district_id'=>$mapping['district_id'],
            'block_id'=>$mapping['block_id']
        ));
        
        $r =  $query->result();
        if(sizeof($r)>0){
            return true;
        }else{
            return false;
        }
    }
}

