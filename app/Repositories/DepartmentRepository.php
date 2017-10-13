<?php
namespace App\Repositories;

use App\Models\Department;
use App\Interfaces\DepartmentInterface;
use Illuminate\Support\Facades\Input;
use Yajra\Datatables\Facades\Datatables;

class DepartmentRepository implements DepartmentInterface
{

    protected $department;

    public function __construct(Department $department)
    {
        $this->department = $department;
    }

    public function getDepartments()
    {
        $departments = $this->department->select();

        $data_tables = Datatables::of($departments);

        $data_tables->filter(function ($query) {
            $term = (Input::get('filter_by') != '') ? Input::get('filter_by') : Input::get('search')['value'];
            if ($term != '') {
                $query->where(function ($query) use ($term) {
                    $query->where('id', 'like', "%{$term}%");
                    $query->orWhere('name', 'like', "%{$term}%");
                });
            }
        });

        $data_tables
            ->editColumn('actions', function ($q) {
                $actions = '<div class="btn-group">';
                $actions .= "<a href='" . route('department.edit', ['id' => $q->id]) . "' class='btn btn-default btn-sm'><i class='fa fa-pencil-square-o'></i></a>";
                $actions .= "<a onClick='return confirm(`Are you sure ?`);' href='" . route('department_delete', ['id' => $q->id]) . "' class='btn btn-default btn-sm'><i class='fa fa-trash-o'></i></a>";
                $actions .= '</div>';
                return $actions;
            });

        return $data_tables;
    }

    public function getAll()
    {
        return $this->department->orderBy('name', 'ASC')->get();
    }

    public function store($data)
    {
        return $this->department->create($data);
    }

    public function getDepartmentById($id)
    {
        return $this->department->findOrFail($id);
    }

    public function update($data, $id)
    {
        return $this->department->where('id', $id)->update($data);
    }

    public function destroy($id)
    {
        return $this->department->findOrFail($id)->delete();
    }

}