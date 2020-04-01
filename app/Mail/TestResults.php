<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestResults extends Mailable
{
    use Queueable, SerializesModels;
    protected $headers=[];
    protected $handShakes=[];
    protected $SecurityVulnerabilities=[];
    protected $ConnectionProtocols=[];
    protected $ServerHello=[];
    protected $CyphersPherProtocole=[];
    protected $IP;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $headers,array $handShakes,array $SecurityVulnerabilities,array $ConnectionProtocols,array $ServerHello,array $CyphersPherProtocole,$IP)
    {
    $this->headers=$headers;
    $this->handShakes=$handShakes;
    $this->SecurityVulnerabilities=$SecurityVulnerabilities;
    $this->ConnectionProtocols=$ConnectionProtocols;
    $this->ServerHello=$ServerHello;
    $this->CyphersPherProtocole=$CyphersPherProtocole;
    $this->IP=$IP;

  }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->markdown('emails.testResults')->with([
          'headers' => $this->headers,
          'handShakes' => $this->handShakes,
          'SecurityVulnerabilities' => $this->SecurityVulnerabilities,
          'ConnectionProtocols' => $this->ConnectionProtocols,
          'ServerHello' => $this->ServerHello,
          'CyphersPherProtocole' => $this->CyphersPherProtocole,
          'IP' => $this->IP,
          ]);
    }
}
