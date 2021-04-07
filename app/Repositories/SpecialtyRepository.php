<?php


namespace App\Repositories;


use App\Specialty;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class SpecialtyRepository
{
    /**
     * Returns all of the Specialities Records from database
     *
     * @return Specialty[]|Collection
     */
    public function all()
    {
        return Specialty::all();
    }

    /**
     * Gets Specialty Model record by its Name
     *
     * @param $specialtyName
     * @return bool
     */
    public function getByName(string $specialtyName)
    {
        try {
            return Specialty::where('name', $specialtyName)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }

    /**
     * Gets Specialty Model record by its Id
     *
     * @param $specialtyId
     * @return bool
     */
    public function getById(int $specialtyId)
    {
        try {
            return Specialty::findOrFail($specialtyId);
        } catch (QueryException $e) {
            return false;
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }

    /**
     * Store Specialty records into database
     *
     * @param $data
     * @return bool
     */
    public function store(array $data) : bool
    {
        try {
            Specialty::create($data);
            return true;
        } catch (QueryException $e) {
            return false;
        } catch (ModelNotFoundException $e) {
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Update Specialty Model record
     *
     * @param array $data
     * @return bool
     */
    public function update(array $data) : bool
    {
        try {
            $specialty = Specialty::findOrFail($data['id']);

            $specialty->update([
                'name' => $data['name']
            ]);

            return true;
        } catch (ModelNotFoundException $e) {
            return false;
        } catch (QueryException $e) {
            return false;
        }
    }

    /**
     * Delete Specialty record from database
     *
     * @param int $specialtyId
     * @return bool
     */
    public function destroy(int $specialtyId)
    {
        try {
            Specialty::destroy($specialtyId);
            return true;
        } catch (QueryException $e) {
            return false;
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }

}
