@extends('layouts.dash')
@section('content')

<div id="user-subscription">

	<div class="row">
		<div class="col-md-12">
			
			@if (Session::has('message'))	
              <div class="alert alert-info">
	            <i class="fa fa-check"></i>
	            {{ Session::get('message') }}
	          </div>
	          @endif
			
			@if ($errors->any())	
	          <div class="alert alert-danger">
	            <i class="fa fa-lock"></i>
	            {!! implode('', $errors->all('
	            	<p>:message</p>
	            ')) !!}
	          </div>
	        @endif

		</div>

	</div>
	
	<div class="row" >
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>User Profile<small>Account Settings</small></h2>
					<div class="clearfix"></div>
				</div>
				
				<div class="x_content">
					
					<div class="row">
							
					    <div class="col-md-6">
					      <div class="panel panel-default">
					            <div class="panel-body">
					              <form id="payment-form" class="fieldset-form" method="post" action="{{ url('admin/user/process-subscription') }}">
					              	{{ csrf_field() }}
					                <fieldset>
					                  <legend>Your Payment Information</legend>

					                  <div class="form-alert alert alert-danger" style="display:none;">
							            <i class="fa fa-lock"></i>
							            <p class="error">&nbsp;</p>
							          </div>
									  
					                  <div class="form-group">
					                    <label for="card_number" class="form-label">Card Number</label>
					                    <input type="text" class="form-control card-number" size="20" data-stripe="number" >
					                  </div>
					                  <div class="form-group">
					                  	<div class="row">
					                  		<div class="col-md-6">
						                  		<label for="email" class="form-label">Expiration (MM/YY)</label>
						                  		<div class="row">
						                  			<div class="col-md-6">
						                  				<input type="text" class="form-control exp_month" size="2" data-stripe="exp_month" placeholder="MM">
						                  			</div>
						                  			<div class="col-md-6">
						                  				<input type="text" class="form-control exp_year" size="2" data-stripe="exp_year" placeholder="YY">
						                  			</div>
						                  		</div>
						                  		
						                  		
											</div>
					                  		<div class="col-md-6">
					                  			<label for="email" class="form-label">CVC</label>
					                  			<input type="text" class="form-control cvc" size="4" data-stripe="cvc">
						                    </div>
					                  	</div>
					                    
					                  </div>
					                  <br/>
					                  <button type="submit" class="btn btn-primary submit">Subscribe Now</button>

					                </fieldset>
					              </form>

					            </div>

					      </div>
					    </div>
						<!-- /.col-md-6 -->
					    <div class="col-md-6">
					    	&nbsp;
					    </div>

					</div>
					<!-- /.row -->
				</div> 
				<!-- /.x-content -->
			</div>
		</div>
	</div>

<!-- @include('site.user.create') -->

</div>
@stop

@section('headerScript')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	<script type="text/javascript">
	  Stripe.setPublishableKey("{{ config('services.stripe.key') }}");
	</script>
@stop

@section('footerScript')
	<script type="text/javascript">
		$(function() {

			var $form = $('#payment-form');
			$form.submit(function(event) {
				
				event.preventDefault();
				event.stopPropagation();

				// Disable the submit button to prevent repeated clicks:
				$form.find('.submit').prop('disabled', true);

				// Request a token from Stripe:
				Stripe.card.createToken($form, stripeResponseHandler);

				// Prevent the form from being submitted:
				return false;
			});


			function stripeResponseHandler(status, response) {
				// Grab the form:
				var $form = $('#payment-form');

				//console.log(response);

				if (response.error) { // Problem!

					// Show the errors on the form:
					$form.find('.form-alert').show().find('.error').text(response.error.message);
					$form.find('.submit').prop('disabled', false); // Re-enable submission

				} else { // Token was created!

					// Get the token ID:
					var token = response.id;

					// Insert the token ID into the form so it gets submitted to the server:
					$form.append($('<input type="hidden" name="stripeToken">').val(token));

					// Submit the form:
					$form.get(0).submit();
				}
			};

		});

	</script>
@stop