<?php

abstract class C_ControleurGenerique {

    protected $vue;

    function setVue($vue) {
        $this->vue = $vue;
    }

}