<?php
/**
 * User: Gamma-iron
 * Date: 25.03.2019
 */

namespace App\Traits;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media as MediaModel;

trait MediaTrait
{
    use HasMediaTrait;


    public function getPrimaryCollName($collName = null): string
    {
        return is_null($collName) ? 'primary':$collName;
    }

    public function getMediaCollName($collName = null): string
    {
        return is_null($collName) ? 'media':$collName;
    }

    public function getPrimaryUrl($collName = null): ?string
    {
        if($this->hasPrimary($collName))
            return $this->getFirstMedia($this->getPrimaryCollName($collName))->getUrl();

        return null;
    }

    public function getPrimaryAlt($collName = null)
    {
        if($this->hasPrimary($collName))
            return $this->getFirstMedia($this->getPrimaryCollName($collName))->getCustomProperty('alt');

        return null;
    }

    public function getPrimaryTitle($collName = null)
    {
        if($this->hasPrimary($collName))
            return $this->getFirstMedia($this->getPrimaryCollName($collName))->getCustomProperty('title');

        return null;
    }

    public function getPrimary($collName = null)
    {
        if($this->hasPrimary($collName))
            return $this->getFirstMedia($this->getPrimaryCollName($collName));

        return new class {
            public function getUrl($conversion = null)
            {
                return null;
            }
        };
        //throw new \InvalidArgumentException('Photo do not exist!' );
    }

    public function hasPrimary($collName = null): bool
    {
        return $this->hasMedia($this->getPrimaryCollName($collName));
    }

    public function updatePrimary($file, $properties = [], $collName = null){
        if(!is_null($file))
            $this->updateFile($file, $this->getPrimaryCollName($collName), $properties);
    }

    public function deletePrimary($collName = null)
    {
        $this->clearMediaCollection($this->getPrimaryCollName($collName));
    }

    public function getMediaCollection($collName = null): Collection
    {
        return $this->getMedia($this->getMediaCollName($collName));
    }

    public function hasMediaCollection($collName = null): bool
    {
        return $this->hasMedia($this->getMediaCollName($collName));
    }

    public function updateMediaCollection(array $files, $collName = null)
    {
        foreach ($files as $file){
            if(is_array($file) && isset($file['url']) && isset($file['properties']))
                $this->updateFile($file['url'], $this->getMediaCollName($collName), $file['properties']);
            else
                $this->updateFile($file, $this->getMediaCollName($collName));
        }
    }


    public function registerMediaConversions(MediaModel $media = null)
    {
        $this->addMediaConversion('thumb')->width(300)->height(200);

        $this->addMediaConversion('middle')->width(650)->height(350);

        $this->addMediaConversion('sidebar')->width(400)->height(200);
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection($this->getPrimaryCollName())->singleFile();

        $this->addMediaCollection($this->getMediaCollName());
    }

    public function updateFile($file, $collectionName, $properties = [])
    {


        if($file instanceof self){
            $this->addMediaFromUrl( asset($file->getPrimaryUrl()) )->withCustomProperties($properties)->toMediaCollection($collectionName);
        }
        elseif(filter_var($file, FILTER_VALIDATE_URL) !== false){
            $this->addMediaFromUrl( $file )->withCustomProperties($properties)->toMediaCollection($collectionName);
        }
        elseif($file instanceof UploadedFile){
            $this->addMedia( $file )->withCustomProperties($properties)->toMediaCollection($collectionName);
        }
        else{
            throw new \InvalidArgumentException('Do not correct param $file');
        }

    }
}

