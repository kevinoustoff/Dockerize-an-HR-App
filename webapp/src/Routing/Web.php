<?php
namespace UHA\Routing;

class Web {
    /** @var array<string, array<string, \Closure>> */
    protected array $routes = [];
    protected string $currentPrefix = '';

    public function addRoute(string $method, string $url, \Closure $target): void {
        $url = $this->currentPrefix . $url;
        $pattern = preg_replace('#/{(\w+)}#', '/(?<$1>[^/]+)', $url);
        $pattern = '#^' . $pattern . '$#';
        $this->routes[$method][$pattern] = $target;
    }

    public function addPrefix(string $prefix, \Closure $callback): void {
        $previousPrefix = $this->currentPrefix;
        $this->currentPrefix .= $prefix;
        $callback();
        $this->currentPrefix = $previousPrefix;
    }

    public function processRequest(): string {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (!isset($this->routes[$method])) {
            throw new \Exception('No routes registered for this method.');
        }

        foreach ($this->routes[$method] as $pattern => $target) {
            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches);
                $params = array_values($matches);

                if ($this->currentPrefix !== '/api') {
                    echo call_user_func_array($target, $params);
                    exit;
                } else {
                    return (string) call_user_func_array($target, $params);
                }
            }
        }

        throw new \Exception("Route not found for URL: {$url}");
    }
}

?>