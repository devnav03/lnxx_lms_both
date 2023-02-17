<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class SelfEmpDetail extends Model {

    protected $fillable = [ 'customer_id', 'self_company_name', 'percentage_ownership', 'profession_business', 
    'annual_business_income', 'self_other_company', 'created_at', 'updated_at' ];
    

    public function store($inputs, $id = null)  {
        if ($id) {
            return $this->find($id)->update($inputs);
        } else {
            return $this->create($inputs)->id;
        }
    }


}

 