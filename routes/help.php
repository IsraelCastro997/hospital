Route::get('/cirugias','App\Http\Controllers\CirugiasController@index')->name('cirugias.index');
Route::get('/cirugias/all','App\Http\Controllers\CirugiasController@showall')->name('cirugias.showall');
Route::get('/cirugias/editar/{id}','App\Http\Controllers\CirugiasController@showedit')->name('cirugias.edit');
Route::get('/cirugias/detalleone/{id}','App\Http\Controllers\CirugiasController@showone')->name('cirugias.nuevo');
Route::get('/cirugias/agregar','App\Http\Controllers\CirugiasController@create')->name('cirugias.create');
Route::get('/cirugias/detalle/{id}','App\Http\Controllers\CirugiasController@show')->name('cirugias.show');
Route::apiResource('cirugias', 'App\Http\Controllers\CirugiasController');
