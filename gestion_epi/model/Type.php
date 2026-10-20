<?php
namespace model;


/**
 * Classe métier représentant les types de matériel (type)
 * Exemples : mousqueton, corde, casque...
 * @version 20261016
 */
class Type implements \JsonSerializable {
    
    private ?int $id;
    private ?string $name;
    
    
    public function __construct(?string $name=null, ?int $id=null) {
        $this->id = $id;
        $this->name = $name;
    }
    
    
    /**
     * ToString d'un type
     * @return string
     */
    public function __toString() {
        return 'name = ' . $this->name;
    }
    
    /**
     * Fournit la représentation JSON d'un type
     * @see 'JsonSerializable::jsonSerialize()
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize() {
        $res = array(
            'id' => $this->id,
            'name' => $this->name
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
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    
}
