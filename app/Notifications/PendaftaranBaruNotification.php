<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class PendaftaranBaruNotification extends Notification
{
    protected $pendaftaran;

    public function __construct($pendaftaran)
    {
        $this->pendaftaran = $pendaftaran;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $namaMahasiswa = $this->pendaftaran->mahasiswa->nama ?? 'Mahasiswa';
        $namaInstansi = $this->pendaftaran->instansi->nama ?? $this->pendaftaran->instansi_manual ?? 'Instansi tidak diketahui';

        return [
            'message' => 'Pendaftaran baru dari ' . $namaMahasiswa . ' ke instansi ' . $namaInstansi,
            'pendaftaran_id' => $this->pendaftaran->id,
        ];
    }
}
