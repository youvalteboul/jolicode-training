<?php
/**
 * Created by PhpStorm.
 * User: youval
 * Date: 22/06/2016
 * Time: 16:44
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Address
{
    /**
     * @Column(type="string", name="street")
     */
    protected $street;

    /**
     * @Column(type="string", name="city")
     */
    protected $city;

    /**
     * @Column(type="string", name="postaleCode")
     */
    protected $postalCode;

    /**
     * @Column(type="string", name="country")
     */
    protected $country;


    public function __construct($street, $city, $postalCode, $country)
    {
        $this->street = $street;
        $this->city = $city;
        $this->postalCode = $postalCode;
        $this->country = $country;
    }
}