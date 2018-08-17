<?php

namespace Modules\Projects\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProjectRelation
 * @package App\Models\Projects
 * @version August 13, 2018, 4:13 pm UTC
 *
 * @property \Modules\Projects\Models\ProjectRelationType projectRelationType
 * @property \Modules\Projects\Models\Relation relation
 * @property \Modules\Projects\Models\ProjectRole projectRole
 * @property \Illuminate\Database\Eloquent\Collection addressesPerRelation
 * @property \Illuminate\Database\Eloquent\Collection companyStaff
 * @property \Illuminate\Database\Eloquent\Collection customers
 * @property \Illuminate\Database\Eloquent\Collection projectCustomerRoles
 * @property \Illuminate\Database\Eloquent\Collection projectStaff
 * @property \Illuminate\Database\Eloquent\Collection projectTaskStaff
 * @property \Illuminate\Database\Eloquent\Collection projectTasksCalendaritems
 * @property \Illuminate\Database\Eloquent\Collection projectsCustomers
 * @property \Illuminate\Database\Eloquent\Collection roleStaff
 * @property integer relation_id
 * @property integer project_role_id
 * @property integer project_relation_type
 */
class ProjectRelation extends Model
{
    use SoftDeletes;

    public $table = 'project_relations';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'relation_id',
        'project_role_id',
        'project_relation_type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'project_id' => 'integer',
        'relation_id' => 'integer',
        'project_role_id' => 'integer',
        'project_relation_type' => 'integer'
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
    public function projectRelationType()
    {
        return $this->HasMany(\Modules\Projects\Models\ProjectRelationType::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function relation()
    {
        return $this->belongsTo(\Modules\Projects\Models\Relation::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function projectRole()
    {
        return $this->HasMany(\Modules\Projects\Models\ProjectRole::class);
    }
}
