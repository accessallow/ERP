<?php

class Web extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('product_model');
//        $this->load->model('inquiry_model');
        $this->load->model('seller_model');
    }

    public function index_json() {
        $this->load->model("product_model");
        if ($this->input->get('product_category_id')) {
            $category_id = $this->input->get('product_category_id');
            $products = $this->product_model->get_all_entries_joined($category_id);
        } else {
            $products = $this->product_model->get_all_entries_joined(null);
        }

        $products = $this->attachImageDataToProducts($products);

        $this->output->set_content_type('application/json')
                ->set_output(json_encode($products));
    }

    public function product($product_id) {
        //It will show product page with corresponding side-products
        $p = $this->product_model->get_one_product_joined($product_id);
        $p = $this->attachImageDataToProducts($p);

        $sideProducts = $this->product_model->getSideProductsOfaProduct($product_id);
        $sideProducts = $this->attachImageDataToProducts($sideProducts);
        $sellers = $this->seller_model->get_all_entries($product_id);

        $mappedSellersOfThisArea = $this->sellersOfThisArea($sellers, array(
            'state_name' => $this->input->get('state_name'),
            'district_name' => $this->input->get('district_name'),
            'block_name' => $this->input->get('block_name')
        ));



        $p = $p[0];

        $data = array(
            'sellers' => $mappedSellersOfThisArea,
            'product' => $p,
            'side_products' => $sideProducts,
            'geolocation' => array(
                'state_name' => $this->input->get('state_name'),
                'district_name' => $this->input->get('district_name'),
                'block_name' => $this->input->get('block_name')
            )
        );

        $this->load->view('web/header');
        $this->load->view('web/middle', $data);
        $this->load->view('web/footer');
    }

    public function sellersOfThisArea($sellers, $location) {
//        var_dump($sellers);
//        var_dump($location);
//        die();
        //$state_name,$district_name,$block_name
        $this->load->model('coverage_model');
        $coverageMapping = $this->coverage_model->getMapping();
//        var_dump($coverageMapping);

        $mappingOfThisArea = $this->mappingOfThisArea($coverageMapping, $location);
//        var_dump($mappingOfThisArea);

        $mappedSellers = array();
        foreach ($sellers as $s) {
            if ($this->isSellerInMapping($s, $mappingOfThisArea)) {
                array_push($mappedSellers, $s);
            }
        }
//        var_dump($mappedSellers);
//        die();

        return $mappedSellers;
    }

    public function isSellerInMapping($sellerObj, $mappingOfArea) {
        $present = false;
        foreach ($mappingOfArea as $m) {
            if (strcasecmp($m->seller_id, '' . $sellerObj->id) == 0) {
                $present = true;
            }
        }
        return $present;
    }

    public function mappingOfThisArea($allMapping, $location) {
        $mappingOfThisArea = array();
        foreach ($allMapping as $m) {
            if (strcasecmp($m->state_name, $location['state_name']) == 0 &&
                    strcasecmp($m->district_name, $location['district_name']) == 0 &&
                    strcasecmp($m->block_name, $location['block_name']) == 0) {
                array_push($mappingOfThisArea, $m);
            }
        }
        return $mappingOfThisArea;
    }

    public function inquiry($product_id, $seller_id) {
        if ($this->input->post('product_id')) {
            $productId = $this->input->post('product_id');
            $customerName = $this->input->post('customer_name');
            $customerContact = $this->input->post('customer_contact');
            $customerAddress = $this->input->post('customer_address');
            $seller_id = $this->input->post('seller_id');
            $seller_name = $this->input->post('seller_name');
            $quoted_price = $this->input->post('quoted_price');

            $state_name = $this->input->post('state_name');
            $district_name = $this->input->post('district_name');
            $block_name = $this->input->post('block_name');

            $this->load->model('inquiry_model');
            $this->inquiry_model->registerInquiry(array(
                'product_id' => $productId,
                'customer_name' => $customerName,
                'customer_contact' => $customerContact,
                'customer_address' => $customerAddress,
                'seller_id' => $seller_id,
                'seller_name' => $seller_name,
                'quoted_price' => $quoted_price,
                'state_name'=>$state_name,
                'district_name'=>$district_name,
                'block_name'=>$block_name
            ));

            redirect('Web/success/' . $productId."?state_name=$state_name&district_name=$district_name&block_name=$block_name");
        } else {
            //This will showw inquiry form
            $p = $this->product_model->get_one_product_joined($product_id);

            $this->load->model('product_seller_mapping_model');
            $product_price = $this->product_seller_mapping_model->give_me_price($product_id, $seller_id);
            $seller_name = $this->seller_model->get_seller_name($seller_id);

            $geolocation = array(
                'state_name' => $this->input->get('state_name'),
                'district_name' => $this->input->get('district_name'),
                'block_name' => $this->input->get('block_name')
            );

            $data = array(
                'product' => $p[0],
                'seller_id' => $seller_id,
                'quoted_price' => $product_price[0]->product_price,
                'seller_name' => $seller_name,
                'geolocation' => $geolocation
            );

            $this->load->view('web/header');
            $this->load->view('web/inquiry', $data);
            $this->load->view('web/footer');
        }
    }

    public function success($product_id) {
        $data = array(
            'product_id' => $product_id,
            'geolocation' => array(
                'state_name' => $this->input->get('state_name'),
                'district_name' => $this->input->get('district_name'),
                'block_name' => $this->input->get('block_name')
            )
        );

        $this->load->view('web/header');
        $this->load->view('web/success', $data);
        $this->load->view('web/footer');
    }

    public function getSideProducts($productId) {
        $sideProducts = $this->product_model->getSideProductsOfaProduct($productId);

        $sideProducts = $this->attachImageDataToProducts($sideProducts);

        $this->output->set_content_type('application/json')
                ->set_output(json_encode($sideProducts));
    }

    public function getCropProducts($cropSlug) {
        $cropProducts = $this->product_model->getProductsOfaCrop($cropSlug);

        $cropProducts = $this->attachImageDataToProducts($cropProducts);

        $this->output->set_content_type('application/json')
                ->set_output(json_encode($cropProducts));
    }

    private function attachImageDataToProducts($productsArray) {
        $this->load->model('upload_model');
        foreach ($productsArray as $p) {
            $r = $this->upload_model->get_all_uploads(
                    array(
                        'attachment_id' => $p->id,
                        'attachment_type' => 1
                    )
            );
            foreach ($r as $oneUpload) {
                $oneUpload->file_name = base_url() . 'assets/uploads/' . $oneUpload->file_name;
            }

            $p->uploads = $r;

            if (sizeof($r) < 2) {
                $no_banner = new stdClass();

                $no_product = new stdClass();

                $no_banner->id = "1";
                $no_banner->attachment_id = "";
                $no_banner->attachment_type = "";
                $no_banner->file_name = base_url() . 'assets/uploads/no_banner_image.png';
                $no_banner->description = "";
                $no_banner->tag = "";

                $no_product->id = "2";
                $no_product->attachment_id = "";
                $no_product->attachment_type = "";
                $no_product->file_name = base_url() . 'assets/uploads/no_banner_image.png';
                $no_product->description = "";
                $no_product->tag = "";



                $r = array($no_banner, $no_product);

                $p->uploads = $r;
            }
        }
        return $productsArray;
    }

    public function getAllProducts() {
        //Warning : this function expects named $GET patemeters
        if ($this->input->get('crop_slug') && $this->input->get('screen_name') && $this->input->get('state_name') && $this->input->get('district_name') && $this->input->get('block_name')) {

            $crop_slug = $this->input->get('crop_slug');
            $screen_name = $this->input->get('screen_name');
            $state_name = $this->input->get('state_name');
            $district_name = $this->input->get('district_name');
            $block_name = $this->input->get('block_name');
            $version = $this->input->get('version');


            $cropProducts = $this->product_model->getProductsByMapping($crop_slug, $screen_name, $state_name, $district_name, $block_name,$version);

            $cropProducts = $this->attachImageDataToProducts($cropProducts);

            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($cropProducts));
        } else {
            echo "insufficient input";
        }
    }

}
