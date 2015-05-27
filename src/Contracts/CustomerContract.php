<?php namespace EscapeWork\Moip\Contracts;

interface CustomerContract
{

    public function getCode();
    public function getEmail();
    public function getFullname();
    public function getCpf();
    public function getPhoneNumber();
    public function getPhoneAreaCode();
    public function getBirthdateDay();
    public function getBirthdateMonth();
    public function getBirthdateYear();
}
