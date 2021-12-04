<?php

namespace Ombimo\LarawebCore\Controller;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOMeta as SEO;
use Illuminate\Http\Request;
use Ombimo\LarawebCore\Helpers\Alert;
use Ombimo\LarawebCore\Helpers\Breadcrumb;
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
            Alert::set('alert-success', __('app.contact.sukses'));
        } else {
            Alert::set('alert-danger', __('app.contact.gagal'));
            return redirect()->route('contact')->withInput();
        }

        return redirect()->route('contact');
    }
}
