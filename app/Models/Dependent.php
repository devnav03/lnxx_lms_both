<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Dependent extends Model {

    protected $fillable = [ 'user_id', 'name', 'relation', 'created_at', 'updated_at'];

    public function store($inputs, $id = null)  {
        if ($id) {
            return $this->find($id)->update($inputs);
        } else {
            return $this->create($inputs)->id;
        }
    }

}

 