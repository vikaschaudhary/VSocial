<?php

namespace NIC\Mail;

use Zend\Mail\Message;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Mail\Transport\File as FileTransport;
use Zend\Mail\Transport\FileOptions;

class Mail {

  protected $transport;
  protected $mail;
  protected $name = "localhost.localdomain";
  protected $host = "127.0.0.1";
  protected $connection_class = "plain";
  protected $username = 'user';
  protected $password = 'pass';
  protected $from;
  protected $to;
  protected $body;
  protected $subject;
  protected $template;
  protected $templateVars = array();
  protected $headers = array();
  protected $cc;
  protected $bcc;

  public function __construct(array $params = array()) {

    $this->transport = isset($params['transport']) && !empty($params['transport']) ? strtolower($params['transport']) : "smtp";
    $this->transport = isset($params['transport']) && !empty($params['transport']) ? strtolower($params['transport']) : "smtp";
    $this->setOptions($params);
  }

  protected function setOptions($params) {
    if (!is_null($this->transport)) {
      switch ($this->transport) {
        case "smtp":
          $authType = isset($params['auth_type']) ? strtolower($params['auth_type']) : 'plain';
          $server_name = isset($params['server_name']) ? strtolower($params['server_name']) : $this->name;
          $server_host = isset($params['server_host']) ? strtolower($params['server_host']) : $this->host;

          $username = isset($params['username']) ? strtolower($params['username']) : $this->username;
          $password = isset($params['password']) ? strtolower($params['password']) : $this->password;
          switch ($authType) {
            case "plain":
              $options = array(
                  'connection_class' => 'plain',
                  'connection_config' => array(
                      'username' => $username,
                      'password' => $password,
                  )
              );
              break;
            case "login":
              $options = array(
                  'connection_class' => 'login',
                  'connection_config' => array(
                      'username' => $username,
                      'password' => $password,
                  )
              );
              break;
            case "crammd5":
              $options = array(
                  'connection_class' => 'crammd5',
                  'connection_config' => array(
                      'username' => $username,
                      'password' => $password,
                  )
              );
              break;
            case "plain_tls":
              $options = array(
                  'port' => 587, // Notice port change for TLS is 587
                  'connection_class' => 'plain',
                  'connection_config' => array(
                      'username' => $username,
                      'password' => $password,
                      'ssl' => 'tls',
                  )
              );
              break;
            default :
              break;
          }

          $options['name'] = $server_name;
          $options['host'] = $server_host;


          $mailOptions = new SmtpOptions($options);
          $this->mail = new Transport\Smtp($mailOptions);
          break;
        case "sendmail":
          $options = array();
          $this->mail = new Transport\Sendmail($options);
          break;
        case "file":
          $options = new FileOptions(array(
              'path' => 'data/mail/',
              'callback' => function (FileTransport $transport) {
                return 'Message_' . microtime(true) . '_' . mt_rand() . '.txt';
              },
          ));
          $this->mail = new Transport\File($options);
          break;
        default :
          break;
      }
    }
  }

  public function setProtocol($protocol) {
    if (is_null($this->protocol) || $protocol != $this->protocol) {
      $this->protocol = $protocol;
    }

    return $this;
  }

  public function addFrom($from) {
    $this->from = $from;
    return $this;
  }

  public function addTo($to) {
    $this->to = $to;
    return $this;
  }

  public function addBody($body) {
    $this->body = $body;
    return $this;
  }

  public function addTemplate($template) {
    $this->template = $template;
    return $this;
  }

  public function addTemplateParams($templatesParams = array()) {
    $this->templateVars = $templatesParams;
    return $this;
  }

  public function addSubject($subject) {
    $this->subject = $subject;
    return $this;
  }

  public function addHeader($header) {
    array_merge($this->headers, $header);
    return $this;
  }

  public function addHeaders($headers) {
    $this->headers = $headers;
    return $this;
  }

  public function addCC($cc) {
    $this->cc = $cc;
    return $this;
  }

  public function addBcc($bcc) {
    $this->bcc = $bcc;
    return $this;
  }

  public function send() {
    $mail = $this->mail;
    $message = new Message();
    $message->addTo($this->to)
            ->addFrom($this->from)
            ->setSender($this->from)
            ->setSubject($this->subject)
            ->setBody($this->body);
    $message->setEncoding("UTF-8");
    if (sizeof($this->headers) > 0) {
      foreach ($this->headers as $key => $value) {
        $message->getHeaders()->addHeaderLine($key, $value);
      }
    }
    $mail->send($message);
  }

}

?>
