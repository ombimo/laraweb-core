<?php

namespace Ombimo\LarawebCore\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOMeta as SEO;
use Ombimo\LarawebCore\Breadcrumb;
use Ombimo\LarawebCore\Helpers\Web;
use Ombimo\LarawebCore\Models\Pesan;

class ContactController extends Controller
{
    public function get()
    {
        SEO::setTitle(__('app.menu.contact'));

        //breadcrumb
        Breadcrumb::add(__('app.menu.contact'), route('contact'));

        Web::setMenu('kontak');

        return view('contact', [
        ]);
    }

    public function post(Request $request)
    {
        $pesan = new Pesan;
        $pesan->nama = $request->input('nama');
        $pesan->email = $request->input('email');
        $pesan->no_telp = $request->input('no_telp');
        $pesan->subjek = $request->input('subjek');
        $pesan->isi = $request->input('isi');
        if ($pesan->save()) {
            session()->flash('alert', [
                'type' => 'alert-success',
                'msg' => __('app.contact.sukses')
            ]);
        } else {
            session()->flash('alert', [
                'type' => 'alert-danger',
                'msg' => __('app.contact.gagal')
            ]);
            return redirect()->route('contact')->withInput();
        }

        return redirect()->route('contact');
    }
}
