<?php 

namespace form\type;

use form\InputRender;

abstract class Input implements InputRender{

    protected string $type;
    private string $label = "";

    protected string $value;
    protected string $name;
    protected string $id;
    private ?string $function = null;

    public function __construct(
        string $value,
        protected bool $required,
        string $name,
        string $id,
        string $function =null,
    ){
        // peut poser problème si on a un espace
        $this->value = str_replace(" ", "", $value);
        $this->name = str_replace(" ", "", $name);
        $this->id = str_replace(" ", "", $id);
        $this->function = $function;
    }

    public function __toString() {
        return $this->render();
    }

    public function setLabel(string $label){
        $this->label = "<label for=".$this->id.">".$label."</label>";
        return $this;
    }

    public function render(): string{
        $required = $this->required ? "required=true" : "";
        $value = $this->value === "" ? "" : "value=".$this->value;
        $function = $this->function === null ? "" : "onclick=".$this->function;
        $input =  "<input type=".$this->type." $required $value id=".$this->id." name=".$this->name." $function>";

        if($this->label !== ""){
            return $this->label.$input;
        }
        return $input;
    }
}