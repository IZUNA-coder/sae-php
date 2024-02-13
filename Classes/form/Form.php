<?php 

namespace form;

use form\type\Hidden;
use form\type\Input;
use form\type\Link;
use form\type\Submit;

class Form implements InputRender{

    // type possible du formulaire
    public const POST = "POST";
    public const GET = "GET";
    public const PUT = "PUT";
    public const DELETE = "DELETE";

    /** @var Input[] */
    private array $input = [];

    /**
     * @param string $action
     * @param string $method
     * @param string $id id du formulaire
     */
    public function __construct(
        protected string $action,
        protected string $method,
        private string $id
    ){
        // ajoute au formulaire son identifiant
        $this->addInput(new Hidden($this->id, true, "form_id", "form_id"));
    }

    /**
     * @param Input $input
     * @return void
     */
    public function addInput(Input $input): void{
        $this->input[] = $input;
    }

    /**
     * @return array
     */
    public function getInputs(): array{
        return $this->input;
    }

    /**
     * permet la redirection de page 
     * @param string $controller
     * @param string $action
     * @return void
     */
    public function setController(string $controller, string $action): void{
        $this->addInput(new Hidden($controller, true, "controller", "controller"));
        $this->addInput(new Hidden($action, true, "action", "action"));
    }


    public function __toString(){
        return $this->render();
    }

    /**
     * @return string
     */
    public function render(): string{
        $form = "<form class='form' action=".$this->action." method=".$this->method.">";
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
        return $form;
    }
}