<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class UserEducation extends Model
{
    protected $fillable = [ 'user_id', 'education', 'primary_school', 'high_school', 'graduate',
 'postgraduate', 'others', 'created_at', 'updated_at' ];


    public function store($inputs, $id = null)  {
        if ($id) {
            return $this->find($id)->update($inputs);
        } else {
            return $this->create($inputs)->id;
        }
    }


}

 