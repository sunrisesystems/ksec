<?php 
namespace cvmapp\Dto;

use Request;


class BaseDTO
{

    public function populate()
    {
        $propertyArr = get_object_vars($this);

        foreach ($propertyArr as $property => $value) {
            if (is_string($property) && Request::get($property)) {
                $this->$property = Request::get($property);
            }
        }
    }

    /**
     * Convert the DTO properties to an Array - key - Value format, if fails then Null is returned
     *
     * @return array|null
     */
    public function populatetoArray()
    {
        $this::populate();
        $propertyArr = get_object_vars($this);
        $data = array();

        foreach ($propertyArr as $property => $value) {
            if (is_string($property) && Request::get($property)) {
//                $this->$property = Request::get($property);
                $data[$property] = $value;
            }
        }

        return empty($data)? null: $data;
    }

    public function populateData($session)
    {
        $propertyArr = get_object_vars($this);

        foreach ($propertyArr as $property => $value) {
            if (is_string($property) && isset($session[$property]) && $session[$property]) {
                $this->$property = $session[$property];
            }
        }
    }

}

?>