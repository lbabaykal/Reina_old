<?php

namespace App\Services\Image\Interfaces;

interface ImageInterface
{
    public function setStorage($storage): ImageInterface;
    public function setFormat($format): ImageInterface;
    public function setFileField($field): ImageInterface;
    public function save();
}
