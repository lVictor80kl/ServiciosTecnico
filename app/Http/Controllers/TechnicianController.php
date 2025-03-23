namespace App\Http\Controllers;

use App\Models\Technician;
use Illuminate\Http\Request;

class TechnicianController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('search');
        $technicians = Technician::where('name', 'LIKE', "%{$query}%")->get();
        return response()->json($technicians);
    }
}
