use App\Http\Controllers\TechnicianController;

// ... otras rutas ...

Route::get('/api/technicians', [TechnicianController::class, 'search']);
