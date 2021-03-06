<?php

//done 
class ProductTags {

    public static $deleted = 0;
    public static $available = 1;

}

class Product_model extends CI_Model {

    var $product_name = "";
    var $product_brand = "";
    var $product_price = "";
    var $slug = "";
    var $product_domain = "";
    var $product_category = "";
    var $seller_id = "";
    var $product_description = "";
    var $stock = null;
    var $tag = NULL;

    public function __construct() {
        $this->load->database();
    }

    function insert($name, $brand, $price, $slug, $domain, $category, $seller_id, $description) {
        $this->product_name = $name;
        $this->product_brand = $brand;
        $this->product_price = $price;
        $this->slug = $slug;
        $this->product_domain = $domain;
        $this->product_category = $category;
        $this->seller_id = $seller_id;
        $this->product_description = $description;
        $this->stock = 0;
        $this->tag = ProductTags::$available;

        $this->db->insert("products", $this);
    }

    function edit($id, $name, $brand, $price, $slug, $domain, $category, $seller_id, $description, $stock) {
        $this->product_name = $name;
        $this->product_brand = $brand;
        $this->product_price = $price;
        $this->slug = $slug;
        $this->product_domain = $domain;
        $this->product_category = $category;
        $this->seller_id = $seller_id;
        $this->product_description = $description;
        $this->stock = $stock;
        $this->tag = ProductTags::$available;

        $this->db->update('products', $this, array('id' => $id));
    }

    function delete($id) {

        $data = array('tag' => ProductTags::$deleted);
        $this->db->where('id', $id);
        $this->db->update('products', $data);
        
        $this->db->update('product_seller_mapping',array(
            'tag'=>0
        ),array(
            'product_id'=>id
        ));
        
    }

    function get_all_entries($where = null) {
        $where['tag'] = ProductTags::$available;
        $this->db->order_by("product_name", "asc");
        $query = $this->db->get_where('products', $where);
        return $query->result();
    }

    function get_all_entries_no_matter_what() {
        /*
         * this function will return all the product records whether
         * they are deleted or available not does not matter..
         * use it with caution
         * it is returning dead-products...you will not want to mess with
         * dead things   
         */
        $query = $this->db->get_where('products');
        return $query->result();
    }

