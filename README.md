Task created using Laravel Homestead.



Routes and views used 

- <strong>Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');</strong>

returns to main menu with a list of all url-links in the database, along with the short links and number of how many times the link is visited

- Route::get('/add-new-link', [App\Http\Controllers\HomeController::class, 'add_link'])->name('home.add.link');

returns to the add link page, which has a simple input for submitting the url

- Route::get('/view/{short_url}', [App\Http\Controllers\HomeController::class, 'view'])->name('home.view');

apon clicking on the shortened link, the route redirects to the original page which is first retrieved from the db and add's plus one visit to the counter

- Route::post('/store-link', [App\Http\Controllers\LinkController::class, 'store'])->name('store.link');

this is the route where we submit the request for procesing. First we validate if the input is valid url format, than create a five letter string. We check if
there is an existing string. If it is unique, we set the counter to zero, and save all the data in db, original_url, short_url and counter


API routes

- Route::get('/view/{short_url}', [App\Http\Controllers\ApiController::class, 'view']);

when accessed, we first check the db for the record. 
If the record exists, add plus one on the counter and return the json response with the original_url, with the coresponding status
If the record doesn't exist, we return an error message with status 404, resource not found.

- Route::post('/store-link', [App\Http\Controllers\ApiController::class, 'store']);

the route is used to save and shorten a given link which is sent with a post request.
First we validate if it is a valid url, if not, we return json error message "Bad request/Url not vali" with status 400.
If the url is valid we continue with the steps for creating the record, short_url creation and save in db.
If the link is successfully created we return json with status success, and message "Url save successfully, along with the selected record and a status of 200.
If there was an error we return an error message with status 500. 