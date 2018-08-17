<?php

namespace Modules\Projects\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Project
 * @package App\Models\Projects
 * @version August 13, 2018, 4:13 pm UTC
 *
 * @property \Modules\Projects\Models\Company company
 * @property \Illuminate\Database\Eloquent\Collection addressesPerRelation
 * @property \Illuminate\Database\Eloquent\Collection companyStaff
 * @property \Illuminate\Database\Eloquent\Collection customers
 * @property \Illuminate\Database\Eloquent\Collection ProjectCustomerRole
 * @property \Illuminate\Database\Eloquent\Collection projectStaff
 * @property \Illuminate\Database\Eloquent\Collection projectTaskStaff
 * @property \Illuminate\Database\Eloquent\Collection ProjectTask
 * @property \Illuminate\Database\Eloquent\Collection projectTasksCalendaritems
 * @property \Illuminate\Database\Eloquent\Collection projectsCustomers
 * @property \Illuminate\Database\Eloquent\Collection roleStaff
 * @property integer company_id
 * @property string name
 * @property string slug
 * @property date start_date
 * @property date due_date
 */
class Project extends Model
{
    use SoftDeletes;

    public $table = 'projects';


    public $timestamps = false;
    public $softdeletes = false;


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'slug',
        'start_date',
        'due_date'
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
        'start_date' => 'date',
        'due_date' => 'date'
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
    public function company()
    {
        return $this->belongsTo(\Modules\Projects\Models\Company::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function projectCustomerRoles()
    {
        return $this->hasMany(\Modules\Projects\Models\ProjectCustomerRole::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function employees()
    {
        return $this->belongsToMany(\Modules\Projects\Models\Employee::class, 'project_staff');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function projectTasks()
    {
        return $this->hasMany(\Modules\Projects\Models\ProjectTask::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function customers()
    {
        return $this->belongsToMany(\Modules\Projects\Models\Customer::class, 'projects_customers');
    }
}
