<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public $data;
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Users.mails.orderConfirmation')
            ->from('dn5678853@gmail.com', 'ISMART STORE')
            ->subject('[ISMART STORE] Xác Nhận Đơn Hàng Tại Cửa Hàng ISMART')
            ->with($this->data);
    }
}
