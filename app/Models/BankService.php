<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BankService extends Model {
	
    protected $fillable = [ 'bank_id', 'service_id', 'created_by', 'created_at', 'updated_at' ];

    public function store($inputs, $id = null)  {
        if ($id){
            return $this->find($id)->update($inputs);
        } else {
            return $this->create($inputs)->id;
        }
    }


}

 