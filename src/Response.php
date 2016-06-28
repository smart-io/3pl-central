<?php

namespace ThreePlCentral;

use DOMDocument;
use DOMText;
use Psr\Http\Message\ResponseInterface;

class Response implements \ThreePlCentral\ResponseInterface
{
    private $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function body()
    {
        return (string) $this->response->getBody();
    }

    public function json()
    {
        $body = $this->body();
        $xml = new DOMDocument("1.0", "ISO-8859-15");
        $xml->loadXML($body);

        $body = null;
        foreach ($xml->firstChild->childNodes as $node) {
            if (!($node instanceof DOMText) && $node->tagName === 'soap:Body') {
                $body = $node;
                break;
            }
        }

        if ($body) {
            $content = null;
            foreach ($body->childNodes as $node) {
                if (!($node instanceof DOMText)) {
                    $content = $node;
                    break;
                }
            }
            if ($content) {
                return $this->parseXmlContent($content->nodeValue);
            }
        }
        return [];
    }

    private function parseXmlContent($xml)
    {
        $xml = trim($xml);
        if (strncmp($xml, '<', 1) !== 0) {
            return ['error' => $xml];
        }
        $xml = new \SimpleXMLElement($xml);
        $obj = json_decode(json_encode($xml));
        foreach ($obj as $param => $value) {
            return $value;
        }
        return null;
    }
}
