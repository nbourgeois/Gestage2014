<?php

/**
 * Description of M_Specialite
 *
 * @author btssio
 */
class M_Specialite{
    
	private $id; // type : int
	private $libellecCourt; // type : string
	private $libelleLong; 
        
        function __construct($id, $libellecCourt, $libelleLong) {
            $this->id = $id;
            $this->libellecCourt = $libellecCourt;
            $this->libelleLong = $libelleLong;
        }

        public function getId() {
            return $this->id;
        }

        public function getLibellecCourt() {
            return $this->libellecCourt;
        }

        public function getLibelleLong() {
            return $this->libelleLong;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setLibellecCourt($libellecCourt) {
            $this->libellecCourt = $libellecCourt;
        }

        public function setLibelleLong($libelleLong) {
            $this->libelleLong = $libelleLong;
        }

        
        
}
