<?php

		namespace App\Controllers;
		use App\Models\PesananModel;

		class PesananController extends BaseController
		{
			protected $transaksi;

			function __construct()
			{
				helper('form');
				$this->validation = \Config\Services::validation();
				$this->transaksi = new PesananModel();
			}

			public function index()
			{
				$data['transaksis'] = $this->transaksi->findAll();
				return view('pages/pesanan_view', $data);
			}

			public function create()
			{
				$data = $this->request->getPost();
				
				if($data){
					$dataForm = [ 
						'username' => $this->request->getPost('username'),
						'ongkir' => $this->request->getPost('ongkir'),
						'total_harga' => $this->request->getPost('total_harga'),
                        'created_by' => $this->request->getPost('created_by'),
					];
		
					$this->transaksi->insert($dataForm); 
			
					return redirect('pesanan')->with('success','Data Berhasil Ditambah');
				}else{
					return redirect('pesanan')->with('failed',implode("<br>",$errors));
				}    
			}

			public function edit($id)
			{
				$data = $this->request->getPost();
				if($data){
					if($data){
						if($data){
							$dataForm =[
								'status' => $this -> request -> getPost('status'),				
							];
						}
					}
					$this->transaksi->update($id, $dataForm);
					return redirect('pesanan')->with('success','Data Berhasil Diubah');
				}else{
					return redirect('pesanan')->with('failed','Data gagal di perbarui');
				}
				
			}

			public function delete($id)
			{		
				$this->transaksi->delete($id);

				return redirect('pesanan')->with('success','Data Berhasil Dihapus');
			}
		}