<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
use App\Http\Requests;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Models\FeeShipping;

session_start();
class DeliveryController extends Controller
{

    public function AuthLogin(){
        $admin_id = session::get('admin_id');
        if($admin_id){
            return redirect::to('dashboard');
        }else{
            return redirect::to('admin')->send();
        }
    }


    // get province
    public function delivery(Request $request){
        $this->AuthLogin();
        $province = Province::orderby('province_id', 'ASC')->get();
        return view('admin.delivery.manage_delivery')->with(compact('province'));
    }

    // choose province, district, ward
    public function select_delivery(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action'] == 'province'){
                $select_district = District::where('province_id', $data['province_id'])->orderby('district_id', 'ASC')->get();
                $output .= '<option value="0">---- Chọn quận huyện -----</option>';
                foreach($select_district as $district){
                    $output .= '<option value="'. $district->district_id .'">'. $district->district_name .'</option>';
                }
            }else{
                $select_ward = Ward::where('district_id', $data['province_id'])->orderby('ward_id', 'ASC')->get();
                $output .= '<option value="0">---- Chọn xã phường -----</option>';
                foreach($select_ward as $ward){
                    $output .= '<option value="'. $ward->ward_id .'">'. $ward->ward_name .'</option>';
                }
            }
        }
        echo $output;
    }

    // insert delivery
    public function insert_delivery(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $feeshipping = new FeeShipping();
        $feeshipping->province_id = $data['province'];
        $feeshipping->district_id = $data['district'];
        $feeshipping->ward_id = $data['ward'];
        $feeshipping->fee_shipping = $data['fee_shipping'];
        $feeshipping->save();
    }

    // fetch fee shipping
    public function fetch_fee_shipping(){
        $this->AuthLogin();

        $fee_shipping = FeeShipping::orderby('feeshipping_id', 'DESC')->get();
        $output = '';
        $output .=
            '<div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tên tỉnh thành phố</th>
                            <th>Tên quận huyện</th>
                            <th>Tên xã phường</th>
                            <th>Phí vận chuyển</th>
                        </tr>
                    </thead>
                    <tbody>';
                        foreach ($fee_shipping as $key => $fee){
                        $output .= '<tr>
                                <td>'. $fee->provinces->province_name .'</td>
                                <td>'. $fee->districts->district_name .'</td>
                                <td>'. $fee->wards->ward_name .'</td>
                                <td contenteditable data-fee_shipping_id="'. $fee->feeshipping_id .'" class="fee_shipping_edit">'
                                    .number_format($fee->fee_shipping, 0,',','.') .' đ</td>
                            </tr>';
                        }
                    $output .= '</tbody>
                </table>
            </div>';
        echo $output;
    }

    // update fee shipping
    public function update_fee_shipping(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $feeshipping = FeeShipping::find($data['fee_shipping_id']);
        // $fee_shipping = rtrim($data['fee_shipping']);
        $feeshipping->fee_shipping = $data['fee_shipping'];
        $feeshipping->save();
    }
}
