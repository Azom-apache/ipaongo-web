<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Donate extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->data['image']){
            return $this->view('email.donate', compact('data'))->subject($this->data['subject'])->attach($this->data['image']);
        }


        if(!$this->data['image']){
            return $this->view('email.donate', compact('data'))->subject($this->data['subject']);
        }


    }
}
