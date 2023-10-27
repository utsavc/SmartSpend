@extends('layout.app')

@section('content')
<div class="row container-fluid">

	@include('layout.sidelayout')

	<div class="col-lg-10">
		<div class="container">
			<div class="row justify-content-center mt-2 mb-3">
				<div class="col-md-6 border p-5" style="background: #faf9f5;">
					<h3 class="text-center">Expense</h3>

					<form name="expense" action="{{ route('expense.store')}}" method="post" onsubmit="return validateExpense();" enctype="multipart/form-data">
						@csrf
						<div class="mb-3">
							<label class="form-label">Expense Amount</label>
							<input type="text" name="amount" class="form-control @error('amount') is-invalid @enderror" required>
							@error('amount')
							<div class="invalid-feedback">
								{{ $message }} <!-- Display the error message for 'amount' -->
							</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">Description</label>
							<textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror" required></textarea>
							@error('description')
							<div class="invalid-feedback">
								{{ $message }} <!-- Display the error message for 'description' -->
							</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">Category</label>
							<select name="category" class="form-select @error('category') is-invalid @enderror" aria-label="Default select example" required>
								<option selected>Select Category</option>
								<option value="Business Travel">Business Travel</option>
								<option value="Office Expense">Office Expenses</option>
								<option value="Overtime Meal">Overtime Meal</option>
								<option value="Others">Others</option>
							</select>
							@error('category')
							<div class="invalid-feedback">
								{{ $message }} <!-- Display the error message for 'category' -->
							</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">Supporting Document</label>
							<input type="file" name="supporting_document" class="form-control @error('supporting_document') is-invalid @enderror">
							@error('supporting_document')
							<div class="invalid-feedback">
								{{ $message }} <!-- Display the error message for 'supporting_document' -->
							</div>
							@enderror
						</div>

						<div class="mb-3 form-check">
							<input type="checkbox" class="form-check-input" id="draft" name="draft">
							<label class="form-check-label" for="draft">Draft</label>
						</div>

						@if(session('success'))
						<div class="alert alert-success">
							{{ session('success') }}
						</div>
						@endif

						<div class="">
							<button type="submit" class="btn btn-sm btn-primary">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	// Add an event listener to the checkbox
	document.addEventListener('DOMContentLoaded', function () {
    const checkbox = document.querySelector('#draft'); // Replace with the actual checkbox ID

    // Add a change event listener to the checkbox
    checkbox.addEventListener('change', function () {
        const submitButton = document.querySelector('button[type="submit"]'); // Select the submit button

        // Check if the checkbox is checked
        if (checkbox.checked) {
            submitButton.textContent = 'Draft'; // Change the text of the submit button to "Draft"
        } else {
            submitButton.textContent = 'Submit'; // Change it back to "Submit" if the checkbox is unchecked
        }
    });
});

</script>
@endsection
