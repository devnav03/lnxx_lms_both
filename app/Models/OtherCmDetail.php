<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class OtherCmDetail extends Model
{
    protected $fillable = [ 'customer_id', 'monthly_pension', 'created_at', 'updated_at' ];

    public function store($inputs, $id = null)  {
        if ($id) {
            return $this->find($id)->update($inputs);
        } else {
            return $this->create($inputs)->id;
        }
    }
}

 