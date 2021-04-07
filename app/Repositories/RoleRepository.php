<?php


namespace App\Repositories;

use App\Role;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class RoleRepository
{
    /**
     * Return All Role Data
     *
     * @return Role[]|Collection
     */
    public function all()
    {
        return Role::all();
    }

    /**
     * Get Role Model record by it Name
     *
     * @param $roleName
     * @return bool
     */
    public function getByName($roleName)
    {
        try {
            return Role::where('name', $roleName)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }

    /**
     * Get Role Model record by its Id
     *
     * @param $id
     * @return bool
     */
    public function getById($id)
    {
        try {
            return Role::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }

    /**
     * Store Role record into Database
     *
     * @param array $data
     * @return bool
     */
    public function store(array $data)
    {
        try {
            Role::create([
                'name' => $data['name']
            ]);

            return true;
        } catch (QueryException $e) {
            return false;
        }
    }

    /**
     * Update Role Record from database
     *
     * @param array $data
     * @return bool
     */
    public function update(array $data)
    {
        try {
            $role = $this->getById($data['id']);

            $role->update([
                'name' => request()->$data['name'],
                'updated_at' => Carbon::now()->timestamp
            ]);

            return true;
        } catch (QueryException $e) {
            return false;
        }
    }

    /**
     * Delete Role record from database
     *
     * @param $id
     * @return bool
     */
    public function destroy($id)
    {
        try{
            Role::destroy($id);
            return true;
        } catch (ModelNotFoundException $e) {
            return false;
        } catch (QueryException $e) {
            return false;
        }
    }
}
