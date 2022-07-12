<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Pumps;

class PumpsController extends Controller
{
    public function index(Request $request) {
        if($request->ajax()){
            $filterPumpsData = json_decode($request->filterData, true);
            $getFilterPumps = DB::table('pumps');
            if(count($filterPumpsData['size']) > 0) {
                $getFilterPumps = $getFilterPumps->whereIn('size', $filterPumpsData['size']);
            }
            if(count($filterPumpsData['body']) > 0) {
                $getFilterPumps = $getFilterPumps->whereIn('body', $filterPumpsData['body']);
            }
            if(count($filterPumpsData['elastomer']) > 0) {
                $getFilterPumps = $getFilterPumps->whereIn('elastomer', $filterPumpsData['elastomer']);
            }
            $getFilterPumps = $getFilterPumps->get();
            echo json_encode($getFilterPumps);exit();
        } else {
            $size_data = [];
            $pumps_data = Pumps::all();
            foreach($pumps_data as $key => $value) {
                array_push($size_data, $value->size);
            }
            $size_data = array_unique($size_data);
        }
        return view('pumps', compact('pumps_data', 'size_data'));
    }

    public function getPumpsBySize(Request $request) {
        $size = json_decode($request->size, true);
        $body = [];
        $elastomer = [];
        $getPumpData = Pumps::whereIn('size', $size)->get();
        foreach ($getPumpData as $key => $value) {
            if(!empty($value->body)) {
                array_push($body, $value->body);
            }
            
            if(!empty($value->elastomer)) {
                array_push($elastomer, $value->elastomer);
            }
        }
        echo json_encode(array('body' => $body, 'elastomer'=> $elastomer));exit;
    }

    public function importData() {
        $fileD = fopen(public_path().'/assets/pumps-data.csv', 'r');
        $column=fgetcsv($fileD);
        while(!feof($fileD)){
            $rowData[] = fgetcsv($fileD);
        }
        foreach ($rowData as $key => $data) {
            if (is_array($data)) {
                $pump_data = array(
                                    "brand" => $data[0],
                                    "size"  => $data[1],
                                    "body"  => $data[2],
                                    "elastomer" => $data[3],
                                    "atex" => $data[4],
                                    "end_connections" => $data[5],
                                    "joints" => $data[6]
                                );
                DB::table('pumps')->insert($pump_data);
            }
            echo PHP_EOL;
        } 
        echo 'Pumps data imported successfully';
    }
}
