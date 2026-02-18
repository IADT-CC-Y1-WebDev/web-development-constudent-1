<?php
/**
 * User Registration Handler - Exercise
 *
 * Follow the steps below to progressively implement form handling.
 * Each step corresponds to an example in /examples/04-php-forms/
 *
 * This file processes the form submission from book_create.php
 */


// =============================================================================
// Write your code here
// =============================================================================
// Include the required library files
require_once './lib/config.php';
require_once './lib/session.php';
require_once './lib/forms.php';
require_once './lib/utils.php';

$data = [];
$errors = [];

// Start the session
startSession();

try {
    // =========================================================================
    // STEP 1: View Posted Data
    // See: /examples/04-php-forms/step-01-form-submission/
    // =========================================================================
    // TODO: First, just dump the posted data to see what's submitted
    // dd($_POST);

    // =========================================================================
    // STEP 2: Check Request Method
    // See: /examples/04-php-forms/step-02-request-method/
    // =========================================================================
    // TODO: Check that the request method is POST

    // Step 2: Check request method - only accept POST requests
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    // If we get here, we have a valid POST request
    dd($_POST);


    // =========================================================================
    // STEP 3: Extract Data
    // See: /examples/04-php-forms/step-03-data-extraction/
    // =========================================================================
    // TODO: Extract form data into $data array
    // Use the null coalescing operator (??) to provide default values
    //
    // Hint: The format_ids field uses an array (format_ids[]) because multiple
    // checkboxes can be selected. This is already handled in the $data 
    // extraction:
    // 'format_ids' => $_POST['format_ids'] ?? []

    $data = [
        'title' => $_POST['title'] ?? null,
        'price' => $_POST['price'] ?? null,
        'publisher_id' => $_POST['publisher_id'] ?? null,
        'year' => $_POST['year'] ?? null,
        'isbn' => $_POST['isbn'] ?? null,
        'description' => $_POST['description'] ?? null,
        'cover' => $_FILES['cover'] ?? null,
        'format_ids' => $_POST['format_ids'] ?? [],
    ];

    

    // Now we can work with $data instead of $_POST
    dd($data);


    // =========================================================================
    // STEP 4: Validate Data
    // See: /examples/04-php-forms/step-04-validation/
    // =========================================================================
    // TODO: Define validation rules for each field
    // TODO: Check validation data against the rules
    // Create validator and check if validation fails; if so, store the first 
    // error for each field in the $errors array and throw an exception

     $rules = [
        'title' => 'required|notempty|min:1|max:255',
        'author' => 'required|notempty|min:1|max:255',
        'price' => 'required|float|minvalue:0',
        'description' => 'required|notempty|min:10|max:1000',
        'publisher' => 'required|notempty|min:1|max:255',
        'year' => 'required|notempty|min:1|max:255',
        'cover' => 'required|file|image|mimes:jpg,jpeg,png|max_file_size:5242880',
        'isbn' => 'required|notempty|min:1|max:255',
        'format_ids' => 'required|notempty|min:1|max:255'
        
    ];


    $validator = new Validator($data, $rules);

    if ($validator->fails()) {
        foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }
        throw new Exception('Validation failed.');
    }

    echo "<h2>Validation Passed!</h2>";
    dd($data);

    // =========================================================================
    // STEP 9: File Uploads
    // See: /examples/04-php-forms/step-09-file-uploads/
    // =========================================================================
    // TODO: Extract file from $_FILES
    // Hint: Add to $data extraction:
    // 'cover' => $_FILES['cover'] ?? null
    //
    // TODO: Add validation for the cover:
    // Hint: Add to $rules
    // 'cover' => 'required|file|image|mimes:jpg,jpeg,png|max_file_size:2097152'  // 2MB = 2 * 1024 * 1024
    //
    // TODO: Process file upload
    // If there is an upload error, add to an error to the $errors array and 
    // throw an exception
    // Hint: Use the ImageUpload class to handle the upload


    // =========================================================================
    // STEP 10: Complete Handler
    // See: /examples/04-php-forms/step-10-complete/
    // =========================================================================
    // TODO: Clear form data on success (before redirect)


    // =========================================================================
    // STEP 8: Flash Messages
    // See: /examples/04-php-forms/step-08-flash-messages/
    // =========================================================================
    // TODO: On successful registration, set a success flash message and 
    // redirect back to the form
    $uploader = new ImageUpload();
    $imageFilename = $uploader->process($_FILES['cover']);

    if (!$imageFilename) {
        throw new Exception('Failed to process and save the image.');
    }

    // Clear form data on success
    clearFormData();
    clearFormErrors();

    setFlashMessage('success', 'Product created with image: ' . $imageFilename);
    redirect('product_create.php');
}
catch (Exception $e) {
   
    if ($imageFilename) {
        $uploader->deleteImage($imageFilename);
    }

    setFlashMessage('error', 'Error: ' . $e->getMessage());
    setFormErrors($errors);
    setFormData($data);
    redirect('book_create.php');
}

    // =========================================================================
    // STEP 5: Store Errors and Redirect
    // See: /examples/04-php-forms/step-05-display-errors/
    // =========================================================================
    // TODO: In the catch block, store validation errors in the session
    // TODO: Redirect back to the form

    // echo "Error: " . $e->getMessage();
    // =========================================================================
    // STEP 6: Store Form Data for Repopulation
    // See: /examples/04-php-forms/step-06-repopulate-fields/
    // =========================================================================
    // TODO: Before redirecting on error, also store the form data


    // =========================================================================
    // STEP 8: Flash Messages
    // See: /examples/04-php-forms/step-08-flash-messages/
    // =========================================================================
    // TODO: On validation error, you set an error flash message

    

