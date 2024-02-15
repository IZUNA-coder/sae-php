<?php

namespace form\type;


class Select extends Input{
   
    protected string $id;
protected string $name;
private ?string $function = null;
private ?string $idlabel = null;
private array $options = [];
protected ?string $label = null;

public function __construct(
    string $id,
    string $name,
    ?string $function = null,
    ?string $label = null,
    ?string $idlabel = null,
    ?array $options = null
){
    $this->id = str_replace(" ", "", $id);
    $this->name = str_replace(" ", "", $name);
    $this->function = $function;
    $this->label = $label;
    $this->idlabel = $idlabel;
    $this->options = $options ?? [];
}

    public function __toString(){
        return $this->render();
    }

    public function setLabel(string $label){
        $this->label = "<label for=".$this->idlabel.">".$label."</label>";
        return $this;
    }

    public function setOption(string $value, string $text){
        return "<option value=".$value.">".$text."</option>";
    }

    public function setFunction(string $function){
        $this->function = $function;
        return $this;
    }   

    public function addOption(string $value, string $text){
        $this->options[] = "<option value=".$value.">".$text."</option>";
        return $this;
    }

    public function addOptionArray(string $value,array $options){
        foreach($options as $option){
            $this->options[] = "<option value=".$value.">".$option."</option>";
        }
        return $this;
    }

    public function render(): string{
        $function = $this->function === null ? "" : "onclick=".$this->function;
        $select = "<select id=".$this->id." name=".$this->name." $function>";
        foreach($this->options as $option){
            $select .= $option;
        }
        $select .= "</select>";

        if($this->label !== ""){
            return $this->label.$select;
        }
        return $select;
    }	
}