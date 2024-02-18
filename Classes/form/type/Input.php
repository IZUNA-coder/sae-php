<?php 

namespace form\type;

use form\InputRender;

abstract class Input implements InputRender{

    protected string $type;
    protected string $label = "";

    protected string $value;
    protected string $name;
    protected string $id;
    protected ?string $function = null;
    protected string $RadioValue = "";
    protected ?string $event = null;

    public function __construct(
        string $value,
        protected bool $required,
        string $name,
        string $id,
        string $function =null,
        string $RadioValue = "",
        string $event = null,
    ){
        // peut poser problème si on a un espace
        
        $this->value = $value;
        $this->name = str_replace(" ", "", $name);
        $this->id = str_replace(" ", "", $id);
        $this->function = $function;
        $this->RadioValue = $RadioValue;
        $this->event = $event;
    }

    public function __toString() {
        return $this->render();
    }

    public function setLabel(string $label){
        $this->label = "<label for=".$this->id.">".$label."</label>";
        return $this;
    }

    private function getFonctionString(): string {
        return $this->function === null ? '' : $this->event . '="' . $this->function . '"';
    }

    public function render(): string{
        $required = $this->required ? 'required="true"' : '';
        $value = $this->value === "" ? '' : 'value="'.$this->value.'"';
        $function = $this->getFonctionString();

        $label = $this->label !== "" ? $this->label : '';
        
        if($this->type === "radio"){
            $input = '<input type="'.$this->type.'" '.$required.' '.$value.' id="'.$this->id.'" name="'.$this->name.'" '.$function.'>';
            return $label . $input . $this->RadioValue;
        }
        
        $input = '<input type="'.$this->type.'" '.$required.' '.$value.' id="'.$this->id.'" name="'.$this->name.'" '.$function.'>';
        return $label . $input;
    }
    
}