    function get_all_entries_joined($category_id = null) {
        if ($category_id) {
            $queryString = "SELECT p.id,p.product_category as 'product_category_id',
            p.product_name,p.product_brand,p.product_price,
            p.product_domain as 'domain_id',d.product_category_name as 'domain_name',
            p.slug,c.product_category_name as 'product_category',s.seller_name as 'seller_name',p.seller_id,
                p.product_description,
                p.screen_association,p.state_association,p.district_association,
                p.stock FROM products p,product_category c,seller s,product_domain d  
                WHERE (p.product_category = c.id and
                p.product_category = $category_id and
                p.seller_id = s.id and
                p.product_domain = d.id and 
                p.tag = " . ProductTags::$available . ")"
                    . "order by s.seller_name asc,p.product_name asc;";
        } else {
            $queryString = "SELECT p.id,c.id as 'product_category_id',
                p.product_name,p.product_brand,p.product_price,
                p.product_domain as 'domain_id',d.product_category_name as 'domain_name',
                p.slug,c.product_category_name as 'product_category',s.seller_name as 'seller_name',p.seller_id,
                p.product_description,
                p.screen_association,p.state_association,p.district_association,                
                p.stock FROM products p,product_category c,seller s,product_domain d
                WHERE (
                p.product_category = c.id 
                and p.seller_id = s.id 
                and p.product_domain = d.id 
                and  p.tag = " . ProductTags::$available . ""
                    . ") order by p.product_name asc;";
        }

        $query = $this->db->query($queryString);
        return $query->result();
    }

    function get_products_mark_ordered() {
        $where['tag'] = ProductTags::$available;
        $this->db->order_by("mark", "asc");
        $this->db->order_by("product_name", "asc");
        $query = $this->db->get_where('products', $where);
        return $query->result();
    }

    function get_one_product_joined($product_id) {
        $queryString = "SELECT p.id,c.id as 'product_category_id',
                p.product_name,p.product_brand,p.product_price,
                p.product_domain as 'domain_id',d.product_category_name as 'domain_name',
                p.slug,c.product_category_name as 'product_category',
                s.seller_name as 'seller_name',p.seller_id as 'seller_id',
                p.product_description,p.crop_association,p.product_association, p.disease_association,
                p.screen_association,p.state_association,p.district_association,
                p.stock
                FROM products p,product_category c , product_domain d,seller s
                WHERE ( p.product_category = c.id and 
                p.id = $product_id
                and p.product_domain = d.id  
                and p.seller_id = s.id
                and p.tag = " . ProductTags::$available . ""
                . ") order by p.product_name asc;";
        $query = $this->db->query($queryString);
        return $query->result();
    }

    function get_all_entries_joined_no_matter_what() {
        $query = $this->db->query('SELECT p.id,p.product_name,p.product_brand,c.product_category_name as \'product_category\','
                . 'p.product_description,p.stock FROM products p,product_category c WHERE p.product_category = c.id;');
        return $query->result();
    }

    function get_one_product($id) {

        $query = $this->db->get_where('products', array('id' => $id, 'tag' => ProductTags::$available));
        return $query->result();
    }

    function get_one_product_no_matter_what($id) {

        $query = $this->db->get_where('products', array('id' => $id));
        return $query->result();
    }

    function get_products_from_this_seller($seller_id) {
//        $queryString = "select 
//                        p.id as 'id',
//                        psm.id as 'mapping_id',
//                        p.product_name,
//                        p.product_brand,p.product_price,
//                        psm.product_price,
//                        (select product_category_name from product_category where product_category.id=p.product_category) as 'product_category',
//                        p.product_category as 'product_category_id',
//                        p.product_description,
//                        p.stock
//                        from
//                        products p,
//                        product_seller_mapping psm
//                        where
//                        (
//                        p.id = psm.product_id and
//                        psm.seller_id = $seller_id and
//                        p.tag=1 and
//                        psm.tag=1
//                        )
//                        order by 
//                        p.product_name asc;";

        $queryString = "select 
                        p.id as 'id',
                        psm.id as 'mapping_id',
                        p.product_name,
                        p.product_brand,
                        psm.product_price,
                        (select product_category_name from product_category where product_category.id=p.product_category) as 'product_category',
                        p.product_category as 'product_category_id',
						p.product_domain as 'domain_id',
						(select product_category_name from product_domain where product_domain.id=p.product_domain) as 'domain_name',
						p.slug,
						(select seller_name from seller where seller.id=psm.seller_id) as 'seller_name',
						psm.seller_id as 'seller_id',
                        p.product_description,
                        p.screen_association,p.state_association,p.district_association,
                        p.stock
                        from
                        products p,
                        product_seller_mapping psm
						
                        where
                        (
                        p.id = psm.product_id and
                        psm.seller_id = $seller_id and
                        p.tag=1 and
                        psm.tag=1
                        )
                        order by 
                        p.product_name asc;";
        $query = $this->db->query($queryString);
        return $query->result();
    }

    function get_products_which_this_seller_dont_sell($seller_id) {
        $queryString = "select 
                        *
                        from 
                        products 
                        where
                        id 
                        not in(select distinct product_id
                        from product_seller_mapping
                        where seller_id = $seller_id
                        and tag = 1
                        ) and tag = 1;
                        ";
        $query = $this->db->query($queryString);
        return $query->result();
    }

    ///////////////////////////////////////////////
    ///////////////METADATA QUERY FUNCTIONS//////////
    ///////////////////////////////////////////////

    function get_total_products($whereArray) {
        $this->db->where($whereArray);
        $this->db->from('products');
        $q = $this->db->count_all_results();

        return $q;
    }

    function get_total_categorized_products($category_id) {
        $this->db->where(array('product_category' => $category_id, 'tag' => 1));
        $this->db->from('products');
        $q = $this->db->count_all_results();

        return $q;
    }

    function count_my_sellers($product_id) {
        $this->db->where(array(
            'product_id' => $product_id,
            'tag' => ProductTags::$available
        ));
        $this->db->from('product_seller_mapping');
        $a = $this->db->count_all_results();
        return $a;
    }

    function my_best_rate($product_id) {
        $mysellers = $this->count_my_sellers($product_id);
        if ($mysellers == 0 || $mysellers == null) {
            return 0;
        } else {
            $where = array(
                'product_id' => $product_id,
                'tag' => ProductTags::$available
            );
            $this->db->select_min('product_price');
            $query = $this->db->get_where('product_seller_mapping', $where);

            $r = $query->result();
            $r = $r[0];
            return $r->product_price;
        }
    }

    function my_best_seller($product_id) {
//        echo "Product_id = $product_id<br/>";
        $mysellers = $this->count_my_sellers($product_id);
        if ($mysellers == 0) {
            return "Nil";
        } else {
            $best_price = $this->my_best_rate($product_id);
//            echo 'Best Price = '.$best_price;
            $where = array(
                'product_id' => $product_id,
                'product_price' => $best_price,
                'tag' => ProductTags::$available
            );
            $q = $this->db->get_where('product_seller_mapping', $where);
            $q = $q->result();
            $q = $q[0];
            $where = array(
                'id' => $q->seller_id,
                'tag' => ProductTags::$available
            );
            $qr = $this->db->get_where('seller', $where);
//            echo "<pre>";
//            echo var_dump($qr);
//            echo "</pre>";

            $qr = $qr->result();
            $qr = $qr[0];
            return $qr->seller_name;
        }
    }

    function update_my_stock($product_id, $count) {
        $this->db->update('products', array('stock' => $count), //this to update
                array('id' => $product_id)); //where id=blah
    }

    function mark_product($product_id, $mark) {
        $data = array('mark' => $mark);
        $this->db->where('id', $product_id);
        $this->db->update('products', $data);
    }

    function get_mark($product_id) {
        $product = $this->get_one_product($id);
        if ($product != null) {
            $product = $product[0];
            return $product['mark'];
        } else {
            return null;
        }
    }

    function attachCropString($productId, $cropString) {
        $this->db->update('products', array(
            'crop_association' => $cropString
                ), array(
            'id' => $productId
        ));
    }

    function attachProdString($productId, $cropString) {
        $this->db->update('products', array(
            'product_association' => $cropString
                ), array(
            'id' => $productId
        ));
    }

    function attachDiseaseString($productId, $cropString) {
        $this->db->update('products', array(
            'disease_association' => $cropString
                ), array(
            'id' => $productId
        ));
    }

    function attachScreenString($productId, $cropString) {
        $this->db->update('products', array(
            'screen_association' => $cropString
                ), array(
            'id' => $productId
        ));
    }
    function attachStateString($productId, $cropString) {
        $this->db->update('products', array(
            'state_association' => $cropString
                ), array(
            'id' => $productId
        ));
    }
    function attachDistrictString($productId, $cropString) {
        $this->db->update('products', array(
            'district_association' => $cropString
                ), array(
            'id' => $productId
        ));
    }

    function isSlugAvailble($slug) {
        $query = $this->db->get_where('products', array(
            'slug' => $slug
        ));
        $result = $query->result();
        if (count($result) > 0) {
            return false;
        }
        return true;
    }

    function getProductsOfaCrop($cropSlug) {

        $queryString = "SELECT p.id,c.id as 'product_category_id',
                p.product_name,p.product_brand,p.product_price,
                p.product_domain as 'domain_id',d.product_category_name as 'domain_name',
                p.slug,c.product_category_name as 'product_category',s.seller_name as 'seller_name',p.seller_id,
                p.product_description,p.stock FROM products p,product_category c,seller s,product_domain d
                WHERE (
                p.product_category = c.id 
                and p.seller_id = s.id 
                and p.product_domain = d.id   
                and INSTR(`crop_association`, '$cropSlug') > 0
                and  p.tag = " . ProductTags::$available . ""
                . ") order by s.seller_name asc,p.product_name asc;";

        $query = $this->db->query($queryString);
        return $query->result();
    }

    function getProductFromSellerRenew($seller_id) {
        $queryString = "SELECT p.id,c.id as 'product_category_id',
                p.product_name,p.product_brand,p.product_price,
                p.product_domain as 'domain_id',d.product_category_name as 'domain_name',
                p.slug,c.product_category_name as 'product_category',s.seller_name as 'seller_name',p.seller_id,
                p.product_description,p.stock FROM products p,product_category c,seller s,product_domain d
                WHERE (
                p.product_category = c.id 
                and p.seller_id = s.id 
                and p.seller_id = $seller_id
                and p.product_domain = d.id  
                and  p.tag = " . ProductTags::$available . ""
                . ") order by s.seller_name asc,p.product_name asc;";

        $query = $this->db->query($queryString);
        return $query->result();
    }

    function getSideProductsOfaProduct($productId) {

        $p = $this->get_one_product($productId);
        $p = $p[0];
        $productSlugs = $p->product_association;
        //echo $productSlugs;
//        $seperateSlugsArray = preg_split(",",$productSlugs);
//        var_dump($productSlugs);
//        var_dump($seperateSlugsArray);
//        echo $seperateSlugsArray;
//        
//        $b = [];
//        foreach ($seperateSlugsArray as $value) {
//            $value = "'$value'";
//            array_push($b, $value);
//        }
//        $c = implode(",", $b);

        $queryString = "SELECT p.id,c.id as 'product_category_id',
                p.product_name,p.product_brand,p.product_price,
                p.product_domain as 'domain_id',d.product_category_name as 'domain_name',
                p.slug,c.product_category_name as 'product_category',s.seller_name as 'seller_name',p.seller_id,
                p.product_description,p.stock FROM products p,product_category c,seller s,product_domain d
                WHERE (
                p.product_category = c.id 
                and p.seller_id = s.id 
                and INSTR(\"$productSlugs\", slug) > 0
                and p.id != $p->id
                and p.product_domain = d.id  
                and  p.tag = " . ProductTags::$available . ""
                . ") order by s.seller_name asc,p.product_name asc;";

        //echo $queryString;

        $query = $this->db->query($queryString);
        return $query->result();
    }
    
    function getProductsByMappingOld($crop_slug,$screen_name,$state_name,$district_name,$block_name) {

        $queryString = "SELECT p.id,c.id as 'product_category_id',
                p.product_name,p.product_brand,p.product_price,
                p.product_domain as 'domain_id',d.product_category_name as 'domain_name',
                p.slug,c.product_category_name as 'product_category',s.seller_name as 'seller_name',p.seller_id,
                p.product_description,p.stock FROM products p,product_category c,seller s,product_domain d
                WHERE (
                p.product_category = c.id 
                and p.seller_id = s.id 
                and p.product_domain = d.id   
                and INSTR(`crop_association`, '$crop_slug') > 0
                    and INSTR(`screen_association`, '$screen_name') > 0
                        and INSTR(`state_association`, '$state_name') > 0
                            and INSTR(`district_association`, '$district_name') > 0
                and  p.tag = " . ProductTags::$available . ""
                . ") order by s.seller_name asc,p.product_name asc;";

        $query = $this->db->query($queryString);
        return $query->result();
    }
    
        function getProductsByMapping($crop_slug,$screen_name,$state_name,$district_name,$block_name,$version_name) {
          $this->load->model('mapping_model');
        $productMappings = $this->mapping_model->getMapping();
        
        $crop_slug = trim($crop_slug);
        $screen_name = trim($screen_name);
        //p.id in (select product_id from versioning where version='$version_name') and
        
        $versionString = '';
        if($version_name){
            $versionString = "p.id in (select product_id from versioning where version='$version_name') and";
        }
        
        //Gets products of perticular version,crop and screen
        $queryString = "SELECT p.id,c.id as 'product_category_id',
                p.product_name,p.product_brand,p.product_price,
                p.product_domain as 'domain_id',d.product_category_name as 'domain_name',
                p.slug,c.product_category_name as 'product_category',s.seller_name as 'seller_name',p.seller_id,
                p.product_description,p.stock FROM products p,product_category c,seller s,product_domain d
                WHERE (
                $versionString
                p.product_category = c.id 
                and p.seller_id = s.id 
                and p.product_domain = d.id   
                and INSTR(`crop_association`, '$crop_slug') > 0
                    and INSTR(`screen_association`, '$screen_name') > 0
                and  p.tag = " . ProductTags::$available . "" 
                . ") order by s.seller_name asc,p.product_name asc;";
        
        //echo '<br/><hr/>';
        //echo $queryString; 
        
        $query = $this->db->query($queryString);
        $all_products =  $query->result();
        
     //var_dump($q);
     
     //die();
//        echo '<br/><hr/>';
//        var_dump($productMappings);
        
        
        return $this->getPassingProducts($all_products, $productMappings, $state_name, $district_name, $block_name);
        
        
    }
    function getPassingProducts($products,$mapping,$state_name,$district_name,$block_name){
        $passingProducts = array();
        $passedMappings = $this->getMappings($mapping, $state_name, $district_name, $block_name);
        
//        echo '<br/><hr/>';
//        var_dump($passedMappings);
        
        foreach ($products as $p) {
            if($this->isProductThere($passedMappings, $p->id)){
                array_push($passingProducts, $p);
            }
        }
        
//        echo '<br/><hr/>';
//        var_dump($passingProducts);
        
        return $passingProducts;
    }
    function isProductThere($mappings,$product_id){
        $present = false;
        foreach ($mappings as $m) {
            if(strcasecmp($m->product_id, $product_id)==0){
                $present = true;
            }
        }
        return $present;
    }
    function getMappings($mappings,$state_name,$district_name,$block_name){
        $passedMappings = array();
        foreach ($mappings as $m) {
            if(strcasecmp($m->state_name, $state_name)==0
                    && (strcasecmp($m->district_name, $district_name)==0 || strcasecmp($m->district_name, 'ALL')==0)
                    && (strcasecmp($m->block_name, $block_name)==0 || strcasecmp($m->block_name, 'ALL')==0)){
                array_push($passedMappings, $m);
                    }
        }
        return $passedMappings;
    }
    
    function getVersionProducts($version){
        $queryString = "SELECT p.id,c.id as 'product_category_id',
                p.product_name,p.product_brand,p.product_price,
                p.product_domain as 'domain_id',d.product_category_name as 'domain_name',
                p.slug,c.product_category_name as 'product_category',s.seller_name as 'seller_name',p.seller_id,
                p.product_description,p.stock FROM products p,product_category c,seller s,product_domain d
                WHERE (
                p.product_category = c.id 
                and p.seller_id = s.id 
                and p.product_domain = d.id   
                and p.id in (select product_id from versioning where version='$version')
                and  p.tag = " . ProductTags::$available . ""
                . ") order by s.seller_name asc,p.product_name asc;";

        $query = $this->db->query($queryString);
        return $query->result();
    }

}
