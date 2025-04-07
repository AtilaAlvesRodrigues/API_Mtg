<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPassword extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $resetUrl = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('🔒 Redefinição de Senha Personalizada')
            ->greeting('Olá!')
            ->line('Recebemos uma solicitação para redefinir sua senha.')
            ->action('Redefinir Senha', $resetUrl)
            ->line('Se você não solicitou isso, pode ignorar este e-mail.')
            ->salutation('Até logo, Equipe Magic App 🧙‍♂️');
    }

    public function toArray($notifiable)
    {
        return [];
    }
}