<?php

namespace App\Helper;

use Ramsey\Uuid\Uuid;

class CustomController
{

    /**
     * @param string $field
     *
     * @return string
     */
    public function generateImageName($field = '')
    {
        $value = '';
        if (request()->hasFile($field)) {
            $files = request()->file($field);
            $extension = $files->getClientOriginalExtension();
            $name = $this->uuidGenerator();
            $value = $name . '.' . $extension;
        }
        return $value;
    }

    /**
     * @return string
     */
    public function uuidGenerator()
    {
        return Uuid::uuid1()->toString();
    }

    public function saveImage($fileName, $file, $destinationPath, $old = null)
    {
        $file->move($destinationPath, $fileName);
        if ($old) {
            if (file_exists(public_path().$old)) {
                unlink(public_path().$old);
            }
        }
    }

    public function deleteImg($model, $id, $name)
    {
        $class = '\\App\\Models\\'.$model;
        $class::destroy($id);
        if ($name && file_exists(public_path().$name)) {
            unlink(public_path().$name);
        }
    }
}
