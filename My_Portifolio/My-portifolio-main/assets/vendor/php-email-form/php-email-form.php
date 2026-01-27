<?php

class PHP_Email_Form {
  public $to;
  public $from_name;
  public $from_email;
  public $subject;
  public $messages = [];
  public $ajax = false;

  public function add_message($msg, $label) {
    $this->messages[] = $label . ': ' . $msg;
  }

  public function send() {
    $message = implode("\n", $this->messages);
    $headers = "From: " . $this->from_name . " <" . $this->from_email . ">\r\n";
    $headers .= "Reply-To: " . $this->from_email . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($this->to, $this->subject, $message, $headers)) {
      return $this->ajax ? json_encode(['status' => 'success', 'message' => 'Message sent successfully']) : 'Message sent successfully';
    } else {
      return $this->ajax ? json_encode(['status' => 'error', 'message' => 'Message failed to send']) : 'Message failed to send';
    }
  }
}

?>
