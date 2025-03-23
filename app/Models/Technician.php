namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technician extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone']; // Asegúrate de que estos campos existan en tu base de datos
}
