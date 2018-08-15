<?php

namespace Modules\Core\Repositories;

use Modules\Core\Models\Role;


/**
 * Class RoleRepository
 * @package App\Repositories\Core
 * @version August 13, 2018, 4:14 pm UTC
 *
 * @method Role findWithoutFail($id, $columns = ['*'])
 * @method Role find($id, $columns = ['*'])
 * @method Role first($columns = ['*'])
*/
class RolesRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'slug',
        'permissions_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Role::class;
    }
}
