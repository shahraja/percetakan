<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotifMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $transaksi, $subject, $userName;
    public function __construct($transaksi)
    {
        $this->transaksi = $transaksi;

        $this->userName = User::where('id', $this->transaksi->user_id)->first()->name;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $listStatus = [
            "Menunggu Pembayaran" => "Segera Lakukan Pembayaran",
            "Pembayaran Dikonfirmasi" => "Pembayaran Berhasil",
            "Ditolak" => "Pembayaran Ditolak",
            "Expire" => "Pembayaran Sudah Expired",
            "Pending" => "Pembayaran Sedang Pending",
        ];
        $this->subject = $listStatus[$this->transaksi->status];
        return new Envelope(
            subject: $this->subject
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.email',
            with: [
                'transaksi' => $this->transaksi,
                'subject' => $this->subject,
                'userName' => $this->userName
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
