<?php

namespace Modules\Projects\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProjectRole extends Model
{
    use SoftDeletes;

    public $table = 'project_roles';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'slug',
        'project_id',
        'staff_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'slug' => 'string',
        'project_id' => 'integer',
        'staff_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function projectStaff()
    {
        return $this->HasMany(\Modules\Projects\Models\ProjectStaff::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function projectRelations()
    {
        return $this->hasMany(\Modules\Projects\Models\ProjectRelation::class);
    }
}
