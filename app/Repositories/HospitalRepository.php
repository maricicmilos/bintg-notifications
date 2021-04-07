<?php


namespace App\Repositories;


use App\Helpers\Image;
use App\Hospital;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use App\Repositories\UserRepository;

class HospitalRepository
{
    const MODEL_NAME = 'hospital';
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
       $this->userRepository = $userRepository; 
    }

    /**
     * Gets all of the Hospital database records
     *
     * @return Hospital[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Hospital::all();
    }

    /**
     * Gets Hospital by Serial Number value or return false if such record doesnt exists
     *
     * @param $serialNumber
     * @return bool
     */
    public function getBySerialNum($serialNumber)
    {
        try {
            return Hospital::where('serial_number', $serialNumber)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }

    /**
     * Get Hospital by Id
     *
     * @param $id
     * @return bool
     */
    public function getById($id)
    {
        try{
            return Hospital::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }
    /**
     * Get Hospital by User Id 
     *
     * @param $id
     * @return bool
     */
    public function getByUserId($userId)
    {
        try {
            $user = $this->userRepository->getById($userId);
            return $user->hospitals->first;
        } catch(ModelNotFoundException $e) {
            return false;
        };
    }

    /**
     * Store Hospital records coming from the Create Form
     *
     * @param array
     * @return bool
     */
    public function store(array $data) : bool
    {
        try {
            $uploadedImage = $data['image'];
            $storeImageName = Image::uploadImageAndGetStoredName($uploadedImage, self::MODEL_NAME);

            Hospital::create([
                'name' => $data['name'],
                'serial_number' => $data['serial_number'],
                'image_path' => $storeImageName
            ]);

            return true;
        } catch (QueryException $e) {
            return false;
        }
    }

    /**
     * Update Hospital record selected by Id coming from post request
     *
     * @param array
     * @return bool
     */
    public function update(array $data) : bool
    {
        try {
            $hospital = $this->getById($data['id']);
            $storedImageName = $hospital->image_path;
            $storedImageName = substr($storedImageName, strlen(Image::HOSPITAL_MODEL_PATH));

            if (request()->file('image')) {
                unlink(Image::getAbsoluteHospitalsPath() . $storedImageName);
                $storedImageName = Image::uploadImageAndGetStoredName($data['image'], self::MODEL_NAME);
            }

            $hospital->update([
                'name' => $data['name'],
                'serial_number' => $data['serial_number'],
                'image_path' => $storedImageName,
                'updated_at' => Carbon::now()->timestamp
            ]);

            return true;

        } catch (ModelNotFoundException $e) {
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Delete Hospital Record by Id coming from post request
     *
     * @param $id
     * @return bool
     */
    public function destroy($id) : bool
    {
        try{
            $hospital = $this->getById($id);
            $imagePath = $hospital->image_path;
            unlink(Image::getAbsoluteHospitalsPath() . substr($imagePath, strlen(Image::HOSPITAL_MODEL_PATH)));
            Hospital::destroy($id);

            return true;
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }
}
