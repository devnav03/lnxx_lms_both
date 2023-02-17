<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ServiceApply extends Model {
	
    protected $fillable = [ 'customer_id', 'service_id', 'app_status', 'app_no', 'bank_id', 'decide_by', 'status', 'created_at', 'updated_at' ];

    public function store($inputs, $id = null)  {
        if ($id) {
            return $this->find($id)->update($inputs);
        } else {
            return $this->create($inputs)->id;
        }
    }


}

 