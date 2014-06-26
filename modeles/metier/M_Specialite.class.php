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

}
