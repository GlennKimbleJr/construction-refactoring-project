<?php

namespace App;

use App\Database;
use League\Plates\Engine;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Controller
{
    /**
     * @param App\Database $db
     * @param Psr\Http\Message\ResponseInterface $response
     * @param League\Plates\Engine $template
     */
    public function __construct(Database $db, RequestInterface $request, ResponseInterface $response, Engine $template)
    {
        $this->db = $db;
        $this->request = $request;
        $this->response = $response;
        $this->template = $template;
    }

    /**
     * Wrapper to build a template and return the response object.
     *
     * @param  string $view template to load.
     * @param  array  $args arguments to pass into the template.
     *
     * @return Response
     */
    protected function view($view, $args = [])
    {
        $this->shareWithAllViews([
            'route_path' => $this->request->getUri()->getPath(),
        ]);

        $this->response->getBody()->write(
            $this->template->render(str_replace('.', '/', $view), $args)
        );

        return $this->response;
    }

    private function shareWithAllViews($data)
    {
        $this->template->addData($data);
    }

    /**
     * Wrapper to return a redirect as a response object.
     *
     * @param  string $to destination url.
     * @return Response
     */
    protected function redirect($to) {
        return $this->response->withAddedHeader('location', $to);
    }
}
