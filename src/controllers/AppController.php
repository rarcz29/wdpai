<?php

require_once 'src/services/Account.php';

class AppController
{
    protected $account;
    private $request;

    public function __construct()
    {
        $this->request = $_SERVER['REQUEST_METHOD'];
        session_start();
        $this->account = new Account();
    }

    protected function isGet(): bool
    {
        return $this->request === 'GET';
    }

    protected function isPost(): bool
    {
        return $this->request === 'POST';
    }
    
    protected function render(string $template = null, array $variables = [])
    {
        $templatePath = 'public/views/'. $template.'.php';
        $output = 'File not found';
                
        if(file_exists($templatePath)){
            extract($variables);
            
            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }
        
        print $output;
    }

    protected function redirect(string $page = '')
    {
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/".$page);
    }
}
