<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\DetailCheckout;
use DB;
use App\Models\User;
use App\Models\courier;
use App\Models\Produk;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function indexadmin()
    {
        $itemtransaksicount = DB::table('adminnotifications')
            ->select('id', 'adminnotifications.id_checkout_review', 'adminnotifications.jenis')
            ->where('adminnotifications.jenis', "transaksi")
            ->where('adminnotifications.read', "belum")
            ->count();
            $itempembayarancount = DB::table('adminnotifications')
            ->select('id','adminnotifications.id_checkout_review', 'adminnotifications.jenis')
            ->where('adminnotifications.jenis', "pembayaran")
            ->where('adminnotifications.read', "belum")
            ->count();
            $itemreviewcount = DB::table('adminnotifications')
            ->select('id','adminnotifications.id_checkout_review', 'adminnotifications.jenis')
            ->where('adminnotifications.jenis', "review")
            ->where('adminnotifications.read', "belum")
            ->count();
    
            $itemtransaksitotal = DB::table('adminnotifications')
            ->select('id','id_checkout_review', 'jenis')
            ->where('adminnotifications.read', "belum")
            ->count();

            $itemtransaksi = DB::table('adminnotifications')
            ->select('id','id_checkout_review', 'jenis')
            ->where('adminnotifications.read', "belum")
            ->get();
    
            if ($itemtransaksitotal > '0') {
                if($itemtransaksitotal == '1'){
                    if($itemtransaksi[0]->jenis == 'transaksi'){
                    notify()->success('Hi transaksi baru dengan id : '.$itemtransaksi[0]->id_checkout_review.' sudah masuk,segera cek!!!');
                    $itemupdate = DB::statement('UPDATE adminnotifications SET `read` = "sudah" WHERE adminnotifications.id = '.$itemtransaksi[0]->id.';');
                    $iteminsert = DB::statement('UPDATE adminnotifications SET pesan = ("Hi transaksi baru dengan id : '.$itemtransaksi[0]->id_checkout_review.' sudah masuk,segera cek!!!") WHERE adminnotifications.id = '.$itemtransaksi[0]->id.';'); 
                    // $itemdelete = DB::delete('DELETE FROM adminnotifications WHERE adminnotifications.id = '.$itemtransaksi[0]->id.';');
                    }
                    elseif($itemtransaksi[0]->jenis == 'pembayaran'){
                    notify()->success('Hi bukti pembayaran transaksi dengan id : '.$itemtransaksi[0]->id_checkout_review.' sudah tersedia, segera cek!!!');
                    $itemupdate = DB::statement('UPDATE adminnotifications SET `read` = "sudah" WHERE adminnotifications.id = '.$itemtransaksi[0]->id.';');
                    $iteminsert = DB::statement('UPDATE adminnotifications SET pesan = ("Hi bukti pembayaran transaksi dengan id : '.$itemtransaksi[0]->id_checkout_review.' sudah tersedia, segera cek!!!") WHERE adminnotifications.id = '.$itemtransaksi[0]->id.';'); 
                    // $itemdelete = DB::delete('DELETE FROM adminnotifications WHERE adminnotifications.id = '.$itemtransaksi[0]->id.';');
                    }

                    elseif($itemtransaksi[0]->jenis == 'review'){
                        notify()->success('Hi terdapat ulasan baru dengan id : '.$itemtransaksi[0]->id_checkout_review.' segera cek!!!');
                        $itemupdate = DB::statement('UPDATE adminnotifications SET `read` = "sudah" WHERE adminnotifications.id = '.$itemtransaksi[0]->id.';');
                        $iteminsert = DB::statement('UPDATE adminnotifications SET pesan = ("Hi terdapat ulasan baru dengan id : " .$itemtransaksi[0]->id_checkout_review. "segera cek!!!") WHERE adminnotifications.id = '.$itemtransaksi[0]->id.';'); 
    
                        // $itemdelete = DB::delete('DELETE FROM adminnotifications WHERE adminnotifications.id = '.$itemtransaksi[0]->id.';');
                    }
                }
                elseif($itemtransaksitotal > '1'){
                    foreach ($itemtransaksi as $ya){
                        if($itemtransaksicount > 0 and $itempembayarancount > 0 and $itemreviewcount > 0){
                            notify()->success('Hi beberapa transaksi dan bukti pembayaran transaksi serta ulasan baru telah tersedia, segera cek!!!');
                            foreach ($itemtransaksi as $y){ 
                                $itemupdate = DB::statement('UPDATE adminnotifications SET `read` = "sudah" WHERE adminnotifications.id = '.$y->id.';');
                                $iteminsert = DB::statement('UPDATE adminnotifications SET pesan = ("Hi beberapa transaksi dan bukti pembayaran transaksi serta ulasan baru telah tersedia, segera cek!!!") WHERE adminnotifications.id = '.$itemtransaksi[0]->id.';'); 
        
                                // $itemdelete = DB::delete('DELETE FROM adminnotifications WHERE adminnotifications.id = '.$y->id.';');
                            }
                        }
                        elseif($itemtransaksicount > 0 and $itempembayarancount > 0 ){
                            notify()->success('Hi beberapa transaksi dan bukti pembayaran transaksi baru telah tersedia, segera cek!!!');
                            foreach ($itemtransaksi as $y){ 
                                $itemupdate = DB::statement('UPDATE adminnotifications SET `read` = "sudah" WHERE adminnotifications.id = '.$y->id.';');
                                $iteminsert = DB::statement('UPDATE adminnotifications SET pesan = ("Hi beberapa transaksi dan bukti pembayaran transaksi baru telah tersedia, segera cek!!!") WHERE adminnotifications.id = '.$itemtransaksi[0]->id.';'); 

                                // $itemdelete = DB::delete('DELETE FROM adminnotifications WHERE adminnotifications.id = '.$y->id.';');
                            }
                        }
                        elseif($itemtransaksicount > 0 and $itemreviewcount > 0){
                            notify()->success('Hi beberapa transaksi dan ulasan baru telah tersedia, segera cek!!!');
                            foreach ($itemtransaksi as $y){ 
                                $itemupdate = DB::statement('UPDATE adminnotifications SET `read` = "sudah" WHERE adminnotifications.id = '.$y->id.';');
                                $iteminsert = DB::statement('UPDATE adminnotifications SET pesan = ("Hi beberapa transaksi dan ulasan baru telah tersedia, segera cek!!!") WHERE adminnotifications.id = '.$itemtransaksi[0]->id.';'); 

                                // $itemdelete = DB::delete('DELETE FROM adminnotifications WHERE adminnotifications.id = '.$y->id.';');
                            }
                        }
                        elseif($itempembayarancount > 0 and $itemreviewcount > 0){
                            notify()->success('Hi beberapa bukti pembayaran transaksi dan ulasan baru telah tersedia, segera cek!!!');
                            foreach ($itemtransaksi as $y){ 
                                $itemupdate = DB::statement('UPDATE adminnotifications SET `read` = "sudah" WHERE adminnotifications.id = '.$y->id.';');
                                $iteminsert = DB::statement('UPDATE adminnotifications SET pesan = ("Hi beberapa bukti pembayaran transaksi dan ulasan baru telah tersedia, segera cek!!!") WHERE adminnotifications.id = '.$itemtransaksi[0]->id.';'); 

                                // $itemdelete = DB::delete('DELETE FROM adminnotifications WHERE adminnotifications.id = '.$y->id.';');
                            }
                        }
                        elseif($ya->jenis == "transaksi"){
                            notify()->success('Hi beberapa transaksi baru sudah masuk, segera cek!!!');
                            foreach ($itemtransaksi as $y){ 
                                $itemupdate = DB::statement('UPDATE adminnotifications SET `read` = "sudah" WHERE adminnotifications.id = '.$y->id.';');
                                $iteminsert = DB::statement('UPDATE adminnotifications SET pesan = ("Hi beberapa transaksi baru sudah masuk, segera cek!!!") WHERE adminnotifications.id = '.$itemtransaksi[0]->id.';'); 

                                // $itemdelete = DB::delete('DELETE FROM adminnotifications WHERE adminnotifications.id = '.$y->id.';');
                            }
                        }
                        elseif($ya->jenis == "pembayaran"){
                            notify()->success('Hi beberapa bukti transaksi pembayaran sudah tersedia, segera cek!!!');
                            foreach ($itemtransaksi as $y){ 
                                $itemupdate = DB::statement('UPDATE adminnotifications SET `read` = "sudah" WHERE adminnotifications.id = '.$y->id.';');
                                $iteminsert = DB::statement('UPDATE adminnotifications SET pesan = ("Hi beberapa bukti transaksi pembayaran sudah tersedia, segera cek!!!") WHERE adminnotifications.id = '.$itemtransaksi[0]->id.';'); 

                                // $itemdelete = DB::delete('DELETE FROM adminnotifications WHERE adminnotifications.id = '.$y->id.';');
                            }
                        }
                        elseif($ya->jenis == "review"){
                            notify()->success('Hi beberapa ulasan baru sudah tersedia, segera cek!!!');
                            foreach ($itemtransaksi as $y){ 
                                $itemupdate = DB::statement('UPDATE adminnotifications SET `read` = "sudah" WHERE adminnotifications.id = '.$y->id.';');
                                $iteminsert = DB::statement('UPDATE adminnotifications SET pesan = ("Hi beberapa ulasan baru sudah tersedia, segera cek!!!") WHERE adminnotifications.id = '.$itemtransaksi[0]->id.';'); 

                                // $itemdelete = DB::delete('DELETE FROM adminnotifications WHERE adminnotifications.id = '.$y->id.';');
                            }
                        }
                        
                    }
                }
            }


            $user = User::count();
        if (!$user) {
            $user = 0;
        }
        $product = Produk::count();
        if (! $product) {
            $product = 0;
        }
        $transaction = Checkout::count();
        if (!$transaction) {
            $transactiont = 0;
        }
        $courier = courier::count();
        if (!$courier) {
            $courier = 0;
        }

        $now = Carbon::now('Asia/Makassar');
        $allTransactions = Checkout::where('status', 'sampai_tujuan')->get();
        //dd($allTransactions);
        $allSales = Checkout::where('status','sampai_tujuan')->count();
        $monthlySales = Checkout::where('status','sampai_tujuan')->whereMonth('created_at', $now->month)->count();
        $annualSales = Checkout::where('status','sampai_tujuan')->whereYear('created_at', $now->year)->count();
        $monthlyTransactions = Checkout::where('status', 'sampai_tujuan')->whereMonth('created_at', $now->month)->get();
        $annualTranscations = Checkout::where('status', 'sampai_tujuan')->whereYear('created_at', $now->year)->get();
        //dd($allTransactions);
        $incomeTotal = 0;
        $incomeMonthly = 0;
        $incomeAnnual = 0;

        foreach ($allTransactions as $transaction) {
            $incomeTotal+=$transaction->total;
        }

        
        foreach ($monthlyTransactions as $monthly) {
            $incomeMonthly+=$monthly->total;
        }

        foreach ($annualTranscations as $annual) {
            $incomeAnnual+=$annual->total;
        }

        
        $january = Checkout::where('status', 'sampai_tujuan')->whereMonth('created_at', '01')->count();
        $february = Checkout::where('status', 'sampai_tujuan')->whereMonth('created_at', '02')->count();
        $march = Checkout::where('status', 'sampai_tujuan')->whereMonth('created_at', '03')->count();
        $april = Checkout::where('status', 'sampai_tujuan')->whereMonth('created_at', '04')->count();
        $may = Checkout::where('status', 'sampai_tujuan')->whereMonth('created_at', '05')->count();
        $june = Checkout::where('status', 'sampai_tujuan')->whereMonth('created_at', '06')->count();
        $july = Checkout::where('status', 'sampai_tujuan')->whereMonth('created_at', '07')->count();
        $august = Checkout::where('status', 'sampai_tujuan')->whereMonth('created_at', '08')->count();
        $september = Checkout::where('status', 'sampai_tujuan')->whereMonth('created_at', '09')->count();
        $october = Checkout::where('status', 'sampai_tujuan')->whereMonth('created_at', '10')->count();
        $november = Checkout::where('status', 'sampai_tujuan')->whereMonth('created_at', '11')->count();
        $december = Checkout::where('status', 'sampai_tujuan')->whereMonth('created_at', '12')->count();

        return view('homeadmin', compact(
            'user','product','transaction','courier',
            'now', 'allSales', 'monthlySales', 'annualSales', 'incomeTotal', 'incomeMonthly', 'incomeAnnual', 'january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'
        ));

    }

    //checkout page
    public function checkout(){
        $checkout = Checkout::all();

        $detailcekout = DetailCheckout::all();
        

        return view('/admin/checkout', compact('checkout', 'detailcekout'));
    }

    //ganti status
    public function waiting($id){
        $data = Checkout::where('id', $id)
        ->update([
            'status' => "waiting"
        ]);
        return redirect('/admin/checkout');
    }

    //ganti status
    public function valid($id){
        $data = Checkout::where('id', $id)
        ->update([
            'status' => "valid"
        ]);

        //dd($id);
        
        return redirect('/admin/checkout');
    }

    //ganti status
    public function expired($id){
        $data = Checkout::where('id', $id)
        ->update([
            'status' => "expired"
        ]);
        return redirect('/admin/checkout');
    }

    //ganti status
    public function pengiriman($id){
        $data = Checkout::where('id', $id)
        ->update([
            'status' => "dalam_pengiriman"
        ]);
        return redirect('/admin/checkout');
    }

    //ganti status
    public function sampaitujuan($id){
        $data = Checkout::where('id', $id)
        ->update([
            'status' => "sampai_tujuan"
        ]);
        return redirect('/admin/checkout');
    }

    public function cetak(){
        $checkout = Checkout::all();
 
    	$pdf = PDF::loadview('laporan_pdf',['checkout'=>$checkout]);
    	return $pdf->stream();
    }
    
}
