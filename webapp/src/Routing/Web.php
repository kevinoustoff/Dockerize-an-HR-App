<?php
namespace UHA\Routing;

class Web {
    protected $routes = [];
    protected $currentPrefix = '';
    public function addRoute(string $method, string $url, \Closure $target) {
        $url = $this->currentPrefix . $url;
        // Use regular expression to match parameters in the URL
        $pattern = preg_replace('#/{(\w+)}#', '/(?<$1>[^/]+)', $url);
        $pattern = '#^' . $pattern . '$#';

        $this->routes[$method][$pattern] = $target;
    }

    public function addPrefix(string $prefix, \Closure $callback) {
        
        $previousPrefix = $this->currentPrefix;

        $this->currentPrefix .= $prefix;

        
        $callback();

        // Restore the previous prefix
        $this->currentPrefix = $previousPrefix;
    }

    public function processRequest() {
        $method = $_SERVER['REQUEST_METHOD'];
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $pattern => $target) {
                // Check if the URL matches the pattern
                if (preg_match($pattern, $url, $matches)) {
                    // Remove the first element (full match) from $matches
                    array_shift($matches);

                    // Call the target closure with parameters
                    if($this->currentPrefix != "/api"){
                        echo call_user_func_array($target, $matches);
                        exit;
                    }
                    else{
                        return call_user_func_array($target,$matches);
                    }
                    
                }
            }
        }

        throw new \Exception('Route not found');
    }
}
?>
