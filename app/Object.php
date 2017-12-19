<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Image;

class Object extends Model
{
    public function getUrl() {
        if ($this->category == 'квартира') {
            return '/prodaja-kvartir-v-ulan-ude/' . $this->str2url($this->sub_locality_name . '-' . $this->address) . '-' . $this->id;
        }

        if ($this->category == 'дом') {
            return '/prodaja-domov-v-ulan-ude/' . $this->str2url($this->sub_locality_name . '-' . $this->address) . '-' . $this->id;
        }

        if ($this->category == 'комната') {
            return '/prodaja-komnat-v-ulan-ude/' . $this->str2url($this->sub_locality_name . '-' . $this->address) . '-' . $this->id;
        }

        if ($this->category == 'участок') {
            return '/prodaja-uchastkov-v-ulan-ude/' . $this->str2url($this->sub_locality_name . '-' . $this->address) . '-' . $this->id;
        }
    }

    private function rus2translit($string) {
        $converter = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'y',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'h',   'ц' => 'c',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
            'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

            'А' => 'A',   'Б' => 'B',   'В' => 'V',
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
            'И' => 'I',   'Й' => 'Y',   'К' => 'K',
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
            'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        );
        return strtr($string, $converter);
    }

    private function str2url($str) {
        // переводим в транслит
        $str = $this->rus2translit($str);
        // в нижний регистр
        $str = strtolower($str);
        // заменям все ненужное нам на "-"
        $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
        // удаляем начальные и конечные '-'
        $str = trim($str, "-");
        return $str;
    }

    public function addImage(UploadedFile $file) {
        $dir = public_path() . '/photo/' . $this->id;
        $filePath = $file->getPath() . '/' . $file->getFilename();
        $size = getimagesize($filePath);
        if (! $size) {
            return false;
        }

        $image = new Image();
        $image->object_id = $this->id;
        $image->name = $file->getClientOriginalExtension();
        $image->save();

        if (!file_exists($dir)) {
            mkdir($dir);
        }

        if ($size[0] < 820) {
            $file->move($dir, $image->id . '.' . $image->name);
            return [
                'id' => $image->id,
                'name' => $this->id . '/' . $image->id . '.' . $image->name
            ];
        }

        $oldimg = false;
        if ($size[2] == IMAGETYPE_PNG) {
            $oldimg = imagecreatefrompng($filePath);
        }
        if ($size[2] == IMAGETYPE_GIF) {
            $oldimg = imagecreatefromgif($filePath);
        }
        if ($size[2] == IMAGETYPE_JPEG) {
            $oldimg = imagecreatefromjpeg($filePath);
        }
        if (!$oldimg) {
            return false;
        }

        $newHeight = round(($size[1] * 800) / $size[0]);
        $newimg = imagecreatetruecolor(800, $newHeight);

        imagecopyresampled($newimg, $oldimg, 0, 0, 0, 0, 800, $newHeight, $size[0], $size[1]);

        $exif = @exif_read_data($filePath);
        if(!empty($exif['Orientation'])) {
            switch($exif['Orientation']) {
                case 8:
                    $newimg = imagerotate($newimg, 90, 0);
                    break;
                case 3:
                    $newimg = imagerotate($newimg, 180, 0);
                    break;
                case 6:
                    $newimg = imagerotate($newimg, -90, 0);
                    break;
            }
        }

        imagejpeg($newimg, $dir . '/' . $image->id . '.jpg');

        $image->name = 'jpg';
        $image->save();

        return [
            'id' => $image->id,
            'name' => $this->id . '/' . $image->id . '.jpg'
        ];
    }

    public function delImage($id) {
        $image = Image::find($id);
        if (!$image) {
            return false;
        }

        $dir = public_path() . '/photo/' . $this->id;
        if(file_exists($dir . '/' . $image->id . '.' . $image->name)) {
            unlink($dir . '/' . $image->id . '.' . $image->name);
        }
        Image::destroy($id);
    }
}
