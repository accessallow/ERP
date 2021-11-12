<?php

class Mapping_model extends CI_Model{
    var $tableName = 'mapping';
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
    public function getMapping($productId=null){
        $query = null;
        if($productId!=null){
            $queryString = "select 
                        m.id,
                        b.block_name,
                        d.district_name,
                        s.state_name,
                        m.state_id,
                        m.district_id,
                        m.product_id
                        from 
                        mapping m,block b,districts d,states s
                        where
                        m.state_id = s.id and
                        m.district_id = d.id and
                        m.block_id = b.id and
                        m.product_id=$productId 
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
                        m.product_id
                        from 
                        mapping m,block b,districts d,states s
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
            'product_id'=>$mapping['product_id'],
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
    
    public function isVersionMappingExist($mapping){
        
        $query = $this->db->get_where('versioning',array(
            'product_id'=>$mapping['product_id'],
            'version'=>$mapping['version']
        ));
        
        $r =  $query->result();
        if(sizeof($r)>0){
            return true;
        }else{
            return false;
        }
    }
    
    public function getVersionMapping($product_id){
         $queryString = "select 
            v.id,v.product_id,p.id as 'version_id',p.product_category_name as 'version_name'
            from versioning v, product_version p
            where (
            product_id = $product_id and
            v.version = p.product_category_name
            )";
         //echo $queryString;
         
        $query = $this->db->query($queryString);
        $r =  $query->result();
        return $r;
    }
    
    public function getUnmappedVersions($product_id){
        $queryString = "select p.id,p.product_category_name as 'version_name' from product_version p where 
        (
        p.product_category_name not in (select version from versioning where product_id=$product_id)
         and p.tag=1   

        )";
         //echo $queryString;
         
        $query = $this->db->query($queryString);
        $r =  $query->result();
        return $r;
    }
    public function getMappedVersions($product_id){
        $queryString = "select 
            v.id,v.product_id,p.id as 'version_id',p.product_category_name as 'version_name'
            from versioning v, product_version p
            where (
            product_id = $product_id and
            v.version = p.product_category_name
            )";
         //echo $queryString;
         
        $query = $this->db->query($queryString);
        $r =  $query->result();
        return $r;
    }
    
    
    public function insertVersionMapping($mapping){
        $this->db->insert('versioning',$mapping);
    }
    public function updateVersionMapping($mappingId,$mapping){
        $this->db->update($this->tableName,$mapping,array(
            'id'=>$mappingId
        ));
    }
    public function deleteVersionMapping($mappingId){
        $this->db->delete('versioning',array(
            'id'=>$mappingId
        ));
    }
    
    public function getVersionMappingFromId($mappingId){
        $query = $this->db->get_where('versioning',array(
            'id'=>$mappingId
        ));
        return $query->result();
    }
}

