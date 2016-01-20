<?php 

namespace EscapeWork\Moip\Contracts;

interface AddressContract
{

    public function getStreet();
    public function getNumber();
    public function getComplement();
    public function getDistrict();
    public function getCity();
    public function getState();
    public function getCountry();
    public function getZipcode();
}
