<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use function PHPUnit\Framework\assertGreaterThanOrEqual;

class Image
{
    const HOSPITAL_MODEL_PATH = "\images\hospitals\\";

    /**
     * Get absolute path for storing uploaded Hospital Images
     *
     * @return string
     */
    public static function getAbsoluteHospitalsPath()
    {
        return public_path() . self::HOSPITAL_MODEL_PATH;
    }

    /**
     * Upload image and return Stored Image Name Record
     *
     * @param $uploadedImage
     * @param $modelName
     * @return string
     */
    public static function uploadImageAndGetStoredName($uploadedImage, $modelName)
    {
        $uploadedImageType = $uploadedImage->getClientOriginalExtension();
        $storeImageName = Carbon::now()->timestamp . '_' . rand() . '.' . $uploadedImageType;
        $uploadedImage->move(self::resolveStorageByModel($modelName), $storeImageName);
        return $storeImageName;
    }

    /**
     * Get Model Storage Location
     *
     * @param $modelName
     * @return string
     */
    private static function resolveStorageByModel($modelName)
    {
        switch ($modelName) {
            case 'hospital' :
                return self::getAbsoluteHospitalsPath();
                break;
            default :
                throw new ModelNotFoundException(Message::GENERAL_ERROR);
        }
    }
}
