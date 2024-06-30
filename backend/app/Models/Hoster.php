<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hoster extends Model
{
    use HasFactory;

    private $model;
    private $ram;
    private $hdd;
    private $location;
    private $price;

    public function __construct(string $model,string $ram, string $hdd, string $location, string $price)
    {
        $this->model = $model;
        $this->ram = $ram;
        $this->hdd = $hdd;
        $this->location = $location;
        $this->price = $price;

        $this->setAttribute('model', $model);
        $this->setAttribute('ram_capacity', $this->getRamValue()['capacity']);
        $this->setAttribute('ram_type', $this->getRamValue()['type']);
        $this->setAttribute('hdd_capacity', $this->getHDDValue()['capacity']);
        $this->setAttribute('hdd_type', $this->getHDDValue()['type']);
        $this->setAttribute('hdd_unity', $this->getHDDValue()['unity']);
        $this->setAttribute('price', $this->getPriceValue()['value']);
        $this->setAttribute('location', $location);

    }

    public function getModelAttribute(){
        return $this->model;
    }


    public function getRamValue(): array{
        //the ram attribute is like 16GBDDR3 and I want to get only the 16 value
        //I will use a regular expression to get the first number in the string

        $data = [];

        $exploded = explode('GB', $this->ram);

        if(count($exploded) > 0){
            $data['label'] = $this->ram;
            $data['capacity'] = intval($exploded[0]);
            $data['type'] = $exploded[1];
        }

        return $data;
    }

    public function getHDDValue(): array{
        //the hdd attribute is like 2x2TBSATA2 or 2x500GBSATA2
        //I want to explode it in regular expression for TB or GB 
        //can be sata, sas or ssd
        
        $pattern = '/(\d+)x(\d+)(TB|GB)([a-zA-Z]+)/';

        $data = [];

        if(preg_match($pattern, $this->hdd, $matches)){
            $data['label'] = $matches[0];

            switch ($matches[3]) {
                case 'TB':
                    $data['capacity'] = $matches[1] * $matches[2] * 1024;
                    break;
                case 'GB':
                    $data['capacity'] = $matches[1] * $matches[2];
                    break;
            }

            $data['type'] = $matches[4];
            $data['unity'] = $matches[3];
        }


        return $data;
    }

    public function getPriceValue(): array{
        //price is in the format €1.00
        //I will remove the € sign and convert it to float
        $data = [];
        $data['label'] = $this->price;
        $data['value'] = floatval(str_replace('€', '', $this->price));

        return $data;
    }


    public function toArray()
    {
        return [
            'model' => $this->model,
            'ram' => $this->getRamValue(),
            'storage' => $this->getHDDValue(),
            'location' => $this->location,
            'price' => $this->getPriceValue()
        ];
    }

    function getLocation(): string{
        return $this->location;
    }
}
