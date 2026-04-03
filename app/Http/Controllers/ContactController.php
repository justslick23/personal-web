<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function submit(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|max:255',
            'message'    => 'required|string|min:10|max:5000',
        ]);

        try {
            Mail::send([], [], function (Message $mail) use ($data) {
                $mail->to('hello@tokelofoso.online')
                     ->replyTo($data['email'], $data['first_name'] . ' ' . $data['last_name'])
                     ->subject('New Contact Message from ' . $data['first_name'] . ' ' . $data['last_name'])
                     ->html(
                         '<div style="font-family:sans-serif;max-width:600px;margin:0 auto;padding:2rem;background:#f9f9f9;">
                             <div style="background:#111;padding:1.5rem 2rem;border-radius:8px 8px 0 0;">
                                 <h2 style="color:#00e676;margin:0;font-size:1.1rem;letter-spacing:.05em;">NEW MESSAGE — tokelofoso.online</h2>
                             </div>
                             <div style="background:#fff;padding:2rem;border:1px solid #eee;border-radius:0 0 8px 8px;">
                                 <table style="width:100%;border-collapse:collapse;">
                                     <tr>
                                         <td style="padding:.6rem 0;color:#888;font-size:.85rem;width:110px;">Name</td>
                                         <td style="padding:.6rem 0;font-weight:600;">' . htmlspecialchars($data['first_name'] . ' ' . $data['last_name']) . '</td>
                                     </tr>
                                     <tr>
                                         <td style="padding:.6rem 0;color:#888;font-size:.85rem;">Email</td>
                                         <td style="padding:.6rem 0;"><a href="mailto:' . htmlspecialchars($data['email']) . '" style="color:#00e676;">' . htmlspecialchars($data['email']) . '</a></td>
                                     </tr>
                                 </table>
                                 <hr style="border:none;border-top:1px solid #eee;margin:1.25rem 0;">
                                 <p style="color:#888;font-size:.85rem;margin-bottom:.5rem;">Message</p>
                                 <p style="line-height:1.75;white-space:pre-wrap;">' . htmlspecialchars($data['message']) . '</p>
                             </div>
                             <p style="text-align:center;font-size:.75rem;color:#aaa;margin-top:1rem;">
                                 Sent via tokelofoso.online contact form
                             </p>
                         </div>'
                     );
            });

            return redirect()->route('contact')
                ->with('success', 'Message sent! I\'ll get back to you soon.');

        } catch (\Throwable $e) {
            return redirect()->route('contact')
                ->with('error', 'Something went wrong sending your message. Please try emailing me directly.')
                ->withInput();
        }
    }
}