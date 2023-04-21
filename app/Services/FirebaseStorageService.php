<?php

namespace App\Services;

use App\Common\Constants;
use Kreait\Firebase\Factory;

/**
 * Firebase configuration steps:
 * - Require firebase library: composer require kreait/laravel-firebase
 * - Download service accounts private key:
 *   ... > Project settings > Service accounts > Pick Node js > Generate new private key => json file
 * - Put json file above to the \storage\app\public\credentials\ folder
 * - Put FIREBASE_CREDENTIALS = \storage\app\public\credentials\<json-file-name>.json to .env file
 */
class FirebaseStorageService
{
    private static $firebaseStorage;
    private static $firebaseBucket;

    private function __construct()
    {
        static::$firebaseStorage = (new Factory)->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
            ->createStorage();
        static::$firebaseBucket = static::$firebaseStorage->getBucket();
    }

    public static function getStorageBucket() {
        if (is_null(static::$firebaseBucket)) {
            new FirebaseStorageService();
        }
        return static::$firebaseBucket;
    }

    public static function getImageUrl($imagePath)
    {
        $expiresAt = new \DateTime('tomorrow');
        $imageReference = static::getStorageBucket()->object(Constants::FIREBASE_STORAGE_IMAGES_PATH . $imagePath);
        if (!$imageReference->exists()) {
            return null;
        }
        return $imageReference->signedUrl($expiresAt);
    }
}
