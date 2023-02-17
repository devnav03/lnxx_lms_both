<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CmSalariedDetail extends Model {

    protected $fillable = [ 'customer_id', 'company_name', 'date_of_joining', 'monthly_salary', 'last_three_salary_credits', 'last_two_salary_credits', 'accommodation_company', 'last_one_salary_credits', 'last_one_salary_file', 'last_two_salary_file', 'last_three_salary_file', 'other_company', 'created_at', 'updated_at'];

    public function store($inputs, $id = null)  {
        if ($id) {
            return $this->find($id)->update($inputs);
        } else {
            return $this->create($inputs)->id;
        }
    }

}

 