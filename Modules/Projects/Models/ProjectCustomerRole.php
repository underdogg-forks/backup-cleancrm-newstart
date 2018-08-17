<?php

namespace Modules\Projects\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProjectCustomerRole
 * @package App\Models\Projects
 * @version August 13, 2018, 4:13 pm UTC
 *
 * @property \Modules\Projects\Models\Customer customer
 * @property \Modules\Projects\Models\Project project
 * @property \Illuminate\Database\Eloquent\Collection addressesPerRelation
 * @property \Illuminate\Database\Eloquent\Collection companyStaff
 * @property \Illuminate\Database\Eloquent\Collection customers
 * @property \Illuminate\Database\Eloquent\Collection projectStaff
 * @property \Illuminate\Database\Eloquent\Collection projectTaskStaff
 * @property \Illuminate\Database\Eloquent\Collection projectTasksCalendaritems
 * @property \Illuminate\Database\Eloquent\Collection projectsCustomers
 * @property \Illuminate\Database\Eloquent\Collection roleStaff
 * @property integer customer_id
 * @property integer projects_id
 * @property integer project_role_id
 * @property string name
 * @property string slug
 */
class ProjectCustomerRole extends Model
{
    use SoftDeletes;

    public $table = 'project_customer_roles';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'customer_id',
        'projects_id',
        'project_role_id',
        'name',
        'slug'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'customer_id' => 'integer',
        'projects_id' => 'integer',
        'project_role_id' => 'integer',
        'name' => 'string',
        'slug' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function customer()
    {
        return $this->belongsTo(\Modules\Projects\Models\Customer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function project()
    {
        return $this->belongsTo(\Modules\Projects\Models\Project::class);
    }
}
