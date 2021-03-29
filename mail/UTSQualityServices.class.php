<?php
class PrimaryClass
{
    public function __construct()
    {
    }

    public function doAction()
    {
        $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING) ?: "";
        // Process the Action.

        if (strpos($action, ".") === false) {
            $method = $action;
            if (method_exists(__CLASS__, $method)) {
                $this->$method();
                return;
            }
        } else {
            $actionParts = explode(".", $action);
            $class = (isset($actionParts[0]) ? $actionParts[0] : "");
            $method = (isset($actionParts[1]) ? $actionParts[1] : "");
            if (method_exists($class, $method)) {
                $class = new $class();
                $class->$method();
                $class = null;
                return;
            }
        }
    }

    public function testing() {
        echo $_POST["data"][0];
    }
}
