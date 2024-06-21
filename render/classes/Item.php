<?php

class Item
{
    private $item;
    private $blender;
    private $db;
    private $filename;

    public function __construct($id, $db, $filename)
    {
        $database = new Database($db);

        $this->item = $database->getItem($id);
        $this->blender = new Blender();
        $this->db = $db;
        $this->filename = $filename;
        // we need to comment this out because ses is shitty
        // $this->clothingFilenames = explode(',', $clothingFilenames);
    }

    public function render()
    {
        $blender = $this->blender;
        
        $focused = [];

        $avatars = config('AVATARS');
        
        $avatar = $this->item->type == 'gadget' ? $avatars['GADGET'] : ($this->item->type == 'accessory' ? $avatars['TOOL'] : $avatars['DEFAULT']);
        $face = $this->item->type == 'face' ? $this->item->filename : 'default';

        $blender->importBlend($avatar);
        $blender->setTexture('face', 'Head', $face);

        switch ($this->item->type) {
            case 'hat':
                $blender->importModel('hat', $this->item->filename);
                $focused[] = 'hat';
                $blender->removeObjects(['Head', 'Torso', 'LeftArm', 'LeftHand', 'RightArm', 'RightHand', 'LeftLeg', 'RightLeg']);
                break;
            case 'face':
                $blender->removeObjects(['Torso', 'LeftArm', 'LeftHand', 'RightArm', 'RightHand', 'LeftLeg', 'RightLeg']);
                $focused[] = 'Head';
                break;
            case 'accessory':
                $blender->importModel('accessory', $this->item->filename);
                $focused[] = 'accessory';
                $blender->removeObjects(['Head', 'Torso', 'LeftArm', 'LeftHand', 'RightArm', 'RightHand', 'LeftLeg', 'RightLeg']);
                break;
            case 'shirt':
                $blender->setShirt($this->item->filename);
                break;
            case 'pants':
                $blender->setPants($this->item->filename);
                break;
            case 'tshirt':
                $blender->setTshirt($this->item->filename);
                break;
            case 'clothing_bundle':
                $blender->setShirt($this->clothingFilenames[0]);
                $blender->setPants($this->clothingFilenames[1]);
                break;
            case 'crate':
                $blender->importModel('crate', $this->item->filename);
                $focused[] = 'crate';
                break;
            // hurricanes new head render (shit works aha!)
            case 'head':
                $blender->removeObjects(['Head']);
                $blender->importModel('Head', $this->item->filename);
                $this->resizeFace($this->item->face ?? 'default', $this->item->face ?? 'default', 0.5);
                $blender->setTexture('face', 'Head', $this->item->face ?? 'default', 0.5);
                break;                    
            case 'bundle':
                foreach ($this->item->bundle_items as $bundleItem) {
                    $key = $bundleItem['type'] . generate_filename();
                    if (!in_array($bundleItem['type'], ['face'])) {
                        $blender->importModel($key, $bundleItem['filename']);
                    }
                    if ($bundleItem['type'] == 'head') {
                        $blender->setTexture('face', $key, $face);
                    }
                }
                break;
        }

        $blender->colorObjects(color_array('item_body_color'));

        if (!in_array($this->item->type, ['shirt', 'pants', 'bundle', 'hat', 'face', 'head', 'tshirt', 'tool'])) {
            $blender->rotateCamera($this->item->type == 'face');
            $blender->focus($focused);
        }

        $blender->saveThumbnail($this->filename, 'item');
        $blender->execute("item_{$this->item->id}");
    }

    public function updateThumbnail()
    {
        delete_thumbnail($this->item->thumbnail_url);

        $update = $this->db->prepare('UPDATE items SET thumbnail_url = :thumbnail_url WHERE id = :id');
        $update->bindValue(':id', $this->item->id, PDO::PARAM_INT);
        $update->bindValue(':thumbnail_url', $this->filename, PDO::PARAM_STR);
        $update->execute();
    }

    private function resizeFace($filename, $originalFilename)
{
    $directories = [];

    $directories['thumbnails'] = config('DIRECTORIES', 'THUMBNAILS');
    $directories['uploads'] = config('DIRECTORIES', 'UPLOADS');
    $directories['root'] = config('DIRECTORIES', 'ROOT');
    $imageSize = config('IMAGE_SIZES', 'ITEM');

    $filename = "{$directories['thumbnails']}/{$filename}.png";

    if ($originalFilename == 'default') {
        $originalFilename = "{$directories['root']}/img/face.png"; // skiddy aha! jk
    } else {
        $originalFilename = "{$directories['root']}/{$originalFilename}.png";
    }

    $image = imagecreatefrompng($originalFilename);
    $newImage = imagecreatetruecolor($imageSize, $imageSize);

    imagealphablending($newImage, false);
    imagesavealpha($newImage, true);

    $transparency = imagecolorallocatealpha($newImage, 255, 255, 255, 127);

    imagefilledrectangle($newImage, 0, 0, $imageSize, $imageSize, $transparency);
    imagecopyresampled($newImage, $image, 0, 0, 0, 0, $imageSize, $imageSize, imagesx($image), imagesy($image));

    imagepng($newImage, $filename);
    delete_thumbnail($originalFilename);
}
}