<?php
namespace Controllers\Mnt;

// ---------------------------------------------------------------
// Sección de imports
// ---------------------------------------------------------------
use Controllers\PublicController;
use Views\Renderer;
use Utilities\Validators;
use Dao\Mnt\GetCatalogo as DaoCatalogo;

class Catalogo extends PublicController
{
    private $viewData = array();

    public function run():void
    {
        // code
        $this->init();

        // Cuando es método POST (click en el botón)
        if ($this->isPostBack()) {
            $this->procesarPost();
        }
        Renderer::render('mnt/catalogo', $this->viewData);
    }

    private function init()
    {
        $this->viewData = array();
        $this->viewData["Productos"] = array();
        $this->viewData["invPrdDsc"] = "";
        $this->viewData["invPrdPrc"] = "";
        $this->viewData["RngMin"] = "";
        $this->viewData["RngMax"] = ""; 
        $this->viewData["error_busq"] = array();
        $this->viewData["error_minRng"] = array();

        $this->tmpProductos = DaoCatalogo::getAll();
        $this->viewData["Productos"] = $this->tmpProductos;
    }

    private function procesarPost()
    {
        $hasErrors = false;
        $this->viewData["invPrdDsc"] = ($_POST["invPrdDsc"]);

        if (Validators::IsEmpty($this->viewData["invPrdDsc"]) && !isset($_POST['RngMin']) && !isset($_POST['RngMax'])){
        $this->viewData["error_busq"][]
                = "Por favor indique lo que desea buscar";
            $hasErrors = true;
        }

        if (!Validators::IsEmpty($this->viewData["invPrdDsc"]) && (isset($_POST['RngMin']) || isset($_POST['RngMax']))){
            $this->viewData["error_busq"][]
                = "No se pueden realizar dos busquedas simultaneas";
            $hasErrors = true;
        }
        
        
        
        if (!$hasErrors) {
            if(intval($_POST['RngMin']) > intval($_POST['RngMax'])){
                $this->viewData["error_minRng"][]
                    = "Seleccione un rango mínimo correcto";
                $hasErrors = true;
            }
            if (!Validators::IsEmpty($this->viewData["invPrdDsc"])){
                $this->viewData["Productos"] = array();
                $this->tmpProductos = DaoCatalogo::getByDes($this->viewData["invPrdDsc"]);
                $this->viewData["Productos"] = $this->tmpProductos;

            }else{
                $this->viewData["Productos"] = array();
                $this->viewData["RngMin"] = intval($_POST['RngMin']);
                $this->viewData["RngMax"] = intval($_POST['RngMax']);
                $this->tmpProductos = DaoCatalogo::getByRng($this->viewData["RngMin"], $this->viewData["RngMax"]);
                $this->viewData["Productos"] = $this->tmpProductos;
            }
        }

    }
}