<?php
class View
{
    public static function redirect($nameView, $argc = [])
    {
        ob_start();
        extract($argc);
        require_once  "./View/$nameView.php";
        $content1 = ob_get_contents();
        ob_clean();
        ob_end_flush();
        echo $content1; // Hieu.dev. From e-web.vn
    }
}