<?php
namespace model;


/**
 * Classe métier représentant les fabricants (manufacturers)
 * @author V. Verdon
 * @version 20231115
 */
class Manufacturer implements \JsonSerializable {
    
    private ?int $id;
    private string $name;
    private ?string $shortName;
    

    public function __construct(string $name=null, string $short_name=null, int $id=null) {
        $this->id = $id;
        $this->name = $name;
        $this->shortName = $short_name;
    }
    
    
    /**
     * ToString d'un manufacturer
     * @return string
     */
    public function __toString() {
        return 'name = ' . $this->name . ' ; short name = ' . $this->shortName;
    }
    
    /**
     * Fournit la représentation JSON d'un manufacturer
     * @see 'JsonSerializable::jsonSerialize()
     */
    public function jsonSerialize() {
        $res = array(
            'id' => $this->id,
            'name' => $this->name,
            'short_name' => $this->shortName
        );
        return $res;
    }
    
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $shortName
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;
    }

}

