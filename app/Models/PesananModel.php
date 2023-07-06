<?php namespace App\Models;

		use CodeIgniter\Model;

		class PesananModel extends Model
		{
			protected $table = 'transaksi'; 
			protected $primaryKey = 'id';
			protected $allowedFields = [
				'username','ongkir','total_harga', 'status', 'created_date'
			];  
		}