<?php

namespace Modules\Projects\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProjectTasks
 * @package App\Models\Projects
 * @version August 13, 2018, 4:13 pm UTC
 *
 * @property \Modules\Projects\Models\Project project
 * @property \Illuminate\Database\Eloquent\Collection addressesPerRelation
 * @property \Illuminate\Database\Eloquent\Collection companyStaff
 * @property \Illuminate\Database\Eloquent\Collection customers
 * @property \Illuminate\Database\Eloquent\Collection projectCustomerRoles
 * @property \Illuminate\Database\Eloquent\Collection projectStaff
 * @property \Illuminate\Database\Eloquent\Collection ProjectTaskStaff
 * @property \Illuminate\Database\Eloquent\Collection projectTasksCalendaritems
 * @property \Illuminate\Database\Eloquent\Collection projectsCustomers
 * @property \Illuminate\Database\Eloquent\Collection roleStaff
 * @property integer project_id
 * @property string name
 * @property string start_date
 */
class ProjectTasks extends Model
{
    use SoftDeletes;

    public $table = 'project_tasks';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'project_id',
        'name',
        'start_date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'project_id' => 'integer',
        'name' => 'string',
        'start_date' => 'string'
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
    public function project()
    {
        return $this->belongsTo(\Modules\Projects\Models\Project::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function projectTaskStaff()
    {
        return $this->hasMany(\Modules\Projects\Models\ProjectTaskStaff::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function calendarItems()
    {
        return $this->HasMany(\Modules\Projects\Models\CalendarItem::class, 'project_tasks_calendaritems');
    }
}
