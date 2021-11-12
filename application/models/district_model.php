<?php

class District_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    function insert($district) {
        $this->db->insert("districts", $district);
    }

    function edit($id, $district) {
        $this->db->update("districts", $district, array('id' => $id));
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete("districts");
    }

    function get_all_entries() {
        $queryString = "select 
                        d.id,
                        d.district_name,
                        s.state_name,
                        d.state_id
                        from 
                        districts d,states s
                        where
                        d.state_id = s.id
                        order by
                        s.state_name asc,
                        d.district_name asc";
        $query = $this->db->query($queryString);
        return $query->result();
    }

    function get_one_district($id) {
        $query = $this->db->get_where("districts", array('id' => $id));
        return $query->result();
    }

    function get_district_name($id) {
        $a = $this->get_one_district($id);
        return $a[0]->state_name;
    }

    ///////////////////////////////////////////////////////////
    /////////////// METADATA QUERY FUNCTIONS //////////////////
    ///////////////////////////////////////////////////////////

    function getDistrictCount() {
        $query = $this->db->get('districts');
        $result = $query->result();
        $q = count($result);

        return $q;
    }

}
