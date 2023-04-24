<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scanbarcode extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'scanbarcodes';

    protected $fillable = ['barcode'];
	
}
