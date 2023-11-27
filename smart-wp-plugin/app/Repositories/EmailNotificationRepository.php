<?php

namespace SmartWpPlugin\Repositories;

use SmartWpPlugin\Repositories\AbstractRepository;

/**
 * class EmailNotificationRepository
 * @package SmartWpPlugin\Repositories
 * DESCRIPTION: EmailNotificationRepository Service Layer.
 */
class EmailNotificationRepository extends  AbstractRepository
{

    /**
     * send_mail
     *
     * @return void
     *  Description: Send General Email
     */
    public function send_mail($subject, $template_path, $user_data, $data = array())
    {
        try {
            $from_name = get_email_settings("from_name") ? get_email_settings("from_name") : "UpNext";
            $form_email = get_email_settings("from_email") ? get_email_settings("from_email") : "info@smart-is.com";
            $html = $this->output_view($template_path, $data);
            if (get_email_settings('enable_twilio') && get_email_settings('twilio_api_key')) {
                $email = new \SendGrid\Mail\Mail();
                $email->setFrom($form_email, $from_name);
                $email->setSubject($subject);
                $email->addTo($user_data['email'], $user_data['name']);
                $email->addContent(
                    "text/html",
                    $html
                );
                $sendgrid = new \SendGrid(get_email_settings('twilio_api_key'));
                $response = $sendgrid->send($email);
                return $this->send_response($response);
            } else {
                $headers = array('Content-Type: text/html; charset=UTF-8', 'From:' . $from_name . '<' . $form_email . '>');

                $response = wp_mail($user_data['email'], $subject, $html, $headers);
                if ($response) {
                    return $this->send_response($response);
                } else {
                    return $this->send_response([], [], 'Email not sent', false);
                }
            }
        } catch (\Exception $e) {
            return $this->send_response([], [], $e->getMessage(), false);
        }
    }
}
