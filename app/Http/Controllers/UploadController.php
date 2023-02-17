<?php

namespace App\Http\Controllers;

//use App\Http\Controllers\Controller;
use App\User;
use App\Models\Lead;
use League\Flysystem\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Response;

class UploadController extends Controller {

public function lead_import(){
   return view('admin.upload.upload');
}


public function lead_upload(Request $request){

    $file = $request->uploaded_file;
    if ($file) {
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath();
        $fileSize = $file->getSize();
        $this->checkUploadedFileProperties($extension, $fileSize);
        $location = 'uploads';
       // $file->move($location, $filename);
        $destinationPath = public_path().'/uploads/' ;
        $file->move($destinationPath, $filename);
        $filepath = public_path($location . "/" . $filename);

        $file = fopen($filepath, "r");
        $importData_arr = array();
        $i = 0;
        while (($filedata = fgetcsv($file, 5000, ",")) !== FALSE) {
            $num = count($filedata);
            if ($i == 0) {
                $i++;
                continue;
            }
            for ($c = 0; $c < $num; $c++) {
                $importData_arr[$i][] = $filedata[$c];
            }
            $i++;
        }
        fclose($file);
            $responce = $this->uploadleads($importData_arr);
    } else {
        throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
        $responce = ['status'=>404,'message' => "No file was uploaded"];
    }
    return response()->json($responce);
}
public function emp_lead_upload(Request $request){
    $file = $request->uploaded_file;
    if ($file) {
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath();
        $fileSize = $file->getSize();
        $this->checkUploadedFileProperties($extension, $fileSize);
        $location = 'uploads';
        $file->move($location, $filename);
        $filepath = public_path($location . "/" . $filename);
        $file = fopen($filepath, "r");
        $importData_arr = array();
        $i = 0;
        while (($filedata = fgetcsv($file, 5000, ",")) !== FALSE) {
            $num = count($filedata);
            if ($i == 0) {
                $i++;
                continue;
            }
            for ($c = 0; $c < $num; $c++) {
                $importData_arr[$i][] = $filedata[$c];
            }
            $i++;
        }
        fclose($file);
            $responce = $this->uploadleads($importData_arr);
    } else {
        throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
        $responce = ['status'=>404,'message' => "No file was uploaded"];
    }
    return response()->json($responce);
}
public function agent_lead_upload(Request $request){

    $file = $request->uploaded_file;
    if ($file) {
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath();
        $fileSize = $file->getSize();
        $this->checkUploadedFileProperties($extension, $fileSize);
        $location = 'uploads';
        $file->move($location, $filename);
        $filepath = public_path($location . "/" . $filename);
        $file = fopen($filepath, "r");
        $importData_arr = array();
        $i = 0;
        while (($filedata = fgetcsv($file, 5000, ",")) !== FALSE) {
            $num = count($filedata);
            if ($i == 0) {
                $i++;
                continue;
            }
            for ($c = 0; $c < $num; $c++) {
                $importData_arr[$i][] = $filedata[$c];
            }
            $i++;
        }
        fclose($file);
            $responce = $this->uploadleads($importData_arr);
    } else {
        throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
        $responce = ['status'=>404,'message' => "No file was uploaded"];
    }
    return response()->json($responce);
}
public function manager_lead_upload(Request $request){

    $file = $request->uploaded_file;
    if ($file) {
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath();
        $fileSize = $file->getSize();
        $this->checkUploadedFileProperties($extension, $fileSize);
        $location = 'uploads';
        $file->move($location, $filename);
        $filepath = public_path($location . "/" . $filename);
        $file = fopen($filepath, "r");
        $importData_arr = array();
        $i = 0;
        while (($filedata = fgetcsv($file, 5000, ",")) !== FALSE) {
            $num = count($filedata);
            if ($i == 0) {
                $i++;
                continue;
            }
            for ($c = 0; $c < $num; $c++) {
                $importData_arr[$i][] = $filedata[$c];
            }
            $i++;
        }
        fclose($file);
            $responce = $this->uploadleads($importData_arr);
    } else {
        throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
        $responce = ['status'=>404,'message' => "No file was uploaded"];
    }
    return response()->json($responce);
}
public function checkUploadedFileProperties($extension, $fileSize){
    $valid_extension = array("csv", "xlsx");
    $maxFileSize = 2097152;
    if (in_array(strtolower($extension), $valid_extension)) {
        if ($fileSize <= $maxFileSize) {
        } else {
            throw new \Exception('No file was uploaded', Response::HTTP_REQUEST_ENTITY_TOO_LARGE);
        }
    } else {
        throw new \Exception('Invalid file extension', Response::HTTP_UNSUPPORTED_MEDIA_TYPE);
    }
}
public function uploadleads($importData_arr){
    $user_type = Auth()->user()->user_type;
    $userId = \Auth::id();
    $j = 0;
    foreach ($importData_arr as $importData) {
        $j++;
        $uploadlead = Lead::where(['email'=>$importData[2], 'number'=>$importData[3]])->first();
        if(!empty($uploadlead)){
            $lead = $uploadlead;
        }else{
            $lead = new Lead;
        }
        if(!empty($importData[0])){
            $lead->saturation = $importData[0];
        }
        if(!empty($importData[1])){
            $lead->name = $importData[1];
        }
        if(!empty($importData[2])){
            $lead->mname = $importData[2];
        }
        if(!empty($importData[3])){
            $lead->lname = $importData[3];
        }
        if(!empty($importData[4])){
            $lead->email = $importData[4];
        }
        if(is_numeric($importData[5])){
            $lead->number = $importData[5];
        }
        if(!empty($importData[6])){
            $lead->product = $importData[6];
        }
        if(!empty($importData[7])){
            $lead->reference = $importData[7];
        }
        if(!empty($importData[8])){
            $lead->source = $importData[8];
        }
        if(!empty($importData[9])){
            $lead->note = $importData[9];
        }
        $lead->uploaded_by = $userId;
        if($user_type == 3 || $user_type == 4){
            $lead->alloted_to = $userId;
        }            
        $lead->save();
    }

    $mg ='<div class="alert alert-success" role="alert">
   '.$j.' Leads successfully uploaded
    </div>';
    return ['status'=>200,'message' => $mg];
} 
public function lead_sample_sheet_download(){
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=lead_sample_file'.'.csv');
        $output = fopen('php://output', 'w');
        fputcsv($output, array('saturation', 'first name', 'middile name', 'last name', 'email', 'number', 'product', 'reference', 'source', 'note'));
        $reports = array(["saturation"=>"Mr.", "name"=>"Demo Singh", "mname"=>"kumar", "lname"=>"Singh", "email"=>"demo@gmail.com" , "number"=>"999999999", "product"=>"Credit Card" , "reference"=>"LNXX1234" , "source"=>"Social Media" , "note"=>"NA"], ["saturation"=>"Miss.", "name"=>"Demo", "mname"=>"kumar", "lname"=>"Sharma", "email"=>"demo2@gmail.com" , "number"=>"9999999999" , "product"=>"Personal Loan" , "reference"=>"LNXX1234" , "source"=>"Social Media" , "note"=>"NA"], ["saturation"=>"Dr.", "name"=>"Demo", "mname"=>"", "lname"=>"Arora", "email"=>"demo2@gmail.com" , "number"=>"999999999" , "product"=>"House Loan" , "reference"=>"LNXX1234" , "source"=>"Social Media" , "note"=>"NA"]);;
        if (count($reports) > 0) {
            foreach ($reports as $report) {
                $report_row = [
                    $report['saturation'],
                    ucfirst($report['name']),
                    ucfirst($report['mname']),
                    ucfirst($report['lname']),
                    $report['email'],
                    $report['number'],
                    $report['product'], 
                    $report['reference'],
                    $report['source'],
                    $report['note'],
                ];

                fputcsv($output, $report_row);
            }
          }    
}     

}