<?php

namespace App\Service;

use App\Entity\ProfileDog;
use App\Kernel;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class DogService.
 */
class DogService
{
    /**
     * @var Filesystem $fileSystem
     */
    private $fileSystem;

    /**
     * DogService constructor.
     *
     * @param Filesystem $fileSystem
     */
    public function __construct(Filesystem $fileSystem)
    {
        $this->fileSystem = $fileSystem;
    }

    /**
     * @param array $data
     *
     * @return ProfileDog
     */
    public function createDog(array $data, ProfileDog $dog): ProfileDog
    {
        return $dog
            ->setAge($data['age'] ?? null)
            ->setName($data['name'] ?? null)
            ->setBreed($data['breed'] ?? null)
            ->setCode($data['code'] ?? null)
            ->setHeight($data['height'] ?? null)
            ->setLength($data['length'] ?? null)
            ->setWeight($data['weight'] ?? null)
        ;
    }

    /**
     * @param File $file
     *
     * @return string
     * 
     * @throws \Symfony\Component\Filesystem\Exception\IOException
     */
    public function processFile(File $file): string
    {
        $fileName = md5(uniqid('.', true)) . '.' . $file->guessExtension();
        $path = $this->getPicturesDir() . $fileName;

        if (!is_dir($this->getPicturesDir())) {
            mkdir($this->getPicturesDir(), 0700);
        }

        $this->fileSystem->dumpFile($path, file_get_contents($file));

        return 'pictures/' . $fileName;
    }

    /**
     * @return string
     */
    private function getPicturesDir(): string
    {
        return Kernel::ROOT_DIR . 'public/pictures/';
    }

}
