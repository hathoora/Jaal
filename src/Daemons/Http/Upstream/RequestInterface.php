<?php

namespace Hathoora\Jaal\Daemons\Http\Upstream;

use Hathoora\Jaal\Daemons\Http\Client\RequestInterface as ClientRequestInterface;
use Hathoora\Jaal\Daemons\Http\Message\ResponseInterface;
use Hathoora\Jaal\IO\React\SocketClient\Stream;

Interface RequestInterface extends \Hathoora\Jaal\Daemons\Http\Message\RequestInterface
{
    /**
     * Return vhost
     *
     * @return \Hathoora\Jaal\Daemons\Http\Vhost\Vhost
     */
    public function getVhost();

    /**
     * Return  client's request
     *
     * @return ClientRequestInterface
     */
    public function getClientRequest();

    /**
     * Set outbound stream
     *
     * @param Stream $stream
     * @return self
     */
    public function setStream(Stream $stream);

    /**
     * Returns connection stream socket
     *
     * @return Stream
     */
    public function getStream();

    /**
     * Send's the request to upstream server, this also allows sending incoming client data directly to upstream without
     * having to write to local disk hence preventing unnecessary IO
     *
     * @param null $buffer
     */
    public function send($buffer = null);

    /**
     * Reads the data from upstream server and parses it
     *
     * @param        $data
     * @return mixed
     */
    public function onInboundData($data);

    /**
     * Upstream reply is client's request response
     *
     * @param null $code to overwrite upstream response
     * @param null $message
     */
    public function error($code, $message = NULL);

    public function cleanup();
}
