<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');

        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['registration_count'] = $this->Db_model->setTable('registrations')->count();


        $this->load->view('admin/index', $data);
    }

    public function ward()
    {
        $data['wards'] = $this->Db_model->setTable('ward')->get_all([
            'is_delete' => 0,
        ]);
        $this->load->view('admin/ward', $data);
    }

    public function saveWard()
    {
        if ($this->input->post()) {

            $lastWard = $this->Db_model->setTable('ward')
                ->get_row_order(['is_delete' => 0], 'ward_no', 'DESC');

            $nextWardNo = !empty($lastWard) ? $lastWard->ward_no + 1 : 1;

            $ward_name = 'वार्ड नं0 ' . $nextWardNo . ' - ' . $this->input->post('ward_name');

            $data = [
                'ward_name' => $ward_name,
                'ward_no'   => $nextWardNo
            ];

            $insert = $this->Db_model->setTable('ward')->insert($data);

            if ($insert) {
                $this->session->set_flashdata('success', 'वार्ड सफलतापूर्वक जोड़ा गया!');
            } else {
                $this->session->set_flashdata('error', 'वार्ड जोड़ने में समस्या हुई!');
            }
        }

        redirect('Admin/ward');
    }

    public function updateWard()
    {
        if ($this->input->post()) {

            $id = $this->input->post('id');
            $ward_name = $this->input->post('ward_name');

            $update = $this->Db_model->setTable('ward')->update(
                ['id' => $id],
                ['ward_name' => $ward_name]
            );

            if ($update) {
                $this->session->set_flashdata('success', 'वार्ड सफलतापूर्वक सम्पादित किया गया!');
            } else {
                $this->session->set_flashdata('error', 'वार्ड सम्पादित करने में समस्या हुई!');
            }
        }

        redirect('Admin/ward');
    }

    public function deleteWard($id)
    {
        $getWard = $this->Db_model->setTable('ward')->get_row([
            'is_delete' => 0,
            'id' => $id
        ]);

        if (!$getWard) {
            $this->session->set_flashdata('error', 'वार्ड नहीं मिला!');
            redirect('Admin/ward');
        }

        $exist = $this->Db_model->setTable('registrations')->get_all([
            'is_delete' => 0,
            'ward_no' => $getWard->ward_no
        ]);

        if (!empty($exist)) {
            $this->session->set_flashdata(
                'error',
                'इस वार्ड में पंजीकरण मौजूद हैं, इसलिए वार्ड हटाया नहीं जा सकता!'
            );
            redirect('Admin/ward');
        }

        $delete = $this->Db_model->setTable('ward')->update(
            ['id' => $id],
            ['is_delete' => 1]
        );

        if ($delete) {
            $this->session->set_flashdata('success', 'वार्ड सफलतापूर्वक हटाया गया!');
        } else {
            $this->session->set_flashdata('error', 'वार्ड हटाने में समस्या हुई!');
        }

        redirect('Admin/ward');
    }

    public function financialYear()
    {
        $data['years'] = $this->Db_model->setTable('fin_year')->get_all([
            'is_delete' => 0,
        ]);
        $this->load->view('admin/financial_year', $data);
    }

    public function saveFinancialYear()
    {
        if ($this->input->post()) {

            $lastFinYear = $this->Db_model->setTable('fin_year')
                ->get_row_order(['is_delete' => 0], 'fin_year_id', 'DESC');

            $nextFinYearID = !empty($lastFinYear) ? $lastFinYear->fin_year_id + 1 : 1;


            $data = [
                'fin_year' => $this->input->post('fin_year'),
                'fin_year_id'   => $nextFinYearID
            ];

            // echo print_r($data);
            // die;

            $insert = $this->Db_model->setTable('fin_year')->insert($data);

            if ($insert) {
                $this->session->set_flashdata('success', 'वित्तीय वर्ष सफलतापूर्वक जोड़ा गया!');
            } else {
                $this->session->set_flashdata('error', 'वित्तीय वर्ष जोड़ने में समस्या हुई!');
            }
        }

        redirect('Admin/financialYear');
    }

    public function updateFinancialYear()
    {
        if ($this->input->post()) {

            $id = $this->input->post('id');
            $fin_year = $this->input->post('fin_year');

            $update = $this->Db_model->setTable('fin_year')->update(
                ['id' => $id],
                ['fin_year' => $fin_year]
            );

            if ($update) {
                $this->session->set_flashdata('success', 'वित्तीय वर्ष सफलतापूर्वक सम्पादित किया गया!');
            } else {
                $this->session->set_flashdata('error', 'वित्तीय वर्ष सम्पादित करने में समस्या हुई!');
            }
        }

        redirect('Admin/financialYear');
    }

    public function deleteFinancialYear($id)
    {
        $getFinYear = $this->Db_model->setTable('fin_year')->get_row([
            'is_delete' => 0,
            'id' => $id
        ]);

        if (!$getFinYear) {
            $this->session->set_flashdata('error', 'वित्तीय वर्ष नहीं मिला!');
            redirect('Admin/financialYear');
        }

        $exist = $this->Db_model->setTable('registrations')->get_all([
            'is_delete' => 0,
            'fin_year' => $getFinYear->fin_year_id
        ]);

        // Check if registrations exist
        if (!empty($exist)) {
            $this->session->set_flashdata(
                'error',
                'इस वित्तीय वर्ष में पंजीकरण मौजूद हैं, इसलिए वित्तीय वर्ष हटाया नहीं जा सकता!'
            );
            redirect('Admin/financialYear');
        }

        $existindemand = $this->Db_model->setTable('housetax_demand')->get_all([
            'fin_year' => $getFinYear->fin_year
        ]);

        if (!empty($existindemand)) {
            $this->session->set_flashdata(
                'error',
                'इस वित्तीय वर्ष में पंजीकरण मौजूद हैं, इसलिए वित्तीय वर्ष हटाया नहीं जा सकता!'
            );
            redirect('Admin/financialYear');
        }


        $delete = $this->Db_model->setTable('fin_year')->update(
            ['id' => $id],
            ['is_delete' => 1]
        );

        if ($delete) {
            $this->session->set_flashdata('success', 'वित्तीय वर्ष सफलतापूर्वक हटाया गया!');
        } else {
            $this->session->set_flashdata('error', 'वित्तीय वर्ष हटाने में समस्या हुई!');
        }

        redirect('Admin/financialYear');
    }

    public function houseType()
    {
        $data['house_types'] = $this->Db_model->setTable('house_type')->get_all([
            'is_delete' => 0,
        ]);
        $this->load->view('admin/house_type', $data);
    }

    public function saveHouseType()
    {
        if ($this->input->post()) {

            $lastHouseType = $this->Db_model->setTable('house_type')
                ->get_row_order(['is_delete' => 0], 'house_type_id', 'DESC');

            $nextHouseTypeID = !empty($lastHouseType) ? $lastHouseType->house_type_id + 1 : 1;


            $data = [
                'house_type' => $this->input->post('house_type'),
                'house_type_id'   => $nextHouseTypeID
            ];

            // echo print_r($data);
            // die;

            $insert = $this->Db_model->setTable('house_type')->insert($data);

            if ($insert) {
                $this->session->set_flashdata('success', 'भवन प्रकार सफलतापूर्वक जोड़ा गया!');
            } else {
                $this->session->set_flashdata('error', 'भवन प्रकार जोड़ने में समस्या हुई!');
            }
        }

        redirect('Admin/houseType');
    }

    public function updateHouseType()
    {
        if ($this->input->post()) {

            $id = $this->input->post('id');
            $house_type = $this->input->post('house_type');

            $update = $this->Db_model->setTable('house_type')->update(
                ['id' => $id],
                ['house_type' => $house_type]
            );

            if ($update) {
                $this->session->set_flashdata('success', 'भवन प्रकार सफलतापूर्वक सम्पादित किया गया!');
            } else {
                $this->session->set_flashdata('error', 'भवन प्रकार सम्पादित करने में समस्या हुई!');
            }
        }

        redirect('Admin/houseType');
    }

    public function deleteHouseType($id)
    {
        $getHouseType = $this->Db_model->setTable('house_type')->get_row([
            'is_delete' => 0,
            'id' => $id
        ]);

        if (!$getHouseType) {
            $this->session->set_flashdata('error', 'भवन प्रकार नहीं मिला!');
            redirect('Admin/houseType');
        }

        $exist = $this->Db_model->setTable('registrations')->get_all([
            'is_delete' => 0,
            'house_type_id' => $getHouseType->house_type_id
        ]);

        // Check if registrations exist
        if (!empty($exist)) {
            $this->session->set_flashdata(
                'error',
                'इस भवन प्रकार में पंजीकरण मौजूद हैं, इसलिए भवन प्रकार हटाया नहीं जा सकता!'
            );
            redirect('Admin/houseType');
        }

        $delete = $this->Db_model->setTable('house_type')->update(
            ['id' => $id],
            ['is_delete' => 1]
        );

        if ($delete) {
            $this->session->set_flashdata('success', 'भवन प्रकार सफलतापूर्वक हटाया गया!');
        } else {
            $this->session->set_flashdata('error', 'भवन प्रकार हटाने में समस्या हुई!');
        }



        redirect('Admin/houseType');
    }

    public function houseLocation()
    {
        $data['house_locations'] = $this->Db_model->setTable('house_location')->get_all([
            'is_delete' => 0,
        ]);
        $this->load->view('admin/house_location', $data);
    }

    public function saveHouseLocation()
    {
        if ($this->input->post()) {

            $lastHouseLocation = $this->Db_model->setTable('house_location')
                ->get_row_order(['is_delete' => 0], 'id', 'DESC');

            $nextHouseLocationID = !empty($lastHouseLocation) ? $lastHouseLocation->house_location_id + 1 : 1;


            $data = [
                'house_location' => $this->input->post('house_location'),
                'house_location_id'   => $nextHouseLocationID
            ];

            // echo print_r($data);
            // die;

            $insert = $this->Db_model->setTable('house_location')->insert($data);

            if ($insert) {
                $this->session->set_flashdata('success', 'भवन या भूमि अवस्थिति सफलतापूर्वक जोड़ा गया!');
            } else {
                $this->session->set_flashdata('error', 'भवन या भूमि अवस्थिति जोड़ने में समस्या हुई!');
            }
        }

        redirect('Admin/houseLocation');
    }

    public function updateHouseLocation()
    {
        if ($this->input->post()) {

            $id = $this->input->post('id');
            $house_location = $this->input->post('house_location');

            $update = $this->Db_model->setTable('house_location')->update(
                ['id' => $id],
                ['house_location' => $house_location]
            );

            if ($update) {
                $this->session->set_flashdata('success', 'भवन या भूमि अवस्थिति सफलतापूर्वक सम्पादित किया गया!');
            } else {
                $this->session->set_flashdata('error', 'भवन या भूमि अवस्थिति सम्पादित करने में समस्या हुई!');
            }
        }

        redirect('Admin/houseLocation');
    }

    public function deleteHouseLocation($id)
    {
        $getHouseLocation = $this->Db_model->setTable('house_location')->get_row([
            'is_delete' => 0,
            'id' => $id
        ]);

        if (!$getHouseLocation) {
            $this->session->set_flashdata('error', 'भवन या भूमि अवस्थिति नहीं मिला!');
            redirect('Admin/houseLocation');
        }

        $exist = $this->Db_model->setTable('registrations')->get_all([
            'is_delete' => 0,
            'house_location_id' => $getHouseLocation->house_location_id
        ]);

        // Check if registrations exist
        if (!empty($exist)) {
            $this->session->set_flashdata(
                'error',
                'इस भवन या भूमि अवस्थिति में पंजीकरण मौजूद हैं, इसलिए भवन या भूमि अवस्थिति हटाया नहीं जा सकता!'
            );
            redirect('Admin/houseLocation');
        }

        $delete = $this->Db_model->setTable('house_location')->update(
            ['id' => $id],
            ['is_delete' => 1]
        );

        if ($delete) {
            $this->session->set_flashdata('success', 'भवन या भूमि अवस्थिति सफलतापूर्वक हटाया गया!');
        } else {
            $this->session->set_flashdata('error', 'भवन या भूमि अवस्थिति हटाने में समस्या हुई!');
        }



        redirect('Admin/houseLocation');
    }

    public function registration1()
    {
        $data['wards'] = $this->Db_model->setTable('ward')->get_all([
            'is_delete' => 0,
        ]);
        $data['house_locations'] = $this->Db_model->setTable('house_location')->get_all([
            'is_delete' => 0,
        ]);
        $data['house_types'] = $this->Db_model->setTable('house_type')->get_all([
            'is_delete' => 0,
        ]);
        $data['fin_year'] = $this->Db_model->setTable('fin_year')->get_all([
            'is_delete' => 0,
        ]);

        $lasthouse = $this->Db_model->setTable('ward')
            ->get_row_order(['is_delete' => 0], 'id', 'DESC');

        if ($lasthouse) {
            $data['crn'] = $crn + 1;
        } else {
            $data['crn'] = 1;
        }

        $data['houses'] = null;
        $this->load->view('admin/registration', $data);
    }

    public function registration()
    {
        $data['wards'] = $this->Db_model->setTable('ward')->get_all([
            'is_delete' => 0,
        ]);

        $data['house_locations'] = $this->Db_model->setTable('house_location')->get_all([
            'is_delete' => 0,
        ]);

        $data['house_types'] = $this->Db_model->setTable('house_type')->get_all([
            'is_delete' => 0,
        ]);

        $data['fin_year'] = $this->Db_model->setTable('fin_year')->get_all([
            'is_delete' => 0,
        ]);


        $lastHouse = $this->Db_model->setTable('registrations')
            ->get_row_order([], 'crn', 'DESC');

        if ($lastHouse) {
            $data['crn'] = $lastHouse->crn + 1;
        } else {
            $data['crn'] = 1;
        }

        $data['houses'] = null;

        $this->load->view('admin/registration', $data);
    }

    public function generate_unique_id()
    {
        $ward_no = $this->input->post('ward_no');
        $house_type_id = $this->input->post('house_type_id');
        $old_unique_id = $this->input->post('old_unique_id');

        $suffix = 'H';
        if ($house_type_id == 1) $suffix = 'R';
        elseif ($house_type_id == 2) $suffix = 'C';
        elseif ($house_type_id == 3) $suffix = 'M';

        $ward_code = str_pad($ward_no, 2, '0', STR_PAD_LEFT);


        if (!empty($old_unique_id) && strlen($old_unique_id) >= 10) {
            $old_ward = substr($old_unique_id, 8, 2);

            if ($old_ward == $ward_code) {
                echo substr($old_unique_id, 0, -1) . $suffix;
                return;
            }
        }


        $this->db->where("LEFT(unique_id, 10) =", 'NPM01243' . $ward_code);
        $this->db->order_by('unique_id', 'DESC');
        $last = $this->db->get('registrations')->row();

        if ($last) {
            $last_number = intval(substr($last->unique_id, 10, 6));
            $new_number = str_pad($last_number + 1, 6, '0', STR_PAD_LEFT);
        } else {
            $new_number = '000001';
        }

        echo 'NPM01243' . $ward_code . $new_number . $suffix;
    }

    public function saveRegistration()
    {
        if ($this->input->post()) {
            $data = $this->input->post();

            $insert = $this->Db_model->setTable('registrations')->insert($data);

            if ($insert) {
                $this->session->set_flashdata('success', 'भवन  सफलतापूर्वक जोड़ा गया!');
            } else {
                $this->session->set_flashdata('error', 'भवन जोड़ने में समस्या हुई!');
            }
        }
        redirect('Admin/registration');
    }



    public function searchRegistrationByWard()
    {

        $data['wards'] = $this->Db_model->setTable('ward')->get_all([
            'is_delete' => 0,
        ]);

        $this->load->view('admin/search_registration_by_ward', $data);
    }

    public function viewRegistrationByWard()
    {
        if ($this->input->post()) {

            // echo print_r($this->input->post());

            $data['houses'] = $this->Db_model->setTable('registrations')->get_all([
                'is_delete' => 0,
                'ward_no' => $this->input->post('ward_no')
            ]);

            $data['wards'] = $this->Db_model->setTable('ward')->get_row([
                'is_delete' => 0,
                'ward_no' => $this->input->post('ward_no')
            ]);
        }
        $this->load->view('admin/view_registration_by_ward', $data);
    }

    public function editRegistration($id)
    {
        $data['wards'] = $this->Db_model->setTable('ward')->get_all([
            'is_delete' => 0,
        ]);

        $data['house_locations'] = $this->Db_model->setTable('house_location')->get_all([
            'is_delete' => 0,
        ]);

        $data['house_types'] = $this->Db_model->setTable('house_type')->get_all([
            'is_delete' => 0,
        ]);

        $data['fin_year'] = $this->Db_model->setTable('fin_year')->get_all([
            'is_delete' => 0,
        ]);

        $data['houses'] = $this->Db_model
            ->setTable('registrations')
            ->get_row([
                'id' => $id,
                'is_delete' => 0
            ]);

        if (!$data['houses']) {
            $this->session->set_flashdata('error', 'रिकॉर्ड नहीं मिला');
            redirect('Admin/searchRegistrationByWard');
        }

        $this->load->view('admin/registration', $data);
    }

    public function updateRegistration($id)
    {
        $data = $this->input->post();

        $update = $this->Db_model
            ->setTable('registrations')
            ->update(['id' => $id], $data);

        if ($update) {
            $this->session->set_flashdata(
                'success',
                'रिकॉर्ड सफलतापूर्वक अपडेट किया गया'
            );
        } else {
            $this->session->set_flashdata(
                'error',
                'रिकॉर्ड अपडेट नहीं हुआ'
            );
        }

        redirect('Admin/searchRegistrationByWard');
    }

    public function deleteRegistration($id)
    {
        $registration = $this->Db_model
            ->setTable('registrations')
            ->get_row(['id' => $id, 'is_delete' => 0]);

        // echo print_r($registration);
        // die;

        if (!$registration) {
            $this->session->set_flashdata('error', 'भवन रिकॉर्ड नहीं मिला!');
            redirect('Admin/searchRegistrationByWard');
        }


        $demand = $this->Db_model
            ->setTable('housetax_demand')
            ->get_row(['user_id' => $id]);

        // echo print_r($demand);
        // die;

        if ($demand) {
            $this->session->set_flashdata(
                'error',
                'इस भवन का टैक्स डिमांड मौजूद है, इसलिए भवन हटाया नहीं जा सकता!'
            );

            redirect('Admin/searchRegistrationByWard');
        }

        // echo print_r($demand);
        //     die;

        $delete = $this->Db_model
            ->setTable('registrations')
            ->update(
                ['id' => $id],
                ['is_delete' => 1]
            );

        // echo print_r($delete);
        // die;

        if ($delete) {
            $this->session->set_flashdata(
                'success',
                'भवन सफलतापूर्वक हटाया गया!'
            );
        } else {
            $this->session->set_flashdata(
                'error',
                'भवन हटाने में समस्या हुई!'
            );
        }

        redirect('Admin/searchRegistrationByWard');
    }

    public function searchRegistrationByWardFin()
    {

        $data['wards'] = $this->Db_model->setTable('ward')->get_all([
            'is_delete' => 0,
        ]);

        $data['fin_years'] = $this->Db_model->setTable('fin_year')->get_all([
            'is_delete' => 0,
        ]);

        $this->load->view('admin/search_registration_by_ward_fin', $data);
    }

    public function showDemand()
    {

        if ($this->input->post()) {
            // echo print_r($this->input->post());
            // die;

            $data['from_date'] = $this->input->post('from_date');
            $data['to_date'] = $this->input->post('to_date');
            $data['fin_year_id'] = $this->input->post('fin_year_id');
            $data['ward_no'] = $this->input->post('ward_no');

            // echo print_r($data);
            // die;

            $data['houses'] = $this->Db_model->setTable('registrations')->get_all([
                'is_delete' => 0,
                'fin_year' => $this->input->post('fin_year_id'),
                'ward_no' => $this->input->post('ward_no')
            ]);

            // echo print_r($data);
            // die;

            $demand_count = $this->Db_model->setTable('housetax_demand')->count();


            $data['next_bill_no'] = $demand_count + 1;

            // echo print_r($data);
            // die;
        }

        $this->load->view('admin/demand_by_ward', $data);
    }

    public function saveDemand()
    {
        if ($this->input->post()) {

            $from = $this->input->post('from_date');
            $to = $this->input->post('to_date');
            $billno = $this->input->post('bill_no');

            // die;

            $houses = $this->Db_model->setTable('registrations')->get_all([
                'is_delete' => 0,
                'fin_year' => $this->input->post('fin_year_id'),
                'ward_no' => $this->input->post('ward_no')
            ]);

            $fyj = $this->Db_model->setTable('fin_year')->get_row([
                'is_delete' => 0,
                'fin_year_id' => $this->input->post('fin_year_id'),
            ]);

            if (!$fyj) {
                $this->session->set_flashdata('error', 'Financial year not found');
                redirect('Admin/searchRegistrationByWardFin');
            }

            $fy = $fyj->fin_year;





            list($start, $end) = explode('-', $fy);
            $new_fy = ((int)$start + 1) . '-' . ((int)$end + 1);

            $exists_new_fy = $this->db->where([
                'fin_year' => $new_fy,
                'is_delete' => 0
            ])->get('fin_year')->row();

            if (!$exists_new_fy) {
                $this->session->set_flashdata('error', 'पहले अगला वित्तीय वर्ष जोड़े!');
                redirect('Admin/searchRegistrationByWardFin');
            }

            $this->db->trans_start();

            $bill_date = date('Y-m-d');

            $lastDemand = $this->Db_model->setTable('housetax_demand')
                ->get_row_order([], 'crn', 'DESC');

            $crn = ($lastDemand) ? $lastDemand->crn + 1 : 1;

            foreach ($houses as $h) {

                $total_tax =
                    $h->arv +
                    $h->opening_arrear +
                    $h->open_land +
                    $h->opening_arrear_open_land +
                    $h->arv_water +
                    $h->opening_arrear_water ;
                    

                $data = [
                    'user_id' => $h->id,
                    'crn' => $crn,
                    'unique_id' => $h->unique_id,
                    'ward_no' => $h->ward_no,
                    'fin_year' => $fy,
                    'from_date' => $from,
                    'to_date' => $to,
                    'bill_date' => $bill_date,
                    'billno' => $billno,

                    'arv' => $h->arv,
                    'opening_arrear' => $h->opening_arrear,
                    'open_land' => $h->open_land,
                    'opening_arrear_open_land' => $h->opening_arrear_open_land,
                    'arv_water' => $h->arv_water,
                    'opening_arrear_water' => $h->opening_arrear_water,

                    'total_tax' => $total_tax,

                    'curr_arrear' => $h->arv + $h->opening_arrear,
                    'curr_advance' => 0,
                    'curr_arrear_open_land' => $h->open_land + $h->opening_arrear_open_land ,
                    'curr_advance_open_land' => 0,
                    'curr_arrear_water' => $h->arv_water + $h->opening_arrear_water,
                    'curr_advance_water' => 0,
                    'status' => 0,
                    'method' => 0
                ];


                $this->Db_model->setTable('registrations')->update(
                    ['id' => $h->id],
                    [
                        'fin_year' => $exists_new_fy->fin_year_id,
                        'opening_arrear' => $h->arv + $h->opening_arrear,
                        'opening_arrear_open_land' => $h->open_land + $h->opening_arrear_open_land,
                        'opening_arrear_water' => $h->arv_water + $h->opening_arrear_water,
                    ]
                );

                $this->Db_model->setTable('housetax_demand')->insert($data);

                $billno++;
                $crn++;
            }

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('error', 'डिमांड जनरेट करने में त्रुटि हुई।');
            } else {
                $this->session->set_flashdata('success', 'डिमांड सफलतापूर्वक जनरेट हुई।');
            }

            redirect('Admin/searchRegistrationByWardFin');
        } else {
            $this->session->set_flashdata('error', 'Invalid request');
            redirect('Admin/searchRegistrationByWardFin');
        }
    }

    public function saveDemand1()
    {
        if ($this->input->post()) {

            $from = $this->input->post('from_date');
            $to = $this->input->post('to_date');
            echo $billno = $this->input->post('bill_no');

            // die;

            $houses = $this->Db_model->setTable('registrations')->get_all([
                'is_delete' => 0,
                'fin_year' => $this->input->post('fin_year_id'),
                'ward_no' => $this->input->post('ward_no')
            ]);

            $fyj = $this->Db_model->setTable('fin_year')->get_row([
                'is_delete' => 0,
                'fin_year_id' => $this->input->post('fin_year_id'),
            ]);

            if (!$fyj) {
                $this->session->set_flashdata('error', 'Financial year not found');
                redirect('Admin/searchRegistrationByWardFin');
            }

            $fy = $fyj->fin_year;

            list($start, $end) = explode('-', $fy);
            $new_fy = ((int)$start + 1) . '-' . ((int)$end + 1);

            $exists_new_fy = $this->db->where([
                'fin_year' => $new_fy,
                'is_delete' => 0
            ])->get('fin_year')->row();

            if (!$exists_new_fy) {
                $this->session->set_flashdata('error', 'पहले अगला वित्तीय वर्ष जोड़े!');
                redirect('Admin/searchRegistrationByWardFin');
            }

            $this->db->trans_start();

            $bill_date = date('Y-m-d');

            foreach ($houses as $h) {

                $total_tax =
                    $h->arv +
                    $h->opening_arrear +
                    $h->open_land +
                    $h->opening_arrear_open_land +
                    $h->arv_water +
                    $h->opening_arrear_water;

                $data = [
                    'user_id' => $h->id,
                    'crn' => $h->id,
                    'unique_id' => $h->unique_id,
                    'ward_no' => $h->ward_no,
                    'fin_year' => $fy,
                    'from_date' => $from,
                    'to_date' => $to,
                    'bill_date' => $bill_date,
                    'billno' => $billno,

                    'arv' => $h->arv,
                    'opening_arrear' => $h->opening_arrear,
                    'open_land' => $h->open_land,
                    'opening_arrear_open_land' => $h->opening_arrear_open_land,
                    'arv_water' => $h->arv_water,
                    'opening_arrear_water' => $h->opening_arrear_water,

                    'total_tax' => $total_tax,

                    'curr_arrear' => $h->arv + $h->opening_arrear,
                    'curr_advance' => 0,
                    'curr_arrear_open_land' => $h->open_land + $h->opening_arrear_open_land,
                    'curr_advance_open_land' => 0,
                    'curr_arrear_water' => $h->arv_water + $h->opening_arrear_water,
                    'curr_advance_water' => 0,

                    'status' => 0,
                    'method' => 0
                ];


                $this->Db_model->setTable('registrations')->update(
                    ['id' => $h->id],
                    [
                        'fin_year' => $exists_new_fy->fin_year_id,
                        'opening_arrear' => $h->arv + $h->opening_arrear,
                        'opening_arrear_open_land' => $h->open_land + $h->opening_arrear_open_land,
                        'opening_arrear_water' => $h->arv_water + $h->opening_arrear_water,
                    ]
                );

                $this->Db_model->setTable('housetax_demand')->insert($data);

                $billno++;
            }

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('error', 'डिमांड जनरेट करने में त्रुटि हुई।');
            } else {
                $this->session->set_flashdata('success', 'डिमांड सफलतापूर्वक जनरेट हुई।');
            }

            redirect('Admin/searchRegistrationByWardFin');
        } else {
            $this->session->set_flashdata('error', 'Invalid request');
            redirect('Admin/searchRegistrationByWardFin');
        }
    }

    public function searchGeneratedDemand()
    {
        $data['wards'] = $this->Db_model->setTable('ward')->get_all([
            'is_delete' => 0,
        ]);

        $data['fin_years'] = $this->Db_model->setTable('fin_year')->get_all([
            'is_delete' => 0,
        ]);

        $this->load->view('admin/search_demand_by_ward_fin', $data);
    }

    public function showGeneratedDemand()
    {
        if ($this->input->post()) {

            $data['demands'] = $this->Db_model->setTable('housetax_demand')->get_all([
                'ward_no' => $this->input->post('ward_no'),
                'fin_year' => $this->input->post('fin_year'),
            ]);

            $houses = $this->Db_model->setTable('registrations')->get_all([
                'is_delete' => 0,
                'ward_no' => $this->input->post('ward_no')
            ]);

            $data['wards'] = $this->Db_model
                ->setTable('ward')
                ->get_row(['ward_no' => $this->input->post('ward_no'), 'is_delete' => 0]);

            $data['house_detail'] = [];

            foreach ($houses as $h) {
                $data['house_detail'][$h->id] = $h;
            }


            $this->load->view('admin/generated_demand_by_ward_fin', $data);
        }
    }

    public function printBill($id)
    {
        $data['demand'] = $this->Db_model->setTable('housetax_demand')->get_row([
            'id' => $id
        ]);

        $data['house'] = $this->Db_model->setTable('registrations')->get_row([
            'id' => $data['demand']->user_id,
            'is_delete' => 0
        ]);

        $data['wards'] = $this->Db_model->setTable('ward')->get_row([
            'ward_no' => $data['demand']->ward_no,
            'is_delete' => 0
        ]);

        $this->load->view('admin/printbill', $data);
    }

    public function searchByWardFinPayTax()
    {
        $data['wards'] = $this->Db_model->setTable('ward')->get_all([
            'is_delete' => 0,
        ]);

        $data['fin_years'] = $this->Db_model->setTable('fin_year')->get_all([
            'is_delete' => 0,
        ]);

        $this->load->view('admin/search_paytax_ward_fin', $data);
    }

    public function demandListFinPayTax()
    {
        if ($this->input->post()) {

            $data['demands'] = $this->Db_model->setTable('housetax_demand')->get_all([
                'ward_no' => $this->input->post('ward_no'),
                'fin_year' => $this->input->post('fin_year'),
                'status' => 0,
            ]);

            $houses = $this->Db_model->setTable('registrations')->get_all([
                'is_delete' => 0,
                'ward_no' => $this->input->post('ward_no')
            ]);

            $data['house_detail'] = [];

            foreach ($houses as $h) {
                $data['house_detail'][$h->id] = $h;
            }


            $this->load->view('admin/demand_list_paytax', $data);
        }
    }

    public function payTax($id)
    {
        $data['demand'] = $this->Db_model->setTable('housetax_demand')->get_row([
            'id' => $id,
            'status' => 0,
        ]);

        $data['house'] = $this->Db_model->setTable('registrations')->get_row([
            'id' => $data['demand']->user_id,
            'is_delete' => 0
        ]);

        $this->load->view('admin/paytax_form', $data);
    }


    public function savePaymentOffline()
    {
        if ($this->input->post()) {

            $demand = $this->Db_model->setTable('housetax_demand')->get_row([
                'id' => $this->input->post('user_id'),
                'status' => 0,
            ]);

            if (!$demand) {
                $this->session->set_flashdata('error', 'मांग नही प्राप्त हुई!');
                redirect('Admin/searchByWardFinPayTax');
            }


            $houseTax = (float) $this->input->post('house_tax');
            $openLand = (float) $this->input->post('open_land');
            $waterTax = (float) $this->input->post('water_tax');


            $paidHouse = (float) $this->input->post('paid_amount');
            $paidOpenLand = (float) $this->input->post('open_land_paid');
            $paidWater = (float) $this->input->post('water_tax_paid');


            $arrearHouse = $houseTax - $paidHouse;
            $arrearOpenLand = $openLand - $paidOpenLand;
            $arrearWater = $waterTax - $paidWater;


            $arrearHouse = max(0, $arrearHouse);
            $arrearOpenLand = max(0, $arrearOpenLand);
            $arrearWater = max(0, $arrearWater);

            $sum_arrear = $arrearHouse + $arrearOpenLand + $arrearWater;

            if ($sum_arrear > 0) {
                $this->Db_model->setTable('housetax_demand')->update(
                    ['id' => $this->input->post('user_id')],
                    [
                        'status' => 0,
                        'curr_arrear' => $arrearHouse,
                        'curr_arrear_open_land' => $arrearOpenLand,
                        'curr_arrear_water' => $arrearWater,
                        'method' => 1
                    ]
                );

                $this->Db_model->setTable('registrations')->update(
                    ['id' => $demand->user_id],
                    [
                        'opening_arrear' => $arrearHouse,
                        'opening_arrear_open_land' => $arrearOpenLand,
                        'opening_arrear_water' => $arrearWater
                    ]
                );
            } else {
                $this->Db_model->setTable('housetax_demand')->update(
                    ['id' => $this->input->post('user_id')],
                    [
                        'status' => 1,
                        'curr_arrear' => 0,
                        'curr_arrear_open_land' => 0,
                        'curr_arrear_water' => 0,
                        'method' => 1
                    ]
                );

                $this->Db_model->setTable('registrations')->update(
                    ['id' => $demand->user_id],
                    [
                        'opening_arrear' => 0,
                        'opening_arrear_open_land' => 0,
                        'opening_arrear_water' => 0
                    ]
                );
            }


            $data = [
                'user_id' => $this->input->post('user_id'),

                'house_tax' => $houseTax,
                'paid_amount' => $paidHouse,
                'arrear' => $arrearHouse,

                'open_land' => $openLand,
                'open_land_paid' => $paidOpenLand,
                'open_land_arrear' => $arrearOpenLand,

                'water_tax' => $waterTax,
                'water_tax_paid' => $paidWater,
                'water_tax_arrear' => $arrearWater,

                'payment_id' => 'PAY' . time(),
                'payment_date' => $this->input->post('payment_date'),
                'billno' => $this->input->post('billno'),
            ];

            $insert = $this->Db_model->setTable('housetax_payment')->insert($data);

            if ($insert) {
                $this->session->set_flashdata('success', 'भुगतान सफलतापूर्वक दर्ज किया गया!');
            } else {
                $this->session->set_flashdata('error', 'भुगतान दर्ज करने में समस्या हुई!');
            }
        }

        redirect('Admin/searchByWardFinPayTax');
    }
    public function savePaymentOffline1()
    {
        if ($this->input->post()) {

            $demand = $this->Db_model->setTable('housetax_demand')->get_row([
                'id' => $this->input->post('user_id'),
                'status' => 0,
            ]);

            if (!$demand) {
                $this->session->set_flashdata('error', 'मांग नही प्राप्त हुई!');
                redirect('Admin/searchByWardFinPayTax');
            }


            $houseTax = (float) $this->input->post('house_tax');
            $openLand = (float) $this->input->post('open_land');
            $waterTax = (float) $this->input->post('water_tax');


            $paidHouse = (float) $this->input->post('paid_amount');
            $paidOpenLand = (float) $this->input->post('open_land_paid');
            $paidWater = (float) $this->input->post('water_tax_paid');


            $arrearHouse = $houseTax - $paidHouse;
            $arrearOpenLand = $openLand - $paidOpenLand;
            $arrearWater = $waterTax - $paidWater;


            $arrearHouse = max(0, $arrearHouse);
            $arrearOpenLand = max(0, $arrearOpenLand);
            $arrearWater = max(0, $arrearWater);


            $this->Db_model->setTable('registrations')->update(
                ['id' => $demand->user_id],
                [
                    'opening_arrear' => $arrearHouse,
                    'opening_arrear_open_land' => $arrearOpenLand,
                    'opening_arrear_water' => $arrearWater,
                ]
            );


            $this->Db_model->setTable('housetax_demand')->update(
                ['id' => $this->input->post('user_id')],
                [
                    'status' => 1,
                    'method' => 1,
                ]
            );


            $data = [
                'user_id' => $this->input->post('user_id'),

                'house_tax' => $houseTax,
                'paid_amount' => $paidHouse,
                'arrear' => $arrearHouse,

                'open_land' => $openLand,
                'open_land_paid' => $paidOpenLand,
                'open_land_arrear' => $arrearOpenLand,

                'water_tax' => $waterTax,
                'water_tax_paid' => $paidWater,
                'water_tax_arrear' => $arrearWater,

                'payment_id' => 'PAY' . time(),
                'payment_date' => $this->input->post('payment_date'),
                'billno' => $this->input->post('billno'),
            ];

            $insert = $this->Db_model->setTable('housetax_payment')->insert($data);

            if ($insert) {
                $this->session->set_flashdata('success', 'भुगतान सफलतापूर्वक दर्ज किया गया!');
            } else {
                $this->session->set_flashdata('error', 'भुगतान दर्ज करने में समस्या हुई!');
            }
        }

        redirect('Admin/searchByWardFinPayTax');
    }

    public function searchReceipt()
    {
        $data['wards'] = $this->Db_model->setTable('ward')->get_all([
            'is_delete' => 0,
        ]);

        $data['fin_years'] = $this->Db_model->setTable('fin_year')->get_all([
            'is_delete' => 0,
        ]);

        $this->load->view('admin/search_receipt', $data);
    }

    public function receiptTable()
    {
        $ward_no = $this->input->post('ward_no');
        $fin_year = $this->input->post('fin_year');

        $this->db->select('
            housetax_payment.*,
            housetax_demand.ward_no,
            housetax_demand.fin_year,
            registrations.name,
            registrations.father_name,
            registrations.house_number,
            registrations.unique_id,
            registrations.address,
            ward.ward_name
        ');

        $this->db->from('housetax_payment');

        $this->db->join(
            'housetax_demand',
            'housetax_demand.id = housetax_payment.user_id',
            'inner'
        );

        $this->db->join(
            'registrations',
            'registrations.id = housetax_demand.user_id',
            'inner'
        );
        $this->db->join(
            'ward',
            'ward.ward_no = housetax_demand.ward_no',
            'left'
        );

        if (!empty($ward_no)) {
            $this->db->where('housetax_demand.ward_no', $ward_no);
        }

        if (!empty($fin_year)) {
            $this->db->where('housetax_demand.fin_year', $fin_year);
        }

        $data['payments'] = $this->db->get()->result();

        $this->load->view('admin/receipt_table', $data);
    }

    public function taxReceipt($payment_id)
    {
        $data['payment'] = $this->Db_model->setTable('housetax_payment')->get_row([
            'id' => $payment_id
        ]);

        $data['demand'] = $this->Db_model->setTable('housetax_demand')->get_row([
            'id' => $data['payment']->user_id
        ]);

        $data['house'] = $this->Db_model->setTable('registrations')->get_row([
            'id' => $data['demand']->user_id
        ]);

        $data['wards'] = $this->Db_model->setTable('ward')->get_row([
            'ward_no' => $data['demand']->ward_no
        ]);

        // // Debug
        // echo '<pre>';
        // print_r($data);
        // die;

        $this->load->view('admin/receipt', $data);
    }

    public function searchBigDueForm()
    {
        $data['wards'] = $this->Db_model->setTable('ward')->get_all([
            'is_delete' => 0,
        ]);

        $this->load->view('admin/search_big_due_ward', $data);
    }

    public function showBigDueWard()
    {
        if ($this->input->post()) {

            $data['demands'] = $this->Db_model
                ->setTable('housetax_demand')
                ->get_all_tax_greater(
                    $this->input->post('ward_no'),
                    $this->input->post('min_amount')
                );

            $houses = $this->Db_model->setTable('registrations')->get_all([
                'is_delete' => 0,
                'ward_no' => $this->input->post('ward_no')
            ]);

            $data['house_detail'] = [];

            foreach ($houses as $h) {
                $data['house_detail'][$h->id] = $h;
            }

            $data['wards'] = $getWard = $this->Db_model->setTable('ward')->get_row([
                'is_delete' => 0,
                'ward_no' => $this->input->post('ward_no')
            ]);

            // echo print_r($data);
            // die;

            $this->load->view('admin/big_due_ward', $data);
        } else {
            $this->session->set_flashdata('error', 'समस्या हुई!');
            redirect('Admin/searchBigDueForm');
        }
    }

    public function searchReportByWard()
    {
        $data['wards'] = $this->Db_model->setTable('ward')->get_all([
            'is_delete' => 0,
        ]);

        $data['fin_years'] = $this->Db_model->setTable('fin_year')->get_all([
            'is_delete' => 0,
        ]);

        $this->load->view('admin/search_report_ward', $data);
    }

    public function reportByWard()
    {
        if ($this->input->post()) {
            $ward_no = $this->input->post('ward_no');
            $fin_year = $this->input->post('fin_year');

            $this->db->select('
            housetax_payment.*,
            housetax_demand.ward_no,
            housetax_demand.fin_year,
            registrations.name,
            registrations.father_name,
            registrations.house_number,
            registrations.unique_id,
            registrations.address,
            ward.ward_name
        ');

            $this->db->from('housetax_payment');

            $this->db->join(
                'housetax_demand',
                'housetax_demand.id = housetax_payment.user_id',
                'inner'
            );

            $this->db->join(
                'registrations',
                'registrations.id = housetax_demand.user_id',
                'inner'
            );

            $this->db->join(
                'ward',
                'ward.ward_no = housetax_demand.ward_no',
                'left'
            );

            if (!empty($ward_no)) {
                $this->db->where('housetax_demand.ward_no', $ward_no);
            }

            if (!empty($fin_year)) {
                $this->db->where('housetax_demand.fin_year', $fin_year);
            }

            $data['payments'] = $this->db->get()->result();

            $this->load->view('admin/report_by_ward', $data);
        } else {
            $this->session->set_flashdata('error', 'समस्या हुई!');
            redirect('Admin/searchReportByWard');
        }
    }

    public function searchReportByFinYear()
    {

        $data['fin_years'] = $this->Db_model->setTable('fin_year')->get_all([
            'is_delete' => 0,
        ]);

        $this->load->view('admin/search_report_fin', $data);
    }

    public function reportByFin()
    {
        if ($this->input->post()) {

            $fin_year = $this->input->post('fin_year');

            $this->db->select('
                housetax_payment.*,
                housetax_demand.ward_no,
                housetax_demand.fin_year,
                registrations.name,
                registrations.father_name,
                registrations.house_number,
                registrations.unique_id,
                registrations.address,
                ward.ward_name
            ');

            $this->db->from('housetax_payment');

            $this->db->join(
                'housetax_demand',
                'housetax_demand.id = housetax_payment.user_id',
                'inner'
            );

            $this->db->join(
                'registrations',
                'registrations.id = housetax_demand.user_id',
                'inner'
            );

            $this->db->join(
                'ward',
                'ward.ward_no = housetax_demand.ward_no',
                'left'
            );

            if (!empty($fin_year)) {
                $this->db->where('housetax_demand.fin_year', $fin_year);
            }

            $data['payments'] = $this->db->get()->result();



            $this->load->view('admin/report_by_fin', $data);
        } else {
            $this->session->set_flashdata('error', 'समस्या हुई!');
            redirect('Admin/searchReportByFinYear');
        }
    }

    public function searchReportByDate()
    {
        $this->load->view('admin/search_report_date');
    }

    public function reportByDate()
    {
        if ($this->input->post()) {

            $from_date = $this->input->post('from_date');
            $to_date   = $this->input->post('to_date');

            $this->db->select('
            housetax_payment.*,
            housetax_demand.ward_no,
            housetax_demand.fin_year,
            registrations.name,
            registrations.father_name,
            registrations.house_number,
            registrations.unique_id,
            registrations.address,
            ward.ward_name
        ');

            $this->db->from('housetax_payment');

            $this->db->join(
                'housetax_demand',
                'housetax_demand.id = housetax_payment.user_id',
                'inner'
            );

            $this->db->join(
                'registrations',
                'registrations.id = housetax_demand.user_id',
                'inner'
            );

            $this->db->join(
                'ward',
                'ward.ward_no = housetax_demand.ward_no',
                'left'
            );


            if (!empty($from_date)) {
                $this->db->where('housetax_payment.payment_date >=', $from_date);
            }

            if (!empty($to_date)) {
                $this->db->where('housetax_payment.payment_date <=', $to_date);
            }

            $data['payments'] = $this->db->get()->result();

            $this->load->view('admin/report_by_date', $data);
        } else {
            $this->session->set_flashdata('error', 'समस्या हुई!');
            redirect('Admin/searchReportByDate');
        }
    }
}
