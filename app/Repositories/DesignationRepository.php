<?php
namespace App\Repositories;

use App\Models\Designation;

use App\Interfaces\DesignationInterface;
use Illuminate\Support\Facades\Input;
use Yajra\Datatables\Facades\Datatables;

class DesignationRepository implements DesignationInterface
{

    protected $designation;

    public function __construct(Designation $designation)
    {
        $this->designation = $designation;
    }

    public function getDesignations()
    {
        $designations = $this->designation->select();

        $data_tables = Datatables::of($designations);

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
                $actions .= "<a href='" . route('designation.edit', ['id' => $q->id]) . "' class='btn btn-default btn-sm'><i class='fa fa-pencil-square-o'></i></a>";
                $actions .= "<a onClick='return confirm(`Are you sure ?`);' href='" . route('designation_delete', ['id' => $q->id]) . "' class='btn btn-default btn-sm'><i class='fa fa-trash-o'></i></a>";
                $actions .= '</div>';
                return $actions;
            });

        return $data_tables;
    }

    public function getAll()
    {
        return $this->designation->orderBy('name', 'ASC')->get();
    }

    public function store($data)
    {
        return $this->designation->create($data);
    }

    public function getDesignationById($id)
    {
        return $this->designation->findOrFail($id);
    }

    public function update($data, $id)
    {
        return $this->designation->where('id', $id)->update($data);
    }

    public function destroy($id)
    {
        return $this->designation->findOrFail($id)->delete();
    }

}