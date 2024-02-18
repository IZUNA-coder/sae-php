<?php

namespace form;

use form\type\Hidden;
use form\type\Input;
use form\type\Link;
use form\type\Submit;


class FormData extends Form
{
    public function __construct(
        protected string $action,
        protected string $method,
        private string $id,
        private string $enctype = "multipart/form-data"
    ) {
        parent::__construct($action, $method, $id);
    }

    public function render(): string{
        $form = "<form class='form' action='".$this->action."' method='".$this->method."' id='".$this->id."' enctype='".$this->enctype."'>";
        foreach($this->input as $input){
            // affiche les submits à la fin du formulaire
            if($input instanceof Submit){
                continue;
            }

            if($input instanceof Hidden){
                $form .= $input;
                continue;
            }

            if($input instanceof Link){
                $form .= $input;
                continue;
            }
            
            $form .= "<div class='form-input'><div>".$input."</div></div>";
        }

        foreach($this->input as $input){
            if($input instanceof Submit){
                $form .= "<div class='form-input'><div>".$input."</div></div>";
            }
        }
        $form .= "</form>";
        return $form;
    } 

}