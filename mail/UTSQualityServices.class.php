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

    public function SendMail()
    {
        $name = $_POST["data"][0];
        $phoneNumber = $_POST["data"][1];
        $ClientLocation = $_POST["data"][2];
        $otherLocation = $_POST["data"][3];

        $to = "keith.blackwelder@ktbwebservices.com";
        $subject = "Website contact form submitted.";
        $body = "You have received a new message from your website contact form.\n\n" . "Here are the details:\n\nName: $name\n\nPhone: $phoneNumber\n\nLocation: $ClientLocation\n\n\nOther Location: $otherLocation";

        if (mail($to, $subject, $body, "From: info@utsqualityservices.com")) {
            echo json_encode(["answer" => "yes"]);
        } else {
            echo json_encode(["answer" => "no"]);
        }
    }

    public function testing()
    {
        echo $_POST["data"][0];
    }
}
