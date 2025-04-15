<?php
 
 namespace App\Http\Controllers;
 
 use App\Models\BarangModel;
 use App\Models\KategoriModel;
 use Illuminate\Http\Request;
 use Yajra\DataTables\DataTables;
 use Illuminate\Support\Facades\Validator;
 use PhpOffice\PhpSpreadsheet\IOFactory;
 
 
 class BarangController extends Controller
 {
     /**
      * Display a listing of the resource.
      */
     public function index()
     {
         $breadcrumb = (object) [
             'title' => 'Data Barang',
             'list'  => ['Home', 'Barang']
         ];
 
         $page = (object) [
             'title' => 'Daftar barang yang terdaftar dalam sistem'
         ];
 
         $activeMenu = 'barang';
 
         $kategori = KategoriModel::all();
 
         return view('barang.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'kategori' => $kategori]);
     }
 
     public function list(Request $request)
     {
         $products = BarangModel::select('barang_id', 'barang_kode', 'barang_nama', 'kategori_id', 'harga_beli', 'harga_jual')->with('kategori');
 
         // Filter data barang berdasarkan kategori_id
         if ($request->kategori_id) {
             $products->where('kategori_id', $request->kategori_id);
         }
 
         return DataTables::of($products)
             ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
             ->addColumn('aksi', function ($barang) {
                // menambahkan kolom aksi
                // $btn = '<a href="' . url('/barang/' . $barang->barang_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                // $btn .= '<a href="' . url('/barang/' . $barang->barang_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                // $btn .= '<form class="d-inline-block" method="POST" action="' . url('/barang/' . $barang->barang_id) . '">'
                //     . csrf_field() . method_field('DELETE') .
                //     '<button type="submit" class="btn btn-danger btn-sm"
                //     onclick="return confirm(\'Apakah Anda yakit menghapus data
                //     ini?\');">Hapus</button></form>';
                $btn = '<button onclick="modalAction(\'' . url('/barang/' . $barang->barang_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';

                $btn .= '<button onclick="modalAction(\'' . url('/barang/' . $barang->barang_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';

                $btn .= '<button onclick="modalAction(\'' . url('/barang/' . $barang->barang_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                 return $btn;
             })
             ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
             ->make(true);
     }
 
     /**
      * Show the form for creating a new resource.
      */
     public function create()
     {
         $breadcrumb = (object) [
             'title' => 'Tambah Barang',
             'list'  => ['Home', 'Barang', 'Tambah']
         ];
 
         $page = (object) [
             'title' => 'Tambah barang baru'
         ];
 
         $kategori = KategoriModel::all();
 
         $activeMenu = 'barang';
 
         return view('barang.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
     }
 
     /**
      * Store a newly created resource in storage.
      */
     public function store(Request $request)
     {
         $request->validate([
             'barang_kode'   => 'required|string|min:3|unique:m_barang,barang_kode',
             'barang_nama'   => 'required|string|max:100',
             'kategori_id'   => 'required|int',
             'harga_beli'    => 'required|integer',
             'harga_jual'    => 'required|integer'
         ]);
 
         BarangModel::create([
             'barang_kode'   => $request->barang_kode,
             'barang_nama'   => $request->barang_nama,
             'kategori_id'   => $request->kategori_id,
             'harga_beli'    => $request->harga_beli,
             'harga_jual'    => $request->harga_jual
         ]);
 
         return redirect('/barang')->with('success', 'Data barang berhasil disimpan');
     }
 
     /**
      * Display the specified resource.
      */
     public function show(string $id)
     {
         $barang = BarangModel::with('kategori')->find($id);
 
         $breadcrumb = (object) [
             'title' => 'Detail Barang',
             'list'  => ['Home', 'Barang', 'Detail']
         ];
 
         $page = (object) [
             'title' => 'Detail barang'
         ];
 
         $activeMenu = 'barang';
 
         return view('barang.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'barang' => $barang]);
     }
 
     /**
      * Show the form for editing the specified resource.
      */
     public function edit(string $id)
     {
         $barang = BarangModel::find($id);
         $kategori = KategoriModel::all();
 
         $breadcrumb = (object) [
             'title' => 'Edit Barang',
             'list'  => ['Home', 'barang', 'Edit']
         ];
 
         $page = (object) [
             'title' => 'Edit barang'
         ];
 
         $activeMenu = 'barang';
 
         return view('barang.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'barang' => $barang, 'kategori' => $kategori]);
     }
 
     /**
      * Update the specified resource in storage.
      */
     public function update(Request $request, string $id)
     {
         $request->validate([
             'barang_kode'   => 'required|string|min:3|unique:m_barang,barang_kode,' . $id . ',barang_id',
             'barang_nama'   => 'required|string|max:100',
             'kategori_id'   => 'required|integer',
             'harga_beli'    => 'required|integer',
             'harga_jual'    => 'required|integer'
         ]);
 
         BarangModel::find($id)->update([
             'barang_kode'   => $request->barang_kode,
             'barang_nama'   => $request->barang_nama,
             'kategori_id'   => $request->kategori_id,
             'harga_beli'    => $request->harga_beli,
             'harga_jual'    => $request->harga_jual
         ]);
 
         return redirect('/barang')->with('success', 'Data barang berhasil diubah');
     }
 
     /**
      * Remove the specified resource from storage.
      */
     public function destroy(string $id)
     {
         $check = BarangModel::find($id);
 
         if (!$check) {
             return redirect('/barang')->with('error', 'Data barang tidak ditemukan');
         }
 
         try {
             BarangModel::destroy($id);
 
             return redirect('/barang')->with('success', 'Data barang berhasil dihapus');
         } catch (\Illuminate\Database\QueryException $e) {
             return redirect('/barang')->with('error', 'Data barang gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
         }
     }

      // Create ajax
      public function create_ajax()
      {
          $kategori = KategoriModel::select('kategori_id', 'kategori_nama')->get();
  
          return view('barang.create_ajax')->with('kategori', $kategori);
      }
      
       // Store ajax
     public function store_ajax(Request $request)
     {
         if ($request->ajax() || $request->wantsJson) {
             $rules = [
                 'kategori_id' => 'required|int',
                 'barang_kode' => 'required|string|min:3|unique:m_barang,barang_kode',
                 'barang_nama' => 'required|string|max:100',
                 'harga_beli' => 'required|integer',
                 'harga_jual' => 'required|integer',
             ];
 
             $validator = Validator::make($request->all(), $rules);
 
             if ($validator->fails()) {
                 return response()->json([
                     'status' => false,
                     'message' => 'Validasi Gagal',
                     'msgField' => $validator->errors(),
                 ]);
             }
 
             BarangModel::create($request->all());
 
             return response()->json([
                 'status' => true,
                 'message' => 'Data barang berhasil disimpan',
             ]);
         }
         return redirect('/');
     }

      // Edit ajax
      public function edit_ajax(string $id)
      {
          $barang = BarangModel::find($id);
          $kategori = KategoriModel::select('kategori_id', 'kategori_nama')->get();
  
          return view('barang.edit_ajax', ['barang' => $barang, 'kategori' => $kategori]);
      }
      
      // Update ajax
     public function update_ajax(Request $request, string $id)
     {
         if ($request->ajax() || $request->wantsJson()) {
             $rules = [
                 'barang_kode' => 'required|string|min:3|unique:m_barang,barang_kode,' . $id . ',barang_id',
                 'barang_nama' => 'required|string|max:100',
                 'kategori_id' => 'required|integer',
                 'harga_beli' => 'required|integer',
                 'harga_jual' => 'required|integer',
             ];
 
             $validator = Validator::make($request->all(), $rules);
 
             if ($validator->fails()) {
                 return response()->json([
                     'status' => false,
                     'message' => 'Validasi Gagal',
                     'msgField' => $validator->errors(),
                 ]);
             }
             $check = BarangModel::find($id);
             if ($check) {
                 $check->update($request->all());
 
                 return response()->json([
                     'status' => true,
                     'message' => 'Data barang berhasil diupdate',
                 ]);
             } else {
                 return response()->json([
                     'status' => false,
                     'message' => 'Data barang tidak ditemukan',
                 ]);
             }
         }
         return redirect('/');
     }
 
     // Confirm ajax
     public function confirm_ajax(string $id)
     {
         $barang = BarangModel::find($id);
 
         return view('barang.confirm_ajax', ['barang' => $barang]);
     }
 
     // Delete ajax
     public function delete_ajax(Request $request, string $id)
     {
         if ($request->ajax() || $request->wantsJson()) {
             $barang = BarangModel::find($id);
 
             if ($barang) {
                 $barang->delete();
                 return response()->json([
                     'status' => true,
                     'message' => 'Data barang berhasil dihapus'
                 ]);
             } else {
                 return response()->json([
                     'status' => false,
                     'message' => 'Data barang tidak ditemukan'
                 ]);
             }
         }
         return redirect('/');
     }

     /**
      * Menampilkan form import barang
      */
    public function import()
    {
        return view('barang.import');
    }

    public function import_ajax(Request $request)
     {
         if ($request->ajax() || $request->wantsJson()) {
             $rules = [
                 'file_barang' => ['required', 'mimes:xlsx', 'max:1024']
             ];
 
             $validator = Validator::make($request->all(), $rules);
             if ($validator->fails()) {
                 return response()->json([
                     'status' => false,
                     'message' => 'Validasi Gagal',
                     'msgField' => $validator->errors()
                 ]);
             }
 
             $file = $request->file('file_barang');
             $reader = IOFactory::createReader('Xlsx');
             $reader->setReadDataOnly(true);
             $spreadsheet = $reader->load($file->getRealPath());
             $sheet = $spreadsheet->getActiveSheet();
             $data = $sheet->toArray(null, false, true, true);
 
             $insert = [];
             if (count($data) > 1) {
                 foreach ($data as $baris => $value) {
                     if ($baris > 1) { // baris ke 1 adalah header
                         $insert[] = [
                             'kategori_id' => $value['A'],
                             'barang_kode' => $value['B'],
                             'barang_nama' => $value['C'],
                             'harga_beli' => $value['D'],
                             'harga_jual' => $value['E'],
                             'created_at' => now(),
                         ];
                     }
                 }
 
                 if (count($insert) > 0) {
                     BarangModel::insertOrIgnore($insert);
                     return response()->json([
                         'status' => true,
                         'message' => 'Data berhasil diimport'
                     ]);
                 }
             }
 
             return response()->json([
                 'status' => false,
                 'message' => 'Tidak ada data yang diimport'
             ]);
         }
 
         return redirect('/');
     }

     public function export_excel()
     {
        //ambil data barang yang akan di export
        $barang = BarangModel::select('kategori_id', 'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual')
                    ->orderBy('kategori_id')
                    ->with('kategori')
                    ->get();
            
            //load library excel 
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet(); // ambil sheet yang aktif
            
            $sheet->setCellValue('A1', 'No');
            $sheet->setCellValue('B1', 'Kode Barang');
            $sheet->setCellValue('C1', 'Nama Barang');
            $sheet->setCellValue('D1', 'Harga Beli');
            $sheet->setCellValue('E1', 'Harga Jual');
            $sheet->setCellValue('F1', 'Kategori');

            $sheet->getStyle('A1:F1')->getFont()->setBold(true); // bold header

            $no = 1; //nomor data dimulai dari 1
            $baris = 2; //baris data dimulai dari bari ke 2
            foreach ($barang as $key => $value) {
                $sheet->setCellValue('A'.$baris, $no);
                $sheet->setCellValue('B'.$baris, $value->barang_kode);
                $sheet->setCellValue('C'.$baris, $value->barang_nama);
                $sheet->setCellValue('D'.$baris, $value->harga_beli);
                $sheet->setCellValue('E'.$baris, $value->harga_jual);
                $sheet->setCellValue('F'.$baris, $value->kategori->kategori_nama);
                $baris++;
                $no++;
            }

            foreach(range('A','F') as $columnID) {
                $sheet->getColumnDimension($columnID)->setAutoSize(true); // set auto size untuk kolom 
            }
            
            $sheet->setTitle('Data Barang');
         
            // Generate filename
            $filename = 'Data_Barang_' . date('Y-m-d_H-i-s') . '.xlsx';
    
            // Set header untuk download file
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
            header('Cache-Control: cache, must-revalidate');
            header('Pragma: public');
    
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
            exit;
        }
    }  
 