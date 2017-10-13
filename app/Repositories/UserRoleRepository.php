<?php
namespace App\Repositories;
use App\Models\UserRole;

/**
 * Class UserRoleRepositoty
 *
 * @package App\Repositories
 */
class UserRoleRepository
{
    /**
     * @var
     */
    protected $model;

    /**
     *
     */
    public function __construct()
    {
        $this->model = new UserRole();
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->orderBy('role_name', 'ASC')->get();
    }
}

?>